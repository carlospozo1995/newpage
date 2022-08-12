function openModalUpdate() {
    $("#modalUpdateUser").modal("show");
    formUpdateUser.reset();
}

let formUpdateUser = document.getElementById('formPerfil');

formPerfil.addEventListener('submit', function (e){
    e.preventDefault();
    var identificacion = document.getElementById("identificacion").value;
    var nombre = document.getElementById("nombre").value;
    var apellido = document.getElementById("apellido").value;
    var telefono = document.getElementById("telefono").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

    if (identificacion == "" || nombre == "" || apellido == "" || telefono == "") {
        Swal.fire("Atención", "Asegúrese de llenar todos los campos.", "error");
        return false;
    }

    if (password != "" || confirmPassword != "") {
        if (password != confirmPassword) {
            Swal.fire("Atención", "Las contraseñas no son iguales.", "info");
            return false;
        }
        if (password.length < 5) {
            Swal.fire("Atención", "La contraseña debe tener un mínimo de 5 caracteres.", "info");
            return false;
        }
    }

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + 'Perfil/updatePerfil';
    var formData = new FormData(formPerfil);
    request.open("POST", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function () {
        if (request.readyState !=4) return;
        if(request.status == 200){
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                $("#modalUpdateUser").modal("hide");
                Swal.fire({
                    title: '',
                    text: objData.msg,
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            }
        }else{
            Swal.fire(
                'Atención!',
                objData.msg,
                'error'
            );
        }
    };



    
}); 