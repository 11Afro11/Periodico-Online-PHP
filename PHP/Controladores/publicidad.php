<?php

/**
 * Created by PhpStorm.
 * User: afro
 * Date: 16/05/17
 * Time: 8:58
 */
class Publicidad
{
    private $db;
    public function ItsPubli($data)
    {
        $this->db = $data;
        $sql = "SELECT * FROM Anuncio";
        $rs = $this->db->qwery($sql);

        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->conexion->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
            //printf ("%s (%s)\n", $arr[0], $arr[1]);
        }
        return $arr;
    }

    public function GetPubliSize(){
        $sql="SELECT * FROM Anuncio";
        $rs=$this->db->qwery($sql);
        $numero_filas = $rs->num_rows;
        return $numero_filas;
    }

    public function GetPubliName($id)
    {
        $sql="SELECT nombre FROM Anuncio WHERE id=$id";
        $rs = $this->db->qwery($sql);
        $arr = $rs->fetch_all(MYSQLI_NUM);

        return $arr[0][0];
    }

    public function GetPubliSrc($id)
    {
        $sql="SELECT enlace FROM Anuncio WHERE id=$id";
        $rs = $this->db->qwery($sql);
        $arr = $rs->fetch_all(MYSQLI_NUM);

        return $arr[0][0];
    }

    public function GetPubliImg($id){
        $sql="SELECT Imagen FROM Anuncio WHERE id=$id";
        $rs = $this->db->qwery($sql);
        $arr = $rs->fetch_all(MYSQLI_NUM);

        echo $arr[0][0];
    }

    public function GetPubliClk($id)
    {
        $sql="SELECT clicks FROM Anuncio WHERE id=$id";
        $rs = $this->db->qwery($sql);
        $arr = $rs->fetch_all(MYSQLI_NUM);

        return $arr[0][0];
    }

    public function BorraPublicidad($id){
        $sql="DELETE FROM  Anuncio WHERE id=$id";
        $rs = $this->db->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
    }


    public function AniadePublicidad($nombre, $url, $img){
        $id = $this->GetPubliSize();
        $sql="INSERT INTO Anuncio VALUES ('$id', 0, '$nombre', '$url', '$img')";
        $rs = $this->db->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
    }

    public function AddClick($id){
        $current = $this->GetPubliClk($id);
        $current = $current+1;
        $sql = "UPDATE Anuncio SET clicks=$current WHERE id='$id'";
        $rs = $this->db->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
    }

    public function AddPubli(){
        $sql = "INSERT INTO Add(id, clicks, nombre, enlace, imagen) VALUES (0, 50, InstantGaming, 'https://www.instant-gaming.com/fr/?gclid=EAIaIQobChMI_LvHmenZ1QIVzJPtCh0WzgEsEAAYASAAEgJeBPD_BwE', 'https://3.bp.blogspot.com/-WD_S5FGjaRQ/Vufu4bW7lxI/AAAAAAAAJo0/bNPOAYYtkdUEq4lk8iBBlIUCiIT_DhPXw/s640/instantgaming.jpg')";
    }

    public function ModificaNombre($id, $nom){
        $sql = "UPDATE Anuncio SET nombre='$nom' WHERE id=$id";
        $rs = $this->db->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->dbT->error, E_USER_ERROR);
        }
    }

    public function ModificaEnlace($id, $nom){
        $sql = "UPDATE Anuncio SET enlace='$nom' WHERE id=$id";
        $rs = $this->db->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->dbT->error, E_USER_ERROR);
        }
    }

}