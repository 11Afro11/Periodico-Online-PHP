<?php
/**
 * Created by PhpStorm.
 * User: Afro
 * Date: 10/08/2017
 * Time: 20:32
 */
include "../modelo.php";
include "../Controladores/usuario.php";
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
$datos = new BaseDatos;
$datos->conectar();
$users = new Usuario();
$users->Inicia($datos);

$boss = $users->EsJefe($_SESSION['username']);
