
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
                html += '<th>IMAGEN</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';
                $.each(datosJSON.datos, function (i, item) {
                    html += '<tr>';
                    html += '<td style="text-align: center">';
                    html += '<a type="button" title="Ver modal de premios" data-toggle="modal" data-target="#modal_premio"' +
                        ' onclick="read_premio(' + item.id + ')">' +
                        '<i class="fa fa-edit text-fuchsia" aria-hidden="true"></i></a>';
                    html += '</td>'
                    //+
                    html += '<td>' + item.nombre + '</td>';
                    html += '<td>' + item.stock + '</td>';
                    html += '<td>' + item.precio + '</td>';
                    html += '<td>' + item.pintrash + '</td>';
                    html += '<td style="text-align: center">';
                    html += '<a type="button" title="Ver Imagen" data-toggle="modal" data-target="#modal_imagen"' +
                        ' onclick="data_modal(' + item.id + ')">' +
                        '<i class="fa fa-image text-light-blue" aria-hidden="true"></i></a>';
                    html += '</td>'
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
            console.log(error);
            //var datosJSON = $.parseJSON(error.responseText);
            //swal("Error", datosJSON.mensaje, "error");
        }
    });


}

function data_modal(id) {
    var image = "";
    for (var i = 0; i < list_imagen.length; i++) {
        if (id == list_imagen[i].id) {
            image = list_imagen[i].imagen;
            break;
        }
    }
    console.log(id);
    console.log(list_imagen);
    if (image != null){
        var route = DIRECCION_WS_IMAGE + '' + image;
        var html = '<img src="' + route + '" height="400px" width="400px" >';
        console.log(html);
        $("#p_image").html(html);

    }


}

function modal_premio() {
    $("#premio_title").html("Nuevo");
    limpiar();
    $("#pre_operation").val("Nuevo");

}

function premio_add() {

    var ruta = DIRECCION_WS + "premio_create.php";
    var token = localStorage.getItem('token');


    var formData = new FormData($("#form_premio")[0]);
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
                $("#pre_close").click();

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





    //
    // var ruta = DIRECCION_WS + "premio_create.php";
    // var token = localStorage.getItem('token');
    //
    // //alert("yupe");
    // var operacion = $("#premio_title").html();
    // var foto_val = $('#foto').val();
    // var img = "";
    // if(operacion=="Nuevo"){
    //     if(foto_val==""){
    //         img = "";
    //     }else{
    //         img = $('#foto')[0].files[0]['name'];
    //     }
    //     var data = {
    //         nombre: $("#pre_descripcion").val(),
    //         stock: $("#pre_stock").val(),
    //         precio: $("#pre_precio").val(),
    //         pintrash: $("#pre_pintrash").val(),
    //         imagen: img,
    //         operation: operacion
    //     };
    // }else{
    //     var ide = $("#premio_id").val();
    //     var image = "";
    //     for (var i = 0; i < list_imagen.length; i++) {
    //         if (ide == list_imagen[i].id) {
    //             image = list_imagen[i].imagen;
    //             break;
    //         }
    //     }
    //     if(image == "" || image == null){
    //         if(foto_val==""){
    //             image = "";
    //         }else{
    //             image = $('#foto')[0].files[0]['name'];
    //         }
    //     }
    //     console.log(image);
    //     var data = {
    //         nombre: $("#pre_descripcion").val(),
    //         stock: $("#pre_stock").val(),
    //         precio: $("#pre_precio").val(),
    //         pintrash: $("#pre_pintrash").val(),
    //         id: ide,
    //         imagen: image,
    //         operation: operacion
    //     };
    // }
    //
    //
    // $.ajax({
    //     type: "post",
    //     headers: {
    //         token: token
    //     },
    //     url: ruta,
    //     contentType: "application/json",
    //     data: JSON.stringify(data),
    //     success: function (resultado) {
    //         var datosJSON = resultado;
    //         console.log(resultado);
    //         if (datosJSON.estado === 200) {
    //             swal("Exito", datosJSON.mensaje, "success");
    //             listado();
    //             limpiar();
    //             $("#pre_close").click();
    //
    //         } else {
    //             swal("Nota", datosJSON.mensaje, "info");
    //             console.log(resultado)
    //         }
    //     },
    //     error: function (error) {
    //         console.log(error);
    //         var datosJSON = $.parseJSON(error.responseText);
    //         swal("Error", datosJSON.mensaje, "error");
    //     }
    // });


}

function limpiar() {
    $("#pre_descripcion").val("");
        $("#pre_stock").val("");
        $("#pre_precio").val("");
        $("#pre_pintrash").val("");
        $("#foto").val("");
}


function read_premio(id) {
    var ruta = DIRECCION_WS + "premio_leer.php";
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

                $("#premio_title").html("Editar");
                $("#pre_operation").val("Editar");


                $("#premio_id").val(jsonResultado.datos.id);
                $("#pre_descripcion").val(jsonResultado.datos.nombre);
                $("#pre_stock").val(jsonResultado.datos.stock);
                $("#pre_precio").val(jsonResultado.datos.precio);
                $("#pre_pintrash").val(jsonResultado.datos.pintrash);

            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}