'use strict';

var tableProducts;
var rowtable;

$(document).ready(function () {
	// --- PRINT DATA TABLE USERS --- //
    tableProducts = $("#tableProducts").DataTable({
        "aProcessing": true,
        "aServerSide":true,
        "autoWidth": false,
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

	// CONTAINER IMAGES PRODUCT
	if($('.btnAddImage').length){
        $('.btnAddImage').click(() => {

            let key = Date.now();
			let newElement = $("<div>", {
			    id: "div" + key,

			    html: `
			        <div class="prevImage"></div>
			        <input type="file" name="foto" id="img${key}" class="inputUploadfile">
			        <label for="img${key}" class="btnUploadfile"><i class="fas fa-upload"></i></label>
			        <button class="btnDeleteImage" type="button" onclick="ftnDelItem('#div${key}')"><i class="fas fa-trash"></i></button>`
			});
			$("#containerImages").append(newElement);
			$('#div' + key + ' .btnUploadfile').click();

            fntInputFile();
        });
    }
    fntInputFile();

    //DATA JSON INSERT AND UPDATE PRODUCT
	formNewProduct.submit((e) =>{
		e.preventDefault();
		if($('#name_product').val() == "" || $('#desMainProd').val() == "" || $('#listCategories').val() == "" || $('#brand').val() == "" || $('#code').val() == "" || $('#price').val() == "" || $('#listStatus').val() == ""){
			Swal.fire("Atención", "Por favor asegúrese de llenar los campos requeridos.", "error");
            return false;
		}else{
			let elementsValid = $(".valid");
            let isValid = true;
            elementsValid.each((index, element) => {
                if($(element).hasClass('is-invalid')){
                    Swal.fire("Atención", "Por favor asegúrese de no tener campos en rojo.", "error");
                    isValid = false;
                    return false;
                };
            });

            if (!isValid) {
                return false;
            }

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
                		let htmlStatus = $("#listStatus").val() == 1 ? '<div class="text-center"><span class="bg-success p-1 rounded"><i class="fa-solid fa-user"></i> Activo</span></div>' : '<div class="text-center"><span class="bg-danger p-1 rounded"><i class="fa-solid fa-user-slash"></i> Inactivo</span></div>';
                        
                        let textCategory = $("#listCategories").find("option:selected").text().replace(/\s*\([^)]*\)\s*/g, "");
                        let sliderDst = "";
                        let sliderMbl = "";
                        data.data_request.sliderDst != "" ? sliderDst = '<img class="text-center" style="display:flex; margin:auto; width:70px" src="'+data.data_request.sliderDst+'">' : sliderDst = "";
                        data.data_request.sliderMbl != "" ? sliderMbl = '<img class="text-center" style="display:flex; margin:auto; width:50px" src="'+data.data_request.sliderMbl+'">' : sliderMbl = "";

                        if(rowtable == ""){
                        	let id_row = $("#tableProducts").DataTable().rows().count() + 1;
                            let btnWatch = "";
                            let btnUpdate = "";
                            let btnDelete = "";

                            let id_product = data.data_request.id_encrypt;
                            let module_data = data.data_request.module;
                            let id_user = data.data_request.id_user;

                            if (module_data.ver == 1) {
                                btnWatch = '<button type="button" class="btn btn-secondary btn-sm" onclick="watch('+"'"+id_product+"'"+')" tilte="Ver"><i class="fa-solid fa-eye"></i></button>'
                            }

                            if (module_data.actualizar == 1) {
                                btnUpdate = '<button type="button" class="btn btn-primary btn-sm" onclick="edit(this, '+"'"+id_product+"'"+')" tilte="Editar"><i class="fa-solid fa-pencil"></i></button>';
                            }

                            if (id_user == 1 && module_data.eliminar == 1){
                                btnDelete = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteData(this, '+"'"+id_product+"'"+')" tilte="Eliminar"><i class="fa-solid fa-trash"></i></button>';
                            }

                            $("#tableProducts").DataTable().row.add([
                                id_row, 
                                $('#code').val(),
                                $("#name_product").val(),
                                textCategory,
                            	"$ " + numberFormat(parseFloat($('#price').val())),
                                $('#stock').val(),
                                sliderDst,
                                sliderMbl,
                                htmlStatus,
                                '<div class="text-center"> '+btnWatch+" "+btnUpdate+" "+btnDelete+'</div>'
                            ]).draw(false);
                        }else{
                            let n_row = $(rowtable).find("td:eq(0)").html();
                            let buttons_html = $(rowtable).find("td:eq(9)").html();
                            $("#tableProducts").DataTable().row(rowtable).data([
                                n_row,
                                $("#code").val(),
                                $("#name_product").val(),
                                textCategory,
                                "$ " + numberFormat(parseFloat($('#price').val())),
                                $('#stock').val(),
                                sliderDst,
                                sliderMbl,
                                htmlStatus,
                                buttons_html,
                            ]).draw(false);
                        }

                		$('#modalFormProduct').modal('hide');
                        msgShow(1, 'Productos', data.msg);
                	}else{
                		msgShow(2, 'Atención', data.msg);
                	}
                	loading.css("display","none");
                },
            });
		}
	});

});

