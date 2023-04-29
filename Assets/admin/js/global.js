'use strict';

if($("#loading").length){
    var loading = $("#loading");
}

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

// TEST - EXPRESSION REGULAR
function testExpression(value, regex) {
    if (regex.test(value)){
        return true;
    }else{
        return false;
    }
}

//FUNCTION GENERAL - VALIDATE INPUT(EXPRESION REGULAR)
function validateExpresion() {
    let validElements = document.querySelectorAll(".valid");
    let expresion = "";

    validElements.forEach(function (element) {
        element.addEventListener('keyup', function () {
            let inputValue = this.value;
        
            switch(true){
                case this.classList.contains('valid_text'):
                    expresion = testExpression(inputValue, /^([a-zA-ZÑñÁáÉéÍíÓóÚú\s])*$/);
                break;
                case this.classList.contains('valid_phone'):
                    expresion = testExpression(inputValue, /^([0-9]{7,10})$/);
                break;
                case this.classList.contains('valid_number'):
                    expresion = testExpression(inputValue, /^\d+$/);
                break;
                case this.classList.contains('valid_price'):
                    expresion = testExpression(inputValue, /^\d{1,}[.,]\d{2}$/);
                break;
                case this.classList.contains('valid_email'):
                    expresion = testExpression(inputValue, /^(([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9])+\.)+([a-zA-Z0-9]{2,4}))*$/);
                break;
                case this.classList.contains('valid_password'):
                    expresion = testExpression(inputValue, /^(?=.*\d)(?=.*[a-z]).{8,}$/);
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


// ----- LOADING OF DIFFERENT IMAGES ACCORDING TO THE SECTION ----- //
if ($("#formNewCategory").length || $("#formNewProduct").length) {
    $(".contImgUpload").each((index, item)=>{

        // ADD AND VALIDATE IMAGE
        var imagen = $(item).find(".imagen");
        imagen.change((e)=>{
            var uploadImagen = imagen.val();
            var fileImagen = imagen.prop("files")[0];
            var nav = window.URL || window.webkitURL;
            var alertImagen = $(item).find(".alertImgUpload");

            if (uploadImagen != "") {
                var typeImagen = fileImagen.type;
                var nameImagen = fileImagen.name;

                if (typeImagen != 'image/jpeg' && typeImagen != "image/png" && typeImagen != "image/jpg") {
                    alertImagen.html('<p class="text-danger text-center">El archivo selecionado no es válido. Intentelo de nuevo.</p>');

                    if($(item).find(".imgUpload")){
                        $(item).find(".imgUpload").remove();
                    }

                    $(item).find(".delImgUpload").addClass("notBlock");
                    imagen.val("");
                    return false;
                }else{
                    alertImagen.html("");

                    if($(item).find(".imgUpload")){
                        $(item).find(".imgUpload").remove();
                    }

                    $(item).find(".delImgUpload").removeClass("notBlock");
                    var obj_url = nav.createObjectURL(fileImagen);
                    $(item).find(".prevImgUpload div").html('<img class="imgUpload" src="'+obj_url+'">');
                }
            }else{
                alert("No ha seleccionado una imagen.")
                if($(item).find(".imgUpload")){
                    $(item).find(".imgUpload").remove();
                }
            }

        });
        
        // BTN DELETE IMAGE
        if($(item).find(".delImgUpload")){
            var delImagen = $(item).find(".delImgUpload");
            delImagen.click(()=>{
                $(item).find(".image_remove").val(1);
                removeImage(item);
            });
        }
    });
}

// FUNCTION DELETE IMAGE BTN
function removeImage(item) {
    $(item).find(".imagen").val("");
    $(item).find(".delImgUpload").addClass("notBlock");

    if($(item).find(".imgUpload")){
        $(item).find(".imgUpload").remove();
    }
}
// ------------------------- END -------------------------- //

function numberFormat(number, decimals = 2, decPoint = ',', thousandsSep = '.') {
    return number.toFixed(decimals).replace('.', decPoint).replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSep);
}

$('#session_close').on('click', function () {
    $.ajax({
        url: base_url + "login/logout/",
        // dataType: 'JSON',
        // method: 'POST',
        // data: {
        //     id_product: id,
        //     option: option,
        // },
        beforeSend: function() {
            
        },
        success: function(data){
            window.location.reload(false);
        },
        error: function(xhr, status, error) {
            console.log(error)
        },
        complete: function() {
            
        }
    });  
})