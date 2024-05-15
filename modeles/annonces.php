<?php 
    class annonces{
        private $pdo;

        public function __construct() {
            try {
                $infoConnexion = parse_ini_file("base.ini");
                $this->pdo = new PDO("mysql:host=".$infoConnexion["host"].";dbname=".$infoConnexion["database"].";charset=utf8", $infoConnexion["user"], $infoConnexion["password"]);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getAllAnnonces(){
            $sql = $this->pdo->prepare("SELECT * from annonces");
            $sql->execute();
            $res = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        public function ajouterAnnonces($titre, $desc, $idUser, $idLoge){
            $sql = $this->pdo->prepare("INSERT INTO `annonces`(`Titre`, `Description`, `ID_Utilisateurs`, `ID_Logements`) VALUES (:titre, :descr, :idUser, :idLoge)");
            $sql->bindParam(':titre',$titre, PDO::PARAM_STR);
            $sql->bindParam(':descr',$desc, PDO::PARAM_STR);
            $sql->bindParam(':idUser',$idUser, PDO::PARAM_INT);
            $sql->bindParam(':idLoge',$idLoge, PDO::PARAM_INT);
            return $sql->execute();
        }

        public function getAnnonces($idType){
            $sql = $this->pdo->prepare("SELECT *, id_Type
            FROM annonces
            INNER JOIN logement ON annonces.ID_Logements = logement.id WHERE id_Type = :idType;");
            $sql->bindParam(':idType', $idType, PDO::PARAM_INT);
            $sql->execute();
            $res = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        public function getUneAnnonce($id){
            $sql = $this->pdo->prepare("SELECT * FROM annonces WHERE ID=:id");
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->execute();
            $res = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        public function getIdLogementAnnonce($id){
            $sql = $this->pdo->prepare("SELECT ID_Logements FROM annonces WHERE ID=:id");
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->execute();
            $res = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        public function getAnnonceProprio($id){
            $sql = $this->pdo->prepare("SELECT * FROM annonces WHERE ID_Utilisateurs=:id");
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->execute();
            $res = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }   
    }