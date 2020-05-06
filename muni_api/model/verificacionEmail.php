<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 05/05/20
 * Time: 01:41 PM
 */

require_once '../datos/conexion.php';
class verificacionEmail  extends conexion
{

    private $id;
    private $gmail;
    private $codigo;
    private $proveedor_id;

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
    public function getGmail()
    {
        return $this->gmail;
    }

    /**
     * @param mixed $gmail
     */
    public function setGmail($gmail)
    {
        $this->gmail = $gmail;
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

    public function create()
    {
        try {

            //codfifiacion para autogenerar un code

            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

            function generate_string($input, $strength = 16) {
                $input_length = strlen($input);
                $random_string = '';
                for($i = 0; $i < $strength; $i++) {
                    $random_character = $input[mt_rand(0, $input_length - 1)];
                    $random_string .= $random_character;
                }

                return $random_string;
            }

            $new_code = generate_string($permitted_chars, 6);



            $sql = "INSERT INTO verificacion_mail (gmail, codigo, proveedor_id)
                  values (:p_gmail, :p_codigo, :p_proveedor_id) ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_gmail", $this->gmail);
            $sentencia->bindParam(":p_codigo", $new_code);
            $sentencia->bindParam(":p_proveedor_id", $this->proveedor_id);
            $sentencia->execute();

            return $new_code;


        } catch (Exception $ex) {
            throw $ex;
        }


    }


    public function search_codigo_verificacion()
    {

        try {

            $sql = "select
                *
                from verificacion_mail
                where proveedor_id = :proveedor_id and codigo = :p_codigo";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":proveedor_id", $this->proveedor_id);
            $sentencia->bindParam(":p_codigo", $this->codigo);
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            if ($sentencia->rowCount()) {
                $res = $this->update_estado_proveedor($this->proveedor_id);
                if($res){
                    return 1;
                }else{
                    return -1;
                }

            }else{
                return 0;
            }

        }catch (Exception $ex) {
            throw $ex;
        }


    }

    public function update_estado_proveedor($proveedor_id){

        $this->dblink->beginTransaction();
        try {
            $sql = "update persona set estado = 'A' where id = :p_proveedor_id ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_proveedor_id", $proveedor_id);
            $sentencia->execute();
            $this->dblink->commit();

            return true;

        }catch (Exception $ex) {
            throw $ex;
        }
    }


}