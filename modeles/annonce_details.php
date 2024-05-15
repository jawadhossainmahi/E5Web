<?php
// Import des fichiers nécessaires
require_once "controleurs/controleur.php";

// Instanciation du contrôleur
$controleur = new controleur();

// Vérification de l'existence du paramètre d'ID d'annonce
if(isset($_GET['id'])) {
    // Récupération de l'ID de l'annonce depuis l'URL
    $idAnnonce = $_GET['id'];
    // Appel de la méthode pour afficher les détails de l'annonce
    $controleur->afficherDetailsAnnonce($idAnnonce);
} else {
    // Redirection vers la page d'accueil si l'ID de l'annonce n'est pas spécifié
    header("Location: index.php?action=accueil");
    exit;
}
?>
