
'use strict';

var tableRoles;
var rowTable;

$(document).ready(function(){

    var formNewRol = $("#formNewRol");

    if ($("#btnNewRol").length) {
        $("#btnNewRol").click(function () {

            formNewRol.find("#idRol").val("");
            $(".modal-header").removeClass("headerUpdate").addClass("headerRegister");
            $(".modal-title").text("Nuevo Rol");
            $("#btnSubmitRol").removeClass("bg-success").addClass("btn-primary");
            $(".btnText").text("Guardar");
            formNewRol.trigger("reset");

            $('#modalFormRol').modal('show');
            rowTable = "";

        });       
    }


    // --- ADD NEW ROL --- //
    formNewRol.submit((e) => {
        e.preventDefault();
        let id = $("#idRol").val();
        let name = $("#name_rol").val();
        let description = $("#descrip_rol").val();
        let status = $("#status_rol").val();

        if (name == "" || description == "" || status == "") {
            msgShow(2, 'Atención', "Rellene todos los campos.");
            return false;
        }else{
            let url_ajax = base_url + "roles/setRol/";
            $.ajax({
                url: url_ajax,
                dataType: 'JSON',
                method: 'POST',
                data: {
                    id :id,
                    name: name,
                    description: description,
                    status: status,
                },
                success: function(data){
                    if (data.status) {
                        let htmlStatus = status == 1 ? '<div class="text-center"><span class="bg-success p-1 rounded"><i class="fa-solid fa-user"></i> Activo</span></div>' : '<div class="text-center"><span class="bg-danger p-1 rounded"><i class="fa-solid fa-user-slash"></i> Inactivo</span></div>';

                        if (rowTable == "") {
                            let id_request = data.data_request.id_request;
                            let id_user = data.data_request.id_user;

                            let id_row = $("#tableRoles").DataTable().rows().count() + 1;
                            let btnPermissions = "";
                            let btnUpdate = "";
                            let btnDelete = "";

                            if (id_user == 1) {
                                btnPermissions = '<button type="button" class="btn btn-secondary btn-sm" onclick="permissions('+"'"+id_request+"'"+')" tilte="Permisos"><i class="fa-solid fa-key"></i></button>'
                            }

                            if (id_user == 1) {
                                btnUpdate = '<button type="button" class="btn btn-primary btn-sm" onclick="edit(this, '+"'"+id_request+"'"+')" tilte="Editar"><i class="fa-solid fa-pencil"></i></button>';
                            }

                            if (id_user == 1){
                                btnDelete = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteData(this, '+"'"+id_request+"'"+')" tilte="Eliminar"><i class="fa-solid fa-trash"></i></button>';
                            }

                            $("#tableRoles").DataTable().row.add([
                                id_row,    
                                capitalLetter(name),
                                capitalLetter(description),
                                htmlStatus,
                                '<div class="text-center"> '+btnPermissions+" "+btnUpdate+" "+btnDelete+'</div>'
                            ]).draw(false);
                        }else{
                            let n_row = $(rowTable).find("td:eq(0)").html();
                            let buttons_html = $(rowTable).find("td:eq(4)").html()
                            $("#tableRoles").DataTable().row(rowTable).data([
                                n_row,    
                                capitalLetter(name),
                                capitalLetter(description),
                                htmlStatus,
                                buttons_html,
                            ]).draw(false);
                        }
                        $('#modalFormRol').modal('hide');
                        msgShow(1, 'Permisos de Usuario', data.msg);
                    }else{
                        msgShow(2, 'Atención', data.msg);
                    }
                },
                error: function(e){
                    // console.log(e);
                },
                beforeSend: function(){
                    // console.log("antes completar");
                },
                complete: function() {

                }
            });
        }
        

    });

    // --- PRINT DATA TABLE ROLES --- //
  	tableRoles = $("#tableRoles").DataTable({
        "aProcessing": true,
        "aServerSide":true,
        "language":{
            "url":"//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        },
        "responsive": true,
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
        "dom": 'lBfrtip',
        "buttons": [
            "copy", "csv", "excel", "pdf", "print", "colvis"
        ],
        "bDestroy":true,
        "order":[[0,"asc"]],
        "iDisplayLength":10,
    });
});


// --- PRINT PERMISSIONS ACCORDING TO ROLE (MODAL) --- //
function permissions(data) {
    if (!data) {
        return false;
    }else{
        let url_ajax = base_url + "permissions/getPermissions/";
                
        $.ajax({
            url: url_ajax,
            dataType: 'html',
            method: 'POST',
            data: {
                data: data,
            },
            success: function(data){
                if (data == "") {
                    msgShow(3, 'Error', "Ha ocurrido un error. Intentelo mas tarde.");
                }else{
                    $("#contentModalPermissions").html(data);

                    // SWITCH OFF/ON
                    $("input[data-bootstrap-switch]").each(function(){
                        $(this).bootstrapSwitch('state', $(this).prop('checked'));
                    });
                    // -----------------------------
                    
                    $('.modalPermisos').modal('show');
                    
                    if($("#form_permissions").length){
                        $("#form_permissions").submit(savePermission);
                    }
                }
            },
            error: function(e){
                // console.log(e);
            },
            beforeSend: function(){
                // console.log("antes completar");
            },
            complete: function(){
                // console.log("completado");
            }
        });
    }
}

// --- ADD PERMISSIONS ACCORDING TO ROLE --- //
function savePermission(e) {
    e.preventDefault();

    var formData = $(this).serializeArray();
    let url_ajax = base_url + "permissions/setPermissions/";
                
    $.ajax({
        url: url_ajax,
        dataType: 'JSON',
        method: 'POST',
        data: formData,
        success: function(data){
            if (data.status) {
                msgShow(1, 'Permisos de Usuario', data.msg);
            }else{
                msgShow(3, 'Error', data.msg);
            }
        },
        error: function(e){
            // console.log(e);
        },
        beforeSend: function(){
            // console.log("antes completar");
        },
        complete: function(){
            // console.log("completado");
        }
    });
    
}

// --- EDIT ROLE --- //
function edit(element, data) {
    rowTable = $(element).closest("tr")[0];
    let ischild = $(rowTable).hasClass("child");
    if(ischild){
        rowTable = $(rowTable).prev()[0];
    }

    $(".modal-header").removeClass("headerRegister").addClass("headerUpdate");
    $(".modal-title").text("Actualizar rol");
    $("#btnSubmitRol").removeClass("btn-primary").addClass("bg-success");
    $(".btnText").text("Actualizar");

    if (!data) {
        return false;
    }else{
        let url_ajax = base_url + "roles/getRol/";
                
        $.ajax({
            url: url_ajax,
            dataType: 'JSON',
            method: 'POST',
            data: {
                data: data,
            },
            success: function(data){
                if (data.status) {
                    $("#idRol").val(data.data_request.id_rol);
                    $("#name_rol").val(data.data_request.name_rol);
                    $("#descrip_rol").val(data.data_request.description_rol);
                    $("#status_rol").val(data.data_request.status);

                    $('#modalFormRol').modal('show');
                }else{
                    msgShow(3, 'Error', data.msg);
                }
            },
            error: function(e){
                // console.log(e);
            },
            beforeSend: function(){
                // console.log("antes completar");
            },
            complete: function(){
                // console.log("completado");
            }
        });
    }
}

// --- DELETE ROLE --- //
function deleteData(element, data) {
    Swal.fire({
        title: 'Eliminar Rol',
        text: "Realmente quiere eliminar el rol!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            if (!data) {
                return false;
            }else{
                let url_ajax = base_url + "roles/delRol/";
                        
                $.ajax({
                    url: url_ajax,
                    dataType: 'JSON',
                    method: 'POST',
                    data: {
                        data: data,
                    },  
                    success: function(data){
                        if (data.status) {
                            let row_closest = $(element).closest("tr");
                            if(row_closest.length){
                                let ischild = $(row_closest).hasClass("child");
                                if(ischild){
                                    let prevtr = row_closest.prev();
                                    if(prevtr.length){
                                        $("#tableRoles").DataTable().row(prevtr[0]).remove().draw(false);
                                    }
                                }
                                else{
                                    $("#tableRoles").DataTable().row(row_closest[0]).remove().draw(false);
                                }
                            }

                            // Reset the id column
                            resetIdTable($("#tableRoles"));
                            
                            msgShow(1, 'Eliminado', data.msg);
                        }else{
                            msgShow(3, 'Error', data.msg);
                        }
                    },
                    error: function(e){
                        // console.log(e);
                    },
                    beforeSend: function(){
                        // console.log("antes completar");
                    },
                    complete: function(){
                        // console.log("completado");
                    }
                });
            }
        }
    });
}