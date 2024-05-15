<?php 
class controleur{
    public function accueil(){
        $lesAnnonces = array();
        $lesAnnonces = (new annonces)->getAllAnnonces();
        $lesPhotos = (new photo)->getAllPhoto();
        (new vue)->accueil($lesAnnonces, $lesPhotos);
    }

   
        public function connexion() {
            if (isset($_POST["ok"])) {
                $mdp = $_POST['motdepasse'];
                $email = htmlspecialchars($_POST['email']);
                if((new utilisateurs)->connexion($email, $mdp)){
                    $this->accueil();
                }else{
                    $message = 'Mauvais login/mot de passe';
                    (new vue)->connexion($message);
                }

        }else{
            (new vue)->connexion();
        }
    }

        public function inscription() {
            (new vue)->inscription();
            if(isset($_POST['ok'])){
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $mail = $_POST['email'];
                $mdp = $_POST['motdepasse'];
                if(!empty($nom and $prenom and $mail and $mdp)){
                    if((new utilisateurs)->inscription($nom, $prenom, $mail, $mdp)==true){
                        header("Location: index.php?action=connexion");
                    }else{
                        $message = "un probleme est survenu lors de l'inscription";
                        (new vue)->inscription($message);
                    }
                    

                }
                
            }

        }

        public function annulerReservationAnnonce($idAnnonce) {
            // Vérifier si l'utilisateur est connecté
            if(isset($_SESSION['connexion'])) {
                // Récupérer l'ID de l'utilisateur connecté
                $idUtilisateur = $_SESSION['connexion'];
                // Appeler la méthode pour annuler la réservation
                (new reservation)->annuleReservation($idUtilisateur);
                // Redirection vers la page des détails de l'annonce
                header("Location: index.php?action=annonce_details&id=$idAnnonce");
                exit;
            } else {
                // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
                header("Location: index.php?action=connexion");
                exit;
            }
        }
        
        public function afficherTypesLogement() {
            // Récupérer les types de logement depuis la base de données
            $typesLogement = (new type)->getAllTypes();
            // Afficher la vue des types de logement
            (new vue)->typesLogement($typesLogement);
        }
        

        public function afficherDetailsAnnonce($idAnnonce) {
            // Récupérer les détails de l'annonce
            $detailsAnnonce = (new annonces)->getUneAnnonce($idAnnonce);
            if(empty($detailsAnnonce)) {
                // Rediriger vers la page d'accueil si l'annonce n'existe pas
                header("Location: index.php?action=accueil");
                exit;
            }
        
            // Récupérer les photos de l'annonce
            $photosAnnonce = (new photo)->getPhoto($idAnnonce);
        
            // Récupérer les périodes de réservation disponibles pour l'annonce
            $periodesReservation = (new periode)->getPeriode($idAnnonce);
        
            // Afficher la vue des détails de l'annonce
            (new vue)->detailsAnnonce($detailsAnnonce, $photosAnnonce, $periodesReservation);
        }

        public function ajouterPhotosAnnonce($idAnnonce) {
            // Vérifier si des fichiers ont été téléchargés
            if(isset($_FILES['photos']) && !empty($_FILES['photos']['name'])) {
                // Définir le dossier de destination pour les téléchargements
                $dossierDestination = "photos/";
                // Parcourir les fichiers téléchargés
                foreach($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
                    // Vérifier si le fichier est une image
                    if(getimagesize($_FILES['photos']['tmp_name'][$key])) {
                        // Générer un nom de fichier unique pour éviter les doublons
                        $nomFichier = uniqid() . '_' . basename($_FILES['photos']['name'][$key]);
                        // Déplacer le fichier téléchargé vers le dossier de destination
                        move_uploaded_file($_FILES['photos']['tmp_name'][$key], $dossierDestination . $nomFichier);
                        // Enregistrer le chemin de l'image dans la base de données
                        (new photo)->ajoutPhoto($dossierDestination . $nomFichier);
                    }
                }
                // Redirection vers la page des détails de l'annonce
                header("Location: index.php?action=annonce_details&id=$idAnnonce");
                exit;
            }
        }
        

