<?php

require_once '../datos/conexion.php';

class persona extends conexion
{

    private $id;
    private $dni;
    private $ap_paterno;
    private $ap_materno;
    private $nombres;
    private $sexo;
    private $fn;
    private $celular;
    private $direccion;
    private $correo;
    private $estado;
    private $zona_id;
    private $rol_id;
    private $codigo;
    private $fecha_registro;
    private $clave;

    private $status;

    /**
     * @return mixed
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * @param mixed $clave
     */
    public function setClave($clave)
    {
        $this->clave = $clave;
    }


    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
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
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param mixed $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    /**
     * @return mixed
     */
    public function getApPaterno()
    {
        return $this->ap_paterno;
    }

    /**
     * @param mixed $ap_paterno
     */
    public function setApPaterno($ap_paterno)
    {
        $this->ap_paterno = $ap_paterno;
    }

    /**
     * @return mixed
     */
    public function getApMaterno()
    {
        return $this->ap_materno;
    }

    /**
     * @param mixed $ap_materno
     */
    public function setApMaterno($ap_materno)
    {
        $this->ap_materno = $ap_materno;
    }

    /**
     * @return mixed
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * @param mixed $nombres
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }

    /**
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param mixed $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * @return mixed
     */
    public function getFn()
    {
        return $this->fn;
    }

    /**
     * @param mixed $fn
     */
    public function setFn($fn)
    {
        $this->fn = $fn;
    }

    /**
     * @return mixed
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * @param mixed $celular
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @param mixed $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
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
    public function getZonaId()
    {
        return $this->zona_id;
    }

    /**
     * @param mixed $zona_id
     */
    public function setZonaId($zona_id)
    {
        $this->zona_id = $zona_id;
    }

    /**
     * @return mixed
     */
    public function getRolId()
    {
        return $this->rol_id;
    }

    /**
     * @param mixed $rol_id
     */
    public function setRolId($rol_id)
    {
        $this->rol_id = $rol_id;
    }


    public function create()
    {

        try {

            if ($this->rol_id == 2) {
                $sql = "select secuencia from correlativo where tabla = 'persona_reciclador' ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                $secuencia = $resultado["secuencia"];
                $secuencia = $secuencia + 1;
                $pad = 5;
//                if (strlen($secuencia) == 1) {
//                    $pad = 5;
//                } else {
//                    if (strlen($secuencia) == 2) {
//                        $pad = 4;
//                    } else {
//                        if (strlen($secuencia) == 3) {
//                            $pad = 3;
//                        } else {
//                            if (strlen($secuencia) == 4) {
//                                $pad = 2;
//                            } else {
//                                if (strlen($secuencia) == 5) {
//                                    $pad = 1;
//                                }
//                            }
//                        }
//                    }
//                }
                $correlativo = str_pad($secuencia, $pad, "0", STR_PAD_LEFT);
                $numeracion = "RC-" . $correlativo;
                $this->setCodigo($numeracion);
            } else {
                $this->setCodigo(null);
            }

            $sql = "insert into persona (dni,nombres,ap_paterno,ap_materno,sexo,fecha_nac,celular,direccion,
                      correo,estado,zona_id,rol_id,codigo,fecha_registro)
                    values (:p_dni, :p_nombres ,:p_ap_paterno, :p_ap_materno, :p_sexo, :p_fn, :p_celular, :p_direccion,
                    :p_correo,:p_estado,:p_zona, :p_rol, :p_codigo, :p_fecha_registro); ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_dni", $this->dni);
            $sentencia->bindParam(":p_nombres", $this->nombres);
            $sentencia->bindParam(":p_ap_paterno", $this->ap_paterno);
            $sentencia->bindParam(":p_ap_materno", $this->ap_materno);
            $sentencia->bindParam(":p_sexo", $this->sexo);
            $sentencia->bindParam(":p_fn", $this->fn);
            $sentencia->bindParam(":p_celular", $this->celular);
            $sentencia->bindParam(":p_direccion", $this->direccion);
            $sentencia->bindParam(":p_correo", $this->correo);
            $sentencia->bindParam(":p_estado", $this->estado);
            $sentencia->bindParam(":p_zona", $this->zona_id);
            $sentencia->bindParam(":p_rol", $this->rol_id);
            $sentencia->bindParam(":p_codigo", $this->codigo);
            $sentencia->bindParam(":p_fecha_registro", $this->fecha_registro);
            $sentencia->execute();

            if ($this->rol_id == 2) {
                $this->dblink->beginTransaction();

                $sql = "update correlativo set secuencia = :p_secuencia where tabla = 'persona_reciclador' ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_secuencia", $secuencia);
                $sentencia->execute();
                $this->dblink->commit();

            }

