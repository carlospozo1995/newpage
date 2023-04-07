$(document).ready(function () {

	// QUANTITY OF PRODUCT TO BUY (input-number)
	var stock_quantity = parseInt($('.product-variable-quantity input[type="number"]').attr('max'));

	$('.product-variable-quantity').on('click input', '.btn-minus, .btn-plus, input[type="number"]', function () {
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

	$('.product-variable-quantity input[type="number"]').on('blur', function () {
    	let value = parseInt($(this).val());

    	if (isNaN(value) || value === '' || value === null) {
      		$(this).val(1);
    	} else if (value > stock_quantity) {
      		$(this).val(stock_quantity);
    	}
  	});

});
