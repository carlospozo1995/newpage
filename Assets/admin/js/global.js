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

// TEST PASSWORD - EXPRESSION REGULAR
function testPass(txtString) {
    var stringText = new RegExp(/^(?=.*\d)(?=.*[a-z]).{8,}$/);
    if (stringText.test(txtString)){
        return true;
    }else{
        return false;
    }
}

// TEST TEXT - EXPRESSION REGULAR
function testText(txtString) {
    var stringText = new RegExp(/^([a-zA-ZÑñÁáÉéÍíÓóÚú\s])*$/);
    if (stringText.test(txtString)){
        return true;
    }else{
        return false;
    }
}

// TEST NUMBER - EXPRESSION REGULAR
function testNumber(intCant) {
    // var intCantidad = new RegExp(/^([0-9])*$/);
    var intCantidad = new RegExp(/^([0-9]{7,10})$/);
    if (intCantidad.test(intCant)){
        return true;
    }else{
        return false;
    }
}

// TEST EMAIL - EXPRESSION REGULAR
function testEmail(email) {
    var stringEmail = new RegExp(/^(([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9])+\.)+([a-zA-Z0-9]{2,4}))*$/);
    if (stringEmail.test(email) == false){
        return false;
    }else{
        return true;
    }
}

// FUNCTION GENERAL - VALIDATE INPUT(EXPRESION REGULAR)
function validateExpresion() {
    let validElements = document.querySelectorAll(".valid");
    let expresion = "";

    validElements.forEach(function (element) {
        element.addEventListener('keyup', function () {
            let inputValue = this.value;
        
            switch(true){
                case this.classList.contains('valid_text'):
                    expresion = testText(inputValue);
                break;
                case this.classList.contains('valid_number'):
                    expresion = testNumber(inputValue);
                break;
                case this.classList.contains('valid_email'):
                    expresion = testEmail(inputValue);
                break;
                default:
                    return false;
                break;
            }

            if (inputValue != "") {
                if (!expresion) {
                    this.classList.add('is-invalid');
                }else{
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            }else{
                this.classList.remove('is-invalid');   
                this.classList.remove('is-valid');
            }
        })
    });
}

function validFocus() {
    let validElements = document.querySelectorAll(".valid");
    validElements.forEach(function (element) {
        element.classList.remove("is-invalid");
        element.classList.remove("is-valid");
    });
}

window.addEventListener('load', function () {
    validateExpresion();
}, false);
