<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 30/11/19
 * Time: 09:16 PM
 */
header('Access-Control-Allow-Origin: *');

require_once '../model/residuo.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';


try {
    $obj = new residuo();
    $resultado = $obj->lista();

    if($resultado){
        Funciones::imprimeJSON(200, "",$resultado);
    }

} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}