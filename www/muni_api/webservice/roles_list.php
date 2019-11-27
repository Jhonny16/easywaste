<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 22/09/19
 * Time: 03:02 PM
 */
header('Access-Control-Allow-Origin: *');

require_once '../model/rol.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';


try {
    $obj = new rol();
    $resultado = $obj->rol_list();

    if($resultado){
        Funciones::imprimeJSON(200, "",$resultado);
    }

} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}