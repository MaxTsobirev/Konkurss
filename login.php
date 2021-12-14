<?php
//login vorm AB salvestatud kasutajanimega
session_start();
if(isset($_SESSION['tuvastamine'])){
    header('Location: haldus.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css";>
</head>
<body>
<h1>Login vorm</h1>
<a href="https://github.com/MaxTsobirev/phpleht">Github</a>
<form action="" method="post">
    Login:
    <input type="text" name="login" placeholder="kasutaja nimi">
    <br>
    Parool
    <input type="password" name="pass">
    <br>
    <input type="submit" value="Logi sisse">
</form>
</body>
</html>