// EDIT PRODUCT
function edit(element, data_request){
    rowtable = $(element).closest("tr")[0];
    let ischild = $(rowtable).hasClass("child");
    if(ischild){
        rowtable = $(rowtable).prev()[0];
    }
        
    $(".modal-header").removeClass("headerRegister").addClass("headerUpdate");
    $(".modal-title").text("Actualizar Categoria");
    $("#btnSubmitProduct").removeClass("btn-primary").addClass("bg-success");
    $(".btnText").text("Actualizar");
    validFocus();
    
    if (!data_request) {
        return false;
    }else{
    	let url_ajax = base_url + "products/getProduct/";
        $.ajax({
            url: url_ajax,
            dataType: 'JSON',
            method: 'POST',
            data: {
                data: data_request,
            },
            success: function(data){

   				if (data.status) {
   					$('#modalFormProduct').modal('show');
   					$(".card-footer").css("display", "block");
   					let data_product = data.data_request.data_product;
                    let htmlImage = "";

   					$("#id_product").val(data_request);
   					$("#name_product").val(data_product.name_product);
   					$('#desMainProd').val(data_product.desMain);
   					data_product.desGeneral != null ? tinymce.activeEditor.setContent(data_product.desGeneral) : tinymce.activeEditor.setContent("");
                    if (data_product.tags != null) {
                        $("#tagsProduct").tagsinput('removeAll'); 
                        $("#tagsProduct").tagsinput('add', data_product.tags)
                    }else{
                        $("#tagsProduct").tagsinput('removeAll'); 
                    }
   					$("#sliderMbl_actual").val(data_product.sliderMbl);
                    $("#sliderDst_actual").val(data_product.sliderDst);
                    $("#wbanner_actual").val(data_product.banner_width);
                    $("#lgbannerP_actual").val(data_product.banner_large)

                    $(".contImgUpload").each((index, item)=>{
                        $(item).find(".image_remove").val(0);
                        $(item).find(".imagen").val("");
                        $(item).find(".alertImgUpload").html("");
                    });

                    if (data_product.sliderDst != null && data_product.sliderMbl != null) {
                        $(".prevSliderMbl div").html('<img class="imgUpload" src="'+data_product.url_sliderMbl+'">');
                        $(".prevSliderDst div").html('<img class="imgUpload" src="'+data_product.url_sliderDst+'">');
                        $(".delSliderMbl, .delSliderDst").removeClass("notBlock");
                    }else{
                        $(".prevSliderMbl div").html('');
                        $(".prevSliderDst div").html('');
                        $(".delSliderMbl, .delSliderDst").addClass("notBlock");
                    }

                    if(data_product.url_bannerWidth != null){
                        $(".prevWidthBanner div").html('<img class="imgUpload" src="'+data_product.url_bannerWidth+'">');
                        $(".delwbanner").removeClass("notBlock");
                    }else{
                        $(".prevWidthBanner div").html('');
                        $(".delwbanner").addClass("notBlock");
                    }

                    if(data_product.url_lgbannerP != null){
                        $(".prev_lgbannerP div").html('<img class="imgUpload" src="'+data_product.url_lgbannerP+'">');
                        $(".del_lgbannerP").removeClass("notBlock");
                    }else{
                        $(".prev_lgbannerP div").html('');
                        $(".del_lgbannerP").addClass("notBlock");
                    }

                    $("#sliderDes").val(data_product.sliderDes);
                    $("#listCategories").val(data_product.option_encrypt);
            		$("#listCategories").select2();
            		$('#brand').val(data_product.brand);
					$('#code').val(data_product.code);
					$('#price').val(data_product.price);
					$('#stock').val(data_product.stock);
                    $('#prev_price').val(data_product.prevPrice);
                    $('#discount').val(data_product.discount);
                    $('#cantDues').val(data_product.cantDues);
                    $('#priceDues').val(data_product.priceDues);
					$('#listStatus').val(data_product.status);

                    if (data_product.images_product.length > 0) {
                        for (var i = 0; i < data_product.images_product.length; i++) {
                            let key = Date.now() + i;
                            htmlImage += `
                                <div id="div${key}">
                                    <div class="prevImage">
                                        <img src="${data_product.images_product[i].url_image}">
                                    </div>
                                    <button type="button" class="btnDeleteImage" onclick="ftnDelItem('#div${key}')" imgname= "${data_product.images_product[i].image}"><i class="fas fa-trash"></i></button>
                                </div>
                            `;
                        }
                    }
                    $("#containerImages").html(htmlImage);
   				}
            }
        });
   	}
}

