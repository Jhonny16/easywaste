var DIRECCION_WS = "http://localhost/www/muni_api/webservice/";
var sexo = 'M';
var cambiar_password = 0;
var id = localStorage.getItem('id');
$('#p_masculino').on('ifChecked', function (event) {
    sexo = 'M';
});
$('#p_femenino').on('ifChecked', function (event) {
    sexo = 'F';
});

$('#p_cambiar_password').on('ifChecked', function (event) {
    cambiar_password = 1;
    $("#p_password").removeAttr('disabled')

});

$('#p_cambiar_password').on('ifUnchecked', function (event) {
    $("#p_password").attr('disabled','disabled');
});

$(document).ready(function () {

    read(id);
});

function edit_perfil() {


    var ruta = DIRECCION_WS + "perfil_update.php";
    var token = localStorage.getItem('token');
    var data = {
        dni: $("#p_dni").val(),
        ap_paterno: $("#p_paterno").val(),
        ap_materno: $("#p_materno").val(),
        nombres: $("#p_nombres").val(),
        sexo: sexo,
        fn: $("#p_fnacimiento").val(),
        celular: $("#p_celular").val(),
        direccion: $("#p_direccion").val(),
        correo: $("#p_email").val(),
        cambiar_password: cambiar_password,
        password: $("#p_password").val(),
        id : id
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
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar!',
                    cancelButtonText: 'Cancelar!'
                }).then(function (result) {
                    if (result.value) {
                        window.location = "../Vista/vista_perfil.php";
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

                //$("#operation").html('Editar');

               // $("#proveedor_create_title").html("");
                //$("#proveedor_create_title").html("Editar datos proveedor");

                //$("#proveedor_vista_nuevo").attr('style', 'display:block');
                //$("#pro_vista_lista").attr('style', 'display:none');
                //mapa_direcciones();
                //$("#proveedor_id").val(resultado.datos.id);

                $("#p_dni").val(resultado.datos.dni);
                $("#p_paterno").val(resultado.datos.ap_paterno);
                $("#p_materno").val(resultado.datos.ap_materno);
                $("#p_nombres").val(resultado.datos.nombres);
                $("#p_fnacimiento").val(resultado.datos.fecha_nac);
                $("#p_email").val(resultado.datos.correo);

                if (resultado.datos.sexo == 'M') {
                    $("#p_masculino").iCheck('check');
                } else {
                    $("#p_femenino").iCheck('check')
                }
                $("#p_celular").val(resultado.datos.celular);
                $("#p_direccion").val(resultado.datos.direccion);


                var nombre_completo = $("#p_paterno").val() + ' '+ $("#p_materno").val()+ ' ' + $("#p_nombres").val();
                console.log(nombre_completo);
                $("#name_complet").html(nombre_completo);

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
