<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
	<title>Content</title>
    <?php
        ini_set('display_errors', 1);
        error_reporting(E_ALL ^ E_NOTICE);
        include "Controladores/Noticias.php";

        //$datos = new BaseDatos;
        $datos->conectar();

        $not = new Noticias();


        $vec_noticias = $not->ItsNoticias($datos);



        function PrintNoticia($arg_1, $vec_noticias, $notis)
        {
            $ident = $vec_noticias[$arg_1][0];
            echo "<article><a class=\"notice\" href='notice.php?noticia=";
            echo $ident;
            echo "'><h2><img id=\"imagen\" src=\"";
            echo $vec_noticias[$arg_1][7];
            echo "\" href=\"#\">";
            $notis->GetNoticiaTitle($ident);
            //echo $vec_noticias[$arg_1][2];
            echo "</h2></a></article>";
        }

        function PrintNoticiaDest($arg_1, $notis)
        {
            $ident = $arg_1;
            echo "<article><a class=\"notice\" href='notice.php?noticia=";
            echo $ident;
            echo "'><h2><img id=\"imagen\" src=\"";
            $notis->GetNoticiaImg($ident);
            echo "\" href=\"#\">";
            $notis->GetNoticiaTitle($ident);
            //echo $vec_noticias[$arg_1][2];
            echo "</h2></a></article>";
        }



        function PrintPortada($arg_1, $vec_noticias)
        {
            $ident = $vec_noticias[$arg_1][0];
            echo "<a class=\"notice\" href='notice.php?noticia=";
            echo $ident;
            echo "'><img id=\"imagenMain\" src=\"";
            echo $vec_noticias[$arg_1][7];
            echo "\" href=\"#\"><h2>";
            echo $vec_noticias[$arg_1][2];
            echo "</h2></a>";
        }

        ?>
</head>
<body>
    <div class="engloba">
        <div class="mainfirst">
<article id="Main">
    <?php
        $encontrada = false;
        $identifier = 0;
        $tamNotis = $not->GetNoticiasSize();
        for($i = $tamNotis-1; $i >= 0; $i = $i-1){
            if($vec_noticias[$i][8] == 1){
                $identifier = $i;
                $i = -1;
            }
        }
        PrintPortada($identifier, $vec_noticias);
    ?>
</article>


            <div>
            <?php
            $cont = 0;
            for($i = 0; $i < 3; $i = $i+1){
                $identif = $not->GetNoticiaDestacada($i);
                if($cont === 0){
                    echo "<div class=\"izquierda\">";
                    $cont = $cont+1;
                }
                else if($cont === 2){
                    echo "<div class=\"derecha\">";
                    $cont = $cont+1;
                }
                else if($cont === 1){
                    echo "<div class=\"centro\">";
                    $cont = 0;
                }
                echo "<div class=\"division\">";
                PrintNoticiaDest($identif, $not);
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
            echo "<div>";
            $cont = 0;
            for($i = 3; $i < 6; $i = $i+1){
                $identif = $not->GetNoticiaDestacada($i);
                if($cont === 0){
                    echo "<div class=\"izquierda\">";
                    $cont = $cont+1;
                }
                else if($cont === 2){
                    echo "<div class=\"derecha\">";
                    $cont = $cont+1;
                }
                else if($cont === 1){
                    echo "<div class=\"centro\">";
                    $cont = 0;
                }
                echo "<div class=\"division\">";
                PrintNoticiaDest($identif, $not);
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";


                $tamTemas = $tem->GetTemasSize();
                $cont = 0;
                for($i = 0; $i < $tamTemas; $i = $i+1){
                    if($cont === 0){
                        echo "<div class=\"izquierda\">";
                        $cont = $cont+1;
                    }
                    else if($cont === 1){
                        echo "<div class=\"derecha\">";
                        $cont = $cont+1;
                    }
                     else if($cont === 2){
                        echo "<div class=\"centro\">";
                        $cont = 0;
                    }
                    echo "<div class=\"division\">";
                    echo "<h3>";
                    echo $vec_temas[$i][0];
                    echo "</h3>";
                    $tamnoticiaPorTema = $not->GetNoticiasByTagSize($vec_temas[$i][1]);
                    if($tamnoticiaPorTema > 0) {
                        $noticias_con_este_tema = $not->GetNoticiaByTag($vec_temas[$i][1]);

                        for ($j = $tamnoticiaPorTema - 1; $j >= $tamnoticiaPorTema - 4 and $j >= 0; $j--) {
                            PrintNoticia($j, $noticias_con_este_tema, $not);
                        }
                    }
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";

            ?>


</div>
</body>
</html>