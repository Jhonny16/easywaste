<?php

header('Access-Control-Allow-Origin: *');

require_once '../model/servicio.php';
require_once '../model/persona.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}
$token = $_SERVER["HTTP_TOKEN"];

$reciclador_id = json_decode(file_get_contents("php://input"))->reciclador_id;
$servicio_id = json_decode(file_get_contents("php://input"))->servicio_id;


$position_reciclacores = new persona();
$position = $position_reciclacores->posicion_recicladores_reasignacion($reciclador_id);

if(count($position) > 0){
    $valor = max(array_column($position, 'valor'));
    for($i=0; $i<count($position);$i++){
        if($valor==$position[$i]['valor']){
            $reciclador_id = $position[$i]['id'];
            break;

        }
    }

    $objserv = new servicio();
    $objserv->getId($servicio_id);
    $res = $objserv->servicio_create_reasignar($reciclador_id);

    Funciones::imprimeJSON(200, "Se reasigno el servicio", $res);


}else{
    $res = $objeto->create_pendiente();
    if($res){
        Funciones::imprimeJSON(200, "Se guardo el servicio. Esperando reciclador ... ", []);
    }else{
        Funciones::imprimeJSON(500, "Error ... ", []);

    }
}


