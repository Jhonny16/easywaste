<?php
header('Access-Control-Allow-Origin: *');

require_once '../model/premio.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}

$pintrash = json_decode(file_get_contents("php://input"))->pintrash;


try {
    $obj = new premio();
    $resultado = $obj->premios_list_pintrash($pintrash);

    if($resultado){
        Funciones::imprimeJSON(200, "",$resultado);
    }

} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}