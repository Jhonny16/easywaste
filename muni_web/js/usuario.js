/**
 * Created by tito_ on 05/12/2018.
 */
var DIRECCION_WS = "http://localhost/clinica_api/webservice/";
var user_id =0;
var operacion = 'agregar';
$(document).ready(function () {
    listado();
});
function listado() {
    operacion = 'agregar';
    var ruta = DIRECCION_WS + "usuarios_list.php";
    var token = localStorage.getItem('token');

    $("#listado_users").html("");
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
                html += '<table id="users_table_list" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th>Edit</th>';
                html += '<th>DNI</th>';
                html += '<th>USUARIO</th>';
                html += '<th>ESTADO</th>';
                html += '<th>TIPO</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';
                $.each(datosJSON.datos, function (i, item) {

                    html += '<tr>';
                    html += '<td style="text-align:center">';
                    html += '<a type="button" title="Editar" onclick="edit('+ item.id +')">' +
                        '<i class="fa fa-edit text-aqua" ></i></a>';
                    html += '</td>'
                    html += '<td>' + item.dni + '</td>';
                    html += '<td>' + item.nombre_usuario + '</td>';
                    if (item.estado == '1') {
                        html += '<td>ACTIVO</td>';
                    } else {
                        html += '<td>INACTIVO</td>';
                    }
                    html += '<td>' + item.rol + '</td>';
                    html += '</tr>';
                });
                html += '</tbody>';
                html += '</table>';

                $("#listado_users").html(html);
                $('#users_table_list').DataTable({
                    "aaSorting": [[0, "desc"]],
                    "bScrollCollapse": true,
                    "bPaginate": true
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
    user_id = '';
    user_id = id;
    var ruta = DIRECCION_WS + "usuario_read.php";
    var token = localStorage.getItem('token');
    var data = {'id': id};
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
            if (datosJSON.estado == 200) {
                operacion = 'editar';
                $("#divcheck_contrasenia").removeAttr('style');
                $("#txtcontrasenia").attr('readonly','readonly');
                $("#usuario_id").val(resultado.datos.id);
                $("#txtdocumento").val(resultado.datos.dni);
                $("#txtnombre_completo").val(resultado.datos.nombre_usuario);
                if (resultado.datos.estado == '1') {
                    $("#rbactivo").iCheck('check');
                } else {
                    $("#rbnoactivo").iCheck('check')
                }
                $("#combo_tipousuario").val(resultado.datos.tipo_usuario);
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
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });

}

function validar_password(){
    var ruta = DIRECCION_WS + "validar_password.php";
    var token = localStorage.getItem('token');
    var data = {
        'user_id': user_id,
        'clave': $("#txtcontrasenia").val()
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
            if(resultado.datos=='1'){
                $("#divnueva_contrasenia").removeAttr('style');
                swal({title: "Exito",text: "Contraseña Valida!!", type: "success"}).then(function (result) {
                    if (result.value) {
                        $("#txtnueva_contrasenia").removeAttr('readonly');
                        $("#txtnueva_contrasenia").focus();
                    }
                });
                ;

            }else{
                if(resultado.datos=='0'){
                    swal("Nota", "Contraseña N0 Valida!!", "info");
                    $("#txtcontrasenia").val("");

                }else{
                    swal("Nota", "No hubo resultado en la búsqueda", "info");
                    $("#txtcontrasenia").val("");
                }
            }


        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });

}


$('#check_contrasenia').on('ifChecked', function (event) {
    $("#txtcontrasenia").removeAttr('readonly');
    $("#divnueva_contrasenia").removeAttr('style');

});
$('#check_contrasenia').on('ifUnchecked', function (event) {
    $("#txtcontrasenia").attr('readonly','readonly');
    $("#txtnueva_contrasenia").attr('readonly','readonly');
    $("#txtcontrasenia").val("");
    $("#divnueva_contrasenia").attr('style','display:none');
    $("#txtnueva_contrasenia").val("");
});


function limpiar() {
    operacion = 'agregar';
    $("#usuario_id").val("");
    $("#txtnombre_completo").val("");
    $("#txtdocumento").val("");
    $("#combo_tipousuario").val("1");
    $("#rbactivo").iCheck('check');
    $("#rbnoactivo").iCheck('uncheck');
    $("#check_contrasenia").iCheck('uncheck');
    $("#txtcontrasenia").val("");
    $("#txtcontrasenia").removeAttr('readonly');
    $("#divcheck_contrasenia").attr('style','display:none');
    $("#divnueva_contrasenia").attr('style','display:none');

}
var estado='1';
$('#rbactivo').on('ifChecked', function (event) {
    estado=1;

});
$('#rbnoactivo').on('ifChecked', function (event) {
    estado=0;
});
var clave;
function usuario_add() {
    var ruta = DIRECCION_WS + "usuario_create_update.php";
    var token = localStorage.getItem('token');
    if(operacion == 'agregar'){
        clave = $("#txtcontrasenia").val();
    }else{
        clave = $("#txtnueva_contrasenia").val();
    }

    var data = {
        p_usuario_id: $("#usuario_id").val(),
        p_documento: $("#txtdocumento").val(),
        p_tipo: $("#combo_tipousuario").val(),
        p_password: clave ,
        p_estado: estado,
        p_operacion: operacion
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
            if (resultado.estado == 200) {
                limpiar();
                swal("Exito", resultado.mensaje, "success");
                listado();
            } else {
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
