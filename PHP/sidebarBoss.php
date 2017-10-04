<!DOCTYPE html>
<html>
<head>
    <title>Foother</title>
    <link rel="stylesheet" href="../CSS/sidde.css">
</head>
<body>
<div class="lateral">
    <h2 id="subtitle">Menú</h2>

    <article id="bosside">
        <a href="ShowNotice.php">
            <h3>Gestor de Comentarios</h3>
        </a>
    </article>
    <article id="bosside">
        <a href="gestorPubli.php">
            <h3>Gestor de Publicidad</h3>
        </a>
    </article>
    <article id="bosside">
        <?php
            if($boss){
                echo "<a href=\"historial.php\">";
            }
            else if($redactor){
                echo "<a href=\"perfilUser.php\">";
            }
        ?>

            <h3>Gestor de Noticias</h3>
        </a>
    </article>
    <article id="bosside">
        <a href="aniadeTema.php">
            <h3>Gestor de Secciones</h3>
        </a>
    </article>

    <?php
    $datos->desconectar();
    ?>


</div>
</body>
</html>
