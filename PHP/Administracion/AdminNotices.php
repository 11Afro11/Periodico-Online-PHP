<?php
/**
 * Created by PhpStorm.
 * User: Afro
 * Date: 08/08/2017
 * Time: 11:53
 */
    ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_NOTICE);
    include "../Controladores/tematica.php";

    $notis = new Noticias();
    $notis->ItsNoticias($datos);
    $tema = new Tematica();
    $tema->Inicia($datos);
?>

<div id="content">
    <div id="content-header">
        <h1>Noticias</h1>
    </div>
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Data table</h5>
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
                $tamanio = $notis->GetNoticiasSize();
                for($i = 0; $i < $tamanio; $i=$i+1){
                    $au = $notis->GetNoticiaAuthor($i);
                    if(!empty($au)) {
                        echo "<tr class=\"gradeX\" onCLick=\"document.location='error403.html'\">";
                        echo "<td>";
                        echo $au;
                        echo "</td>";
                        echo "<td>";
                        echo $notis->GetNoticiaTitle($i);
                        echo "</td>";
                        echo "<td>";
                        echo $tema->GetSpecificTheme($i);
                        echo "</td>";
                        $enedicion = $notis->Enedicion($i);
                        $esportada = $notis->Esportada($i);
                        $publicado = $notis->Publicada($i);
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
<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> 2017 Administración de <a href="http://thegametoday.ddns.net">TheGameToday</a> </div>
</div>
