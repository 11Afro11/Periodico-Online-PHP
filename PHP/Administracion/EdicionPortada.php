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
            <a href="Organizacion.php" title="Go to Home" class="tip-bottom">Organizacion</a>
            <a href="EdicionPortada.php" class="current">Edicion de la Portada</a></div>
        <?php
        ini_set('display_errors', 1);
        error_reporting(E_ALL ^ E_NOTICE);
        include "../Controladores/tematica.php";

        $notis = new Noticias();
        $notis->ItsNoticias($datos);
        $tema = new Tematica();
        $tema->Inicia($datos);
        $noticiasPendientes = $notis->GetNoticiaPendiente();
        if($_GET['portada']){
            $parametro = 10;
        }
        else{
            $parametro = $_GET['numero'];
        }

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
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $tamanio = $notis->GetNoticiasPendientesSize();
                        for($i = 0; $i < $tamanio; $i=$i+1){
                        $au = $noticiasPendientes[$i][1];
                        if(true) {
                        $id = $noticiasPendientes[$i][0];
                        ?><tr class="gradeX"><?php
                            echo "<td onCLick=\"document.location='../Controladores/PublicarEdiciones.php?parametro=$parametro&noticia=$id'\">";
                            echo $au;
                            echo "</td>";
                            echo "<td onCLick=\"document.location='../Controladores/PublicarEdiciones.php?parametro=$parametro&noticia=$id'\">";
                            echo $notis->GetNoticiaTitle($id);
                            echo "</td>";
                            echo "<td onCLick=\"document.location='../Controladores/PublicarEdiciones.php?parametro=$parametro&noticia=$id'\">";
                            echo $tema->GetSpecificTheme($id);
                            echo "</td>";
                            echo "<td onCLick=\"document.location='NoticiaAdmin.php?numero=$id&selected=4&from=2'\">";
                            echo "VER";
                            echo "</td>";

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
