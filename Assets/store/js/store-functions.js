
if(localStorage.getItem("shoppingCartData") == null && window.location.pathname.split("/").pop() == "comprar"){
    window.location.href = base_url + "carrito";
}

/*****************************
 * Alert Login-Register(Store)
 *****************************/
function msgAlert(container, msg){
    let htmlAlert = $(container).html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">${msg}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`).hide().fadeIn();
}

/*****************************
 * Number Format
 *****************************/
function numberFormat(number, decimals = 2, decPoint = ',', thousandsSep = '.') {
    return number.toFixed(decimals).replace('.', decPoint).replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSep);
}

$(document).ready(function () {
    /*****************************
     * Show Password
     *****************************/
    $('.show-password').each(function () {
        $(this).on('click', function () {
            var input = $(this).parent().prev();
            if ($(this).hasClass('fa-eye-slash')) {
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');
                input.prop('type', 'text');
            } else {
                $(this).addClass('fa-eye-slash').removeClass('fa-eye');
                input.prop('type', 'password');
            }
        })
    })

    /************************************************
     * Login User - Store
     ***********************************************/
    let formLoginStore = $('#form-login_store');
    if(formLoginStore.length){
        formLoginStore.submit(function(e){
            e.preventDefault();

            let email = $("#email_login").val();
            let password = $("#password_login").val();
            if(email == "" && password == ""){
                msgAlert('.alert-login', 'Ingrese su correo y contraseña.');
                return false;
            }
            else if(email == ""){
               msgAlert('.alert-login', 'Ingrese su correo.');
                return false;
            }else if(password == ""){
                msgAlert('.alert-login', 'Ingrese su contraseña.');
                return false;
            }else{
                $.ajax({
                    url: base_url + "login/ajaxLogin/",
                    dataType: 'JSON',
                    method: 'POST',
                    data: {
                        email: email,
                        password: password
                    },
                    beforeSend: function() {
                        $('.content-loading').css("display","flex");
                    },
                    success: function(data){
                        if (data.status) {
                            // localStorage.setItem("client", JSON.stringify(data.user));
                            window.location.reload(false);
                        }else{
                            msgAlert('.alert-login', data.msg);
                            $("#password").val("");
                        }
                    },
                    error: function(xhr, status, error) {
                    },
                    complete: function() {
                        $('.content-loading').css("display","none");
                    }
                });   
			}

    	});
    }

    /************************************************
     * Modal at login - Icon User
     ***********************************************/
    $('body #popover_mycount').popover({
        html: true,
        content: `
                <ul class="content-dialog_mycount text-center font-weight-bold h6">
                    <li class="mb-2 mt-1"><i class="fa fa-user-o pr-2 pl-2"></i><a href="https://www.google.com/">MI CUENTA</a></li>
                    <li><i class="icon-lock-open pr-2 pl-2" aria-hidden="true"></i><a href="" id="close_session">CERRAR SESIÓN</a></li>
                </ul>`,
        trigger: 'focus',
        placement: 'bottom',
    });

    /************************************************
     * Close Session - Store
     ***********************************************/
    $('body').on('click', '#close_session', function() {
        $.ajax({
            url: base_url + "index/logout/",
            beforeSend: function() {
                
            },
            success: function(data){
                // localStorage.removeItem("client");
                window.location.reload(false);
            },
            error: function(xhr, status, error) {
            },
            complete: function() {
                
            }
        });  
    });

    function testExpression(value, regex) {
        if (regex.test(value)) {
            return true;
        } else {
            return false;
        }
    }

    function validateExpresion() {
        $('.valid').each(function () {
            $(this).on('keyup', function () {
                let inputValue = $(this).val();
                let expresion = false;

                switch (true) {
                    case $(this).hasClass('valid_text'):
                        expresion = testExpression(inputValue, /^([a-zA-ZÑñÁáÉéÍíÓóÚú\s])*$/);
                        break;
                    case $(this).hasClass('valid_phone'):
                        expresion = testExpression(inputValue, /^([0-9]{7,10})$/);
                        break;
                    case $(this).hasClass('valid_number'):
                        expresion = testExpression(inputValue, /^\d+$/);
                        break;
                    case $(this).hasClass('valid_price'):
                        expresion = testExpression(inputValue, /^\d{1,}[.,]\d{2}$/);
                        break;
                    case $(this).hasClass('valid_email'):
                        expresion = testExpression(inputValue, /^(([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9])+\.)+([a-zA-Z0-9]{2,4}))*$/);
                        break;
                    case $(this).hasClass('valid_password'):
                        expresion = testExpression(inputValue, /^(?=.*\d)(?=.*[a-z]).{8,}$/);
                        break;
                    default:
                        return false;
                        break;
                }

                if (inputValue != "") {
                    if (!expresion) {
                        $(this).parent().addClass('is-invalid');
                    } else {
                        $(this).parent().removeClass('is-invalid');
                        $(this).parent().addClass('is-valid');
                    }
                } else {
                    $(this).parent().removeClass('is-invalid');
                    $(this).parent().removeClass('is-valid');
                }
            });
        });
    }

    validateExpresion();
});
