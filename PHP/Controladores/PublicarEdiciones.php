<?php
/**
 * Created by PhpStorm.
 * User: afro
 * Date: 9/05/17
 * Time: 16:36
 */
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
include "../modelo.php";
include "Noticias.php";

$parametro = $_GET['parametro'];
$notice = $_GET['noticia'];

$base = new BaseDatos();
$base->conectar();
$notis = new Noticias();
$notis->ItsNoticias($base);
if($parametro < 10){
    $notis->CambiaNoticiaDestacada($parametro, $notice);
    $notis->PublicaNoticia($notice);
}
else{
    $notis->PublicaPortada($notice);
}
header("Refresh:0; url='../Administracion/Organizacion.php'");

?>