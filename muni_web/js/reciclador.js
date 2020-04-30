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

var doc = 8;
$('#rec_td_dni').on('ifChecked', function (event) {
    console.log("dni");
    doc = 8;

    $("#rec_dni").removeAttr('maxlength');
    $("#rec_dni").attr('maxlength','8');
    $("#div_rec_pa").removeAttr('style');
    $("#div_rec_ma").removeAttr('style');
});
$('#rec_td_ruc').on('ifChecked', function (event) {
    console.log("ruc")
    doc = 11;
    $("#rec_dni").removeAttr('maxlength');
    $("#rec_dni").attr('maxlength','11');
    $("#div_rec_pa").attr('style','display:none');
    $("#div_rec_ma").attr('style','display:none');
});

$("#rec_dni").change(function () {
    var value = $(this).val();
    console.log(value);
    console.log(value.length);
    if(doc == 11){
        if(value.length == doc){
            $("#rec_dni").removeAttr('style');
        }else{
            $("#rec_dni").attr('style','background-color: #ed8f8f');
            swal('Nota', 'Debe ingresar 11 caracteres', 'warning');
            $("#rec_dni").focus();
        }
    }

    if(doc == 8){
        if(value.length == doc){
            $("#rec_dni").removeAttr('style');
        }else{
            $("#rec_dni").attr('style','background-color: #ed8f8f');
            swal('Nota', 'Debe ingresar 8 caracteres', 'warning');
            $("#rec_dni").focus();
        }
    }


});

var alerta_fecha = 0;
var es_proveedor = 0;

$(document).ready(function () {
    zonas_list();

    // $('#rec_fn').on("change blur load",function(){
    //     //Définition des jours interdits :
    //
    //     console.log($(this).val());
    //     console.log($("#fecha_hoy").val())
    //
    //     var fecha1 = moment($(this).val());
    //     var fecha2 = moment($("#fecha_hoy").val());
    //
    //     console.log(fecha1);
    //
    //     if ($(this).val() != ""){
    //         var diferencia = fecha2.diff(fecha1, 'days');
    //         console.log(diferencia);
    //         if((diferencia/364) >= 18){
    //             alerta_fecha = 0;
    //         }else{
    //             alerta_fecha = 1;
    //             if (alerta_fecha == 1){
    //                 swal("Cuidado! ", "No es mayor de edad. Verifique la fecha ingresada", "warning");
    //
    //             }
    //
    //         }
    //            // console.log(fecha2.diff(fecha1, 'days'), ' dias de diferencia');
    //     }
    //
    //
    // })

});


$("#rec_fn").change(function () {
    console.log($(this).val());

    console.log($("#fecha_hoy").val())

        var fecha1 = moment($(this).val());
        var fecha2 = moment($("#fecha_hoy").val());

        console.log(fecha1);

        if ($(this).val() != ""){
            var diferencia = fecha2.diff(fecha1, 'days');
            console.log(diferencia);
            if((diferencia/365.3) >= 18){
                alerta_fecha = 0;
                $("#rec_fn").removeAttr('style');
            }else{
                alerta_fecha = 1;
                if (alerta_fecha == 1){
                    swal("Cuidado! ", "No es mayor de edad. Verifique la fecha ingresada", "warning");
                    $("#rec_fn").attr('style','background-color: #ed8f8f');

                }

            }
               // console.log(fecha2.diff(fecha1, 'days'), ' dias de diferencia');
         }
});
function reciclador_add() {

    if (alerta_fecha == 1){
        swal("Cuidado! ", "No es mayor de edad. Verifique la fecha ingresada", "warning");
        $("#rec_fn").attr('style','background-color: red');

    }
    else{
        alerta_fecha = 0;
        $("#rec_fn").removeAttr('style');
    }

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
        rol_id: 2,
        fecha_registro: $("#fecha_registro").val(),
        operation: operation,
        is_param : es_proveedor
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


function zonas_list() {
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
                    html += '<option value="' + item.id + '">' + item.nombre + '</option>';
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



$('#rec_es_proveedor').on('ifChecked', function (event) {
    es_proveedor = 1;

});

$('#rec_es_proveedor').on('ifUnchecked', function (event) {
    es_proveedor = 0;
});



