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


$operation = $_POST['info_operation'];
$titulo = $_POST['info_titulo'];
$descripcion = $_POST['info_descripcion'];
$rol_id = $_POST['info_rol'];
$image = $_FILES['info_foto'];

$id = $_POST['informacion_id'];

try {

    if ($operation == 'Nuevo') {


        $explode = explode('.', $image['name']);
        $extension = $explode[1];
        $name_encriptado = md5($image['tmp_name']) . '.' . $extension;
        $ruta = '../imagenes/' . '' . $name_encriptado . '';

        $res = move_uploaded_file($image['tmp_name'], $ruta);


        $objp = new informacion();
        $objp->setTitulo($titulo);
        $objp->setDescripcion($descripcion);
        $objp->setRolId($rol_id);
        $objp->setImagen($name_encriptado);

        if ($res) {
            $result = $objp->create();
            if ($result) {
                Funciones::imprimeJSON(200, "Agregado Correcto", $result);
            } else {
                Funciones::imprimeJSON(203, "Error al momento de agregar", "");
            }
        } else {
            Funciones::imprimeJSON(203, "No se guardó la imagen : ", $image);

        }


    } else {

        $objp = new informacion();
        $objp->setTitulo($titulo);
        $objp->setDescripcion($descripcion);
        $objp->setRolId($rol_id);

        $objp->setId($id);

        if ($image['name'] != "") {
            $explode = explode('.', $image['name']);
            $extension = $explode[1];
            $name_encriptado = md5($image['tmp_name']) . '.' . $extension;
            $ruta = '../imagenes/' . '' . $name_encriptado . '';

            $res = move_uploaded_file($image['tmp_name'], $ruta);

            $objp->setImagen($name_encriptado);

        }


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