$(document).ready(function() {

    // MODIFY URL
    var newUrl = window.location.pathname.replace(/\/{2,}/g, '/').replace(/\/+$/, '');
    if (newUrl !== window.location.pathname) {
        window.history.replaceState({}, '', newUrl);
        location.reload();
    }

    //LOAD PRODUCTS BY CATEGORY 
    $('.category-url').click(function(e){
        e.preventDefault();
        var element = $(this) 
        var category = element.data('category');
        let url_ajax = base_url + "categoria/loadProducts/";

        $('.content-loading').css("display","flex");
        $.ajax({
            url: url_ajax,
            dataType: 'JSON',
            method: 'POST',
            data: {
                category: category,
            },
            success: function(data){
                $('.page-active').text(category.replace('-', ' ').toUpperCase());
                window.history.replaceState({}, '', element.attr('href'));
                $('#container-products-grid').html(data.content_grid);
                $('#container-products-single').html(data.content_single);
                
                // Cambios de datos para el ordenamineto de los productos
                $('#sort-data').attr("data-son", `${data.sons_url}`);
                $("#sort-data").val('default');
                $("#sort-data").niceSelect('update');

                start = 10;
                if(data.total_products.length > 10 && data.total_products.length > 0){
                    $('.container-pagination-btn').html(`<div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                                            <button id="load-more" onclick="loadMoreProd('${data.sons_url}')" class="load-more time-trans-txt">VER MÁS<div class="cont-load-more"><span class="loader-more-data"></span></div></button>
                                         </div>`);
                }else{
                    $('.container-pagination-btn').html("");
                }

                if(data.total_products != ""){
                    const countBrand = {};
                    for (const product of data.total_products){
                        if(countBrand[product.brand]){
                            countBrand[product.brand]++;
                        }else{
                            countBrand[product.brand] = 1;
                        }
                    }

                    const listBrand = $('<ul class="content-check-brand"></ul>');
                    for (const brand in countBrand){
                        const li = $('<li></li>');
                        const checkbox = `<label class="checkbox-default" for="${brand.toLowerCase()}">
                                              <input type="checkbox" id="${brand.toLowerCase()}">
                                              <span>${brand} (${countBrand[brand]})</span>
                                          </label>`;
                        li.append(checkbox);
                        listBrand.append(li);
                    }
                    $(".filter-type-select").html(listBrand);

                    if (data.total_products.length > 5) {
                        listBrand.addClass("brand-total");
                    }

                    $('.filter-type-select .content-check-brand').attr("data-son", `${data.sons_url}`);
                }else{
                    $(".filter-type-select").html("");
                }

                $('.content-loading').css("display","none");

            }
        });     
    });

    $('#sort-data').change(function(){
        let dataSon = $(this).attr('data-son');
        let elementVal = $(this).val();
        let url_ajax = base_url + "categoria/orderBy/";
        $('.content-loading').css("display","flex");
        $.ajax({
            url: url_ajax,
            dataType: 'JSON',
            method: 'POST',
            data: {
                dataSon: dataSon,
                elementVal: elementVal,
            },
            success: function(data){
                $('#container-products-grid').html(data.content_grid);
                $('#container-products-single').html(data.content_single);
                $('.content-check-brand input[type="checkbox"]').removeAttr("checked");
                start = 10;
                if(data.total_products.length > 10 && data.total_products.length > 0){
                    $('.container-pagination-btn').html(`<div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                                            <button id="load-more" onclick="loadMoreProd('${dataSon}')" class="load-more time-trans-txt">VER MÁS<div class="cont-load-more"><span class="loader-more-data"></span></div></button>
                                         </div>`);
                }else{
                    $('.container-pagination-btn').html("");
                }

                $('.content-loading').css("display","none");
            }

        }); 
    });

    $('.filter-type-select').on("change", ".content-check-brand input[type='checkbox']", function(){
        let inputsCheck = $('.content-check-brand input[type="checkbox"]:checked');
        let checkedId = [];
        for (var i = 0; i < inputsCheck.length; i++) {
            checkedId.push(inputsCheck[i].id);
        }
        let dataSon = $('body .content-check-brand').attr('data-son');
        $('.content-loading').css("display","flex");
        $.ajax({
            url: base_url + "categoria/checkedBrand/",
            dataType: 'JSON',
            method: 'POST',
            data: {
                dataSon: dataSon,
                checkedId: checkedId
            },
            success: function(data) { 
                $('#container-products-grid').html(data.content_grid);
                $('#container-products-single').html(data.content_single);
                
                $("#sort-data").val('default');
                $("#sort-data").niceSelect('update');
                start = 10;
                if(data.total_products.length > 10 && data.total_products.length > 0){
                    $('.container-pagination-btn').html(`<div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                                            <button id="load-more" onclick="loadMoreProd('${dataSon}')" class="load-more time-trans-txt">VER MÁS<div class="cont-load-more"><span class="loader-more-data"></span></div></button>
                                         </div>`);
                }else{
                    $('.container-pagination-btn').html("");
                }
                $('.content-loading').css("display","none");
            }
        });        
    })
});

let start = 10;
let perLoad = 10;
let loading = false;

// LOAD MORE PRODUCTS LOADER
function loadMoreProd(dataSon) {
    var sortData = $("#sort-data").val();
    let inputsCheck = $('.content-check-brand input[type="checkbox"]:checked');
    let checkedId = [];
    for (var i = 0; i < inputsCheck.length; i++) {
        checkedId.push(inputsCheck[i].id);
    }

    if(loading){
        return;
    }

    loading = true;
    $('.cont-load-more').css("display", "flex");
    $.ajax({
        url: base_url + "categoria/loadMoreData/",
        dataType: 'JSON',
        method: 'POST',
        data: {
            checkedId: checkedId,
            sortData: sortData,
            dataSon: dataSon,
            start: start,
            perLoad: perLoad
        },
        success: function(data) { 
            $('#container-products-grid').append(data.content_grid);
            $('#container-products-single').append(data.content_single);
            start += perLoad;

            if (data.remaining <= 0) {
                $(".page-pagination").remove();
            }
            loading = false;
            $('.cont-load-more').css("display", "none");
        }
    });
};
