<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 01/12/19
 * Time: 08:02 PM
 */
require_once '../datos/conexion.php';
class reporte extends conexion
{


    public function ventas_por_producto($residuo_id, $fecha_inicio, $fecha_fin){
        try {

            $sql = "select
                     r.id, r.nombre, SUM(d.cantidad) as peso_total , d.precio, SUM(d.sub_total) as sub_total
                    from detalle d inner join residuo r on d.residuo_id = r.id
                    inner join venta v on d.venta_id = v.id
                    where (case when 0 = :p_residuo_id then true else r.id = :p_residuo_id end)
                     and v.fecha_registro between :p_fecha_inicio and :p_fecha_fin
                    group by r.id, r.nombre, d.precio ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_residuo_id", $residuo_id);
            $sentencia->bindParam(":p_fecha_inicio", $fecha_inicio);
            $sentencia->bindParam(":p_fecha_fin", $fecha_fin);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

}