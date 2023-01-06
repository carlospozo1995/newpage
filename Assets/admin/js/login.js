
'use strict';

$(document).ready(function(){

    // ---- LOGIN FLIPPED ---- //
    $('.login-content [data-toggle="flip"]').click(function() {
        $('.login').toggleClass('flipped');
        return false;
    });

    // ---- LOGIN USER ---- //

    let formLogin = $("#formLogin");
    if(formLogin.length){
        formLogin.submit(function(e){
            e.preventDefault();

            let email = $("#email").val();
            let password = $("#password").val();
            if(emptyValidate(email) && emptyValidate(password)){
                msgShow(2, 'Error', 'Ingrese correo y contraseña');
                return false;
            }else if(emptyValidate(email)){

                msgShow(2,'Error', 'Ingrese correo');
                return false;

            }else if(emptyValidate(password)){

                msgShow(2,'Error', 'Ingrese contraseña');
                return false;
                
            }else{
                loading.style.display = 'flex';

                let url_ajax = base_url + "login/ajaxLogin/";
                
                $.ajax({
                    url: url_ajax,
                    dataType: 'JSON',
                    method: 'POST',
                    data: {
                        email: email,
                        password: password
                    },
                    success: function(data){
                        if (data.status) {
                            window.location = base_url + "dashboard";
                        }else{
                            msgShow(2, 'Error', data.msg);
                            $("#password").val("");
                        }
                        loading.style.display = 'none';

                        return false;
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
        });
    }


    // ---- RESET PASSWORD USER ---- //

    let emailSend = $("#formEmailSend");
    if (emailSend.length) {
        emailSend.submit(function (e) {

            e.preventDefault();

            let resetEmail = $("#resetEmail").val();

            if(emptyValidate(resetEmail)){
                msgShow(2, 'Error', 'Ingrese su correo para seguir el proceso.');
                return false;
            }else{
                loading.style.display = 'flex';
                let url_ajax = base_url + "login/ajaxEmailSend/";

                $.ajax({
                    url: url_ajax,
                    dataType: 'JSON',
                    method: 'POST',
                    data: {
                        resetEmail: resetEmail,
                    },
                    success: function(data){
                        if(data.status){
                            Swal.fire({
                                title:'',
                                text:data.msg,
                                icon:'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed){
                                    window.location = base_url + "login";
                                }
                            });
                        }else{
                            msgShow(2, 'Error', data.msg);
                        }
                        loading.style.display = 'none';

                        return false;
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

        });
    }
    

    let resetPass = $('#formResetPass');
    if (resetPass.length) {
        resetPass.submit(function(e) {
            
            e.preventDefault();

            let pass = $('#password').val();
            let confirmPass = $('#passwordConfirm').val();

            if (emptyValidate(pass) || emptyValidate(confirmPass)) {
                msgShow(2, '', 'Rellene los campos requeridos.');
                return false;
            }else{
                if (!testPass(pass)) {
                    msgShow(2, '', 'La contraseña debe contener números y letras con un mínimo de 8 caracteres.');
                    return false;
                }

                if(pass != confirmPass){
                    msgShow(2, '', 'Las contraseñas deben ser iguales.');
                    return false;   
                }

                loading.style.display = 'flex';

                let url_ajax = base_url + "resetPassword/updatePassword/";
                
                $.ajax({
                    url: url_ajax,
                    dataType: 'JSON',
                    method: 'POST',
                    data: {
                        password: pass,
                        confirmPassword: confirmPass,
                    },
                    success: function(data){
                        if(data.status){
                            Swal.fire({
                                title:'',
                                text:data.msg,
                                icon:'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Iniciar Sesión',
                                closeOnConfirm:false,
                            }).then((result) => {
                                if (result.isConfirmed){
                                    window.location = base_url + "login";
                                }else{
                                    window.location = base_url + "login";
                                }
                            });
                        }else{
                             Swal.fire({
                                title:'Error',
                                text:data.msg,
                                icon:'error',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'ok',
                            }).then((result) => {
                                if (result.isConfirmed){
                                    window.location = base_url + "login";
                                }else{
                                    window.location = base_url + "login";
                                }
                            });
                        }
                        
                        loading.style.display = 'none';

                        return false;
                    },
                    error: function(e){
                        console.log(e);
                    },
                    beforeSend: function(){
                        // console.log("antes completar");
                    },
                    complete: function(){
                        // console.log("completado");
                    }
                });
            }

        })
    }

});