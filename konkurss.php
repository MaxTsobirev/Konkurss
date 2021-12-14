<?php
session_start();
if(!isset($_SESSION['tuvastamine'])) {
    header('Location: login.php');
    exit();
}
require_once ('conf.php');
global $yhendus;
// punktide nulliks UPDATE
if (isset($_REQUEST['punkt'])){
    $kask=$yhendus->prepare("UPDATE konkurss SET punktid=punktid+1 WHERE id=?");
    $kask->bind_param("i",$_REQUEST['punkt']);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
}
//uuse kommentaari lisamine
if (isset($_REQUEST['uus_komment'])){
    $kask=$yhendus->prepare("UPDATE konkurss SET kommentaar=CONCAT(kommentaar, ?) WHERE id=?");
    $kommentlisa=$_REQUEST['komment']."\n";
    $kask->bind_param("si",$kommentlisa,$_REQUEST ['uus_komment']);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
}

?>
<!Doctype html>
<html lang="et">
<head>
    <title>FotoKonkurss</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<nav>
    <a href="haldus.php">Admin leht</a>
    <a href="konkurss.php">Kasutaja leht</a>
    <a href="https://github.com/MaxTsobirev/Konkurss">GITHUB</a>
</nav>
<h1>FotoKonkurss</h1>
<?php
// tabeli konkirss sisu näitamine
$kask=$yhendus->prepare("SELECT id, nimi,pilt,kommentaar, punktid FROM konkurss WHERE avalik=1");
$kask->bind_result($id, $nimi,$pilt, $kommentaar, $punktid);
$kask->execute();
echo "<table><tr><td>Nimi</td><td>pilt</td><td>Kommentaar</td><td>Punktid</td><td><td>Lisa Kommentaar</td></td></tr>";

while($kask->fetch()){
    echo "<tr><td>$nimi</td>";
    echo "<td><img src='$pilt' alt='pilt'></td>";
    echo "<td>".nl2br($kommentaar)."</td>";
    echo "<td>$punktid</td>";
    echo "<td><a href='?punkt=$id'>+1punkt</a></td>";
    echo "<td>
    <form action='?'>
        <input type='hidden' name='uus_komment' value='$id'>
        <input type='text' name='komment'>
        <input type='submit' value='OK'>
    </form></td>";

}

echo "</table>"

?>

</body>
</html>
