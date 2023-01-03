
'use strict';

$(document).ready(function(){

    var tableRoles;
    var rowTable = "";

    var formNewRol = $("#formNewRol");

    if ($("#btnNewRol").length) {
        $("#btnNewRol").click(function () {

            formNewRol.find("#idRol").val("");
            $(".modal-header").removeClass("headerUpdate").addClass("headerRegister");
            $(".modal-title").text("Nuevo Rol");
            $("btnSubmitRol").removeClass("bg-success").addClass("btn-primary");
            $(".btnText").text("Guardar");
            formNewRol.trigger("reset");

            $('#modalFormRol').modal('show');

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
                                btnUpdate = '<button type="button" class="btn btn-primary btn-sm" onclick="update('+"'"+id_request+"'"+')" tilte="Editar"><i class="fa-solid fa-pencil"></i></button>';
                            }

                            if (id_user == 1){
                                btnDelete = '<button type="button" class="btn btn-danger btn-sm" onclick="delete('+"'"+id_request+"'"+')" tilte="Eliminar"><i class="fa-solid fa-trash"></i></button>';
                            }

                            $("#tableRoles").DataTable().row.add([
                                id_row,    
                                capitalLetter(name),
                                capitalLetter(description),
                                htmlStatus,
                                '<div class="text-center"> '+btnPermissions+" "+btnUpdate+" "+btnDelete+'</div>'
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

// ---  --- //
function update(data) {
    // if (!data) {
    //     return false;
    // }else{
    //     let url_ajax = base_url + "roles/getElementsByTagName('')Rol/";
                
    //     // $.ajax({
    //     //     url: url_ajax,
    //     //     dataType: 'html',
    //     //     method: 'POST',
    //     //     data: {
    //     //         data: data,
    //     //     },
    //     //     success: function(data){

    //     //         $("#contentModalPermissions").html(data);

    //     //         // SWITCH OFF/ON
    //     //         $("input[data-bootstrap-switch]").each(function(){
    //     //             $(this).bootstrapSwitch('state', $(this).prop('checked'));
    //     //         });
    //     //         // -----------------------------
                
    //     //         $('.modalPermisos').modal('show');
                
    //     //         if($("#form_permissions").length){
    //     //             $("#form_permissions").submit(savePermission);
    //     //         }
    //     //     },
    //     //     error: function(e){
    //     //         // console.log(e);
    //     //     },
    //     //     beforeSend: function(){
    //     //         // console.log("antes completar");
    //     //     },
    //     //     complete: function(){
    //     //         // console.log("completado");
    //     //     }
    //     // });
    // }
}