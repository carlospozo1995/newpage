
'use strict';

var tableCategories;
var rowtable;

$(document).ready(function(){
    // --- PRINT DATA TABLE USERS --- //
    tableCategories = $("#tableCategories").DataTable({
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

    var formNewCategory = $("#formNewCategory");

    if ($("#btnNewCategory").length) {
        $("#btnNewCategory").click(function () {
            $('#modalFormCategory').modal('show');
            $(".modal-header").removeClass("headerUpdate").addClass("headerRegister");
            $(".modal-title").text("Nueva Categoria");
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

    // ADD NEW CATEGORY
    formNewCategory.submit((e)=>{
        e.preventDefault();
        let text_ctg = "";
        $("#listCategories").val() == 0 ? text_ctg = "" : text_ctg = $("#listCategories").find("option:selected").text();
        text_ctg = text_ctg.replace(/-/g, "");
        
        if($("#name_category").val() == "" || $("#listCategories").val() == "" || $("#listStatus").val() == ""){
            Swal.fire("Atención", "Por favor asegúrese de llenar los campos requeridos.", "error");
            return false;
        }else{
            loading.css("display","flex");
            var formData = new FormData(e.target);
            let url_ajax = base_url + "categories/setCategory/";

            $.ajax({
                url: url_ajax,
                dataType: 'JSON',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false, 
                success: function(data){
                    console.log(data)
                    if (data.status) {
                        let htmlStatus = $("#listStatus").val() == 1 ? '<div class="text-center"><span class="bg-success p-1 rounded"><i class="fa-solid fa-user"></i> Activo</span></div>' : '<div class="text-center"><span class="bg-danger p-1 rounded"><i class="fa-solid fa-user-slash"></i> Inactivo</span></div>';
                            
                        let sliderDst = "";
                        let sliderMbl = "";
                        data.data_request.sliderDst != "" ? sliderDst = '<img class="text-center" style="display:flex; margin:auto; width:70px" src="'+data.data_request.sliderDst+'">' : sliderDst = "";
                        data.data_request.sliderMbl != "" ? sliderMbl = '<img class="text-center" style="display:flex; margin:auto; width:50px" src="'+data.data_request.sliderMbl+'">' : sliderMbl = "";

                        if(rowtable == ""){
                            let id_row = $("#tableCategories").DataTable().rows().count() + 1;
                            let btnWatch = "";
                            let btnUpdate = "";
                            let btnDelete = "";

                            let id_category = data.data_request.id_encrypt;
                            let module_data = data.data_request.module;
                            let id_user = data.data_request.id_user;

                            if (module_data.ver == 1) {
                                btnWatch = '<button type="button" class="btn btn-secondary btn-sm" onclick="watch('+"'"+id_category+"'"+')" tilte="Ver"><i class="fa-solid fa-eye"></i></button>'
                            }

                            if (module_data.actualizar == 1) {
                                btnUpdate = '<button type="button" class="btn btn-primary btn-sm" onclick="edit(this, '+"'"+id_category+"'"+')" tilte="Editar"><i class="fa-solid fa-pencil"></i></button>';
                            }

                            if (id_user == 1 && module_data.eliminar == 1){
                                btnDelete = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteData(this, '+"'"+id_category+"'"+')" tilte="Eliminar"><i class="fa-solid fa-trash"></i></button>';
                            }

                            $("#tableCategories").DataTable().row.add([
                                id_row, 
                                $("#name_category").val(),
                                text_ctg,
                                sliderDst,
                                sliderMbl,
                                htmlStatus,
                                '<div class="text-center"> '+btnWatch+" "+btnUpdate+" "+btnDelete+'</div>'
                            ]).draw(false);
                        }

                        $('#modalFormCategory').modal('hide');
                        msgShow(1, 'Categorias', data.msg);
                    }else{
                        msgShow(2, 'Atención', data.msg);
                    }
                    loading.css("display","none");
                },
                error: function(e){
                    // console.log(e);
                },
                beforeSend: function(){
                    // console.log("antes completar");
                },
                complete: function(){
                    // console.log("completado");
                }
            });
        }
    });
});

// --- EDIT CATEGORY --- //
function edit(element, data){
    rowtable = $(element).closest("tr")[0];
    let ischild = $(rowtable).hasClass("child");
    if(ischild){
        rowtable = $(rowtable).prev()[0];
    }
        // $("#id_category").val(data);
    $(".modal-header").removeClass("headerRegister").addClass("headerUpdate");
    $(".modal-title").text("Actualizar Categoria");
    $("#btnSubmitUser").removeClass("btn-primary").addClass("bg-success");
    $(".btnText").text("Actualizar");
    
    if (!data) {
        return false;
    }else{
        let url_ajax = base_url + "categories/getCategory/";
        $.ajax({
            url: url_ajax,
            dataType: 'JSON',
            method: 'POST',
            data: {
                data: data,
            },
            success: function(data){
                if (data.status) {
                    $('#modalFormCategory').modal('show');
                    let data_category = data.data_request.data_category;

                    $("#icon_actual").val(data_category.icon);
                    $("#photo_actual").val(data_category.photo);
                    $("#sliderMbl_actual").val(data_category.sliderMbl);
                    $("#sliderDst_actual").val(data_category.sliderDst);

                    $(".contImgUpload").each((index, item)=>{
                        $(item).find(".image_remove").val(0);
                        $(item).find(".imagen").val("");
                    });

                    if (data_category.sliderDst != null && data_category.sliderMbl != null) {
                        // $(item).find(".prevImgUpload div").html('<img class="imgUpload" src="'+obj_url+'">');
                        $(".prevSliderMbl div").html('<img class="imgUpload" src="'+data_category.url_sliderMbl+'">')
                        $(".prevSliderDst div").html('<img class="imgUpload" src="'+data_category.url_sliderDst+'">')
                        // $("#.delSlidermbl") 
                    }else{
                        $(".prevSliderMbl div").html('');
                        $(".prevSliderDst div").html('');
                    }


                }else{
                    msgShow(3, 'Error', data.msg);
                }
            },
            error: function(e){
                // console.log(e);
            },
            beforeSend: function(){
                // console.log("antes completar");
            },
            complete: function(){
                // console.log("completado");
            }
        });
    }
}

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


