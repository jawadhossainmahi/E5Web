<?php
session_start();

//connexion a la base

$config = parse_ini_file("base.ini");
try {
	$pdo = new \PDO("mysql:host=".$config["host"].";dbname=".$config["database"].";charset=utf8", $config["user"], $config["password"]);
} catch(Exception $e) {
	echo "<h1>Erreur de connexion à la base de données :</h1>";
	echo $e->getMessage();
	exit;
}

require("vues/vue.php");
require("controleurs/controleur.php");
require("modeles/utilisateurs.php");
require("modeles/annonces.php");
require("modeles/logement.php");
require("modeles/photo.php");
require("modeles/periode.php");
require("modeles/reservation.php");



if(isset($_GET["action"])) {
	switch($_GET["action"]) {
		case "accueil":
			(new controleur)->accueil();
			break;

		case "connexion":
			(new controleur)->connexion();
			break;

		case "inscription":
			(new controleur)->inscription();
			break;
		case "deconnexion":
			(new controleur)->deconnexion();
			break;
		case "annonces":
			(new controleur)->annonces();
			break;
		case "afficherAppartement":
			(new controleur)->afficherAppartement();
			break;
		case "afficherMaison":
			(new controleur)->afficherMaison();
			break;
		case "profil":
			(new controleur)->profilProprio();
			break;
		case "modifier":
			(new controleur)->modifierPeriode();
			break;
		case "ajouter":
			(new controleur)->ajouterPeriode();
			break;
		case "supprimer":
			(new controleur)->supprimerPeriode();
			break;	
    }
}else{
    (new controleur)->accueil();
}
?>