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
include "tematica.php";
include "correccion.php";

$base = new BaseDatos();
$base->conectar();
$tag = $_GET['tema'];
$notis = new Noticias();
$tem = new Tematica();
$corr = new Correccion();
$notis->ItsNoticias($base);
$tem->Inicia($base);
$corr->Inicia($base);
$ident = $_GET['ident'];
$identificador = $tem->GetId($tag);
$notis->SendNotice($ident);
if(!$tem->YaTrata($ident)) {
    $tem->AsignaTema($ident, $identificador);
}

if($corr->BuscaCorreccion($ident)){
    $corr->BorraCorreccion($ident);
    $notis->ModificaCorreccion($ident);
}
$notis->PublicaNoticia($ident);
header("Refresh:0; url='../Administracion/administracion.php'");

?>