<?php

header('Access-Control-Allow-Origin: *');

require_once '../model/almacen.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}

$id = json_decode(file_get_contents("php://input"))->almacen_id;


try {
    $obj = new almacen();

    $obj->setId($id);

    $resultado = $obj->detalle();

    if ($resultado) {
        Funciones::imprimeJSON(200, "", $resultado);
    } else {
    }

} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}