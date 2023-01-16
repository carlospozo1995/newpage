'use strict';
$(document).ready(function(){
    if ($("#btnNewCategory").length) {
            $("#btnNewCategory").click(function () {
                $('#modalFormCategory').modal('show');
            });
    }
});