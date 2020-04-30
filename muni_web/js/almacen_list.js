var DIRECCION_WS = "http://localhost/www/muni_api/webservice/";
var list_venta = [];
$(document).ready(function () {
    listado();
    //centro_acopio_final();
});

function listado() {
    var ruta = DIRECCION_WS + "almacen_lista.php";
    var token = localStorage.getItem('token');

    $("#almacen_lista").html("");
    $.ajax({
        type: "get",
        headers: {
            token: token
        },
        url: ruta,
        data: {},
        success: function (resultado) {
            console.log(resultado);
            var datosJSON = resultado;
            if (datosJSON.estado == 200) {
                list_venta = resultado.datos;
                var html = "";
                html += '<table id="almacen_table_list" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th style="text-align: center">#</th>';
                html += '<th>CODIDO</th>';
                html += '<th>RECICLADOR</th>';
                html += '<th>FECHA REGISTRO</th>';
                html += '<th>CENTRO ACOPIO TEMPORAL</th>';
                html += '<th>SECTOR</th>';
                html += '<th>PESO TOTAL</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';
                $.each(datosJSON.datos, function (i, item) {
                    html += '<tr>';
                    html += '<td style="text-align: center">';
                    html += '<a type="button" title="Detalle de Almacenamiento" data-toggle="modal" data-target="#modal_almacen_detalle"' +
                        ' onclick="data_modal(' + item.id + ')">' +
                        '<i class="fa fa-outdent text-light" aria-hidden="true"></i></a>';
                    html += '</td>';
                    //+
                    html += '<td>' + item.code + '</td>';
                    html += '<td>' + item.reciclador + '</td>';
                    html += '<td>' + item.fecha_registro + '</td>';
                    html += '<td>' + item.centro_acopio + '</td>';
                    html += '<td>' + item.sector + '</td>';
                    html += '<td>' + item.total_peso + '</td>';
                    html += '</tr>';
                });
                html += '</tbody>';
                html += '</table>';

                $("#almacen_lista").html(html);
                $('#almacen_table_list').DataTable({
                    "aaSorting": [[0, "desc"]],
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
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });


}
var acopio_final = "0";
function data_modal(id) {
    var ruta = DIRECCION_WS + "almacen_detalle.php";
    var token = localStorage.getItem('token');

    var code = "";
    var state = "";

    $("#tabla_almacen_detalle").html("");

    $.ajax({
        type: "post",
        headers: {
            token: token
        },
        url: ruta,
        data: JSON.stringify({'almacen_id': id}),
        success: function (resultado) {
            var datosJSON = resultado;
            if (datosJSON.estado == 200) {
                $("#almacen_code").html(resultado.datos[0].code);

                var html = "";
                html += '<table id="tabla_almacen_detalle_t" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th style="text-align: center">#</th>';
                html += '<th>Residuo</th>';
                html += '<th>Peso</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody id="det_detalle">';
                $.each(datosJSON.datos, function (i, item) {
                    html += '<tr>';
                    html += '<td style="text-align: center">' + item.id + '</td>';
                    html += '<td>' + item.nombre + '</td>';
                    html += '<td>' + item.cantidad + '</td>';
                    html += '</tr>';
                });
                html += '</tbody>';
                html += '</table>';

                $("#tabla_almacen_detalle").html(html);


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
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });

}

