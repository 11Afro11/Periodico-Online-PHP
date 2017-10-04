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
    <link rel="stylesheet" href="../CSS/Borra.css">
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
                        echo "</p>";?>
                        <a href="PHP/BorraComentario.php?id=<?php echo $id; ?>&name=<?php $com->GetComentName($i);?>&date=<?php $com->GetComentDate($i);?>&text=<?php $com->GetComentText($i); ?>&url=<?php echo $_SERVER['REQUEST_URI'];?>">BORRAR</a><?php
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

                    <form action="PHP/comentador.php?url=<?php echo $_SERVER['REQUEST_URI'] ?>&id=<?php echo $id?>" method="post">
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