<?php
header('Access-Control-Allow-Origin: *');

require_once '../model/reporte.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}
$token = $_SERVER["HTTP_TOKEN"];

$rol_id = json_decode(file_get_contents("php://input"))->rol_id;
$fecha_inicial = json_decode(file_get_contents("php://input"))->fecha_inicial;
$fecha_final = json_decode(file_get_contents("php://input"))->fecha_final;

$objeto = new reporte();

$res = $objeto->sensibilizacion($rol_id, $fecha_inicial, $fecha_final);

$lista = array();
$lista[0] =  ['Se sensibilizaron', 'Cantidad'];
$lista[1] =  ['Si', $res['si']];
$lista[2] =  ['No', $res['no']];

//for ($i = 1; $i <=count($res); $i++) {
//    $datos = array(
//        "si" => $res[$i]["si"],
//        "no" => $res[$i]["no"],
//    );
//
//    $lista[$i] = $datos;
//}

if ($res) {
    Funciones::imprimeJSON(200, "Consulta exitosa", $lista);
} else {
    Funciones::imprimeJSON(203, "No hubo resutados en la busqueda.", $res);
}
