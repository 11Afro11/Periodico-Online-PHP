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
$notis = new Noticias();
$notis->ItsNoticias($base);
$ident = $_GET['ident'];

$notis->PublicaNoticia($ident);
header("Refresh:0; url='../Administracion/Pendientes.php'");

?>