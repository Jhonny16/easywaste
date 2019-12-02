var DIRECCION_WS = "http://localhost/www/muni_api/webservice/";
var list_venta = [];
$(document).ready(function () {
    listado();
});
var list_imagen = [];

function listado() {
    var ruta = DIRECCION_WS + "premios_list.php";
    var token = localStorage.getItem('token');

    $("#premios_list").html("");
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
                list_imagen = resultado.datos;
                var html = "";
                html += '<table id="table_premios_list" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th style="text-align: center">#</th>';
                html += '<th>PREMIO</th>';
                html += '<th>STOCK</th>';
                html += '<th>PRECIO</th>';
                html += '<th>PINTRASH</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';
                $.each(datosJSON.datos, function (i, item) {
                    html += '<tr>';
                    html += '<td style="text-align: center">';
                    html += '<a type="button" title="Detalle de Venta" data-toggle="modal" data-target="#modal_imagen"' +
                        ' onclick="data_modal(' + item.id + ')">' +
                        '<i class="fa fa-outdent text-light" aria-hidden="true"></i></a>';
                    html += '</td>'
                    //+
                    html += '<td>' + item.nombre + '</td>';
                    html += '<td>' + item.stock + '</td>';
                    html += '<td>' + item.precio + '</td>';
                    html += '<td>' + item.pintrash + '</td>';
                    html += '</tr>';
                });
                html += '</tbody>';
                html += '</table>';

                $("#premios_list").html(html);
                $('#table_premios_list').DataTable({
                    "aaSorting": [[0, "desc"]],
                    "bScrollCollapse": true,
                    "bPaginate": true,
                    "sScrollX": "100%",
                    "sScrollXInner": "100%",
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

function data_modal(id){
    var image = "";
    var path = '/www/muni_web/imagenes/imagenespremios/';
    for(var i=0; i<list_imagen.length; i++){
        if(id == list_imagen[i].id ){
            image = list_imagen[i].imagen;

            break;
        }
    }
    var route = path + '' +image;
    var html = '<img src="'+ route +'" height="400px" width="400px" >';
    console.log(html);
    $("#p_image").html(html);

}