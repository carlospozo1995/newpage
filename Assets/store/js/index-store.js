$(document).ready(function () {
    $("#sendMail").click(function () {
        $.ajax({
			url: base_url + "index/testEmail/",
			dataType: 'JSON',
			method: 'POST',
			data: {
				envio: '...'
			},
			beforeSend: function() {
			},
			success: function(data){
				if (data.status) {
                    console.log('mensaje enviado');
                }else{
                    console.log('mensaje no enviado');
                }
			},
			error: function(xhr, status, error) {
				console.log(error);
			},
			complete: function() {

			}
		});
    })

	let first = parseFloat("12.56");
    let second = parseFloat("1000.56");

	$( "#slider-range-test" ).slider({
      	range: true,
      	min: first,
      	max: second,
      	values: [ first, second ],
      	slide: function( event, ui ) {
        	$( "#test-amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      	},
    });

    $( "#test-amount" ).val( "$" + first +  " - $" + second );
})