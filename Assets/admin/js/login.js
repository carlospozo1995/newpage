// LOGIN FLIPPED - RESET PASSWORD
'use strict';

$(document).ready(function(){
    $('.login-content [data-toggle="flip"]').click(function() {
        $('.login').toggleClass('flipped');
        return false;
    });

    // ---- LOGIN USER ---- //

    let formLogin = $("#formLogin");
    if(formLogin){
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
                            msgShow(3, 'Error', data.msg);
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

    let formReset = $("#formResetPass");
    if (formReset) {
        formReset.submit(function (e) {

            e.preventDefault();

            let emailReset = $("#resetEmail").val();

            if(emptyValidate(emailReset)){
                msgShow(2, 'Error', 'Ingrese su correo para seguir el proceso.');
                return false;
            }else{
                // loading.style.display = 'flex';
                let url_ajax = base_url + "login/ajaxReset/";

                $.ajax({
                    url: url_ajax,
                    dataType: 'JSON',
                    method: 'POST',
                    data: {
                        emailReset: emailReset,
                    },
                    success: function(data){   
                        console.log(data);
                        // if (data.status) {
                        //     window.location = base_url + "dashboard";
                        // }else{
                        //     msgShow(3, 'Error', data.msg);
                        //     $("#password").val("");
                        // }
                        // loading.style.display = 'none';

                        // return false;
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
    

});