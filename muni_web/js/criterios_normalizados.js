var DIRECCION_WS = "http://localhost/www/muni_api/webservice/";

$(document).ready(function () {
    c1_tiempo_atencion();
    c2_antiguedad();
    c3_calificacion();
    c4_atencion();

});

function c1_tiempo_atencion() {
    // $("#combo_zona").empty();
    var ruta = DIRECCION_WS + "criterio1_datos.php";
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
                html += '<table id="table_tiempo_atencion" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th> # </th>';
                html += '<th> Reciclador</th>';
                html += '<th> Bono </th>';
                html += '<th> Pos. Intervalo</th>';
                html += '<th> Valor </th>';

                html += '</tr>';
                html += '</thead>';
                html += '<tbody >';
                $.each(datosJSON.datos, function (i, item) {

                    html += '<tr>';
                    ;
                    html += '<td>' + item.id + '</td>';
                    html += '<td>' + item.reciclador + '</td>';
                    html += '<td>' + item.bono + '</td>';
                    html += '<td>' + item.intervalo + '</td>';
                    html += '<td>' + item.valor + '</td>';
                    html += '</tr>';

                });
                html += '</tbody>';
                html += '</table>';

                $("#div_tiempo_atencion").html(html);
                $('#table_tiempo_atencion').DataTable({
                    "aaSorting": [[0, "asc"]],
                    "bbSorting": [[0, "asc"]],
                    "bScrollCollapse": true,
                    "bPaginate": true,
                    "sScrollX": "100%",
                    "sScrollXInner": "100%",
                });


            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}

function c2_antiguedad() {
    // $("#combo_zona").empty();
    var ruta = DIRECCION_WS + "criterio2_datos.php";
    var token = localStorage.getItem('token');

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
                html += '<table id="table_antiguedad" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th> # </th>';
                html += '<th> Reciclador</th>';
                html += '<th> Antiguedad </th>';
                html += '<th> Valor </th>';
                html += '</tr>';

                html += '</thead>';
                html += '<tbody >';
                $.each(datosJSON.datos, function (i, item) {

                    html += '<tr>';
                    html += '<td>' + item.id + '</td>';
                    html += '<td>' + item.reciclador + '</td>';
                    html += '<td>' + item.antiguedad + '</td>';
                    html += '<td>' + item.valor + '</td>';
                    html += '</tr>';

                });
                html += '</tbody>';
                html += '</table>';

                $("#div_antiguedad").html(html);
                $('#table_antiguedad').DataTable({
                    // "aaSorting": [[0, "asc"]],
                    // "bbSorting": [[0, "asc"]],
                    // "bScrollCollapse": true,
                    // "bPaginate": true,
                    // "sScrollX": "100%",
                    // "sScrollXInner": "100%",
                });


            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}

function c3_calificacion() {
    // $("#combo_zona").empty();
    var ruta = DIRECCION_WS + "criterio3_datos.php";
    var token = localStorage.getItem('token');

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
                html += '<table id="table_calificacion" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th> # </th>';
                html += '<th> Reciclador</th>';
                html += '<th> Calificacion </th>';
                html += '<th> Valor </th>';
                html += '</tr>';

                html += '</thead>';
                html += '<tbody >';
                $.each(datosJSON.datos, function (i, item) {

                    html += '<tr>';
                    html += '<td>' + item.id + '</td>';
                    html += '<td>' + item.reciclador + '</td>';
                    html += '<td>' + item.calificacion + '</td>';
                    html += '<td>' + item.valor + '</td>';
                    html += '</tr>';

                });
                html += '</tbody>';
                html += '</table>';

                $("#div_calificacion").html(html);
                $('#table_calificacion').DataTable({
                    // "aaSorting": [[0, "asc"]],
                    // "bbSorting": [[0, "asc"]],
                    // "bScrollCollapse": true,
                    // "bPaginate": true,
                    // "sScrollX": "100%",
                    // "sScrollXInner": "100%",
                });


            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}

function c4_atencion() {
    // $("#combo_zona").empty();
    var ruta = DIRECCION_WS + "criterio4_datos.php";
    var token = localStorage.getItem('token');

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
                html += '<table id="table_incumplimiento" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th> # </th>';
                html += '<th> Reciclador</th>';
                html += '<th> Atendidos - NoAtendidos </th>';
                html += '<th> Pos. Intervalo</th>';
                html += '<th> Valor </th>';
                html += '</tr>';

                html += '</thead>';
                html += '<tbody >';
                $.each(datosJSON.datos, function (i, item) {

                    html += '<tr>';
                    html += '<td>' + item.id + '</td>';
                    html += '<td>' + item.reciclador + '</td>';
                    html += '<td>' + item.atencion + '</td>';
                    html += '<td>' + item.intervalo + '</td>';
                    html += '<td>' + item.valor + '</td>';
                    html += '</tr>';

                });
                html += '</tbody>';
                html += '</table>';

                $("#div_incumplimiento").html(html);
                $('#table_incumplimiento').DataTable({
                    // "aaSorting": [[0, "asc"]],
                    // "bbSorting": [[0, "asc"]],
                    // "bScrollCollapse": true,
                    // "bPaginate": true,
                    // "sScrollX": "100%",
                    // "sScrollXInner": "100%",
                });


            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}

