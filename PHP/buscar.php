
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
$consultaBusqueda = $_POST['valorBusqueda'];
?>
<script type="text/javascript">
    String.prototype.splice = function(idx, rem, str) {
        return this.slice(0, idx) + str + this.slice(idx + Math.abs(rem));
    };

    function resaltar(actualVec){
        var resalt = actualVec;
        var numeroLetras = '<?php echo $consultaBusqueda;?>'.length;
        var posicion = resalt.indexOf('<?php echo $consultaBusqueda;?>');
        //resalt = resalt.splice(posicion, 0, "<span id='resaltado'>");
        resalt = resalt.splice(posicion+numeroLetras, 0, "</span>");
        resalt = resalt.splice(posicion, 0, "<span id='resaltado'>");

        return resalt;
    };
</script>



<?php
//Archivo de conexión a la base de datos
include "modelo.php";
include "Controladores/Noticias.php";
$base = new BaseDatos();
$base->conectar();
$notis = new Noticias();
$notis->ItsNoticias($base);
include "Controladores/usuario.php";
$users = new Usuario();
$users->Inicia($base);
session_start();
$boss = $users->EsJefe($_SESSION['username']);
$redactor = $users->EsRedactor($_SESSION['username']);


function PrintPortada($arg_1, $vec_noticias)
{
    $ident = $vec_noticias[$arg_1][0];
    echo "<div id=display>";
    echo "<a class=\"notice\" href='revisionNoticia.php?noticia=";
    echo $ident;
    echo "'><h2><img id=\"imagenMain\" src=\"";
    echo $vec_noticias[$arg_1][7];
    echo "\" href=\"#\">";
    echo $vec_noticias[$arg_1][2];
    echo "<h4 id='subti'>";
    echo $vec_noticias[$arg_1][3];
    echo "</h4>";
    echo "</h2></a>";
    echo "</div>";
}

function PrintErr()
{
    echo "<div id=display>";
    echo "<a class=\"notice\" href=#";
    echo "><h2><img id=\"imagenMain\" src=\"../Imagenes/err.jpg\"";
    echo "\" href=\"#\">";
    echo "No existe ninguna noticia con esos criterios";
    echo "</h2></a>";
    echo "</div>";
}

//Variable de búsqueda


//Filtro anti-XSS
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);

//Variable vacía (para evitar los E_NOTICE)
$mensaje = "";


//Comprueba si $consultaBusqueda está seteado
if (isset($consultaBusqueda)) {

    //Selecciona todo de la tabla mmv001
    //donde el nombre sea igual a $consultaBusqueda,
    //o el apellido sea igual a $consultaBusqueda,
    //o $consultaBusqueda sea igual a nombre + (espacio) + apellido

    if($boss or $redactor){
        $noticias = $notis->BuscarNoticias($consultaBusqueda);


        //Obtiene la cantidad de filas que hay en la consulta
        $filas = $notis->BuscarNoticiasRow($consultaBusqueda);
    }
    else{
        $noticias = $notis->BuscarNoticiasPublicadas($consultaBusqueda);


        //Obtiene la cantidad de filas que hay en la consulta
        $filas = $notis->BuscarNoticiasRowPublicadas($consultaBusqueda);
    }


    //Si no existe ninguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
    if ($filas === 0) {
        PrintErr();
    } else {
        //Si existe alguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
        echo 'Resultados para <strong>'.$consultaBusqueda.'</strong>';

        //La variable $resultado contiene el array que se genera en la consulta, así que obtenemos los datos y los mostramos en un bucle>

        for($i=0; $i < $filas; $i++){
            PrintPortada($i, $noticias, $actualVec);
        }

    }; //Fin else $filas

};//Fin isset $consultaBusqueda

?>