// LOAD IMAGES PRODUCT EXISTS
function fntInputFile() {
    $(".inputUploadfile").each((index, item) => {
        $(item).on("change", () => {
            let id_product = $("#id_product").val();
			let parentId = $(item).parent().attr("id");
			let idFile = $(item).attr("id");
			let uploadFoto = $("#" + idFile).val();
			let fileImg = $("#" + idFile).get(0).files;
			let prevImg = $("#" + parentId + " .prevImage");
			let nav = window.URL || window.webkitURL;

            if(uploadFoto != ""){
                let type = fileImg[0].type;
				let name = fileImg[0].name;
				if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
				  prevImg.html('<span class="text-center">Archivo no válido.</span>');
				  $("#" + idFile).val("");
				  return false;
				} else {
                    let objeto_url = nav.createObjectURL($(item).prop("files")[0]);
					prevImg.html('<img class="loading" src="' + base_url + 'Assets/admin/files/images/loading.gif">');

                    var formData = new FormData();
                    formData.append("id", id_product);
                    formData.append("file", $(item).prop("files")[0]);
                    
					let url_ajax = base_url + "products/setImage/";
		            $.ajax({
		                url: url_ajax,
		                dataType: 'JSON',
		                method: 'POST',
		                data: formData,
                        contentType: false,
                        processData: false, 
		                success: function(data){
		    				if(data.status){
                                prevImg.html(`<img src="${objeto_url}">`);
                                $("#" + parentId + " .btnDeleteImage").attr("imgName", data.data_request.data_img);
                                $("#" + parentId + " .btnUploadfile").addClass('notBlock');
                                $("#" + parentId + " .btnDeleteImage").removeClass('notBlock');
                                msgShow(1, 'Productos', data.msg);
                            }else{
                                msgShow(2, 'Atención', data.msg);
                            }
		    			},
		            });
                }
            }
        });
    });
}

function ftnDelItem(element) {
    let name_img = $(element + ' .btnDeleteImage').attr('imgName');
    let id_product = $("#id_product").val();

    var formData = new FormData();
    formData.append("id", id_product);
    formData.append("file_name", name_img);
    
    let url_ajax = base_url + "products/delFile/";
    $.ajax({
        url: url_ajax,
        dataType: 'JSON',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false, 
        success: function(data){
            if(data.status){
                $(element).remove();
                msgShow(1, 'Productos', data.msg);
            }else{
                msgShow(2, 'Atención', data.msg);
            }
        },
    });
}

