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
                $('#sort-data').attr("data-son", `${data.sons_url}`);
                start = 12;
                if(data.total_products.length > 12 && data.total_products.length > 0){
                    $('.container-pagination-btn').html(`<div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                                            <button id="load-more" onclick="loadMoreProd('${data.sons_url}')" class="load-more time-trans-txt">VER MÁS<div class="cont-load-more"><span class="loader-more-data"></span></div></button>
                                         </div>`);
                }else{
                    $('.container-pagination-btn').html("");
                }

                $('.content-loading').css("display","none");

            }
        });     
    });

    $('#sort-data').change(function(){
        let dataSon = $(this).attr('data-son');
        let elementVal = $(this).val();
        let url_ajax = base_url + "categoria/orderBy/";

        $.ajax({
            url: url_ajax,
            dataType: 'JSON',
            method: 'POST',
            data: {
                dataSon: dataSon,
                elementVal: elementVal,
            },
            success: function(data){
                console.log(data);
            }
        }); 
    });
});

let start = 12;
let perLoad = 4;
let loading = false;

// LOAD MORE PRODUCTS LOADER
function loadMoreProd(dataSon) {

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