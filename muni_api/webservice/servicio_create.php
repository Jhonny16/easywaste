<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 10/11/19
 * Time: 12:47 PM
 */
header('Access-Control-Allow-Origin: *');

require_once '../model/servicio.php';
require_once '../model/persona.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}
$token = $_SERVER["HTTP_TOKEN"];

$proveedor_id = json_decode(file_get_contents("php://input"))->proveedor_id;
$latitud = json_decode(file_get_contents("php://input"))->latitud;
$longitud = json_decode(file_get_contents("php://input"))->longitud;
$referencia = json_decode(file_get_contents("php://input"))->referencia;
//$array_distancias = json_decode(file_get_contents("php://input"))->array_distancias;
//$imagen = pg_escape_bytea(file_get_contents("php://input"))->imagen;

$objeto = new servicio();

date_default_timezone_set("America/Lima");
$hora = date('H:i:s');
$fecha = date('Y-m-d');
$estado = 'Abierto';

$objeto->setProveedorId($proveedor_id);
$objeto->setFecha($fecha);
$objeto->setHora($hora);
$objeto->setLatitud($latitud);
$objeto->setLongitud($longitud);
$objeto->setReferencia($referencia);
$objeto->setEstado($estado);
//$objeto->setImagen($imagen);



$position_reciclacores = new persona();
$position = $position_reciclacores->posicion_recicladores();

$lat = $position[0]['lat'];
$lng = $position[0]['lng'];

//$geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lng.'&key=AIzaSyAz2Oa-_4POfA1s5UslFrXfTe66uPfgEMU');

$cant = count($position) - 1;

$destinos = null;

for ($i= 0; $i< count($position); $i++){
    if($position[$i]['lat'] != null){
        if ($i==0){
            $destinos = $position[$i]['lat'].','. $position[$i]['lng'].'|';
        }else{
            if($i==$cant){
                $destinos .= $position[$i]['lat'].','. $position[$i]['lng'];
            }else{
                $destinos .= $position[$i]['lat'].','. $position[$i]['lng'].'|';
                //$destino .= count($position);
            }

        }
    }
}

if($destinos!=null){
    $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins='.$latitud.','.$longitud.'&destinations='.$destinos.'&key=AIzaSyAz2Oa-_4POfA1s5UslFrXfTe66uPfgEMU');
    $outputTo = json_decode($geocodeFrom);
    $array = [];
    for ($i= 0; $i< count($position); $i++){
        if($position[$i]['lat'] != null){
            $position[$i]['distance'] = $outputTo->rows[0]->elements[$i]->distance->text;
        }
    }

    $objeto->setArrayDistancias($position);

   // Funciones::imprimeJSON(203, "No hay recicladores disponibles", $outputTo);


    $res = $objeto->create();
    if ($res == -1) {
        Funciones::imprimeJSON(200, "No hay recicladores dispomibles", $res);
    } else {
        if($res==0){
            Funciones::imprimeJSON(200, "Pequeño error", $res);
        }else{
            if($res > 0){
                Funciones::imprimeJSON(200, "Se guardo el servicio", $res);
            }else{
                Funciones::imprimeJSON(203, "Error al guardar", $res);

            }
        }
    }

}else{
    Funciones::imprimeJSON(203, "No hay recicladores disponibles", $outputTo);

}









/*$outputFrom = json_decode($geocodeFrom);
$geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$latitud.','.$longitud.'&key=AIzaSyAz2Oa-_4POfA1s5UslFrXfTe66uPfgEMU');
$outputTo = json_decode($geocodeTo);


$latitudeFrom = $outputFrom->results[0]->geometry->location->lat;
$longitudeFrom = $outputFrom->results[0]->geometry->location->lng;
$latitudeTo = $outputTo->results[0]->geometry->location->lat;
$longitudeTo = $outputTo->results[0]->geometry->location->lng;

$theta = $longitudeFrom - $longitudeTo;
$dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
$dist = acos($dist);
$dist = rad2deg($dist);
$miles = $dist * 60 * 1.1515;
$unit = 'K';
$unit = strtoupper($unit);
if ($unit == "K") {
    return ($miles * 1.609344).' km';
} else if ($unit == "N") {
    return ($miles * 0.8684).' nm';
} else {
    return $miles.' mi';
}*/




//Funciones::imprimeJSON(203, "Error al guardar", $res);



