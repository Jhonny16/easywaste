var DIRECCION_WS = "http://localhost/www/muni_api/webservice/";
var clase = 'background-image: linear-gradient(150deg, rgb(255,255,255) 300px, rgb(4,216,205)95%);'


$(document).ready(function () {
    listado();
    $("#proveedor_vista_nuevo").attr('style', 'display:none');
});

function nuevo(){
    window.location = "../Vista/proveedor.php";
}

function habilitar_create() {
    $("#proveedor_vista_nuevo").attr('style', 'display:block;' + clase + '');
}


function listado() {
    var ruta = DIRECCION_WS + "proveedor_list.php";
    var token = localStorage.getItem('token');

    $("#proveedor_lista").html("");
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

                var html = "";
                html += '<table id="pro_table_list" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th>Edit</th>';
                html += '<th>DNI</th>';
                html += '<th>NOMNRE COMPLETO</th>';
                html += '<th>DIRECCION</th>';
                html += '<th>ZONA</th>';
                html += '<th>CELULAR</th>';
                html += '<th>CORREO</th>';
                html += '<th>ESTADO</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';
                $.each(datosJSON.datos, function (i, item) {

                    html += '<tr>';
                    html += '<td>';
                    html += '<a type="button" title="Editar" onclick="edit(' + item.id + ')">' +
                        '<i class="fa fa-edit text-aqua"></i></a>';
                    html += '</td>'
                    //+ item.id + '</td>';
                    html += '<td>' + item.dni + '</td>';
                    html += '<td>' + item.ap_paterno + ' ' + item.ap_materno + ' ' + item.nombres + '</td>';
                    html += '<td>' + item.direccion + '</td>';
                    html += '<td>' + item.zona + '</td>';
                    html += '<td>' + item.celular + '</td>';
                    html += '<td>' + item.correo + '</td>';
                    if (item.estado == 'A') {
                        html += '<td>ACTIVO</td>';
                    } else {
                        html += '<td>INACTIVO</td>';
                    }

                    html += '</tr>';
                });
                html += '</tbody>';
                html += '</table>';

                $("#proveedor_lista").html(html);
                $('#pro_table_list').DataTable({
                    "aaSorting": [[0, "desc"]],
                    "bScrollCollapse": true,
                    "bPaginate": true,
                    "sScrollX": "150%",
                    "sScrollXInner": "150%",
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
