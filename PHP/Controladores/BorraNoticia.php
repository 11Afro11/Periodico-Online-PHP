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

$base = new BaseDatos();
$base->conectar();
$com = new Noticias();
$id = $_GET['id'];
$com->ItsNoticias($base);


$com->BorraNoticia($id);
header("Refresh:0; url='../Administracion/administracion.php");

?>