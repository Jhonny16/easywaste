<?php


header('Access-Control-Allow-Origin: *');

require_once '../model/informacion.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}
$token = $_SERVER["HTTP_TOKEN"];


$operation= json_decode(file_get_contents("php://input"))->operation;
if($operation!='Nuevo'){
    $id = json_decode(file_get_contents("php://input"))->id;

}

$rol_id = json_decode(file_get_contents("php://input"))->rol_id;
$titulo = json_decode(file_get_contents("php://input"))->titulo;
$descripcion = json_decode(file_get_contents("php://input"))->descripcion;
$foto_name = json_decode(file_get_contents("php://input"))->imagen;

try {

    if ($operation == 'Nuevo') {

        $objp = new informacion();
        $objp->setTitulo($titulo);
        $objp->setDescripcion($descripcion);
        $objp->setRolId($rol_id);
        $objp->setImagen($foto_name);

        $result = $objp->create();
        if ($result) {
            Funciones::imprimeJSON(200, "Agregado Correcto", $result);
        } else {
            Funciones::imprimeJSON(203, "Error al momento de agregar", "");
        }


    } else {

        $objp = new informacion();
        $objp->setTitulo($titulo);
        $objp->setDescripcion($descripcion);
        $objp->setRolId($rol_id);
        $objp->setImagen($foto_name);
        $objp->setId($id);

        $result = $objp->update();
        if ($result) {
            Funciones::imprimeJSON(200, "Actualizado de manera correcta", $result);
        } else {
            Funciones::imprimeJSON(203, "Error al momento de actualizar", "");
        }
    }


} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}