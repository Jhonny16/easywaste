<?php

require_once '../datos/conexion.php';
class code extends conexion
{

    public function ultimo()
    {
        $sql = "select * from code  order by id desc limit 1";
        $sentencia = $this->dblink->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function search_code($code){
        try {

            $sql = "select * from code where numero = :p_code ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_code", $code);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            if ($sentencia->rowCount()) {

                $res = $this->create();
                if($res) {
                    return true;
                }

            }else{
                return false;
            }
        }catch (Exception $ex){
            throw $ex;
        }


    }


    public function create(){

        try {

            date_default_timezone_set("America/Lima");
            $fecha_registro = date('Y-m-d');

            //codfifiacion para autogenerar un code

            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

            function generate_string($input, $strength = 16) {
                $input_length = strlen($input);
                $random_string = '';
                for($i = 0; $i < $strength; $i++) {
                    $random_character = $input[mt_rand(0, $input_length - 1)];
                    $random_string .= $random_character;
                }

                return $random_string;
            }

            $new_code = generate_string($permitted_chars, 6);

            $sql = "insert into code (numero, fecha_creacion)
                    values (:p_numero, :p_fecha); ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_numero", $new_code);
            $sentencia->bindParam(":p_fecha", $fecha_registro);
            $sentencia->execute();
            return True;

        }catch (Exception $ex) {
            throw $ex;
        }


    }

}