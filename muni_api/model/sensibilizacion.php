<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 08/12/19
 * Time: 08:53 PM
 */
require_once '../datos/conexion.php';
class sensibilizacion extends conexion
{
    private $persona_id;
    private $respuesta;
    private $comentario;
    private $fecha;

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
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * @param mixed $respuesta
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;
    }

    /**
     * @return mixed
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * @param mixed $comentario
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
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

    public function create()
    {
        try {

            $sql = "insert into sensibilizacion (respuesta, fecha_registro, persona_id, comentario)
                    values (:p_respuesta, :p_fecha, :p_persona_id, :p_comentario); ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_respuesta", $this->respuesta);
            $sentencia->bindParam(":p_fecha", $this->fecha);
            $sentencia->bindParam(":p_persona_id", $this->persona_id);
            $sentencia->bindParam(":p_comentario", $this->comentario);
            $sentencia->execute();

            return true;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function informacion_list(){
        try {

            $sql = "SELECT * from informacion";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }
    }


}