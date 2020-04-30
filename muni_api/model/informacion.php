<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 04/12/19
 * Time: 10:57 PM
 */
require_once '../datos/conexion.php';
class informacion extends conexion
{
    private $id;
    private $titulo;
    private $descripcion;
    private $imagen;
    private $rol_id;

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
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
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

    public function create()
    {
        try {


            $sql = "INSERT INTO informacion (titulo, descripcion, imagen,rol_id) 
                  values (:p_titulo, :p_des, :p_imagen,:p_rol_id) ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_titulo", $this->titulo);
            $sentencia->bindParam(":p_des", $this->descripcion);
            $sentencia->bindParam(":p_imagen", $this->imagen);
            $sentencia->bindParam(":p_rol_id", $this->rol_id);
            $sentencia->execute();

            return true;


        } catch (Exception $ex) {
            throw $ex;
        }


    }

    public function lista()
    {
        try {

            $sql = "SELECT * from informacion";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }


    }

    public function lista_por_rol($persona_id)
    {
        try {

            $sql = "SELECT rol_id from persona where id = :p_persona_id";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_persona_id", $persona_id);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            if ($sentencia->rowCount()) {
                $rol_id = $resultado['rol_id'];

                $sql = "SELECT * from informacion where rol_id = :p_rol_id";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_rol_id", $rol_id);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

                return $resultado;
            }




        } catch (Exception $ex) {
            throw $ex;
        }


    }


    public function update()
    {

        try {
            if($this->imagen){
                $this->dblink->beginTransaction();
                $sql = "update informacion set 
                    titulo = :p_titulo, 
                    descripcion = :p_descripcion,                  
                    imagen = :p_imagen,
                    rol_id = :p_rol_id
                    where id = :p_id ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_titulo", $this->titulo);
                $sentencia->bindParam(":p_descripcion", $this->descripcion);
                $sentencia->bindParam(":p_imagen", $this->imagen);
                $sentencia->bindParam(":p_rol_id", $this->rol_id);
                $sentencia->bindParam(":p_id", $this->id);
            }else{
                $this->dblink->beginTransaction();
                $sql = "update informacion set 
                    titulo = :p_titulo, 
                    descripcion = :p_descripcion,                  
                    rol_id = :p_rol_id
                    where id = :p_id ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_titulo", $this->titulo);
                $sentencia->bindParam(":p_descripcion", $this->descripcion);
                $sentencia->bindParam(":p_rol_id", $this->rol_id);
                $sentencia->bindParam(":p_id", $this->id);
            }


            $sentencia->execute();
            $this->dblink->commit();

            return true;

        } catch (Exception $ex) {
            throw $ex;


        }
    }

    function read(){
        try {

            $sql = "SELECT * from informacion where id = :p_id";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id", $this->id);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

            return $resultado;

        } catch (Exception $ex) {
            throw $ex;
        }

    }

}