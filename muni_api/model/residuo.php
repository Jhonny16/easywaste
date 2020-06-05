<?php

require_once '../datos/conexion.php';
class residuo extends conexion
{
    private $id;
    private $nombre;

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
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function lista(){
        try {

            $sql = "SELECT * from residuo";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function lista_por_reciclador($reciclador_id){
        try {

            $sql = "select r.id,r.nombre ,
                           sum(da.cantidad) -
                           coalesce((select
                              sum(d.cantidad) as cantidad
                            from detalle as d inner join venta v on d.venta_id = v.id
                            where v.reciclador_id = :p_reciclador and d.residuo_id = r.id),0) as cantidad
                    from detalle_almacen as da left join residuo r on da.residuo_id = r.id
                    inner join almacen a on da.almacen_id = a.id
                    where a.reciclador_id = :p_reciclador
                    group by r.id, r.nombre
                    having    sum(da.cantidad) -
                              coalesce((select
                                          sum(d.cantidad) as cantidad
                                        from detalle as d inner join venta v on d.venta_id = v.id
                                        where v.reciclador_id = :p_reciclador and d.residuo_id = r.id),0) > 0
                    ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_reciclador", $reciclador_id);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }
    }
}