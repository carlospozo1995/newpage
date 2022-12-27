// LOGIN FLIPPED - RESET PASSWORD
'use strict';

$(document).ready(function(){

	var tableRoles;

    

    if ($("#btnNewRol")) {
        $("#btnNewRol").click(function () {
            $('#modalFormRol').modal('show');
        });
    }

  	tableRoles = $("#tableRoles").DataTable({
        "aProcessing": true,
        "aServerSide":true,
        "language":{
            "url":"//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        },
        "responsive": true,
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
        "dom": 'lBfrtip',
        "buttons": [
            "copy", "csv", "excel", "pdf", "print", "colvis"
        ],
        "bDestroy":true,
        "order":[[0,"asc"]],
        "iDisplayLength":10,
    });
});

function permissions(data) {
    if (!data) {
        return false;
    }else{
        let url_ajax = base_url + "permissions/getPermissions/";
                
        $.ajax({
            url: url_ajax,
            dataType: 'JSON',
            method: 'POST',
            data: {
                data: data,
            },
            success: function(data){
                console.log(data.name);
            },
            error: function(e){
                console.log(e);
            },
            beforeSend: function(){
                // console.log("antes completar");
            },
            complete: function(){
                // console.log("completado");
            }
        });
    }
}