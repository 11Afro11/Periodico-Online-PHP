<!DOCTYPE html>
<html>
<head>
	<title>Foother</title>
    <link rel="stylesheet" href="../CSS/sidde.css">
    <script>

    </script>
</head>
<body onload='redimensionar()'>
<div class="lateral">
    <h2 id="subtitle">Te Puede Interesar</h2>

    <?php
    function PrintNoticiaN($arg_1, $vec_noticias, $notis)
    {
        $ident = $vec_noticias[$arg_1][0];
        echo "<article><a id=\"relacionado\" class=\"notice\" href='notice.php?noticia=";
        echo $ident;
        echo "'><h2><img id=\"imagen\" src=\"";
        echo $vec_noticias[$arg_1][7];
        echo "\" href=\"#\">";
        $notis->GetNoticiaTitle($ident);
        //echo $vec_noticias[$arg_1][2];
        echo "</h2></a></article>";
    }

    include "Controladores/publicidad.php";
    $publi = new Publicidad();
    $publi->ItsPubli($datos);
    function AddClick($id, $publicidad){
        $publicidad->AddClick($id);
    }


    $tamanio = $publi->GetPubliSize();
    $random = rand(0, $tamanio-1);
    do{
        $random2 = rand(0, $tamanio-1);
    }while($random2 == $random);
        ?>
    <a href="Controladores/Pulsacion.php?id=<?php echo $random;?>" target="_blank"><img id="anuncio" src="<?php $publi->GetPubliImg($random);?>"></a>
    <a href="Controladores/Pulsacion.php?id=<?php echo $random2;?>" target="_blank"><img id="anuncio" src="<?php $publi->GetPubliImg($random2);?>"></a><?php
    if($id != NULL) {
        $theme = $tem->GetSpecificTheme($id);
        $notices = $notis->GetNoticiaByTagLess($theme, $id);
        $iterac = $notis->GetNoticiasSizeByTagLess($theme, $id);

        for ($i = 0; $i < 2 && $i < $iterac; $i++) {
            PrintNoticiaN($i, $notices, $notis);
        }
    }


    ?>

    <?php
    $datos->desconectar();
    ?>





</div>
</body>
</html>
