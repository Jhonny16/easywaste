<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 02/12/19
 * Time: 08:37 AM
 */
require_once '../datos/conexion.php';

class premio extends conexion
{
    public function lista()
    {
        try {

            $sql = "SELECT * from premio";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }
    }


}