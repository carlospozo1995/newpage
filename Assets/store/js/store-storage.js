
$(window).ready(function () {
    if (localStorage.getItem("shoppingCartData") && Array.isArray(JSON.parse(localStorage.getItem("shoppingCartData")))) {
        let cartData_view = JSON.parse(localStorage.getItem("shoppingCartData"));
        let cartData_productIds = $.map(cartData_view, function(product) {
            return product.id;
        });

        $.ajax({
            url: base_url + "carrito/getProducts/",
            dataType: 'JSON',
            method: 'POST',
            data: {
                productIds: cartData_productIds,
            },
            beforeSend: function() {
            
            },
            success: function(data){
                for (let i = cartData_view.length - 1; i >= 0; i--) {
                    const product_cartData = cartData_view[i];
                    const existsData = data.some(product => product.id === product_cartData.id);

                    if (!existsData) {
                        cartData_view.splice(i, 1);
                    }else {
                        const productData = data.find(product => product.id === product_cartData.id);
                        product_cartData['amount_product'] = product_cartData['amount_product'] > productData.stock ? productData.stock : product_cartData['amount_product'] == 0 && productData.stock > 0 ? 1 : product_cartData['amount_product'];
                        Object.assign(product_cartData, productData);
                    }
                }
                localStorage.setItem("shoppingCartData", JSON.stringify(cartData_view));
                upNumberCart();
                modalShoppingCart();
                viewShoppingCart();

                $('.product-variable-quantity').each(function () {
                    var product_quantity = parseInt($(this).find('input[type="number"]').attr('max'));

                    $(this).on('click input', '.btn-minus, .btn-plus, input[type="number"]', function () {
                        let input = $(this).siblings('input[type="number"]');
                        let value = parseInt(input.val());

                        if ($(this).hasClass('btn-minus')) {
                            input.val(Math.max(value - 1, 1));
                            
                            let id = $(this).attr("idpr");
                            let amount = parseInt(input.val());
                            
                            if(id != null){
                                updateProductPrice(id, amount);    
                            }
                        } else if ($(this).hasClass('btn-plus')) {
                            input.val(Math.min(value + 1, product_quantity));

                            let id = $(this).attr("idpr");
                            let amount = parseInt(input.val());
                            
                            if(id != null){
                                updateProductPrice(id, amount);
                            }
                        } else if ($(this).is('input[type="number"]')) {
                            input.val(Math.min(Math.max(value, 1), product_quantity));
                        }
                    });

                    $(this).find('input[type="number"]').on('blur', function () {
                        let value = parseInt($(this).val());
                        if (isNaN(value) || value === '' || value === null || value == 0) {
                            $(this).val(1);
                        } else if (value > product_quantity) {
                            $(this).val(product_quantity);
                        }

                        let id = $(this).attr("idpr");
                        let amount = parseInt($(this).val());
                        
                        if(id != null){
                            updateProductPrice(id, amount);   
                        }
                    });
                });
            },
            error: function(xhr, status, error) {
                localStorage.removeItem("shoppingCartData");
                $("#modal-shopping-cart-container").html('<h1 class="text-center c-p-deep-blue">Vacio</h1>');
                $('#view-shopping-cart-container').html(`
                    <div class="empty-cart-section section-fluid">
                        <div class="emptycart-wrapper">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-md-10 offset-md-1 col-xl-6 offset-xl-3">
                                        <div class="emptycart-content text-center">
                                            <div class="image">
                                                <img class="img-fluid" src="${media_store}images/empty-cart.png" alt="">
                                            </div>
                                            <h4 class="title">Su carrito esta vacio</h4>
                                            <h6 class="sub-title">Lo sentimos... ¡No se encontró ningún artículo dentro de su carrito!</h6>
                                            <a href="${base_url}" class="btn btn-lg btn-coral">Continuar comprando</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
            },
            complete: function(data) {

            }
        });
    }else{
        localStorage.removeItem("shoppingCartData");
        $("#modal-shopping-cart-container").html('<h1 class="text-center c-p-deep-blue">Vacio</h1>');
        $('#view-shopping-cart-container').html(`
            <div class="empty-cart-section section-fluid">
                <div class="emptycart-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-10 offset-md-1 col-xl-6 offset-xl-3">
                                <div class="emptycart-content text-center">
                                    <div class="image">
                                        <img class="img-fluid" src="${media_store}images/empty-cart.png" alt="">
                                    </div>
                                    <h4 class="title">Su carrito esta vacio</h4>
                                    <h6 class="sub-title">Lo sentimos... ¡No se encontró ningún artículo dentro de su carrito!</h6>
                                    <a href="${base_url}" class="btn btn-lg btn-coral">Continuar comprando</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `);
    }

    /************************************************
    * QUANTITY OF PRODUCT TO BUY (input-number) (Al parecer esto hay que eliminarlo)
    ***********************************************/
    $('#product-variable-quantity').each(function () {
        var stock_quantity = parseInt($(this).find('input[type="number"]').attr('max'));

        $(this).on('click input', '.btn-minus, .btn-plus, input[type="number"]', function () {
            let input = $(this).siblings('input[type="number"]');
            let value = parseInt(input.val());

            if ($(this).hasClass('btn-minus')) {
                input.val(Math.max(value - 1, 1));
            } else if ($(this).hasClass('btn-plus')) {
                input.val(Math.min(value + 1, stock_quantity));
            } else if ($(this).is('input[type="number"]')) {
                input.val(Math.min(Math.max(value, 1), stock_quantity));
            }
        });

        $(this).find('input[type="number"]').on('blur', function () {
            let value = parseInt($(this).val());
            if (isNaN(value) || value === '' || value === null || value == 0) {
                $(this).val(1);
            } else if (value > stock_quantity) {
                $(this).val(stock_quantity);
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
        
        if ($('.amount-product').length) {
            amount = parseInt($('.amount-product').val());
        }

        $.ajax({
            url: base_url + "carrito/addCartProduct/",
            dataType: 'JSON',
            method: 'POST',
            data: {
                id_product: id,
            },
            beforeSend: function() {
                
            },
            success: function(data){
                if (data.status) {
                    let cartData;
                    let product_added = data.product_added;

                    localStorage.getItem("shoppingCartData") ? cartData = JSON.parse(localStorage.getItem("shoppingCartData")) : cartData = [] ;

                    if(cartData.some(product=> product.id === id)){
                        const indexProduct_added = cartData.findIndex(product=> product.id === id);

                        if ((cartData[indexProduct_added].amount_product + amount) < cartData[indexProduct_added].stock){
                            cartData[indexProduct_added].amount_product += amount;
                        }else{
                            cartData[indexProduct_added].amount_product = cartData[indexProduct_added].stock;
                        }
                    }else{
                        product_added.amount_product = amount;
                        cartData.push(product_added);
                    }

                    localStorage.setItem("shoppingCartData", JSON.stringify(cartData));
                    const amountCart = cartData.reduce((acc, product) => acc + product.amount_product, 0);

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
                                        <p> <strong>Precio: </strong> <span class="cart-price-product">$${numberFormat(product_added.price)}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 modal-border">
                                <ul class="modal-add-cart-product-shipping-info">
                                    <li> <strong><i class="icon-shopping-cart"></i> Tiene ${amountCart} productos en su carrito.</strong></li>
                                    <li>
                                        <div class="modal-add-cart-product-cart-buttons font-weight-bold">
                                            <a href="${base_url}carrito">Ver carrito</a>
                                            <a href="${base_url}carrito/procesarCompra">Procesar pago</a>
                                        </div>
                                    </li>
                                    <li class="modal-continue-button"><a href="#" data-bs-dismiss="modal">CONTINUAR COMPRANDO</a></li>
                                </ul>
                            </div>
                        </div>
                    `);

                    upNumberCart();
                    modalShoppingCart();
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

    function upNumberCart(){
        let numberCart = JSON.parse(localStorage.getItem("shoppingCartData")).reduce((acc, product) => acc + product.amount_product, 0);
        $(".amount-product-cart").text(numberCart);
    }

    function modalShoppingCart() {
        const ul = $("<ul class='offcanvas-cart'></ul>");
        let total = 0;
        JSON.parse(localStorage.getItem("shoppingCartData")).forEach(item => {
            total += item.amount_product * item.price;
            let li =  `<li class="offcanvas-cart-item-single">
                            <div class="offcanvas-cart-item-block">
                                <a href="${base_url}producto/${item.url}" class="offcanvas-cart-item-image-link">
                                    <img src="${item.image}" alt=""
                                        class="offcanvas-cart-image">
                                </a>
                                <div class="offcanvas-cart-item-content">
                                    <a href="${base_url}producto/${item.url}" class="offcanvas-cart-item-link">${item.name}</a>
                                    <div class="offcanvas-cart-item-details">`
                                    if (item.stock != 0) {
                                        li += `<span class="offcanvas-cart-item-details-quantity">${item.amount_product} x </span>
                                        <span class="offcanvas-cart-item-details-price">$${numberFormat(item.price)}</span>`;
                                    }else{
                                        li += `<span class="c-coral font-weight-bold fs-12">Lo sentimos no hay disponible.</span>`;
                                    }
                            li +=   `</div>
                                </div>
                            </div>
                            <div class="offcanvas-cart-item-delete text-right" id="cart-item-delete" idpr="${item.id}" option="1">
                                <span class="offcanvas-cart-item-delete"><i class="fa fa-trash-o"></i></span>
                            </div>
                        </li>`;

            ul.append(li);
        });
        const modalFooter = `
            <div class="offcanvas-cart-total-price">
                <span class="offcanvas-cart-total-price-text">Total:</span>
                <span class="offcanvas-cart-total-price-value">$${numberFormat(total)}</span>
            </div>
            <ul class="offcanvas-cart-action-button">
                <li><a href="${base_url}carrito" class="btn btn-block btn-deep-blue">Ver Carrito</a></li>
                <li><a href="${base_url}carrito/procesarCompra" class=" btn btn-block btn-deep-blue mt-5">Procesar Pago</a></li>
            </ul>
        `;

        const modalContent = ul.prop('outerHTML') + modalFooter;
        $("#modal-shopping-cart-container").html(modalContent);
    }

    function viewShoppingCart() {
        let total = 0;
        let subtotal = 0;
        let totalIva = 0;
        let tbodyContent;
        JSON.parse(localStorage.getItem("shoppingCartData")).forEach(item => {
            // if (item.amount_product > 0) {
                let totalProduct = item.amount_product * item.price;
                subtotal += item.amount_product * item.price;
                // totalIva (create IVA function and add them)

                tbodyContent += `
                    <tr id="${item.id}">
                        <td class="product_remove">
                            <span class="cursor-pointer" id="cart-item-delete" idpr="${item.id}" option="2"><i class="fa fa-trash-o"></i></span>
                        </td>
                        <td class="product_thumb">
                            <a href="${base_url}producto/${item.url}"><img src="${item.image}?>" alt=""></a>
                        </td>

                        <td class="product_name">
                            <a href="${base_url}producto/${item.url}">${item.name}</a>
                        </td>

                        <td class="product_price">
                            $${numberFormat(item.price)}
                        </td>`;

            if (item.amount_product != 0) {
                tbodyContent += `
                        <td class="product_quantity">
                            <div class="product-variable-quantity m-auto" style="width: max-content;">
                                <i class="fa fa-minus pl-4 pr-2 btn-minus" idpr="${item.id}"></i>
                                <input class="amount-product" type="number" min="1" max="${item.stock}" value="${item.amount_product}" idpr="${item.id}">
                                <i class="fa fa-plus pr-4 pl-2 btn-plus" idpr="${item.id}"></i>
                            </div>
                        </td>`   
            }else{
                tbodyContent += `
                        <td>
                            <div>
                                <span class="c-coral font-weight-bold fs-12">No hay disponibles</span>
                            </div>
                        </td>`   
            }
                tbodyContent += `
                        <td class="product-total">
                            $${numberFormat(totalProduct)}
                        </td>
                    </tr>
                `;
            // }
        });
        totalIva = subtotal * 0.12;
        // iva function
        total = subtotal + totalIva;

        $('#view-shopping-cart-container').html(`
            <div class="cart-section">
                <div class="cart-table-wrapper" data-aos="fade-up" data-aos-delay="0">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-md-8">
                                <div class="table_desc">
                                    <div class="table_page table-responsive">
                                        <table id="table-cart">
                                            <thead>
                                                <tr>
                                                    <th class="product_remove">Eliminar</th>
                                                    <th class="product_thumb">Imagen</th>
                                                    <th class="product_name">Producto</th>
                                                    <th class="product-price">Precio</th>
                                                    <th class="product_quantity">Cantidad</th>
                                                    <th class="product_total">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="coupon_code right" data-aos="fade-up" data-aos-delay="400">
                                    <h3 class="text-center">Total del carrito</h3>
                                    <div class="coupon_inner">
                                        <div class="cart_subtotal">
                                            <p>Subtotal</p>
                                            <p class="cart_amount subtotal-cart">$${numberFormat(subtotal)}</p>
                                        </div>
                                        <div class="cart_subtotal">
                                            <p>IVA</p>
                                            <p class="cart_amount iva-cart">$${numberFormat(totalIva)}</p>
                                        </div>
                                        <hr>
                                        <div class="cart_subtotal">
                                            <p>Total</p>
                                            <p class="cart_amount total-cart">$${numberFormat(total)}</p>
                                        </div>
                                        <div class="checkout_btn">
                                            <a href="${base_url}carrito/procesarCompra" class="btn btn-coral">Procesar pago</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `);

        $("#table-cart tbody").html(tbodyContent);
    }

    function updateProductPrice(id, amount) {
        if(id != ""){
            let cartData_up = JSON.parse(localStorage.getItem("shoppingCartData"));
            if (cartData_up.findIndex(product=> product.id === id) > -1) {
                let total = 0;
                let subtotal = 0;
                let totalIva = 0;
                let totalProduct = 0;

                for (var i = 0; i < cartData_up.length; i++) {
                    if (cartData_up[i]['id'] === id) {
                        cartData_up[i]['amount_product'] = amount;
                        totalProduct = amount * cartData_up[i]['price'];
                    }
                }
                localStorage.setItem("shoppingCartData", JSON.stringify(cartData_up));
                cartData_up.forEach(item => {
                    subtotal += item.price * item.amount_product;
                    // totalIva (create IVA function and add them
                });
                totalIva = subtotal * 0.12;
                // iva function
                total = subtotal + totalIva;

                let row_product = $(`#${id}`);
                    row_product.find('td').eq(5).text("$" + numberFormat(totalProduct));
                $(".subtotal-cart").text("$" + numberFormat(subtotal));
                $(".iva-cart").text("$" + numberFormat(totalIva));
                $(".total-cart").text("$" + numberFormat(total));
            }else{
                Swal.fire({icon: 'error', html: `<span class="font-weight-bold">Ha ocurrido un error. Inténtelo más tarde.</span>`, confirmButtonColor: '#4431DE'});
            }
        }else{
            Swal.fire({icon: 'error', html: `<span class="font-weight-bold">Ha ocurrido un error. Inténtelo más tarde.</span>`, confirmButtonColor: '#4431DE'});
        }
    }

    /*****************************
     * Delete Item Shopping Cart
     *****************************/
    $("#modal-shopping-cart-container, #view-shopping-cart-container").on('click', '#cart-item-delete', function () {
        let option = parseInt($(this).attr("option"));
        let id = $(this).attr("idpr");
        
        if ((option == 1 || option == 2) && id != "") {
            let cartData_delete = JSON.parse(localStorage.getItem("shoppingCartData"));
            let index = cartData_delete.findIndex(product=> product.id === id)
            if (index > -1) {
                let total = 0;
                cartData_delete.splice(index, 1);
                localStorage.setItem("shoppingCartData", JSON.stringify(cartData_delete));
                upNumberCart();
                
                switch (option){
                    case 1:
                        if(cartData_delete.length == 0){
                            localStorage.removeItem("shoppingCartData");
                            $("#modal-shopping-cart-container").html('<h1 class="text-center c-p-deep-blue">Vacio</h1>');
                        }else{
                            cartData_delete.forEach(item => {
                                total += item.amount_product * item.price;
                            });
                            $('.offcanvas-cart-total-price-value').html(numberFormat(total));
                            $(this).parent().remove();
                        }
                    break;

                    case 2:
                        if(cartData_delete.length == 0){
                            localStorage.removeItem("shoppingCartData");
                            window.location.href = base_url;
                        }else{
                            let subtotal = 0;
                            let totalIva = 0;
                            cartData_delete.forEach(item => {
                                subtotal += item.amount_product * item.price;
                                 // totalIva (create IVA function and add them)
                            });
                            totalIva = subtotal * 0.12;
                            // iva function
                            total = subtotal + totalIva;
                            $(this).parent().parent().remove();

                            $(".subtotal-cart").text("$" + numberFormat(subtotal));
                            $(".iva-cart").text("$" + numberFormat(totalIva));
                            $(".total-cart").text("$" + numberFormat(total));
                        }
                    break;
                }
            }else{
                Swal.fire({icon: 'error', html: `<span class="font-weight-bold">Ha ocurrido un error. Inténtelo más tarde.</span>`, confirmButtonColor: '#4431DE'});
            }
        }else{
            Swal.fire({icon: 'error', html: `<span class="font-weight-bold">Ha ocurrido un error. Inténtelo más tarde.</span>`, confirmButtonColor: '#4431DE'});
        }
    })    

});
