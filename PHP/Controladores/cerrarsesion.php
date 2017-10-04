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

session_destroy();
$url = $_GET['url'];
header("Refresh:0; url=../../index.php");

?>