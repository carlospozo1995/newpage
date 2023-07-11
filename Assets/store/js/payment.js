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

                if (!existsData) {
                    cartStorage.splice(i, 1);
                }else {
                    const productData = data.find(product => product.id === product_cartData.id);
                    product_cartData['amount_product'] = product_cartData['amount_product'] > productData.stock ? productData.stock : product_cartData['amount_product'];
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
		                                <div class="offcanvas-cart-item-details">
		                                    <span class="offcanvas-cart-item-details-quantity">${item.amount_product} x </span>
		                                    <span class="offcanvas-cart-item-details-price">$${numberFormat(item.price)}</span>
		                                </div>
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
				if(data.status && data.paymentType != ""){
					console.log(data.paymentType)
					// if (data.paymentType) {
					// 	console.log('tarjeta');
					// 	console.log(data);
					// }else{
					// 	console.log('transferencia');
					// 	console.log(data);
					// }
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

});
