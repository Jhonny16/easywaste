
var clase = 'background-image: linear-gradient(150deg, rgb(255,255,255) 300px, rgb(4,216,205)95%);'

var es_proveedor = 0;
var rol_id = 0;

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
                html += '<th style="text-align: center">Edit</th>';
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
                    html += '<td style="text-align: center">';
                    html += '<a type="button" title="Editar" onclick="read(' + item.id + ')">' +
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
    var ruta = DIRECCION_WS + "persona_read.php";
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

                $("#operation").html('Editar');

                $("#reciclador_create_title").html("");
                $("#reciclador_create_title").html("Editar datos reciclador");

                $("#reciclador_vista_nuevo").attr('style', 'display:block');
                $("#rec_vista_lista").attr('style', 'display:none');
                mapa_direcciones();
                $("#reciclador_id").val(resultado.datos.id);
                $("#rec_dni").val(resultado.datos.dni);
                $("#rec_appaterno").val(resultado.datos.ap_paterno);
                $("#rec_apmaterno").val(resultado.datos.ap_materno);
                $("#rec_nombres").val(resultado.datos.nombres);
                $("#rec_fn").val(resultado.datos.fecha_nac);
                $("#rec_email").val(resultado.datos.correo);

                if (resultado.datos.sexo == 'M') {
                    $("#rec_m").iCheck('check');
                } else {
                    $("#rec_f").iCheck('check')
                }
                $("#rec_celular").val(resultado.datos.celular);
                if (resultado.datos.estado == 'A') {
                    $("#rec_a").iCheck('check');
                } else {
                    $("#rec_i").iCheck('check')
                }
                ;
                console.log("zonita");
                console.log('' + resultado.datos.zona_id + '');

                zonas_list(resultado.datos.zona_id);
                //$("#combo_zona").val(''+resultado.datos.zona_id+'');
                $("#pac-input").val(resultado.datos.direccion);

                rol_id = resultado.datos.rol_id;

                if(resultado.datos.other_rol == true){
                    $("#rec_es_proveedor").iCheck('check');

                }else{
                    $("#rec_es_proveedor").iCheck('uncheck');

                }

                if (resultado.datos.dni.length== 8) {
                    $("#rec_td_dni").iCheck('check');

                } else {
                    $("#rec_td_ruc").iCheck('check');

                }


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

function zonas_list(id) {
    // $("#combo_zona").empty();
    var ruta = DIRECCION_WS + "zonas_list.php";
    console.log(ruta);
    $.ajax({
        type: "get",
        url: ruta,
        data: {},
        success: function (resultado) {
            console.log(resultado);
            var datosJSON = resultado;
            if (datosJSON.estado === 200) {
                var html = "";
                html += '<option value="0">-- Seleccione Zona --</option>';
                $.each(datosJSON.datos, function (i, item) {
                    if (item.id == id) {
                        html += '<option value="' + item.id + '" selected>' + item.nombre + '</option>';

                    } else {
                        html += '<option value="' + item.id + '" >' + item.nombre + '</option>';

                    }
                });
                $("#combo_zona").append(html);
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}
var sexo = 'M';
var estado = 'A';
$('#rec_m').on('ifChecked', function (event) {
    sexo = 'M';
});
$('#rec_f').on('ifChecked', function (event) {
    sexo = 'F';
});
$('#rec_a').on('ifChecked', function (event) {
    estado = 'A';
});
$('#rec_i').on('ifChecked', function (event) {
    estado = 'I';
});


function reciclador_add() {
    var ruta = DIRECCION_WS + "persona_create.php";
    var token = localStorage.getItem('token');

    var operation = $("#operation").html();


    var data = {
        dni: $("#rec_dni").val(),
        ap_paterno: $("#rec_appaterno").val(),
        ap_materno: $("#rec_apmaterno").val(),
        nombres: $("#rec_nombres").val(),
        sexo: sexo,
        fn: $("#rec_fn").val(),
        celular: $("#rec_celular").val(),
        direccion: $("#pac-input").val(),
        correo: $("#rec_email").val(),
        estado: estado,
        zona_id: $("#combo_zona").val(),
        fecha_registro: $("#fecha_registro").val(),
        id: $("#reciclador_id").val(),
        operation: operation,
        rol_id : rol_id,
        is_param : es_proveedor,
        user_name: localStorage.getItem('nombreUsuario')


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
            if (datosJSON.estado === 200) {

                swal({
                    title: 'Bien',
                    text: datosJSON.mensaje,
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#00ACD6',
                    confirmButtonText: 'Aceptar!',
                }).then(function (result) {
                    if (result.value) {
                        window.location = "../Vista/reciclador_list.php";
                    }
                });

            } else {
                swal({
                    type: 'warning',
                    title: 'Nota!!',
                    text: datosJSON.mensaje,
                })
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}


$('#rec_es_proveedor').on('ifChecked', function (event) {
    es_proveedor = 1;

});

$('#rec_es_proveedor').on('ifUnchecked', function (event) {
    es_proveedor = 0;
});



