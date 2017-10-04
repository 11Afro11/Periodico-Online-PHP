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
include "tematica.php";
$datos = new BaseDatos;
$datos->conectar();
$tem = new Tematica();
$tem->Inicia($datos);
$text = $_POST['titulo'];
$tem->AniadeTema($text);
header("Refresh:0; url='../Administracion/AdministracionTemas.php'");