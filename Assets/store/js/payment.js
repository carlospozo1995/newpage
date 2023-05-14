$(document).ready(function () {
	let cartStorage = JSON.parse(localStorage.getItem('dataCart'));
	let total = 0;
    let subtotal = 0;
    let totalIva = 0;
    let totalEnvio = 0;
    // const balao = 0;
    const ul = $("<ul class='offcanvas-cart py-3 px-3'></ul>");
	cartStorage.forEach(item => {
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

	$('.subtotal-payment').text("$"+numberFormat(subtotal));
	$('.iva-payment').text("$"+numberFormat(totalIva));
	$('.total-payment').text("$"+numberFormat(total));
    $('.purchase-summary').append(ul);
});