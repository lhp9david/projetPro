<?php
function connect_bd(){
	$dsn="mysql:dbname=".'project'.";host=".'localhost';
		try{
		$connexion=new PDO($dsn,'root','');
		}
		catch(PDOException $e){
		printf("Échec de la connexion : %s\n", $e->getMessage());
		exit();
		}
	return $connexion;
}
?>