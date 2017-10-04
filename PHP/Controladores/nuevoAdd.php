<?php
/**
 * Created by PhpStorm.
 * User: afro
 * Date: 15/05/17
 * Time: 9:38
 */
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
include "../modelo.php";
include "publicidad.php";
$datos = new BaseDatos;
$datos->conectar();
$publi = new Publicidad();
$publi->ItsPubli($datos);
$url = $_POST['enlace'];
$nombre = $_POST['titulo'];
$imagen = $_POST['foto'];
$publi->AniadePublicidad($nombre, $url, $imagen);
header("Refresh:0; url='../Administracion/Graficos.php'");