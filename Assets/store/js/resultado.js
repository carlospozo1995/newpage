$(document).ready(function () {
    // VARIABLES FOR LOADING PRODUCTS
    var start = 10;
    var perLoad = 10;
    var loading = false;

    // $('.content-section-page .container-pagination-btn').on('click', '#load-more', function () {
    //     let data_search = $('#data-store').val();
        
    //     // Data brand checked
    //     let ids_check = [];
    //     if ($('.content-check-brand').length) {
    //         let brand_check = $('.content-check-brand input[type="checkbox"]:checked');
    //         for (var i = 0; i < brand_check.length; i++) {
    //             ids_check.push(brand_check[i].id);
    //         }
    //     }

    //     // Value order by
    //     let order_value = $("#products-order").val();

    //     // Data range price
    //     let price_min = $('#slider-range').attr('data-min');
    //     let price_max = $('#slider-range').attr('data-max');

    //     if(loading){
    //         return;
    //     }

    //     loading = true;
        
    //     $.ajax({
    //         url: base_url + "resultado/loadMoreProducts/",
    //         dataType: 'JSON',
    //         method: 'POST',
    //         data: {
    //             selectVal : order_value,
    //             checkedVal : ids_check,
    //             dataSearch: data_search,
    //             price_min: price_min,
    //             price_max: price_max,
    //             start: start,
    //             perLoad: perLoad
    //         },
    //         beforeSend: function() {
    //             $('.load-more .cont-load-more').css("display", "flex");
    //         },
    //         success: function(data){   
    //             // Print remaining products - different container
    //             // $('#container-products-grid').append(data.content.grid);
    //             // $('#container-products-single').append(data.content.single);
    //             // start += perLoad;

    //             // if (data.remaining <= 0) {
    //             //     $(".page-pagination").remove();
    //             // }
    //             loading = false;
    //         },
    //         error: function(xhr, status, error) {
                
    //         },
    //         complete: function() {
    //             $('.load-more .cont-load-more').css("display", "none");
    //         }
    //     });
    // });

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

})