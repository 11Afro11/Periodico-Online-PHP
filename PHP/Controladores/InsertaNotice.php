<?php
/**
 * Created by PhpStorm.
 * User: Afro
 * Date: 11/08/2017
 * Time: 18:26
 */
include "../Controladores/tematica.php";
include "Noticias.php";
include "../modelo.php";
session_start();
$ident = $_GET['notid'];

$datos = new BaseDatos();
$datos->conectar();
$notis = new Noticias();
$notis->ItsNoticias($datos);
$tema = new Tematica();
$tema->Inicia($datos);
$title = $_POST['titulo'];
$tag = $_POST['seleccion'];
$notice = $_POST['cuerpo'];

/////////////////////////Subida de la foto////////////////////////
$move = "../../Imagenes/".$ident.$_FILES['foto']['name'];
$ruta = "../Imagenes/".$ident.$_FILES['foto']['name'];
move_uploaded_file($_FILES['foto']['tmp_name'], $move);
$nombreImagen = $ruta;

if($notis->BuscaNoticia($ident)){
    $notis->ModificaNoticia($notice, $ident);
    $notis->ModificaImagen($nombreImagen, $ident);
}
else {
    $notis->AniadeNoticiaEnEdicion($ident, $_SESSION['username'], $title, $notice, $nombreImagen);
}

header("Refresh:0; url=../Administracion/Preview.php?notid=$ident&tag=$tag");