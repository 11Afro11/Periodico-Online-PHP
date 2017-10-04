<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>The Game Today</title>
    <link rel="stylesheet" href="../CSS/Menu.css">
    <link rel="stylesheet" href="../CSS/Social.css">
    <link rel="stylesheet" href="../CSS/MainStyle.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/Principal.css">
    <link rel="stylesheet" href="../CSS/chatbox-style.css">
    <link rel="stylesheet" href="../CSS/texto.css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="../Javascript/behaviour.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({
            selector:'textarea',
            height:"550px",
            width:"100%",
            position:"relative"
        });</script>


</head>

<body>
<header>
    <?php
    include "header.php";
    ?>
</header>



<!-- Fin del menu desplegable -->


<!-- Imagen de portada con el titulo del periodico -->
<a href="../index.php">
    <img id="Portada" src="../Imagenes/Portada.png">
</a>
<!-- fin de portada -->

<!-- Articulo principal -->


<?php
/**
 * Created by PhpStorm.
 * User: afro
 * Date: 17/04/17
 * Time: 18:37
 */
include "Controladores/comentarios.php";
include "Controladores/Noticias.php";
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);

$base = new BaseDatos();
$base->conectar();
$id = $_GET['noticia'];
$notis = new Noticias();
$notis->ItsNoticias($base);
?>
<div class="mainbox">
    <div class="engloba">
        <div class="mainfirst">

            <form accept-charset="utf-8" method="POST">
                <input type="text" name="busqueda" id="busqueda" value="" placeholder="" maxlength="30" autocomplete="off" onKeyUp="buscar();" /> <a id="busc">Busca Noticia</a>
            </form>
            <div id="resultadoBusqueda"></div>



            <script>


                String.prototype.splice = function(idx, rem, str) {
                    return this.slice(0, idx) + str + this.slice(idx + Math.abs(rem));
                };

                function deprueba(actual){
                    textoBusqueda = $("input#busqueda").val();
                    $("actual:contains(textoBusqueda)").css("background-color: #00abf0");
                    return actual;
                }

                function resaltar(actualVec){
                    textoBusqueda = $("input#busqueda").val();
                    resalt = actualVec;
                    busc = actualVec.toLowerCase();
                    numeroLetras = textoBusqueda.length;
                    hacheuno = busc.indexOf("<h2>");

                    tope = busc.indexOf("</h2>");
                    posicion = busc.indexOf(textoBusqueda, hacheuno+4);
                    if(posicion < tope) {
                        resalt = resalt.splice(posicion + numeroLetras, 0, "</span>");
                        resalt = resalt.splice(posicion, 0, "<span id='resaltado'>");
                        busc = busc.splice(posicion + numeroLetras, 0, "</span>");
                        busc = busc.splice(posicion, 0, "<span id='resaltado'>");
                    }
                    hacheuno = busc.indexOf("<h2>", tope);
                    tope = busc.indexOf("</h2>", hacheuno);
                    while(hacheuno != -1){
                        posicion = busc.indexOf(textoBusqueda, hacheuno+4);
                        if(posicion < tope) {
                            resalt = resalt.splice(posicion + numeroLetras, 0, "</span>");
                            resalt = resalt.splice(posicion, 0, "<span id='resaltado'>");
                            busc = busc.splice(posicion + numeroLetras, 0, "</span>");
                            busc = busc.splice(posicion, 0, "<span id='resaltado'>");
                        }
                        hacheuno = busc.indexOf("<h2>", tope);
                        tope = busc.indexOf("</h2>", hacheuno);
                    }

                    return resalt;
                };


                $(document).ready(function() {
                    $.ajax({
                        async:false,
                        cache:false,
                        dataType:"html",
                        type: 'POST',
                        url: "listarNoticias.php",
                        success:  function(respuesta){
                            $("#resultadoBusqueda").html(respuesta);
                        },
                        beforeSend:function(){},
                        error:function(objXMLHttpRequest){}
                    });
                });

                function buscar() {
                    var textoBusqueda = $("input#busqueda").val();

                    if (textoBusqueda != "") {
                        $.ajax({
                            async:true,
                            cache:false,
                            dataType:"html",
                            type: 'POST',
                            url: "buscar.php",
                            data: "valorBusqueda="+textoBusqueda,
                            success:  function(respuesta){
                                $("#resultadoBusqueda").html(respuesta);
                            },
                            beforeSend:function(){},
                            error:function(objXMLHttpRequest){}
                        });
                    } else {
                        $.ajax({
                            async:false,
                            cache:false,
                            dataType:"html",
                            type: 'POST',
                            url: "listarNoticias.php",
                            success:  function(respuesta){
                                $("#resultadoBusqueda").html(respuesta);
                            },
                            beforeSend:function(){},
                            error:function(objXMLHttpRequest){}
                        });
                    };
                };
            </script>


        </div>
        <?php
        include "sidebar.php";
        echo "</div>";
        echo "</div>";

        ?>



</body>