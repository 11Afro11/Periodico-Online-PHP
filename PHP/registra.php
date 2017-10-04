<!DOCTYPE html>
<html>
<head>
    <title>The Game Today</title>
    <link rel="stylesheet" href="../../CSS/Menu.css">
    <link rel="stylesheet" href="../../CSS/Social.css">
    <link rel="stylesheet" href="../../CSS/MainStyle.css">
    <link rel="stylesheet" href="../../CSS/style.css">
    <link rel="stylesheet" href="../../CSS/Principal.css">
    <link rel="stylesheet" href="../../CSS/chatbox-style.css">
    <link rel="stylesheet" href="../../CSS/formulario.css">
    <script src="../Javascript/behaviour.js"></script>
</head>

<body>


<!-- Fin del menu desplegable -->


<!-- Imagen de portada con el titulo del periodico -->
<a href="#">
    <img id="Portada" src="../../Imagenes/Portada.png">
</a>


<?php
$url = $_GET['url'];


?>


<div class="container mregister">
    <div id="login">
        <h1>Registrar</h1>
        <form name="registerform" id="registerform" action="Controladores/aniadeUser.php?url=<?php echo $url; ?>" method="post">
            <p>
                <label for="user_login">Nombre Completo<br />
                    <input type="text" name="full_name" id="full_name" class="input" size="32" value="" /></label>
            </p>

            <p>
                <label for="user_pass">E-mail<br />
                    <input type="email" name="email" required id="email" class="input" value="" size="32" /></label>
            </p>

            <p>
                <label for="user_pass">Nombre De Usuario<br />
                    <input type="text" name="username" required id="username" class="input" value="" size="20" /></label>
            </p>

            <p>
                <label for="user_pass">Contraseña<br />
                    <input type="password" name="password" required id="password" class="input" value="" size="32" /></label>
            </p>

            <p class="submit">
                <input type="submit" name="register" id="register" class="button" value="Registrar" />
            </p>

            <p class="regtext">Ya tienes una cuenta? <a href="inicia.php" >Entra Aquí!</a>!</p>
        </form>

    </div>
</div>




</body>
