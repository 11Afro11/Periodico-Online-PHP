<?php

/**
 * Created by PhpStorm.
 * User: afro
 * Date: 3/05/17
 * Time: 20:02
 */

function Prevenir($consultaBusqueda){
    $caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
    $caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
    return str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);
}

class Usuario
{
    private $bd;

    public function Inicia($data)
    {
        $this->bd = $data;
    }

    public function CompruebaUsuario($usuario, $pass){
        Prevenir($usuario);
        Prevenir($pass);
        $sql = "SELECT * FROM usuario WHERE nombre='$usuario'";
        $result = $this->bd->qwery($sql);
        $arr = $result->fetch_all(MYSQLI_NUM);
        $almacenada = $arr[0][3];
        $user_pass =  $pass;
        $salt = md5($user_pass);
        $pasword_encriptado = crypt($user_pass, $salt);
        $condicion = false;
        if($almacenada === $pasword_encriptado){
            $condicion =  true;
        }

        return $condicion;
    }

    public function AniadeUsuario($user, $pass, $corr){
        Prevenir($user);
        Prevenir($pass);
        Prevenir($corr);
        $i = $this->GetUsersSize();
        $sql="INSERT INTO usuario  VALUES ('$i', '$user', '$corr', '$pass')";
        $rs = $this->bd->qwery($sql);
        if($rs ===false){

        }
    }

    public function BuscaUsuario($user){
        Prevenir($user);
        $sql = "SELECT * FROM usuario WHERE nombre='$user'";
        $result = $this->bd->qwery($sql);
        $numero_filas = $result->num_rows;
        if($numero_filas > 0){
            return true;
        }
        return false;
    }

    public function EsJefe($user){
        Prevenir($user);
        $sql = "SELECT * FROM jefe WHERE nombre='$user'";
        $result = $this->bd->qwery($sql);
        $numero_filas = $result->num_rows;
        if($numero_filas > 0){
            return true;
        }
        return false;
    }

    public function EsRedactor($user){
        Prevenir($user);
        $sql = "SELECT * FROM redactor WHERE nombre='$user'";
        $result = $this->bd->qwery($sql);
        $numero_filas = $result->num_rows;
        if($numero_filas > 0){
            return true;
        }
        return false;
    }

    public function Redactores(){
        $sql = "SELECT id FROM redactor";
        $result = $this->bd->qwery($sql);
        if ($result === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->bd->error, E_USER_ERROR);
        } else {
            $arr = $result->fetch_all(MYSQLI_NUM);
        }
        return $arr[0];
    }

    public function Usuarios(){
        $sql = "SELECT id FROM usuario WHERE id NOT IN (SELECT id FROM redactor) AND id NOT IN (SELECT id FROM jefe)";
        $result = $this->bd->qwery($sql);
        if ($result === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->bd->error, E_USER_ERROR);
        } else {
            $arr = $result->fetch_all(MYSQLI_NUM);
        }
        return $arr[0];
    }

    public function UserGetNombre($id){
        $sql = "SELECT nombre FROM usuario WHERE id=$id";
        $result = $this->bd->qwery($sql);
        if ($result === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->bd->error, E_USER_ERROR);
        } else {
            $arr = $result->fetch_all(MYSQLI_NUM);
        }
        return $arr[0][0];
    }

    public function UserGetMail($id){
        $sql = "SELECT email FROM usuario WHERE id=$id";
        $result = $this->bd->qwery($sql);
        if ($result === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->bd->error, E_USER_ERROR);
        } else {
            $arr = $result->fetch_all(MYSQLI_NUM);
        }
        return $arr[0][0];
    }

    public function UserGetPass($id){
        $sql = "SELECT pass FROM usuario WHERE id=$id";
        $result = $this->bd->qwery($sql);
        if ($result === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->bd->error, E_USER_ERROR);
        } else {
            $arr = $result->fetch_all(MYSQLI_NUM);
        }
        return $arr[0][0];
    }

    public function GetRedactoresSize(){
        $sql="SELECT * FROM redactor";
        $rs=$this->bd->qwery($sql);
        $numero_filas = $rs->num_rows;
        return $numero_filas;
    }

    public function GetUsersSize(){
        $sql="SELECT id FROM usuario";
        $rs=$this->bd->qwery($sql);
        $numero_filas = $rs->num_rows;
        return $numero_filas;
    }

    public function BecomeRedactor($nom, $em, $pas, $i){

        $sql="INSERT INTO redactor VALUES('$nom', '$em', '$pas', '$i')";
        $rs = $this->bd->qwery($sql);
        if($rs ===false){

        }
    }
}