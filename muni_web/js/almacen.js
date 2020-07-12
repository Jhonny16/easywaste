
var list_residuos;
var user_id = localStorage.getItem('id');
$(document).ready(function () {
    a_residuos();
    a_centro_acopio();
    a_reciclador_list();
});

function a_residuos(){
    $("#a_combo_tipo_residuo").empty();
    var ruta = DIRECCION_WS + "residuo_list.php";
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
                html += '<option value="0">-- Seleccione residuo --</option>';
                list_residuos = resultado.datos;
                $.each(datosJSON.datos, function (i, item) {
                    html += '<option value="'+ item.id +'">' + item.nombre +'</option>';
                });
                $("#a_combo_tipo_residuo").append(html);
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}

function a_centro_acopio(){
    $("#a_combo_centro_acopio_t").empty();
    var ruta = DIRECCION_WS + "acopio_temporal.php";
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
                html += '<option value="0">-- Seleccione centro acopio --</option>';
                $.each(datosJSON.datos, function (i, item) {
                    html += '<option value="'+ item.id +'">' + item.nombre +'</option>';
                });
                $("#a_combo_centro_acopio_t").append(html);
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}


$("#a_combo_centro_acopio_t").change(function () {
    a_sector(this.value);
});

function a_sector(ca_id){

    $("#a_sector").empty();

    var ruta = DIRECCION_WS + "acopio_sector.php";
    var token = localStorage.getItem('token');

    console.log(ruta);
    $.ajax({
        type: "post",
        headers: {
            token: token
        },
        url: ruta,
        contentType: "application/json",
        data: JSON.stringify({'id': ca_id}),
        success: function (resultado) {
            console.log(resultado);
            var datosJSON = resultado;
            if (datosJSON.estado === 200) {
                var html = "";
                html += '<option value="0">-- Seleccione sector --</option>';
                $.each(resultado.datos, function (i, item) {
                    if (item.nombre != '-'){
                        console.log(item.nombre);
                        html += '<option value="'+ item.nombre +'">' + item.nombre +'</option>';
                    }

                });
                $("#a_sector").append(html);
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}

function a_reciclador_list(){
    $("#a_combo_reciclador").empty();
    var ruta = DIRECCION_WS + "reciclador_list.php";
    var token = localStorage.getItem('token');
    console.log(ruta);
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
            if (datosJSON.estado === 200) {
                var html = "";
                html += '<option value="0">-- Seleccione reciclador --</option>';
                $.each(datosJSON.datos, function (i, item) {
                    if(item.estado != 'I'){
                        html += '<option value="'+ item.id +'">' + item.ap_paterno + ' '+ item.ap_materno + ' '+ item.nombres  +'</option>';

                    }
                });
                $("#a_combo_reciclador").append(html);
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}

function add_almacen(){

    console.log("add");
    var residuo_id = $("#a_combo_tipo_residuo").val();
    var peso = $("#a_txt_peso").val();

    if (peso == "" || parseInt(peso) == 0) {
        swal({
            type: 'warning',
            title: 'Nota',
            text: 'Debe ingresar el peso!',
        })
        $("#txt_peso").focus;
        return 0;
    }

    if (residuo_id == "0") {
        swal({
            type: 'warning',
            title: 'Nota',
            text: 'Debe seleccionar residuo!',
        })
        return 0;
    }

    console.log("detail_pppp");
    var nombre = "";
    console.log(list_residuos);
    for(var i=0; i < list_residuos.length; i++){
        if(residuo_id == list_residuos[i].id){
            nombre = list_residuos[i].nombre;
            break;
        }
    }


    var fila = "<tr>" +
        "<td>" + residuo_id + "</td>" +
        "<td style=\"text-align: right\" >" + nombre + "</td>" +
        "<td style=\"text-align: right\" id=>" + peso + "</td>" +
        "<td align=\"center\" id=\"celiminar\"><a href=\"javascript:void();\"><i class=\"fa fa-trash text-red\"></i></a></td>" +
        "</tr>";

    $("#tbla_detalle").append(fila);

    $("#a_combo_tipo_residuo").val("");
    $("#a_txt_peso").val("");

    calcular_total();
}

function calcular_total(){
    var importeNeto = 0;
    $("#tbla_detalle tr").each(function () {
        var importe = $(this).find("td").eq(2).html();
        console.log(importe);
        importeNeto = importeNeto + parseFloat(importe);
    });

    $("#a_total").html(importeNeto.toFixed(2));
}


$(document).on("click", "#celiminar", function () {
    if (!confirm("Esta seguro de elimina el registro seleccionado")) {
        return 0;
    }
    var fila = $(this).parents().get(0); //capturar la fila que deseamos eliminar
    fila.remove(); //eliminar la fila

    calcular_total();
});

var arrayDetalle = new Array();
function guardar_en_almacen() {

    var ruta = DIRECCION_WS + "almacen_create.php";
    var token = localStorage.getItem('token');

    var centro_acopio_t = $("#a_combo_centro_acopio_t").val();
    var reciclador = $("#a_combo_reciclador").val();
    if(centro_acopio_t=='0'){
        swal({
            type: 'warning',
            title: 'Nota',
            text: 'Debe seleccionar el centro de acopio temporal!',
        })
        return 0;
    }

    if(reciclador=='0'){
        swal({
            type: 'warning',
            title: 'Nota',
            text: 'Debe seleccionar el reciclador!',
        })
        return 0;
    }

    swal({
        title: 'Nota',
        text: "Desea guardar la venta?'!",
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar!',
        cancelButtonText: 'Cancelar!'
    }).then(function (result) {
        if (result.value) {

            arrayDetalle.splice(0, arrayDetalle.length);

            $("#tbla_detalle tr").each(function () {
                var residuo_id = $(this).find("td").eq(0).html();
                var peso = $(this).find("td").eq(2).html();
                var objDetalle = new Object(); //Crear un objeto para almacenar los datos

                /*declaramos y asignamos los valores a los atributos*/
                objDetalle.residuo_id = residuo_id;
                objDetalle.cantidad = peso;

                //Almacenar al objeto objDetalle en el array arrayDetalle
                arrayDetalle.push(objDetalle);

            });
            var jsonDetalle = JSON.stringify(arrayDetalle);
            var data = {
                reciclador_id: $("#a_combo_reciclador").val(),
                user_id: user_id,
                acopio_temporal_id: $("#a_combo_centro_acopio_t").val(),
                sector_name: $("#a_sector").val(),
                total: $("#a_total").html(),
                detalle: jsonDetalle
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
                                window.location = "../Vista/almacen_lista.php";
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

    })
}