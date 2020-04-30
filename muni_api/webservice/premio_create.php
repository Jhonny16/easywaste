<?php


header('Access-Control-Allow-Origin: *');

require_once '../model/premio.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}
$token = $_SERVER["HTTP_TOKEN"];


//$operation= json_decode(file_get_contents("php://input"))->operation;
//if($operation!='Nuevo'){
//    $id = json_decode(file_get_contents("php://input"))->id;
//
//}
//
//$nombre = json_decode(file_get_contents("php://input"))->nombre;
//$stock= json_decode(file_get_contents("php://input"))->stock;
//$precio = json_decode(file_get_contents("php://input"))->precio;
//$pintrash = json_decode(file_get_contents("php://input"))->pintrash;
//$foto_name = json_decode(file_get_contents("php://input"))->imagen;

$operation = $_POST['pre_operation'];
$nombre = $_POST['pre_descripcion'];
$stock = $_POST['pre_stock'];
$precio = $_POST['pre_precio'];
$pintrash = $_POST['pre_pintrash'];
$image = $_FILES['foto'];

$id = $_POST['premio_id'];


try {

    if ($operation == 'Nuevo') {

        if ($image['name'] == "") {
            Funciones::imprimeJSON(203, "Debe seleccionar una imagen", "");
            exit();
        }

        $explode = explode('.', $image['name']);
        $extension = $explode[1];
        $name_encriptado = md5($image['tmp_name']) . '.' . $extension;
        $ruta = '../imagenes/' . '' . $name_encriptado . '';

        $res = move_uploaded_file($image['tmp_name'], $ruta);


        $objp = new premio();
        $objp->setNombre($nombre);
        $objp->setStock($stock);
        $objp->setPrecio($precio);
        $objp->setPintrash($pintrash);
        $objp->setImagen($name_encriptado);

        //Funciones::imprimeJSON(200, "Agregado Correcto", $foto_name);

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

        $objp = new premio();
        $objp->setNombre($nombre);
        $objp->setStock($stock);
        $objp->setPrecio($precio);
        $objp->setPintrash($pintrash);
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