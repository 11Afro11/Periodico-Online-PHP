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
        <div id="breadcrumb"> <a href="administracion.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_NOTICE);
    include "../Controladores/tematica.php";

    $notis = new Noticias();
    $notis->ItsNoticias($datos);
    $tema = new Tematica();
    $tema->Inicia($datos);
    ?>
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Noticias</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>Autor</th>
                        <th>Titulo</th>
                        <th>Tema</th>
                        <?php if($boss){ ?><th>Estado</th><?php };?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tamanio = $notis->Marcapaginas();
                    for($i = $tamanio-1; $i >= 0; $i=$i-1){
                        $au = $notis->GetNoticiaAuthor($i);
                        $publi = $notis->Publicada($i);
                        if(!empty($au) and $publi){
                            ?><tr class="gradeX"><?php
                            echo "<td onCLick=\"document.location='NoticiaAdmin.php?numero=$i'\">";
                            echo $au;
                            echo "</td>";
                            echo "<td onCLick=\"document.location='NoticiaAdmin.php?numero=$i'\">";
                            $notis->GetNoticiaTitle($i);

                            echo "</td>";
                            echo "<td onCLick=\"document.location='NoticiaAdmin.php?numero=$i'\">";
                            echo $tema->GetSpecificTheme($i);
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
