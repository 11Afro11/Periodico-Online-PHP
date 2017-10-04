<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>The Game Today</title>
    <link rel="stylesheet" href="../CSS/Menu.css">
    <link rel="stylesheet" href="../CSS/Social.css">
    <link rel="stylesheet" href="../CSS/MainStyle.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/chatbox-style.css">
    <script src="../Javascript/behaviour.js"></script>
    <meta name="viewport" content="width-device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
</head>

<body onload="redimensionar()">

<?php
include "header.php";
?>

<div class="mainbox">
    <?php
    include "content.php";
    include "sidebar.php";
    ?>
</div>

<?php
include "foother.php";
?>


</body>
