<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 29/04/20
 * Time: 11:59 AM
 */

require_once '../datos/conexion.php';

class posicion_actual extends conexion
{


    private $id;
    private $latitud_actual;
    private $longitud_actual;
    private $reciclador_id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLatitudActual()
    {
        return $this->latitud_actual;
    }

    /**
     * @param mixed $latitud_actual
     */
    public function setLatitudActual($latitud_actual)
    {
        $this->latitud_actual = $latitud_actual;
    }

    /**
     * @return mixed
     */
    public function getLongitudActual()
    {
        return $this->longitud_actual;
    }

    /**
     * @param mixed $longitud_actual
     */
    public function setLongitudActual($longitud_actual)
    {
        $this->longitud_actual = $longitud_actual;
    }

    /**
     * @return mixed
     */
    public function getRecicladorId()
    {
        return $this->reciclador_id;
    }

    /**
     * @param mixed $reciclador_id
     */
    public function setRecicladorId($reciclador_id)
    {
        $this->reciclador_id = $reciclador_id;
    }




    public function create(){
        try {

            $sql = "insert into posicion_actual (latitud, longitud, reciclador_id)
                    values (:p_latitud, :p_longitud ,:p_reciclador_id); ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_latitud", $this->latitud_actual);
            $sentencia->bindParam(":p_longitud", $this->longitud_actual);
            $sentencia->bindParam(":p_reciclador_id", $this->reciclador_id);
            $sentencia->execute();
            return True;

        }catch (Exception $ex) {
            throw $ex;
        }
    }

}