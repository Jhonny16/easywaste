<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 29/04/20
 * Time: 04:53 PM
 */
require_once '../datos/conexion.php';
class almacen extends conexion
{

    private $id;
    private $code;
    private $fecha_registro;
    private $reciclador_id;
    private $user_id;
    private $acopio_temporal_id;
    private $sector_id;
    private $sector_name;
    private $total_peso;
    private $detalle;

    /**
     * @return mixed
     */
    public function getSectorName()
    {
        return $this->sector_name;
    }

    /**
     * @param mixed $sector_name
     */
    public function setSectorName($sector_name)
    {
        $this->sector_name = $sector_name;
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
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getFechaRegistro()
    {
        return $this->fecha_registro;
    }

    /**
     * @param mixed $fecha_registro
     */
    public function setFechaRegistro($fecha_registro)
    {
        $this->fecha_registro = $fecha_registro;
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
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getAcopioTemporalId()
    {
        return $this->acopio_temporal_id;
    }

    /**
     * @param mixed $acopio_temporal_id
     */
    public function setAcopioTemporalId($acopio_temporal_id)
    {
        $this->acopio_temporal_id = $acopio_temporal_id;
    }

    /**
     * @return mixed
     */
    public function getSectorId()
    {
        return $this->sector_id;
    }

    /**
     * @param mixed $sector_id
     */
    public function setSectorId($sector_id)
    {
        $this->sector_id = $sector_id;
    }

    /**
     * @return mixed
     */
    public function getTotalPeso()
    {
        return $this->total_peso;
    }

    /**
     * @param mixed $total_peso
     */
    public function setTotalPeso($total_peso)
    {
        $this->total_peso = $total_peso;
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
            $sql = "select secuencia from correlativo where tabla = 'almacen' ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();

            $secuencia = $resultado["secuencia"];
            $secuencia = $secuencia + 1;
            $pad = 6;

            $correlativo = str_pad($secuencia, $pad, "0", STR_PAD_LEFT);
            $numeracion = "ALM-" . $correlativo;
            $this->setCode($numeracion);


            $sql = "insert into almacen (code, fecha_registro, reciclador_id, user_id, acopio_temporal_id, sector_name, total_peso)
                    values (:p_code, :p_fecha_registro ,:p_reciclador, :p_user, :p_acopio_temporal,:p_sector_name, :p_total); ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_code", $this->code);
            $sentencia->bindParam(":p_fecha_registro", $this->fecha_registro);
            $sentencia->bindParam(":p_reciclador", $this->reciclador_id);
            $sentencia->bindParam(":p_user", $this->user_id);
            $sentencia->bindParam(":p_acopio_temporal", $this->acopio_temporal_id);
            $sentencia->bindParam(":p_sector_name", $this->sector_name);
            $sentencia->bindParam(":p_total", $this->total_peso);
            $sentencia->execute();

            $sql = "SELECT id FROM almacen order by 1 desc limit 1";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();

            if ($sentencia->rowCount()) {

                $id = $resultado['id'];
                $datosDetalle = json_decode($this->detalle);

                foreach ($datosDetalle as $key => $value) {
                    $sql = "insert into 
                        detalle_almacen (residuo_id, almacen_id, cantidad)
                        values(:p_residuo_id,:p_almacen_id,:p_cantidad)";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_residuo_id", $value->residuo_id);
                    $sentencia->bindParam(":p_almacen_id", $id);
                    $sentencia->bindParam(":p_cantidad", $value->cantidad);
                    $sentencia->execute();


                    $this->dblink->beginTransaction();
                    $sql = "update residuo set stock = stock + :p_cantidad where id = :p_residuo_id ";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_cantidad", $value->cantidad);
                    $sentencia->bindParam(":p_residuo_id", $value->residuo_id);
                    $sentencia->execute();
                    $this->dblink->commit();

                }


            }


            $this->dblink->beginTransaction();
            $sql = "update correlativo set secuencia = :p_secuencia where tabla = 'almacen' ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_secuencia", $secuencia);
            $sentencia->execute();
            $this->dblink->commit();



            return True;

        } catch (Exception $ex) {
            throw $ex;
        }
    }



    public function lista()
    {

        try {

            $sql = "
                    select
                    a.id, a.code,
                           a.fecha_registro,
                    p.ap_paterno || ' ' || p.ap_materno||' ' ||p.nombres as reciclador,
                           ca.nombre as centro_acopio,
                           a.sector_name as sector,
                           a.total_peso
                    from almacen a inner join persona p on a.reciclador_id = p.id
                    inner join centro_acopio ca on a.acopio_temporal_id = ca.id";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }


    }

    public function detalle()
    {
        try {

            $sql = "select d.*, r.nombre, a.code
                    from detalle_almacen d inner join residuo r on d.residuo_id = r.id
                    inner join almacen a on d.almacen_id = a.id
                    where almacen_id = :p_almacen_id;
                    ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_almacen_id", $this->id);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }


    }

}