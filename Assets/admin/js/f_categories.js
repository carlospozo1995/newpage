
'use strict';

var tableCategories;
var rowtable;

$(document).ready(function(){

    var formNewCategory = $("#formNewCategory");

    if ($("#btnNewCategory").length) {
        $("#btnNewCategory").click(function () {
            $('#modalFormCategory').modal('show');
            $(".modal-header").removeClass("headerUpdate").addClass("headerRegister");
            $(".modal-title").text("Nuevo Categodria");
            $("#btnSubmitCategory").removeClass("bg-success").addClass("btn-primary");
            $(".btnText").text("Guardar");
            formNewCategory.trigger("reset");

            let id_category = document.getElementById("id_category").value = "";
            let listCtgVal = document.getElementById("listCategories").value = 0;
            ctgListOptions(id_category, listCtgVal);

            $(".contImgUpload").each((index, item)=>{
                $(item).find(".contImage").removeClass("notBlock");
                $(item).find(".errorImage").html("");
                $(item).find(".alertImgUpload").html("");
                $(item).find(".image_actual").val("");
                $(item).find(".image_remove").val(0);
                removeImage(item);
            });

            rowtable = "";
        });
    }

    if (formNewCategory.length) {
        
        $(".contImgUpload").each((index, item)=>{

            // ADD AND VALIDATE IMAGE
            var imagen = $(item).find(".imagen");
            imagen.change((e)=>{
                var uploadImagen = imagen.val();
                var fileImagen = imagen.prop("files")[0];
                var nav = window.URL || window.webkitURL;
                var alertImagen = $(item).find(".alertImgUpload");

                if (uploadImagen != "") {
                    var typeImagen = fileImagen.type;
                    var nameImagen = fileImagen.name;

                    if (typeImagen != 'image/jpeg' && typeImagen != "image/png" && typeImagen != "image/jpg") {
                        alertImagen.html('<p class="text-danger text-center">El archivo selecionado no es válido. Intentelo de nuevo.</p>');

                        if($(item).find(".imgUpload")){
                            $(item).find(".imgUpload").remove();
                        }

                        $(item).find(".delImgUpload").addClass("notBlock");
                        imagen.val("");
                        return false;
                    }else{
                        alertImagen.html("");

                        if($(item).find(".imgUpload")){
                            $(item).find(".imgUpload").remove();
                        }

                        $(item).find(".delImgUpload").removeClass("notBlock");
                        var obj_url = nav.createObjectURL(fileImagen);
                        // -----------
                        $(item).find(".prevImgUpload div").html('<img class="imgUpload" src="'+obj_url+'">');
                    }
                }else{
                    alert("No ha seleccionado una imagen.")
                    if($(item).find(".imgUpload")){
                        $(item).find(".imgUpload").remove();
                    }
                }

            });
            
            // BTN DELETE IMAGE
            if($(item).find(".delImgUpload")){
                var delImagen = $(item).find(".delImgUpload");
                delImagen.click(()=>{
                    $(item).find(".image_remove").val(1);
                    removeImage(item);
                });
            }

            //  VALIDATE OPTION SELECT CATEGORY
            let listCategories = $("#listCategories");
            listCategories.change(()=>{

                if(listCategories.val() == 0){
                    $(item).find(".contImage").removeClass("notBlock");   
                    $(item).find(".errorImage").html("");
                    $(item).find(".alertErrorImg").html("");
                }else{
                    $(item).find(".contImage").addClass("notBlock");
                    $(item).find(".errorImage").html('<span><i class="fa-solid fa-circle-info"></i> Las categorias superiores solo pueden contener una imagen.</span>');
                    
                    $(item).find(".contImage .imagen").val("");
                    $(item).find(".contImage .imgUpload").remove();
                    $(item).find(".contImage .delImgUpload").addClass("notBlock");
                }

            });

        });
    }

});

// SELECT OPTION - CATEGORIES LIST
function ctgListOptions(idCtg, listCtgVal) {
    let url_ajax = base_url + "categories/listCategories/";
    
    $.ajax({
        url: url_ajax,
        dataType: 'JSON',
        method: 'POST',
        data: {
            id_category: idCtg,
        },
        success: function(data){
            $("#listCategories").html(data);
            $("#listCategories").val(listCtgVal);
            $("#listCategories").select2();
        },
    });
}

// FUNCTION DELETE IMAGE BTN
function removeImage(item) {
    $(item).find(".imagen").val("");
    $(item).find(".delImgUpload").addClass("notBlock");

    if($(item).find(".imgUpload")){
        $(item).find(".imgUpload").remove();
    }
}