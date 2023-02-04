'use strict';

var tableProducts;
var rowtable;

$(document).ready(function () {

	var formNewProduct = $("#formNewProduct");

	if ($("#btnNewProduct").length) {
		$("#btnNewProduct").click(()=>{
			$("#modalFormProduct").modal("show");
			formNewProduct.trigger("reset");
			$("#listCategories").select2();
		});
	}	


});
