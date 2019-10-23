var DIRECCION_WS = "http://localhost/www/muni_api/webservice/";
var cantidad_criterios = 0;
var data_criterios = null;
var criterios_val = [];
$(document).ready(function () {
    criterios_lista();
});

function criterios_lista() {
    // $("#combo_zona").empty();
    var ruta = DIRECCION_WS + "criterios_list.php";
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
                cantidad_criterios = datosJSON.datos.length;
                data_criterios = datosJSON.datos;
                var html = "";
                html += '<table id="table_criterios_comparacion" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th colspan="5">Comparacion de Criterios</th>';
                html += '</tr>';
                html += '<tr>';
                html += '<td>CRITERIOS</td>';

                $.each(datosJSON.datos, function (i, item) {
                    html += '<td>' + item.nombre + '</td>';
                });
                html += '</tr>';
                html += '</thead>';
                html += '<tbody id="cri_body_values">';
                $.each(datosJSON.datos, function (i, item) {

                    html += '<tr>';
                    html += '<td>' + item.nombre + '</td>';
                    var cont = 1;
                    for (var i = 0; i < datosJSON.datos.length; i++) {

                        html += '<td><select class="form-control select2" onclick="valdidate_pesos(' + item.id +'' + datosJSON.datos[i].id + ')" style="width: 100%;" ' +
                            'id="' + item.id + '' + datosJSON.datos[i].id + '" >\n' +
                            '                  <option value="0">Seleccione Valor</option>\n' +
                            '                  <option value="9">9</option>\n' +
                            '                  <option value="7">7</option>\n' +
                            '                  <option value="5">5</option>\n' +
                            '                  <option value="3">3</option>\n' +
                            '                  <option value="1">1</option>\n' +
                            '                  <option value="0.33">1/3</option>\n' +
                            '                  <option value="0.20">1/5</option>\n' +
                            '                  <option value="0.14">1/7</option>\n' +
                            '                  <option value="0.11">1/9</option>\n' +
                            '                </select></td>';
                        cont = cont + 1;
                    }

                    html += '</tr>';
                });
                html += '</tbody>';
                // html += '<tfoot>';
                // html += '<tr>';
                // html += '<th>SUMA</th>';
                // for (var i = 0; i < datosJSON.datos.length; i++) {
                //     html += '<td><input id="S'+ datosJSON.datos[i].id +'" readonly=""></td>';
                //     // html += '<th  id="S'+ datosJSON.datos[i].id +'"></th>';
                // }
                // html += '</tr>';
                // html += '</tfoot>';
                html += '</table>';

                $("#criterios_comparacion").html(html);
                $('#table_criterios_comparacion').DataTable({
                    "aaSorting": [[0, "asc"]],
                    "bbSorting": [[0, "asc"]],
                    "bScrollCollapse": true,
                    "bPaginate": true,
                    "sScrollX": "100%",
                    "sScrollXInner": "100%",
                });


            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}


var arrayDetalle = new Array();

function generate_algorit() {
    swal({
        title: 'Nota:',
        text: "Se generarán los pesos para los criterios",
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar!',
        cancelButtonText: 'Cancelar!'
    }).then(function (result) {
        if (result.value) {
            algoritmo_ahp();
        }

    })
}

