var DIRECCION_WS = "http://localhost/www/muni_api/webservice/";
var list_venta = [];
$(document).ready(function () {
    listado();
});
var list_imagen = [];

function listado() {
    var ruta = DIRECCION_WS + "informacion_list_persona.php";


    var data = {'persona_id': persona_id};


    $("#informacion_list").html("");
    $.ajax({
        type: "post",
        headers: {
            token: token
        },
        url: ruta,
        data: JSON.stringify(data),
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
    var route = path + '' + image;
    var html = '<img src="' + route + '" height="400px" width="400px" >';
    console.log(html);
    $("#p_image").html(html);

}

function modal_informacion() {
    $("#informacion_title").html("Nuevo");
}

function informacion_add() {
    var ruta = DIRECCION_WS + "informacion_create.php";
    var token = localStorage.getItem('token');

    //alert("yupe");
    var operacion = $("#informacion_title").html();
    var foto_val = $('#info_foto').val();
    var img = "";
    if(operacion=="Nuevo"){
        if(foto_val==""){
            img = "";
        }else{
            img = $('#info_foto')[0].files[0]['name'];
        }
        var data = {
            titulo: $("#info_titulo").val(),
            descripcion: $("#info_descripcion").val(),
            imagen: img,
            operation: operacion
        };
    }else{
        var ide = $("#informacion_id").val();
        var image = "";
        for (var i = 0; i < list_imagen.length; i++) {
            if (ide == list_imagen[i].id) {
                image = list_imagen[i].imagen;
                break;
            }
        }
        if(image == "" || image == null){
            if(foto_val==""){
                image = "";
            }else{
                image = $('#info_foto')[0].files[0]['name'];
            }
        }
        console.log(image);
        var data = {
            titulo: $("#info_titulo").val(),
            descripcion: $("#info_descripcion").val(),
            id: ide,
            imagen: image,
            operation: operacion
        };
    }


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
    });


}

function limpiar() {
    $("#info_titulo").val("");
    $("#info_descripcion").val("");
    $("#info_foto").val("");
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


                $("#informacion_id").val(jsonResultado.datos.id);
                $("#info_titulo").val(jsonResultado.datos.titulo);
                $("#combo_rol_id").val(jsonResultado.datos.rol_id);
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