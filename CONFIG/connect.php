<?php
$bdd = new PDO('mysql:host=localhost;dbname=projet5;charset=utf8', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
//, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
?>