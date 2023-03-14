$(document).ready(function() {
    var start = 3; // Empezar a cargar los productos a partir del cuarto
    var perLoad = 3; // Cargar tres productos cada vez

    $("#load-more").click(function() {
        $.ajax({
            url: base_url + "index/loadMore/",
            type: "POST",
            data: {
                start: start,
                perLoad: perLoad
            },
            success: function(data) {
                if (data != "") {
                    $("#cont-general").append(data);
                    start += perLoad;
                } else {
                    $("#load-more").hide();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
});
