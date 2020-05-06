var proveedor_id = null;
$(document).ready(function () {
    //alert("el tony kross");
    getUrlVars();


});

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
        vars[key] = value;
    });
    console.log(vars);
    console.log(vars.persona_id);
    proveedor_id = vars.persona_id;
    //return vars;
}


function validate_code() {

    var ruta = DIRECCION_WS + "code_validation.php";

    if (proveedor_id == null) {
        swal({
            type: 'info',
            title: 'Nota!',
            text: "No tiene acceso para guardar la información. Debe tener acceso desde la aplicación EasyWaste.",
        })
        return 0;
    }

    var data = {
        code: $("#code_validate").val(),
        proveedor_id: proveedor_id
    };

    console.log(data);

    $.ajax({
        type: "post",
        url: ruta,
        contentType: "application/json",
        data: JSON.stringify(data),
        success: function (resultado) {
            var datosJSON = resultado;
            console.log(resultado);
            if (datosJSON.estado === 200) {


                swal({
                    title: 'Genial !',
                    text: data.mensaje,
                    type: 'info',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar!'
                }).then(function (result) {
                    if (result.value) {
                        window.location = "../Vista/agradecimiento_validacion.php";
                    }

                });

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
