
'use strict';

var tableCategories;
var rowtable;
var sonsCtg;

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

    $(".contImgUpload").each((index, item)=>{
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
                    
                    if (data.status) {
                        sonsCtg = data.data_request.data_sons;

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
                            
                            var newRow = $("#tableCategories").DataTable().row.add([
                                id_row, 
                                $("#name_category").val(),
                                text_ctg,
                                sliderDst,
                                sliderMbl,
                                htmlStatus,
                                '<div class="text-center"> '+btnWatch+" "+btnUpdate+" "+btnDelete+'</div>'
                            ]).draw(false).node();
                            $(newRow).attr("id", id_category);

                        }else{
                            let n_row = $(rowtable).find("td:eq(0)").html();
                            let buttons_html = $(rowtable).find("td:eq(6)").html();
                            $("#tableCategories").DataTable().row(rowtable).data([
                                n_row,
                                $("#name_category").val(),
                                text_ctg,
                                sliderDst,
                                sliderMbl,
                                htmlStatus,
                                buttons_html,
                            ]).draw(false);

                            for (let i = 0; i < sonsCtg.length; i++) {
                                let currentId = sonsCtg[i].id_son;
                                let currentFatherName = sonsCtg[i].father_name;

                                let row = $("#tableCategories").DataTable().rows().every(function() {
                                    let rowNode = this.node();
                                    let rowData = this.data();
                                    let rowId = rowNode.id;
                                    if (rowId === currentId) {
                                        $("#tableCategories").DataTable().cell(this, 2).data(currentFatherName).draw();
                                        $("#tableCategories").DataTable().cell(this, 5).data(htmlStatus).draw();
                                        return false;
                                    }
                                    return true;
                                });
                            }
                        }

                        $('#modalFormCategory').modal('hide');
                        msgShow(1, 'Categorias', data.msg);
                    }else{
                        msgShow(2, 'Atención', data.msg);
                    }
                    loading.css("display","none");
                },
            });
        }
    });
});

// --- EDIT CATEGORY --- //
function edit(element, data_request){
    rowtable = $(element).closest("tr")[0];
    let ischild = $(rowtable).hasClass("child");
    if(ischild){
        rowtable = $(rowtable).prev()[0];
    }
        
    $(".modal-header").removeClass("headerRegister").addClass("headerUpdate");
    $(".modal-title").text("Actualizar Categoria");
    $("#btnSubmitUser").removeClass("btn-primary").addClass("bg-success");
    $(".btnText").text("Actualizar");
    
    if (!data_request) {
        return false;
    }else{
        let url_ajax = base_url + "categories/getCategory/";
        $.ajax({
            url: url_ajax,
            dataType: 'JSON',
            method: 'POST',
            data: {
                data: data_request,
            },
            success: function(data){
                if (data.status) {
                    $('#modalFormCategory').modal('show');
                    let data_category = data.data_request.data_category;
                    sonsCtg = data_category.sons;
                    $("#id_category").val(data_request);
                    $("#name_category").val(data_category.name_category);
                    $("#sliderDesOne").val(data_category.sliderDesOne);
                    $("#sliderDesTwo").val(data_category.sliderDesTwo);
                    $("#listStatus").val(data_category.status);
                    $("#icon_actual").val(data_category.icon);
                    $("#photo_actual").val(data_category.photo);
                    $("#sliderMbl_actual").val(data_category.sliderMbl);
                    $("#sliderDst_actual").val(data_category.sliderDst);

                    $(".contImgUpload").each((index, item)=>{
                        $(item).find(".image_remove").val(0);
                        $(item).find(".imagen").val("");
                        $(item).find(".alertImgUpload").html("");
                    });

                    if (data_category.sliderDst != null && data_category.sliderMbl != null) {
                        $(".prevSliderMbl div").html('<img class="imgUpload" src="'+data_category.url_sliderMbl+'">');
                        $(".prevSliderDst div").html('<img class="imgUpload" src="'+data_category.url_sliderDst+'">');
                        $(".delSliderMbl, .delSliderDst").removeClass("notBlock");
                    }else{
                        $(".prevSliderMbl div").html('');
                        $(".prevSliderDst div").html('');
                        $(".delSliderMbl, .delSliderDst").addClass("notBlock");
                    }

                    if (data_category.fatherCategory == null) {
                        ctgListOptions(data_request, 0);

                        $(".prevPhoto div").html('<img class="imgUpload" src="'+data_category.url_photo+'">');
                        $(".prevIcon div").html('<img class="imgUpload" src="'+data_category.url_icon+'">');
                        $(".delPhoto, .delIcon").removeClass("notBlock");

                        $(".contImgUpload").each((index, item)=>{
                            $(item).find(".contImage").removeClass("notBlock");
                            $(item).find(".errorImage").html('');
                        });
                    }else{
                        ctgListOptions(data_request, data_category.option_encrypt);

                        $(".prevPhoto div, .prevIcon div").html('');
                        $(".delPhoto, .delIcon").addClass("notBlock");

                        $(".contImgUpload").each((index, item)=>{
                            $(item).find(".contImage").addClass("notBlock");
                            $(item).find(".errorImage").html('<span><i class="fa-solid fa-circle-info"></i> Las categorias superiores solo pueden contener una imagen.</span>');
                        });
                    }

                }else{
                    msgShow(3, 'Error', data.msg);
                }
            }
        });
    }
}

// --- VIEW CATEGORY --- //
function watch(data){

    $(".modal-header").removeClass("headerUpdate").addClass("headerRegister");
    $(".modal-title").text("Datos de categoria");
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
                console.log(data)
                // let obj_request =  data.data_request; 
                // console.log(obj_request);
                // if (data.status) {
                //     let status = obj_request.status == 1 ? '<span class="bg-success p-1 rounded"><i class="fas fa-user"></i> Activo</span>' : '<span class="bg-danger p-1 rounded"><i class="fas fa-user-slash"></i> Inactivo</span>';
                    
                    // $("#").text(obj_request.);
                    // $("#").text(obj_request.);
                    // $("#").text(obj_request.);
                    // $("#").text(obj_request.);
                    // $("#").text(obj_request.);
                    // $("#").text(obj_request.);
                    // $("#").html(status);
                    // $("#").text(obj_request.);

                //     $('#modalViewCategory').modal('show');
                // }else{
                //     msgShow(3, 'Error', data.msg);
                // }
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

