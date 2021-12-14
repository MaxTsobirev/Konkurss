<?php
session_start();
if(!isset($_SESSION['tuvastamine'])) {
    header('Location: login.php');
    exit();
}
require_once ('conf.php');
global $yhendus;
// punktide lisamine UPDATE
if (isset($_REQUEST['punkt'])){
    $kask=$yhendus->prepare("UPDATE konkurss SET punktid=0 WHERE id=?");
    $kask->bind_param("i",$_REQUEST['punkt']);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
}
// kommentaar lisamine UPDATE
if (isset($_REQUEST['kommentaar'])){
    $kask=$yhendus->prepare("UPDATE konkurss SET kommentaar=0 WHERE id=?");
    $kask->bind_param("i",$_REQUEST['kommentaar']);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
}
//nimi lisamine konkurssi
if (isset($_REQUEST['nimi'])){
    $kask=$yhendus->prepare("INSERT INTO konkurss(nimi, pilt, lisamisaeg)values(?,?, NOW())");
    $kask->bind_param("ss",$_REQUEST['nimi'],$_REQUEST['pilt']);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
}
// nimi näitamine avalik=1 UPDATE
if (isset($_REQUEST['avamine'])){
    $kask=$yhendus->prepare("UPDATE konkurss SET avalik=1 WHERE id=?");
    $kask->bind_param("i",$_REQUEST['avamine']);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
}
// nimi peitmine avalik=0 UPDATE
if (isset($_REQUEST['peitmine'])){
    $kask=$yhendus->prepare("UPDATE konkurss SET avalik=0 WHERE id=?");
    $kask->bind_param("i",$_REQUEST['peitmine']);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
}
//kustutamine
if (isset($_REQUEST['kustuta'])){
    $kask=$yhendus->prepare("DELETE FROM konkurss WHERE id=?");
    $kask->bind_param("i",$_REQUEST['kustuta']);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
}
?>
<!Doctype html>
<html lang="et">
<head>
    <title>FotoKonkurssi halduseleht</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<nav>
    <a href="lisamine.php">Lisamine</a>
    <a href="haldus.php">Admin leht</a>
    <a href="konkurss.php">Kasutaja leht</a>
    <a href="https://github.com/MaxTsobirev/Konkurss">GITHUB</a>
</nav>
<h1>FotoKonkurssi halduseleht</h1>
<?php
// tabeli konkirss sisu näitamine
$kask=$yhendus->prepare("SELECT id, nimi,pilt, lisamisaeg, punktid, avalik FROM konkurss");
$kask->bind_result($id, $nimi,$pilt, $aeg, $punktid,$avalik);
$kask->execute();
echo "<table><tr><td>Nimi</td><td>pilt</td><td>Lisamisaeg</td><td>Punktid</td></tr>";

while($kask->fetch()){
    echo "<tr><td>$nimi</td>";
    echo "<td><img src='$pilt' alt='pilt'></td>";
    echo "<td>$aeg</td>";
    echo "<td>$punktid</td>";
    echo "<td><a href='?punkt=$id'>Punktid nulliks</a></td>";
    echo "<td><a href='?kommentaar=$id'>Kommentaar nulliks</a></td>";
    //Peida-näita
    $avatekst="Ava";
    $param="avamine";
    $seisund="Peidetud";
    if($avalik==1){
        $avatekst="Peida";
        $param="peitmine";
        $seisund="Avatud";
    }
    echo "<td>$seisund</td>";
    echo "<td><a href='?$param=$id'>$avatekst</a></td>";
    echo "<td><a href='?kustuta=$id'>kustuta</a></td>";


    echo "</tr>";
}
echo "</table>"

?>

</body>
</html>
