<?php

/**
 * Created by PhpStorm.
 * User: afro
 * Date: 20/04/17
 * Time: 9:07
 */

function PrevenirSQL($consultaBusqueda){
    $caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
    $caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
    return str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);
}

class Comentarios
{
    private $db;
    private $identificador;
    private $ids;
    private $names;
    private $texts;

    public function Inicializa($base, $id){
        $this->db = $base;
        $this->identificador = $id;
        $this->setId();
        $this->setNames();
        $this->setText();
    }

    private function setId(){
        $sql = "SELECT id FROM Comentario";
        $rs = $this->db->qwery($sql);

        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->conexion->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
            //printf ("%s (%s)\n", $arr[0], $arr[1]);
        }
        $this->ids = $arr;
    }

    private function setNames(){
        $sql = "SELECT nombre FROM Comentario";
        $rs = $this->db->qwery($sql);

        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->conexion->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
            //printf ("%s (%s)\n", $arr[0], $arr[1]);
        }
        $this->names = $arr;
    }

    private function setText(){
        $sql = "SELECT mensaje FROM Comentario";
        $rs = $this->db->qwery($sql);

        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->conexion->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
            //printf ("%s (%s)\n", $arr[0], $arr[1]);
        }
        $this->texts = $arr;
    }

    public function GetComent()
    {
            $sql = "SELECT * FROM Comentario WHERE id='$this->identificador'";
            $rs = $this->db->qwery($sql);

            if ($rs === false) {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->conexion->error, E_USER_ERROR);
            } else {
                $arr = $rs->fetch_all(MYSQLI_NUM);
                //printf ("%s (%s)\n", $arr[0], $arr[1]);
            }
            return $arr;
    }

    public function  GetComentName($id){
        $coment = $this->GetComent($id);
        echo $coment[$id][1];
    }

    public function  GetComentDate($id){
        $coment = $this->GetComent($id);
        echo $coment[$id][2];
    }

    public function  GetComentText($id){
        $coment = $this->GetComent($id);
        echo $coment[$id][3];
    }

    public function GetComentSize(){
        $sql="SELECT * FROM Comentario WHERE id='$this->identificador'";
        $rs=$this->db->qwery($sql);
        $numero_filas = $rs->num_rows;
        return $numero_filas;
    }

    public function Comenta($id, $nom, $date, $text){
        $tam = $this->GetComSize();
        PrevenirSQL($text);
        $sql="INSERT INTO Comentario (id, nombre, fecha, mensaje, orden) VALUES ('$id', '$nom', '$date', '$text', '$tam')";
        $rs = $this->db->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->conexion->error, E_USER_ERROR);
        }
    }

    public function BorraComentario($id, $nom, $date, $text, $orden){
        $sql="DELETE FROM  Comentario WHERE id=$id and  nombre='$nom' and fecha='$date' and mensaje='$text' and orden='$orden'";
        $rs = $this->db->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
    }

    public function GetName($id){
        return $this->names[$id][0];
    }

    public function GetIds($id){
        return $this->ids[$id][0];
    }

    public function GetText($id){
        return $this->texts[$id][0];
    }

    public function GetComSize(){
        $sql="SELECT * FROM Comentario";
        $rs=$this->db->qwery($sql);
        $numero_filas = $rs->num_rows;
        return $numero_filas;
    }

    public function GetComentNameOrden($ord){
        $sql = "SELECT nombre FROM Comentario WHERE orden='$ord'";
        $rs = $this->db->qwery($sql);

        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->conexion->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
            //printf ("%s (%s)\n", $arr[0], $arr[1]);
        }
        return $arr[0][0];
    }

    public function GetComentIDOrden($ord){
        $sql = "SELECT id FROM Comentario WHERE orden='$ord'";
        $rs = $this->db->qwery($sql);

        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->conexion->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
            //printf ("%s (%s)\n", $arr[0], $arr[1]);
        }
        return $arr[0][0];
    }

    public function GetComentTextOrden($ord){
        $sql = "SELECT mensaje FROM Comentario WHERE orden='$ord'";
        $rs = $this->db->qwery($sql);

        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->conexion->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
            //printf ("%s (%s)\n", $arr[0], $arr[1]);
        }
        return $arr[0][0];
    }

    public function GetComentDateOrden($ord){
        $sql = "SELECT fecha FROM Comentario WHERE orden='$ord'";
        $rs = $this->db->qwery($sql);

        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->conexion->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
            //printf ("%s (%s)\n", $arr[0], $arr[1]);
        }
        return $arr[0][0];
    }


    public function ModificaComentario($id, $men){
        $sql = "UPDATE Comentario SET mensaje='$men' WHERE orden=$id";
        $rs = $this->db->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
    }

    public function Marcapaginas(){
        $sql = "SELECT orden FROM Comentario ORDER BY orden DESC";
        $rs = $this->db->qwery($sql);
        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
        }
        return $arr[0][0];
    }

}
?>