            $sql = "SELECT id FROM persona order by 1 desc limit 1";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();

            $persona_id = 0;
            if ($sentencia->rowCount()) {
                $persona_id = $resultado["id"];
                return $persona_id;
            }else{
                return $persona_id;
            }





//            if ($this->rol_id == 3) {
//                $sql = "select id from persona order by id desc limit 1";
//                $sentencia = $this->dblink->prepare($sql);
//                $sentencia->execute();
//                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
//                if ($sentencia->rowCount()) {
//                    $pintrash = 0;
//                    $sql = "insert into pintrash (pintrash, persona_id)
//                        values (:p_pintrash,:p_persona_id)";
//                    $sentencia = $this->dblink->prepare($sql);
//                    $sentencia->bindParam(":p_pintrash", $pintrash);
//                    $sentencia->bindParam(":p_persona_id", $resultado['id']);
//                    $sentencia->execute();
//                }
//            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function read()
    {

        try {
            $sql = "select p.*,
                           (case
                             when p.rol_id = 2 then (case when (select estado from persona where dni = p.dni and rol_id = 3)='A' then true else false end)
                             when p.rol_id = 3 then (case when (select estado from persona where dni = p.dni and rol_id = 2)='A' then true else false end)
                             else FALSE
                             end) as other_rol
                     from persona p where id  = :p_persona_id";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_persona_id", $this->id);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    public function update_other($rol_id)
    {

        try {
            $sql = "select id from persona where dni = :p_dni and rol_id = :p_rol_id ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_dni", $this->dni);
            $sentencia->bindParam(":p_rol_id", $rol_id);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

            if ($sentencia->rowCount()) {
                if($resultado['id']){

                    $this->dblink->beginTransaction();

                    try {
                        $sql = "update persona set 
                    nombres = :p_nombres,
                    ap_materno = :p_mateno,
                    ap_paterno = :p_paterno,
                    sexo = :p_sexo,
                    fecha_nac = :p_fc,
                    celular = :p_celular,
                    direccion = :p_direccion,
                    correo = :p_correo,
                    estado = :p_estado,
                    zona_id = :p_zona                                        
                    where dni = :p_dni ";
                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->bindParam(":p_dni", $this->dni);
                        $sentencia->bindParam(":p_nombres", $this->nombres);
                        $sentencia->bindParam(":p_mateno", $this->ap_materno);
                        $sentencia->bindParam(":p_paterno", $this->ap_paterno);
                        $sentencia->bindParam(":p_sexo", $this->sexo);
                        $sentencia->bindParam(":p_fc", $this->fn);
                        $sentencia->bindParam(":p_celular", $this->celular);
                        $sentencia->bindParam(":p_direccion", $this->direccion);
                        $sentencia->bindParam(":p_correo", $this->correo);
                        $sentencia->bindParam(":p_estado", $this->estado);
                        $sentencia->bindParam(":p_zona", $this->zona_id);
                        $sentencia->execute();
                        $this->dblink->commit();
                        return true;
                    } catch (Exception $exc) {
                        $this->dblink->rollBack();
                        throw $exc;
                    }

                }else{
                    $this->create();
                }
            }else{
                $this->create();

            }



        } catch (Exception $exc) {
            throw $exc;
        }
    }


