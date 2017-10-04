<?php

/**
 * Created by PhpStorm.
 * User: afro
 * Date: 14/05/17
 * Time: 12:22
 */
class Correccion
{
    private $dbT;
    public function Inicia($data)
    {
        $this->dbT = $data;
    }

    public function GetTexto($id)
    {
        $sql="SELECT texto FROM corrige WHERE id=$id";
        $rs = $this->dbT->qwery($sql);
        $arr = $rs->fetch_all(MYSQLI_NUM);

        return $arr[0][0];
    }

    public function AsignaCorreccion($id, $text){
        $sql="INSERT INTO corrige (id, texto) VALUES ('$id', '$text')";
        $rs = $this->dbT->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->dbT->error, E_USER_ERROR);
        }
    }

    public function BorraCorreccion($id){
        $sql="DELETE FROM corrige WHERE id=$id";
        $rs = $this->dbT->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->dbT->error, E_USER_ERROR);
        }
    }

    public function BuscaCorreccion($id){
        $sql = "SELECT * FROM corrige WHERE id=$id";
        $result = $this->dbT->qwery($sql);
        $numero_filas = $result->num_rows;
        if($numero_filas > 0){
            return true;
        }
        return false;
    }
}