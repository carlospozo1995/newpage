$(document).ready(function () {
    // VARIABLES FOR LOADING PRODUCTS
    var start = 10;
    var perLoad = 10;
    var loading = false;

    // MODIFY URL
    var newUrl = window.location.pathname.replace(/\/{2,}/g, '/').replace(/\/+$/, '');
    if(newUrl != window.location.pathname){
        window.history.replaceState({}, '', newUrl);
        location.reload();
    }

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
                if(data.total_products.length > 0){
                    // Reset navigation page
                    $('.navigation-page').html(html_nav);
                    // Reset total products displayed
                    $('.page-amount').html(data.total_products.length+' Productos');

                    // Reset order products
                    $('#products-order').attr("data-sons", `${data.sons}`);
                    $("#products-order").val('default');
                    $("#products-order").niceSelect('update');

                    // Print products - different container
                    $('#container-products-grid').html(data.content.grid);
                    $('#container-products-single').html(data.content.single);

                    // Add button load more products
                    if (data.total_products.length > 10) {
                        start = 10;
                        $('.container-pagination-btn').html(`<div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                                            <button id="load-more" class="load-more time-trans-txt" data-sons="${data.sons}">VER MÁS<div class="cont-load-more"><span class="loader-more-data"></span></div></button>
                                         </div>`);
                    }else{
                        $('.container-pagination-btn').html("");
                    }

                    // Price filter products range
                        let price_column = data.total_products.map(function(product) {
                            return product.price;
                        });
                        let price_min = parseInt(Math.min.apply(null, price_column));
                        let price_max = parseInt(Math.max.apply(null, price_column));

                        $('#slider-range').attr('data-min', price_min);
                        $('#slider-range').attr('data-max', price_max);


                        priceRange(price_min, price_max);

                    // Add marks products
                    const countBrand = {};
                    for (const product of data.total_products){
                        if(countBrand[product.brand]){
                            countBrand[product.brand]++;
                        }else{
                            countBrand[product.brand] = 1;
                        }
                    }

                    let contentList = "";
                    for (const brand in countBrand){
                        const checkbox = `<label class="checkbox-default" for="${brand.toLowerCase()}">
                                              <input type="checkbox" id="${brand.toLowerCase()}">
                                              <span>${brand} (${countBrand[brand]})</span>
                                          </label>`;
                        const li = $('<li></li>').append(checkbox);
                        contentList += li.prop('outerHTML');
                    }
                    $(".content-check-brand").html(contentList);
                    $(".content-check-brand").attr('data-sons', data.sons);

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
        let sons_category = $(this).attr('data-sons');
        let this_val = $(this).val();

        // Data brand checked
        let brand_check = $('.content-check-brand input[type="checkbox"]:checked');
        var ids_check = [];
        for (var i = 0; i < brand_check.length; i++) {
            ids_check.push(brand_check[i].id);
        }

        let url_ajax = base_url + "categoria/orderProducts/";

        $.ajax({
            url: url_ajax,
            dataType: 'JSON',
            method: 'POST',
            data: {
                selectVal : this_val,
                checkedVal : ids_check,
                sons: sons_category,
            },
            beforeSend: function() {
                $('.content-loading').css("display","flex");
            },
            success: function(data){
                // Reset total products displayed
                $('.page-amount').html(data.total_products.length+' Productos');

                $('#container-products-grid').html(data.content.grid);
                $('#container-products-single').html(data.content.single);

                if (data.total_products.length > 10) {
                        start = 10;
                        $('.container-pagination-btn').html(`<div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                                            <button id="load-more" class="load-more time-trans-txt" data-sons="${sons_category}">VER MÁS<div class="cont-load-more"><span class="loader-more-data"></span></div></button>
                                         </div>`);
                }else{
                    $('.container-pagination-btn').html("");
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
        let sons_category = $('.content-check-brand').attr('data-sons');
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
                $('.page-amount').html(data.total_products.length+' Productos');

                $('#container-products-grid').html(data.content.grid);
                $('#container-products-single').html(data.content.single);

                 if (data.total_products.length > 10) {
                        start = 10;
                        $('.container-pagination-btn').html(`<div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                                            <button id="load-more" class="load-more time-trans-txt" data-sons="${sons_category}">VER MÁS<div class="cont-load-more"><span class="loader-more-data"></span></div></button>
                                         </div>`);
                }else{
                    $('.container-pagination-btn').html("");
                }
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
        // Data brand checked
        let brand_check = $('.content-check-brand input[type="checkbox"]:checked');
        let ids_check = [];
        for (var i = 0; i < brand_check.length; i++) {
            ids_check.push(brand_check[i].id);
        }

        // Value order by
        let order_value = $("#products-order").val();

        let sons_category = $(this).data('sons');

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

});

/************************************************
* Price Slider
***********************************************/
let price_min = parseInt($('#slider-range').attr('data-min'));
let price_max = parseInt($('#slider-range').attr('data-max'));

function priceRange(price_min, price_max) {
    let points_range =  $('#slider-range span');
    let progress_line = $('#slider-range .ui-widget-header');

    $("#slider-range").slider({
        range: true,
        min: price_min,
        max: price_max,
        values: [price_min, price_max],
        slide: function(event, ui) {
            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
        }
    });

    $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));

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