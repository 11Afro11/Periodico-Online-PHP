<?php
/**
 * Created by PhpStorm.
 * User: Afro
 * Date: 08/08/2017
 * Time: 11:35
 */
include "cabecera.php";
$ident = $_GET['notid'];
session_start();
?>

<link rel="stylesheet" href="css/Noticia.css" />

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="administracion.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a href="Redaccion.php?ident=<?php echo $ident; ?>&selected=3" title="Go to Home" class="tip-bottom">Redacción</a>
            <a href="ComentariosAdmin.php" class="current">Preview</a></div>
        <?php
        ini_set('display_errors', 1);
        error_reporting(E_ALL ^ E_NOTICE);
        include "../Controladores/tematica.php";

        $notis = new Noticias();
        $notis->ItsNoticias($datos);
        $tema = new Tematica();
        $tema->Inicia($datos);
        $tag = $_GET['tag'];

        ?>
        <div class="row-fluid">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                    <h5>Preview</h5>
                </div>
                <div class="widget-content nopadding">
                    <form action="Redaccion.php?ident=<?php echo $ident;?>&selected=3" method="POST" enctype="multipart/form-data">
                        <input id="button" type="submit" name="submit" class="btn btn-success" value="Back" />
                    </form>
                    <form action="../Controladores/redirige.php?ident=<?php echo $ident; ?>&tema=<?php echo $tag; ?>" method="post">

                        <input id="button" class="btn btn-success" type="submit" value="Enviar  ">
                    </form>
                    <?php if($boss){ ?>
                        <form action="../Controladores/PublicaBoss.php?ident=<?php echo $ident; ?>&tema=<?php echo $tag; ?>&" method="post">

                            <input class="btn btn-success" id="button" type="submit" value="PUBLICAR">
                        </form>
                    <?php };?>
                    <div class="contenido">
                        <?php
                        echo "<h1>";
                        $notis->GetNoticiaTitle($ident);
                        echo "</h1>";
                        ?>

                        <?php
                        echo "<img id=\"uno\" src=../";
                        $notis->GetNoticiaImg($ident);
                        echo ">";
                        $notis->GetNoticia($ident);
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
