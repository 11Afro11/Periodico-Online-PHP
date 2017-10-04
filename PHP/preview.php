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

$base = new BaseDatos();
$base->conectar();
$id = $_GET['noticia'];
$notis = new Noticias();
$notis->ItsNoticias($base);
?>
<div class="mainbox">
    <div class="engloba">
        <div class="mainfirst">
            <div class="principal">
            <?php
            $ident = $_GET['notid'];
            $title = $_POST['titulo'];
            $tag = $_POST['seleccion'];
            $notice = $_POST['cuerpo'];

            /////////////////////////Subida de la foto////////////////////////
            $move = "../Imagenes/".$ident.$_FILES['foto']['name'];
            move_uploaded_file($_FILES['foto']['tmp_name'], $move);
            $nombreImagen = $move;

            //////////////////////////////fin de la subida de la foto/////////////////////////////

            echo "<h1>";
            echo $title;
            echo "</h1>";


            if($notis->BuscaNoticia($ident)){
                $notis->ModificaNoticia($notice, $ident);
                $notis->ModificaImagen($nombreImagen, $ident);
            }
            else {
                $notis->AniadeNoticiaEnEdicion($ident, $_SESSION['username'], $title, $notice, $nombreImagen);
            }
            ?><img id="uno" src="<?php $notis->GetNoticiaImg($ident); ?>"><?php
            echo $notice;
            ?>
                <form action="redaccion.php?ident=<?php echo $ident; ?>" method="post">

                    <input id="boton" type="submit" value="Revisar">
                </form>
                <form action="PHP/redirige.php?ident=<?php echo $ident; ?>&tema=<?php echo $tag; ?>" method="post">

                    <input id="boton" type="submit" value="Enviar  ">
                </form>
            </div>

        </div>
        <?php
        include "sidebar.php";
        echo "</div>";
        echo "</div>";
        include "foother.php";

        ?>





</body>