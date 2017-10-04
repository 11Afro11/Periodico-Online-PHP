<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$_SESSION['loggedin'] = true;
$_SESSION['username'] = $username;
$_SESSION['start'] = time();
$_SESSION['expire'] = $_SESSION['start'] + (50 * 60);

$url = $_GET['url'];
header("Refresh:0; url='../index.php");
?>