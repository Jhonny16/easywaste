var DIRECCION_WS = "http://localhost/www/muni_api/webservice/";
var clase = 'background-image: linear-gradient(150deg, rgb(255,255,255) 300px, rgb(4,216,205)95%);'
var sexo = 'M';
var estado = 'A';
//estado
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

$(document).ready(function () {
    zonas_list();
});

function reciclador_add() {
    var ruta = DIRECCION_WS + "persona_create.php";
    var token = localStorage.getItem('token');
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
        rol_id: 2,
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
                    type: 'success',
                    title: 'Bien',
                    text: datosJSON.mensaje,
                })
                window.location = "../Vista/reciclador_list.php";
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


function zonas_list(){
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