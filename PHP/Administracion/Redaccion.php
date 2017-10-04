
<html>
<head>
    <link rel="stylesheet" href="css/Redaccion.css" />
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
</head>
<?php
/**
 * Created by PhpStorm.
 * User: Afro
 * Date: 08/08/2017
 * Time: 21:38
 */
include "../Controladores/comentarios.php";
include "../Controladores/tematica.php";
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
include "cabecera.php";
$id = $_GET['noticia'];
$notis = new Noticias();
$notis->ItsNoticias($datos);




?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="administracion.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="Redaccion.php" class="current">Redacción</a></div>
        <div class="row-fluid">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                    <h5>Redaccion</h5>
                </div>
                <div class="widget-content nopadding">

                    <?php
                    $datos->conectar();

                    $not = new Noticias();


                    $vec_noticias = $not->ItsNoticias($datos);

                    $identifier = $_GET['ident'];
                    if($identifier != null){
                        $idnotice = $identifier;
                        if($not->EstaCorrigiendo($idnotice)){
                            include "../Controladores/correccion.php";
                            $correct = new Correccion();
                            $correct->Inicia($datos);
                            $textocorreccion = $correct->GetTexto($idnotice);
                            echo "<h3>";
                            echo $textocorreccion;
                            echo "</h3>";
                        }
                    }
                    else{
                        $idnotice = $not->Marcapaginas()+1;
                    }


                    $tem = new Tematica();
                    $tem->Inicia($datos);
                    $vec_temas = $tem->GetTemas();
                    $tamanio = $tem->GetTemasSize();



                    ?>
                    <form action="../Controladores/InsertaNotice.php?notid=<?php echo $idnotice;?>&selected=3" method="POST" enctype="multipart/form-data">
                            <input type="text" name="titulo" id="titulotitle" placeholder="Título de la noticia" class="input" size="20" value="<?php if($identifier != null){$not->GetNoticiaTitle($identifier);} ?>" />
                            <select id="titulo" name="seleccion">
                                <?php

                                    for($i = 0; $i < $tamanio; $i= $i+1){
                                        echo "<option value=\"";
                                        echo $vec_temas[$i][0];
                                        echo "\">";
                                        echo $vec_temas[$i][0];
                                        echo "</option>";
                                    }
                                    ?>
                            </select>
                            <input id="titulo" type="file" name="foto" />
                        <input id="button" type="submit" name="submit" class="btn btn-success" value="Preview" />
                        <textarea name="cuerpo" class="Editor"><?php if($identifier != null){$not->GetNoticia($identifier);} ?></textarea>
                    </form>



                </div>
            </div>
        </div>
    </div>
    <!--Footer-part-->
    <div class="row-fluid">
        <div id="footer" class="span12"> 2017 Administración de <a href="http://thegametoday.ddns.net">TheGameToday</a> </div>
    </div>
</div>
