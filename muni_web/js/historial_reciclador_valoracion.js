$(document).ready(function () {
    lista();
});

function lista(){
    var ruta = DIRECCION_WS + "history_reciclador_valor.php";
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
                html += '<table id="tabla_historial_reciclador_valor" class="table table-bordered table-hover small">';
                html += '<thead>';
                html += '<tr style="background-color: #3f5649; height:25px; color: white">';
                html += '<th style="text-align: center">#</th>';
                html += '<th>Fecha operación</th>';
                html += '<th>DNI</th>';
                html += '<th>Reciclador</th>';
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
                    html += '<td>' + item.secuencia + '</td>';
                    html += '<td>' + item.fecha_hora + '</td>';
                    html += '<td>' + item.dni + '</td>';
                    html += '<td>' + item.ap_paterno + ' ' + item.ap_materno + ' ' + item.nombres + '</td>';
                    html += '<td>' + item.valor + '</td>';
                    html += '<td>' + item.user_name + '</td>';
                    html += '<td>' + item.operacion + '</td>';
                    html += '<td>' + item.dir_ip + '</td>';
                    html += '<td>' + item.usuario + '</td>';

                    html += '</tr>';
                });
                html += '</tbody>';
                html += '</table>';
                $("#historial_reciclador_list").empty();
                $("#historial_reciclador_list").html(html);
                $('#tabla_historial_reciclador_valor').DataTable({
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