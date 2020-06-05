
var list_venta = [];
$(document).ready(function () {
    listado();
    centro_acopio_final();
});

function listado() {
    var ruta = DIRECCION_WS + "venta_list.php";
    var token = localStorage.getItem('token');

    $("#ventas_lista").html("");
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
                list_venta = resultado.datos;
                var html = "";
                html += '<table id="venta_table_list" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th style="text-align: center">Detalle</th>';
                html += '<th>COMPROBANTE</th>';
                html += '<th>RECICLADOR</th>';
                html += '<th>FECHA REGISTRO</th>';
                html += '<th>CENTRO ACOPIO FINAL</th>';
                html += '<th>PRECIO TOTAL</th>';
                html += '<th>ESTADO</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';
                $.each(datosJSON.datos, function (i, item) {
                    html += '<tr>';
                    html += '<td style="text-align: center">';
                    html += '<a type="button" title="Detalle de Venta" data-toggle="modal" data-target="#modal-success-detalle"' +
                        ' onclick="data_modal(' + item.venta_id + ')">' +
                        '<i class="fa fa-outdent text-light" aria-hidden="true"></i></a>';
                    html += '</td>'
                    //+
                    html += '<td>' + item.documento_referencia + '</td>';
                    html += '<td>' + item.reciclador + '</td>';
                    html += '<td>' + item.fecha_registro + '</td>';
                    html += '<td>' + item.centro_acopio_f + '</td>';
                    html += '<td>' + item.precio_total + '</td>';
                    html += '<td>' + item.estado + '</td>';
                    html += '</tr>';
                });
                html += '</tbody>';
                html += '</table>';

                $("#ventas_lista").html(html);
                $('#venta_table_list').DataTable({
                    "aaSorting": [[0, "desc"]],
                    "bScrollCollapse": true,
                    "bPaginate": true,
                    "sScrollX": "110%",
                    "sScrollXInner": "110%",
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
var acopio_final = "0";
function data_modal(id) {
    var ruta = DIRECCION_WS + "venta_detalle.php";
    var token = localStorage.getItem('token');

    var code = "";
    var state = "";
    var price_total = 0;

    for (var i = 0; i < list_venta.length; i++) {
        if (id == list_venta[i].venta_id) {
            code = list_venta[i].code;
            state = list_venta[i].estado;
            price_total = list_venta[i].precio_total;
            acopio_final= list_venta[i].acopio_final_id;
            break;
        }
    }

    $("#sale_id").val(id);

    $("#tabla_venta_detalle").html("");

    $.ajax({
        type: "post",
        headers: {
            token: token
        },
        url: ruta,
        data: JSON.stringify({'venta_id': id}),
        success: function (resultado) {
            console.log(resultado)
            var datosJSON = resultado;
            if (datosJSON.estado == 200) {
                $("#venta_code").html(datosJSON.datos[0].documento_referencia);
                //alert(acopio_final);
                // if(state == 'Vendido'){
                //     ca_final(acopio_final);
                //     $("#combo_acopio_final").val(acopio_final);
                //     $("#precio_total").html(price_total);
                // }

                var html = "";
                html += '<table id="tabla_venta_detalle_t" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th style="text-align: center">#</th>';
                html += '<th>Residuo</th>';
                html += '<th>Peso</th>';
                html += '<th style="width:25px;">Precio</th>';
                html += '<th>Sub total</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody id="det_detalle">';
                $.each(datosJSON.datos, function (i, item) {
                    html += '<tr>';
                    html += '<td>' + item.id + '</td>';
                    html += '<td>' + item.nombre + '</td>';
                    html += '<td>' + item.cantidad + '</td>';
                    if(state == 'Vendido'){
                        html += '<td>' + item.precio +'</td>'
                    }else{
                        html += '<td><input type="number" id="txt_precio'+ item.id +'" placeholder="Ingrese precio" ' +
                            'onchange="al_cambiar(' + item.id + ')"></td>';
                        html += '<td id="precio'+ item.id +'" style="display: none"></td>';
                    }

                    html += '<td id="subtotal'+ item.id +'">' + item.sub_total + '</td>';
                    html += '</tr>';
                });
                html += '</tbody>';
                html += '</table>';

                $("#tabla_venta_detalle").html(html);
                // $('#tabla_venta_detalle_t').DataTable({
                //     "aaSorting": [[0, "desc"]],
                //     "bScrollCollapse": true,
                //     "bPaginate": true,
                //     "sScrollX": "100%",
                //     "sScrollXInner": "100%",
                // });


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

function centro_acopio_final() {
    $("#combo_acopio_final").empty();
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
                    html += '<option value="' + item.id + '">' + item.nombre + '</option>';
                });
                $("#combo_acopio_final").append(html);
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}

function nuevo() {
    window.location = "../Vista/venta.php";
}

/*function al_cambiar(id) {
    var total = 0.0;
    var subtotal = 0.0;
    var precio = $("#txt_precio" + id).val();
    $("#precio" + id).html(precio);

    $("#det_detalle tr").each(function () {

        var ide = $(this).find("td").eq(0).html();
        var peso = $(this).find("td").eq(2).html();

        if(id == ide){
            subtotal = parseFloat(precio) * parseFloat(peso);
            $("#subtotal" + id).html(subtotal.toFixed(2));
            return false;
        }



        //var price = $(this).find("td").eq(4).html();
        //console.log(peso);
        //console.log(price);
        //subtotal = parseFloat(price) * parseFloat(peso);


        //total = subtotal + total;
    });

    $("#det_detalle tr").each(function () {
        var sub_total = $(this).find("td").eq(5).html();

        // console.log(peso);
        // console.log(price);
        // subtotal = parseFloat(sub_total) * parseFloat(peso);
        //
        // $("#subtotal" + id).html(subtotal.toFixed(2));
        total = parseFloat(sub_total) + total;
    });

    console.log("total");
    console.log(total);

    $("#precio_total").html(total.toFixed(2));

    // $("#det_detalle tr").each(function () {
    //     var peso = $(this).find("td").eq(2).html();
    //     var price = $(this).find("td").eq(4).html();
    //     console.log(peso);
    //     console.log(price);
    //     subtotal = parseFloat(price) * parseFloat(peso);
    //
    //     $("#subtotal" + id).html(subtotal.toFixed(2));
    //     total = subtotal + total;
    // });


}*/
/*
var arrayDetalle = new Array();
function save_detail(){

    var ruta = DIRECCION_WS + "venta_update.php";
    var token = localStorage.getItem('token');

    var acopio_final = $("#combo_acopio_final").val();
    if(acopio_final=='0'){
        swal({
            type: 'warning',
            title: 'Nota',
            text: 'Debe seleccionar el centro de acopio final!',
        })
        return 0;
    }

    swal({
        title: 'Nota',
        text: "Desea guardar los cambios?'!",
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar!',
        cancelButtonText: 'Cancelar!'
    }).then(function (result) {
        if (result.value) {

            arrayDetalle.splice(0, arrayDetalle.length);

            $("#det_detalle tr").each(function () {
                var id = $(this).find("td").eq(0).html();
                var peso = $(this).find("td").eq(2).html();
                var precio = $(this).find("td").eq(4).html();
                var sub_total = $(this).find("td").eq(5).html();

                var objDetalle = new Object();
                objDetalle.detalle_id = id;
                objDetalle.peso = peso;
                objDetalle.precio = precio;
                objDetalle.sub_total = sub_total;

                arrayDetalle.push(objDetalle);

            });
            var jsonDetalle = JSON.stringify(arrayDetalle);
            var data = {
                venta_id: $("#sale_id").val(),
                estado: 'Vendido',
                acopio_final_id: $("#combo_acopio_final").val(),
                precio_total: $("#precio_total").html(),
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


}*/

//
// function ca_final(id) {
//     $("#combo_acopio_final").empty();
//     var ruta = DIRECCION_WS + "acopio_final.php";
//     console.log(ruta);
//     $.ajax({
//         type: "get",
//         url: ruta,
//         data: {},
//         success: function (resultado) {
//             console.log(resultado);
//             var datosJSON = resultado;
//             if (datosJSON.estado === 200) {
//                 var html = "";
//                 html += '<option value="0">-- Seleccione centro acopio --</option>';
//                 $.each(datosJSON.datos, function (i, item) {
//                     if(item.id == acopio_final){
//                         html += '<option value="' + item.id + '" selected>' + item.nombre + '</option>';
//
//                     }else{
//                         html += '<option value="' + item.id + '">' + item.nombre + '</option>';
//
//                     }
//                 });
//                 $("#combo_acopio_final").append(html);
//             }
//         },
//         error: function (error) {
//             console.log(error);
//             var datosJSON = $.parseJSON(error.responseText);
//             swal("Error", datosJSON.mensaje, "error");
//         }
//     });
// }
