<?php
header('Access-Control-Allow-Origin: *');

require_once '../model/informacion.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';


$persona_id = json_decode(file_get_contents("php://input"))->persona_id;

try {
    $obj = new informacion();
    $resultado = $obj->lista($persona_id);

    if($resultado){

        Funciones::imprimeJSON(200, "",$resultado);
    }

} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}