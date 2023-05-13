$(document).ready(function () {
	let cartStorage = JSON.parse(localStorage.getItem('dataCart'));
	let total = 0;
    let subtotal = 0;
    let totalIva = 0;
	cartStorage.forEach(item => {
        subtotal += item.amount_product * item.price;
	});
	total = subtotal + totalIva;

	$('.subtotal-payment').text("$"+numberFormat(subtotal));
	$('.iva-payment').text("$"+numberFormat(totalIva));
	$('.total-payment').text("$"+numberFormat(total));
});