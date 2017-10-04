<?php
/**
 * Created by PhpStorm.
 * User: Afro
 * Date: 24/08/2017
 * Time: 10:25
 */
include "usuario.php";
include "../modelo.php";
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);

$id = $_GET['id'];
$usuario = new Usuario();
$base = new BaseDatos();
$base->conectar();
$usuario->Inicia($base);
$nom = $usuario->UserGetNombre($id);
$em = $usuario->UserGetMail($id);
$pas = $usuario->UserGetPass($id);
$i = $usuario->GetRedactoresSize();

$usuario->BecomeRedactor($nom, $em, $pas, $i);

header("Refresh:0; url=../Administracion/Usuarios.php");