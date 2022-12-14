'use strict';

function emptyValidate(value){
    return value == undefined || value == false || value == null || value == "" ? true: false;
}

function msgShow(type, title, msg){

    let  icon;
    if(type == 1){icon = 'success'}else if(type == 2){icon = 'warning'}else{icon = 'error'}

    Swal.fire({
        icon: icon,
        title: title,
        text: msg
    })
}