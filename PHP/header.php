<!DOCTYPE html>
<html>
<head>
    <title>Header</title>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="../Javascript/menu.js"></script>
    <meta name="viewport" content="width-device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
</head>
<body>
<header>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_NOTICE);
    include "modelo.php";
    include "Controladores/tematica.php";
    $datos = new BaseDatos;
    $datos->conectar();
    $tem = new Tematica();
    $tem->Inicia($datos);
    $vec_temas = $tem->GetTemas();

    $tamanio = $tem->GetTemasSize();

    function PrintTopic($arg_1, $vec_temas)
    {
    ?>
    <li id="derecha"><a href="ShowNotice.php?topic=<?php echo $vec_temas[$arg_1][2];?>"><span><i class="icon icon-eye"></i></span>
            <?php
            echo $vec_temas[$arg_1][0];
            echo "</a></li>";
            }


            ?>

            <div class="menu_bar">
                <a href="#" class="bt-menu"><span class="icon-home"></span><img id="Portada" src="../Imagenes/Portada.png"></a>
            </div>
            <nav>
                <ul>
                    <li><a href="../index.php"><span class="primero"><i class="icon icon-home"></i></span>Home</a></li>
                    <li class="submenu"><a href="#"><span class="segundo"><i class="icon icon-pacman"></i></span class="caret">Plataformas</a>
                        <ul class="children">
                            <li><a href="http://store.steampowered.com/?l=spanish"><span><i class="icon icon-steam"></i></span>PC</a></li>
                            <li><a href="https://www.nintendo.es/index.html"><span><i class="icon icon-nintendo"></i></span>Nintendo 3DS</a></li>
                            <li><a href="http://www.xbox.com/es-es/"><span><i class="icon icon-xbox"></i></span>XBox One</a></li>
                            <li><a href="https://www.playstation.com/es-es/explore/ps4/"><span><i class="icon icon-play"></i></span>PS4</a></li>
                        </ul>
                    </li>
                    <li class="submenu"><a href="fotos.php"><span class="tercero"><i class="icon icon-books"></i></span class="caret">Fotos</a></li>
                    <li class="submenu"><a href="#"><span class="cuarto"><i class="icon icon-stack"></i></span class="caret">Categorías</a>
                        <ul class="children">
                            <?php
                            for($i = 0; $i < $tamanio; $i= $i+1){
                                PrintTopic($i, $vec_temas);
                            }

                            ?>

                        </ul>
                    </li>
                    <li><a href="search.php"><span class="quinto"><i class="icon icon-search"></i></span>Buscar</a>

                    </li>


                    <?php
                    session_start();
                    ?>
                    <?php
                    include "Controladores/usuario.php";
                    $users = new Usuario();
                    $users->Inicia($datos);
                    if(isset($_POST['username']) && isset($_POST['password'])) {

                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $condicion = $users->CompruebaUsuario($username, $password);
                        if($condicion){
                            $_SESSION['loggedin'] = true;
                            $_SESSION['username'] = $username;
                            $_SESSION['start'] = time();
                            $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
                            unset($_POST['username']);
                            unset($_POST['password']);
                            $username = " ";
                            $password = " ";


                            //header("Refresh:0; url=$url");
                        }
                        else{
                            echo '<script language="javascript">alert("Nombre de usuario o contraseña incorrecta");</script>';
                        }

                    }


                    $datos->desconectar();

                    if(isset($_SESSION['username'])){
                    $boss = $users->EsJefe($_SESSION['username']);
                    $redactor = $users->EsRedactor($_SESSION['username']);
                    if($boss) echo "<li class=\"submenu\"><a href=\"#\"><span class=\"sexto\"><i class=\"icon icon-user-tie\"></i></span>";
                    else if($redactor)  echo "<li class=\"submenu\"><a href=\"#\"><span class=\"sexto\"><i class=\"icon icon-user-check\"></i></span>";
                    else echo "<li class=\"submenu\"><a href=\"#\"><span class=\"sexto\"><i class=\"icon icon-users\"></i></span>";
                    echo $_SESSION['username'] . "";
                    echo "</a>";
                    echo "<ul class=\"children\">";

                    ?>
                    <li id="derecha"><a href="Controladores/cerrarsesion.php?url=
                    <?php
                        echo $_SERVER['REQUEST_URI'];
                        ?>"><span><i class="icon icon-user-minus"></i></span>Logout</a></li>
                    <?php if($redactor || $boss){echo "<li id=\"derecha\"><a href=\"Administracion/administracion.php\"><span><i class=\"icon icon-unlocked\"></i></span>Administración</a></li>";}?>
                </ul>

                <?php
                }
                else{
                ?>
    <li class="submenu"><a href="#"><span class="sexto"><i class="icon icon-user"></i></span class="caret">Usuario</a>
        <ul class="children">
            <li id="derecha"><a href="inicia.php?url=<?php echo $_SERVER['REQUEST_URI']; ?>"><span><i class="icon icon-lock"></i></span>Inicia Sesion</a></li>
            <li id="derecha"><a href="registra.php?url=<?php echo $_SERVER['REQUEST_URI']; ?>"><span><i class="icon icon-user-plus"></i></span>Registrarse</a></li>
        </ul>
        <?php

        }
        ?>
    </li>


    </ul>
    </nav>
</header>



<div class="social">
    <h5>Siguenos</h5>
    <ul>
        <li><a href="https://www.facebook.com/Thegametoday-123398504954759/" target="_blank" class="icon-facebook"></a></li>
        <li><a href="https://twitter.com/TheGamesToday" target="_blank" class="icon-twitter"></a></li>
        <li><a href="http://www.googleplus.com/" target="_blank" class="icon-google-plus3"></a></li>
        <li><a href="http://www.youtube.com/" target="_blank" class="icon-youtube"></a></li>
        <li><a href="mailto:contacto@thegametoday.com" class="icon-mail2"></a></li>
    </ul>
</div>

<!-- Fin del menu desplegable -->


<!-- Imagen de portada con el titulo del periodico -->
<a href="#">
    <img id="PortadaM" src="../Imagenes/Portada.png">
</a>
</body>
</html>