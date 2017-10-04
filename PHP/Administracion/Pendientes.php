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

    $notis = new Noticias();
    $notis->ItsNoticias($datos);
    $tema = new Tematica();
    $tema->Inicia($datos);
    $noticiasPendientes = $notis->GetNoticiaPendiente();
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
                    ?><tr class="gradeX" onCLick="document.location='RevisaNoticia.php?notid=<?php echo $id; ?>&selected=5'"><?php
                            echo "<td>";
                            echo $au;
                            echo "</td>";
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
                            if($esportada)
                                echo "Portada";
                            else if($publicado)
                                echo "Publicado";
                            else{
                                echo "En Edicion";
                            }
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
