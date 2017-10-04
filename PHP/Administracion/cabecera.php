<?php
/**
 * Created by PhpStorm.
 * User: Afro
 * Date: 08/08/2017
 * Time: 11:36
 */?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>TheGameToday Admin</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="css/fullcalendar.css" />
    <link rel="stylesheet" href="css/matrix-style.css" />
    <link rel="stylesheet" href="css/matrix-media.css" />
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/jquery.gritter.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<!--Header-part-->
<div id="header">
    <h1><a href="#">TheGameToday</a></h1>
</div>
<!--close-Header-part-->

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$dir =$_SERVER['REQUEST_URI'];

include "../modelo.php";
include "../Controladores/usuario.php";
include "../Controladores/Noticias.php";
$datos = new BaseDatos;
$datos->conectar();
$users = new Usuario();
$users->Inicia($datos);

$boss = $users->EsJefe($_SESSION['username']);

if(isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $condicion = $users->CompruebaUsuario($username, $password);
    if($condicion){
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
        unset($_POST['username']);
        unset($_POST['password']);
        $username = " ";
        $password = " ";


        //header("Refresh:0; url=$url");
    }
    else{
        echo '<script language="javascript">alert("Nombre de usuario o contraseña incorrecta");</script>';
    }

}
else if($_SESSION['loggedin'] == FALSE){
        header("Refresh:0; url=LoginAdmin.php?url='$dir");
}





$noticias = new Noticias();
$noticias->ItsNoticias($datos);
$numNoticiasPendientes = $noticias->GetNoticiasPendientesSize();
$numNoticiasPendientesCor = $noticias->GetNoticiasAcorregirSize($_SESSION['username']);
$seleccionado = $_GET['selected'];
$user = $_SESSION['username'];

?>

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <li id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome <?php echo $_SESSION['username']; ?></span></a>
        <li class=""><a title="" href="../Controladores/CerrarSesionAdmin.php?url=<?php echo $dir; ?>"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
    </ul>
</div>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<div id="search">
    <input type="text" placeholder="Search here..."/>
    <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div>
<!--close-top-serch-->
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
        <?php if($boss){ ?>
        <li <?php if($seleccionado == 0) echo "class=\"active\""; ?>><a href="administracion.php?selected=0"><i class="icon icon-home"></i> <span>Noticias</span></a> </li>
        <li <?php if($seleccionado == 1) echo "class=\"active\""; ?>> <a href="Graficos.php?selected=1"><i class="icon icon-signal"></i> <span>Anuncioss</span></a> </li>
        <li <?php if($seleccionado == 2) echo "class=\"active\""; ?>> <a href="ComentariosAdmin.php?selected=2?selected=2"><i class="icon icon-inbox"></i> <span>Comentarios</span></a> </li>
        <li <?php if($seleccionado == 3) echo "class=\"active\""; ?>><a href="Redaccion.php?selected=3"><i class="icon icon-th"></i> <span>Redaccion</span></a></li>
        <li <?php if($seleccionado == 4) echo "class=\"active\""; ?>><a href="Organizacion.php?selected=4"><i class="icon icon-fullscreen"></i> <span>Organización</span></a></li>
        <li <?php if($seleccionado == 5) echo "class=\"active\""; ?>> <a href="Pendientes.php?selected=5"><i class="icon icon-th-list"></i> <span>Pendientes</span> <span class="label label-important"><?php if($numNoticiasPendientes > 0)echo $numNoticiasPendientes; ?></span></a></li>

        <li <?php if($seleccionado == 6) echo "class=\"active\""; ?>><a href="Usuarios.php?selected=6"><i class="#"></i> <span>Usuarios</span></a></li>
            <li <?php if($seleccionado == 7) echo "class=\"active\""; ?>><a href="AdministracionTemas.php?selected=7"><i class="#"></i> <span>Temas</span></a></li>
        <?php }else{ ?>
        <li <?php if($seleccionado == 0) echo "class=\"active\""; ?>><a href="administracion.php?selected=0"><i class="icon icon-home"></i> <span>Noticias</span></a> </li>
        <li <?php if($seleccionado == 3) echo "class=\"active\""; ?>><a href="Redaccion.php?selected=3"><i class="icon icon-th"></i> <span>Redaccion</span></a></li>
            <li <?php if($seleccionado == 5) echo "class=\"active\""; ?>> <a href="PendienteCorreccion.php?selected=5"><i class="icon icon-th-list"></i> <span>Pendientes</span> <span class="label label-important"><?php if($numNoticiasPendientesCor > 0)echo $numNoticiasPendientesCor; ?></span></a></li>
        <?php }?>

    </ul>
</div>
</body>
