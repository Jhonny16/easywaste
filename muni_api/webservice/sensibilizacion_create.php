<?php

header('Access-Control-Allow-Origin: *');

require_once '../model/sensi';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}
$token = $_SERVER["HTTP_TOKEN"];

$respuesta = json_decode(file_get_contents("php://input"))->respuesta;
$comentario = json_decode(file_get_contents("php://input"))->comentario;
$persona_id= json_decode(file_get_contents("php://input"))->persona_id;




$objeto = new sensibilizacion();


date_default_timezone_set("America/Lima");
$fecha = date('Y-m-d');

$objeto->setPersonaId($persona_id);
$objeto->setFecha($fecha);
$objeto->setRespuesta($respuesta);
$objeto->setComentario($comentario);

$res = $objeto->create();
if ($res) {
    Funciones::imprimeJSON(200, "Se guardo la informacion de forma correcta", $res);
} else {
    Funciones::imprimeJSON(203, "Error al guardar", "");
}


