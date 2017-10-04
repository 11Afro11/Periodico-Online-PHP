<!DOCTYPE html>
<html>
<head>
    <title>The Game Today</title>
    <link rel="stylesheet" href="../CSS/menuOpcional.css">
    <link rel="stylesheet" href="../CSS/Social.css">
    <link rel="stylesheet" href="../CSS/MainStyle.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/Principal.css">
    <link rel="stylesheet" href="../CSS/chatbox-style.css">
    <link rel="stylesheet" href="../CSS/formulario.css">
    <script src="../Javascript/behaviour.js"></script>
</head>

<body>


<!-- Fin del menu desplegable -->


<!-- Imagen de portada con el titulo del periodico -->
<a href="#">
    <img id="Portada" src="../Imagenes/Portada.png">
</a>


<?php
$url = $_GET['url'];

?>


<div class="container mlogin">
    <div id="login">
        <h1>Logueo</h1>
        <form name="loginform" id="loginform" action="<?php echo $url; ?>" method="POST">
            <p>
                <label for="user_login">Nombre De Usuario<br />
                    <input type="text" name="username" id="username" class="input" value="" size="20" /></label>
            </p>
            <p>
                <label for="user_pass">Contraseña<br />
                    <input type="password" name="password" id="password" class="input" value="" size="20" /></label>
            </p>
            <p class="submit">
                <input type="submit" name="login" class="button" value="Entrar" />
            </p>
            <p class="regtext">No estas registrado? <a href="register.php" >Registrate Aquí</a>!</p>
        </form>

    </div>

</div>




</body>
