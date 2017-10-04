<link rel="stylesheet" href="css/Edicion.css" />

<?php
/**
 * Created by PhpStorm.
 * User: Afro
 * Date: 13/08/2017
 * Time: 19:37
 */
include "cabecera.php";
?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="administracion.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="Organizacion.php" class="current">Organización</a></div>
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
                    <h2 id="portada">Portada</h2>
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
                            $id = $notis->GetPortada();
                                $au = $notis->GetNoticiaAuthor($id);
                                if(!empty($au)){
                            ?>
                            <tr class="gradeX"
                                onCLick="document.location='EdicionPortada.php?portada=1'"><?php
                                echo "<td>";
                                echo $au;
                                echo "</td>";
                                echo "<td>";
                                $notis->GetNoticiaTitle($id);
                                echo "</td>";
                                echo "<td>";
                                echo $tema->GetSpecificTheme($id);
                                echo "</td>";
                                $enedicion = $notis->Enedicion($id);
                                $esportada = $notis->Esportada($id);
                                $publicado = $notis->Publicada($id);
                                echo "<td>";
                                if ($esportada)
                                    echo "Portada";
                                else if ($publicado)
                                    echo "Publicado";
                                else {
                                    echo "En Edicion";
                                }
                                echo "</td>";
                                echo "</tr>";
                                }

                            ?>
                        </tbody>
                    </table>
                </div>
            <div class="widget-content nopadding">
                    <h2 id="destacados">Destacadas</h2>
                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="gradeX"><?php
                                $identific = $notis->GetNoticiaDestacada(0);
                            echo "<td onCLick=\"document.location='EdicionPortada.php?numero=0&selected=4'\">";
                                $notis->GetNoticiaTitle($identific);
                            echo "</td>";
                            echo "<td onCLick=\"document.location='EdicionPortada.php?numero=1&selected=4'\">";
                            $notis->GetNoticiaTitle($notis->GetNoticiaDestacada(1));
                            echo "</td>";
                            echo "<td onCLick=\"document.location='EdicionPortada.php?numero=2&selected=4'\">";
                                $notis->GetNoticiaTitle($notis->GetNoticiaDestacada(2));
                            echo "</td>";
                            echo "</tr>";?>
                            <tr class="gradeX"><?php
                                $identific = $notis->GetNoticiaDestacada(3);
                            echo "<td onCLick=\"document.location='EdicionPortada.php?numero=3&selected=4'\">";
                                $notis->GetNoticiaTitle($identific);
                            echo "</td>";
                            echo "<td onCLick=\"document.location='EdicionPortada.php?numero=4&selected=4'\">";
                            $notis->GetNoticiaTitle($notis->GetNoticiaDestacada(4));
                            echo "</td>";
                            echo "<td onCLick=\"document.location='EdicionPortada.php?numero=5&selected=4'\">";
                                $notis->GetNoticiaTitle($notis->GetNoticiaDestacada(5));
                            echo "</td>";
                            echo "</tr>";
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
