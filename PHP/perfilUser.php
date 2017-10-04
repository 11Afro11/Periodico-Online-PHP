<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>The Game Today</title>
    <link rel="stylesheet" href="../CSS/Menu.css">
    <link rel="stylesheet" href="../CSS/Social.css">
    <link rel="stylesheet" href="../CSS/MainStyle.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/Principal.css">
    <link rel="stylesheet" href="../CSS/chatbox-style.css">
    <link rel="stylesheet" href="../CSS/texto.css">
    <script src="../Javascript/behaviour.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({
            selector:'textarea',
            height:"550px",
            width:"100%",
            position:"relative"
        });</script>


</head>

<body>
<header>
    <?php
    include "header.php";
    ?>
</header>



<!-- Fin del menu desplegable -->


<!-- Imagen de portada con el titulo del periodico -->
<a href="../index.php">
    <img id="Portada" src="../Imagenes/Portada.png">
</a>
<!-- fin de portada -->

<!-- Articulo principal -->


<?php
/**
 * Created by PhpStorm.
 * User: afro
 * Date: 17/04/17
 * Time: 18:37
 */
include "Controladores/comentarios.php";
include "Controladores/Noticias.php";
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);

$base = new BaseDatos();
$base->conectar();
$id = $_GET['noticia'];
$notis = new Noticias();
$notis->ItsNoticias($base);
?>
<div class="mainbox">
    <div class="engloba">
        <div class="mainfirst">

            <h1 id="histtitle">Noticias pendientes de revisión</h1>
            <?php
            function PrintPortada($arg_1, $vec_noticias)
            {
                $ident = $vec_noticias[$arg_1][0];
                echo "<div id=display>";
                echo "<a class=\"notice\" href='redaccion.php?ident=";
                echo $ident;
                echo "'><h2><img id=\"imagenMain\" src=\"";
                echo $vec_noticias[$arg_1][7];
                echo "\" href=\"#\">";
                echo $vec_noticias[$arg_1][2];
                echo "<h3>Autor:";
                echo $vec_noticias[$arg_1][1];
                echo "</h3>";
                echo "</h2></a>";
                echo "</div>";
            }

            //$datos = new BaseDatos
            $user = $_SESSION['username'];

            $vec_noticias_pendientes = $notis->GetNoticiasACorregir($user);

            $tam_noticias_pendientes = $notis->GetNoticiasAcorregirSize($user);
            for ($j = $tam_noticias_pendientes-1; $j >= 0; $j--) {
                PrintPOrtada($j, $vec_noticias_pendientes);
            }






            ?>
            <h1 id="histtitle">Noticias Publicadas por ti</h1>

            <?php

            $vec_noticias_publicadas = $notis->GetNoticiasPublicadasBy($user);
            $tam_noticias_publicadas = $notis->GetNoticiasPublicadasBySize($user);
            for ($j = $tam_noticias_publicadas-1; $j >= 0; $j--) {
                PrintPOrtada($j, $vec_noticias_publicadas);
            }

            ?>


        </div>
        <?php
        include "sidebarBoss.php";
        echo "</div>";
        echo "</div>";

        ?>



</body>