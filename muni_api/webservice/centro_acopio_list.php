<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 29/04/20
 * Time: 04:08 PM
 */
header('Access-Control-Allow-Origin: *');

require_once '../model/centro_acopio.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';


try {
    $obj = new centro_acopio();
    $resultado = $obj->list_all();


    if($resultado){
        Funciones::imprimeJSON(200, "",$resultado);
    }

} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}