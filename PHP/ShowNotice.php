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
    <link rel="stylesheet" href="../CSS/Borra.css">
    <link rel="stylesheet" href="../CSS/botones.css">
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


            <?php
            $users = new Usuario();
            $users->Inicia($datos);
            $boss = $users->EsJefe($_SESSION['username']);
            function PrintExaminado($arg_1, $vec_noticias, $datos)
            {
                $users = new Usuario();
                $users->Inicia($datos);
                $boss = $users->EsJefe($_SESSION['username']);
                $ident = $vec_noticias[$arg_1][0];
                echo "<div id=display>";
                echo "<a class=\"notice\" href='examinarNoticia.php?noticia=";
                echo $ident;
                echo "'><h2><img id=\"imagenMain\" src=\"";
                echo $vec_noticias[$arg_1][7];
                echo "\" href=\"#\">";
                echo $vec_noticias[$arg_1][2];
                echo "<h3>Autor:";
                echo $vec_noticias[$arg_1][1];
                echo "</h3>";
                echo "</h2></a>";
                if($boss) echo "<a id=\"delete\" href=\"PHP/BorraNoticia.php?id=$ident\">";
                if($boss) echo "BORRAR</a>";
                echo "</div>";
            }

            //$datos = new BaseDatos
            $vec_noticias;
            if(isset($_GET['topic'])){
                $vec_noticias = $notis->GetNoticiaByTag($_GET['topic']);
                $tam_noticias = $notis->GetNoticiasByTagSize($_GET['topic']);
                echo "<h1>Noticias de ";
                echo $_GET['topic'];
                echo "</h1>";
            }
            else{
                $vec_noticias = $notis->ItsNoticias($base);
                $tam_noticias = $notis->GetNoticiasSize();
                echo "<h1>Noticias</h1>";
            }
            for ($j = $tam_noticias-1; $j >= 0; $j--) {
                PrintExaminado($j, $vec_noticias, $datos);

            }






            ?>


        </div>
        <?php

        include "sidebar.php";
        echo "</div>";
        echo "</div>";

        ?>



</body>