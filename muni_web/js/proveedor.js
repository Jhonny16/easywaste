var DIRECCION_WS = "http://localhost/www/muni_api/webservice/";
var clase = 'background-image: linear-gradient(150deg, rgb(255,255,255) 300px, rgb(4,216,205)95%);'
var sexo = 'M';
var estado = 'A';
//estado
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

$(document).ready(function () {
    pro_zonas_list();
});

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
        rol_id: 3,
        fecha_registro: $("#fecha_registro").val(),
        operation: $("#operation").html()
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


function pro_zonas_list(){
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
                    html += '<option value="'+ item.id +'">' + item.nombre +'</option>';
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