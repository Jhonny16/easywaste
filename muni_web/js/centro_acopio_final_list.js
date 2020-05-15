
var list_venta = [];

var operation = null;
$(document).ready(function () {
    listado();
});
var list_imagen = [];

function listado() {
    var ruta = DIRECCION_WS + "centro_acopio_final_list.php";

    $("#centro_acopio_final_list").html("");
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
                html += '<table id="table_ca_final_list" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th style="text-align: center">#</th>';
                html += '<th>NOMBRE</th>';
                html += '<th>DIRECCIÓN</th>';
                html += '<th>TIPO</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';
                $.each(datosJSON.datos, function (i, item) {
                    html += '<tr>';
                    html += '<td style="text-align: center">';
                    html += '<a type="button" title="Ver modal" data-toggle="modal" data-target="#modal_ca"' +
                        ' onclick="read_centro(' + item.id + ')">' +
                        '<i class="fa fa-edit text-fuchsia" aria-hidden="true"></i></a>';
                    html += '</td>'
                    //+
                    html += '<td>' + item.nombre + '</td>';
                    html += '<td>' + item.direccion + '</td>';
                    html += '<td>' + item.tipo + '</td>';

                    html += '</tr>';
                });
                html += '</tbody>';
                html += '</table>';

                $("#centro_acopio_final_list").html(html);
                $('#table_ca_final_list').DataTable({
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


function modal_acopio() {
    $("#ca_title").html("Nuevo");
    limpiar();
    operation = 'Nuevo';
    $("#combo_type").val("Final");

    var value = $("#combo_type").val();
    $("#div_numero_sectores").attr('style', 'display:none');
    console.log("finality");

    $("#combo_type").attr('disabled','disabled');
    if (operation != "Nuevo"){
        if (value == 'Final') {
            $("#div_numero_sectores").attr('style', 'display:none');
        } else {
            $("#div_numero_sectores").removeAttr('style');

        }
    }


};


function centro_acopio_add() {
    var ruta = DIRECCION_WS + "centro_acopio_create.php";
    var token = localStorage.getItem('token');

    var data = {
        'nombre': $("#ca_nombre").val(),
        'direccion': $("#ca_direccion").val(),
        'tipo': $("#combo_type").val(),
        'numero_sectores': 0,
        'operation': operation,
        'id': $("#ca_id").val()
    }

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
            var datosJSON = resultado;
            console.log(resultado);
            if (datosJSON.estado === 200) {
                swal("Exito", datosJSON.mensaje, "success");
                listado();
                limpiar();
                $("#ca_close").click();

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
    $("#ca_nombre").val("");
    $("#ca_direccion").val("");
    $("#combo_type").val("Temporal");
    $("#ca_numero_sectores").val("");
    $("#ca_id").val("");
}


function read_centro(id) {
    var ruta = DIRECCION_WS + "centro_acopio_read.php";
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
            var jsonResultado = resultado;
            if (jsonResultado.estado === 200) {
                console.log(resultado);

                limpiar();

                operation = "Editar";

                $("#ca_title").html("Editar");

                $("#ca_id").val(jsonResultado.datos.id);
                $("#ca_nombre").val(jsonResultado.datos.nombre);
                $("#ca_direccion").val(jsonResultado.datos.direccion);
                $("#combo_type").val(jsonResultado.datos.tipo);

                if (jsonResultado.datos.tipo == 'Final') {
                    $("#div_numero_sectores").attr('style', 'display:none');
                } else {
                    $("#div_numero_sectores").removeAttr('style');

                }
                $("#ca_numero_sectores").val(jsonResultado.datos.numero_sectores);

            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}