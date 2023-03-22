$(document).ready(function () {
	$(".contenedorBtn").on("click", ".btnTest", function() {
console.log("....");
});



	$(".addbtn").click(function () {
		$('.contenedorBtn').append("<button class='btnTest'>click 4</button>")
	});
})