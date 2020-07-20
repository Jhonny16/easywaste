<?php

require_once '../datos/conexion.php';

class servicio extends conexion
{
    private $id;
    private $code;
    private $taa;
    private $tra;
    private $calificacion;
    private $estado;
    private $fecha;
    private $hora;
    private $proveedor_id;
    private $reciclador_id;
    private $latitud;
    private $longitud;
    private $referencia;
    private $hora_respuesta;
    private $hora_llegada;
    private $tiempo_aproximado;
    private $imagen;

    private $array_distancias;

    /**
     * @return mixed
     */
    public function getArrayDistancias()
    {
        return $this->array_distancias;
    }

    /**
     * @param mixed $array_distancias
     */
    public function setArrayDistancias($array_distancias)
    {
        $this->array_distancias = $array_distancias;
    }


    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }


    /**
     * @return mixed
     */
    public function getTiempoAproximado()
    {
        return $this->tiempo_aproximado;
    }

    /**
     * @param mixed $tiempo_aproximado
     */
    public function setTiempoAproximado($tiempo_aproximado)
    {
        $this->tiempo_aproximado = $tiempo_aproximado;
    }


    /**
     * @return mixed
     */
    public function getHoraRespuesta()
    {
        return $this->hora_respuesta;
    }

    /**
     * @param mixed $hora_respuesta
     */
    public function setHoraRespuesta($hora_respuesta)
    {
        $this->hora_respuesta = $hora_respuesta;
    }

    /**
     * @return mixed
     */
    public function getHoraLlegada()
    {
        return $this->hora_llegada;
    }

    /**
     * @param mixed $hora_llegada
     */
    public function setHoraLlegada($hora_llegada)
    {
        $this->hora_llegada = $hora_llegada;
    }


    /**
     * @return mixed
     */
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * @param mixed $referencia
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;
    }


    /**
     * @return mixed
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * @param mixed $latitud
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;
    }

    /**
     * @return mixed
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * @param mixed $longitud
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;
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
    public function getTaa()
    {
        return $this->taa;
    }

    /**
     * @param mixed $tap
     */
    public function setTaa($taa)
    {
        $this->taa = $taa;
    }

    /**
     * @return mixed
     */
    public function getTra()
    {
        return $this->tra;
    }

    /**
     * @param mixed $tra
     */
    public function setTra($tra)
    {
        $this->tra = $tra;
    }

    /**
     * @return mixed
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * @param mixed $calificacion
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;
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
    public function getProveedorId()
    {
        return $this->proveedor_id;
    }

    /**
     * @param mixed $proveedor_id
     */
    public function setProveedorId($proveedor_id)
    {
        $this->proveedor_id = $proveedor_id;
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


    public function create()
    {

        try {


            $sql = "select secuencia from correlativo where tabla = 'servicio' ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();

            $secuencia = $resultado["secuencia"];
            $secuencia = $secuencia + 1;
            $pad = 6;
            $correlativo = str_pad($secuencia, $pad, "0", STR_PAD_LEFT);
            $numeracion = "SRV-" . $correlativo;
            $this->setCode($numeracion);


            $sql = "insert into servicio (code, estado, fecha, hora, 
                                          proveedor_id, latitud,longitud, referencia, imagen)
                    values (:p_code, :p_estado, :p_fecha, :p_hora, 
                                          :p_proveedor_id, :p_latitud, :p_longitud, :p_ref, :p_imagen); ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_code", $this->code);
            $sentencia->bindParam(":p_estado", $this->estado);
            $sentencia->bindParam(":p_fecha", $this->fecha);
            $sentencia->bindParam(":p_hora", $this->hora);
            $sentencia->bindParam(":p_proveedor_id", $this->proveedor_id);
            $sentencia->bindParam(":p_latitud", $this->latitud);
            $sentencia->bindParam(":p_longitud", $this->longitud);
            $sentencia->bindParam(":p_ref", $this->referencia);
            $sentencia->bindParam(":p_imagen", $this->imagen);
            $sentencia->execute();


            //Calculo de distancias: para ello necesitamos determinar cuales son los disponibles
            //$datosDetalle = json_decode($this->array_distancias);
            $datosDetalle = $this->array_distancias;
            $array = [];

            for ($i = 0; $i < count($datosDetalle); $i++) {


                $array_data = [];
                $array_data[0] = $datosDetalle[$i]['id'];
                $array_data[1] = $datosDetalle[$i]['valor'];
                //En caso este disponible se agregará a un arreglo
                array_push($array, $array_data);
//
//                $sql_d = "select p.id, p.valor,
//                                   (select name_status from status where reciclador_id = p.id
//                                    order by id desc limit 1) as name_status
//                            from  persona p
//                            where p.rol_id = 2 and p.id = :p_reciclador_id
//                            group by p.id,p.valor
//                            order by p.valor desc limit 1
//                            ";
//                $sentence = $this->dblink->prepare($sql_d);
//                $sentence->bindParam(":p_reciclador_id", $value->reciclador_id);
//                $sentence->execute();
//                $res = $sentence->fetch(PDO::FETCH_ASSOC);
//
//                //Determinamos si el reciclador esta disponible
//                if ($sentence->rowCount()) {
//                    if($res['id'] > 0 and $res['name_status'] == 'Disponible'){
//                        $array_data = [];
//                        $array_data[0] = $res['id'];
//                        $array_data[1] = $res['valor'];
//                        //$array_data[1] = $value->distancia;
//                        //En caso este disponible se agregará a un arreglo
//                        array_push($array, $array_data);
//                    }
//
//                }

            }

            //Si hay recicladores disponibles entonces determinamos por prioridad de valor.
            if (count($array) > 0) {

                $mayor = (double)$array[0][1];
                $recycle_id = $array[0][0];
                for ($i = 0; $i < count($array); $i++) {
                    if ($mayor < (double)$array[$i][1]) {
                        $mayor = (double)$array[$i][1];
                        $recycle_id = $array[$i][0];
                    }
                }

                //return $recycle_id;

                // --
                //Asigamos el reciclador al servicio

                $this->dblink->beginTransaction();
                $sql = "update servicio set reciclador_id = :p_reciclador where code = :p_code ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_reciclador", $recycle_id);
                $sentencia->bindParam(":p_code", $this->code);
                $sentencia->execute();
                $this->dblink->commit();


                date_default_timezone_set("America/Lima");
                $hora = date('H:i:s');
                $fecha = date('Y-m-d');
                $estado = 'Ocupado';

                $sql = "insert into status (fecha, hora, name_status, reciclador_id) 
                        values (:p_fecha,:p_hora,:p_estado,:p_reciclador)";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_fecha", $fecha);
                $sentencia->bindParam(":p_hora", $hora);
                $sentencia->bindParam(":p_estado", $estado);
                $sentencia->bindParam(":p_reciclador", $recycle_id);
                $sentencia->execute();


                //----

                //Asignamos los servicios a reciclador segun orden de prioridad

                //Comentado por el momento

//                $sql_s = "select p.id, p.valor,
//                           (select name_status from status where reciclador_id = p.id
//                           order by id desc limit 1) as name_status
//                    from  persona p
//                    where p.rol_id = 2
//                    group by p.id,p.valor
//                    having (select name_status from status where reciclador_id = p.id
//                             order by id desc limit 1) = 'Disponible'
//                    order by p.valor desc limit 1";
//                $sentence = $this->dblink->prepare($sql_s);
//                $sentence->execute();
//                $result = $sentence->fetch(PDO::FETCH_ASSOC);
//                //if(count($result)>0){
//                if ($sentence->rowCount()) {
//                    $this->dblink->beginTransaction();
//                    $sql = "update servicio set reciclador_id = :p_reciclador where code = :p_code ";
//                    $sentencia = $this->dblink->prepare($sql);
//                    $sentencia->bindParam(":p_reciclador", $result['id']);
//                    $sentencia->bindParam(":p_code", $this->code);
//                    $sentencia->execute();
//                    $this->dblink->commit();
//
//
//                    date_default_timezone_set("America/Lima");
//                    $hora = date('H:i:s');
//                    $fecha = date('Y-m-d');
//                    $estado = 'Ocupado';
//
//                    $sql = "insert into status (fecha, hora, name_status, reciclador_id)
//                        values (:p_fecha,:p_hora,:p_estado,:p_reciclador)";
//                    $sentencia = $this->dblink->prepare($sql);
//                    $sentencia->bindParam(":p_fecha", $fecha);
//                    $sentencia->bindParam(":p_hora", $hora);
//                    $sentencia->bindParam(":p_estado", $estado);
//                    $sentencia->bindParam(":p_reciclador", $result['id']);
//                    $sentencia->execute();
//                }


                //----

                $this->dblink->beginTransaction();
                $sql = "update correlativo set secuencia = :p_secuencia where tabla = 'servicio' ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_secuencia", $secuencia);
                $sentencia->execute();
                $this->dblink->commit();

                $sql = "select id from servicio order by id desc limit 1 ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                if ($sentencia->rowCount()) {
                    $servicio_id = $resultado['id'];

                    $res = $this->position_create($servicio_id, $this->latitud, $this->longitud);
                    if ($res) {
                        return array($recycle_id, $servicio_id);
                    } else {
                        return array(0, 0);
                    }
                }

                //---


            } else {

                return array(-1, -1);

            }


        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function create_pendiente()
    {

        try {
            $sql = "select secuencia from correlativo where tabla = 'servicio' ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();

            $secuencia = $resultado["secuencia"];
            $secuencia = $secuencia + 1;
            $pad = 6;
            $correlativo = str_pad($secuencia, $pad, "0", STR_PAD_LEFT);
            $numeracion = "SRV-" . $correlativo;
            $this->setCode($numeracion);

            $state = 'Abierto';

            $sql = "insert into servicio (code, estado, fecha, hora, 
                                          proveedor_id, latitud,longitud, referencia, imagen)
                    values (:p_code, :p_estado, :p_fecha, :p_hora, 
                                          :p_proveedor_id, :p_latitud, :p_longitud, :p_ref, :p_imagen); ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_code", $this->code);
            $sentencia->bindParam(":p_estado", $state);
            $sentencia->bindParam(":p_fecha", $this->fecha);
            $sentencia->bindParam(":p_hora", $this->hora);
            $sentencia->bindParam(":p_proveedor_id", $this->proveedor_id);
            $sentencia->bindParam(":p_latitud", $this->latitud);
            $sentencia->bindParam(":p_longitud", $this->longitud);
            $sentencia->bindParam(":p_ref", $this->referencia);
            $sentencia->bindParam(":p_imagen", $this->imagen);
            $sentencia->execute();

            $this->dblink->beginTransaction();
            $sql = "update correlativo set secuencia = :p_secuencia where tabla = 'servicio' ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_secuencia", $secuencia);
            $sentencia->execute();
            $this->dblink->commit();

            return true;

        } catch (Exception $ex) {
            throw $ex;
        }


    }

    public function position_create($servicio_id, $latitud, $longitud)
    {
        try {

            $sql = "insert into position (latitud, longitud, lat_actual, lon_actual, servicio_id)
                    values (:p_latitud, :p_longitud ,:p_latitud_actual, :p_longitud_actual,  :p_servicio_id); ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_latitud", $latitud);
            $sentencia->bindParam(":p_longitud", $latitud);
            $sentencia->bindParam(":p_latitud_actual", $latitud);
            $sentencia->bindParam(":p_longitud_actual", $longitud);
            $sentencia->bindParam(":p_servicio_id", $servicio_id);
            $sentencia->execute();
            return 1;

        } catch (Exception $ex) {
            throw $ex;
            return 0;
        }
    }

    public function list_serv_prov()
    {

        try {
            $sql = "select
                    s.id, (p.ap_paterno ||' '|| p.ap_materno ||' '|| p.nombres) as proveedor,
                    s.fecha, s.hora, s.estado, s.tiempo_aprox_atencion
                    from
                    servicio s inner join persona p on s.proveedor_id = p.id
                    where s.estado = 'Abierto' and s.reciclador_id = :p_reciclador_id";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_reciclador_id", $this->reciclador_id);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function serv_atender()
    {

        try {

            $sql = "select  s.id, s.nuevo_id , s.code, (p.ap_paterno ||' '|| p.ap_materno ||' '|| p.nombres) as proveedor,
                        (r.ap_paterno ||' '|| r.ap_materno ||' '|| r.nombres) as reciclador,
                        r.dni as reciclador_dni, s.reciclador_id,
                        s.fecha, s.hora, s.estado, s.tiempo_aprox_atencion, latitud, longitud
                        from  servicio s inner join persona p on s.proveedor_id = p.id
                        left join persona r on s.reciclador_id = r.id
                    where s.id =  :p_serv_id ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_serv_id", $this->id);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

            if ($sentencia->rowCount()) {
                $reciclador_id = $resultado['reciclador_id'];
                date_default_timezone_set("America/Lima");
                $hora = date('H:i:s');
                $fecha = date('Y-m-d');
                $name_status = 'Ocupado';
                $sql = "insert into status (fecha, hora, name_status, reciclador_id)
                    values (:p_fecha, :p_hora ,:name_status, :p_reciclador_id); ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_fecha", $fecha);
                $sentencia->bindParam(":p_hora", $hora);
                $sentencia->bindParam(":name_status", $name_status);
                $sentencia->bindParam(":p_reciclador_id", $reciclador_id);
                $sentencia->execute();
            }


            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function update_estado_hora()
    {
        $this->dblink->beginTransaction();

        try {

            $sql = "update servicio set estado = :p_estado , hora_respuesta = :p_hora_respuesta,
                    tiempo_aprox_atencion = :p_tiempo_aprox where id = :p_serv_id";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_serv_id", $this->id);
            $sentencia->bindParam(":p_hora_respuesta", $this->hora_respuesta);
            $sentencia->bindParam(":p_tiempo_aprox", $this->tiempo_aproximado);
            $sentencia->bindParam(":p_estado", $this->estado);
            $sentencia->execute();
            $this->dblink->commit();
            return true;
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }


    }

    public function update_estado_hora_llegada()
    {


        try {
            $this->dblink->beginTransaction();
            $sql = "update servicio set estado = :p_estado , hora_llegada = :p_hora_llegada  where id = :p_id";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id", $this->id);
            $sentencia->bindParam(":p_hora_llegada", $this->hora_llegada);
            $sentencia->bindParam(":p_estado", $this->estado);
            $sentencia->execute();
            $this->dblink->commit();
            return true;
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }


    }

    public function update_estado()
    {


        try {
            $this->dblink->beginTransaction();
            $sql = "update servicio set estado = :p_estado where id = :p_id";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_estado", $this->estado);
            $sentencia->bindParam(":p_id", $this->id);
            $sentencia->execute();
            $this->dblink->commit();

            if ($this->estado == 'Finalizado') {

                $sql = "select reciclador_id, proveedor_id from servicio where id = :p_id ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_id", $this->id);
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                if ($sentencia->rowCount()) {
                    $reciclador_id = $resultado['reciclador_id'];
                    if ((integer)$reciclador_id > 1) {
                        date_default_timezone_set("America/Lima");
                        $hora = date('H:i:s');
                        $fecha = date('Y-m-d');
                        $estado = 'Disponible';

                        $sql = "insert into status (fecha, hora, name_status, reciclador_id)
                        values (:p_fecha,:p_hora,:p_estado,:p_reciclador)";
                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->bindParam(":p_fecha", $fecha);
                        $sentencia->bindParam(":p_hora", $hora);
                        $sentencia->bindParam(":p_estado", $estado);
                        $sentencia->bindParam(":p_reciclador", $reciclador_id);
                        $sentencia->execute();

                        //Agregado para insertar 1 pintrash por servicio
                        $value = 1;
                        $sql = "insert into pintrash (pintrash, servicio_id)
                                    values (:p_pintrash,:p_servicio_id)";
                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->bindParam(":p_pintrash", $value);
                        $sentencia->bindParam(":p_servicio_id", $this->id);
                        $sentencia->execute();
//
//                        $sql = "select
//                                  p.pintrash, p.servicio_id
//                                from pintrash p inner join servicio s on p.servicio_id = s.id inner join persona p2 on s.proveedor_id = p2.id
//                                where p2.id = :p_proveedor_id and p.descuento >= 1
//                                order by p.id desc limit 1
//                                ;";
//                        $sentencia = $this->dblink->prepare($sql);
//                        $sentencia->bindParam(":p_proveedor_id", $resultado['proveedor_id']);
//                        $sentencia->execute();
//                        $res = $sentencia->fetch(PDO::FETCH_ASSOC);

//                        if ($sentencia->rowCount()) {
//                            $p1 = (integer)$res['pintrash'];
//                            $serv_id = (integer)$res['servicio_id'];
//
//                            $sql = "select count(*)/2 as pintrash
//                                from servicio
//                                where proveedor_id = :p_proveedor_id and id > :p_serv_id ;";
//                            $sentencia = $this->dblink->prepare($sql);
//                            $sentencia->bindParam(":p_proveedor_id", $resultado['proveedor_id']);
//                            $sentencia->bindParam(":p_serv_id", $serv_id);
//                            $sentencia->execute();
//                            $res = $sentencia->fetch(PDO::FETCH_ASSOC);
//
//                            if ($sentencia->rowCount()) {
//                                $p2 = (integer)$res['pintrash'];
//
//                                $pin = (integer)$p1 + (integer)$p2;
//
//                                $sql = "insert into pintrash (pintrash, servicio_id)
//                                    values (:p_pintrash,:p_servicio_id)";
//                                $sentencia = $this->dblink->prepare($sql);
//                                $sentencia->bindParam(":p_pintrash", $pin);
//                                $sentencia->bindParam(":p_servicio_id", $this->id);
//                                $sentencia->execute();
//                            }
//
//                        }else{
//                            $sql = "select count(*)/2 as pintrash
//                                from servicio
//                                where proveedor_id = :p_proveedor_id ;";
//                            $sentencia = $this->dblink->prepare($sql);
//                            $sentencia->bindParam(":p_proveedor_id", $resultado['proveedor_id']);
//                            $sentencia->execute();
//                            $res = $sentencia->fetch(PDO::FETCH_ASSOC);
//                            if ($sentencia->rowCount()) {
//                                $sql = "insert into pintrash (pintrash, servicio_id)
//                                    values (:p_pintrash,:p_servicio_id)";
//                                $sentencia = $this->dblink->prepare($sql);
//                                $sentencia->bindParam(":p_pintrash", $res['pintrash']);
//                                $sentencia->bindParam(":p_servicio_id", $this->id);
//                                $sentencia->execute();
//                            }
//                        }


                    }

                    return true;
                } else {
                    return true;
                }

            } else {
                return -1;
            }


//            if($this->estado == 'Finalizado'){
//                $sql = "select proveedor_id from servicio
//                    where id = :p_id";
//                $sentencia = $this->dblink->prepare($sql);
//                $sentencia->bindParam(":p_id", $this->id);
//                $sentencia->execute();
//                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
//                if ($sentencia->rowCount()) {
//                    $proveedor_id = $resultado['proveedor_id'];
//                    $res = $this->count_pintrash($proveedor_id);
//                    if($res==-2){
//                        return -2 ;
//                    }else{
//                        return $res;
//                    }
//                }else{
//                    return -1;
//                }
//            }else{
//                return -1;
//            }

        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }


    }

    public function count_pintrash($proveedor_id)
    {
        try {
//            $sql = "select count(*)/2 as pintrash from servicio
//                    where proveedor_id = :p_proveedor_id
//                    group by proveedor_id
//                    having count(*)/2 > 0";
            $sql = "select p2.id, p2.dni, p2.ap_paterno || ' '|| p2.ap_materno ||' '|| p2.nombres as proveedor
                            ,sum(p.pintrash) -
                             coalesce((select sum(pintrash_total) from canje where persona_id = p2.id),0)
                               as pintrash
                    from pintrash p left join servicio s on p.servicio_id = s.id
                                    inner join persona p2 on s.proveedor_id = p2.id
                    where p2.id = :p_persona_id
                    group by  p2.id, p2.dni, p2.ap_paterno || ' '|| p2.ap_materno ||' '|| p2.nombres
                     limit 1;";
            $sentence = $this->dblink->prepare($sql);
            $sentence->bindParam(":p_persona_id", $proveedor_id);
            $sentence->execute();
            $result = $sentence->fetch(PDO::FETCH_ASSOC);

            if ($sentence->rowCount()) {
                return (integer)$result['pintrash'];
            } else {
                return -2;
            }
//
//            $sql = "select id, hasta_id from pintrash where persona_id = :p_persona_id";
//            $sentence = $this->dblink->prepare($sql);
//            $sentence->bindParam(":p_persona_id", $proveedor_id);
//            $sentence->execute();
//            $result = $sentence->fetch(PDO::FETCH_ASSOC);
//            if ($sentence->rowCount()) {
//
//                $sql = "select count(*) as cantidad, count(*)/2 as pintrash,
//                           (select max(id) from servicio where proveedor_id = :p_proveedor_id)  as servicio_id,
//                           (select hasta_id from pintrash where persona_id = :p_proveedor_id) as a_partir
//                           from servicio
//                    where proveedor_id = :p_proveedor_id and id >= :p_id  ";
//                $sentencia = $this->dblink->prepare($sql);
//                $sentencia->bindParam(":p_proveedor_id", $proveedor_id);
//                $sentencia->bindParam(":p_id", $result['hasta_id']);
//                $sentencia->execute();
//                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
//
//                if ($sentencia->rowCount()) {
//                    $cantidad = $resultado['cantidad'];
//
//                    $mod = $cantidad % 2;
//                    if($mod==0){
//                        $this->dblink->beginTransaction();
//                        $sql = "update pintrash set pintrash = :p_pintrash, hasta_id = :p_hasta_id
//                        where id = :p_id";
//                        $sentencia = $this->dblink->prepare($sql);
//                        $sentencia->bindParam(":p_pintrash", $resultado['pintrash']);
//                        $sentencia->bindParam(":p_hasta_id",$resultado['id']);
//                        $sentencia->bindParam(":p_id", $result['id']);
//                        $sentencia->execute();
//                        $this->dblink->commit();
//                    }else{
//                        $var = 1000;
//                        $this->dblink->beginTransaction();
//                        $sql = "update pintrash set pintrash = :p_pintrash, hasta_id = :p_hasta_id
//                        where id = :p_id";
//                        $sentencia = $this->dblink->prepare($sql);
//                        $sentencia->bindParam(":p_pintrash", $resultado['pintrash']);
//                        $sentencia->bindParam(":p_hasta_id", $var);
//                        $sentencia->bindParam(":p_id", $result['id']);
//                        $sentencia->execute();
//                        $this->dblink->commit();
//                    }
//
//                }else{
//                    $sql = "insert into pintrash (pintrash, hasta_id, persona_id)
//                        values (:p_pintrash,:p_hasta_id,:p_persona_id)";
//                    $sentencia = $this->dblink->prepare($sql);
//                    $sentencia->bindParam(":p_pintrash", $resultado['pintrash']);
//                    $sentencia->bindParam(":p_hasta_id", $resultado['servicio_id']);
//                    $sentencia->bindParam(":p_persona_id", $proveedor_id);
//                    $sentencia->execute();
//                }
//
//            }else{
//                $sql = "select count(*) as cantidad, count(*)/2 as pintrash,
//                           (select max(id) from servicio where proveedor_id = :p_proveedor_id)
//                            as servicio_id
//                           from servicio
//                    where proveedor_id = :p_proveedor_id";
//                $sentencia = $this->dblink->prepare($sql);
//                $sentencia->bindParam(":p_proveedor_id", $proveedor_id);
//                $sentencia->execute();
//                $res = $sentencia->fetch(PDO::FETCH_ASSOC);
//
//                $sql = "select id from pintrash where persona_id = :p_persona_id";
//                $sentencia = $this->dblink->prepare($sql);
//                $sentencia->bindParam(":p_persona_id", $proveedor_id);
//                $sentencia->execute();
//                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
//                if ($sentencia->rowCount()) {
//                    $cantidad = $res['cantidad'];
//
//                    $mod = $cantidad % 2;
//                    if($mod==0){
//                        $this->dblink->beginTransaction();
//                        $sql = "update pintrash set pintrash = :p_pintrash, hasta_id = :p_hasta_id
//                        where id = :p_id";
//                        $sentencia = $this->dblink->prepare($sql);
//                        $sentencia->bindParam(":p_pintrash", $res['pintrash']);
//                        $sentencia->bindParam(":p_hasta_id",$res['servicio_id']);
//                        $sentencia->bindParam(":p_id", $resultado['id']);
//                        $sentencia->execute();
//                        $this->dblink->commit();
//                    }else{
//                        $var = 1000;
//                        $this->dblink->beginTransaction();
//                        $sql = "update pintrash set pintrash = :p_pintrash, hasta_id = :p_hasta_id
//                        where id = :p_id";
//                        $sentencia = $this->dblink->prepare($sql);
//                        $sentencia->bindParam(":p_pintrash", $res['pintrash']);
//                        $sentencia->bindParam(":p_hasta_id",$var);
//                        $sentencia->bindParam(":p_id", $resultado['id']);
//                        $sentencia->execute();
//                        $this->dblink->commit();
//                    }
//
//                }else{
//                    $sql = "insert into pintrash (pintrash, hasta_id, persona_id)
//                        values (:p_pintrash,:p_hasta_id,:p_persona_id)";
//                    $sentencia = $this->dblink->prepare($sql);
//                    $sentencia->bindParam(":p_pintrash", $res['pintrash']);
//                    $sentencia->bindParam(":p_hasta_id", $res['servicio_id']);
//                    $sentencia->bindParam(":p_persona_id", $proveedor_id);
//                    $sentencia->execute();
//                }
//            }
//
//            $sql = "select pintrash from pintrash where persona_id = :p_persona_id";
//            $sentence = $this->dblink->prepare($sql);
//            $sentence->bindParam(":p_persona_id", $proveedor_id);
//            $sentence->execute();
//            $respuesta = $sentence->fetch(PDO::FETCH_ASSOC);
//
//


        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function update_calificacion()
    {
        $this->dblink->beginTransaction();

        try {

            $sql = "update servicio set calificacion = :p_calificacion where id = :p_id";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_calificacion", $this->calificacion);
            $sentencia->bindParam(":p_id", $this->id);
            $sentencia->execute();
            $this->dblink->commit();
            return true;
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }


    }

    public function servicio_create_reasignar($reciclador_id, $reciclador_antiguo_id)
    {

        try {

            $sql = "select * from servicio where id = :p_id ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id", $this->id);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

            if ($sentencia->rowCount()) {
                $estado = 'Abierto';
                $this->setEstado($estado);
                $this->setFecha($resultado['fecha']);
                $this->setHora($resultado['hora']);
                $this->setProveedorId($resultado['proveedor_id']);
                $this->setLongitud($resultado['longitud']);
                $this->setLatitud($resultado['latitud']);
                $this->setReferencia($resultado['referencia']);
                $this->setImagen($resultado['imagen']);

            }


            $sql = "select secuencia from correlativo where tabla = 'servicio' ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();

            $secuencia = $resultado["secuencia"];
            $secuencia = $secuencia + 1;
            $pad = 6;
            $correlativo = str_pad($secuencia, $pad, "0", STR_PAD_LEFT);
            $numeracion = "SRV-" . $correlativo;
            $this->setCode($numeracion);


            $sql = "insert into servicio (code, estado, fecha, hora, 
                                          proveedor_id, latitud,longitud, referencia, imagen, reciclador_id)
                    values (:p_code, :p_estado, :p_fecha, :p_hora, 
                                          :p_proveedor_id, :p_latitud, :p_longitud, :p_ref, :p_imagen, :p_reciclador_id); ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_code", $this->code);
            $sentencia->bindParam(":p_estado", $this->estado);
            $sentencia->bindParam(":p_fecha", $this->fecha);
            $sentencia->bindParam(":p_hora", $this->hora);
            $sentencia->bindParam(":p_proveedor_id", $this->proveedor_id);
            $sentencia->bindParam(":p_latitud", $this->latitud);
            $sentencia->bindParam(":p_longitud", $this->longitud);
            $sentencia->bindParam(":p_ref", $this->referencia);
            $sentencia->bindParam(":p_imagen", $this->imagen);
            $sentencia->bindParam(":p_reciclador_id", $reciclador_id);
            $sentencia->execute();

            date_default_timezone_set("America/Lima");
            $hora = date('H:i:s');
            $fecha = date('Y-m-d');
            $estado = 'Ocupado';

            $sql = "insert into status (fecha, hora, name_status, reciclador_id) 
                        values (:p_fecha,:p_hora,:p_estado,:p_reciclador)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_fecha", $fecha);
            $sentencia->bindParam(":p_hora", $hora);
            $sentencia->bindParam(":p_estado", $estado);
            $sentencia->bindParam(":p_reciclador", $reciclador_id);
            $sentencia->execute();

            $estado = 'Disponible';
            $sql = "insert into status (fecha, hora, name_status, reciclador_id) 
                        values (:p_fecha,:p_hora,:p_estado,:p_reciclador)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_fecha", $fecha);
            $sentencia->bindParam(":p_hora", $hora);
            $sentencia->bindParam(":p_estado", $estado);
            $sentencia->bindParam(":p_reciclador", $reciclador_antiguo_id);
            $sentencia->execute();


            $this->dblink->beginTransaction();
            $sql = "update correlativo set secuencia = :p_secuencia where tabla = 'servicio' ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_secuencia", $secuencia);
            $sentencia->execute();
            $this->dblink->commit();

            $sql = "select id from servicio order by id desc limit 1 ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

            if ($sentencia->rowCount()) {
                $servicio_id = $resultado['id'];


                $state = 'Cancelado';
                $this->dblink->beginTransaction();
                $sql = "update servicio set estado = :p_estado, nuevo_id = :p_nuevo_id where id = :p_id ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_id", $this->id);
                $sentencia->bindParam(":p_estado", $state);
                $sentencia->bindParam(":p_nuevo_id", $servicio_id);
                $sentencia->execute();
                $this->dblink->commit();

                $res = $this->position_create($servicio_id, $this->latitud, $this->longitud);
                if ($res) {
                    return array($reciclador_id, $servicio_id);
                } else {
                    return array(0, 0);
                }
            }

            //---


        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }


    }


}