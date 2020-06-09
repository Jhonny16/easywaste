$(document).ready(function () {
    lista();
});

function lista(){
    var ruta = DIRECCION_WS + "history_criterios.php";
    var token = localStorage.getItem('token');

    $.ajax({
        type: "post",
        headers: {
            token: token
        },
        url: ruta,
        data: JSON.stringify({'fecha_inicio': $("#history_fecha_incial").val(), 'fecha_fin': $("#history_fecha_final").val()}),
        success: function (resultado) {
            console.log(resultado)
            var datosJSON = resultado;
            if (datosJSON.estado == 200) {

                var html = "";
                html += '<table id="tabla_historial_criterios" class="table table-bordered table-hover small">';
                html += '<thead>';
                html += '<tr style="background-color: #3f5649; height:25px; color: white">';
                html += '<th style="text-align: center">#</th>';
                html += '<th>Fecha operación</th>';
                html += '<th>Criterio</th>';
                html += '<th>Valor</th>';
                html += '<th>Usuario sistema</th>';
                html += '<th>Operación</th>';
                html += '<th>Dirección IP</th>';
                html += '<th>Rol base de datos</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody id="det_detalle">';
                $.each(datosJSON.datos, function (i, item) {
                    html += '<tr>';
                    html += '<td>' + (i+1) + '</td>';
                    html += '<td>' + item.fecha_hora + '</td>';
                    html += '<td>' + item.nombre + '</td>';
                    html += '<td>' + item.valor + '</td>';
                    html += '<td>' + item.user_name + '</td>';
                    html += '<td>' + item.operacion + '</td>';
                    html += '<td>' + item.dir_ip + '</td>';
                    html += '<td>' + item.usuario + '</td>';

                    html += '</tr>';
                });
                html += '</tbody>';
                html += '</table>';
                $("#historial_criterios_list").empty();
                $("#historial_criterios_list").html(html);
                $('#tabla_historial_criterios').DataTable({
                    "aaSorting": [[0, "desc"]],
                    "bScrollCollapse": true,
                    "bPaginate": true,
                    "sScrollX": "110%",
                    "sScrollXInner": "110%",
                });


            }
        },
        error: function (error) {
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}