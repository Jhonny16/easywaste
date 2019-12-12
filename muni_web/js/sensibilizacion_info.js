var DIRECCION_WS = "http://localhost/www/muni_api/webservice/";
var persona_id = null;
var list_info = [];
$(document).ready(function () {
   //alert("el tony kross");
   getUrlVars();

   listado();
});


function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    console.log(vars);
    console.log(vars.persona);
    persona_id = vars.persona;
    //return vars;
}

function listado() {
    var ruta = DIRECCION_WS + "informacion_list_persona.php";

    var data = {'persona_id': persona_id};

    $("#data_informacion").html("");
    $.ajax({
        type: "post",
        url: ruta,
        data: JSON.stringify(data),
        success: function (resultado) {
            console.log(resultado);
            var datosJSON = resultado;
            if (datosJSON.estado == 200) {
                list_info = resultado.datos;
                var html = "";
                $.each(datosJSON.datos, function (i, item) {

                    html += ' <div class="col-lg-4 col-xs-12" style="text-align: center">' + '<img width="230" height="230" ' +
                        'src="../imagenes/informacion/'+ item.imagen+'" data-toggle="modal" data-target="#modal_descripcion" ' +
                        'onclick="des(' + item.id + ')" alt="">'+'<br>'+ item.titulo+' </div>';

                });

                $("#data_informacion").html(html);

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
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });


}
var respuesta = 0;
$('#info_si').on('ifChecked', function (event) {
    respuesta = 1;
});
$('#info_no').on('ifChecked', function (event) {
    respuesta = 0;
});


function sensibilizacion_add() {
    var ruta = DIRECCION_WS + "sensibilizacion_create.php";
    var token = localStorage.getItem('token');

    if(persona_id == null){
        swal({
            type: 'info',
            title: 'Nota!',
            text: "No tiene acceso para guardar la información. Debe tener acceso desde la aplicación EasyWaste.",
        })
        return 0;
    }

    var data = {
        comentario: $("#info_observacion").val(),
        respuesta: respuesta,
        persona_id: persona_id
    };

    console.log(data);


    swal({
        title: 'Nota !',
        text: "Desea usted guardar la información? ",
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
                data: JSON.stringify(data),
                success: function (resultado) {
                    var datosJSON = resultado;
                    console.log(resultado);
                    if (datosJSON.estado === 200) {
                        swal("Exito", datosJSON.mensaje, "success");

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

    })



}

function des(id){
    $("#info_descripcion").val("")
    for(var i=0; i<list_info.length; i++){
        if(list_info[i].id == id){
            $("#info_descripcion").val(list_info[i].descripcion);
            break;
        }
    }

}