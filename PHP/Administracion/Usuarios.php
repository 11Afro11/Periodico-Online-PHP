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
                        <th>Nombre</th>
                        <th>correo</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    for($i = 0; $i < $users->GetUsersSize(); $i=$i+1){
                        $nom = $users->UserGetNombre($i);
                        if ($users->EsRedactor($nom)){
                        ?>
                        <tr class="gradeX"><?php
                            echo "<td>";
                            echo $users->UserGetNombre($i);
                            echo "</td>";
                            echo "<td>";
                            echo $users->UserGetMail($i);
                            echo "</td>";
                            echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Usuarios</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>correo</th>
                        <th>Upgrade</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    for($i = 0; $i < $users->GetUsersSize(); $i=$i+1){
                    $nom = $users->UserGetNombre($i);
                    if (!$users->EsRedactor($nom) && !$users->EsJefe($nom)){
                    ?>
                    <tr class="gradeX"><?php
                        echo "<td>";
                        echo $users->UserGetNombre($i);
                        echo "</td>";
                        echo "<td>";
                        echo $users->UserGetMail($i);
                        echo "</td>";

                        echo "<td onCLick=\"document.location='../Controladores/upgradeUser.php?id=$i'\">";
                        echo "Upgrade";
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
