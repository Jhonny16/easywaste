var DIRECCION_WS = "http://localhost/www/muni_api/webservice/";
$(document).ready(function () {
    zonas();
});

function zonas(){
    $("#combo_report_zonas").empty();
    var ruta = DIRECCION_WS + "zonas_list.php";
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
                html += '<option value="0">-- Seleccione Zona --</option>';
                $.each(datosJSON.datos, function (i, item) {
                    html += '<option value="' + item.id + '">' + item.nombre + '</option>';
                });
                $("#combo_report_zonas").append(html);
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}

function filtrar(){
    var ruta = DIRECCION_WS + "reporte_sensibilizacion.php";
    var token = localStorage.getItem('token');
    var fechas = $("#rep_sensi_fechas").val();
    var fecha1 = fechas.substr(0, 10);
    var fecha2 = fechas.substr(13, 23);

    var data = {
        rol_id: $("#combo_rol_id").val(),
        fecha_inicial: fecha1,
        fecha_final: fecha2
    };
    console.log(data);


    $.ajax({
        type: "post",
        headers: {
            token: token
        },
        url: ruta,
        contentType: "application/json",
        data: JSON.stringify(data),
        success: function (resultado) {
            console.log(resultado);
            var datosJSON = resultado;
            console.log(resultado);
            //detalle_productos
            if (resultado.estado == 200) {
                var data = resultado.datos;

                console.log(data);
                grafico_circular(data);

                //google.charts.setOnLoadCallback(drawVisualization(array));
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });

}



function grafico_circular(valor) {
    var data = google.visualization.arrayToDataTable(valor);

    var options = {
        title: 'Sensibilizacion ',
        is3D: false,
    };

    var chart = new google.visualization.PieChart(document.getElementById('reporte_sensibilizacion_grafico'));
    chart.draw(data, options);

}