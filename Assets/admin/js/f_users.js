
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
        let password = $("#pass_user").val();

        let rol_text =  $("#list_rol").find("option:selected").text();

        if (dni == "" || name == "" || surname == "" || phone == "" || email == "" || list_rol == "" || status == "") {
            msgShow(2, 'Atención', "Rellene todos los campos.");
            return false;
        }else{

            let elementsValid = $(".valid");
            elementsValid.each((index, element) => {
                if($(element).hasClass('is-invalid')){
                    Swal.fire("Atención", "Por favor asegúrese de no tener campos en rojo.", "error");
                    return false;
                };
            });

            let url_ajax = base_url + "users/setUser/";
            $.ajax({
                url: url_ajax,
                dataType: 'JSON',
                method: 'POST',
                data: {
                    id : id,
                    dni : dni, 
                    name: name,
                    surname: surname,
                    phone : phone,
                    email :  email,
                    list_rol : list_rol,
                    status: status,
                    password : password,
                },
                success: function(data){
                    if(data.status){
                        let htmlStatus = status == 1 ? '<div class="text-center"><span class="bg-success p-1 rounded"><i class="fa-solid fa-user"></i> Activo</span></div>' : '<div class="text-center"><span class="bg-danger p-1 rounded"><i class="fa-solid fa-user-slash"></i> Inactivo</span></div>';
                        
                        if(rowTable == ""){
                            let idr_decrypt = data.data_request.idr_decrypt;
                            let idr_encrypt = data.data_request.idr_encrypt;
                            let module_data = data.data_request.module;  
                            let id_user = data.data_request.id_user;

                            let id_row = $("#tableUsers").DataTable().rows().count() + 1;
                            let btnWatch = "";
                            let btnUpdate = "";
                            let btnDelete = "";

                            if (module_data.ver == 1) {
                                btnWatch = '<button type="button" class="btn btn-secondary btn-sm" onclick="watch('+"'"+idr_encrypt+"'"+')" tilte="Ver"><i class="fa-solid fa-eye"></i></button>'
                            }

                            if (idr_decrypt != id_user && module_data.actualizar == 1) {
                                btnUpdate = '<button type="button" class="btn btn-primary btn-sm" onclick="edit(this, '+"'"+idr_encrypt+"'"+')" tilte="Editar"><i class="fa-solid fa-pencil"></i></button>';
                            }

                            if (idr_decrypt != id_user && module_data.eliminar == 1){
                                btnDelete = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteData(this, '+"'"+idr_encrypt+"'"+')" tilte="Eliminar"><i class="fa-solid fa-trash"></i></button>';
                            }

                            $("#tableUsers").DataTable().row.add([
                                id_row,    
                                capitalLetter(name),
                                capitalLetter(surname),
                                email,
                                phone,
                                rol_text,
                                htmlStatus,
                                '<div class="text-center"> '+btnWatch+" "+btnUpdate+" "+btnDelete+'</div>'
                            ]).draw(false);
                        }

                        $('#modalFormUser').modal('hide');
                        msgShow(1, 'Usuario', data.msg);
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

});

// --- EDIT USER --- //
function edit(element, data) {
    rowTable = $(element).closest("tr")[0];
    let ischild = $(rowTable).hasClass("child");
    if(ischild){
        rowTable = $(rowTable).prev()[0];
    }

    $(".modal-header").removeClass("headerRegister").addClass("headerUpdate");
    $(".modal-title").text("Actualizar Usuario");
    $("#btnSubmitUser").removeClass("btn-primary").addClass("bg-success");
    $(".btnText").text("Actualizar");
    $("#pass_user").val("");
    
    validFocus();

    if (!data) {
        return false;
    }else{
        let url_ajax = base_url + "users/getUser/";
                
        $.ajax({
            url: url_ajax,
            dataType: 'JSON',
            method: 'POST',
            data: {
                data: data,
            },
            success: function(data){
                if (data.status) {
                    $("#id_user").val(data.data_request.id_user);
                    $("#dni_user").val(data.data_request.dni);
                    $("#name_user").val(data.data_request.name_user);
                    $("#surname_user").val(data.data_request.surname_user);
                    $("#phone_user").val(data.data_request.phone);
                    $("#email_user").val(data.data_request.email);
                    $("#list_rol").val(data.data_request.rolid);
                    $("#status_user").val(data.data_request.status);

                    $("#list_rol").select2();   
                    $('#modalFormUser').modal('show');
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