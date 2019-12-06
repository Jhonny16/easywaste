<?php
header('Access-Control-Allow-Origin: *');

require_once '../model/canje.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}

$detalle = json_decode(file_get_contents("php://input"))->detalle;
$descuento = json_decode(file_get_contents("php://input"))->descuento;
$pintrash_actual = json_decode(file_get_contents("php://input"))->pintrash_actual;
$persona_id = json_decode(file_get_contents("php://input"))->persona_id;

try {
    $obj = new canje();
    $obj->setDetalle($detalle);
    $obj->setDescuento($descuento);
    $obj->setPintrashActual($pintrash_actual);
    $obj->setPersonaId($persona_id);

    $resultado = $obj->create();

    if($resultado){
        Funciones::imprimeJSON(200, "Se ha guardado el canje ",$resultado);
    }else{
        Funciones::imprimeJSON(203, "No hay periodos","");
    }

} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}