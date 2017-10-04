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
        <div id="breadcrumb"> <a href="administracion.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="Pendientes.php.php" class="current">Noticias Pendientes</a></div>
        <?php
        ini_set('display_errors', 1);
        error_reporting(E_ALL ^ E_NOTICE);
        include "../Controladores/tematica.php";
        include "../Controladores/correccion.php";

        $notis = new Noticias();
        $correct = new Correccion();
        $correct->Inicia($datos);
        $notis->ItsNoticias($datos);
        $tema = new Tematica();
        $tema->Inicia($datos);
        $name = $_SESSION['username'];
        $noticiasPendientes = $notis->GetNoticiasACorregir($name);
        ?>
        <div class="row-fluid">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                    <h5>Noticias pendientes de corrección</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Tema</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $tamanio = $notis->GetNoticiasAcorregirSize($name);
                        for($i = 0; $i < $tamanio; $i=$i+1){
                        $id = $noticiasPendientes[$i][0];
                        ?><tr class="gradeX" onCLick="document.location='Redaccion.php?ident=<?php echo $id;?>&selected=3'"><?php
                            echo "<td>";
                            echo $notis->GetNoticiaTitle($id);
                            echo "</td>";
                            echo "<td>";
                            echo $tema->GetSpecificTheme($id);
                            echo "</td>";
                            $enedicion = $notis->Enedicion($id);
                            $esportada = $notis->Esportada($id);
                            $publicado = $notis->Publicada($id);
                            echo "<td>";
                            echo $correct->GetTexto($id);
                            echo "</td>";
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
