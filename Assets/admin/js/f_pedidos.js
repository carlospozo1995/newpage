'use strict';
var tablePedidos;

$(document).ready(function () {
   
    // --- PRINT DATA TABLE USERS --- //
    tablePedidos = $("#tablePedidos").DataTable({
        "aProcessing": true,
        "aServerSide":true,
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


    if ($(".btn_next-process").length) {
        $(".btn_next-process").click(function name() {
            let this_btn = $(this);
            let id_order = this_btn.attr('id');

            if (id_order != "") {
                let url = base_url + "pedidos/statusOrder/";
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

                            fntSave();
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

    function fntSave() {
        $(".btn-save").click(function (e) {
            e.preventDefault();
            let value_status = $(".status-type").val();

            if (value_status != "") {
                let fcont = $(".status-type").parent();
                let dateVal = fcont.find($(".date-val")).val();
                let commentVal = fcont.find($(".comment-val")).val();
                
                if (dateVal != "") {

                    let url = base_url + "//";
                    $.ajax({
                        url: url,
                        dataType: 'JSON',
                        method: 'POST',
                        data: {
                            value_status: value_status,
                            dateVal: dateVal,
                            commentVal: commentVal
                        },
                        success: function(data){}
                    });

                }else{
                    msgShow(2, 'Atención', "Por favor ingrese un fecha.");
                }
            }else{
                msgShow(3, 'Error', "Ha ocurrido un error. Inténtelo de nuevo.");
            }
        })
    }
});