
'use strict';

var tableUsers;
var rowTable;

$(document).ready(function () {

    // --- PRINT DATA TABLE USERS --- //
    tableUsers = $("#tableUsers").DataTable({
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

	var formNewUser = $("#formNewUser");

    if ($("#list_rol").length) {
        $("#list_rol").select2();
    }

	if ($("#btnNewUser").length) {
        $("#btnNewUser").click(function () {
            
            formNewUser.find("#id_user").val("");            
            $(".modal-header").removeClass("headerUpdate").addClass("headerRegister");
            $(".modal-title").text("Nuevo Usuario");
            $("#btnSubmitUser").removeClass("bg-success").addClass("btn-primary");
            $(".btnText").text("Guardar");
            formNewUser.trigger("reset");
            $("#list_rol").select2();
            validFocus();

            $('#modalFormUser').modal('show');
            rowTable = "";
        
        });       
    }

    // --- ADD NEW USER --- //
    formNewUser.submit((e) => {
        e.preventDefault();
        let id = $("#id_user").val();
        let dni = $("#dni_user").val();
        let name = $("#name_user").val();
        let surname = $("#surname_user").val();
        let phone = $("#phone_user").val();
        let email = $("#email_user").val();
        let list_rol = $("#list_rol").val();
        let status = $("#status_user").val();

        if (dni == "" || name == "" || surname == "" || phone == "" || email == "" || list_rol == "" || status == "") {
            msgShow(2, 'Atención', "Rellene todos los campos.");
            return false;
        }else{
            let url_ajax = base_url + "users/setUser/";
            $.ajax({
                url: url_ajax,
                dataType: 'JSON',
                method: 'POST',
                data: {
                    id_user : id,
                    dni_user : dni, 
                    name_user: name,
                    surname_user: surname,
                    phone_user : phone,
                    email_user :  email,
                    list_rol : list_rol,
                    status: status,
                },
                success: function(data){
                    console.log(data);
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

});