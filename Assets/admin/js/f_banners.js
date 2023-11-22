$(document).ready(function () {

    $("#formSliderMCtg").submit(function (e) {
        addBannerCtg(e, $(this).find(".type-imageCtg").val(), $(this).find(".select_options").val(), "tableSliderMCtg");
    });

    $("#formBannerLCtg").submit(function (e) {
        addBannerCtg(e, $(this).find(".type-imageCtg").val(), $(this).find(".select_options").val(), "tableBannerLCtg");
    });

    $("#formBannerSCtg").submit(function (e) {
        addBannerCtg(e, $(this).find(".type-imageCtg").val(), $(this).find(".select_options").val(), "tableBannerSCtg");
    });

    $("#formSliderMProd").submit(function (e) {
        addBannerProd(e, $(this).find(".type-imageProd").val(), $(this).find(".select_options").val(), "tableSliderMProd");
    });

    $(".select_options").select2();

})

function addBannerCtg(e, typeB, selectB, table) {
    if (typeB == "" || selectB == "") {
        msgShow(3, 'Error', "Ha ocurrido un error. Inténtelo de nuevo.");
    }else{
        loading.css("display","flex");

        $.ajax({
            url: base_url + "banners/insertBannerCtg/",
            dataType: 'JSON',
            method: 'POST',
            data: {
                id: selectB,
                type: typeB
            },
            beforeSend: function() {
            },
            success: function(data){

                if (data.status) {
                    let id_row = $("#"+table+"").DataTable().rows().count() + 1;
                    let btnDelete = "";
                    var newRow;

                    let id_banner = data.request.id;
                    let module_data = data.request.module;
                    let id_user = data.request.id_user;

                    if (id_user == 1 && module_data.eliminar == 1){
                        btnDelete = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteData(this, '+"'"+id_banner+"'"+', '+"'"+table+"'"+', '+typeB+')" tilte="Eliminar"><i class="fa-solid fa-trash"></i></button>';
                    }

                    if (typeB == 1) {
                        var newRow = $("#"+table+"").DataTable().row.add([
                            id_row,
                            data.request.name,
                            '<img class="text-center" style="display:flex; margin:auto; width:60px" src="' + data.request.sliderDst + '">',
                            '<img class="text-center" style="display:flex; margin:auto; width:40px" src="' + data.request.sliderMbl + '">',
                            '<div class="text-center"> '+btnDelete+'</div>',
                        ]).draw(false).node();
                    }else if (typeB == 2) {
                        var newRow = $("#"+table+"").DataTable().row.add([
                            id_row,
                            data.request.name,
                            '<img class="text-center" style="display:flex; margin:auto; width:40px" src="'+data.request.bLarge+'">',
                            '<div class="text-center"> '+btnDelete+'</div>',
                        ]).draw(false).node();
                    }else{
                        var newRow = $("#"+table+"").DataTable().row.add([
                            id_row,
                            data.request.name,
                            '<img class="text-center" style="display:flex; margin:auto; width:60px" src="'+data.request.bSmall+'">',
                            '<div class="text-center"> '+btnDelete+'</div>',
                        ]).draw(false).node();
                    }
                    $(newRow).attr("id", id_banner);

                    msgShow(1, 'Banners Category', data.msg);
                }else{
                    msgShow(2, 'Atención', data.msg);
                }

                loading.css("display","none");
            },
            error: function(xhr, status, error) {
                console.log(error);
            },
            complete: function() {
            }
        });
    }
    e.preventDefault();
}

function addBannerProd(e, typeB, selectB, table) {
    if (typeB == "" || selectB == "") {
        msgShow(3, 'Error', "Ha ocurrido un error. Inténtelo de nuevo.");
    }else{
        loading.css("display","flex");

        $.ajax({
            url: base_url + "banners/insertBannerProd/",
            dataType: 'JSON',
            method: 'POST',
            data: {
                id: selectB,
                type: typeB
            },
            beforeSend: function() {
            },
            success: function(data){

                if (data.status) {
                    let id_row = $("#"+table+"").DataTable().rows().count() + 1;
                    let btnDelete = "";
                    var newRow;

                    let id_banner = data.request.id;
                    let module_data = data.request.module;
                    let id_user = data.request.id_user;

                    if (id_user == 1 && module_data.eliminar == 1){
                        btnDelete = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteData(this, '+"'"+id_banner+"'"+', '+"'"+table+"'"+', '+typeB+')" tilte="Eliminar"><i class="fa-solid fa-trash"></i></button>';
                    }

                    if (typeB == 1) {
                        var newRow = $("#"+table+"").DataTable().row.add([
                            id_row,
                            data.request.name,
                            '<img class="text-center" style="display:flex; margin:auto; width:60px" src="' + data.request.sliderDst + '">',
                            '<img class="text-center" style="display:flex; margin:auto; width:40px" src="' + data.request.sliderMbl + '">',
                            '<div class="text-center"> '+btnDelete+'</div>',
                        ]).draw(false).node();
                    }
                    // else if (typeB == 2) {
                    //     var newRow = $("#"+table+"").DataTable().row.add([
                    //         id_row,
                    //         data.request.name,
                    //         '<img class="text-center" style="display:flex; margin:auto; width:40px" src="'+data.request.bLarge+'">',
                    //         '<div class="text-center"> '+btnDelete+'</div>',
                    //     ]).draw(false).node();
                    // }else{
                    //     var newRow = $("#"+table+"").DataTable().row.add([
                    //         id_row,
                    //         data.request.name,
                    //         '<img class="text-center" style="display:flex; margin:auto; width:60px" src="'+data.request.bSmall+'">',
                    //         '<div class="text-center"> '+btnDelete+'</div>',
                    //     ]).draw(false).node();
                    // }
                    $(newRow).attr("id", id_banner);

                    msgShow(1, 'Banners Product', data.msg);
                }else{
                    msgShow(2, 'Atención', data.msg);
                }

                loading.css("display","none");
            },
            error: function(xhr, status, error) {
                console.log(error);
            },
            complete: function() {
            }
        });
    }
    e.preventDefault();
}

function deleteData(element, data, tname, type) {
    Swal.fire({
        title: 'Eliminar Banner',
        text: "Realmente quiere eliminar el banner!",
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
                let url_ajax = base_url + "banners/delBannerCtg/";
                        
                $.ajax({
                    url: url_ajax,
                    dataType: 'JSON',
                    method: 'POST',
                    data: {
                        id: data,
                        typeBanner: type
                    },  
                    success: function(data){
                        if (data.status) {
                            let row_closest = $(element).closest("tr");
                            if(row_closest.length){
                                let ischild = $(row_closest).hasClass("child");
                                if(ischild){
                                    let prevtr = row_closest.prev();
                                    if(prevtr.length){
                                        $("#"+tname+"").DataTable().row(prevtr[0]).remove().draw(false);
                                    }
                                }
                                else{
                                    $("#"+tname+"").DataTable().row(row_closest[0]).remove().draw(false);
                                }
                            }

                            // Reset the id column
                            resetIdTable($("#"+tname+""));
                            
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
