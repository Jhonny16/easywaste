<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 10/11/19
 * Time: 02:37 PM
 */
header('Access-Control-Allow-Origin: *');

require_once '../model/servicio.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';


if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}

$token = $_SERVER["HTTP_TOKEN"];

$parametro = json_decode(file_get_contents("php://input"))->parametro;
$id = json_decode(file_get_contents("php://input"))->id;

if ($parametro == '3' or $parametro == 3) {
    $estado = 'En Atencion';
    date_default_timezone_set("America/Lima");
    $hora_llegada = date('H:i:s');
} else {
    if ($parametro == '4' or $parametro == 4) {
        $estado = 'Finalizado';
    } else {
        if ($parametro == '5' or $parametro == 5) {
            $estado = 'Cancelado';
        }
    }
}
try {
    $obj = new servicio();

    $obj->setEstado($estado);
    $obj->setId($id);

    if ($parametro == '3' or $parametro == 3) {
        $obj->setHoraLlegada($hora_llegada);
        $res = $obj->update_estado_hora_llegada();
    }else{
        $res = $obj->update_estado();
    }


    $resultado = "";

    if($res==true){
            Funciones::imprimeJSON(200, "Se actualizo estado",$resultado);
    }else{
        Funciones::imprimeJSON(203, "No actualizo estado",$resultado);
    }



} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}


