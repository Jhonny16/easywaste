<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 02/07/20
 * Time: 02:48 PM
 */

header('Access-Control-Allow-Origin: *');

require_once '../model/almacen.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}

$reciclador_id = json_decode(file_get_contents("php://input"))->reciclador_id;



try {
    $obj = new almacen();
    $obj->setRecicladorId($reciclador_id);
    $resultado = $obj->lista_por_reciclador();

    if($resultado){
        for($i=0; $i<count($resultado); $i++){
            $obj->setId($resultado[$i]['id']);
            $detalle = $obj->detalle();
            $resultado[$i]['detalle'] = $detalle;
        }
        Funciones::imprimeJSON(200, "",$resultado);
    }

} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}