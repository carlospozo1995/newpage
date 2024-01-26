'use strict';
var tablePedidos;

$(document).ready(function () {
   
    // --- PRINT DATA TABLE USERS --- //
    tablePedidos = $("#tablePedidos").DataTable({
        "aProcessing": true,
        "aServerSide":true,
        "language":{
            "url":"//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        },
        "responsive": true,
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
        // "dom": 'lBfrtip',
        // "buttons": [
        //     "copy", "csv", "excel", "pdf", "print", "colvis"
        // ],
        "bDestroy":true,
        "order":[[0,"asc"]],
        "iDisplayLength":25,
    });

});