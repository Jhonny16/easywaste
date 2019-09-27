var DIRECCION_WS = "http://localhost/www/muni_api/webservice/";
var clase = 'background-image: linear-gradient(150deg, rgb(255,255,255) 300px, rgb(4,216,205)95%);'


$(document).ready(function () {
    listado();
    $("#reciclador_vista_nuevo").attr('style', 'display:none');
});

function nuevo(){
    window.location = "../Vista/reciclador.php";
}

function habilitar_create() {
    $("#reciclador_vista_nuevo").attr('style', 'display:block;' + clase + '');
}


function listado() {
    var ruta = DIRECCION_WS + "reciclador_list.php";
    var token = localStorage.getItem('token');

    $("#reciclador_lista").html("");
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
                html += '<table id="rec_table_list" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th>Edit</th>';
                html += '<th>DNI</th>';
                html += '<th>NOMNRE COMPLETO</th>';
                html += '<th>CODIGO</th>';
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
                    html += '<td>' + item.codigo + '</td>';
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

                $("#reciclador_lista").html(html);
                $('#rec_table_list').DataTable({
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


function edit(id) {
    habilitar_create();
    $("#med_clave").attr('style', 'display:none');
    $("#med_lbl_clave").attr('style', 'display:none');
    $("#med_vista_lista").attr('style', 'display:none');
    $("#operation").html('Editar');
    read(id);
}

function read(id) {
    var ruta = DIRECCION_WS + "medico_read.php";
    var token = localStorage.getItem('token');
    var data = {'id': id};
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
                $("#med_dni").val(resultado.datos.dni);
                $("#med_apellidos").val(resultado.datos.apellidos);
                $("#med_nombres").val(resultado.datos.nombres);
                $("#med_rne").val(resultado.datos.rne);
                $("#med_cmp").val(resultado.datos.cmp);
                $("#med_telefono").val(resultado.datos.telefono);
                $("#med_email").val(resultado.datos.email);
                if (resultado.datos.estado == '1') {
                    $("#med_si").iCheck('check');
                } else {
                    $("#med_si").iCheck('check')
                }
                $("#user_id").val(resultado.datos.user_id);
                $("#medico_id").val(resultado.datos.id);


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