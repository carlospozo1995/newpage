'use strict';

var tableProducts;
var rowtable;

$(document).ready(function () {
	// --- PRINT DATA TABLE USERS --- //
    tableProducts = $("#tableProducts").DataTable({
        "aProcessing": true,
        "aServerSide":true,
        "language":{
            "url":"//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        },
        "responsive": true,
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
        "dom": 'lBfrtip',
        "buttons": [
            "copy", "csv", "excel", "pdf", "print", "colvis"
        ],
        "bDestroy":true,
        "order":[[0,"asc"]],
        "iDisplayLength":25,
    });

	var formNewProduct = $("#formNewProduct");

	if ($("#btnNewProduct").length) {
		$("#btnNewProduct").click(()=>{
			$("#modalFormProduct").modal("show");
			$(".modal-header").removeClass("headerUpdate").addClass("headerRegister");
            $(".modal-title").text("Nuevo Producto");
            $("#btnSubmitProduct").removeClass("bg-success").addClass("btn-primary");
            $(".btnText").text("Guardar");
			formNewProduct.trigger("reset");
			$("#id_product").val("");
			$("#listCategories").select2();
			validFocus();

			$(".contImgUpload").each((index, item)=>{
                $(item).find(".alertImgUpload").html("");
                $(item).find(".image_actual").val("");
                $(item).find(".image_remove").val(0);
                removeImage(item);
            });

            $(".card-footer").css("display", "none");
			rowtable = "";
		});
	}	

	// TEXT AREA TINYMCE
	$(document).on('focusin', function(e) {
	    if ($(e.target).closest(".tox-tinymce, .tox-tinymce-aux, .moxman-window, .tam-assetmanager-root").length) {
	        e.stopImmediatePropagation();
	    }
	});

	tinymce.init({
	    selector: '#desGeneralProd',
	    setup: function (editor) {
	         editor.on('change', function () {
	            tinymce.triggerSave();
	        });
	        
	    },
	    width: "100%",
	    height: 200,    
	    statubar: true,
	    plugins: [
	        "advlist autolink lists charmap print preview hr anchor pagebreak",
	        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
	        "save table contextmenu directionality template paste textcolor"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | print preview fullpage | forecolor backcolor",
	    branding: false,
	});

	formNewProduct.submit((e) =>{
		e.preventDefault();
		if($('#name_product').val() == "" || $('#desmainProd').val() == "" || $('#listCategories').val() == "" || $('#brand').val() == "" || $('#code').val() == "" || $('#price').val() == "" || $('#stock').val() == "" || $('#listStatus').val() == ""){
			Swal.fire("Atención", "Por favor asegúrese de llenar los campos requeridos.", "error");
            return false;
		}else{
			let elementsValid = $(".valid");
            elementsValid.each((index, element) => {
                if($(element).hasClass('is-invalid')){
                    Swal.fire("Atención", "Por favor asegúrese de no tener campos en rojo.", "error");
                    return false;
                };
            });

            // loading.css("display","flex");
            var formData = new FormData(e.target);
            let url_ajax = base_url + "products/setProduct/";
            $.ajax({
                url: url_ajax,
                dataType: 'JSON',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false, 
                success: function(data){
                	if (data.status) {
                		$('#modalFormProduct').modal('hide');
                        msgShow(1, 'Productos', data.msg);
                	}else{
                		msgShow(2, 'Atención', data.msg);
                	}
                	// loading.css("display","none");
                },
            });
		}
	});

});
