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
        <div id="breadcrumb"> <a href="administracion.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="ComentariosAdmin.php" class="current">Comentarios</a></div>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_NOTICE);
    include "../Controladores/comentarios.php";

    $notis = new Noticias();
    $notis->ItsNoticias($datos);
    $com = new Comentarios();
    $com->Inicializa($datos, 0);
    ?>

    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Comentarios</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Autor</th>
                        <th>Texto</th>
                        <th>Borrar</th>
                        <th>Modificar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tamanio = $com->Marcapaginas();
                    for($i = 0; $i < $tamanio+1; $i=$i+1){
                        $au = $com->GetComentNameOrden($i);
                        if(!empty($au)) {
                            echo "<tr class=\"gradeA\">";
                            echo "<td>";
                            echo $com->GetComentDateOrden($i);
                            echo "</td>";
                            echo "<td>";
                            echo $au;
                            echo "</td>";
                            echo "<td>";
                            echo $com->GetComentTextOrden($i);
                            echo "</td>";
                            echo "<td onCLick=\"document.location='../Controladores/BorraComentario.php?id=$i'\">";
                            echo "Borrar</td>";
                            echo "<td>";
                            ?>
                            <div class="chat-form">

                            <form action="../Controladores/ModificaComentario.php?id=<?php echo $i ?>" method="post">
                                <textarea name='texto' id="entrada" placeholder="Nuevo comentario"></textarea>

                                <input class="btn btn-success" id="boton" type="submit" value="Send">
                            </form>

                        </div><?php
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
</div>
