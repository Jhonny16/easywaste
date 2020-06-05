<?php

header('Access-Control-Allow-Origin: *');

require_once '../model/persona_criterio.php';
require_once '../model/persona_status.php';
require_once '../model/periodo.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}

try {
    $objpc = new persona_criterio();
    $objpersona = new persona_status();
    $objperiodo = new periodo();

    $norma = $objpc->datos_normalizados();
    if($norma){
        $update_state_reciclador = $objpersona->update_state_reciclador();
        $update_state_periodo = $objperiodo->update_state_periodo();

        Funciones::imprimeJSON(200, "", $norma);
    }



} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}