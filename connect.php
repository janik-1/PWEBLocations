<?php
		

	$hostname = "localhost";	//ou localhost
	$base= "test";
	$loginBD= "root";	//ou "root"
	$passBD="root";
	//$pdo = null;

try {

	$pdo = new PDO ("mysql:server=$hostname; dbname=$base", "$loginBD", "$passBD");
}

catch (PDOException $e) {
	die  ("Echec de connexion : " . $e->getMessage() . "\n");
}