var DIRECCION_WS = "http://localhost/www/muni_api/webservice/";

$(document).ready(function () {
    code();

});

function code(){
    var ruta = DIRECCION_WS + "code_last.php";
    var token = localStorage.getItem('token');
    $.ajax({
        type: "get",
        headers: {
            token: token
        },
        url: ruta,
        contentType: "application/json",
        data: {},
        success: function (resultado) {
            var datosJSON = resultado;
            console.log(resultado);
            if (datosJSON.estado === 200) {
                $("#code_generate").html(datosJSON.datos.numero);

            } else {
                console.log(resultado);
                //swal("Mensaje del sistema", resultado.mensaje, "warning");
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}