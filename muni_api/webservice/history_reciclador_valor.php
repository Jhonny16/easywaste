<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 09/06/20
 * Time: 04:33 PM
 */
header('Access-Control-Allow-Origin: *');

require_once '../model/persona.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';


try {

    $fecha_inicio = json_decode(file_get_contents("php://input"))->fecha_inicio;
    $fecha_fin = json_decode(file_get_contents("php://input"))->fecha_fin;

    $obj = new persona();
    $resultado = $obj->historial($fecha_inicio,$fecha_fin);

    if($resultado){
        Funciones::imprimeJSON(200, "",$resultado);
    }

} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}