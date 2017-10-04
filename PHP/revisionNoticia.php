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
                echo "<h1>";
                $notis->GetNoticiaTitle($id);
                echo "</h1>";
                echo "<img id=\"uno\" src=";
                $notis->GetNoticiaImg($id);
                echo ">";
                $notis->GetNoticia($id);
                ?>
            </div>
            <?php
            $com = new Comentarios();
            $com->Inicializa($base, $id);
            ?>

            <form action="PHP/publica.php?ident=<?php echo $id; ?>" method="post">

                <input id="botonEdit" type="submit" value="PUBLICAR">
            </form>

            <form action="PHP/portada.php?ident=<?php echo $id; ?>" method="post">

                <input id="botonEdit" type="submit" value="PORTADA">
            </form>

            <form action="redaccion.php?ident=<?php echo $id; ?>" method="post">

                <input id="botonEdit" type="submit" value="CORREGIR">
            </form>

            <div class="despliegueEdit" id="despliegue">
                <?php
                if(isset($_SESSION['username'])){
                    $user = $_SESSION['username'];
                    ?>
                    <input id="boton-send" type="button" onclick="Show()" value="revisar"><?php } ?>
            </div>

            <div class="chatbox" id="chatbox" style='display:none;'>


                <div class="chat-form">

                    <form action="PHP/corrector.php?url=<?php echo $_SERVER['REQUEST_URI'] ?>&ident=<?php echo $id?>" method="post">
                        <textarea name='texto' id = "entrada" placeholder="Introduce las anotaciones..."></textarea>

                        <input id="boton" type="submit" value="Send">
                    </form>

                </div>

            </div>

        </div>
<?php
include "sidebarBoss.php";
echo "</div>";
echo "</div>";
include "foother.php";

?><?php
/**
 * Created by PhpStorm.
 * User: afro
 * Date: 13/05/17
 * Time: 20:53
 */