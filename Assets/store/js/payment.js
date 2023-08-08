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

	function dataFormValidation() {
		let flag = true;
		$('.form-client_data input').each(function () {
			if ($(this).val() === "") {
				flag = false;
			}
		});
		return flag;
	}
	function dataInputValidation() {
		let flag = true;
		$('.form-client_data .box-session').each(function () {
			if ($(this).hasClass('invalid-content')) {
				flag = false;
				return false;
			}
		});
		return flag;
	}
	function processForm() {
		if (dataFormValidation() && dataInputValidation()) {
			$('#dataCollapse').collapse('hide');
			$('#shippingCollapse').slideDown();
			$('.btn-collapse-data').addClass('d-block');
			$('.btn-collapse-data').removeClass('d-none');
			$('.btn-collapse-shipping').addClass('d-none');
			$('.btn-collapse-shipping').removeClass('d-block');

			$('.alert-client-data').html("");
			$('.form-client_data .box-session').each(function () {
				$(this).removeClass('valid-content');
			});
		}else{
			msgAlert('.alert-client-data', 'Por favor asegúrese de no tener los campos requeridos en rojo o vacios.');
			return false;
		}
	}

	if(dataFormValidation()){
		$('#dataCollapse').collapse('hide');
		$('#shippingCollapse').slideDown();
		$('.btn-collapse-data').removeClass('d-block');
		$('.btn-collapse-shipping').addClass('d-none');
	}else{
		$('#dataCollapse').collapse('show');
		$('#shippingCollapse').slideUp();
		$('.btn-collapse-data').addClass('d-none');
		$('.btn-collapse-shipping').removeClass('d-block');
	}

	$('.btn-collapse-data').click(function () {
		if(!$('#dataCollapse').hasClass('show')){
			$('.btn-collapse-data').addClass('d-none');
			$('.btn-collapse-data').removeClass('d-block');
			$('.btn-collapse-shipping').addClass('d-block');
			$('.btn-collapse-shipping').removeClass('d-none');
			$('.process-payment').slideUp();
		}
		$('#dataCollapse').collapse('toggle');
		$('#shippingCollapse').slideUp();
	})

	$('.form-client_data').submit(function (e) {
		e.preventDefault();
		processForm();
	});

	$('.btn-collapse-shipping').click(function () {
		$('.process-payment').slideUp();
		processForm();
	});

	$('.form-shipping_information').submit(function (e) {
		e.preventDefault();
		if($('#location').val() != "" && $('#address').val() != "" && $('#addressee').val() != ""){
			$('.btn-collapse-shipping').removeClass('d-none');
			$('.btn-collapse-shipping').addClass('d-block');
			$('#shippingCollapse').slideUp();
			$('.alert-shipping_information').html("");
			$('.form-shipping_information .box-session').each(function () {
				$(this).removeClass('valid-content');
			});
			$('.process-payment').slideDown();
		}else{
			msgAlert('.alert-shipping_information', 'Por favor asegúrese de no tener los campos requeridos en rojo o vacios.');
		}
	});

	if($('.process-payment').length){
		$('.collapse_method-buy-card').slideUp();
		let methodBuy = $('.payment-selection .form-check-input');
		methodBuy.click(function () {
			if ($(this).val() == 'bank-transfer') {
				$('.collapse_method-buy-transfer').slideDown();
				$('.collapse_method-buy-card').slideUp();
			  } else {
				$('.collapse_method-buy-transfer').slideUp();
				$('.collapse_method-buy-card').slideDown();
			  }
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

	$('#finalize-purchase button').click(function () {
		$.ajax({
			url: base_url + "carrito/paymentTypeValidation/",
			dataType: 'JSON',
			method: 'POST',
			data: {
				dni: $('#dni-client').val(),
				ordered_products: cartStorage,
				name: $('#name-client').val(),
				surname: $('#surname-client').val(),
				email: $('#email-client').val(),
				phone: $('#phone-client').val(),
				main_town: $('#location').val(),
				address: $('#address').val(),
				additional_information: $('#additional-information').val(),
				addressee: $('#addressee').val(),
				customer_message: $('#customer-message').val(),
				payment_method: $('.payment-selection input:checked').val(),
				info_client_state: dataFormValidation(),
				check_state : checkButtonState()
			},
			beforeSend: function() {
				// $('.cart-section .content-loading').css("display", "flex");
			},
			success: function(data){
				if (data.status) {
					if (data.paymentType) {
						console.log('tarjeta');
						// console.log(data.verifyProductsDb.flag_stockUpdate);
						if (data.verifyProductsDb.flag_stockUpdate) {
							$('#modalProductsChanges').modal('hide');
							paymentGateway(data.verifyProductsDb.total, data.verifyProductsDb.unique_code);
						}else{
							// aqui abriremos el modal si hay cambios en los productos
							modalProductsChanges(cartStorage, data.verifyProductsDb);
						}
					}else{
						console.log('transferencia');
						if (data.verifyProductsDb.flag_stockUpdate) {
							// aqui le brindaremos los datos para que el cliente haga la transferencia
							console.log(data.verifyProductsDb);
						}else{
							// aqui abriremos el modal si hay cambios en los productos
							modalProductsChanges(cartStorage, data.verifyProductsDb);
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
             	<button type="button" class="btn btn-primary accept-changes">Comprar</button>       
            </div>
		`);

		$('.accept-changes').click(function () {
			$.ajax({
				url: base_url + "carrito/acceptChangesPurchase/",
				dataType: 'JSON',
				method: 'POST',
				data: {
					newProductOrder: verifyProductsDb.newProductsArray,
					main_town: $('#location').val(),
					payment_method: $('.payment-selection input:checked').val()
				},
				beforeSend: function() {
					// $('.cart-section .content-loading').css("display", "flex");
				},
				success: function(dataNew){
					if (dataNew.status) {
						if (dataNew.paymentType) {
							console.log('tarjeta');
							if (dataNew.verifyProductsDb.flag_stockUpdate) {
								$('#modalProductsChanges').modal('hide');
								paymentGateway(dataNew.verifyProductsDb.total, dataNew.verifyProductsDb.unique_code);
							}else{
								$('#modalProductsChanges').modal('hide');
								setTimeout(() => {
									modalProductsChanges(verifyProductsDb.newProductsArray, dataNew.verifyProductsDb);
								}, 500);
							}
						}else{
							console.log('transferencia');
							if (dataNew.verifyProductsDb.flag_stockUpdate) {
								// aqui le brindaremos los datos para que el cliente haga la transferencia
								console.log(dataNew.verifyProductsDb);
								$('#modalProductsChanges').modal('hide');
								// window.location.href = base_url;
							}else{
								$('#modalProductsChanges').modal('hide');
								setTimeout(() => {
									modalProductsChanges(verifyProductsDb.newProductsArray, dataNew.verifyProductsDb);
								}, 500);
							}
						}
					}else{
						console.log(dataNew.msg);
					}
				},
				error: function(xhr, status, error) {
					console.log(error);
				},
				complete: function() {
					// $('.cart-section .content-loading').css("display", "none");
				}
			});
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

	function paymentGateway(total, uniqueCode) {
		var parametros ={
			amount: total * 100,
			amountWithoutTax: total * 100,
			clientTransactionID: uniqueCode,
			responseUrl: "http://localhost/carlos/page/pago",
			cancellationUrl: "http://localhost/carlos/page/cancelacion"
		};

		$.ajax({
			data: parametros,
			url: 'https://pay.payphonetodoesposible.com/api/button/Prepare',
			type:'POST',
			beforeSend:function(xhr){
				xhr.setRequestHeader ('Authorization', "Bearer H69wgPGoCNlXxD_4pm4YhDd_EY2mC7K5hK7xHx2-qFcREHkmoCYl96ObQwSg-5mwVtjksrSwdhLe8_wuvkrhS33RFMolMbw2z3xcqaWRglZqSzVTyZ4F_pQwO2R-Uo6CRoOgrgLfWdl0E8rbmFaAYKsIdeCMQqTjZ0Keh1nl-3G1IRZr5TqAf1J9gqkjEGNGdjZgZS3O91rzyymlyl5AmmDommGDDChPV7_J9I-5XnY3M4X5x4Z7GqUpoCYUdBf0whGh8p2Qa_CEPJWEFHsssbunkZrF0l3RPxXPs8I0ecUH1I0xF6IhLyqiXvWKApjjTgYL8iFC2eG5tXupeZfTT_-hue0")
			},
			success:function SolicitarPago(respuesta){
				location.href = respuesta.payWithCard;
			}, 
			error: function(mensajeerror){
				alert ("Error en la llamada:" + mensajeerror.Message);
			}
		});
	}

});
