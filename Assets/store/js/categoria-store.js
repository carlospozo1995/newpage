$(document).ready(function() {

    var newUrl = window.location.pathname.replace(/\/{2,}/g, '/').replace(/\/+$/, '');
    if (newUrl !== window.location.pathname) {
        window.history.replaceState({}, '', newUrl);
        location.reload();
    }

  
    $('.category-url').click(function(e){
        e.preventDefault();
        var category = $(this).data('category');
        let url_ajax = base_url + "categoria/loadProducts/";
        $('.page-active').text(category.replace('-', ' ').toUpperCase());
        window.history.replaceState({}, '', $(this).attr('href'));
        
        // $('.content-loading').css("display","flex");
        $.ajax({
            url: url_ajax,
            dataType: 'JSON',
            method: 'POST',
            data: {
                category: category,
            },
            success: function(data){
                console.log(data.content_grid)
                $('#container-products-grid').html(data.content_grid);
                // $('.content-loading').css("display","none");
            }
        });     
        
    });

});
