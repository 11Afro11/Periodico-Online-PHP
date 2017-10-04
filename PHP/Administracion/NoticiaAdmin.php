<?php
/**
 * Created by PhpStorm.
 * User: Afro
 * Date: 08/08/2017
 * Time: 11:35
 */
include "cabecera.php";

?>

<link rel="stylesheet" href="css/Noticia.css" />

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="administracion.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <?php if($_GET['from'] == 2) {
                echo "<a href=\"Organizacion.php\" title=\"Go to Home\" class=\"tip - bottom\">Organización</a>";
                echo "<a href=\"EdicionPortada.php\" title=\"Go to Home\" class=\"tip - bottom\">Edicion de la Portada</a>";
            }?>
            <a href="ComentariosAdmin.php" class="current">Noticia</a></div>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_NOTICE);
    include "../Controladores/tematica.php";
    $datos = new BaseDatos;
    $datos->conectar();
    $notis = new Noticias();
    $notis->ItsNoticias($datos);
    $tema = new Tematica();
    $tema->Inicia($datos);
    $numero = $_GET['numero'];
    ?>
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Noticias</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="contenido">
                <?php
                echo "<h1>";
                    $notis->GetNoticiaTitle($numero);
                    echo "</h1>";
                ?>

                <?php
                echo "<img id=\"uno\" src=../";
                $notis->GetNoticiaImg($numero);
                echo ">";
                $notis->GetNoticia($numero);
                ?>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> 2017 Administración de <a href="http://thegametoday.ddns.net">TheGameToday</a> </div>
</div>
</div>
