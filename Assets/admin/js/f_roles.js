
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
            $("btnSubmitRol").removeClass("bg-success").addClass("btn-primary");
            $(".btnText").text("Guardar");
            formNewRol.trigger("reset");

            $('#modalFormRol').modal('show');

        });       
    }


    // --- ADD NEW ROL --- //
    formNewRol.submit((e) => {
        e.preventDefault();


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

    // let btnUpdate = $(".update");
    // btnUpdate.each((index, element) => {
    //     let id_rol = $(element).attr('data_id');

    //     $(element).click(() => {

    //     });
    // });
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