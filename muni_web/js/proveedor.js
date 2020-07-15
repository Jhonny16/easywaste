
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


var doc = 8;
$('#pro_td_dni').on('ifChecked', function (event) {
    console.log("dni");
    doc = 8;

    $("#pro_dni").removeAttr('maxlength');
    $("#pro_dni").attr('maxlength','8');
    $("#div_pro_pa").removeAttr('style');
    $("#div_pro_ma").removeAttr('style');
});
$('#pro_td_ruc').on('ifChecked', function (event) {
    console.log("ruc")
    doc = 11;
    $("#pro_dni").removeAttr('maxlength');
    $("#pro_dni").attr('maxlength','11');
    $("#div_pro_pa").attr('style','display:none');
    $("#div_pro_ma").attr('style','display:none');
});

$("#pro_dni").change(function () {
    var value = $(this).val();
    console.log(value);
    console.log(value.length);
    if(doc == 11){
        if(value.length == doc){
            $("#pro_dni").removeAttr('style');
        }else{
            $("#pro_dni").attr('style','background-color: #ed8f8f');
            swal('Nota', 'Debe ingresar 11 caracteres', 'warning');
            $("#pro_dni").focus();
        }
    }

    if(doc == 8){
        if(value.length == doc){
            $("#pro_dni").removeAttr('style');
        }else{
            $("#pro_dni").attr('style','background-color: #ed8f8f');
            swal('Nota', 'Debe ingresar 8 caracteres', 'warning');
            $("#pro_dni").focus();
        }
    }


});



$(document).ready(function () {
    pro_zonas_list();
});

var es_reciclador = 0;

$("#pro_fn").change(function () {
    console.log($(this).val());

    console.log($("#prov_fecha_hoy").val())

    var fecha1 = moment($(this).val());
    var fecha2 = moment($("#prov_fecha_hoy").val());

    console.log(fecha1);

    if ($(this).val() != ""){
        var diferencia = fecha2.diff(fecha1, 'days');
        console.log(diferencia);
        if((diferencia/365.3) >= 18){
            alerta_fecha = 0;
            $("#pro_fn").removeAttr('style');
        }else{
            alerta_fecha = 1;
            if (alerta_fecha == 1){
                swal("Cuidado! ", "No es mayor de edad. Verifique la fecha ingresada", "warning");
                $("#pro_fn").attr('style','background-color: #ed8f8f');

            }

        }
        // console.log(fecha2.diff(fecha1, 'days'), ' dias de diferencia');
    }
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
        operation: $("#operation").html(),
        is_param : es_reciclador,
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

$('#rec_es_reciclador').on('ifChecked', function (event) {
    es_reciclador = 1;

});

$('#rec_es_reciclador').on('ifUnchecked', function (event) {
    es_reciclador = 0;
});


