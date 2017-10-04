<?php

/**
 * Created by PhpStorm.
 * User: afro
 * Date: 25/04/17
 * Time: 16:29
 */
class Tematica
{
    private $dbT;
    public function Inicia($data)
    {
        $this->dbT = $data;
    }

    public function  GetTemas(){
        $sql = "SELECT * From tema";
        $rs = $this->dbT->qwery($sql);
        $arr = $rs->fetch_all();
        return $arr;
    }

    public function GetSpecificTheme($id)
    {
        $sql = "SELECT * FROM trata WHERE trata.id=$id";
        $rs = $this->dbT->qwery($sql);
        $arr = $rs->fetch_all(MYSQLI_NUM);

        return $arr[0][0];
    }

    public function AniadeTema($nombre){
        $id = $this->GetTemasSize();
        $sql="INSERT INTO tema VALUES ('$nombre', $id )";
        $rs = $this->dbT->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
    }

    public function BorraTema($id){
        $sql="DELETE FROM tema WHERE id=$id";
        $rs = $this->dbT->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
    }

    public function GetTemasSize(){
        $sql="SELECT * FROM tema";
        $rs=$this->dbT->qwery($sql);
        $numero_filas = $rs->num_rows;
        return $numero_filas;
    }

    public function AsignaTema($noticia, $tema){
        $nombre = $this->GetTema($tema);
        $sql="INSERT INTO trata (nombre, id, ident) VALUES ('$nombre', '$noticia', $tema)";
        $rs = $this->dbT->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->dbT->error, E_USER_ERROR);
        }
    }

    public function YaTrata($id){
        $sql = "SELECT * FROM trata WHERE id=$id";
        $result = $this->dbT->qwery($sql);
        $numero_filas = $result->num_rows;
        if($numero_filas > 0){
            return true;
        }
        return false;
    }
    public function GetTema($id)
    {
        $sql = "SELECT nombre FROM tema WHERE id=$id";
        $rs = $this->dbT->qwery($sql);
        $arr = $rs->fetch_all(MYSQLI_NUM);

        return $arr[0][0];
    }

    public function ModificaTema($id, $nom){
        $sql = "UPDATE tema SET nombre='$nom' WHERE id=$id";
        $rs = $this->dbT->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->dbT->error, E_USER_ERROR);
        }
    }

    public function GetId($nom){
        $sql = "SELECT id from tema WHERE nombre='$nom'";
        $rs = $this->dbT->qwery($sql);
        $arr = $rs->fetch_all(MYSQLI_NUM);

        return $arr[0][0];
    }
}