        public function annonces(){

            $id = $_GET['id'];
            $ID = $_GET['ID'];
            
            $uneAnnonce = array();
            $uneReservation = array();
            $lesPhotos = (new photo)->getPhoto($id);
            $uneAnnonce = (new annonces)->getUneAnnonce($ID);
            $uneReservation = (new periode)->getPeriode($id);
            
            if(isset($_POST['reserver'])){
                $selectionnerDate = $_POST['selectionner'];
                
               $date = explode(', ', $selectionnerDate);
         
                
                $prix = $uneReservation[0]['prix'];
                (new reservation)->ajoutReservation($_SESSION['connexion'], $id, $prix,$date[0], $date[1]);
                (new vue)->uneAnnonce($uneAnnonce, $lesPhotos, $uneReservation);
            }else{
                (new vue)->uneAnnonce($uneAnnonce, $lesPhotos, $uneReservation);
            }
            
        }

        public function afficherAppartement(){
            $id = 1;
            $lesLogements = array();
            $lesPhotos = (new photo)->getAllPhoto();
            $lesLogements = (new annonces)->getAnnonces($id);
        

            (new vue)->appartement($lesLogements, $lesPhotos);
        }

        public function afficherMaison(){
            $id = 2;
            $lesLogements = array();
            $lesPhotos = (new photo)->getAllPhoto();
            $lesLogements = (new annonces)->getAnnonces($id);
            (new vue)->maison($lesLogements, $lesPhotos);
            
        }

        public function profilProprio(){
            $utilisateurs = array();
            $annonces = array();
            $lesPhotos = (new photo)->getAllPhoto();
            $utilisateurs = (new utilisateurs)->getInfo($_SESSION['connexion']);
            $annonces = (new annonces)->getAnnonceProprio($_SESSION['connexion']);
            (new vue)->profilProprio($utilisateurs, $annonces, $lesPhotos, null);

            foreach($annonces as $annonce){
                
                if(isset($_POST[$annonce['ID_Logements']])){
                    $dateDebut = htmlspecialchars($_POST['debutDate']);
                    $finDate = htmlspecialchars($_POST['finDate']);
                    $id =$annonce['ID_Logements'];
                    var_dump($id);
                    if((new periode)->ajouterPeriode($id, $dateDebut, $finDate)){
                        $message = "Periode de réservations bien ajouter !";
                    }else{
                        (new vue)->profilProprio($utilisateurs, $annonces, $lesPhotos, $message);
                        $message = "Un probleme est survenu";
                    }
                }
            }
            
        }


        public function ajouterPeriode(){
            $annonces = array();
            $lesPhotos = (new photo)->getAllPhoto();
            $erreur = null;
            $succes = null;
            $annonces = (new annonces)->getAnnonceProprio($_SESSION['connexion']);
            

            foreach($annonces as $annonce){
                if(isset($_POST[$annonce['ID_Logements']])){
                    $dateDebut = htmlspecialchars($_POST['debutDate']);
                    $finDate = htmlspecialchars($_POST['finDate']);
                    $prix = htmlspecialchars($_POST['prix']);
                    $id =$annonce['ID_Logements'];
                    if(empty($prix) || empty($dateDebut) || empty($finDate)){
                        $erreur = "Veuillez remplir tous les champs !";
                    }else{
                        if($dateDebut > $finDate){
                            $erreur = "La date de début ne peut pas être supérieur a la date de fin";
                        }else{

                            if((new periode)->ajouterPeriode($id, $dateDebut, $finDate, $prix)){
                                $succes = "Periode de réservations bien ajoutée !";
                            }else{
                                $erreur = "Un probleme est survenu";
                            }
                        }
                    }  
                }
            }
            (new vue)->ajouterPeriode($annonces, $lesPhotos, $erreur, $succes);
            
        }


        public function deconnexion(){
            (new utilisateurs)->deconnexion();
            header('Location: index.php?action=accueil');
        }
    }


?>