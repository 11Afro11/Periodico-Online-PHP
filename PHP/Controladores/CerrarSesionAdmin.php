<?php
session_start();
?>

<?php
/**
 * Created by PhpStorm.
 * User: afro
 * Date: 28/04/17
 * Time: 13:40
 */

$url = $_GET['url'];
session_destroy();
header("Refresh:0; url=../Administracion/LoginAdmin.php?url='$url");

?>