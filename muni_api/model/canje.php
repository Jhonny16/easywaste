<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 06/12/19
 * Time: 03:10 AM
 */
require_once '../datos/conexion.php';

class canje extends conexion
{
    private $detalle;
    private $descuento;
    private $pintrash_actual;
    private $persona_id;

    /**
     * @return mixed
     */
    public function getPersonaId()
    {
        return $this->persona_id;
    }

    /**
     * @param mixed $persona_id
     */
    public function setPersonaId($persona_id)
    {
        $this->persona_id = $persona_id;
    }



    /**
     * @return mixed
     */
    public function getPintrashActual()
    {
        return $this->pintrash_actual;
    }

    /**
     * @param mixed $pintrash_actual
     */
    public function setPintrashActual($pintrash_actual)
    {
        $this->pintrash_actual = $pintrash_actual;
    }


    /**
     * @return mixed
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * @param mixed $descuento
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    }


    /**
     * @return mixed
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * @param mixed $detalle
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;
    }

    public function create()
    {
        try {

            date_default_timezone_set("America/Lima");
            $fecha = date('Y-m-d');
            $datosDetalle = json_decode($this->detalle);

            $persona_id = $this->persona_id;

            foreach ($datosDetalle as $key => $value) {

                $sql = "insert into 
                        canje (fecha_registro, pintrash_total, persona_id, premio_id)
                        values(:p_fecha,:p_total_pintrash,:p_persona_id,:p_premio_id)";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_fecha", $fecha);
                $sentencia->bindParam(":p_total_pintrash", $value->sub_pintrash);
                $sentencia->bindParam(":p_persona_id", $persona_id);
                $sentencia->bindParam(":p_premio_id", $value->premio_id);
                $sentencia->execute();
            }

            $sql = "Select p.id from pintrash p inner join servicio s on p.servicio_id = s.id 
                    inner join persona p2 on s.proveedor_id = p2.id
                      where p2.id = :p_proveedor_id order by p.id desc limit 1";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_proveedor_id", $persona_id);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

            if ($sentencia->rowCount()) {

                $this->dblink->beginTransaction();
                $sql = "update pintrash set pintrash = :p_pintrash, descuento = :p_descuento
                         where id = :p_id";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_pintrash", $this->pintrash_actual);
                $sentencia->bindParam(":p_descuento", $this->descuento);
                $sentencia->bindParam(":p_id", $resultado['id']);
                $sentencia->execute();
                $this->dblink->commit();

            }


            return True;

        } catch (Exception $ex) {
            throw $ex;
        }
    }
}