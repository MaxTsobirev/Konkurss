<!Doctype html>
<html lang="et">
<head>
    <title>FotoKonkurssi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
<body>
<nav>
    <a href="haldus.php">Admin leht</a>
    <a href="konkurss.php">Kasutaja leht</a>
    <a href="https://github.com/MaxTsobirev/Konkurss">GITHUB</a>
</nav>
<h1>FotoKonkurssi halduseleht</h1>
<h2>Uue pilti lisamine konkurssi</h2>
<form action="?">
    <input type="text" name="nimi" placeholder="uus nimi">
    <br>
    <textarea name="pilt">pildi linki aadress</textarea>
    <br>
    <input type="submit" value="Lisa">
<?php
require_once ('conf.php');
global $yhendus;
//nimi lisamine konkurssi
if (isset($_REQUEST['nimi'])){
    $kask=$yhendus->prepare("INSERT INTO konkurss(nimi, pilt, lisamisaeg)values(?,?, NOW())");
    $kask->bind_param("ss",$_REQUEST['nimi'],$_REQUEST['pilt']);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
}
?>