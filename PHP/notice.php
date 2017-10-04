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
    <script src="../Javascript/behaviour.js"></script>


</head>

<body onload="redimensionar()">
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
include "Controladores/Noticias.php";
include "Controladores/comentarios.php";


$base = new BaseDatos();
$base->conectar();
$id = $_GET['noticia'];
$notis = new Noticias();
$notis->ItsNoticias($base);
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.10";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div class="mainbox">
<div class="engloba">
<div class="mainfirst">
    <div class="principal">
    <?php
    echo "<h1>";
    $notis->GetNoticiaTitle($id);
    echo "</h1>";
    ?>
        <alert><li><a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php $notis->GetNoticiaTitle($id); ?>" data-img="<?php $notis->GetNoticiaImg($id); ?>" data-via="TheGameToday">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></li></alert>

        <div class="fb-share-button" data-href="<?php $_GET['url']; ?>" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Compartir</a></div>



    <?php
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

<div class="despliegue" id="despliegue">
    <h1>COMENTARIOS</h1>
    <?php
    if(isset($_SESSION['username'])){
        $user = $_SESSION['username'];
    ?>
    <input id="boton-send" type="button" onclick="Show()" value="SHOW"><?php } ?>
</div>

<div class="chatbox" id="chatbox" style='display:none;'>
    <div class="chatlog" id="chatlog">

        <?php
        $tam = $com->GetComentSize();
        for($i = 0; $i < $tam; $i++) {
            echo "<div class=\"chat\" id=\"chat\">";
            echo "<div id=\"user-photo\"><img src=\"../Imagenes/icono.png\"></div>";
            echo "<h4>";
            $com->GetComentName($i);
            echo "</h4>";
            echo "<p id=\"fecha\">";
            $com->GetComentDate($i);
            echo "</p>";
            echo "<p id=\"chat-message\">";
            $com->GetComentText($i);
            echo "</p>";
            echo "</div>";
        }
        ?>

    </div>

    <div class="chat-form">
        <!-- <p>Nombre</p><textarea></textarea>

        <p></p> -->
        <div id="nom" style='display: none;'><input id = "nombre" placeholder="Enter your name..." value="<?php echo $_SESSION['username']; ?>"></input>  NOMBRE*</div>
        <?php
        $ur = $_SERVER['REQUEST_URI'];
        ?>

        <form action="Controladores/comentador.php?url=<?php echo $_SERVER['REQUEST_URI'] ?>&id=<?php echo $id?>" method="post">
        <textarea name='texto' id = "entrada" placeholder="Enter the text..." onkeyup="Censura()"></textarea>

        <input id="boton" type="submit" value="Send">
        </form>

    </div>

</div>

</div>
    <?php
        include "sidebar.php";
    echo "</div>";
    echo "</div>";
    include "foother.php";

?>





</body>