<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 29/04/20
 * Time: 04:12 PM
 */
header('Access-Control-Allow-Origin: *');

require_once '../model/centro_acopio.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}

$id = json_decode(file_get_contents("php://input"))->id;

try {
    $obj = new centro_acopio();
    $obj->setId($id);

    $resultado = $obj->read();

    if($resultado){
        Funciones::imprimeJSON(200, "",$resultado);
    }else{
        Funciones::imprimeJSON(203, "Error en la busqueda","");
    }

} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}