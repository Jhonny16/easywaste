<?php

header('Access-Control-Allow-Origin: *');

require_once '../model/venta.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}
$documento = json_decode(file_get_contents("php://input"))->numero_documento;
$reciclador_id = json_decode(file_get_contents("php://input"))->reciclador_id;
$user_id = json_decode(file_get_contents("php://input"))->user_id;
$acopio_final_id = json_decode(file_get_contents("php://input"))->acopio_final_id;
$total = json_decode(file_get_contents("php://input"))->precio_total;
$detalle = json_decode(file_get_contents("php://input"))->detalle;

try {
    date_default_timezone_set("America/Lima");
    $fecha = date('Y-m-d');

    $obj = new venta();
    $obj->setDocumentoReferencia($documento);
    $obj->setRecicladorId($reciclador_id);
    $obj->setUserId($user_id);
    $obj->setAcopioFinalId($acopio_final_id);
    $obj->setPrecioTotal($total);
    $obj->setFechaRegistro($fecha);
    $obj->setDetalle($detalle);

    $res = $obj->create();


    if($res == 1){
        Funciones::imprimeJSON(200, "Se ha guardado la venta", $res);
    }else{
        Funciones::imprimeJSON(203, "No se puede vender un residuo que no cuenta con stock suficiente", $res);
    }
}
catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}