function code_evalue() {
    var ruta = DIRECCION_WS + "code_search.php";
    var token = localStorage.getItem('token');

    var datos = {'p_code': $("#code_insert").val()};
    console.log(datos);

    $.ajax({
        type: "post",
        headers: {
            token: token
        },
        url: ruta,
        contentType: "application/json",
        data: JSON.stringify(datos),
        success: function (resultado) {
            console.log(resultado);
            var datosJSON = resultado;
            if (datosJSON.estado === 200) {
                swal({
                    type: 'success',
                    title: 'Bien',
                    text: datosJSON.mensaje,
                })
                $("#generar_algoritmo").removeAttr('style');
                $("#close_mdl_code").click();
                combos_equales();
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

function combos_equales(){

    for (var i = 1; i <= cantidad_criterios; i++) {
        for (var j = 1; j <= cantidad_criterios; j++) {
            //console.log("equals");
            if(i==j){
                $("#" + i + "" + j + "").attr('readonly','readonly');
                $("#" + i + "" + j + "").val('1');
            }


        }
    }
}

function valdidate_pesos(id){
    console.log("ide:" + id);
    var ide = "" + id + "";
    var id1 = ide.substring(0,1);
    var id2 = ide.substring(1,2);

    var val = $("#" + id +"").val();
    var contra_peso = 0;
    console.log(val);
    if(val == '9'){
        contra_peso = '0.11';
    }
    if(val == '7'){
        contra_peso = '0.14';
    }
    if(val == '5'){
        contra_peso = '0.20';
    }
    if(val == '3'){
        contra_peso = '0.33';
    }
    if(val == '0.33'){
        contra_peso = '3';
    }
    if(val == '0.20'){
        contra_peso = '5';
    }
    if(val == '0.14'){
        contra_peso = '7';
    }
    if(val == '0.11'){
        contra_peso = '9';
    }
    console.log(contra_peso);

    $("#" + id2 + ""+ id1 +"").val(contra_peso);
}

function algoritmo_ahp() {

    arrayDetalle.splice(0, arrayDetalle.length)

    for (var i = 1; i <= cantidad_criterios; i++) {
        for (var j = 1; j <= cantidad_criterios; j++) {
            var id = i + "" + j;
            var valor = $("#" + i + "" + j + "").val();
            var objDetalle = new Object();


            objDetalle.id = id;
            objDetalle.valor = valor;

            arrayDetalle.push(objDetalle);
        }
    }
    console.log(arrayDetalle);

    var suma_pie = [];
    for (var j = 1; j <= cantidad_criterios; j++) {
        var suma = 0;
        for (var i = 0; i < arrayDetalle.length; i++) {
            var item = arrayDetalle[i].id.substring(1, 2);
            //console.log(item);
            if (parseInt(item) == j) {
                var valor = $("#" + arrayDetalle[i].id + "").val();
                suma = suma + parseFloat(valor);
            }
        }
        var objDetalle = new Object();

        objDetalle.columna = j;
        objDetalle.valor = suma;
        console.log(suma);
        suma_pie.push(objDetalle);
    }
    console.log(suma_pie);

    var res_col = [];
    for (var j = 0; j < arrayDetalle.length; j++) {
        for (var i = 0; i < suma_pie.length; i++) {
            var item = arrayDetalle[j].id.substring(1, 2)
            if (suma_pie[i].columna == parseInt(item)) {
                var valor = $("#" + arrayDetalle[j].id + "").val();
                //console.log(valor);
                var v_fila = valor / suma_pie[i].valor;
                //console.log(v_fila)
            }
        }
        var objDetalle = new Object();

        objDetalle.fila = arrayDetalle[j].id;
        objDetalle.valor = v_fila;
        res_col.push(objDetalle);

    }


    console.log(res_col);

    criterios_val = [];

    for (var j = 1; j <= cantidad_criterios; j++) {
        var sum = 0;
        for (var i = 0; i < res_col.length; i++) {
            var item = res_col[i].fila.substring(0, 1);
            if (parseInt(item) == j) {
                sum = sum + res_col[i].valor;
            }
        }
        var prom = sum / cantidad_criterios;

        var objDetalle = new Object();

        objDetalle.criterio_id = j;
        objDetalle.valor = prom.toFixed(2);
        criterios_val.push(objDetalle);

    }
    console.log(criterios_val);

    var html = "";
    html += '<table id="criterios_table_value" class="table table-bordered table-striped">';
    html += '<thead>';
    html += '<tr style="background-color: #ededed; height:25px;">';
    html += '<th>CRITERIO</th>';
    html += '<th>VALOR</th>';
    html += '</thead>';
    html += '<tbody id="values_criterios">';
    $.each(data_criterios, function (i, item) {

        html += '<tr>';
        html += '<td>' + item.nombre + '</td>';
        for (var j = 0; j < criterios_val.length; j++) {
            if (item.id == criterios_val[j].criterio_id) {
                html += '<td>' + criterios_val[j].valor + '</td>';
            }
        }
        html += '</tr>';
    });
    html += '</tbody>';
    html += '</table>';

    $("#criterios_values").html(html);
    $('#criterios_table_value').DataTable({
        "aaSorting": [[0, "desc"]],
        "bScrollCollapse": true,
        "bPaginate": true,
        "sScrollX": "100%",
        "sScrollXInner": "100%",
    });

}

function criterios_values_save() {

    var ruta = DIRECCION_WS + "criterios_update.php";
    var token = localStorage.getItem('token');

    var datos = {'p_datos': criterios_val};

    swal({
        title: 'Consulta!',
        text: "Desea guardar los datos?",
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar!',
        cancelButtonText: 'Cancelar!'
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: "post",
                headers: {
                    token: token
                },
                url: ruta,
                contentType: "application/json",
                data: JSON.stringify(datos),
                success: function (resultado) {
                    console.log(resultado);
                    var datosJSON = resultado;
                    if (datosJSON.estado === 200) {

                        swal({
                            title: 'Bien',
                            text: datosJSON.mensaje,
                            type: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Aceptar!',
                            cancelButtonText: 'Cancelar!'
                        }).then(function (result) {
                                if (result.value) {
                                    window.location = "../Vista/criterios.php";
                                }
                            });

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
    });
}