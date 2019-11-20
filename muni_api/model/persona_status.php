<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 20/11/19
 * Time: 11:38 AM
 */
require_once '../datos/conexion.php';
class persona_status extends conexion
{
    private $id;
    private $reciclador_id;
    private $fecha;
    private $hora;
    private $name_status;

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

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * @param mixed $hora
     */
    public function setHora($hora)
    {
        $this->hora = $hora;
    }

    /**
     * @return mixed
     */
    public function getNameStatus()
    {
        return $this->name_status;
    }

    /**
     * @param mixed $name_status
     */
    public function setNameStatus($name_status)
    {
        $this->name_status = $name_status;
    }


    public function insert_disponibilidad(){

        try {

            $sql = "insert into status (fecha, hora, name_status, reciclador_id)
                    values (:p_fecha, :p_hora ,:name_status, :p_reciclador_id); ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_fecha", $this->fecha);
            $sentencia->bindParam(":p_hora", $this->hora);
            $sentencia->bindParam(":name_status", $this->name_status);
            $sentencia->bindParam(":p_reciclador_id", $this->reciclador_id);
            $sentencia->execute();
            return True;

        }catch (Exception $ex) {
            throw $ex;
        }

    }
}