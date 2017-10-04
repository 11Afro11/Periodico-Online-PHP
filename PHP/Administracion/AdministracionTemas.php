<?php
/**
 * Created by PhpStorm.
 * User: Afro
 * Date: 08/08/2017
 * Time: 11:35
 */

include "cabecera.php";
include "../Controladores/tematica.php";
$tem = new Tematica();
$tem->Inicia($datos);


?>
<div id="content">
    <div id="content-header">
        <div id="content-header">
            <div id="breadcrumb"> <a href="administracion.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="AdministracionTemas.php" class="current">Temas</a></div>
    </div>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_NOTICE);
    ?>
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Redactores</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>Tema</th>
                        <th>Cambiar</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    for($i = 0; $i < $tem->GetTemasSize(); $i=$i+1){
                    $nom = $tem->GetTema($i);
                    if (!empty($nom)){
                    ?>
                    <tr class="gradeX"><?php
                        echo "<td onCLick=\"document.location='NoticiasPorTema.php?tem=$i&selected=7'\">";
                        echo $nom;
                        echo "</td>";
                        echo "<td>";
                        ?>
                        <div class="chat-form">

                            <form action="../Controladores/ModificarTema.php?id=<?php echo $i ?>&ident=<?php echo $ident?>" method="post">
                                <textarea name='texto' id="entrada" placeholder="Nuevo Nombre"></textarea>

                                <input class="btn btn-success" id="boton" type="submit" value="Send">
                            </form>

                        </div>
                        <?php
                        echo "</td>";
                        ?><td onCLick="document.location='../Controladores/BorraTema.php?id=<?php echo $i; ?>'"><?php
                        echo "Eliminar</td>";
                        echo "</tr>";
                        }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <h5>Añadir Tema</h5>
            <form action="../Controladores/nuevoTema.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="titulo" id="titulotitle" placeholder="Nombre del tema" class="input" size="10" />
                <input id="button" type="submit" name="submit" class="btn btn-success" value="Add" />
            </form>
        </div>
    </div>
</div>
<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> 2017 Administración de <a href="http://thegametoday.ddns.net">TheGameToday</a> </div>
</div>
</div>
