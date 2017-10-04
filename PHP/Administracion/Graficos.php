
<html>
<head>
    <link rel="stylesheet" href="css/Redaccion.css" />
    <script src="../../Javascript/Chart.js"></script>
</head>
<?php
/**
 * Created by PhpStorm.
 * User: Afro
 * Date: 08/08/2017
 * Time: 21:38
 */
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
include "cabecera.php";

include "../Controladores/publicidad.php";
$publi = new Publicidad();
$publi->ItsPubli($datos);

?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="administracion.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="Graficos.php" class="current">Anuncios</a></div>
        <div class="row-fluid">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                    <h5>Redaccion</h5>
                </div>
                <div class="widget-content nopadding">
                    <?php
                    for($i=0; $i<$publi->GetPubliSize(); $i=$i+1){
                        $proporciones[$i] = $publi->GetPubliClk($i);
                        $nombres[$i] = $publi->GetPubliName($i);
                    }
                    ?>
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="widget-box">
                                <div class="widget-title"> <span class="icon"> <i class="icon-signal"></i> </span>
                                    <h5>Pie chart</h5>
                                </div>
                                <div id="canvas-holder">

                                    <canvas id="chart-area" width="300" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            <div class="widget-box">
                                <div class="widget-title"> <span class="icon"> <i class="icon-signal"></i> </span>
                                    <h5>Line chart</h5>
                                </div>
                                <div id="canvas-holder">

                                    <canvas id="chart-bar" width="300" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Enlace</th>
                                <th>Clicks</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $tamanio = $publi->GetPubliSize();
                            for($i = 0; $i < $tamanio; $i=$i+1){

                            ?><tr class="gradeX"><?php
                                echo "<td  onCLick=\"document.location='ModificaAnuncio.php?id=$i'\">";
                                echo $publi->GetPubliName($i);
                                echo "</td>";
                                echo "<td onCLick=\"document.location='ModificaAnuncio.php?id=$i'\">";
                                echo $publi->GetPubliSrc($i);
                                echo "</td>";
                                echo "<td>";
                                echo $publi->GetPubliClk($i);
                                echo "</td>";
                                echo "</tr>";

                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <h5>Añadir Anuncio</h5>
                    <form action="../Controladores/nuevoAdd.php" method="POST" enctype="multipart/form-data">
                        <input type="text" name="titulo" id="titulotitle" placeholder="Nombre del anunciante" class="input" size="10" />
                        <input type="text" name="foto" id="titulotitle" placeholder="Url de la imagen" class="input" size="10" />
                        <input type="text" name="enlace" id="titulotitle" placeholder="Enlace" class="input" size="10" />
                        <input id="button" type="submit" name="submit" class="btn btn-success" value="Add" />
                    </form>

                    <script>
                        var proporciones = <?php echo json_encode($proporciones); ?>;
                        var nombres = <?php echo json_encode($nombres); ?>;
                        var pieData = [];
                        var total = 0;
                        for(i=0; i < proporciones.length; i++){
                            total += parseInt(proporciones[i]);
                        }
                        var actual;
                        for(i=0; i < proporciones.length; i++) {
                            actual = parseInt(proporciones[i]);
                            actual = actual*100/total;
                            pieData.push({value:parseInt(actual), color: '#'+Math.floor(Math.random()*16777215).toString(16), highlight: "black", label: nombres[i]});
                        }
                        var ctx = document.getElementById("chart-area").getContext("2d");
                        window.myPie = new Chart(ctx).Pie(pieData);

                        var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
                        var barChartData = {
                            labels : nombres,
                            datasets : [
                                {
                                    fillColor : '#'+Math.floor(Math.random()*16777215).toString(16),
                                    strokeColor : "black",
                                    highlightFill: "black",
                                    highlightStroke: "black",
                                    data : proporciones
                                }
                            ]

                        };
                        var ctx2 = document.getElementById("chart-bar").getContext("2d");
                        window.myBar = new Chart(ctx2).Bar(barChartData);
                    </script>


                </div>
            </div>
        </div>
    </div>
    <!--Footer-part-->
    <div class="row-fluid">
        <div id="footer" class="span12"> 2017 Administración de <a href="http://thegametoday.ddns.net">TheGameToday</a> </div>
    </div>
</div>
