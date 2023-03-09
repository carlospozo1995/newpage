$(document).ready(function() {

    var newUrl = window.location.pathname.replace(/\/{2,}/g, '/')
                                      .replace(/\/+$/, '');
    if (newUrl !== window.location.pathname) {
        window.history.replaceState({}, '', newUrl);
        location.reload();
    }

  
    $('.category-url').click(function(e){
        e.preventDefault();

        var category = $(this).data('category');
        let url_ajax = base_url + "categoria/loadProducts/";
        
        $.ajax({
            url: url_ajax,
            dataType: 'JSON',
            method: 'POST',
            data: {
                category: category,
            },
            success: function(data){
             console.log(data);
                // $('#contenedorProductos').html(data);
            }
        });     
    });

});
