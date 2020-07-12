
var list_residuos;
var user_id = localStorage.getItem('id');
$(document).ready(function () {
    //residuos();
    centro_acopio();
    reciclador_list();
});

$("#combo_reciclador").change(function () {
    console.log(this.value);
    residuos(this.value);
})

function residuos(id){
    $("#combo_tipo_residuo").empty();
    var token = localStorage.getItem('token');
    var ruta = DIRECCION_WS + "residuo_por_reciclador.php";


    $.ajax({
        type: "post",
        headers: {
            token: token
        },
        url: ruta,
        contentType: "application/json",
        data: JSON.stringify({'reciclador_id':  id}),
        success: function (resultado) {
            console.log(resultado);
            var datosJSON = resultado;
            if (datosJSON.estado === 200) {
                var html = "";
                html += '<option value="0">-- Seleccione residuo --</option>';
                list_residuos = resultado.datos;
                $.each(datosJSON.datos, function (i, item) {
                    html += '<option value="'+ item.id +'">Residuo: ' + item.nombre +' / Stock: ' + item.cantidad+'</option>';
                });
                $("#combo_tipo_residuo").append(html);
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}

function centro_acopio(){
    $("#combo_centro_acopio_f").empty();
    var ruta = DIRECCION_WS + "acopio_final.php";
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
                $("#combo_centro_acopio_f").append(html);
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}

function reciclador_list(){
    $("#combo_reciclador").empty();
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
                $("#combo_reciclador").append(html);
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}


function add_preventa(){
    var residuo_id = $("#combo_tipo_residuo").val();
    var sw=0;
    $("#tblv_detalle tr").each(function () {
        var res_id = $(this).find("td").eq(0).html();
        if (residuo_id== res_id){
            sw=1;
            return 0;
        }

    });
    if (sw==1){
        swal({
            type: 'warning',
            title: 'Nota',
            text: 'Este residuo ya está ingresado en el detalle de la venta.',
        })
        return 0;
    }else{
        console.log("add");
        var peso = $("#txt_peso").val();
        var price = $("#txt_price").val();

        if (peso == "" || parseInt(peso) == 0) {
            swal({
                type: 'warning',
                title: 'Nota',
                text: 'Debe ingresar el peso!',
            })
            $("#txt_peso").focus;
            return 0;
        }
        if (price == "" || parseInt(price) == 0) {
            swal({
                type: 'warning',
                title: 'Nota',
                text: 'Debe ingresar el precio!',
            })
            $("#txt_price").focus;
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
            "<td style=\"text-align: right\"  >" + peso + "</td>" +
            "<td style=\"text-align: right\"  >" + price + "</td>" +
            "<td style=\"text-align: right\"  >" + peso * price + "</td>" +
            "<td align=\"center\" id=\"celiminar\"><a href=\"javascript:void();\"><i class=\"fa fa-trash text-red\"></i></a></td>" +
            "</tr>";

        $("#tblv_detalle").append(fila);

        $("#combo_tipo_residuo").val("0");
        $("#txt_peso").val("");
        $("#txt_price").val("");

        calcular_total();
    }


}

function calcular_total(){
    var importeNeto = 0;
    $("#tblv_detalle tr").each(function () {
        var peso = $(this).find("td").eq(2).html();
        var precio = $(this).find("td").eq(3).html();
        var subtotal = $(this).find("td").eq(4).html();
        console.log(subtotal);
        importeNeto = importeNeto + parseFloat(subtotal);
    });

    $("#total").html(importeNeto.toFixed(2));
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
function guardar_venta() {

    var ruta = DIRECCION_WS + "venta_create.php";
    var token = localStorage.getItem('token');

    var centro_acopio_t = $("#combo_centro_acopio_f").val();
    var reciclador = $("#combo_reciclador").val();
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

            $("#tblv_detalle tr").each(function () {
                var residuo_id = $(this).find("td").eq(0).html();
                var cantidad = $(this).find("td").eq(2).html();
                var precio = $(this).find("td").eq(3).html();
                var subtotal = $(this).find("td").eq(4).html();
                var objDetalle = new Object(); //Crear un objeto para almacenar los datos

                /*declaramos y asignamos los valores a los atributos*/
                objDetalle.residuo_id = residuo_id;
                objDetalle.cantidad = cantidad;
                objDetalle.precio = precio;
                objDetalle.subtotal = subtotal;
                //Almacenar al objeto objDetalle en el array arrayDetalle
                arrayDetalle.push(objDetalle);

            });
            var jsonDetalle = JSON.stringify(arrayDetalle);
            var data = {
                numero_documento: $("#numero_documento").val(),
                reciclador_id: $("#combo_reciclador").val(),
                user_id: user_id,
                acopio_final_id: $("#combo_centro_acopio_f").val(),
                precio_total: $("#total").html(),
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
                                window.location = "../Vista/venta_lista.php";
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