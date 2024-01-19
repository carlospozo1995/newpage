$(document).ready(function () {
    var page = 1;
    var loading = false;
    var search = $('#data-search').val();
    var order_val = $("#products-order").val();

    // let brand_check = $('.content-check-brand input[type="checkbox"]:checked');
    // let ids_check = [];
    // for (var i = 0; i < brand_check.length; i++) {
    //     ids_check.push(brand_check[i].id);
    // }

    // LOAD MORE PRODUCTS (BUTTON)
    $('.content-section-page .container-pagination-btn').on('click', '#load-more', function () {

        // Data brand checked
        // let brand_check = $('.content-check-brand input[type="checkbox"]:checked');
        // let ids_check = [];
        // for (var i = 0; i < brand_check.length; i++) {
        //     ids_check.push(brand_check[i].id);
        // }

        // Data range price
        let price_min = $('#slider-range').attr('data-min');
        let price_max = $('#slider-range').attr('data-max');
        
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
                page: page
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
                console.log(ids_check);

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
                        // $('.content-loading').css("display","flex");
                    },
                    success: function (data) {
                        console.log(data);
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    },
                    complete: function () {
                        // $('.content-loading').css("display", "none");
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

