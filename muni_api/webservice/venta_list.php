<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 01/12/19
 * Time: 01:14 AM
 */
header('Access-Control-Allow-Origin: *');

require_once '../model/venta.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';


try {
    $obj = new venta();
    $resultado = $obj->lista();

    if($resultado){
        Funciones::imprimeJSON(200, "",$resultado);
    }

} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}