$(document).ready(function () {
    // VARIABLES FOR LOADING PRODUCTS
    var start = 10;
    var perLoad = 10;
    var loading = false;

    // LOAD PRODUCTS BY CATEGORIES
    $('.category-url').click(function (e) {
        e.preventDefault();

        var element = $(this);
        var dataElement = element.data('category');
        let url_ajax = base_url + "categoria/loadProducts/";

        const url = element.attr('href');
        const match = url.match(/categoria\/(.*)/);

        if (match) {
            const category = match[1];
            const categoryArr = category.split('/');

            var html_nav = '<li><a href="' + base_url + '">HOME</a></li>';

            for (let i = 0; i < categoryArr.length; i++) {
                const value = categoryArr[i];
                const label = value.replace("-", " ").toUpperCase();
              
                if (i === categoryArr.length - 1) {
                    html_nav += '<li class="active">' + label + '</li>';
                } else {
                    let index = url.indexOf(value);
                    if (index !== -1) {
                        var href_data = url.substring(0, index + value.length);
                    }
                    html_nav += '<li><a href="'+href_data+'">' + label + '</a></li>';
                }
            }
        }
        
        $.ajax({
            url: url_ajax,
            dataType: 'JSON',
            method: 'POST',
            data: {
                category: dataElement,
            },
            beforeSend: function() {
                $('.content-loading').css("display","flex");
                $('.sidebar-content .cont-load-more').css("display", "flex");
            },
            success: function(data){       
                window.history.replaceState({}, '', element.attr('href'));
                if(data.products_summary != "" && Array.isArray(data.products_summary)){
                    // Reset data store
                    $('#data-store').val(data.sons);
                    // Reset navigation page
                    $('.navigation-page').html(html_nav);
                    // Reset total products displayed
                    $('.page-amount').html(data.products_summary[0]['amount_products']+' Productos');
                   
                    // Reset order products
                    $("#products-order").val('default');
                    $("#products-order").niceSelect('update');

                    // Print products - different container
                    $('#container-products-grid').html(data.content.grid);
                    $('#container-products-single').html(data.content.single);

                    // Add button load more products
                    if (data.products_summary[0]['amount_products'] > 10) {
                        start = 10;
                        $('.container-pagination-btn').html(`<div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                                            <button id="load-more" class="load-more time-trans-txt">VER MÁS<div class="cont-load-more"><span class="loader-more-data"></span></div></button>
                                         </div>`);
                    }else{
                        $('.container-pagination-btn').html("");
                    }

                    // Price filter products range
                    let price_min = parseFloat(data.products_summary[0]['price_min'] * 100);
                    let price_max = parseFloat(data.products_summary[0]['price_max'] * 100);

                    $('#slider-range').attr('data-min', price_min / 100);
                    $('#slider-range').attr('data-max', price_max / 100);
                    priceRange(price_min, price_max);
                    
                    // Add marks products
                    let contentList = "";
                    data.amount_brands.forEach(element => {
                        const checkbox = `<label class="checkbox-default" for="${element.brand.toLowerCase()}">
                                              <input type="checkbox" id="${element.brand.toLowerCase()}">
                                              <span>${element.brand} (${element.amount})</span>
                                          </label>`;
                        const li = $('<li></li>').append(checkbox);
                        contentList += li.prop('outerHTML');
                    });
                    $(".content-check-brand").html(contentList);

                }else{
                    $('.content-section-page').html(data.content);
                }
            },
            error: function(xhr, status, error) {
                
            },
            complete: function() {
                $('.content-loading').css("display","none");
                $('.sidebar-content .cont-load-more').css("display", "none");
            }
        });
    });

    // ORDER BY PRODUCTS
    $("#products-order").change(function () {
        let sons_category = $('#data-store').val();
        let this_val = $(this).val();

        // Data brand checked
        let brand_check = $('.content-check-brand input[type="checkbox"]:checked');
        var ids_check = [];
        for (var i = 0; i < brand_check.length; i++) {
            ids_check.push(brand_check[i].id);
        }

        // Data range price
        let price_min = $('#slider-range').attr('data-min');
        let price_max = $('#slider-range').attr('data-max');

        let url_ajax = base_url + "categoria/orderProducts/";

        $.ajax({
            url: url_ajax,
            dataType: 'JSON',
            method: 'POST',
            data: {
                selectVal : this_val,
                checkedVal : ids_check,
                price_min: price_min,
                price_max: price_max,
                sons: sons_category,
            },
            beforeSend: function() {
                $('.content-loading').css("display","flex");
            },
            success: function(data){
                // Reset total products displayed
                if (data.content != "") {
                    $('#container-products-grid').html(data.content.grid);
                    $('#container-products-single').html(data.content.single);

                    if (data.products_summary[0]['amount_products'] > 10) {
                        start = 10;
                        $('.container-pagination-btn').html(`<div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                                            <button id="load-more" class="load-more time-trans-txt">VER MÁS<div class="cont-load-more"><span class="loader-more-data"></span></div></button>
                                        </div>`);
                    }else{
                        $('.container-pagination-btn').html("");
                    }
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

            },
            error: function(xhr, status, error) {
                
            },
            complete: function() {
                $('.content-loading').css("display","none");
            }
        });

    });

    // SHOW PRODUCTS BY BRAND
    $('.content-section-page').on('change', ".content-check-brand input[type='checkbox']", function () {
        // Data brand checked
        let sons_category = $('#data-store').val();
        let brand_check = $('.content-check-brand input[type="checkbox"]:checked');
        let ids_check = [];
        for (var i = 0; i < brand_check.length; i++) {
            ids_check.push(brand_check[i].id);
        }

        // Value order by
        let order_value = $("#products-order").val();

        let url_ajax = base_url + "categoria/orderProducts/";

        $.ajax({
            url: url_ajax,
            dataType: 'JSON',
            method: 'POST',
            data: {
                selectVal : order_value,
                checkedVal : ids_check,
                sons: sons_category,
            },
            beforeSend: function() {
                $('.content-loading').css("display","flex");
            },
            success: function(data){  
                // Reset total products displayed
                $('.page-amount').html(data.products_summary[0]['amount_products']+' Productos');

                $('#container-products-grid').html(data.content.grid);
                $('#container-products-single').html(data.content.single);

                if (data.products_summary[0]['amount_products'] > 10) {
                        start = 10;
                        $('.container-pagination-btn').html(`<div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                                            <button id="load-more" class="load-more time-trans-txt">VER MÁS<div class="cont-load-more"><span class="loader-more-data"></span></div></button>
                                         </div>`);
                }else{
                    $('.container-pagination-btn').html("");
                }

                // Price filter products range (no ajax function)
                let price_min =parseFloat(data.products_summary[0]['price_min']) * 100;
                let price_max =parseFloat(data.products_summary[0]['price_max']) * 100;

                $('#slider-range').attr('data-min', price_min / 100);
                $('#slider-range').attr('data-max', price_max / 100);
                priceRange(price_min, price_max);

            },
            error: function(xhr, status, error) {
                
            },
            complete: function() {
                $('.content-loading').css("display","none");
            }
        });

    });

    // LOAD MORE PRODUCTS (BUTTON)
    $('.content-section-page .container-pagination-btn').on('click', '#load-more', function () {
        let sons_category = $('#data-store').val();

        // Data brand checked
        let brand_check = $('.content-check-brand input[type="checkbox"]:checked');
        let ids_check = [];
        for (var i = 0; i < brand_check.length; i++) {
            ids_check.push(brand_check[i].id);
        }

        // Value order by
        let order_value = $("#products-order").val();

        // Data range price
        let price_min = $('#slider-range').attr('data-min');
        let price_max = $('#slider-range').attr('data-max');

        if(loading){
            return;
        }

        loading = true;

        $.ajax({
            url: base_url + "categoria/loadMoreProducts/",
            dataType: 'JSON',
            method: 'POST',
            data: {
                selectVal : order_value,
                checkedVal : ids_check,
                sons: sons_category,
                price_min: price_min,
                price_max: price_max,
                start: start,
                perLoad: perLoad
            },
            beforeSend: function() {
                $('.load-more .cont-load-more').css("display", "flex");
            },
            success: function(data){   
                // Print remaining products - different container
                $('#container-products-grid').append(data.content.grid);
                $('#container-products-single').append(data.content.single);
                start += perLoad;

                if (data.remaining <= 0) {
                    $(".page-pagination").remove();
                }
                loading = false;
            },
            error: function(xhr, status, error) {
                
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
            stop: function(event, ui) {
                $('#slider-range').attr('data-min', ui.values[0] / 100)
                $('#slider-range').attr('data-max', ui.values[1] / 100)

                let sons_category = $('#data-store').val();

                // Data brand checked
                let brand_check = $('.content-check-brand input[type="checkbox"]:checked');
                let ids_check = [];
                for (var i = 0; i < brand_check.length; i++) {
                    ids_check.push(brand_check[i].id);
                }

                // Value order by
                let order_value = $("#products-order").val();
                $.ajax({
                    url: base_url + "categoria/rangePriceProducts/",
                    dataType: 'JSON',
                    method: 'POST',
                    data: {
                        selectVal : order_value,
                        checkedVal : ids_check,
                        sons: sons_category,
                        price_min: ui.values[0] / 100,
                        price_max: ui.values[1] / 100,
                    },
                    beforeSend: function() {
                        $('.content-loading').css("display","flex");
                    },
                    success: function(data){
                        $('.page-amount').html(data.products_summary[0]['amount_products']+' Productos');

                        if (data.content != "") {
                            $('#container-products-grid').html(data.content.grid);
                            $('#container-products-single').html(data.content.single);

                            if (data.products_summary[0]['amount_products'] > 10) {
                                start = 10;
                                $('.container-pagination-btn').html(`<div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                                                    <button id="load-more" class="load-more time-trans-txt">VER MÁS<div class="cont-load-more"><span class="loader-more-data"></span></div></button>
                                                </div>`);
                            }else{
                                $('.container-pagination-btn').html("");
                            }
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
                       
                    },
                    error: function(xhr, status, error) {
                    },
                    complete: function() {
                        $('.content-loading').css("display","none");
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

