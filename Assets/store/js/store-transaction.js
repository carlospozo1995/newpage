
$(window).ready(function () {
	// let productsTransaction =  JSON.parse(localStorage.getItem("shoppingCartData"));
	// let productsIds = $.map(productsTransaction, function(product) {
    // 	return product.id;
	// });
	// let amountProducts = $.map(productsTransaction, function(product) {
    // 	return product.amount_product;
	// });
	// console.log(productsTransaction);
	// $.ajax({
	// 	url: base_url + "pago/updateTransactionProducts/",
	// 	dataType: 'JSON',
	// 	method: 'POST',
	// 	data: {
	// 		productsIds: productsIds,
	// 		amountProducts: amountProducts
	// 	},
	// 	beforeSend: function() {
	// 	},
	// 	success: function(data){
	// 		console.log(data);
			localStorage.removeItem("shoppingCartData");
	// 	},
	// 	error: function(xhr, status, error) {
	// 		console.log(error);
	// 	},
	// 	complete: function() {

	// 	}
	// });

})