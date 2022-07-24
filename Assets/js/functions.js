
function controlTag(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 8) return true;
    else if(tecla == 0 || tecla == 9) return true;
    patron = /[0-9\s]/;
    n =  String.fromCharCode(tecla);
    return patron.test(n);
}

function testText(txtString) {
    var stringText = new RegExp(/^([a-zA-ZÑñÁáÉéÍíÓóÚú\s])*$/);
    if (stringText.test(txtString)){
        return true;
    }else{
        return false;
    }
}

function testEntero(intCant) {
    var intCantidad = new RegExp(/^([0-9])*$/);
    if (intCantidad.test(intCant)){
        return true;
    }else{
        return false;
    }
}

function emailValidate(email) {
    var stringEmail = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9])+\.)+([a-zA-Z0-9]{2,4})+$/);
    if (stringEmail.test(email) == false){
        return false;
    }else{
        return true;
    }
}

function validText() {
    let validText = document.querySelectorAll(".validText");
    validText.forEach(function (validText) {
        validText.addEventListener('keyup', function () {
            let inputValue = this.value;
            if (!testText(inputValue)) {
                this.classList.add('is-invalid');
            }else{
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
                if(inputValue == ''){
                    this.classList.remove('is-valid');
                }
            }
        });
    });
}

function validNumber() {
    let validNumber  = document.querySelectorAll(".validNumber");
    validNumber.forEach(function (validNumber) {
        validNumber.addEventListener('keyup', function () {
            let inputValue = this.value;
            if (!testEntero(inputValue)) {
                this.classList.add('is-invalid');
            }else{
                this.classList.remove('is-invalid');
            }
        });
    });
}

function validEmail() {
    let validEmail  = document.querySelectorAll(".validEmail");
    validEmail.forEach(function (validEmail) {
        validEmail.addEventListener('keyup', function () {
            let inputValue = this.value;
            if (!emailValidate(inputValue)) {
                this.classList.add('is-invalid')
                if (inputValue == "") {
                    this.classList.remove('is-invalid');
                    this.classList.remove('is-valid');
                };
            }else{
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });
    });
}

window.addEventListener('load', function () {
    validText();
    validNumber();
    validEmail();
}, false)