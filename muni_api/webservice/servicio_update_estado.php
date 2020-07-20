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

$parametro = json_decode(file_get_contents("php://input"))->parametro;
$id = json_decode(file_get_contents("php://input"))->servicio_id;
$reciclador_id = json_decode(file_get_contents("php://input"))->reciclador_id;


if ($parametro == '3' or $parametro == 3) {
    $estado = 'En Atencion';
    date_default_timezone_set("America/Lima");
    $hora_llegada = date('H:i:s');

} else {
    if ($parametro == '4' or $parametro == 4) {
        $estado = 'Finalizado';
    } else {
        if ($parametro == '5' or $parametro == 5) {
            $estado = 'Cancelado';
        }
    }
}
try {
    $obj = new servicio();

    $obj->setEstado($estado);
    $obj->setId($id);

    if ($parametro == '3' or $parametro == 3) {
        $obj->setHoraLlegada($hora_llegada);
        $res = $obj->update_estado_hora_llegada();
        if ($res) {
            Funciones::imprimeJSON(200, "Se actualizo estado", $res);
        } else {
            Funciones::imprimeJSON(203, "No actualizo estado", $res);
//        else{
//            Funciones::imprimeJSON(200, "Estado actualizado, acumulo pintrash",$res);
//        }
        }
    } else {
        if($parametro == '5' or $parametro == 5){


            $position_reciclacores = new persona();
            $position = $position_reciclacores->posicion_recicladores_reasignacion($reciclador_id);
            if(count($position) > 0){
                $valor = max(array_column($position, 'valor'));
                for($i=0; $i<count($position);$i++){
                    if($valor==$position[$i]['valor']){
                        $rec_id = $position[$i]['id'];
                        break;

                    }
                }

                $obj->setId($id);
                $res = $obj->servicio_create_reasignar($rec_id, $reciclador_id);

                Funciones::imprimeJSON(200, "Se reasigno el servicio", $res);


            }else{
                $res = $obj->create_pendiente();
                if($res){
                    Funciones::imprimeJSON(200, "Se guardo el servicio. Esperando reciclador ... ", []);
                }else{
                    Funciones::imprimeJSON(500, "Error ... ", []);

                }
            }

        }
        else{
            $res = $obj->update_estado();
            Funciones::imprimeJSON(200, "Se actualizo estado de servicio y reciclador", $res);
        }
    }



//    if($res){
//        Funciones::imprimeJSON(200, "Se actualizo estado",$res);
//    }else{
//        Funciones::imprimeJSON(203, "No actualizo estado",$res);
//    }


} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}


