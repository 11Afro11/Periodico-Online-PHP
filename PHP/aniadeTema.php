<!DOCTYPE html>
<html>
<head>
    <title>The Game Today</title>
    <link rel="stylesheet" href="../CSS/Menu.css">
    <link rel="stylesheet" href="../CSS/Social.css">
    <link rel="stylesheet" href="../CSS/MainStyle.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/Principal.css">
    <link rel="stylesheet" href="../CSS/chatbox-style.css">
    <link rel="stylesheet" href="../CSS/formulario.css">
    <link rel="stylesheet" href="../sidde.css">
    <script src="../Javascript/behaviour.js"></script>
</head>

<body>


<!-- Fin del menu desplegable -->
<?php
include "header.php";
?>


<?php
$url = $_GET['url'];

function PrintTem($arg_1, $vec_temas)
{
?>
<li id="tematica"><a href="http://www.faebook.com/"><span><i class="icon icon-happy"></i></span>
        <?php
        echo $vec_temas[$arg_1][0];
        echo "</a></li>";
        }

?>


<div class="container mlogin">
    <?php
    for($i = 0; $i < $tamanio; $i= $i+1){
        PrintTem($i, $vec_temas);
    }
    ?>
    <div id="login">
        <h1>Nuevo tema</h1>
        <form name="loginform" id="loginform" action="PHP/nuevoTema.php" method="POST">
            <p>
                <label for="user_login">Nombre Del Tema<br />
                    <input type="text" name="topic" id="username" class="input" value="" size="20" /></label>
            </p>
            <p class="submit">
                <input type="submit" name="login" class="button" value="Entrar" />
            </p>
        </form>

    </div>

</div>




</body>
