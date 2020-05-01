<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

require_once '../model/informacion.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';


//$persona_id = json_decode(file_get_contents("php://input"))->persona_id;
$persona_id = $_GET['persona_id'];

try {
    $obj = new informacion();
    $resultado = $obj->lista_por_rol($persona_id);

    if($resultado){

        Funciones::imprimeJSON(200, "",$resultado);
    }

} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}