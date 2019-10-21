<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 21/10/19
 * Time: 11:23 AM
 */

header('Access-Control-Allow-Origin: *');

require_once '../model/code.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}



try {
    $obj = new code();
    $resultado = $obj->ultimo();

    if($resultado){
        Funciones::imprimeJSON(200, "",$resultado);
    }

} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}