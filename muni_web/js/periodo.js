var DIRECCION_WS = "http://localhost/www/muni_api/webservice/";
var periodo_estado = 0;
$(document).ready(function () {
    periodo_listar();

});
$("#btn_nuevo_periodo").click(function () {
    periodo_limpiar_modal();
    $("#txtperiodo_toperacion").val("nuevo");
    $("#periodo_title_modal").html("Nuevo Periodo");
    ultima_fecha();


});
function periodo_limpiar_modal() {
    $("#periodo_fecha_fin").val("");
    $("#periodo_fecha_inicio").val("");
    $("#periodo_descripcion").val("");
    $("#periodo_fecha_fin").removeAttr('disabled');
    $("#periodo_descripcion").removeAttr('disabled');


}

function periodo_listar(){
    var ruta = DIRECCION_WS + "periodos_list.php";
    var token = localStorage.getItem('token');
    console.log(ruta);
    $.ajax({
        type: "get",
        headers: {
            token: token
        },
        url: ruta,
        contentType: "application/json",
        data: {},
        success: function (resultado) {
            console.log(resultado);
            var datosJSON = resultado;
            if (datosJSON.estado === 200) {
                var html = "";

                html += '<table id="tabla_lista_periodos" class="table table-bordered table-striped">';
                html += '<thead>';
                html += '<tr style="background-color: #ededed; height:25px;">';
                html += '<th style="text-align: center">Acciones</th>';
                html += '<th>Fecha inicio</th>';
                html += '<th>Fecha fin</th>';
                html += '<th>Descripcion</th>';
                html += '<th>Estado</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';

                $.each(datosJSON.datos, function (i, item) {

                    html += '<tr>';
                    html += '<td style="text-align: center"><a type="button" title="Editar" data-toggle="modal" ' +
                        'onclick="read_periodo(' + item.id + ')" ' +
                        'data-target="#mdl_periodo" ><i class="fa fa-edit text-aqua"></i></a></td>';
                    html += '<td>' + item.fecha_inicio + '</td>';
                    html += '<td>' + item.fecha_fin + '</td>';
                    html += '<td>' + item.descripcion + '</td>';
                    if(item.estado=='1'){
                        html += '<td>Activo</td>';
                    }else{
                        html += '<td>No Activo</td>';
                    }
                    html += '</tr>';
                });
                html += '</tbody>';
                html += '</table>';

                $("#listado_periodos").html(html);
                $('#tabla_lista_periodos').DataTable({
                    "aaSorting": [[1, "desc"]],
                    "sScrollX": "100%",
                    "sScrollXInner": "100%",
                    "bScrollCollapse": true,
                    "bPaginate": true
                })
            } else {
                console.log(resultado);
                swal("Mensaje del sistema", resultado.mensaje, "warning");
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}

function ultima_fecha(){
    var ruta = DIRECCION_WS + "periodo_ultima_fecha.php";
    var token = localStorage.getItem('token');
    $.ajax({
        type: "get",
        headers: {
            token: token
        },
        url: ruta,
        contentType: "application/json",
        data: {},
        success: function (resultado) {
            var datosJSON = resultado;
            console.log(resultado);
            if (datosJSON.estado === 200) {
                $("#periodo_fecha_inicio").attr('readonly','readonly');
                $("#periodo_fecha_inicio").val(resultado.datos.fecha_fin);

            } else {
                console.log(resultado);
                //swal("Mensaje del sistema", resultado.mensaje, "warning");
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}

function periodo_add() {
    var ruta = DIRECCION_WS + "periodo_create.php";
    var token = localStorage.getItem('token');

    //alert("yupe");
    var operacion = $("#txtperiodo_toperacion").val();
    var data = {
        p_periodo_id: $("#txtperiodo_id").val(),
        p_fecha_inicio: $("#periodo_fecha_inicio").val(),
        p_fecha_fin: $("#periodo_fecha_fin").val(),
        p_descripcion: $("#periodo_descripcion").val(),
        p_estado: periodo_estado,
        p_operacion: operacion
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
            var datosJSON = resultado;
            console.log(resultado);
            if (datosJSON.estado === 200) {
                swal("Exito", datosJSON.mensaje, "success");
                periodo_listar();

            } else {
                swal("Nota", datosJSON.mensaje, "info");
                console.log(resultado)
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });

}
$('#periodo_activo').on('ifChecked', function (event) {
    periodo_estado = 1;
});
$('#periodo_noactivo').on('ifChecked', function (event) {
    periodo_estado = 0;
});

function read_periodo(id) {
    var ruta = DIRECCION_WS + "periodo_read.php";
    var token = localStorage.getItem('token');

    var data = {'p_id' : id};

    $.ajax({
        type: "post",
        headers: {
            token: token
        },
        url: ruta,
        contentType: "application/json",
        data: JSON.stringify(data),
        success: function (resultado) {
            var jsonResultado = resultado;
            if (jsonResultado.estado === 200) {
                console.log(resultado);

                $("#txtperiodo_toperacion").val("editar");
                $("#periodo_title_modal").html("Editar Periodo");
                $("#txtperiodo_id").val(jsonResultado.datos.id);
                if (jsonResultado.datos.estado === '1') {
                    $("#periodo_activo").iCheck('check');
                } else {
                    $("#periodo_noactivo").iCheck('check');
                }
                $("#periodo_fecha_inicio").val(jsonResultado.datos.fecha_inicio);
                $("#periodo_fecha_fin").val(jsonResultado.datos.fecha_fin);
                $("#periodo_descripcion").val(jsonResultado.datos.descripcion);

                if(resultado.datos.vigencia == -1){

                    $("#periodo_fecha_inicio").attr('disabled','disabled');
                    $("#periodo_fecha_fin").attr('disabled','disabled');
                    $("#periodo_descripcion").attr('disabled','disabled');
                    if(resultado.datos.estado=='1'){

                    }else{
                        $("#periodo_v").removeAttr('style');
                        $("#periodo_activo").attr('disabled','disabled');
                        $("#periodo_noactivo").attr('disabled','disabled');
                    }

                }else{
                    $("#periodo_activo").removeAttr('disabled');
                    $("#periodo_noactivo").removeAttr('disabled');
                    $("#periodo_fecha_inicio").removeAttr('disabled');
                    $("#periodo_fecha_fin").removeAttr('disabled');
                    $("#periodo_descripcion").removeAttr('disabled');
                    $("#periodo_v").attr('style','display:none');
                }
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });
}

