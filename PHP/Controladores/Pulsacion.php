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
include "publicidad.php";

$base = new BaseDatos();
$base->conectar();
$id = $_GET['id'];
$publi = new Publicidad();
$publi->ItsPubli($base);
$publi->AddClick($id);
$url = $publi->GetPubliSrc($id);



header("Refresh:0; url='$url'");