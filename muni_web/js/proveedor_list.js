
var clase = 'background-image: linear-gradient(150deg, rgb(255,255,255) 300px, rgb(4,216,205)95%);'

var es_reciclador = 0;
var rol_id = 0;


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
                    html += '<a type="button" title="Editar" onclick="read(' + item.id + ')">' +
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

var sexo = 'M';
var estado = 'A';
$('#pro_m').on('ifChecked', function (event) {
    sexo = 'M';
});
$('#pro_f').on('ifChecked', function (event) {
    sexo = 'F';
});
$('#pro_a').on('ifChecked', function (event) {
    estado = 'A';
});
$('#pro_i').on('ifChecked', function (event) {
    estado = 'I';
});

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
                $("#pro_combo_zona").append(html);
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
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

                $("#proveedor_create_title").html("");
                $("#proveedor_create_title").html("Editar datos proveedor");

                $("#proveedor_vista_nuevo").attr('style', 'display:block');
                $("#pro_vista_lista").attr('style', 'display:none');
                mapa_direcciones();
                $("#proveedor_id").val(resultado.datos.id);

                $("#pro_dni").val(resultado.datos.dni);
                $("#pro_appaterno").val(resultado.datos.ap_paterno);
                $("#pro_apmaterno").val(resultado.datos.ap_materno);
                $("#pro_nombres").val(resultado.datos.nombres);
                $("#pro_fn").val(resultado.datos.fecha_nac);
                $("#pro_email").val(resultado.datos.correo);

                if (resultado.datos.sexo == 'M') {
                    $("#pro_m").iCheck('check');
                } else {
                    $("#pro_f").iCheck('check')
                }
                $("#pro_celular").val(resultado.datos.celular);
                if (resultado.datos.estado == 'A') {
                    $("#pro_a").iCheck('check');
                } else {
                    $("#pro_i").iCheck('check')
                }
                ;
                console.log("zonita");
                console.log('' + resultado.datos.zona_id + '');

                zonas_list(resultado.datos.zona_id);
                //$("#combo_zona").val(''+resultado.datos.zona_id+'');
                $("#pac-input").val(resultado.datos.direccion);

                rol_id = resultado.datos.rol_id;

                if(resultado.datos.other_rol == true){
                    $("#rec_es_reciclador").iCheck('check');

                }else{
                    $("#rec_es_reciclador").iCheck('uncheck');

                }


                if (resultado.dni.length== 8) {
                    $("#pro_td_dni").iCheck('check');

                } else {
                    $("#pro_td_ruc").iCheck('check');

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

function proveedor_add() {
    var ruta = DIRECCION_WS + "persona_create.php";
    var token = localStorage.getItem('token');
    var data = {
        dni: $("#pro_dni").val(),
        ap_paterno: $("#pro_appaterno").val(),
        ap_materno: $("#pro_apmaterno").val(),
        nombres: $("#pro_nombres").val(),
        sexo: sexo,
        fn: $("#pro_fn").val(),
        celular: $("#pro_celular").val(),
        direccion: $("#pac-input").val(),
        correo: $("#pro_email").val(),
        estado: estado,
        zona_id: $("#pro_combo_zona").val(),
        fecha_registro: $("#fecha_registro").val(),
        id : $("#proveedor_id").val(),
        operation: $("#operation").html(),
        rol_id : rol_id,
        is_param : es_reciclador

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
                    title: 'Bien:',
                    text: datosJSON.mensaje,
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar!',
                }).then(function (result) {
                    if (result.value) {
                        window.location = "../Vista/proveedor_list.php";
                    }

                })

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

$('#rec_es_reciclador').on('ifChecked', function (event) {
    es_reciclador = 1;

});

$('#rec_es_reciclador').on('ifUnchecked', function (event) {
    es_reciclador = 0;
});

