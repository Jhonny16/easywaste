<?php

header('Access-Control-Allow-Origin: *');

require_once '../model/sensibilizacion.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';



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
    Funciones::imprimeJSON(200, "Gracias por responder a esta pregunta.", $res);
} else {
    Funciones::imprimeJSON(203, "Error al guardar", "");
}


