
<script src="../../Javascript/behaviour.js"></script>


<?php
/**
 * Created by PhpStorm.
 * User: Afro
 * Date: 08/08/2017
 * Time: 11:35
 */
include "cabecera.php";
$ident = $_GET['notid'];
?>

<link rel="stylesheet" href="css/Noticia.css" />

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="administracion.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a href="Pendientes.php?selected=3" title="Go to Home" class="tip-bottom">Noticias Pendientes</a>
            <a href="ComentariosAdmin.php" class="current">Preview</a></div>
        <?php
        ini_set('display_errors', 1);
        error_reporting(E_ALL ^ E_NOTICE);
        include "../Controladores/tematica.php";

        $notis = new Noticias();
        $notis->ItsNoticias($datos);
        $tema = new Tematica();
        $tema->Inicia($datos);
        $title = $_POST['titulo'];
        $tag = $_POST['seleccion'];
        $notice = $_POST['cuerpo'];

        ?>
        <div class="row-fluid">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                    <h5>Preview</h5>
                </div>



                <div class="widget-content nopadding">
                    <table>

                    <td><form action="../Controladores/publica.php?ident=<?php echo $ident; ?>" method="post">

                        <input class="btn btn-success" id="button" type="submit" value="PUBLICAR">
                        </form></td>

                    <td><form action="../Controladores/portada.php?ident=<?php echo $ident; ?>" method="post">

                        <input class="btn btn-success" id="button" type="submit" value="PORTADA">
                        </form></td>

                    <td><form action="Redaccion.php?ident=<?php echo $ident; ?>" method="post">

                        <input class="btn btn-success" id="button" type="submit" value="CORREGIR">
                        </form></td>
                    <td>
                        <div class="despliegueEdit" id="despliegue">
                        <?php
                        if(isset($_SESSION['username'])){
                            $user = $_SESSION['username'];
                            ?>
                            <input class="btn btn-success" id="button" type="button" onclick="Show()" value="revisar"><?php } ?>
                        </div></td>
                        <td><div class="chatbox" id="chatbox" style='display:none;'>


                            <div class="chat-form">

                                <form action="../Controladores/corrector.php?url=<?php echo $_SERVER['REQUEST_URI'] ?>&ident=<?php echo $ident?>" method="post">
                                    <textarea name='texto' id="entrada" placeholder="Introduce las anotaciones..."></textarea>

                                    <input class="btn btn-success" id="boton" type="submit" value="Send">
                                </form>

                            </div>

                        </div>
                    </td>
                </table>




                    <div class="contenido">
                        <?php
                        echo "<h1>";
                        $notis->GetNoticiaTitle($ident);
                        echo "</h1>";
                        ?>

                        <?php
                        echo "<img id=\"uno\" src=../";
                        $notis->GetNoticiaImg($ident);
                        echo ">";
                        $notis->GetNoticia($ident);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> 2017 Administración de <a href="http://thegametoday.ddns.net">TheGameToday</a> </div>
</div>
</div>
