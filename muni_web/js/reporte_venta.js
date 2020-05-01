
$(document).ready(function () {
    residuos();
});

function residuos(){
    $("#combo_report_residuos").empty();
    var ruta = DIRECCION_WS + "residuo_list.php";
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
                html += '<option value="0">-- Todos los residuos --</option>';
                list_residuos = resultado.datos;
                $.each(datosJSON.datos, function (i, item) {
                    html += '<option value="'+ item.id +'">' + item.nombre +'</option>';
                });
                $("#combo_report_residuos").append(html);
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
    var ruta = DIRECCION_WS + "reporte_venta.php";
    var token = localStorage.getItem('token');
    var fechas = $("#rep_ven_fechas").val();
    var fecha1 = fechas.substr(0, 10);
    var fecha2 = fechas.substr(13, 23);

    var data = {
        residuo_id: $("#combo_report_residuos").val(),
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
            if (datosJSON.estado == 200) {

                var html = "";
                html += '<table id="tbl_reporte_ventas" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th style="text-align: center">#</th>';
                html += '<th>RESIDUO</th>';
                html += '<th>PESO</th>';
                html += '<th>PRECIO</th>';
                html += '<th>SUB TOTAL</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';
                var sum = 0;
                $.each(datosJSON.datos, function (i, item) {

                    html += '<tr>';
                    html += '<td>' + (i + 1) + '</td>';
                    html += '<td>' + item.nombre + '</td>';
                    html += '<td>' + item.peso_total + '</td>';
                    html += '<td>' + item.precio + '</td>';
                    html += '<td style="text-align: right">s/. ' + item.sub_total + '</td>';
                    html += '</tr>';

                    sum = sum + parseFloat(item.sub_total);
                });
                html += '</tbody>';
                html += '<tfoot>';
                html += '<tr>';
                html += '<td colspan="4">TOTAL</td>';
                html += '<td style="text-align: right">s/. ' + sum.toFixed(2) + '</td>';
                html += '</tr>';
                html += '</tfoot>';
                html += '</table>';

                $("#reporte_ventas_list").html(html);
                $('#tbl_reporte_ventas').DataTable({
                    "aaSorting": [[0, "asc"]],
                    "bScrollCollapse": true,
                    "bPaginate": true,
                });


            } else {
                swal({
                    type: 'info',
                    title: 'Nota!',
                    text: datosJSON.mensaje,
                })
                return 0;
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });

}

function genera_pdf(){
    var ruta = DIRECCION_WS + "reporte_venta_pdf.php";
    var token = localStorage.getItem('token');
    var fechas = $("#rep_ven_fechas").val();
    var fecha1 = fechas.substr(0, 10);
    var fecha2 = fechas.substr(13, 23);

    var data = {
        'residuo_id': $("#combo_report_residuos").val(),
        'fecha_inicial': fecha1,
        'fecha_final': fecha2,
        'user_name': localStorage.getItem('nombreUsuario')
    };
    console.log(data);
    $.ajax({
        type: "post",
        headers: {
            token: token
        },
        url: ruta,
        data: JSON.stringify(data),
        success: function (resultado) {
            console.log(resultado);
            // swal("Bien!", "Se genero el PDF correctamente", "success")
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });


}