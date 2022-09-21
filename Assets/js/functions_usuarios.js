var tableUsuarios;
document.addEventListener('DOMContentLoaded', function () {


    let formUsuario = document.querySelector("#formUsuario");
    formUsuario.onsubmit = function (e) {
        e.preventDefault();
        var strIdentificacion = document.querySelector('#txtIdentificacion').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var strApellido = document.querySelector('#txtApellido').value;
        var strEmail = document.querySelector('#txtEmail').value;
        var intTelefono = document.querySelector('#txtTelefono').value;
        var intTipousuario = document.querySelector('#listRolid').value;
        var strPassword = document.querySelector('#txtPassword').value;

        if (strIdentificacion == '' || strApellido == '' || strNombre == '' || strEmail == '' || intTelefono == '' || intTipousuario == '') {
            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }

        
        let formData = new FormData(formUsuario);
        let ajaxUrl = base_url + '/Usuarios/setUsuario';
        fetch(ajaxUrl, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(objData => {
                if (objData.status) {
                    $('#modalFormUsuario').modal("hide");
                    formUsuario.reset();
                   // tableUsuarios.ajax.reload(null, false);
                    swal("Usuarios", objData.msg, "success");
                } else {
                    swal("Error", objData.msg, "error");
                }
            })
            .catch(error => {
                swal("Oops!", "Ocurrio un error en el Sistema, por favor intentalo de nuevo más tarde.", "error");
                console.log("Error: ", error)
            })

    }
}, false);


window.addEventListener('load', function () {
    fntRolesUsuario();
    /*fntViewUsuario();
    fntEditUsuario();
    fntDelUsuario();*/

}, false);

//peticion para obtener los roles para el select
function fntRolesUsuario() {
    var ajaxUrl = base_url + '/Roles/getSelectRoles';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#listRolid').innerHTML = request.responseText;
            document.querySelector('#listRolid').value = 1;
            $('#listRolid').selectpicker('render');
        }
    }

}




function openModal() {
    /* document.querySelector('#idUsuario').value ="";
     document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
     document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
     document.querySelector('#btnText').innerHTML ="Guardar";
     document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
     document.querySelector("#formUsuario").reset();*/
    $('#modalFormUsuario').modal('show');
}