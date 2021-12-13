<?php
$serverinimi='localhost';
$kasutajanimi='maks20';
$parool='Qwerasdfzxcv1234';
$andmebaasinimi='maks20';
$yhendus=new mysqli($serverinimi,$kasutajanimi,$parool,$andmebaasinimi);
$yhendus->set_charset('UTF8');

/*
create table konkurss(
id int primary key AUTO_INCREMENT,
nimi varchar(50),
pilt text,
lisamisaeg datetime,
punktid int default 0,
kommentaar text,
avalik int DEFAULT 1)

*/
?>