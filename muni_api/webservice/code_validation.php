<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 05/05/20
 * Time: 05:39 PM
 */


header('Access-Control-Allow-Origin: *');

require_once '../model/verificacionEmail.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';



$code = json_decode(file_get_contents("php://input"))->code;
$proveedor_id= json_decode(file_get_contents("php://input"))->proveedor_id;


$objeto = new verificacionEmail();


date_default_timezone_set("America/Lima");
$fecha = date('Y-m-d');

$objeto->setCodigo($code);
$objeto->setProveedorId($proveedor_id);

$res = $objeto->search_codigo_verificacion();
if($res == -1){
    Funciones::imprimeJSON(203, "No se actualizó el estado de la persona", $res);

}else{
    if ($res==1) {
        Funciones::imprimeJSON(200, "Su código de verificación ha sido validado!", $res);
    } else {
        Funciones::imprimeJSON(203, "Quizá se equivocó al ingresar su código de verificación", "");
    }

}
