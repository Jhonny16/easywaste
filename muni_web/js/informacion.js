
var list_venta = [];
$(document).ready(function () {
    listado();
});
var list_imagen = [];

function listado() {
    var ruta = DIRECCION_WS + "informacion_list.php";

    $("#informacion_list").html("");
    $.ajax({
        type: "get",
        url: ruta,
        data: {},
        success: function (resultado) {
            console.log(resultado);
            var datosJSON = resultado;
            if (datosJSON.estado == 200) {
                list_imagen = resultado.datos;
                var html = "";
                html += '<table id="table_info_list" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th style="text-align: center">#</th>';
                html += '<th>TITULO</th>';
                html += '<th>DESCRIPCION</th>';
                html += '<th>TIPO</th>';
                html += '<th>IMAGEN</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';
                $.each(datosJSON.datos, function (i, item) {
                    html += '<tr>';
                    html += '<td style="text-align: center">';
                    html += '<a type="button" title="Ver modal de premios" data-toggle="modal" data-target="#modal_informacion"' +
                        ' onclick="read_informacion(' + item.id + ')">' +
                        '<i class="fa fa-edit text-fuchsia" aria-hidden="true"></i></a>';
                    html += '</td>'
                    //+
                    html += '<td>' + item.titulo + '</td>';
                    html += '<td>' + item.descripcion + '</td>';
                    if(item.rol_id == 2){
                        html += '<td>Reciclador</td>';
                    }else{
                        html += '<td>Proveedor</td>';

                    }
                    html += '<td style="text-align: center">';
                    html += '<a type="button" title="Ver Imagen" data-toggle="modal" data-target="#modal_info_imagen"' +
                        ' onclick="data_modal(' + item.id + ')">' +
                        '<i class="fa fa-image text-light-blue" aria-hidden="true"></i></a>';
                    html += '</td>'
                    html += '</tr>';
                });
                html += '</tbody>';
                html += '</table>';

                $("#informacion_list").html(html);
                $('#table_info_list').DataTable({
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
            console.log(error);
            //var datosJSON = $.parseJSON(error.responseText);
            //swal("Error", datosJSON.mensaje, "error");
        }
    });


}

function data_modal(id) {
    var image = "";
    var path = '/www/muni_web/imagenes/informacion/';
    for (var i = 0; i < list_imagen.length; i++) {
        if (id == list_imagen[i].id) {
            image = list_imagen[i].imagen;
            break;
        }
    }
    if (image != null){
        var route = DIRECCION_WS_IMAGE + '' + image;
        var html = '<img src="' + route + '" height="400px" width="400px" >';
        console.log(html);
        $("#p_image").html(html);
    }


}

function modal_informacion() {
    $("#informacion_title").html("Nuevo");
    $("#info_operation").val("Nuevo");
    limpiar();
}

function informacion_add() {
    var ruta = DIRECCION_WS + "informacion_create.php";
    var token = localStorage.getItem('token');

    $("#info_rol").val($("#combo_rol").val());

    var formData = new FormData($("#form_informacion")[0]);
    console.log(formData);
    $.ajax({
        type: "post",
        headers: {
            token: token
        },
        url: ruta,
        contentType: false,
        processData: false,
        cache: false,
        data: formData,
        success: function (resultado) {
            console.log(resultado);
            if (resultado.estado === 200) {
                swal("Exito", resultado.mensaje, "success");
                listado();
                limpiar();
                $("#info_close").click();

            } else {
                swal("Nota", resultado.mensaje, "info");
                console.log(resultado)
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", resultado.mensaje, "error");
        }
    });


/*
    $.ajax({
        type: "post",
        headers: {
            token: token
        },
        url: ruta,
        contentType: "application/json",
        data: JSON.stringify(data),
        success: function (resultado) {
            var datosJSON = resultado;
            console.log(resultado);
            if (datosJSON.estado === 200) {
                swal("Exito", datosJSON.mensaje, "success");
                listado();
                limpiar();
                $("#info_close").click();

            } else {
                swal("Nota", datosJSON.mensaje, "info");
                console.log(resultado)
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });*/


}

function limpiar() {
    $("#info_titulo").val("");
    $("#info_descripcion").val("");
    $("#info_foto").val("");
    $("#info_rol").val("");
    $("#combo_rol").val("0");
}


function read_informacion(id) {
    var ruta = DIRECCION_WS + "informacion_read.php";
    var token = localStorage.getItem('token');

    var data = {'id' : id};

    $.ajax({
        type: "post",
        headers: {
            token: token
        },
        url: ruta,
        contentType: "application/json",
        data: JSON.stringify(data),
        success: function (resultado) {
            var jsonResultado = resultado;
            if (jsonResultado.estado === 200) {
                console.log(resultado);

                limpiar();

                $("#informacion_title").html("Editar");
                $("#info_operation").val("Editar");


                $("#informacion_id").val(jsonResultado.datos.id);
                $("#info_titulo").val(jsonResultado.datos.titulo);
                $("#combo_rol").val(jsonResultado.datos.rol_id);
                $("#info_rol").val(jsonResultado.datos.rol_id);

                $("#info_descripcion").val(jsonResultado.datos.descripcion);

            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}