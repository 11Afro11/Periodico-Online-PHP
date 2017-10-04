<?php
session_start();
?>

<?php
include "../modelo.php";
include "comentarios.php";
/**
 * Created by PhpStorm.
 * User: afro
 * Date: 28/04/17
 * Time: 13:40
 */
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
$base = new BaseDatos();
$base->conectar();
$com = new Comentarios();
$idt = $_GET['id'];
$com->Inicializa($base, $idt);
$user = $_SESSION['username'];
$url = $_GET['url'];
$text = $_POST['texto'];
$hoy = getdate();
$com->Comenta($idt, $user, date("Y/m/d"), $text);
header("Refresh:0; url=$url");

?>