<?php


require_once '../datos/conexion.php';

class venta extends conexion
{
    private $id;
    private $code;
    private $fecha_registro;
    private $estado;
    private $reciclador_id;
    private $user_id;
    private $acopio_temporal_id;
    private $acopio_final_id;
    private $total;
    private $precio_total;
    private $documento_referencia;
    private $detalle;

    /**
     * @return mixed
     */
    public function getDocumentoReferencia()
    {
        return $this->documento_referencia;
    }

    /**
     * @param mixed $documento_referencia
     */
    public function setDocumentoReferencia($documento_referencia)
    {
        $this->documento_referencia = $documento_referencia;
    }



    /**
     * @return mixed
     */
    public function getPrecioTotal()
    {
        return $this->precio_total;
    }

    /**
     * @param mixed $precio_total
     */
    public function setPrecioTotal($precio_total)
    {
        $this->precio_total = $precio_total;
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
    public function getAcopioFinalId()
    {
        return $this->acopio_final_id;
    }

    /**
     * @param mixed $acopio_final_id
     */
    public function setAcopioFinalId($acopio_final_id)
    {
        $this->acopio_final_id = $acopio_final_id;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
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

            $datosDetalle = json_decode($this->detalle);
            foreach ($datosDetalle as $key => $value) {
                $sql = "select stock from residuo where id = :p_residuo_id ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_residuo_id", $value->residuo_id);
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                $sw = 0;
                $stock = 0;
                if ($sentencia->rowCount()) {
                    $stock = $resultado['stock'];
                    if($stock < $value->cantidad){
                        $sw=1;
                        break;
                    }
                }
            }

            if($sw==0){
                $sql = "insert into venta (documento_referencia,fecha_registro,reciclador_id, user_id,acopio_final_id,precio_total)
                    values (:p_documento, :p_fecha_registro ,:p_reciclador, :p_user, :p_acopio_final, :p_precio_total); ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_documento", $this->documento_referencia);
                $sentencia->bindParam(":p_fecha_registro", $this->fecha_registro);
                $sentencia->bindParam(":p_reciclador", $this->reciclador_id);
                $sentencia->bindParam(":p_user", $this->user_id);
                $sentencia->bindParam(":p_acopio_final", $this->acopio_final_id);
                $sentencia->bindParam(":p_precio_total", $this->precio_total);
                $sentencia->execute();

                $sql = "SELECT id FROM venta order by 1 desc limit 1";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if ($sentencia->rowCount()) {

                    foreach ($datosDetalle as $key => $value) {
                        $sql = "insert into 
                        detalle (residuo_id,cantidad,precio,sub_total,venta_id)
                        values(:p_residuo_id,:p_cantidad, :p_precio, :p_sub_total, :p_venta_id)";
                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->bindParam(":p_residuo_id", $value->residuo_id);
                        $sentencia->bindParam(":p_cantidad", $value->cantidad);
                        $sentencia->bindParam(":p_precio", $value->precio);
                        $sentencia->bindParam(":p_sub_total", $value->subtotal);
                        $sentencia->bindParam(":p_venta_id", $resultado['id']);
                        $sentencia->execute();

                        $this->dblink->beginTransaction();
                        $sql = "update residuo set stock = stock - :p_cantidad where id = :p_residuo_id ";
                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->bindParam(":p_cantidad", $value->cantidad);
                        $sentencia->bindParam(":p_residuo_id", $value->residuo_id);
                        $sentencia->execute();
                        $this->dblink->commit();

                    }
                }

                return 1;
            }else{
                return -1;
            }



        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function lista()
    {

        try {

            $sql = "select
                      v.id as venta_id, v.documento_referencia, v.fecha_registro, v.estado, v.precio_total,
                      p.ap_paterno || ' ' || p.ap_materno||' ' ||p.nombres as reciclador,
                      ca.nombre as centro_acopio_f
                    from venta v inner join persona p on v.reciclador_id = p.id
                                 inner join centro_acopio ca on v.acopio_final_id = ca.id;";
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

            $sql = "select d.*, r.nombre, v.documento_referencia
                    from detalle d inner join residuo r on d.residuo_id = r.id
                    inner join venta v on d.venta_id = v.id
                    where venta_id = :p_venta_id;
                    ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_venta_id", $this->id);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }


    }


    public function update()
    {
        try {

            $this->dblink->beginTransaction();
            $sql = "update venta set 
                    estado = :p_estado, 
                    acopio_final_id = :p_acopio_final_id,
                    precio_total = :p_precio_total
                    where id = :p_venta ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_estado", $this->estado);
            $sentencia->bindParam(":p_acopio_final_id", $this->acopio_final_id);
            $sentencia->bindParam(":p_precio_total", $this->precio_total);
            $sentencia->bindParam(":p_venta", $this->id);
            $sentencia->execute();
            $this->dblink->commit();


            $datosDetalle = json_decode($this->detalle);

            foreach ($datosDetalle as $key => $value) {

                $this->dblink->beginTransaction();
                $sql = "update detalle set 
                    cantidad = :p_peso, 
                    precio = :p_precio,
                    sub_total = :p_sub_total
                    where id = :p_detalle_id";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_peso", $value->peso);
                $sentencia->bindParam(":p_precio", $value->precio);
                $sentencia->bindParam(":p_sub_total", $value->sub_total);
                $sentencia->bindParam(":p_detalle_id", $value->detalle_id);
                $sentencia->execute();
                $this->dblink->commit();
            }

            return True;

        } catch (Exception $ex) {
            throw $ex;
        }
    }


}