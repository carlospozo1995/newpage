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

})