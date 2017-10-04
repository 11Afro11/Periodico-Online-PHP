<?php
/**
 * Created by PhpStorm.
 * User: afro
 * Date: 4/05/17
 * Time: 16:41
 */

    ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_NOTICE);
    include "../modelo.php";
    include "usuario.php";
    $base = new BaseDatos();
    $base->conectar();
    $usuario = new Usuario();
    $usuario->Inicia($base);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];


    if($usuario->BuscaUsuario($username)){
        unset($_POST['username']);
        unset($_POST['password']);
        unset($_POST['email']);
        echo '<script language="javascript">alert("Nombre de usuario en uso");</script>';
        header("Location:".$_SERVER['HTTP_REFERER']);

    }
    else {


        unset($_POST['username']);
        unset($_POST['password']);
        unset($_POST['email']);


        $salt = md5($password);
        $pasword_encriptado = crypt($password, $salt);


        $usuario->AniadeUsuario($username, $pasword_encriptado, $email);
        $url = $_GET['url'];
        header("Refresh:0; url=$url");
    }
?>