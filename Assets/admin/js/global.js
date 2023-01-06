'use strict';

// VALIDATE EMPRY INPUT
function emptyValidate(value){
    return value == undefined || value == false || value == null || value == "" ? true: false;
}

// SHOW MESSAGE - SWEET ALERT
function msgShow(type, title, msg){

    let  icon;
    if(type == 1){icon = 'success'}else if(type == 2){icon = 'warning'}else{icon = 'error'}

    Swal.fire({
        icon: icon,
        title: title,
        text: msg
    })
}

// SHOW PASSWORD
function showPass(obj) {
    let inputPass = document.querySelectorAll('.contPass');
    if (obj.classList.contains('fa-eye-slash')) {
        obj.classList.remove('fa-eye-slash');
        obj.classList.add('fa-eye');
        inputPass.forEach(function (input) {
            input.type = 'text';
        });
    }else{
        obj.classList.add('fa-eye-slash');
        obj.classList.remove('fa-eye');
        inputPass.forEach(function (input) {
            input.type = 'password';
        });
    }
}

// TEST PASSWORD - EXPRESSION REGULAR
function testPass(txtString) {
    var stringText = new RegExp(/^(?=.*\d)(?=.*[a-z]).{8,}$/);
    if (stringText.test(txtString)){
        return true;
    }else{
        return false;
    }
}

// FIRST LETTER IN CAPITAL LETTER
function capitalLetter(text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
}

// RESET THE ID COLUMN OF THE DATA TABLE
function resetIdTable(dataTable) {
    let rows = dataTable.DataTable().rows().nodes();

    for (let i = 0; i < rows.length; i++) {
        let row = $(rows[i]);
        let id = i + 1;
        row.attr("id", "row-" + id);
        row.find("td:first").text(id);
    }
}
