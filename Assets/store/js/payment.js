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

		    const selectLocality = $('.country_option');
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
	
});