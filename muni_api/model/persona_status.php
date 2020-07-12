<?php

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


    public function insert_disponibilidad($status)
    {

        try {

            $sql = "insert into status (fecha, hora, name_status, reciclador_id)
                    values (:p_fecha, :p_hora ,:name_status, :p_reciclador_id); ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_fecha", $this->fecha);
            $sentencia->bindParam(":p_hora", $this->hora);
            $sentencia->bindParam(":name_status", $this->name_status);
            $sentencia->bindParam(":p_reciclador_id", $this->reciclador_id);
            $sentencia->execute();

            if ($status == 1) {
                $res = $this->asignar_a_servicio($this->reciclador_id);
                return $res;
            } else {
                return -1;
            }

            //return True;

        } catch (Exception $ex) {
            throw $ex;
        }

    }

    public function asignar_a_servicio($recilador_id)
    {

        try {

            $sql = "select
                    s.id, (p.ap_paterno ||' '|| p.ap_materno ||' '|| p.nombres) as proveedor,
                    s.fecha, s.hora, s.estado, s.tiempo_aprox_atencion
                    from
                    servicio s inner join persona p on s.proveedor_id = p.id
                    where s.estado = 'Pendiente'
                    order by s.id desc limit 1; ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

//            if(count($resultado)>0){
            if ($sentencia->rowCount()) {

                for($i=0; $i<count($resultado); $i++){
                    $this->dblink->beginTransaction();
                    $sql = "update servicio set reciclador_id = :p_reciclador_id where id = :p_servicio_id ";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_servicio_id", $resultado[$i]['id']);
                    $sentencia->bindParam(":p_reciclador_id", $recilador_id);
                    $sentencia->execute();
                    $this->dblink->commit();
                }

                return 1;
            } else {
                return 0;
            }
        } catch (Exception $ex) {
            throw $ex;


        }
    }

    public function update_state_reciclador(){
        try {
            $sql = "
               select r.id,
                        current_date - r.fecha_registro as diferencia,
                       (case when (select name_status from status
                                   where reciclador_id = r.id
                                   order by 1 desc limit 1) is null then 'Baja' else 'Continue'end) as baja
                
                 from persona as r
                where r.rol_id = 2
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            if ($sentencia->rowCount()) {
                for ($i=0; $i<count($resultado); $i++){
                    if($resultado[$i]['diferencia'] > 15 && $resultado[$i]['baja'] == 'Baja'){

                        date_default_timezone_set("America/Lima");
                        $hora = date('H:i:s');
                        $fecha = date('Y-m-d');
                        $estado = 'No Disponible';

                        $sql = "insert into status (fecha, hora, name_status, reciclador_id) 
                        values (:p_fecha,:p_hora,:p_estado,:p_reciclador)";
                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->bindParam(":p_fecha", $fecha);
                        $sentencia->bindParam(":p_hora", $hora);
                        $sentencia->bindParam(":p_estado", $estado);
                        $sentencia->bindParam(":p_reciclador", $resultado[$i]['id']);
                        $sentencia->execute();

                        $state = 'I';

                        $this->dblink->beginTransaction();
                        $sql = "update persona set estado  = :p_estado where id = :p_id";
                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->bindParam(":p_estado", $state);
                        $sentencia->bindParam(":p_id", $resultado[$i]['id']);
                        $sentencia->execute();
                        $this->dblink->commit();

                    }
                }
            }

            return $resultado;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}