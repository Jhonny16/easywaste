
$(document).ready(function () {
    proveedor_pintrash()
});
var list_prov = [];
var list_premios = [];

function proveedor_pintrash() {

    $("#combo_proveedores_list").empty();
    var ruta = DIRECCION_WS + "proveedor_list_pintrash.php";
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
                html += '<option value="0">-- Todos los proveedores --</option>';
                list_prov = resultado.datos;
                $.each(datosJSON.datos, function (i, item) {
                    html += '<option value="' + item.id + '">' + item.dni + " - " + item.proveedor + '</option>';
                });
                $("#combo_proveedores_list").append(html);
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}

$("#combo_proveedores_list").change(function () {
    var pintrash = null;
    var id = $("#combo_proveedores_list").val();
    for (var i = 0; i < list_prov.length; i++) {
        if (list_prov[i].id == id) {
            pintrash = list_prov[i].pintrash;
        }
    }

    $("#txt_pintrash").val(pintrash);

    premios_list(pintrash);
});


function premios_list(pintrash) {

    $("#combo_premios_list").empty();
    var ruta = DIRECCION_WS + "premio_pintrash_list.php";
    var token = localStorage.getItem('token');

    console.log(ruta);
    $.ajax({
        type: "post",
        headers: {
            token: token
        },
        url: ruta,
        contentType: "application/json",
        data: JSON.stringify({'pintrash': pintrash}),
        success: function (resultado) {
            console.log(resultado);
            var datosJSON = resultado;
            if (datosJSON.estado === 200) {
                list_premios = resultado.datos;
                var html = "";
                html += '<option value="0">-- Seleccione premio--</option>';
                list_prov = resultado.datos;
                $.each(datosJSON.datos, function (i, item) {
                    html += '<option value="' + item.id + '">Premio: ' + item.nombre + " - Pintrash: " + item.pintrash + '</option>';
                });
                $("#combo_premios_list").append(html);
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}

var pintrash_premio = null
$("#combo_premios_list").change(function () {
    var stock = null;
    var id = $("#combo_premios_list").val();
    for (var i = 0; i < list_premios.length; i++) {
        if (list_premios[i].id == id) {
            stock = list_premios[i].stock;
            pintrash_premio = list_premios[i].pintrash;
        }
    }

    $("#txt_stock").val(stock);

});

function add_det_premio() {

    var proveedores = $("#combo_proveedores_list").val();
    var premios = $("#combo_premios_list").val();
    var cantidad = $("#txt_cantidad").val();


    if (proveedores == "0" || proveedores == "" ) {
        swal({
            type: 'warning',
            title: 'Nota',
            text: 'Debe seleccionar proveedor!',
        })
        return 0;
    }
    if (premios == "" || premios == "0") {
        swal({
            type: 'warning',
            title: 'Nota',
            text: 'Debe seleccionar Premio!',
        })
        return 0;
    }


    if (cantidad == "" || cantidad == "0") {
        swal({
            type: 'warning',
            title: 'Nota',
            text: 'Debe seleccionar Cantidad!',
        })
        return 0;
    }

    console.log("detail_pppp");
    var nombre = "";
    var puntos = "";
    var id = "";
    console.log(list_premios);
    for (var i = 0; i < list_premios.length; i++) {
        if (premios == list_premios[i].id) {
            nombre = list_premios[i].nombre;
            puntos = list_premios[i].pintrash;
            id = list_premios[i].id;
            break;
        }
    }

    var total_puntos = parseInt(puntos) * parseInt(cantidad);

    var res = calcular_total();

    var total_actual = res + parseInt(total_puntos);

    var pintrash = $("#txt_pintrash").val();
    if(total_actual>parseInt(pintrash)){

        swal({
            type: 'warning',
            title: 'Nota',
            text: 'Excedio el puntaje pintrash!',
        })
        return 0;
    }

    var fila = "<tr>" +
        "<td style=\"text-align: right\" >" + id + "</td>" +
        "<td style=\"text-align: right\" >" + nombre + "</td>" +
        "<td style=\"text-align: right\" id=>" + cantidad + "</td>" +
        "<td style=\"text-align: right\" id=>" + total_puntos + "</td>" +
        "<td align=\"center\" id=\"celiminar\"><a href=\"javascript:void();\"><i class=\"fa fa-trash text-red\"></i></a></td>" +
        "</tr>";

    $("#tbl_premio_canje").append(fila);

    $("#combo_premios_list").val("0");
    $("#txt_cantidad").val("");

    calcular_total();
}

$(document).on("click", "#celiminar", function () {
    if (!confirm("Esta seguro de elimina el registro seleccionado")) {
        return 0;
    }
    var fila = $(this).parents().get(0); //capturar la fila que deseamos eliminar
    fila.remove(); //eliminar la fila

    calcular_total();
});

function calcular_total(){
    var importeNeto = 0;
    $("#tbl_premio_canje tr").each(function () {
        var importe = $(this).find("td").eq(2).html();
        console.log(importe);
        importeNeto = importeNeto + parseFloat(importe);
    });

    $("#total_puntos").html(importeNeto.toFixed(2));

    return importeNeto;


}


var arrayDetalle = new Array();
function guardar_canje() {

    var ruta = DIRECCION_WS + "canje_create.php";
    var token = localStorage.getItem('token');


    swal({
        title: 'Nota',
        text: "Desea guardar el canje?'!",
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar!',
        cancelButtonText: 'Cancelar!'
    }).then(function (result) {
        if (result.value) {

            arrayDetalle.splice(0, arrayDetalle.length);

            $("#tbl_premio_canje tr").each(function () {
                var premio_id = $(this).find("td").eq(0).html();
                var sub_pintrash = $(this).find("td").eq(2).html();
                var persona_id = $("#combo_proveedores_list").val();
                var objDetalle = new Object(); //Crear un objeto para almacenar los datos

                /*declaramos y asignamos los valores a los atributos*/
                objDetalle.premio_id = premio_id;
                objDetalle.sub_pintrash = sub_pintrash;

                //Almacenar al objeto objDetalle en el array arrayDetalle
                arrayDetalle.push(objDetalle);

            });
            var jsonDetalle = JSON.stringify(arrayDetalle);

            var pintrash_prov = $("#txt_pintrash").val();
            var pintrash_total = $("#total_puntos").html();

            var pintrash_actual = parseInt(pintrash_prov) - parseInt(pintrash_total);
            var data = {
                descuento: parseInt(pintrash_total),
                pintrash_actual: pintrash_actual,
                persona_id: $("#combo_proveedores_list").val(),
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