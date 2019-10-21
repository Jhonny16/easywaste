var DIRECCION_WS = "http://localhost/www/muni_api/webservice/";
$(document).ready(function () {
    vigencia();

});

function vigencia(){

    var ruta = DIRECCION_WS + "periodo_vigente.php";
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
                var data = datosJSON.datos;
                var vigencia = 0;
                var estado = 0;
                var periodo_criterio = 0;
                for(var i=0; i<= data.length; i++){
                    vigencia = data[i].vigencia;
                    estado = data[i].vigencia;
                    periodo_criterio = data[i].id;
                    break;

                }
                if(estado=='0' && periodo_criterio==""){
                    $("#mensaje").html("Debe validar un periodo para generar el algoritmo");
                    $("#generar_algoritmo").attr('style','display:none');
                }else{
                    if(estado=='1'){
                        if(vigencia == 1){
                            $("#generar_algoritmo").attr('style','display:none');
                        }else{
                            $("#mensaje").html("No hay periodo vigente");
                            $("#generar_algoritmo").attr('style','display:none');

                        }
                    }
                }


                //swal("Exito", datosJSON.mensaje, "success");

            } else {
                $("#mensaje").html("No hay periodo vigente");
                $("#generar_algoritmo").attr('style','display:none');

                //swal("Nota", datosJSON.mensaje, "info");
                //console.log(resultado)
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}