<?php

header('Access-Control-Allow-Origin: *');

require_once '../model/almacen.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}
$reciclador_id = json_decode(file_get_contents("php://input"))->reciclador_id;
$user_id = json_decode(file_get_contents("php://input"))->user_id;
$acopio_temporal_id = json_decode(file_get_contents("php://input"))->acopio_temporal_id;
$sector_name = json_decode(file_get_contents("php://input"))->sector_name;
$total = json_decode(file_get_contents("php://input"))->total;


$detalle = json_decode(file_get_contents("php://input"))->detalle;

try {
    date_default_timezone_set("America/Lima");
    $fecha = date('Y-m-d');

    $obj = new almacen();
    $obj->setRecicladorId($reciclador_id);
    $obj->setUserId($user_id);
    $obj->setAcopioTemporalId($acopio_temporal_id);
    $obj->setSectorName($sector_name);
    $obj->setTotalPeso($total);
    $obj->setFechaRegistro($fecha);
    $obj->setDetalle($detalle);

    $res = $obj->create();

    if($res){
        Funciones::imprimeJSON(200, "Se ha guardado el almacenamiento de residuos", $res);
    }else{
        Funciones::imprimeJSON(203, "Error al guardar el almacenamiento", $res);
    }
}
catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}