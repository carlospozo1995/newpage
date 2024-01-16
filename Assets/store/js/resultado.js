$(document).ready(function () {
    $('.content-section-page .container-pagination-btn').on('click', '#load-more', function () {
    
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

