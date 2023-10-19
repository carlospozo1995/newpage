$(document).ready(function () {
	
	let cartStorage = JSON.parse(localStorage.getItem('shoppingCartData'));

	let cartStorage_productIds = $.map(cartStorage, function(product) {
        return product.id;
    });

    $.ajax({
        url: base_url + "carrito/getProducts/",
        dataType: 'JSON',
        method: 'POST',
        data: {
            productIds: cartStorage_productIds,
        },
        beforeSend: function() {

        },
        success: function(data){
            for (let i = cartStorage.length - 1; i >= 0; i--) {
                const product_cartData = cartStorage[i];
                const existsData = data.some(product => product.id === product_cartData.id);

                if (!existsData || data.find(product => product.id === product_cartData.id).stock === 0) {
                    cartStorage.splice(i, 1);
                }else {
                    const productData = data.find(product => product.id === product_cartData.id);
                    product_cartData['amount_product'] = product_cartData['amount_product'] > productData.stock ? productData.stock : product_cartData['amount_product'] == 0 && productData.stock > 0 ? 1 : product_cartData['amount_product'];
                    Object.assign(product_cartData, productData);
                }
            }
            localStorage.setItem("shoppingCartData", JSON.stringify(cartStorage));

        	let total = 0;
		    let subtotal = 0;
		    let totalIva = 0;

		    const selectLocality = $('#location');
		    let totalEnvio = 0;

		    const ul = $("<ul class='offcanvas-cart py-3 px-3'></ul>");
			JSON.parse(localStorage.getItem('shoppingCartData')).forEach(item => {
	        	subtotal += item.amount_product * item.price;

		        // Purchase Summary View
		        let li =  `<li class="offcanvas-cart-item-single">
		                        <div class="offcanvas-cart-item-block">
		                            <div class="offcanvas-cart-item-image-link">
		                                <img src="${item.image}" alt=""
		                                    class="offcanvas-cart-image">
		                            </div>
		                            <div class="offcanvas-cart-item-content">
		                                <span class="font-weight-bold">${item.name}</span>
		                                <div class="offcanvas-cart-item-details">`
	                                if (item.stock != 0) {
	                                	li += `
	                            			<span class="offcanvas-cart-item-details-quantity">${item.amount_product} x </span>
		                                    <span class="offcanvas-cart-item-details-price">$${numberFormat(item.price)}</span>
	                                	`;
	                                }else{
	                            		li += `<span class="c-coral font-weight-bold fs-12">Lo sentimos no hay disponible.</span>`;
	                                }
		                                    
		                       	li +=	`</div>
		                            </div>
		                        </div>
		                    </li>`;

		        ul.append(li);
		        // ---------------------- //	
			});
			totalIva = subtotal * 0.12;
			// iva function
			total = subtotal + totalIva + totalEnvio;
			
			if(total < 100){
				$(selectLocality).change(() => {
					if ($(selectLocality).val() == 1) {
						totalEnvio = 0;
					}else if($(selectLocality).val() == 2){
						totalEnvio = 5;
					}else{
						totalEnvio = 10;
					}
					total = subtotal + totalIva + totalEnvio;
					$('.shipment-payment').text("$"+numberFormat(totalEnvio));
					$('.total-payment').text("$"+numberFormat(total));
				});
			}

			$('.subtotal-payment').text("$"+numberFormat(subtotal));
			$('.iva-payment').text("$"+numberFormat(totalIva));
			$('.shipment-payment').text("$"+numberFormat(totalEnvio));
			$('.total-payment').text("$"+numberFormat(total));
		    $('.purchase-summary').append(ul);
		},
        error: function(xhr, status, error) {
        	window.location.href = base_url + "carrito";
		},
        complete: function() {
        }
	});

	// ---------------------------------------------------
	var globalFlag = true;

	function collapseContainer() {
		$('#dataCollapse').collapse('show');
		$('.btn-collapse-data').addClass('d-none');

		$('.btn-collapse-data').click(function () {
			if(!$('#dataCollapse').hasClass('show')){
				$('.btn-collapse-data').addClass('d-none');
				$('.btn-collapse-data').removeClass('d-block');
				$('.btn-collapse-shipping').addClass('d-block');
				$('.btn-collapse-shipping').removeClass('d-none');	
				$('.process-payment').collapse('hide');
			}
			$('#shippingCollapse').collapse('hide');
		})
	}
	collapseContainer();

	function clientDataValidation() {
		if ($('#dni-client').length) {
			if ($('#dni-client').val() == "" || $('.cont-client_data .box-session').hasClass('invalid-content')) {
				globalFlag = false;
			}
		}
		return globalFlag;
	}
	
	function validationProcess() {
		if (clientDataValidation()) {
			$('#dataCollapse').collapse('hide');
			$('#shippingCollapse').collapse('show');
			$('.btn-collapse-data').addClass('d-block');
			$('.btn-collapse-data').removeClass('d-none');
			$('.btn-collapse-shipping').addClass('d-none');

			if ($('.cont-client_data #dni-client').length) {
				$('.alert-client-data').html("");
				$('.cont-client_data .box-session').removeClass('valid-content');
			}
			
		}else{
			msgAlert('.alert-client-data', 'Por favor asegúrese de no tener los campos requeridos en rojo o vacios.');
			return false;
		}
	}

	function inputValidationVerification() {
		if ($('#dni-client').length) {
			$.ajax({
				url: base_url + "carrito/verifyDni/",
				dataType: 'JSON',
				method: 'POST',
				data: {
					dni: $('#dni-client').val(),
				},
				success: function(data){
					if (data.status) {
						validationProcess();
					}else{
						msgAlert('.alert-client-data', data.msg);
					}
				},
				error: function(xhr, status, error) {
					console.log(error);
				}
			});
		}else{
			validationProcess();
		}		
	}

	$('#confirmedDataClient').click(function () {
		inputValidationVerification();
	})

	$('.btn-collapse-shipping').click(function () {
		inputValidationVerification();
		$('.process-payment').collapse('hide');
	});

	$('#confirmedLocationClient').click(function () {
		if($('#location').val() != "" && $('#address').val() != "" && $('#addressee').val() != ""){
			$('.btn-collapse-shipping').removeClass('d-none');
			$('.btn-collapse-shipping').addClass('d-block');
			$('#shippingCollapse').collapse('hide');
			$('.alert-shipping_information').html("");
			$('.cont-shipping_information .box-session').each(function () {
				$(this).removeClass('valid-content');
			});
			$('.process-payment').collapse('show');
		}else{
			msgAlert('.alert-shipping_information', 'Por favor asegúrese de no tener los campos requeridos en rojo o vacios.');
		}
	});

	if($('.process-payment').length){
		$('.collapse_method-buy:first').show();

		$('.payment-selection .form-check-input').on('click', function() {
			const thisCollapse = $(this).parent().parent().find('.collapse_method-buy');
			$('.collapse_method-buy').not(thisCollapse).slideUp();
			thisCollapse.slideDown();
		});
	}

	// Validation And Operation Of The Buy Button

	function checkButtonState() {
		let flag = false;
		var paymentMethod = $('.payment-selection input:checked').length > 0;
		var termsChecked = $('.accept-terms input').prop('checked');
		if(paymentMethod && termsChecked){
			flag = true;
		}
		return flag
	}

	$('.payment-selection input, .accept-terms input').change(function () {
		$('#finalize-purchase button').prop('disabled', !(checkButtonState()));
	});

	function purchaseProcessAndValidation(ordersProducts) {
		$.ajax({
			url: base_url + "carrito/paymentTypeValidation/",
			dataType: 'JSON',
			method: 'POST',
			data: {
				dni: $('#dni-client').length ? $('#dni-client').val() : "",
				ordered_products: ordersProducts,
				main_town: $('#location').val(),
				address: $('#address').val(),
				additional_information: $('#additional-information').val(),
				addressee: $('#addressee').val(),
				customer_message: $('#customer-message').val(),
				payment_method: $('.payment-selection input:checked').val(),
				info_client_state: clientDataValidation(),
				check_state : checkButtonState()
			},
			beforeSend: function() {
				// $('.cart-section .content-loading').css("display", "flex");
			},
			success: function(data){
				if (data.status) {
					let verifiedProducts = data.verifyProductsDb;

					if (data.paymentType) {
						console.log('tarjeta');

						if (verifiedProducts.stockUpdate) {
							$('#modalProductsChanges').modal('hide');
							paymentGateway(ordersProducts, verifiedProducts.total, verifiedProducts.unique_code, data.email_client, data.dni_client, data.phone_client, $('.payment-selection input:checked').val());
						}else{
							// aqui abriremos el modal si hay cambios en los productos
							if ($('#modalProductsChanges').hasClass('show')) {
								$('#modalProductsChanges').modal('hide');
								setTimeout(() => {
									modalProductsChanges(ordersProducts, verifiedProducts);
								}, 500);
							}else{
								modalProductsChanges(ordersProducts, verifiedProducts);
							}
							
						}
					}else{
						console.log('transferencia');
						if (verifiedProducts.stockUpdate) {
							$('#modalProductsChanges').modal('hide');
							// aqui le brindaremos los datos para que el cliente haga la transferencia
							console.log(verifiedProducts);
							// console.log(verifiedProducts.unique_code)
							window.location.href = base_url + "confirmarpedido?order=" + verifiedProducts.unique_code;
						}else{
							// aqui abriremos el modal si hay cambios en los productos
							if ($('#modalProductsChanges').hasClass('show')) {
								$('#modalProductsChanges').modal('hide');
								setTimeout(() => {
									modalProductsChanges(ordersProducts, verifiedProducts);
								}, 500);
							}else{
								modalProductsChanges(ordersProducts, verifiedProducts);
							}
							
						}
					}
				}else{
					console.log(data.msg);
				}
			},
			error: function(xhr, status, error) {
				console.log(error);
			},
			complete: function() {
				// $('.cart-section .content-loading').css("display", "none");
			}
		});
	}

	$('#customer-data_form').submit(function (e) {
		e.preventDefault();
		purchaseProcessAndValidation(cartStorage);
	})

	function modalProductsChanges(localStorage, verifyProductsDb) {
		$('#modalProductsChanges').modal('show');

		$('#modalProductsChanges .modal-content').html(`
			<div class="modal-header">
                <h4 class="modal-title font-weight-bold m-auto c-p-deep-blue text-center">${verifyProductsDb.alert}</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <h5 class="c-coral text-center font-weight-bold">Productos pedidos</h5>
                    	<ul class='offcanvas-cart py-3 px-3'>
                    		${createProductList(localStorage, 1)}
                    	</ul>
                    </div>
                    <div class="col-md-4">
                        <h5 class="c-coral text-center font-weight-bold">Presentan cambios</h5>
                    	<ul class='offcanvas-cart py-3 px-3'>
                    		${createProductList(verifyProductsDb.productsWithChanges, 2)}
                    	</ul>
                    </div>
                    <div class="col-md-4">
                        <h5 class="c-coral text-center font-weight-bold">Pedido actualizado</h5>
                    	<ul class='offcanvas-cart py-3 px-3'>
                    		${createProductList(verifyProductsDb.newProductsArray, 3)}
                    	</ul>
                    	<div class="coupon_code right mb-5" >
					 		<div class="coupon_inner">
					 			<div class="cart_subtotal">
					 				<p>Subtotal</p>
					 				<p class="cart_amount subtotal-update">$${numberFormat(verifyProductsDb.subtotal)}</p>
					 			</div>
					 			<div class="cart_subtotal">
					 				<p>IVA</p>
					 				<p class="cart_amount iva-update">$${numberFormat(verifyProductsDb.iva)}</p>
					 			</div>
					 			<div class="cart_subtotal">
					 				<p>ENVIO</p>
					 				<p class="cart_amount shipment-update">$${numberFormat(verifyProductsDb.envio)}</p>
					 			</div>
					 			<hr>
					 			<div class="cart_subtotal">
					 				<p>Total</p>
					 				<p class="cart_amount total-update">$${numberFormat(verifyProductsDb.total)}</p>
					 			</div>
					 		</div>
					 	</div>
                    </div>
                </div>  
            </div>

            <div class="modal-footer">
            	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
				${verifyProductsDb.total > 0 ? '<button type="button" class="btn btn-primary accept-changes">Comprar</button>' : ''}
            </div>
		`);

		$('.accept-changes').click(function () {
			purchaseProcessAndValidation(verifyProductsDb.newProductsArray);
		});
	}

	function createProductList(products, flag) {
	    let productListHTML = "";

	    products.forEach(product => {
	        let priceFormat = typeof product.price === "string" ? parseFloat(product.price) : product.price;
	        let liProduct;

	        if (flag == 2) {
	            liProduct = `<li class="offcanvas-cart-item-single">
	                            <div class="offcanvas-cart-item-block">
	                                <div class="offcanvas-cart-item-image-link">
	                                    <img src="${product.image}" alt="" class="offcanvas-cart-image">
	                                </div>
	                                <div class="offcanvas-cart-item-content">
	                                    <span class="font-weight-bold">${product.name}</span>
	                                    <div class="offcanvas-cart-item-details">`;

	            if (product.url != false) {
	                if (parseInt(product.stock) == 0) {
	                    liProduct += `<span class="c-coral font-weight-bold fs-12">Lo sentimos no hay disponible.</span>`;
	                } else {
	                    liProduct += `<span class="c-coral">Existencias: </span> <span> ${parseInt(product.stock)}</span>
	                    <div><span class="c-coral">Precio: </span> <span> $${numberFormat(priceFormat)}</span></div>`;
	                }
	            } else {
	                liProduct += `<span class="c-coral font-weight-bold fs-12">Lo sentimos. Este producto ya no existe.</span>`;
	            }

	            liProduct += `</div>
	                                </div>
	                            </div>
	                        </li>`;
	        } else {
	            liProduct = `<li class="offcanvas-cart-item-single">
	                            <div class="offcanvas-cart-item-block">
	                                <div class="offcanvas-cart-item-image-link">
	                                    <img src="${product.image}" alt="" class="offcanvas-cart-image">
	                                </div>
	                                <div class="offcanvas-cart-item-content">
	                                    <span class="font-weight-bold">${product.name}</span>
	                                    <div class="offcanvas-cart-item-details">
	                                        <span class="offcanvas-cart-item-details-quantity">${parseInt(product.amount_product)} x </span>
	                                        <span class="offcanvas-cart-item-details-price">$${numberFormat(priceFormat)}</span>
	                                    </div>
	                                </div>
	                            </div>
	                        </li>`;
	        }

	        if (liProduct) {
	            productListHTML += liProduct;
	        }
	    });

	    return productListHTML;
	}
	
	function paymentGateway(orderedProducts, total, uniqueCode, emailClient, dniClient, phoneClient, payment_method) {
		var parametros ={
			amount: parseFloat((total * 100).toFixed(2)),
			amountWithoutTax: parseFloat((total * 100).toFixed(2)),
			email: emailClient,
			documentId: dniClient,
			clientTransactionID: uniqueCode,
			phoneNumber: '+593'+ phoneClient,
			responseUrl: "http://localhost/carlos/page/confirmarcompra",
			cancellationUrl: "http://localhost/carlos/page/cancelacion"
		};

		$.ajax({
			data: parametros,
			url: 'https://pay.payphonetodoesposible.com/api/button/Prepare',
			type:'POST',
			beforeSend:function(xhr){
				xhr.setRequestHeader ('Authorization', "Bearer A9IblYZbxZFqSIlahmjnYea1CeAKEFWZoUrNtux1YOeQV-fhvTQ7ouwKqYhYK1vQIqJy165MCSGuANYVJDzdzFW1f2_5M24mlmA4iedc0Ii5h4fQkXilX-4PTxlNq7VzJdAblwueJs2RVWieA6-e8AZnB-zSu5G2dEUkVhVxt9gKdUOLYT4MWK1TVUFPayfwumHLOwhqMeuzkE9CJmSlyQjbUTXc_-ofXi4G8qV1Zfyg4ABO7e03p_e3FiK-v3bdIhQZBUom6dOXOSA7LKMgL_3I-vHkCEB-U1DQhhb4C9a0gGrMeZxysUNdbYpuqHtxQ8-ApQ")
			},
			success:function SolicitarPago(respuesta){
				$.ajax({
					url: base_url + "carrito/insertCardPurchaseValidation/",
					dataType: 'JSON',
					method: 'POST',
					data: {
						orderedProducts: orderedProducts,
						uniqueCode : uniqueCode,
						paymentMethod: payment_method
					},
					success: function(data){
						if (data.status) {
							location.href = respuesta.payWithCard;
						}else{
							console.log(data.msg);
						}
					},
					error: function(xhr, status, error) {
						console.log(error)
					},
				});
			}, 
			error: function(mensajeerror){
				$.ajax({
					url: base_url + "carrito/payphoneCallError/",
					dataType: 'JSON',
					method: 'POST',
					data: {
						orderedProducts: orderedProducts
					},
					success: function(data){
						console.log(data)
					},
					error: function(xhr, status, error) {
						
					},
				});
			}
		});
	}

});
