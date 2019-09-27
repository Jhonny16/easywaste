/**
 * Created by tito_ on 13/11/2018.
 */
var DIRECCION_WS = "http://localhost/www/muni_api/webservice/";
$(document).ready(function () {
    roles_list();
});
function roles_list(){
    $("#txtrol").empty();
    var ruta = DIRECCION_WS + "roles_list.php";
    console.log(ruta);
    $.ajax({
        type: "get",
        url: ruta,
        data: {},
        success: function (resultado) {
            console.log(resultado);
            var datosJSON = resultado;
            if (datosJSON.estado === 200) {
                var html = "";
                html += '<option value="0">-- Seleccione Rol Usuario --</option>';
                $.each(datosJSON.datos, function (i, item) {
                    html += '<option value="'+ item.id +'">' + item.descripcion +'</option>';
                });
                $("#txtrol").append(html);
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}