<?php 
    class vue {
        public function entete(){
            echo "
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset='UTF-8'>
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
                <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN\" crossorigin=\"anonymous\">
                <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css\">
                <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css\">
                <link rel=\"stylesheet\" href=\"css/boostrap-grid.css\">
                <link rel=\"stylesheet\" href=\"css/bootstrap.min.css\">
                <link rel=\"stylesheet\" href=\"css/bootstrap.css\">
                
                <link rel=\"stylesheet\" type=\"text/css\" href=\"css/table.css\">
                <script src=\"https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js\" ></script>
                <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js\" integrity=\"sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT\" crossorigin=\"anonymous\"></script>
                <script src=\"https://code.jquery.com/jquery-3.5.1.slim.min.js\"></script>
                <script src=\"https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js\"></script>
                <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js\"></script>
                <script src=\"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js\"></script>
                <script src=\"js/reservation.js\"></script>
                <link rel=\"stylesheet\" href=\"css/style.css\">
                <title>IMMO_WEB</title>
            </head>
            <body>
                <nav class=\"navbar navbar-expand-lg navbar-dark bg-dark\">
                    <a class=\"navbar-brand\" href=\"#\">IMMO_WEB</a>
                    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                        <span class=\"navbar-toggler-icon\"></span>
                    </button>
                    <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
                        <ul class=\"navbar-nav mr-auto\">
                            <li class=\"nav-item\">
                                <a class=\"nav-link\" href=\"index.php?action=accueil\">
                                    Accueil
                                </a>
                            </li>
                            
                            <li class=\"nav-item dropdown\">
                                <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
        ";
        
        if(isset($_SESSION["connexion"])) {
            echo "
            </ul>
            <ul class='navbar-nav ml-auto'>
                <li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle' role='button' data-bs-toggle='dropdown' aria-expanded='false'>".$_SESSION["user"]."
                    </a>
                    <ul class='dropdown-menu dropdown-menu-right custom-dropdown' aria-labelledby='navbarDropdown'>
                        <li><a class='dropdown-item' href='index.php?action=profil'>Profil</a></li>
                        <li><a class='dropdown-item' href='index.php?action=deconnexion'>Déconnexion</a></li>";
                        if($_SESSION["role"] === "proprio"){
                            echo '<li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="index.php?action=ajouter">Gérer mes locations</a></li>';
                        } 
                        echo "
                    </ul>
                </li>
            </ul>";
        }
        else {
            echo "
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"index.php?action=connexion\">Connexion</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"index.php?action=inscription\">Inscription</a>
                        </li>
                        </ul>
                    
            ";
        }
        
        echo "
                    </a>
                </li>
            </form>
        </div>
    </nav>
    <div id=\"content\">
    ";
}

public function afficherTypesLogement() {
    // Méthode pour afficher les types de logement
    $this->entete();
    echo '<h1>Types de logement disponibles</h1>';
    echo '<ul>';
    echo '<li>Appartement</li>';
    echo '<li>Maison</li>';
    // Ajoutez d'autres types de logement ici si nécessaire
    echo '</ul>';
}
		
public function connexion($message = null) {
		$this->entete();

		echo "
			<form method='POST' action='index.php?action=connexion'>
				<h1>Se connecter :</h1>
				<br/>
				<div class=\"form-group\">
					<label for=\"email\">Adresse email</label>
					<input type=\"email\" name=\"email\" class=\"form-control\" id=\"email\" placeholder=\"name@example.com\" required>
				</div>
				<div class=\"form-group\">
					<label for=\"motdepasse\">Mot de passe</label>
					<input type=\"password\" name=\"motdepasse\" class=\"form-control\" id=\"motdepasse\" placeholder=\"●●●●●●\" required>
				</div>
				<br/>
				<a href=\"index.php?action=inscription\">Vous n'êtes pas encore client ? Inscrivez-vous !</a>
				<br/>
				<br/>
				<br/>
				<button type=\"submit\" class=\"btn btn-primary\" name=\"ok\">Connexion</button>
				<p class=text-danger>".$message."</p>
			</form>
		";

}

		public function inscription($message = null) {
			$this->entete();
			echo "
				
					<h2>Inscription</h2>
					<form action=\"index.php?action=inscription\" method=\"post\">
						<div class=\"form-group\">
							<label for=\"nom\">Nom:</label>
							<input type=\"text\" class=\"form-control\" id=\"nom\" name=\"nom\" required>
						</div>
						<div class=\"form-group\">
							<label for=\"prenom\">Prénom:</label>
							<input type=\"text\" class=\"form-control\" id=\"prenom\" name=\"prenom\" required>
						</div>
						<div class=\"form-group\">
							<label for=\"email\">Email:</label>
							<input type=\"email\" class=\"form-control\" id=\"email\" name=\"email\" required>
						</div>
						<div class=\"form-group\">
							<label for=\"motdepasse\">Mot de passe:</label>
							<input type=\"password\" class=\"form-control\" id=\"motdepasse\" name=\"motdepasse\" required>
						</div>
						<button type=\"submit\" class=\"btn btn-primary\" name=\"ok\">Inscription</button>
					</form>
					<p>$message</p>
				
			";
	
		}

		public function accueil($lesAnnonces, $lesPhotos){
			$this->entete();
			echo '<div class="dropdown d-flex">
        <button class="btn btn-secondary btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Filtre
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="index.php?action=afficherAppartement">Appartement</a></li>
          <li><a class="dropdown-item" href="index.php?action=afficherMaison">Maison</a></li>
          <li><a class="dropdown-item" href="index.php?action=accueil">Tout afficher</a></li>
        </ul>
        <div class="input-group ml-2">
          <input type="text" class="form-control" placeholder="Recherche par code postale" aria-label="Rechercher" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button">Rechercher</button>
          </div>
        </div>
      </div>
      <br>';





		  echo "<div class='row'>";
		
		  foreach ($lesAnnonces as $annonce) {
			  echo '<div class="col-md-4 mb-4">';
			  echo '<div class="card h-100">';

			  $annonceAffichee = false;
	  
			  foreach ($lesPhotos as $image) {
				  if ($annonce['ID_Logements'] == $image['id_Logement'] && !$annonceAffichee) {
			
					  echo '<img class="card-img-top" src="' . $image['photo'] . '" alt="Card image cap" style="width: 466px; height: 300px; object-fit: cover;">';
					  $annonceAffichee = true; 
				  }
			  }
	  
			  echo '<div class="card-body">
						  <h5 class="card-title"><a href="index.php?action=annonces&id='.$annonce["ID_Logements"].'&ID='.$annonce["ID"].'">'.$annonce["Titre"].'</a></h5>
						  <p class="card-text">'.$annonce["Description"].'</p>
					  </div>
					  <div class="card-footer">
						  <small class="text-muted">Annonce ajoutée le : '.$annonce["date"].'</small>
					  </div>
				  </div>';
			  echo '</div>';
		  }
	  
		  echo "</div>";
		}

		public function appartement($lesLogements, $lesPhotos){
			$this->entete();
			echo '<div class="dropdown">
			<button class="btn btn-secondary btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
			  Filtre
			</button>
				<ul class="dropdown-menu">
			  		<li><a class="dropdown-item" href="index.php?action=afficherAppartement">Appartement</a></li>
			  		<li><a class="dropdown-item" href="index.php?action=afficherMaison">Maison</a></li>
					<li><a class="dropdown-item" href="index.php?action=accueil">Tout afficher</a></li>
				</ul>
		  </div>
		  </br>';


			echo "<div class='row'>";
			foreach ($lesLogements as $logement) {
				echo '<div class="col-md-4 mb-4">';
				echo '<div class="card h-100">';
  
				$annonceAffichee = false;
		
				foreach ($lesPhotos as $image) {
					if ($logement['id'] == $image['id_Logement'] && !$annonceAffichee) {
			  
						echo '<img class="card-img-top" src="' . $image['photo'] . '" alt="Card image cap" style="width: 466px; height: 300px; object-fit: cover;">';
						$annonceAffichee = true; 
					}
				}
		
				echo '<div class="card-body">
							<h5 class="card-title"><a href="index.php?action=annonces&id='.$logement["ID_Logements"].'&ID='.$logement["ID"].'">'.$logement["Titre"].'</a></h5>
							<p class="card-text">'.$logement["Description"].'</p>
						</div>
						<div class="card-footer">
							<small class="text-muted">Annonce ajoutée le : '.$logement["date"].'</small>
						</div>
					</div>';
				echo '</div>';
			}
		
			echo "</div>";
			
			


			
		}

		public function maison($lesLogements, $lesPhotos){
			$this->entete();
			echo '<div class="dropdown">
			<button class="btn btn-secondary btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
			  Filtre
			</button>
				<ul class="dropdown-menu">
			  		<li><a class="dropdown-item" href="index.php?action=afficherAppartement">Appartement</a></li>
			  		<li><a class="dropdown-item" href="index.php?action=afficherMaison">Maison</a></li>
					<li><a class="dropdown-item" href="index.php?action=accueil">Tout afficher</a></li>
				</ul>
		  </div>
		  </br>';
		  echo "<div class='row'>";

		  foreach ($lesLogements as $logement) {
			  echo '<div class="col-md-4 mb-4">';
			  echo '<div class="card h-100">';

			  $annonceAffichee = false;
	  
			  foreach ($lesPhotos as $image) {
				  if ($logement['id'] == $image['id_Logement'] && !$annonceAffichee) {
			
					  echo '<img class="card-img-top" src="' . $image['photo'] . '" alt="Card image cap" style="width: 466px; height: 300px; object-fit: cover;">';
					  $annonceAffichee = true; 
				  }
			  }
	  
			  echo '<div class="card-body">
						  <h5 class="card-title"><a href="index.php?action=annonces&id='.$logement["ID_Logements"].'&ID='.$logement["ID"].'">'.$logement["Titre"].'</a></h5>
						  <p class="card-text">'.$logement["Description"].'</p>
					  </div>
					  <div class="card-footer">
						  <small class="text-muted">Annonce ajoutée le : '.$logement["date"].'</small>
					  </div>
				  </div>';
			  echo '</div>';
		  }
	  
		  echo "</div>";
		}

		
		
		public function profilProprio($utilisateur, $uneAnnonce, $lesPhotos, $message = null){
			$this->entete();
			if($_SESSION['role'] == 'proprio'){
				echo '<div class="container mt-5">
			<div class="row">
			  <div class="col-md-4">
				<!-- Section gauche - Image de profil et informations utilisateur -->
				<div class="text-center">
				  <img src="images/luffy.jpg" alt="Profile Image" class="profile-img mt-3">';
				  foreach($utilisateur as $util){
					echo '<h4 class="mt-3">'.$util['Nom'].' '.$util['Prenom'].'</h4>
					<p>'.$util['Email'].'</p>
				  </div>
				</div>'; 
				
				}

				  
		
			 echo' <div class="col-md-8">
				
				<h2>Information du compte</h2>
				<ul>
				  
				</ul>
			  </div>
			</div>
		  </div>';


		  echo "<div class='affichage row'>";
		
		 
	  
		  echo "</div>";


			}else{
				echo '<div class="container mt-5">
					<div class="row">
					<div class="col-md-4">
						<!-- Section gauche - Image de profil et informations utilisateur -->
						<div class="text-center">
						<img src="images/zoro.jpg" alt="Profile Image" class="profile-img mt-3">';
						foreach($utilisateur as $util){
							echo '<h4 class="mt-3">'.$util['Nom'].' '.$util['Prenom'].'</h4>
							<p>'.$util['Email'].'</p>
						</div>
						</div>'; 
						
						}

						
				
					echo' <div class="col-md-8">
						
						<h2>Activités Récentes</h2>
						<ul>
						<li>Activité 1</li>
						<li>Activité 2</li>
						<li>Activité 3</li>
						</ul>
					</div>
					</div>
				</div>';
			}
			
	}

	public function uneAnnonce($uneAnnonce, $lesPhotos, $reservation){
		$this->entete();
		echo '
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
		  <div class="carousel-inner">
		  <div class="carousel-item active">
			<img class="d-block w-100 img-fluid" src="'.$lesPhotos[0]['photo'].'" alt="First Slide">
			</div>';

		for($i = 1;$i<count($lesPhotos);$i++){
			echo '<div class="carousel-item">
			<img class="d-block w-100 img-fluid" src="'.$lesPhotos[$i]['photo'].'" alt="Second Slide">
		  </div>';
		 }
		echo '	
		
		  </div>
		  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
			
		  </a>
		</div>'
	  ;

	  echo '
	  <div class="container mt-5">
	  <h1 class="mb-4">Sélectionnez une date de réservation</h1>
	<form method="POST">
	  <div class="form-group">
		  <label for="reservationDate">Date de réservation :</label>
		  <select class="form-control" id="reservationDate" name="selectionner">
		  <option value="" disabled selected>Sélectionnez une date</option>';
		  foreach($reservation as $uneReserv){
			echo '
			<option value="'.$uneReserv['DateDebut'].', '.$uneReserv['DateFin'].'">'.$uneReserv['DateDebut'].' jusqu\'à '.$uneReserv['DateFin'].' </option>
			';

		  }
		  

		  
		 echo '  </select>
		 </div>
	   
		 <button class="btn btn-primary" name = "reserver" id="btnReserver">Réserver</button>';
		  if($_SESSION['role'] == 'proprio'){
			echo '<input type="submit" name=';
		  }

	   echo '</div> 
	   </div>
	</form>
	   '
				   ;
	  
	 
	  
	 
	  
	  
	  ;



	}


	public function ajouterPeriode($uneAnnonce, $lesPhotos, $erreur = null, $succes = null) {
		$this->entete();
	
		if ($erreur != null) {
			echo '<div class="alert alert-danger" role="alert">
					' . $erreur . '
				  </div>';
		} else if ($succes != null) {
			echo '<div class="alert alert-success" role="alert">
					' . $succes . '
				  </div>';
		}
	
		echo '<div class="dropdown">
				<button class="btn btn-secondary btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
				  Action
				</button>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="index.php?action=ajouter">Ajouter une période</a></li>
					<li><a class="dropdown-item" href="index.php?action=afficherMaison">Modifier une période</a></li>
					<li><a class="dropdown-item" href="index.php?action=accueil">Supprimer une période</a></li>
				</ul>
			  </div>';
	
		echo '<div class="col-md-8"></div>';
	
		echo "<div class='affichage row'>";
	
		foreach ($uneAnnonce as $annonce) {
			echo '<div class="col-md-4 mb-4">';
			echo '<div class="card h-100">';
	
			$annonceAffichee = false;
	
			foreach ($lesPhotos as $image) {
				if ($annonce['ID_Logements'] == $image['id_Logement'] && !$annonceAffichee) {
					echo '<img class="card-img-top" src="' . $image['photo'] . '" alt="Card image cap" style="width: 466px; height: 300px; object-fit: cover;">';
					$annonceAffichee = true;
				}
			}
	
			echo '<div class="card-body">
					<h5 class="card-title">'.$annonce["Titre"].'</a></h5>
					<p class="card-text">'.$annonce["Description"].'</p>
					<hr>
					<div class="container mt-5">							
						<form method="POST">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="startDate">Date de Début</label>
									<input name="debutDate" type="text" class="form-control datepicker" id="startDate" placeholder="Sélectionnez une date" required>
								</div>
								<div class="form-group col-md-6">
									<label for="endDate">Date de Fin</label>
									<input name="finDate" type="text" class="form-control datepicker" id="endDate" placeholder="Sélectionnez une date" required>
								</div>
							</div>
							<div class="form-group col-12">
								<label for="prix">Prix :</label>
								<input type="number" class="form-control" name="prix" placeholder="Entrez le prix" min="0" step="any">
							</div>
							<div class="form-group mx-auto">
								<button name="'.$annonce['ID_Logements'].'" type="submit" class="btn btn-primary">Ajouter</button>
							</div>
						</form>
					</div>
				</div>';
			echo '</div>';
			echo '</div>';
		}
	
		echo "</div>";
	
	}
}	

			
				
			
				
			
		
    




?>