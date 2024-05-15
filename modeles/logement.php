<?php 
    class logement{
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

        public function getAllLogement(){
            $sql = $this->pdo->prepare("SELECT * from logement");
            $sql->execute();
            $res = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        public function ajouterLogement($libelle, $adresse, $cp, $ville, $idType, $idProprio = null){
            $sql = $this->pdo->prepare("INSERT INTO `logement`(`libelle`, `adresse`, `ville`, `dateAjout`, id_Type, id_proprietaire) VALUES (:libelle, :adresse, :ville, NOW(), :idType, :idProprio)");
            $sql->bindParam(':libelle',$libelle, PDO::PARAM_STR);
            $sql->bindParam(':adresse',$adresse, PDO::PARAM_STR);
            $sql->bindParam(':cp',$cp, PDO::PARAM_STR);
            $sql->bindParam(':ville',$ville, PDO::PARAM_STR);
            $sql->bindParam(':idType',$idType, PDO::PARAM_INT);
            $sql->bindParam(':idProprio',$idProprio, PDO::PARAM_INT);
            return $sql->execute();
        }

        public function getUnLogement($id){
            
            $sql = $this->pdo->prepare("SELECT * FROM logement WHERE id_Type = :id");
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->execute();
            $res =$sql->fetchAll(PDO::FETCH_ASSOC);
            return $res; 
        }

    }