// VIEW PRODUCT
function watch(data) {
    $(".modal-header").removeClass("headerUpdate").addClass("headerRegister");
    $(".modal-title").text("Datos del producto");
    if (!data) {
        return false;
    }else{
         let url_ajax = base_url + "products/getProduct/";
                
        $.ajax({
            url: url_ajax,
            dataType: 'JSON',
            method: 'POST',
            data: {
                data: data,
            },
            success: function(data){
                let obj_request =  data.data_request.data_product;
                let htmlPhoto = "";
                
                if (data.status) {
                    let status = obj_request.status == 1 ? '<span class="bg-success p-1 rounded"><i class="fas fa-user"></i> Activo</span>' : '<span class="bg-danger p-1 rounded"><i class="fas fa-user-slash"></i> Inactivo</span>';
                    
                    $("#celCode").text(obj_request.code);
                    $("#celName").text(obj_request.name_product);
                    $("#celBrand").text(obj_request.brand);
                    $("#celCategory").text(obj_request.category);
                    $("#celPrice").text("$ " + numberFormat(parseFloat(obj_request.price)));
                    $("#celPricePrev").text("$ " + numberFormat(parseFloat(obj_request.prevPrice)));
                    obj_request.prevPrice != null ? $("#celPricePrev").text("$ " + numberFormat(parseFloat(obj_request.prevPrice))) : $("#celPricePrev").text("");
                    $("#celDiscount").text(obj_request.discount);
                    $("#celStock").text(obj_request.stock);
                    obj_request.url_sliderDst != null ? $("#celSlrDesktop").html('<img class="w-25" src="'+ obj_request.url_sliderDst +'" alt="">') : $("#celSlrDesktop").html("");
                    obj_request.url_sliderMbl != null ? $("#celSlrMobile").html('<img class="w-25" src="'+ obj_request.url_sliderMbl +'" alt="">') : $("#celSlrMobile").html("");
                    $("#celDesMain").text(obj_request.desMain);
                    $("#celDesGeneral").html(obj_request.desGeneral);
                    $("#celCantDues").text(obj_request.cantDues);
                    obj_request.priceDues != null ? $("#celPriceDues").text("$ " + numberFormat(parseFloat(obj_request.priceDues))) : $("#celPriceDues").text("");

                    for (let i = 0; i < obj_request.images_product.length; i++) {
                        htmlPhoto += `<img class="w-25 px-1 py-1" src="${obj_request.images_product[i].url_image}">`;
                    }
                    $("#celPhoto").html(htmlPhoto);

                    $("#celDate_create").text(obj_request.date_create);
                    $("#celStatus").html(status);
                    $('#modalViewProduct').modal('show');
                }else{
                    msgShow(3, 'Error', data.msg);
                }
            }
        });
    }
}

// --- DELETE PRODUCT --- //
function deleteData(element, data) {
    Swal.fire({
        title: 'Eliminar Producto',
        text: "Realmente quiere eliminar el producto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            if (!data) {
                return false;
            }else{
                loading.css("display","flex");
                let url_ajax = base_url + "products/delProduct/";
                        
                $.ajax({
                    url: url_ajax,
                    dataType: 'JSON',
                    method: 'POST',
                    data: {
                        data: data,
                    },  
                    success: function(data){
                        if (data.status) {
                            let row_closest = $(element).closest("tr");
                            if(row_closest.length){
                                let ischild = $(row_closest).hasClass("child");
                                if(ischild){
                                    let prevtr = row_closest.prev();
                                    if(prevtr.length){
                                        $("#tableProducts").DataTable().row(prevtr[0]).remove().draw(false);
                                    }
                                }
                                else{
                                    $("#tableProducts").DataTable().row(row_closest[0]).remove().draw(false);
                                }
                            }

                            // Reset the id column
                            resetIdTable($("#tableProducts"));
                            
                            msgShow(1, 'Eliminado', data.msg);
                        }else{
                            msgShow(3, 'Error', data.msg);
                        }
                        loading.css("display","none");
                    },
                });
            }
        }
    });
}
