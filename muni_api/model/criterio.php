<?php


require_once '../datos/conexion.php';

class criterio extends conexion
{

    private $id;
    private $valor;
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




    private $group;

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param mixed $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
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
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param mixed $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }


    public function criterios_lista()
    {

        try {
            $sql = "select * from criterio";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function update()
    {
        $this->dblink->beginTransaction();

        try {

            $datos = $this->group;

            for ($i = 0; $i < count($datos); $i++) {
                $sql = "update criterio set valor = :p_valor, user_name = :p_user_name where id = :p_id";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_valor", $datos[$i]->valor);
                $sentencia->bindParam(":p_id", $datos[$i]->criterio_id);
                $sentencia->bindParam(":p_user_name", $this->user_name);
                $sentencia->execute();
            }

            $this->dblink->commit();

            $this->insert_code();


            return true;
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }


    }

    public function insert_code()
    {

        try {

            //GENERACION DE CODIGO
            $n=6;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomString = '';

                for ($i = 0; $i < $n; $i++) {
                    $index = rand(0, strlen($characters) - 1);
                    $randomString .= $characters[$index];
                }

            $value = $randomString;

            //FIN

            $sql = "insert into code (numero, fecha_creacion) values (:p_valor, current_date)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_valor", $value);
            $sentencia->execute();

            return true;

        } catch (Exception $exc) {
            throw $exc;
        }


    }

    public function historial($f_inicio, $f_fin)
    {
        $sql = "select * from bitacora.criterio
                where date(fecha_hora) between :p_fecha_inicio and :p_fecha_fin order by secuencia asc ";
        $sentencia = $this->dblink->prepare($sql);
        $sentencia->bindParam(":p_fecha_inicio", $f_inicio);
        $sentencia->bindParam(":p_fecha_fin", $f_fin);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll();
        return $resultado;
    }

}

