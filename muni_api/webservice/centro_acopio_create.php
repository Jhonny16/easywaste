<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 29/04/20
 * Time: 03:49 PM
 */
header('Access-Control-Allow-Origin: *');

require_once '../model/centro_acopio.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}


$nombre = json_decode(file_get_contents("php://input"))->nombre;
$direccion = json_decode(file_get_contents("php://input"))->direccion;
$tipo = json_decode(file_get_contents("php://input"))->tipo;
$numero_sectores = json_decode(file_get_contents("php://input"))->numero_sectores;
$operation = json_decode(file_get_contents("php://input"))->operation;

try {

    if ($operation == 'Nuevo') {

        $obj = new centro_acopio();
        $obj->setNombre($nombre);
        $obj->setDireccion($direccion);
        $obj->setTipo($tipo);
        $obj->setNumeroSectores($numero_sectores);

        $resultado = $obj->create();

        if ($resultado) {
            Funciones::imprimeJSON(200, "Se ha guardado el centro de acopio y sectores", $resultado);
        } else {
            Funciones::imprimeJSON(203, "Cuidado. Error al guardar! ", $resultado);
        }
    }else{
        $id = json_decode(file_get_contents("php://input"))->id;

        $obj = new centro_acopio();
        $obj->setNombre($nombre);
        $obj->setDireccion($direccion);
        $obj->setTipo($tipo);
        $obj->setNumeroSectores($numero_sectores);
        $obj->setId($id);

        $resultado = $obj->update();

        if ($resultado) {
            Funciones::imprimeJSON(200, "Se ha actualizado el centro de acopio y sectores", $resultado);
        } else {
            Funciones::imprimeJSON(203, "Cuidado. Error al guardar! ", $resultado);
        }
    }




} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}