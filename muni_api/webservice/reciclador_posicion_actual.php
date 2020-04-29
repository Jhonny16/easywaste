<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 29/04/20
 * Time: 11:55 AM
 */



header('Access-Control-Allow-Origin: *');

require_once '../model/posicion_actual.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}

$token = $_SERVER["HTTP_TOKEN"];
$reciclador_id = json_decode(file_get_contents("php://input"))->reciclador_id;
$latitud_actual = json_decode(file_get_contents("php://input"))->latitud;
$longitud_actual = json_decode(file_get_contents("php://input"))->longitud;


try {
    $objeto = new posicion_actual();
    $objeto->setRecicladorId($reciclador_id);
    $objeto->setLatitudActual($latitud_actual);
    $objeto->setLongitudActual($longitud_actual);
    $res = $objeto->create();

    if ($res == true) {
        Funciones::imprimeJSON(200, "Se actualizo la posicion", $res);
    } else {
        Funciones::imprimeJSON(203, "Actualizo disponibilidad, no hay servicios pendientes", $res);
    }


} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}
