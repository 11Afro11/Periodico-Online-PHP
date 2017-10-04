<?php
/**
 * Created by PhpStorm.
 * User: Afro
 * Date: 24/08/2017
 * Time: 21:06
 */
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
include "tematica.php";
include "../modelo.php";

$datos = new BaseDatos();
$datos->conectar();
$tem = new Tematica();
$tem->Inicia($datos);

$id = $_GET['id'];
$nom = $_POST['texto'];

$tem->ModificaTema($id, $nom);
$datos->desconectar();

header("Refresh:0; url='../Administracion/AdministracionTemas.php'");