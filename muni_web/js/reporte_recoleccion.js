
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
    var ruta = DIRECCION_WS + "reporterecoleccion.php";
    var token = localStorage.getItem('token');
    var zona_id = $("#combo_report_zonas").val();

    if(parseInt($("#anio_inicial").val()) > parseInt($("#anio_final").val())){
        swal({
            type: 'warning',
            title: 'Nota',
            text: 'El año inicial no puede ser mayor que el año final   !',
        })
        return 0;
    }

    var data = {
        zona_id: zona_id,
        anio_inicial: $("#anio_inicial").val(),
        anio_final: $("#anio_final").val()
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
                var array = [];

                array[0]=['Año', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio',
                    'Agosto','Setiembre','Octubre','Noviembre','Diciembre'];
                //,{ role: 'annotation' }
                for(var i= 0; i < data.length; i++){
                    var array2 = [];
                    array2[0] = ''+ data[i].anio +'';
                    if(data[i].enero == null){array2[1] = 0}else{array2[1] = parseFloat(data[i].enero);}
                    if(data[i].febrero == null){array2[2] = 0}else{array2[2] = parseFloat(data[i].febrero);}
                    if(data[i].marzo == null){array2[3] = 0}else{array2[3] = parseFloat(data[i].marzo);}
                    if(data[i].abril == null){array2[4] = 0}else{array2[4] = parseFloat(data[i].abril);}
                    if(data[i].mayo == null){array2[5] = 0}else{array2[5] = parseFloat(data[i].mayo);}
                    if(data[i].junio == null){array2[6] = 0}else{array2[6] = parseFloat(data[i].junio);}
                    if(data[i].julio == null){array2[7] = 0}else{array2[7] = parseFloat(data[i].julio);}
                    if(data[i].agosto == null){array2[8] = 0}else{array2[8] = parseFloat(data[i].agosto);}
                    if(data[i].setiembre == null){array2[9] = 0}else{array2[9] = parseFloat(data[i].setiembre);}
                    if(data[i].octubre == null){array2[10] = 0}else{array2[10] = parseFloat(data[i].octubre);}
                    if(data[i].noviembre == null){array2[11] = 0}else{array2[11] = parseFloat(data[i].noviembre);}
                    if(data[i].diciembre == null){array2[12] = 0}else{array2[12] = parseFloat(data[i].diciembre);}
                    // array2[13] = '';

                    array.push(array2);
                }
                console.log(array);
                drawVisualization2(array);

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



function drawVisualization2(valor) {
    //var datos = $.parseJSON(valor);
    var array = valor;
    //array[0].push({role: 'style'});
    //array[0] = ["Servicio","Monto"];
    console.log(array);

    // Some raw data (not necessarily accurate)
    var data = google.visualization.arrayToDataTable(array);

    var options = {
        title: '',
        vAxis: {title: 'Peso Vendido'},
        hAxis: {title: 'Año'},
        seriesType: 'bars',
        width: 700,
        heigth: 900

    };

    var chart = new google.visualization.ComboChart(document.getElementById('reporte_recoleccion_grafico'));
    chart.draw(data, options);

}