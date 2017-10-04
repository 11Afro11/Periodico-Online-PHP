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

                <h2>Redacción de la noticia</h2>
                <?php

                //$datos = new BaseDatos;
                $datos->conectar();

                $not = new Noticias();


                $vec_noticias = $not->ItsNoticias($datos);

                $identifier = $_GET['ident'];
                if($identifier != null){
                    $idnotice = $identifier;
                    if($not->EstaCorrigiendo($idnotice)){
                        include "PHP/correccion.php";
                        $correct = new Correccion();
                        $correct->Inicia($datos);
                        $textocorreccion = $correct->GetTexto($idnotice);
                        echo "<h3>";
                        echo $textocorreccion;
                        echo "</h3>";
                    }
                }
                else{
                    $idnotice = $not->GetNoticiasSize();
                }




                ?>
            <form action="preview.php?notid=<?php echo $idnotice; ?>" method="POST" enctype="multipart/form-data">
                <div id="redact">
                    <input type="text" name="titulo" id="titulotitle" placeholder="Título de la noticia" class="input" size="20" value="<?php if($identifier != null){$not->GetNoticiaTitle($identifier);} ?>" />
                    <select id="titulo" name="seleccion">

                        <?php
                        function PrintTop($arg_1, $vec_temas)
                        {
                            ?>
                            <option value="<?php echo $vec_temas[$arg_1][0]; ?>"><?php
                            echo $vec_temas[$arg_1][0];
                            echo "</option>";
                            }
                            $tem->Inicia($datos);
                            $vec_temas = $tem->GetTemas();
                            $tamanio = $tem->GetTemasSize();
                            for($i = 0; $i < $tamanio; $i= $i+1){
                                PrintTop($i, $vec_temas);
                            }
                        ?>

                    </select>

                <input id="titulo" type="file" name="foto" />
                </div>
                <textarea name="cuerpo" class="Editor"><?php if($identifier != null){$not->GetNoticia($identifier);} ?></textarea>
                <input id="boton" type="submit" name="submit" class="button" value="Preview" />

            </form>

            </div>
        <?php
        include "sidebar.php";
        echo "</div>";
        echo "</div>";

        ?>



</body>