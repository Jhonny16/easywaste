<?php

require_once '../datos/conexion.php';

class persona_criterio extends conexion
{

    public function c_tiempo_atencion(){

        try{

            $sql = "select p.id, (p.ap_paterno ||' '|| p.ap_materno ||' '|| p.nombres) as reciclador,
                           coalesce(SUM(s.tiempo_aprox_atencion -
                                        ( ((extract(hours from (hora_llegada)-(hora_respuesta))):: integer) * 60
                                          + (extract(minutes from (hora_llegada)-(hora_respuesta)))::integer)),0)   as bono,
                                                 count(s.id) as cantidad_servicio

                    from servicio s right join persona p on s.reciclador_id = p.id
                    where rol_id = 2 and p.estado = 'A'
                    group by p.id,p.ap_paterno ||' '|| p.ap_materno ||'' || p.nombres;
                     ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }
    }
    public function c_antiguedad(){

        try{

            $sql = "select p.id, (p.ap_paterno ||' '|| p.ap_materno ||' '|| p.nombres) as reciclador,
                          current_date - p.fecha_registro as antiguedad
                    from servicio s right join persona p on s.reciclador_id = p.id
                    where rol_id = 2 and p.estado = 'A'
                    group by p.id,p.ap_paterno ||' '|| p.ap_materno ||'' || p.nombres; ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function c_calificacion(){

        try{

            $sql = "select p.id, (p.ap_paterno ||' '|| p.ap_materno ||' '|| p.nombres) as reciclador,
                           coalesce(SUM(s.calificacion) ,0)as calificacion,
                           count(s.id) as cantidad_servicio
                    from servicio s right join persona p on s.reciclador_id = p.id
                    where rol_id = 2 and p.estado = 'A'
                    group by p.id,p.ap_paterno ||' '|| p.ap_materno ||'' || p.nombres;
                     ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function c_atencion(){

        try{

            $sql = "select p.id, (p.ap_paterno ||' '|| p.ap_materno ||' '|| p.nombres) as reciclador,
                           SUM(case when s.estado='Finalizado' then 1 else 0 end) -
                           SUM(case when s.estado='Cancelado' then 1 else 0 end) as atencion
                    from servicio s  right join persona p on s.reciclador_id = p.id
                    where rol_id = 2 and p.estado = 'A'
                    group by p.id,p.ap_paterno ||' '|| p.ap_materno ||'' || p.nombres;
                     ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function create_update($persona_id, $criterio_id, $valor){
        $this->dblink->beginTransaction();

        try {
            $sql = "select persona_id , criterio_id, valor from persona_criterio
                    where persona_id = :p_personaid and criterio_id= :p_criterioid      ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_personaid", $persona_id);
            $sentencia->bindParam(":p_criterioid", $criterio_id);
            $sentencia->execute();
            $resultado = $sentencia->fetch();

            if ($sentencia->rowCount()){

                $sql = "update persona_criterio  set valor = :p_valor  where 
                              persona_id = :p_personaid and criterio_id = :p_criterioid";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_valor", $valor);
                $sentencia->bindParam(":p_personaid", $persona_id);
                $sentencia->bindParam(":p_criterioid",  $criterio_id);
                $sentencia->execute();


            }
            else{
                $sql = "insert into persona_criterio(persona_id,criterio_id,valor) 
                        values(:p_personaid, :p_criterioid, :p_valor)";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_personaid", $persona_id);
                $sentencia->bindParam(":p_criterioid", $criterio_id);
                $sentencia->bindParam(":p_valor", $valor);
                $sentencia->execute();
            }
            $this->dblink->commit();
            return true;

        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
    }

    public function datos_normalizados()
    {

        try {
            $sql = "select pc.persona_id,
                           (p.ap_paterno||' '|| p.ap_materno ||' '|| p.nombres) as reciclador,
                      SUM(case when pc.criterio_id=1 then pc.valor end) as criterio1,
                      SUM(case when pc.criterio_id=2 then pc.valor end) as criterio2,
                      SUM(case when pc.criterio_id=3 then pc.valor end) as criterio3,
                      SUM(case when pc.criterio_id=4 then pc.valor end) as criterio4
                    from persona_criterio pc inner join persona p on pc.persona_id = p.id
                    where p.estado = 'A'
                    group by persona_id,p.ap_paterno||' '|| p.ap_materno ||' '|| p.nombres
                    order by persona_id asc;";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            $this->update_state_reciclador();

            return $resultado;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function add_value($persona_id, $valor){
        $this->dblink->beginTransaction();

        try {

            $sql = "update persona set valor = :p_valor where id  = :p_persona_id ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_valor", $valor);
            $sentencia->bindParam(":p_persona_id", $persona_id);
            $sentencia->execute();
            $this->dblink->commit();
            return true;

        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

    }

    public function update_state_reciclador(){
        try {
            $sql = "
                    select
                           r.id,
                           (select name_status from status
                       where reciclador_id = r.id
                         order by 1 desc limit 1) as status,
                           (select fecha from status
                            where reciclador_id = r.id
                              order by 1 desc limit 1) as fecha,
                         coalesce  ((current_date
                            -
                           (select fecha from status
                            where reciclador_id = r.id
                              order by 1 desc limit 1)),0) as diferencia,
                           (case
                             when  (current_date - (select fecha from status where reciclador_id = r.id order by 1 desc limit 1) ) >15 then
                             'Desactivar' else 'Activar'
                             end)
                     from
                    persona as r
                    where r.rol_id = 2;";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            if ($sentencia->rowCount()) {
                for ($i=0; $i<count($resultado); $i++){
                    if($resultado[$i]['diferencia'] > 15){

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