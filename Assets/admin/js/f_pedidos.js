'use strict';
var tablePedidos;
var rowTable;

$(document).ready(function () {
   
    // --- PRINT DATA TABLE USERS --- //
    tablePedidos = $("#tablePedidos").DataTable({
        "aProcessing": true,
        "aServerSide":true,
        "autoWidth": false,
        "language":{
            "url":"//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        },
        "responsive": true,
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
        // "dom": 'lBfrtip',
        // "buttons": [
        //     "copy", "csv", "excel", "pdf", "print", "colvis"
        // ],
        "bDestroy":true,
        "order":[[0,"asc"]],
        "iDisplayLength":25,
    });

    if ($("#tablePedidos .btn_next-process").length) {
        $('#tablePedidos').on('click', '.btn_next-process',function name() {
            let this_btn = $(this);
            let id_order = this_btn.attr('id');

            if (id_order != "") {
                let url = base_url + "pedidos/orderProgress/";
                $.ajax({
                    url: url,
                    dataType: 'JSON',
                    method: 'POST',
                    data: {
                        id_order: id_order,
                    },
                    success: function(data){
                        if (data.status) {
                            let request = data.request[0];

                            $(".modal-title").html("Proceso de entrega. Orden #" + request.num_order);

                            let output = "";

                            if (request.reviewed_date != null) {
                                output += createCard("Revisado",  request.reviewed_date, request.reviewed_comment, "");

                                if (request.shipping_date != null) {
                                    output += createCard("Enviado", request.shipping_date, request.shipping_comment, "");

                                    if (request.delivery_date != null) {
                                        output += createCard("Entregado", request.delivery_date, request.delivery_comment, "");
                                    } else {
                                        output += createCard("Entregado", "", "", 3);
                                    }
                                } else {
                                    output += createCard("Enviado", "", "", 2);
                                }
                            } else {
                                output += createCard("Revisado", "", "", 1);
                            }

                            $(".modal-body").html(output);
                            $(".modal-footer").html(`
                                <div><button type="submit" class="btn btn-dark btn-save">Guardar</button></div>
                            `);
                            $('#modalFormStatus').modal('show');

                            fntSave(id_order, this_btn);
                        }else{
                            msgShow(3, 'Error', data.msg)
                        }
                    }
                });
            }else{
                msgShow(3, 'Error', "Ha ocurrido un error. Inténtelo de nuevo.");
            }
        })
    }

    function createCard(title, date, comment, flag) {
        return `
            <div class="card my-4">
                <div class="card-header text-uppercase">${title}</div>
                <div class="card-body">
                    ${flag != "" ? '<input class="status-type" type="hidden" value="'+flag+'">' : ""}
                    <div class="form-row">
                        <div class="col-2 text-right">
                            <label class="p-3 lead">Fecha:</label>
                        </div>
                        <div class="col-10 p-3">
                            <input type="date" class="form-control date-val" ${date != "" ? 'value="'+new Date(date).toISOString().split('T')[0]+'" readonly=""' : ''}>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-2 text-right">
                            <label class="p-3 lead">Comentario:</label>
                        </div>
                        <div class="col-10 p-3">   
                            <textarea class="form-control comment-val" ${comment != "" ? 'readonly="">' + comment : '>'}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    function fntSave(id_order, element) {
        $(".btn-save").click(function (e) {
            e.preventDefault();

            if ($(".status-type").length == 1) {
                let value_status = $(".status-type").val();

                if (value_status != "") {
                    let fcont = $(".status-type").parent();
                    let dateVal = fcont.find($(".date-val")).val();
                    let commentVal = fcont.find($(".comment-val")).val();
                    
                    if (dateVal != "") {
    
                        let url = base_url + "pedidos/updateOrderProgress/";
                        $.ajax({
                            url: url,
                            dataType: 'JSON',
                            method: 'POST',
                            data: {
                                id: id_order,
                                amountEle: $(".status-type").length,
                                status: value_status,
                                date: dateVal,
                                comment: commentVal
                            },
                            beforeSend: function() {
    
                            },
                            success: function(data){

                                if (data.status) {
                                    let objectDate = dateVal.split("-");
                                    let formatDate = objectDate[2] + "/" + objectDate[1] + "/" + objectDate[0];
                                    let status, message, index;
                                    rowTable = element.closest("tr")[0];
                                    
                                    if (data.request == 1) {
                                        index = 0
                                        status = "Revisado";
                                        message = commentVal != "" ? commentVal : "Hemos revisado su pedido, iniciamos proceso de entrega.";
                                    }else if (data.request == 2) {  
                                        index = 1
                                        status = "Enviado";
                                        message = commentVal != "" ? commentVal : "Su pedido ha sido despachado y está en ruta hacia su destino.";
                                    }else{
                                        index = 2
                                        status = "Entregado";
                                        message = commentVal != "" ? commentVal : "¡Felicidades! Su pedido ha sido entregado satisfactoriamente.";
                                    }  
                                   
                                    let ischild = $(rowTable).hasClass("child");
                                    if(ischild){
                                        rowTable = $(rowTable).prev()[0];
                                    }

                                    let listContent = $(rowTable).find("ul.timeline");

                                    let liElement = listContent.find("li:eq(" + index + ")");
                                    liElement.html(`
                                        <h5>${formatDate}</h5>
                                        <p class="font-weight-bold text-success">${status} <i class="nav-icon fas fa-check"></i></p>
                                        <p>${message}</p>
                                    `);


                                    let newContent = `<ul class="timeline list-inline">${listContent.html()}</ul> ${index != 2 ? '<button type="button" class="btn btn-primary btn-sm btn_next-process" id="'+id_order+'">Next process</button>' : ''}`;
                                    $("#tablePedidos").DataTable().cell(rowTable, 7).data(newContent).draw(false);

                                    if (data.statusOrder) {
                                        $("#tablePedidos").DataTable().cell(rowTable, 6).data("Approved").draw(false);
                                        $("#tablePedidos").DataTable().cell(rowTable, 8).data(`
                                        <div class="text-center">
                                            <a href="${base_url}orden/${id_order}" class="btn btn-secondary btn-sm" title="Ver Pedido"><i class="fa-solid fa-eye"></i></a>
                                        </div>`).draw(false);
                                    }

                                    $('#modalFormStatus').modal('hide');
                                    msgShow(1, 'Progreso de entrega', data.msg);
                                }else{
                                    msgShow(2, 'Atención', data.msg);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            },
                            complete: function() {
                                
                            }
    
                        });
    
                    }else{
                        msgShow(2, 'Atención', "Por favor ingrese un fecha.");
                    }
                }else{
                    msgShow(3, 'Error', "Ha ocurrido un error. Inténtelo de nuevo.");
                }
            }else{
                msgShow(3, 'Error', "Ha ocurrido un error. Inténtelo de nuevo.");
            }
            
        })
    }

    if ($("#tablePedidos .btn_order-cancelled").length) {
        $('#tablePedidos').on('click', '.btn_order-cancelled',function name() {
            let this_btn = $(this);
            let id_order = this_btn.attr('id');

            if (id_order != "") {
                let url = base_url + "pedidos/orderCancelled/";
                $.ajax({
                    url: url,
                    dataType: 'JSON',
                    method: 'POST',
                    data: {
                        id_order: id_order,
                    },
                    success: function(data){
                        console.log(data)
                    }
                });
            }else{
                msgShow(3, 'Error', "Ha ocurrido un error. Inténtelo de nuevo.");
            }
        })
    }
});
