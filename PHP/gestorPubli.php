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
    <link rel="stylesheet" href="../Borra.css">
    <script src="../Javascript/behaviour.js"></script>
</head>

<body>


<!-- Fin del menu desplegable -->
<?php
include "header.php";
include "Controladores/publicidad.php";
$publi = new Publicidad();
$vec = $publi->ItsPubli($datos);
$tam = $publi->GetPubliSize();
?>



<?php
$url = $_GET['url'];

function PrintTem($arg_1, $vec)
{
?>
<li id="tematica"><a>
        <?php
        echo $vec[$arg_1][2];
        echo ": ";
        echo $vec[$arg_1][3];
        echo "</a></li>";
        }

        ?>


        <div class="container mlogin">
            <?php
            for($i = 0; $i < $tam; $i= $i+1){
                PrintTem($i, $vec);
                echo "</p>";?>
                <a href="PHP/BorraPubli.php?id=<?php echo $i; ?>">BORRAR</a><?php
            }
            ?>
            <div id="login">
                <h1>Nuevo tema</h1>
                <form name="loginform" id="loginform" action="PHP/nuevoAdd.php" method="POST">
                    <p>
                        <label for="user_login">Proveedor<br />
                            <input type="text" name="provide" id="username" class="input" value="" size="20" /></label>
                    </p>
                    <p>
                        <label for="user_login">Enlace<br />
                            <input type="text" name="link" id="username" class="input" value="" size="20" /></label>
                    </p>
                    <p class="submit">
                        <input type="submit" name="login" class="button" value="Entrar" />
                    </p>
                </form>

            </div>

        </div>




</body>
