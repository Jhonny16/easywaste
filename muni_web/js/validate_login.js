/**
 * Created by tito_ on 30/10/2018.
 */
$(document).ready(function () {
    var token = localStorage.getItem('token');
    console.log(token);
    if (token == null){
        window.location = "../index.php";
    }
});

function out_login(){
    swal({
        title: 'Nota',
        text: "Desea Cerrar Sesión?'!",
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#00ACD6',
        cancelButtonColor: '#F4F4F4',
        confirmButtonText: 'Aceptar!',
        cancelButtonText: 'Cancelar!'
    }).then(function (result) {
        if (result.value) {
            localStorage.clear();
            window.location = "../index.php";
        }
    });

}
