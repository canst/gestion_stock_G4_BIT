<?php 
$bdd = new PDO('mysql:host = localhost; dbname = gs','root','');// connection a la base de donnees
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);//afficher precisement ou se trouve lerreur avec plus de precision
 ?>
