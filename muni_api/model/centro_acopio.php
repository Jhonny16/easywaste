<?php

require_once '../datos/conexion.php';
class centro_acopio extends conexion
{
    private $id;
    private $nombre;
    private $direccion;
    private $tipo;

    private $numero_sectores;

    /**
     * @return mixed
     */
    public function getNumeroSectores()
    {
        return $this->numero_sectores;
    }

    /**
     * @param mixed $numero_sectores
     */
    public function setNumeroSectores($numero_sectores)
    {
        $this->numero_sectores = $numero_sectores;
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
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function lista(){
        try {

            $sql = "SELECT * from centro_acopio where tipo = 'Temporal'";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function lista_acopio_final(){
        try {

            $sql = "SELECT * from centro_acopio where tipo = 'Final'";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function create()
    {
        try {


            $sql = "INSERT INTO centro_acopio (nombre, direccion, tipo,numero_sectores) 
                  values (:p_nombre, :p_direccion, :p_tipo, :p_numero_sectores) ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_nombre", $this->nombre);
            $sentencia->bindParam(":p_direccion", $this->direccion);
            $sentencia->bindParam(":p_tipo", $this->tipo);
            $sentencia->bindParam(":p_numero_sectores", $this->numero_sectores);
            $sentencia->execute();

            $sql = "select id from centro_acopio order by id desc limit 1 ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

            if ($sentencia->rowCount()) {
                $ca_id = $resultado['id'];

                for($i=1; $i<=($this->numero_sectores); $i++){
                    $name = 'Sector-' . $i;

                    $sql = "INSERT INTO sector (nombre, acopio_temporal_id) 
                  values (:p_nombre, :p_ca_temporal_id) ";

                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_nombre", $name);
                    $sentencia->bindParam(":p_ca_temporal_id", $ca_id);
                    $sentencia->execute();
                }
            }

            return true;


        } catch (Exception $ex) {
            throw $ex;
        }


    }

    public function list_all()
    {
        try {

            $sql = "SELECT id,nombre,direccion,tipo,coalesce(numero_sectores,0) as numero_sectores from centro_acopio";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }


    }

    public function update(){


        try {
            $this->dblink->beginTransaction();
            $sql = "update centro_acopio set nombre = :p_nombre, direccion = :p_direccion, tipo = :p_tipo, numero_sectores = :p_numero_sectores
                    where id = :p_id ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_nombre", $this->nombre);
            $sentencia->bindParam(":p_direccion", $this->direccion);
            $sentencia->bindParam(":p_tipo", $this->tipo);
            $sentencia->bindParam(":p_numero_sectores", $this->numero_sectores);
            $sentencia->bindParam(":p_id", $this->id);
            $sentencia->execute();
            $this->dblink->commit();

            $sql = "delete from sector where acopio_temporal_id= :p_id";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id", $this->id);
            $sentencia->execute();

            for($i=1; $i<=$this->numero_sectores; $i++){
                $name = 'Sector-' . $i;

                $sql = "INSERT INTO sector (nombre, acopio_temporal_id) 
                  values (:p_nombre, :p_ca_temporal_id) ";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_nombre", $name);
                $sentencia->bindParam(":p_ca_temporal_id", $this->id);
                $sentencia->execute();
            }

            return true;

        }catch (Exception $ex) {
            throw $ex;
        }
    }

    function read(){
        try {

            $sql = "SELECT id,nombre,direccion,tipo,coalesce(numero_sectores,0) as numero_sectores  from centro_acopio where id = :p_id";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id", $this->id);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }

    }


    function read_sector(){
        try {

            $sql = "SELECT * from sector where acopio_temporal_id = :p_id";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id", $this->id);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }

    }





}