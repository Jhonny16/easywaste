<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 15/05/20
 * Time: 02:38 PM
 */


header('Access-Control-Allow-Origin: *');

require_once '../model/residuo.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}
$reciclador_id = json_decode(file_get_contents("php://input")) -> reciclador_id;


try {
    $obj = new residuo();
    $resultado = $obj->lista_por_reciclador($reciclador_id);


    if($resultado){
        Funciones::imprimeJSON(200, "",$resultado);
    }

} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}