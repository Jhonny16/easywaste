var DIRECCION_WS = "http://localhost/www/muni_api/webservice/";
$(document).ready(function () {
    reciclador_list()
});

function reciclador_list(){
    $("#combo_report_recicladores").empty();
    var ruta = DIRECCION_WS + "reciclador_list.php";
    var token = localStorage.getItem('token');
    console.log(ruta);
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
            if (datosJSON.estado === 200) {
                var html = "";
                html += '<option value="0">-- Seleccione reciclador --</option>';
                $.each(datosJSON.datos, function (i, item) {
                    html += '<option value="'+ item.id +'">' + item.ap_paterno + ' '+ item.ap_materno + ' '+ item.nombres  +'</option>';
                });
                $("#combo_report_recicladores").append(html);
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
    var ruta = DIRECCION_WS + "reporte_proveedores_reciclador.php";
    var token = localStorage.getItem('token');
    var fechas = $("#rep_prov_fechas").val();
    var fecha1 = fechas.substr(0, 10);
    var fecha2 = fechas.substr(13, 23);

    var reciclador_id =   $("#combo_report_recicladores").val();

    var data = {
        reciclador_id: reciclador_id,
        fecha_inicio: fecha1,
        fecha_fin: fecha2
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
                html += '<table id="tbl_reporte_proveedores_reciclador" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th style="text-align: center">#</th>';
                html += '<th>DNI</th>';
                html += '<th>PROVEEDOR</th>';
                html += '<th>N° SERVICIOS</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';
                var sum = 0;
                $.each(datosJSON.datos, function (i, item) {

                    html += '<tr>';
                    html += '<td>' + (i + 1) + '</td>';
                    html += '<td>' + item.proveedor_dni + '</td>';
                    html += '<td>' + item.proveedor + '</td>';
                    html += '<td>' + item.total_servicios + '</td>';
                    html += '</tr>';

                    sum = sum + parseFloat(item.sub_total);
                });
                html += '</tbody>';
                html += '</table>';

                $("#reporte_proveedores_reciclador").html(html);
                $('#tbl_reporte_proveedores_reciclador').DataTable({
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