    public function update()
    {
        $this->dblink->beginTransaction();

        try {

            $sql = "update persona set 
                    dni = :p_dni,
                    nombres = :p_nombres,
                    ap_materno = :p_mateno,
                    ap_paterno = :p_paterno,
                    sexo = :p_sexo,
                    fecha_nac = :p_fc,
                    celular = :p_celular,
                    direccion = :p_direccion,
                    correo = :p_correo,
                    estado = :p_estado,
                    zona_id = :p_zona                                        
                    where id = :p_persona_id ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_dni", $this->dni);
            $sentencia->bindParam(":p_nombres", $this->nombres);
            $sentencia->bindParam(":p_mateno", $this->ap_materno);
            $sentencia->bindParam(":p_paterno", $this->ap_paterno);
            $sentencia->bindParam(":p_sexo", $this->sexo);
            $sentencia->bindParam(":p_fc", $this->fn);
            $sentencia->bindParam(":p_celular", $this->celular);
            $sentencia->bindParam(":p_direccion", $this->direccion);
            $sentencia->bindParam(":p_correo", $this->correo);
            $sentencia->bindParam(":p_estado", $this->estado);
            $sentencia->bindParam(":p_zona", $this->zona_id);
            $sentencia->bindParam(":p_persona_id", $this->id);

            $sentencia->execute();
            $this->dblink->commit();
            return true;

        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
    }

    public function reciclador_lista_all()
    {

        try {
            $sql = "select p.*, z.nombre as zona from persona p inner join zona z on p.zona_id = z.id where p.rol_id = 2  ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function reciclador_lista()
    {

        try {
            $sql = "select p.*, z.nombre as zona from persona p inner join zona z on p.zona_id = z.id where p.rol_id = 2 
                    and p.estado = 'A' ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function proveedor_lista()
    {

        try {
            $sql = "select p.*, z.nombre as zona from persona p inner join zona z on p.zona_id = z.id where p.rol_id = 3 ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function update_perfil($cambio)
    {
        $this->dblink->beginTransaction();

        try {

            if ($cambio == 1) {
                $clave = password_hash($this->clave, PASSWORD_DEFAULT);

                $sql = "update persona set 
                    dni = :p_dni,
                    nombres = :p_nombres,
                    ap_materno = :p_mateno,
                    ap_paterno = :p_paterno,
                    sexo = :p_sexo,
                    fecha_nac = :p_fc,
                    celular = :p_celular,
                    direccion = :p_direccion,
                    correo = :p_correo,
                    password = :p_password
                    where id = :p_persona_id ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_dni", $this->dni);
                $sentencia->bindParam(":p_nombres", $this->nombres);
                $sentencia->bindParam(":p_mateno", $this->ap_materno);
                $sentencia->bindParam(":p_paterno", $this->ap_paterno);
                $sentencia->bindParam(":p_sexo", $this->sexo);
                $sentencia->bindParam(":p_fc", $this->fn);
                $sentencia->bindParam(":p_celular", $this->celular);
                $sentencia->bindParam(":p_direccion", $this->direccion);
                $sentencia->bindParam(":p_correo", $this->correo);
                $sentencia->bindParam(":p_password", $clave);
                $sentencia->bindParam(":p_persona_id", $this->id);

            } else {

                $sql = "update persona set 
                    dni = :p_dni,
                    nombres = :p_nombres,
                    ap_materno = :p_mateno,
                    ap_paterno = :p_paterno,
                    sexo = :p_sexo,
                    fecha_nac = :p_fc,
                    celular = :p_celular,
                    direccion = :p_direccion,
                    correo = :p_correo
                    where id = :p_persona_id ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_dni", $this->dni);
                $sentencia->bindParam(":p_nombres", $this->nombres);
                $sentencia->bindParam(":p_mateno", $this->ap_materno);
                $sentencia->bindParam(":p_paterno", $this->ap_paterno);
                $sentencia->bindParam(":p_sexo", $this->sexo);
                $sentencia->bindParam(":p_fc", $this->fn);
                $sentencia->bindParam(":p_celular", $this->celular);
                $sentencia->bindParam(":p_direccion", $this->direccion);
                $sentencia->bindParam(":p_correo", $this->correo);
                $sentencia->bindParam(":p_persona_id", $this->id);

            }

            $sentencia->execute();
            $this->dblink->commit();
            return true;

        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }


    }

    public function proveedores_pintrash()
    {
        try {
            $sql = "select  p2.id, p2.dni, p2.ap_paterno || ' '|| p2.ap_materno ||' '|| p2.nombres as proveedor
                         ,sum(p.pintrash) -
                          coalesce((select sum(pintrash_total) from canje where persona_id = p2.id),0)
                           as pintrash
                    
                         --,p.pintrash
                    from pintrash p inner join servicio s on p.servicio_id = s.id inner join persona p2 on s.proveedor_id = p2.id
                    --inner join canje c on p2.id = c.persona_id
                    group by  p2.id, p2.dni, p2.ap_paterno || ' '|| p2.ap_materno ||' '|| p2.nombres;
                    ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function posicion_recicladores()
    {

        try {
            $sql = "select
                           pe.id,
                           pe.ap_paterno || ' ' || pe.ap_materno || ' '|| pe.nombres as reciclador_name,
                      coalesce((select latitud from posicion_actual where reciclador_id = pe.id order by id desc limit 1),'') as lat,
                      coalesce((select longitud from posicion_actual where reciclador_id = pe.id order by id desc limit 1),'') as lng,
                     (select name_status from status where reciclador_id = pe.id
                      order by id desc limit 1) as name_status,
                      pe.valor
                    from persona pe
                    where rol_id = 2
                    group by pe.id
                    having (select name_status from status where reciclador_id = pe.id
                            order by id desc limit 1) = 'Disponible'; ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

/*
    public function comprobar_email($email){
        $mail_correcto = 0;
        //compruebo unas cosas primeras
        if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){
            if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {
                //miro si tiene caracter .
                if (substr_count($email,".")>= 1){
                    //obtengo la terminacion del dominio
                    $term_dom = substr(strrchr ($email, '.'),1);
                    //compruebo que la terminación del dominio sea correcta
                    if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
                        //compruebo que lo de antes del dominio sea correcto
                        $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
                        $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
                        if ($caracter_ult != "@" && $caracter_ult != "."){
                            $mail_correcto = 1;
                        }
                    }
                }
            }
        }
        if ($mail_correcto)
            return 1;
        else
            return 0;
    }*/

    public function comprobar_email($correo) {
        return (filter_var($correo, FILTER_VALIDATE_EMAIL)) ? 1 : 0;
    }


    public function historial($f_inicio, $f_fin)
    {
        $sql = "select bp.* from bitacora.persona bp
                inner join public.persona pp on bp.dni = pp.dni
                where pp.rol_id = 2 and date(bp.fecha_hora) between :p_fecha_inicio and :p_fecha_fin ";
        $sentencia = $this->dblink->prepare($sql);
        $sentencia->bindParam(":p_fecha_inicio", $f_inicio);
        $sentencia->bindParam(":p_fecha_fin", $f_fin);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll();
        return $resultado;
    }

    public function posicion_recicladores_reasignacion($reciclador_id)
    {

        try {
            $sql = "select
                           pe.id,
                           pe.ap_paterno || ' ' || pe.ap_materno || ' '|| pe.nombres as reciclador_name,
                      coalesce((select latitud from posicion_actual where reciclador_id = pe.id order by id desc limit 1),'') as lat,
                      coalesce((select longitud from posicion_actual where reciclador_id = pe.id order by id desc limit 1),'') as lng,
                     (select name_status from status where reciclador_id = pe.id
                      order by id desc limit 1) as name_status,
                      pe.valor
                    from persona pe
                    where rol_id = 2 and pe.id != :p_reciclador_id 
                    group by pe.id
                    having (select name_status from status where reciclador_id = pe.id
                            order by id desc limit 1) = 'Disponible'; ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_reciclador_id", $reciclador_id);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $ex) {
            throw $ex;
        }
    }




}