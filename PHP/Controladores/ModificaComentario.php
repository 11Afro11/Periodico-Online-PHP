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
include "comentarios.php";

$base = new BaseDatos();
$base->conectar();
$com = new Comentarios();
$tex = $_POST['texto'];
$id = $_GET['id'];
$com->Inicializa($base, $id);



$com->ModificaComentario($id, $tex);
header("Refresh:0; url='../Administracion/ComentariosAdmin.php'");

?>