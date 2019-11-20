var DIRECCION_WS = "http://localhost/www/muni_api/webservice/";
var list_criterios = [];
$(document).ready(function () {
    criterios_lista();
    criterios_vectores();
    criterios_matriz();


});

function criterios_lista() {
    var ruta = DIRECCION_WS + "criterios_list.php";
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
                list_criterios = datosJSON.datos;
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}

function criterios_vectores() {

    var ruta = DIRECCION_WS + "matriz_normalizada.php";
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
                html += '<table id="table_matriz_normalizada" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th > #</th>';
                html += '<th >Criterio</th>';
                $.each(list_criterios, function (i, item) {
                    html += '<th>' + item.nombre + '</th>';
                });
                html += '</tr>';

                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th ># </th>';
                html += '<th >Reciclador</th>';
                $.each(list_criterios, function (i, item) {
                    html += '<th>' + item.valor + '</th>';
                });
                html += '</tr>';
                html += '</thead>';

                html += '<tbody >';
                $.each(datosJSON.datos, function (i, item) {

                    html += '<tr>';
                    html += '<td>' + item.persona_id + '</td>';
                    html += '<td>' + item.reciclador + '</td>';
                    html += '<td>' + item.criterio1 + '</td>';
                    html += '<td>' + item.criterio2 + '</td>';
                    html += '<td>' + item.criterio3 + '</td>';
                    html += '<td>' + item.criterio4 + '</td>';
                    html += '</tr>';

                });
                html += '</tbody>';
                html += '</table>';

                $("#matriz_vectores").html(html);
                $('#table_matriz_normalizada').DataTable({
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

function criterios_matriz() {

    var ruta = DIRECCION_WS + "matriz_prioridades.php";
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
                html += '<table id="table_matriz_prioridades" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th> # </th>';
                html += '<th> Reciclador</th>';
                html += '<th> Valor </th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody >';
                $.each(datosJSON.datos, function (i, item) {

                    html += '<tr>';
                    ;
                    html += '<td>' + item.persona_id + '</td>';
                    html += '<td>' + item.reciclador + '</td>';
                    html += '<td>' + item.value + '</td>';
                    html += '</tr>';

                });
                html += '</tbody>';
                html += '</table>';

                $("#matriz_prioridades").html(html);
                $('#table_matriz_prioridades').DataTable({
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