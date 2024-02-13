
'use strict';

var tableUsers;
var rowTable;

$(document).ready(function () {

    // --- PRINT DATA TABLE USERS --- //
    tableUsers = $("#tableUsers").DataTable({
        "aProcessing": true,
        "aServerSide":true,
        "autoWidth": false,
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

            loading.css("display","flex");
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
                        }else{
                            let n_row = $(rowTable).find("td:eq(0)").html();
                            let buttons_html = $(rowTable).find("td:eq(7)").html()
                            $("#tableUsers").DataTable().row(rowTable).data([
                                n_row,    
                                capitalLetter(name),
                                capitalLetter(surname),
                                email,
                                phone,
                                rol_text,
                                htmlStatus,
                                buttons_html,
                            ]).draw(false);
                        }

                        $('#modalFormUser').modal('hide');
                        msgShow(1, 'Usuario', data.msg);
                    }else{
                        msgShow(2, 'Atención', data.msg);
                    }
                    loading.css("display","none");
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

    if ($(".editUser").length) {
        $(".editUser").click(function () {
            validFocus();
            let userEdit = $(".editUser").attr('id');
            $.ajax({
                url: base_url + "index/getDataUser/",
                dataType: 'JSON',
                method: 'POST',
                data: {
                    id: userEdit
                },
                beforeSend: function() {

                },
                success: function(data){
                    if (data.status) {
                        $("#dniUser").val(data.request.dni);
                        $("#nameUser").val(data.request.name_user);
                        $("#surnameUser").val(data.request.surname_user);
                        $("#phoneUser").val(data.request.phone);
                        $('#modalEditUser').modal('show');
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
        })

        $('#formEditUser').submit(function (e) {
            e.preventDefault();
            let dniUser = $("#dniUser").val();
            let nameUser = $("#nameUser").val();
            let surnameUser = $("#surnameUser").val();
            let phoneUser = $("#phoneUser").val();

            if (dniUser == "" || nameUser == "" || surnameUser == "" || phoneUser == "") {
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

                $.ajax({
                    url: base_url + "index/updateUser/",
                    dataType: 'JSON',
                    method: 'POST',
                    data: {
                        id: $(".editUser").attr('id'),
                        dni: dniUser,
                        name: nameUser,
                        surname: surnameUser,
                        phone: phoneUser
                    },
                    beforeSend: function() {
    
                    },
                    success: function(data){
                        if (data.status) {
                            $('.name_client').html(nameUser);
                            $('.surname_client').html(surnameUser);
                            $('.dni_client').html(dniUser);
                            $('.phone_client').html(phoneUser);

                            $('#modalEditUser').modal('hide')
                            msgShow(1, 'Usuario', data.msg);
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
            }

        })
    }
    

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

// --- VIEW USER --- //
function watch(data){
    $(".modal-header").removeClass("headerUpdate").addClass("headerRegister");
    $(".modal-title").text("Datos del usuario");
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
                let obj_request =  data.data_request; 
                if (data.status) {
                    let status_user = obj_request.status == 1 ? '<span class="bg-success p-1 rounded"><i class="fas fa-user"></i> Activo</span>' : '<span class="bg-danger p-1 rounded"><i class="fas fa-user-slash"></i> Inactivo</span>';
                    
                    $("#celDni").text(obj_request.dni);
                    $("#celName").text(obj_request.name_user);
                    $("#celSurname").text(obj_request.surname_user);
                    $("#celPhone").text(obj_request.phone);
                    $("#celEmail").text(obj_request.email);
                    $("#celName_rol").text(obj_request.name_rol);
                    $("#celStatus").html(status_user);
                    $("#celDate_create").text(obj_request.date_create);

                    $('#modalViewUser').modal('show');
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
        title: 'Eliminar Usuario',
        text: "Realmente quiere eliminar el usuario!",
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
                loading.css("display","flex");
                let url_ajax = base_url + "users/delUser/";
                        
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
                                        $("#tableUsers").DataTable().row(prevtr[0]).remove().draw(false);
                                    }
                                }
                                else{
                                    $("#tableUsers").DataTable().row(row_closest[0]).remove().draw(false);
                                }
                            }

                            // Reset the id column
                            resetIdTable($("#tableUsers"));
                            
                            msgShow(1, 'Eliminado', data.msg);
                        }else{
                            msgShow(3, 'Error', data.msg);
                        }
                        loading.css("display","none");
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