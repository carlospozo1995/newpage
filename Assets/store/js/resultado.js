$(document).ready(function () {
    var page = 1;
    var loading = false;
    var search = $('#data-search').val();

    // ORDER BY PRODUCTS
    $("#products-order").change(function () {
        let this_val =  $(this).val();

        let brand_check = $('.content-check-brand input[type="checkbox"]:checked');
        let ids_check = [];
        for (var i = 0; i < brand_check.length; i++) {
            ids_check.push(brand_check[i].id);
        }

        let price_min = $('#slider-range').attr('data-min');
        let price_max = $('#slider-range').attr('data-max');

        let url_ajax = base_url + "resultado/orderProducts/";

        $.ajax({
            url: url_ajax,
            dataType: 'JSON',
            method: 'POST',
            data: {
                search : search,
                selectOrder: this_val,
                selectBrands: ids_check,
                price_min: price_min,
                price_max: price_max
            },
            beforeSend: function() {
                $('.content-loading').css("display","flex");
            },
            success: function(data){
                $('.page-amount').html(data.total_p+' Productos');

                if (data.total_p > 0) {
                    $('#container-products-grid').html(data.content.grid);
                    $('#container-products-single').html(data.content.single);
                }else{
                    $('#container-products-grid').html(`<div class="error-section">
                                                                    <div class="container">
                                                                        <div class="row">
                                                                            <div class="error-form">
                                                                                <div style="margin-top: 50px; margin-bottom: 50px" data-aos="fade-up" data-aos-delay="0">
                                                                                    <img style="width: 100%" src="${base_url}assets/store/images/not-product.png">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>`);
                    $('#container-products-single').html(`<div class="error-section">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="error-form">
                                                                        <div style="margin-top: 50px; margin-bottom: 50px" data-aos="fade-up" data-aos-delay="0">
                                                                            <img style="width: 100%" src="${base_url}assets/store/images/not-product.png">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>`);
                }
                
                if (data.total_p > 10) {
                    page = 1
                    $('.container-pagination-btn').html(`<div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                                            <button id="load-more" class="load-more time-trans-txt">VER MÁS<div class="cont-load-more"><span class="loader-more-data"></span></div></button>
                                        </div>`);
                }else{
                    $('.container-pagination-btn').html("");
                }
            },
            error: function(xhr, status, error) {
                console.log(error)
            },
            complete: function() {
                $('.content-loading').css("display","none");
            }
        });
    });

    // SHOW PRODUCTS BY BRAND
    $('.content-section-page').on('change', ".content-check-brand input[type='checkbox']", function () {

        let brand_check = $('.content-check-brand input[type="checkbox"]:checked');
        let ids_check = [];
        for (var i = 0; i < brand_check.length; i++) {
            ids_check.push(brand_check[i].id);
        }
        let order_val = $("#products-order").val();

        let url_ajax = base_url + "resultado/orderProducts/";

        $.ajax({
            url: url_ajax,
            dataType: 'JSON',
            method: 'POST',
            data: {
                search: search,
                selectOrder: order_val,
                selectBrands: ids_check,
            },
            beforeSend: function() {
                $('.content-loading').css("display","flex");
            },
            success: function(data){
                $('.page-amount').html(data.total_p+' Productos');

                $('#container-products-grid').html(data.content.grid);
                $('#container-products-single').html(data.content.single);

                if (data.total_p > 10) {
                    page = 1
                    $('.container-pagination-btn').html(`<div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                                            <button id="load-more" class="load-more time-trans-txt">VER MÁS<div class="cont-load-more"><span class="loader-more-data"></span></div></button>
                                        </div>`);
                }else{
                    $('.container-pagination-btn').html("");
                }

                // Price filter products range (no ajax function)
                let price_min = parseFloat(data.price.min) * 100;
                let price_max = parseFloat(data.price.max) * 100;

                $('#slider-range').attr('data-min', price_min / 100);
                $('#slider-range').attr('data-max', price_max / 100);
                priceRange(price_min, price_max);
            },
            error: function(xhr, status, error) {
                console.log(error)
            },
            complete: function() {
                $('.content-loading').css("display","none");
            }
        });
    });

    // LOAD MORE PRODUCTS (BUTTON)
    $('.content-section-page .container-pagination-btn').on('click', '#load-more', function () {

        // Data brand checked
        let brand_check = $('.content-check-brand input[type="checkbox"]:checked');
        let ids_check = [];
        for (var i = 0; i < brand_check.length; i++) {
            ids_check.push(brand_check[i].id);
        }

        // Data range price
        let price_min = $('#slider-range').attr('data-min');
        let price_max = $('#slider-range').attr('data-max');
        
        let order_val = $("#products-order").val();

        if(loading){
            return;
        }

        loading = true;

        $.ajax({
            url: base_url + "resultado/loadMoreProducts/",
            dataType: 'JSON',
            method: 'POST',
            data: {
                search: search,
                page: page,
                selectOrder: order_val,
                selectBrands: ids_check,
                price_min: price_min,
                price_max: price_max
            },
            beforeSend: function() {
                $('.load-more .cont-load-more').css("display", "flex");
            },
            success: function(data){  
                page++;

                $('#container-products-grid').append(data.content.grid);
                $('#container-products-single').append(data.content.single);
                
                if (page === data.nbPage) {
                    $(".page-pagination").remove();
                }

                loading = false;
            },
            error: function(xhr, status, error) {
                console.log(error)
            },
            complete: function() {
                $('.load-more .cont-load-more').css("display", "none");
            }
        });

    });

    /************************************************
    * Price Slider
    ***********************************************/
   
    let price_min = parseFloat($('#slider-range').attr('data-min') * 100);
    let price_max = parseFloat($('#slider-range').attr('data-max') * 100);

    function priceRange(price_min, price_max) {
        let points_range =  $('#slider-range span');
        let progress_line = $('#slider-range .ui-widget-header');

        $("#slider-range").slider({
            range: true,
            min: price_min,
            max: price_max,
            values: [price_min, price_max],
            slide: function(event, ui) {
                $( "#amount" ).val( "$" + ui.values[ 0 ] / 100 + " - $" + ui.values[ 1 ] / 100 );
            },
            stop: function (event, ui) {
                $('#slider-range').attr('data-min', ui.values[0] / 100);
                $('#slider-range').attr('data-max', ui.values[1] / 100);
                
                let brand_check = $('.content-check-brand input[type="checkbox"]:checked');
                let ids_check = [];
                for (var i = 0; i < brand_check.length; i++) {
                    ids_check.push(brand_check[i].id);
                }
           
                let order_val = $("#products-order").val();

                $.ajax({
                    url: base_url + "resultado/rangePriceProducts/",
                    dataType: 'JSON',
                    method: 'POST',
                    data: {
                        search: search,
                        selectOrder: order_val,
                        selectBrands: ids_check,
                        price_min: ui.values[0] / 100,
                        price_max: ui.values[1] / 100
                    }, 
                    beforeSend: function() {
                        $('.content-loading').css("display","flex");
                    },
                    success: function (data) {
                        $('.page-amount').html(data.total_p+' Productos');

                        if (data.total_p > 0) {
                            $('#container-products-grid').html(data.content.grid);
                            $('#container-products-single').html(data.content.single);
                        }else{
                            $('#container-products-grid').html(`<div class="error-section">
                                                                    <div class="container">
                                                                        <div class="row">
                                                                            <div class="error-form">
                                                                                <div style="margin-top: 50px; margin-bottom: 50px" data-aos="fade-up" data-aos-delay="0">
                                                                                    <img style="width: 100%" src="${base_url}assets/store/images/not-product.png">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>`);
                            $('#container-products-single').html(`<div class="error-section">
                                                                    <div class="container">
                                                                        <div class="row">
                                                                            <div class="error-form">
                                                                                <div style="margin-top: 50px; margin-bottom: 50px" data-aos="fade-up" data-aos-delay="0">
                                                                                    <img style="width: 100%" src="${base_url}assets/store/images/not-product.png">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>`);
                        }
                        
                        if (data.total_p > 10) {
                            page = 1
                            $('.container-pagination-btn').html(`<div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                                                    <button id="load-more" class="load-more time-trans-txt">VER MÁS<div class="cont-load-more"><span class="loader-more-data"></span></div></button>
                                                </div>`);
                        }else{
                            $('.container-pagination-btn').html("");
                        }

                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    },
                    complete: function () {
                        $('.content-loading').css("display", "none");
                    }
                });
            }
        });

        $("#amount").val("$" + $("#slider-range").slider("values", 0) / 100 + " - $" + $("#slider-range").slider("values", 1) / 100);

        points_range.eq(0).css('left', '0%');
        if (price_min === price_max) {
            progress_line.css('background', '#efefef');
            points_range.eq(1).css('left', '0%');
        }else{
            progress_line.css('background', 'linear-gradient(to right, #1000c3, #ff6666)');
            points_range.eq(1).css('left', '100%');
        }
    }

    priceRange(price_min, price_max);

});

