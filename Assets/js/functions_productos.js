document.write(`<script src="${base_url}Assets/js/plugins/barcode/JsBarcode.all.min.js"></script>`);

function modalNewProducto(){
    document.querySelector(".modal-header").classList.replace("headerUpdate-mc", "headerRegister-mc");
    document.querySelector(".modal-title").innerHTML = "Nuevo Producto";
    document.getElementById("btnSubmitProducto").classList.replace("bg-success", "btn-primary");
    document.querySelector(".btnText").innerHTML = "Agregar";
    var idProducto = document.getElementById('idProducto').value = "";
    $('#modalFormProducto').modal('show');
    formProducto.reset();
}

// CONFIGURACION TEXTAREA DESCRIPCION -TINYMCE
$(document).on('focusin', function(e) {
    if ($(e.target).closest(".tox-tinymce, .tox-tinymce-aux, .moxman-window, .tam-assetmanager-root").length) {
        e.stopImmediatePropagation();
    }
});

tinymce.init({
    selector: '#txtDescripcion',
    width: "100%",
    height: 400,    
    statubar: true,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
    branding: false,
});
// -------------------------------------------