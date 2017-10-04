<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>The Game Today</title>
    <link rel="stylesheet" href="../CSS/Menu.css">
    <link rel="stylesheet" href="../CSS/Social.css">
    <link rel="stylesheet" href="../CSS/fotosStyle.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/chatbox-style.css">
    <script src="behaviour.js"></script>

</head>

<body>

<?php
include "header.php";
?>

<div class="mainbox">
    <?php
    include "Controladores/Noticias.php";
    $noticia = new Noticias();
    $noticia->ItsNoticias($datos);

    $images = $noticia->GetNoticiasPhotos();
    $noticia->Get
    ?>
    <div class="engloba">
        <div class="mainfirst">
    <table style="width:100%">
        <?php
            for($i = 0; $i < $noticia->GetNoticiasPublicadasSize(); $i = $i+3){
                echo "<tr>";
                echo "<th><img id=\"imagen\" src=\"";
                echo $images[$i][0];
                echo "\" href=\"#\"></th>";
                if($i+1 <  $noticia->GetNoticiasPublicadasSize()) {
                    echo "<th><img id=\"imagen\" src=\"";
                    echo $images[$i + 1][0];
                    echo "\" href=\"#\"></th>";
                }
                if($i+2 <  $noticia->GetNoticiasPublicadasSize()) {
                    echo "<th><img id=\"imagen\" src=\"";
                    echo $images[$i + 2][0];
                    echo "\" href=\"#\"></th>";
                }
                echo "</tr>";
            }
        ?>
    </table>
        </div>
    </div>

    <?php
    include "sidebar.php";
    ?>
</div>

<?php
include "foother.php";
?>


</body>
