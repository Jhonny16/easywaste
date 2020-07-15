<?php


header('Access-Control-Allow-Origin: *');

require_once '../model/persona.php';
require_once '../model/verificacionEmail.php';
require_once '../util/funciones/Funciones.clase.php';
require_once 'tokenvalidar.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}
$token = $_SERVER["HTTP_TOKEN"];
$operation = json_decode(file_get_contents("php://input"))->operation;
if ($operation == 'Nuevo') {

} else {
    $id = json_decode(file_get_contents("php://input"))->id;
}

$dni = json_decode(file_get_contents("php://input"))->dni;
$nombres = json_decode(file_get_contents("php://input"))->nombres;
$ap_paterno = json_decode(file_get_contents("php://input"))->ap_paterno;
$ap_materno = json_decode(file_get_contents("php://input"))->ap_materno;
$sexo = json_decode(file_get_contents("php://input"))->sexo;
$fn = json_decode(file_get_contents("php://input"))->fn;
$celular = json_decode(file_get_contents("php://input"))->celular;
$direccion = json_decode(file_get_contents("php://input"))->direccion;
$correo = json_decode(file_get_contents("php://input"))->correo;
$estado = json_decode(file_get_contents("php://input"))->estado;
$zona_id = json_decode(file_get_contents("php://input"))->zona_id;
$fecha_registro = json_decode(file_get_contents("php://input"))->fecha_registro;
$rol_id = json_decode(file_get_contents("php://input"))->rol_id;
$is_param = json_decode(file_get_contents("php://input"))->is_param;
$user_name = json_decode(file_get_contents("php://input"))->user_name;


try {
    $datetime1 = new DateTime($fn);
    $datetime2 = new DateTime($fecha_registro);
    $interval = $datetime1->diff($datetime2);
    $dias = $interval->format('%R%a');
    $anio = (float)$dias / 365;
    if ($anio < 18) {
        Funciones::imprimeJSON(500, "La fecha de nacimiento del nuevo registro no supera los 18 años", "");
        exit();
    }

    if ($operation == 'Nuevo') {


        $e_mail = explode('@', $correo);
        if ($correo == null or $correo == '') {
            Funciones::imprimeJSON(500, "Debe ingresar e-mail", "");
            exit();
        } else {
            if ($e_mail[1] == 'gmail.com') {

            } else {
                Funciones::imprimeJSON(500, "El mail ingresado debe ser de la cuenta de GMAIL", "");
                exit();
            }

        }


        $objper = new persona();
        $objper->setDni($dni);
        $objper->setNombres($nombres);
        $objper->setApPaterno($ap_paterno);
        $objper->setApMaterno($ap_materno);
        $objper->setSexo($sexo);
        $objper->setFn($fn);
        $objper->setCelular($celular);
        $objper->setDireccion($direccion);
        $objper->setCorreo($correo);
        $objper->setUserName($user_name);
        if ($rol_id == 3) {
            $objper->setEstado("I");
        } else {
            $objper->setEstado($estado);

        }
        $objper->setZonaId($zona_id);
        $objper->setFechaRegistro($fecha_registro);

        if ($rol_id == 2 and $is_param == 1) {
            $objper->setRolId(3);

            $add_other = $objper->create();

        }

        if ($rol_id == 3 and $is_param == 1) {
            $objper->setRolId(2);

            $add_other = $objper->create();

        }

        $objper->setRolId($rol_id);


        $persona_id = $objper->create();
        if ($persona_id > 1 and $rol_id == 3) {


            $obj_mail = new verificacionEmail();

            $obj_mail->setGmail($correo);
            $obj_mail->setProveedorId($persona_id);

            $new_code = $obj_mail->create();

            $msg = "Bienvido a EasyWaste. \nPara completar su registro, por favor, ingrese su código de verificación.\n
            Código de verificación: " . $new_code . "\nAcceda a este link: 
            http://192.168.1.5/www/muni_web/Vista/code_validation.php?persona_id=" . $persona_id . " \nGracias por su preferencia !";

            $msg = wordwrap($msg, 98, "\r\n");

            $res = mail($correo, "EasyWaste dice Hola!", $msg);


            if ($res == 1) {
                if ($rol_id == 3) {
                    Funciones::imprimeJSON(200, "Agregado Correcto. Valide su codigo de verificación  a traveś de la cuenta de gmail que ud ingresó", $persona_id);

                } else {
                    Funciones::imprimeJSON(200, "Agregado Correcto.", $persona_id);

                }

            } else {
                Funciones::imprimeJSON(200, "Agregado Correcto. No se envió el correo electróniico. ", $persona_id);
            }


        } else {
            if ($persona_id > 1 and $rol_id != 3) {

                Funciones::imprimeJSON(200, "Agregado Correcto.", $persona_id);


            } else {
                Funciones::imprimeJSON(203, "Error al momento de agregar", "");

            }

        }


    } else {

        $objper = new persona();

        $objper->setDni($dni);
        $objper->setNombres($nombres);
        $objper->setApPaterno($ap_paterno);
        $objper->setApMaterno($ap_materno);
        $objper->setSexo($sexo);
        $objper->setFn($fn);
        $objper->setCelular($celular);
        $objper->setDireccion($direccion);
        $objper->setCorreo($correo);
        $objper->setEstado($estado);
        $objper->setZonaId($zona_id);
        $objper->setId($id);
        $objper->setUserName($user_name);



        if ($rol_id == 2 and $is_param == 1) {
            $objper->setRolId(3);
            $add_other = $objper->update_other(3);

        } else {
            if ($rol_id == 2 and $is_param == 0) {
                $objper->setRolId(3);
                $objper->setEstado("I");

                $update_other = $objper->update_other(3);
            }
        }

        if ($rol_id == 3 and $is_param == 1) {
            $objper->setRolId(2);
            $objper->setEstado("I");


            $add_other = $objper->update_other(2);

        } else {
            if ($rol_id == 3 and $is_param == 0) {
                $objper->setRolId(2);
                $objper->setEstado("I");

                $update_other = $objper->update_other(2);
            }
        }

        $objper->setEstado($estado);
        $result = $objper->update();

        if ($result) {
            Funciones::imprimeJSON(200, "Se Actualizo Correctamente", "");
        } else {
            Funciones::imprimeJSON(203, "Error al momento de agregar", "");
        }


    }


} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}