<?php
/**
 * Created by PhpStorm.
 * User: afro
 * Date: 9/05/17
 * Time: 16:36
 */
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
include "Noticias.php";
include "correccion.php";
include "../modelo.php";

$base = new BaseDatos();
$base->conectar();
$notis = new Noticias();
$corr = new Correccion();
$corr->Inicia($base);
$notis->ItsNoticias($base);
$ident = $_GET['ident'];
$text = $_POST['texto'];
$notis->CorrigeNoticia($ident);
$corr->AsignaCorreccion($ident, $text);
header("Refresh:0; url='../Administracion/Pendientes.php'");

?>