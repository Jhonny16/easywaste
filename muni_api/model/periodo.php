<?php

require_once '../datos/conexion.php';

class periodo extends conexion
{
    private $id;
    private $fecha_inicio;
    private $fecha_fin;
    private $descripcion;
    private $estado;
    private $user_name;

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * @param mixed $user_name
     */
    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
    }


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
    public function getFechaInicio()
    {
        return $this->fecha_inicio;
    }

    /**
     * @param mixed $fecha_inicio
     */
    public function setFechaInicio($fecha_inicio)
    {
        $this->fecha_inicio = $fecha_inicio;
    }

    /**
     * @return mixed
     */
    public function getFechaFin()
    {
        return $this->fecha_fin;
    }

    /**
     * @param mixed $fecha_fin
     */
    public function setFechaFin($fecha_fin)
    {
        $this->fecha_fin = $fecha_fin;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function list_periodos()
    {
        $sql = "SELECT * FROM periodo";
        $sentencia = $this->dblink->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function ultima_fecha()
    {
        $sql = "select (fecha_fin + interval '1 days')::date as fecha_fin from periodo order by id desc limit 1";
        $sentencia = $this->dblink->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->fetch();
        return $resultado;
    }

    public function evaluar()
    {
        try {
            $sql = "SELECT estado FROM periodo where 
            (fecha_inicio between :p_fecha_inicio and :p_fecha_fin) 
            or
            (fecha_fin between :p_fecha_inicio and :p_fecha_fin) ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_fecha_inicio", $this->fecha_inicio);
            $sentencia->bindParam(":p_fecha_fin", $this->fecha_fin);
            $sentencia->execute();
            $resultado = $sentencia->fetch();

            if ($sentencia->rowCount()) {
                $state = $resultado["estado"];

                return -1;

            }
            else{
                if($this->estado == '1' or $this->estado == 1){
                    $sql = "SELECT estado FROM periodo where estado = 1";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->execute();
                    if ($sentencia->rowCount()) {
                        return 0;
                    }else{
                        $res = $this->create();
                        return $res;
                    }
                }else{
                    $res =$this->create();
                    return $res;
                }



            }


        } catch (Exception $ex){
            throw $ex;
        }
    }

    public function create(){
        try {

            if ($this->estado=='1' or $this->estado == 1){

                $sql = "INSERT INTO periodo (fecha_inicio, fecha_fin, estado, descripcion, user_name) 
                values (:p_fecha_inicio, :p_fecha_fin, :p_estado, :p_descripcion, :p_user_name) ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_fecha_inicio", $this->fecha_inicio);
                $sentencia->bindParam(":p_fecha_fin", $this->fecha_fin);
                $sentencia->bindParam(":p_estado", $this->estado);
                $sentencia->bindParam(":p_descripcion", $this->descripcion);
                $sentencia->bindParam(":p_user_name", $this->user_name);
                $sentencia->execute();

                $sql = "SELECT id FROM periodo order by 1 desc limit 1";
                $sentencia2 = $this->dblink->prepare($sql);
                $sentencia2->execute();
                $resultado = $sentencia2->fetch();
                if ($sentencia2->rowCount()) {
                    $this->create_periodo_criterio($resultado['id']);
                    return true;;

                }
            }else{
                $sql = "INSERT INTO periodo (fecha_inicio, fecha_fin, estado, descripcion, user_name) 
                  values (:p_fecha_inicio, :p_fecha_fin, :p_estado, :p_descripcion, :p_user_name) ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_fecha_inicio", $this->fecha_inicio);
                $sentencia->bindParam(":p_fecha_fin", $this->fecha_fin);
                $sentencia->bindParam(":p_estado", $this->estado);
                $sentencia->bindParam(":p_descripcion", $this->descripcion);
                $sentencia->bindParam(":p_user_name", $this->user_name);

                $sentencia->execute();

                return 1;
            }


        } catch (Exception $ex){
            throw $ex;
        }


    }

    public function update(){
        $this->dblink->beginTransaction();
        try{

            if($this->estado == 1 or $this->estado == '1'){
                $sql = "SELECT estado,id FROM periodo where estado = '1' ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                $id = $resultado['id'];

                if($id == $this->id){
                    $sql = "UPDATE periodo SET fecha_inicio= :p_fecha_inicio,fecha_fin = :p_fecha_fin,
                    descripcion =  :p_descripcion, estado = :p_estado, user_name = :p_user_name WHERE id = :p_id";

                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_fecha_inicio", $this->fecha_inicio);
                    $sentencia->bindParam(":p_fecha_fin", $this->fecha_fin);
                    $sentencia->bindParam(":p_descripcion", $this->descripcion);
                    $sentencia->bindParam(":p_estado", $this->estado);
                    $sentencia->bindParam(":p_user_name", $this->user_name);
                    $sentencia->bindParam(":p_id", $this->id);
                    $sentencia->execute();

                    $this->dblink->commit();;

                    return 2;
                }else{
                    if ($sentencia->rowCount()) {
                        return -1;
                    }else{
                        $this->create_periodo_criterio($this->id);

                        $sql = "UPDATE periodo SET fecha_inicio= :p_fecha_inicio,fecha_fin = :p_fecha_fin,
                    descripcion =  :p_descripcion, estado = :p_estado, user_name = :p_user_name WHERE id = :p_id";

                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->bindParam(":p_fecha_inicio", $this->fecha_inicio);
                        $sentencia->bindParam(":p_fecha_fin", $this->fecha_fin);
                        $sentencia->bindParam(":p_descripcion", $this->descripcion);
                        $sentencia->bindParam(":p_estado", $this->estado);
                        $sentencia->bindParam(":p_user_name", $this->user_name);
                        $sentencia->bindParam(":p_id", $this->id);
                        $sentencia->execute();

                        $this->dblink->commit();;

                        return 2;
                    }
                }
            }else{
                $sql = "UPDATE periodo SET fecha_inicio= :p_fecha_inicio,fecha_fin = :p_fecha_fin,
                    descripcion =  :p_descripcion, estado = :p_estado, user_name = :p_user_name WHERE id = :p_id";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_fecha_inicio", $this->fecha_inicio);
                $sentencia->bindParam(":p_fecha_fin", $this->fecha_fin);
                $sentencia->bindParam(":p_descripcion", $this->descripcion);
                $sentencia->bindParam(":p_estado", $this->estado);
                $sentencia->bindParam(":p_user_name", $this->user_name);
                $sentencia->bindParam(":p_id", $this->id);
                $sentencia->execute();

                $this->dblink->commit();

                return 2;

            }

        }catch (Exception $ex){
            $this->dblink->rollBack();
            throw $ex;
        }
    }

    public function create_periodo_criterio($periodo_id){
        try {

            $criterio_id=0;
            for($i = 0; $i < 4 ; $i++){
                $criterio_id = $criterio_id + 1;

                $sql = "INSERT INTO periodo_criterio (periodo_id, criterio_id) values (:p_periodo_id,:p_criterio_id)";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_periodo_id", $periodo_id);
                $sentencia->bindParam(":p_criterio_id", $criterio_id);
                $sentencia->execute();
            }

        }catch (Exception $ex){
            throw $ex;
        }


    }

    public function read($id)
    {
        $sql = "SELECT *,(CASE when  fecha_fin < current_date then -1 else 0 end) as vigencia
        FROM periodo WHERE id = " . $id ;
        $sentencia = $this->dblink->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->fetch();
        return $resultado;
    }

    public function vigencia(){
        $sql = "select count(*) as vigente from periodo where estado = 1
                " ;
        $sentencia = $this->dblink->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

        if ($sentencia->rowCount()) {
            return $resultado;
        }else{
            return -1;
        }

    }

    public function update_state_periodo(){
        try {
            $sql = "
                select
                  id,
                  (case when current_date between fecha_inicio and fecha_fin then 1 else 0 end) as new_status
                from periodo
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            if ($sentencia->rowCount()) {
                for ($i=0; $i<count($resultado); $i++){

                    $id = $resultado[$i]['id'];
                    $new_status = $resultado[$i]['new_status'];

                    $this->dblink->beginTransaction();
                    $sql = "update periodo set estado  = :p_estado where id = :p_id";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_estado", $new_status);
                    $sentencia->bindParam(":p_id", $id);
                    $sentencia->execute();
                    $this->dblink->commit();
                }
            }

            return $resultado;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function historial($f_inicio, $f_fin)
    {
        $sql = "select * from bitacora.periodo
                where date(fecha_hora) between :p_fecha_inicio and :p_fecha_fin  ";
        $sentencia = $this->dblink->prepare($sql);
        $sentencia->bindParam(":p_fecha_inicio", $f_inicio);
        $sentencia->bindParam(":p_fecha_fin", $f_fin);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll();
        return $resultado;
    }


}