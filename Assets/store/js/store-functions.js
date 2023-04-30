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

	/*****************************
     * Update Product Price (Shopping Cart - Page)
     *****************************/
    function updateProductPrice(id, amount) {
        $.ajax({
            url: base_url + "carrito/updateProductPrice/",
            dataType: 'JSON',
            method: 'POST',
            data: {
                id_product: id,
                amount_product: amount,
            },
            beforeSend: function() {
                
            },
            success: function(data){
                if(data.status){
                    let row_product = $(`#${id}`);
                    row_product.find('td').eq(5).text(data.total_product);
                    $('.subtotal-cart').html(data.subtotal);
                    $('.total-cart').html(data.total);
                }else{
                    Swal.fire({icon: 'error', html: `<span class="font-weight-bold">${data.error}</span>`, confirmButtonColor: '#4431DE'});
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({icon: 'error', html: `<span class="font-weight-bold">Ha ocurrido un error. Inténtelo más tarde.</span>`, confirmButtonColor: '#4431DE'});
            },
            complete: function() {
                
            }
        }); 
    }

    /************************************************
    * QUANTITY OF PRODUCT TO BUY (input-number)
    ***********************************************/

    $('.product-variable-quantity').each(function () {
        var stock_quantity = parseInt($(this).find('input[type="number"]').attr('max'));

        $(this).on('click input', '.btn-minus, .btn-plus, input[type="number"]', function () {
            let input = $(this).siblings('input[type="number"]');
            let value = parseInt(input.val());

            if ($(this).hasClass('btn-minus')) {
                input.val(Math.max(value - 1, 1));
                
                let id = $(this).attr("idpr");
                let amount = input.val();
                if(id != null){
                    updateProductPrice(id, amount);    
                }
            } else if ($(this).hasClass('btn-plus')) {
                input.val(Math.min(value + 1, stock_quantity));

                let id = $(this).attr("idpr");
                let amount = input.val();
                if(id != null){
                    updateProductPrice(id, amount);
                }
            } else if ($(this).is('input[type="number"]')) {
                input.val(Math.min(Math.max(value, 1), stock_quantity));
            }
        });

        $(this).find('input[type="number"]').on('blur', function () {
            let value = parseInt($(this).val());
            if (isNaN(value) || value === '' || value === null) {
                $(this).val(1);
            } else if (value > stock_quantity) {
                $(this).val(stock_quantity);
            }

            let id = $(this).attr("idpr");
            let amount = $(this).val();
            if(id != null){
                updateProductPrice(id, amount);    
            }
        });
    });

    /************************************************
     * Add To Cart Modal
     ***********************************************/
    $(document).on('click', '.addToCart', function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        let amount = 1;
        
        if ($('#amount-product').length) {
            amount = parseInt($('#amount-product').val());
        }

        $.ajax({
            url: base_url + "index/addCartProduct/",
            dataType: 'JSON',
            method: 'POST',
            data: {
                id_product: id,
                amount_product: amount,
            },
            beforeSend: function() {
                
            },
            success: function(data){
                if (data.status) {
                    let product_added = data.product_added;

                    $(".addd-product-container").html(`
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="modal-add-cart-product-img">
                                            <img class="img-fluid"
                                                src="${product_added.image}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <p class="modal-add-cart-info"><i class="fa fa-check-square"></i>Añadido al carrito con éxito!</p>
                                        <p class="cart-name-product font-weight-bold c-p-deep-blue">${product_added.name.toUpperCase()}</p>
                                        <p> <strong>Precio: </strong> <span class="cart-price-product">$${numberFormat(parseFloat(product_added.price))}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 modal-border">
                                <ul class="modal-add-cart-product-shipping-info">
                                    <li> <strong><i class="icon-shopping-cart"></i> Tiene ${data.amountCart} productos en su carrito.</strong></li>
                                    <li>
                                        <div class="modal-add-cart-product-cart-buttons font-weight-bold">
                                            <a href="${base_url}carrito">Ver carrito</a>
                                            <a href="${base_url}carrito/comprar">Procesar pago</a>
                                        </div>
                                    </li>
                                    <li class="modal-continue-button"><a href="#" data-bs-dismiss="modal">CONTINUAR COMPRANDO</a></li>
                                </ul>
                            </div>
                        </div>
                        `);

                    $('.amount-product-cart').text(data.amountCart);
                    $("#container-shopping-cart").html(data.html_shoppingCart);
                }else{
                    $(".addd-product-container").html(`<h1 class="text-center text-danger">${data.error}</h1>`);
                }
            },
            error: function(xhr, status, error) {
            },
            complete: function() {
                
            }
        });     
    });

    /************************************************
     * Login From Store
     ***********************************************/
    function validarFormulario(){
        let validar = true;
        return validar;
    }
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

    $('body').on('click', '#close_session', function() {
        $.ajax({
            url: base_url + "index/logout/",
            beforeSend: function() {
                
            },
            success: function(data){
                window.location.reload(false);
            },
            error: function(xhr, status, error) {
            },
            complete: function() {
                
            }
        });  
    });

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


});
/*****************************
* Delete Item Shopping Cart
*****************************/
function delItemCart(element) {
    let option = $(element).attr("option");
    let id = $(element).attr("idpr");
    
    if (option == 1 || option == 2) {
        $.ajax({
            url: base_url + "index/delItemCart/",
            dataType: 'JSON',
            method: 'POST',
            data: {
                id_product: id,
                option: option,
            },
            beforeSend: function() {
                
            },
            success: function(data){
                if (data.status) {
                    if(option == 1){
                        $('.amount-product-cart').text(data.amountCart);
                        $("#container-shopping-cart").html(data.html_shoppingCart);  
                    }else{
                        $(element).parent().parent().remove();
                        $('.subtotal-cart').text('$'+data.subtotal);
                        $('.total-cart').text('$'+data.total);
                        if($('#table-cart tr').length == 1){
                            window.location.href = base_url;
                        }
                    }
                }else{
                    Swal.fire({icon: 'error', html: `<span class="font-weight-bold">${data.error}</span>`, confirmButtonColor: '#4431DE'});
                }
            },
            error: function(xhr, status, error) {
                console.log(error)
            },
            complete: function() {
                
            }
        });   
    }
}
