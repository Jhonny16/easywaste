var id;
var direccion;
var latitud;
var longitud;
var mark;
var mapita;

function mapa_direcciones() {

    var map_direcciones = new google.maps.Map(document.getElementById('map_direcciones'), {
        center: {lat: -6.7597355, lng: -79.8381619},
        zoom: 13,
        mapTypeId: 'roadmap'
    });

    // Create the search box and link it to the UI element.
    mapita = map_direcciones;
    var input = document.getElementById('pac-input');
    console.log("mapitaaaaaa");

    var searchBox = new google.maps.places.SearchBox(input);
    map_direcciones.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map_direcciones.addListener('bounds_changed', function () {
        searchBox.setBounds(map_direcciones.getBounds());
    });

    var markers = [];//Inicializamos los markers
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function () {//Inicio de búsqueda
        var places = searchBox.getPlaces();

        console.log(places);
        var direc = $("#pac-input").val();
        console.log(direc);

        if (places.length == 0) {
            return;
        }

        // Clear out the old markers.
        markers.forEach(function (marker) {
            marker.setMap(null);
        });
        //markers = [];

        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function (place) {
            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
            }
            var icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };


            //$("#txt_nueva_direccion").val(direc);

            mark = new google.maps.Marker({
                map: map_direcciones,
                icon: icon,
                title: direc,
                position: place.geometry.location,
                draggable: true

            });
            markers.push(mark);

            console.log("antes de arrastrarrr");
            console.log(place.formatted_address);
            console.log(place.geometry.location.lat());

            //console.log(markers[0]);
            google.maps.event.addListener(mark, 'drag', function(event) {
                coordenadas(mark);
            });

            direccion = direc;
            latitud = place.geometry.location.lat();
            longitud = place.geometry.location.lng();



            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }


        });

        map_direcciones.fitBounds(bounds);

    });//Fin de búsqueda




}

function coordenadas(marker) {
    //console.log("entro");
    var markerLatLng = marker.getPosition();
    latitud = markerLatLng.lat();
    longitud = markerLatLng.lng();
    console.log(latitud);
    console.log(longitud);
}


function validar_direccion(){
    var direccion_lugar = $("#pac-input").val();
    $("#txtdireccion_val").val(direccion_lugar);
    var dir = $("#txtdireccion_val").val()
    $("#txt_latitud").val(latitud);
    $("#txt_longitud").val(longitud);

}

function guardar_direccion() {

    swal({
            title: "Confirme",
            text: "¿Esta seguro de guardar la dirección?",
            showCancelButton: true,
            confirmButtonColor: '#3d9205',
            confirmButtonText: 'Si',
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true,
            imageUrl: "../images/pregunta.png"
        },
        function (isConfirm) {

            if (isConfirm) { //el usuario hizo clic en el boton SI


                $.post(
                    "../controller/Cliente.agregar.direccion.controller.php",
                    {
                        p_id_direccion: id_direccion,
                        p_id_cliente: id,
                        p_direccion_completa: direccion,
                        p_latitud: latitud,
                        p_longitud: longitud
                    }
                ).done(function (resultado) {

                    //console.log(resultado);
                    var datosJSON = resultado;

                    if (datosJSON.estado === 200) {
                        swal("Exito", datosJSON.mensaje, "success");
                        listar_clientes_direcciones();
                        $("#txt_nombre_cliente").val("");
                        $("#txt_nueva_direccion").val("");
                        mapa_direcciones();
                        $("#btncerrar").click(); //Cerrar la ventana
                    } else {
                        swal("Mensaje del sistema", resultado, "warning");
                    }

                }).fail(function (error) {
                    var datosJSON = $.parseJSON(error.responseText);
                    swal("Error", datosJSON.mensaje, "error");
                });

            }
        });




}


function nuevo_limpiar(){
    $("#txt_nombre_cliente").val("");
    $("#txt_nueva_direccion").val("");
    mapa_direcciones();

}


