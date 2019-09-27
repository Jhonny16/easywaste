/**
 * Created by tito_ on 23/10/2018.
 */
var DIRECCION_WS = "http://localhost/www/muni_api/webservice/";
$(document).ready(function () {
    loadProfile();
});

/**
 * Function that gets the data of the profile in case
 * thar it has already saved in localstorage. Only the
 * UI will be update in case that all data is available
 *
 * A not existing key in localstorage return null
 *
 */
function getLocalProfile(callback) {
    var profileImgSrc = localStorage.getItem("PROFILE_IMG_SRC");
    var profileName = localStorage.getItem("PROFILE_NAME");
    var profileReAuthEmail = localStorage.getItem("PROFILE_REAUTH_EMAIL");

    if (profileName !== null
        && profileReAuthEmail !== null
        && profileImgSrc !== null) {
        callback(profileImgSrc, profileName, profileReAuthEmail);
    }
}

/**
 * Main function that load the profile if exists
 * in localstorage
 */
function loadProfile() {

    if (!supportsHTML5Storage()) {
        return false;
    }
    // we have to provide to the callback the basic
    // information to set the profile
    getLocalProfile(function (profileImgSrc, profileName, profileReAuthEmail) {
        //changes in the UI
        $("#profile-img").attr("src", profileImgSrc);
        $("#profile-name").html(profileName);
        $("#reauth-email").html(profileReAuthEmail);
        $("#inputEmail").hide();
        $("#remember").hide();
    });
}

/**
 * function that checks if the browser supports HTML5
 * local storage
 *
 * @returns {boolean}
 */
function supportsHTML5Storage() {
    try {
        return 'localStorage' in window && window['localStorage'] !== null;
    } catch (e) {
        return false;
    }
}

/**
 * Test data. This data will be safe by the web app
 * in the first successful login of a auth user.
 * To Test the scripts, delete the localstorage data
 * and comment this call.
 *
 * @returns {boolean}
 */
function testLocalStorageData() {
    if (!supportsHTML5Storage()) {
        return false;
    }
    localStorage.setItem("PROFILE_IMG_SRC", "//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120");
    localStorage.setItem("PROFILE_NAME", "César Izquierdo Tello");
    localStorage.setItem("PROFILE_REAUTH_EMAIL", "oneaccount@gmail.com");
}

//var ruta = "https://webservicespropio.herokuapp.com/webservice/";


$("#frminiciosesion").submit(function (evento) {
    evento.preventDefault();

    var ruta = DIRECCION_WS + "uservalidar.php";
    var txtRol = $("#txtrol").val();
    var txtDni = $("#txtdni").val();
    var txtPassword = $("#txtclave").val();

    var data = {p_rol:txtRol, p_dni: txtDni, p_clave: txtPassword}
    console.log(data);
    $.ajax({
        type: "post",
        url: ruta,
        contentType: "application/json",
        data: JSON.stringify(data),
        success: function (resultado) {
            console.log(resultado);
            var datosJSON = resultado;
            if (datosJSON.estado === 200) {
                localStorage.setItem('id', datosJSON.datos.id);
                localStorage.setItem('nombreUsuario', datosJSON.datos.persona);
                localStorage.setItem('rolId', datosJSON.datos.rol_id);
                localStorage.setItem('rol', datosJSON.datos.rol);
                //access(datosJSON.datos.rol);
                localStorage.setItem('token', datosJSON.datos.token);
                // window.location = "../Vista/principal.php";
                window.location = "Vista/principal.php";
            }
        },
        error: function (error) {
            $("#txtdni").val("");
            $("#txtclave").val("");
            $("#txtdni").focus();
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            // swal("Error", datosJSON.mensaje, "error");
        }
    });;

    // $.post(ruta, {dni: txtDni, clave: txtPassword}, function () {
    // }).done(function (resultado) {
    //     console.log(resultado);
    //     var datosJSON = resultado;
    //     if (datosJSON.estado === 200) {
    //         localStorage.setItem('nombreUsuario', datosJSON.datos.nombre_usuario);
    //         localStorage.setItem('tipoUsuario', datosJSON.datos.tipo_usuario);
    //
    //         localStorage.setItem('token', datosJSON.datos.token);
    //         // window.location = "../Vista/principal.php";
    //         window.location = "Vista/principal.php";
    //     } else {
    //         swal("Mensaje del sistema", resultado, "warning");
    //     }
    // }).fail(function (error) {
    //     console.log(error);
    //     $("#txtdni").val("");
    //     $("#txtclave").val("");
    //     $("#txtdni").focus();
    //
    //     var datosJSON = $.parseJSON(error.responseText);
    //     swal("Error", datosJSON.mensaje, "error");
    //
    // })
});

