<?php
/**
 * Created by PhpStorm.
 * User: Afro
 * Date: 08/08/2017
 * Time: 11:35
 */

include "cabecera.php";
include "../Controladores/publicidad.php";


?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="administracion.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_NOTICE);
    include "../Controladores/tematica.php";

    $publi = new Publicidad();
    $publi->ItsPubli($datos);
    $anun = $_GET['id'];
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
                        <th><?php echo $publi->GetPubliName($anun);?></th>
                        <th><?php echo $publi->GetPubliSrc($anun);?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    echo "<td>";
                    ?>
                    <div class="chat-form">

                        <form action="../Controladores/ModificarAnuncioNombre.php?id=<?php echo $anun ?>" method="post">
                            <textarea name='texto' id="entrada" placeholder="Nuevo Nombre"></textarea>

                            <input class="btn btn-success" id="boton" type="submit" value="Send">
                        </form>

                    </div>
                    <?php
                    echo "</td>";
                    echo "<td>";
                    ?>
                    <div class="chat-form">

                        <form action="../Controladores/ModificarAnuncioEnlace.php?id=<?php echo $anun ?>" method="post">
                            <textarea name='texto' id="entrada" placeholder="Nuevo Nombre"></textarea>

                            <input class="btn btn-success" id="boton" type="submit" value="Send">
                        </form>

                    </div>
                    <?php
                    echo "</td>";
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
