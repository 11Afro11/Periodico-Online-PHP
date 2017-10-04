<?php
/**
 * Created by PhpStorm.
 * User: Afro
 * Date: 08/08/2017
 * Time: 11:35
 */

include "cabecera.php";

?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="administracion.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a href="AdministracionTemas.php?selected=7" title="Go to Home" class="tip-bottom">Temas</a>
            <a href="NoticiasPorTema.php" class="current">Noticias Por Tema</a></div>
    </div>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_NOTICE);
    include "../Controladores/tematica.php";

    $notis = new Noticias();
    $notis->ItsNoticias($datos);
    $tema = new Tematica();
    $tema->Inicia($datos);
    $tem = $_GET['tem'];
    $topic = $tema->GetTema($tem);
    ?>
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <?php

                ?>
                <h5><?php echo $topic;?></h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>Autor</th>
                        <th>Titulo</th>
                        <?php if($boss){ ?><th>Estado</th><?php };?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $tamnoticiaPorTema = $notis->GetNoticiasByTagSize($tem);
                    $noticias_con_este_tema = $notis->GetNoticiaByTag($tem);
                    for($i = $tamnoticiaPorTema-1; $i >= 0; $i=$i-1){
                    ?><tr class="gradeX"><?php
                        echo "<td onCLick=\"document.location='NoticiaAdmin.php?numero=$i'\">";
                        echo $noticias_con_este_tema[$i][1];
                        echo "</td>";
                        echo "<td onCLick=\"document.location='NoticiaAdmin.php?numero=$i'\">";
                        echo $noticias_con_este_tema[$i][2];
                        echo "</td>";
                        $enedicion = $notis->Enedicion($i);
                        $esportada = $notis->Esportada($i);
                        $publicado = $notis->Publicada($i);
                        if($boss) {
                            echo "<td onCLick=\"document.location='../Controladores/BorraNoticia.php?id=$i'\">";
                            echo "borrar";
                            echo "</td>";
                        }
                        echo "</tr>";

                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> 2017 Administración de <a href="http://thegametoday.ddns.net">TheGameToday</a> </div>
</div>
</div>
