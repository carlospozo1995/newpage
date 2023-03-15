
$(document).ready(function() {
    var start = 3; // Empezar a cargar los productos a partir del cuarto
    var perLoad = 3; // Cargar tres productos cada vez
    var loading = false;

    $("#load-morep").click(function() {
        if (loading) {
            return;
        }

        loading = true;

        $.ajax({
            url: base_url + "index/loadMore/",
            dataType: 'JSON',
            method: 'POST',
            data: {
                start: start,
                perLoad: perLoad
            },
            success: function(data) {
                console.log(data);
                if (data.contentP) {
                    var $container = $('<div>');
                    $container.html(data.contentP);
                    $("#cont-general").append($container);
                    start += perLoad;
                }

                if (data.countP <= 0) {
                    $("#load-morep").hide();
                }

                loading = false;
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                loading = false;
            }
        });
    });

    // $(window).scroll(function() {
    //     if ($(window).scrollTop() + $(window).height() >= $(document).height() - 200 && !loading) {
    //         $("#load-morep").click();
    //     }
    // });
});
