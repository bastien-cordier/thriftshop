<!-- Voila le chemin de connexion vers la base de données PhpMyAdmin, user:root & mdp:root, name:WEBVP -->
<?php
	$bdd = mysqli_connect("localhost","root","root","thriftshop");
	$bdd->set_charset("utf8");
?>