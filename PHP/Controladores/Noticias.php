<meta charset="utf-8">
<?php

/**
 * Created by PhpStorm.
 * User: afro
 * Date: 20/04/17
 * Time: 8:59
 */


class Noticias
{
    private $db;

    //Inicia las noticias

    public function ItsNoticias($data)
    {
        $this->db = $data;
        $sql = "SELECT * FROM noticiaRedactada";
        $rs = $this->db->qwery($sql);

        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->conexion->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
            //printf ("%s (%s)\n", $arr[0], $arr[1]);
        }
        return $arr;
    }

    //devuelve un nombre con un identificador
    public function  GetNoticeName($id){
        $coment = $this->GetNoticia($id);
        echo $coment[0][$id];
    }

    //devuelve una noticia con un identificador
    public function GetNoticia($id)
    {
        $sql="SELECT cuerpo FROM noticiaRedactada WHERE id='$id' ";
        $rs = $this->db->qwery($sql);
        $arr = $rs->fetch_all(MYSQLI_NUM);

        echo $arr[0][0];
    }

    //devuelve el eutor con el identificador
    public function GetNoticiaAuthor($id){
        $sql="SELECT nombre FROM noticiaRedactada WHERE id='$id' ";
        $rs = $this->db->qwery($sql);
        $arr = $rs->fetch_all(MYSQLI_NUM);

        return $arr[0][0];
    }


    public function GetNoticiaTitle($id)
    {
        $sql="SELECT Titulo1 FROM noticiaRedactada WHERE id=$id";
        $rs = $this->db->qwery($sql);
        $arr = $rs->fetch_all(MYSQLI_NUM);

        echo $arr[0][0];
    }

    public function GetNoticiaImg($id)
    {
        $sql="SELECT imagen FROM noticiaRedactada WHERE id=$id";
        $rs = $this->db->qwery($sql);
        $arr = $rs->fetch_all(MYSQLI_NUM);

        echo $arr[0][0];
    }

    public function GetNoticiaByTag($Tag)
    {
        $sql="SELECT * FROM noticiaRedactada WHERE id = ANY (SELECT id FROM trata WHERE ident='$Tag') and publicado=1 and id NOT in (SELECT noticia FROM NoticiasDestacadas)";
        $rs = $this->db->qwery($sql);
        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
        }
        return $arr;
    }

    public function GetNoticiasByTagSize($tag){
        $sql="SELECT * FROM noticiaRedactada WHERE id = ANY (SELECT id FROM trata WHERE ident='$tag') and publicado=1 and id NOT in (SELECT noticia FROM NoticiasDestacadas)";
        $rs = $this->db->qwery($sql);
        $numero_filas = $rs->num_rows;
        return $numero_filas;
    }

    public function GetNoticiaByTagLess($Tag, $ignore)
    {
        $sql="SELECT * FROM noticiaRedactada WHERE id = ANY (SELECT id FROM trata WHERE ident='$Tag') and id <> $ignore and publicado=1 and id NOT in (SELECT noticia FROM NoticiasDestacadas)";
        $rs = $this->db->qwery($sql);
        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->conexion->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
        }
        return $arr;
    }

    public function GetNoticiasSize(){
        $sql="SELECT * FROM noticiaRedactada";
        $rs=$this->db->qwery($sql);
        $numero_filas = $rs->num_rows;
        return $numero_filas;
    }

    public function GetNoticiasSizeByTagLess($Tag, $ignore){
        $sql="SELECT * FROM noticiaRedactada WHERE id = ANY (SELECT id FROM trata WHERE ident='$Tag') and id <> $ignore and id NOT in (SELECT noticia FROM NoticiasDestacadas)";
        $rs=$this->db->qwery($sql);
        $numero_filas = $rs->num_rows;
        return $numero_filas;
    }

    public function desconectar()
    {
        $this->db->desconectar();

    }

    public function GetNoticiaBody($id)
    {
        $sql="SELECT cuerpo FROM noticiaRedactada WHERE id='$id' ";
        $rs = $this->db->qwery($sql);
        $arr = $rs->fetch_all(MYSQLI_NUM);


        echo $arr[0][0];
    }

    public function AniadeNoticiaEnEdicion($id, $nombre,  $title, $cuerpo, $imagen){
        $sql="INSERT INTO noticiaRedactada (id, nombre, titulo1, titulo2, cuerpo, publicado, revisado, imagen, esPortada, enEdicion, correccion) VALUES ('$id', '$nombre', '$title', '$title', '$cuerpo', '0', '0', '$imagen', '0', '1','0')";
        $rs = $this->db->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
    }

    public function SendNotice($id){
        $sql = "UPDATE noticiaRedactada SET enEdicion=0 & revisado=1 WHERE id=$id";
        $rs = $this->db->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
        $sql2 = "UPDATE noticiaRedactada SET revisado=1 WHERE id=$id";
        $rs2 = $this->db->qwery($sql2);
        if($rs2 ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
        $sql2 = "UPDATE noticiaRedactada SET correccion=1 WHERE id=$id";
        $rs2 = $this->db->qwery($sql2);
        if($rs2 ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
    }

    public function ModificaNoticia($cuer, $id){
        $sql = "UPDATE noticiaRedactada SET cuerpo='$cuer' WHERE id='$id'";
        $rs = $this->db->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
    }
    public function ModificaImagen($img, $id){
        $sql = "UPDATE noticiaRedactada SET imagen='$img' WHERE id='$id'";
        $rs = $this->db->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
    }
    public function PublicaNoticia($id){
        $sql = "UPDATE noticiaRedactada SET publicado=1 WHERE id='$id'";
        $rs = $this->db->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
        $sql2 = "UPDATE noticiaRedactada SET correccion=0 WHERE id='$id'";
        $rs = $this->db->qwery($sql2);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql2 . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
        $sql3 = "UPDATE noticiaRedactada SET revisado=0 WHERE id='$id'";
        $rs = $this->db->qwery($sql3);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql3 . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
        $sql3 = "UPDATE noticiaRedactada SET enEdicion=0 WHERE id='$id'";
        $rs = $this->db->qwery($sql3);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql3 . ' Error: ' . $this->db->error, E_USER_ERROR);
        }


    }

    public function PublicaPortada($id){
        $sql = "UPDATE noticiaRedactada SET esPortada=1 WHERE id='$id'";
        $rs = $this->db->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
        $sql2 = "UPDATE noticiaRedactada SET correccion=0 WHERE id='$id'";
        $rs = $this->db->qwery($sql2);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql2 . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
        $sql3 = "UPDATE noticiaRedactada SET revisado=0 WHERE id='$id'";
        $rs = $this->db->qwery($sql3);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql3 . ' Error: ' . $this->db->error, E_USER_ERROR);
        }


    }

    public function CorrigeNoticia($id){
        $sql = "UPDATE noticiaRedactada SET publicado=0 WHERE id='$id'";
        $rs = $this->db->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
        $sql2 = "UPDATE noticiaRedactada SET correccion=1 WHERE id='$id'";
        $rs = $this->db->qwery($sql2);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql2 . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
        $sql3 = "UPDATE noticiaRedactada SET revisado=0 WHERE id='$id'";
        $rs = $this->db->qwery($sql3);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql3 . ' Error: ' . $this->db->error, E_USER_ERROR);
        }


    }

    public function BuscaNoticia($id){
        $sql = "SELECT * FROM noticiaRedactada WHERE id='$id'";
        $result = $this->db->qwery($sql);
        $numero_filas = $result->num_rows;
        if($numero_filas > 0){
            return true;
        }
        return false;
    }

    public function GetNoticiaPendiente()
    {
        $sql="SELECT * FROM noticiaRedactada WHERE revisado=1";
        $rs = $this->db->qwery($sql);
        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
        }
        return $arr;
    }

    public function GetNoticiasPendientesSize(){
        $sql="SELECT * FROM noticiaRedactada WHERE revisado=1";
        $rs=$this->db->qwery($sql);
        $numero_filas = $rs->num_rows;
        return $numero_filas;
    }


    public function GetNoticiasPublicadasSize(){
        $sql="SELECT * FROM noticiaRedactada WHERE publicado=1";
        $rs=$this->db->qwery($sql);
        $numero_filas = $rs->num_rows;
        return $numero_filas;
    }

    public function GetNoticiasPublicadasBy($name){
        $sql="SELECT * FROM noticiaRedactada WHERE publicado=1 and nombre='$name'";
        $rs = $this->db->qwery($sql);
        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
        }
        return $arr;
    }

    public function GetNoticiasPublicadasBySize($name){
        $sql="SELECT * FROM noticiaRedactada WHERE publicado=1 and nombre='$name'";
        $rs=$this->db->qwery($sql);
        $numero_filas = $rs->num_rows;
        return $numero_filas;
    }

    public function GetNoticiasACorregir($name){
        $sql="SELECT * FROM noticiaRedactada WHERE correccion=1 and nombre='$name'";
        $rs = $this->db->qwery($sql);
        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
        }
        return $arr;
    }

    public function GetNoticiasAcorregirSize($name){
        $sql="SELECT * FROM noticiaRedactada WHERE correccion=1 and nombre='$name'";
        $rs=$this->db->qwery($sql);
        $numero_filas = $rs->num_rows;
        return $numero_filas;
    }
    public function GetNoticiasAcorregirSizePresent(){
        $sql="SELECT * FROM noticiaRedactada WHERE correccion=1";
        $rs=$this->db->qwery($sql);
        $numero_filas = $rs->num_rows;
        return $numero_filas;
    }

    public function ModificaCorreccion($id){
        $sql = "UPDATE noticiaRedactada SET correccion=0 WHERE id='$id'";
        $rs = $this->db->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
    }

    public function EstaCorrigiendo($id){
        $sql = "SELECT * FROM noticiaRedactada WHERE correccion=1 and id=$id";
        $result = $this->db->qwery($sql);
        $numero_filas = $result->num_rows;
        if($numero_filas > 0){
            return true;
        }
        return false;
    }

    public function BorraNoticia($id){
        $sql="DELETE FROM  noticiaRedactada WHERE id=$id ";
        $rs = $this->db->qwery($sql);
        if($rs ===false){
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
    }

    public function GetNoticiasPhotos(){
        $sql="SELECT imagen FROM noticiaRedactada WHERE publicado=1";
        $rs = $this->db->qwery($sql);
        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
        }
        return $arr;

    }

    public function Enedicion($id){
        $sql = "SELECT enEdicion FROM noticiaRedactada WHERE id=$id";
        $rs = $this->db->qwery($sql);
        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
        }
        if($arr[0][0] == 1)
            return true;
        return false;
    }

    public function Esportada($id){
        $sql = "SELECT esPortada FROM noticiaRedactada WHERE id=$id";
        $rs = $this->db->qwery($sql);
        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
        }
        if($arr[0][0] == 1)
            return true;
        return false;
    }

    public function Publicada($id){
        $sql = "SELECT publicado FROM noticiaRedactada WHERE id=$id";
        $rs = $this->db->qwery($sql);
        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
        }
        if($arr[0][0] == 1)
            return true;
        return false;
    }

    public function Marcapaginas(){
        $sql = "SELECT id FROM noticiaRedactada ORDER BY id DESC";
        $rs = $this->db->qwery($sql);
        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
        }
        return $arr[0][0];
    }


    public function GetNoticiaDestacada($id){
        $sql = "SELECT noticia FROM NoticiasDestacadas WHERE id=$id";
        $rs = $this->db->qwery($sql);
        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
        }
        return $arr[0][0];
    }

    public function CambiaNoticiaDestacada($id, $not){
        $sql = "UPDATE NoticiasDestacadas SET noticia=$not WHERE id=$id";
        $rs = $this->db->qwery($sql);
        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        }
    }

    public function GetPortada(){
        $sql = "SELECT id FROM noticiaRedactada WHERE esPortada=1 ORDER BY id DESC";
        $rs = $this->db->qwery($sql);
        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->db->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
        }
        return $arr[0][0];
    }

    public function BuscarNoticias($termino){
        $sql = "SELECT * FROM noticiaRedactada WHERE titulo1 COLLATE UTF8_SPANISH_CI LIKE '%$termino%' OR titulo2 COLLATE UTF8_SPANISH_CI LIKE '%$termino%'";
        $rs = $this->db->qwery($sql);

        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->conexion->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
            //printf ("%s (%s)\n", $arr[0], $arr[1]);
        }
        return $arr;
    }

    public function BuscarNoticiasRow($termino){
        $sql = "SELECT * FROM noticiaRedactada WHERE titulo1 COLLATE UTF8_SPANISH_CI LIKE '%$termino%' OR titulo2 COLLATE UTF8_SPANISH_CI LIKE '%$termino%'";
        $rs=$this->db->qwery($sql);
        $numero_filas = $rs->num_rows;
        return $numero_filas;
    }

    public function BuscarNoticiasPublicadas($termino){
        $sql = "SELECT * FROM noticiaRedactada WHERE publicado=1 AND (titulo1 COLLATE UTF8_SPANISH_CI LIKE '%$termino%' OR titulo2 COLLATE UTF8_SPANISH_CI LIKE '%$termino%')";
        $rs = $this->db->qwery($sql);

        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $this->conexion->error, E_USER_ERROR);
        } else {
            $arr = $rs->fetch_all(MYSQLI_NUM);
            //printf ("%s (%s)\n", $arr[0], $arr[1]);
        }
        return $arr;
    }

    public function BuscarNoticiasRowPublicadas($termino){
        $sql = "SELECT * FROM noticiaRedactada WHERE publicado=1 AND (titulo1 COLLATE UTF8_SPANISH_CI LIKE '%$termino%' OR titulo2 COLLATE UTF8_SPANISH_CI LIKE '%$termino%')";
        $rs=$this->db->qwery($sql);
        $numero_filas = $rs->num_rows;
        return $numero_filas;
    }

}
?>