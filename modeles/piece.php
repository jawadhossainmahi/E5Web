<?php 
    class piece{
        private $pdo;

        public function __construct() {
            try {
                $infoConnexion = parse_ini_file(__DIR__ . "base.ini");
                $this->pdo = new PDO("mysql:host=".$infoConnexion["host"].";dbname=".$infoConnexion["database"].";charset=utf8", $infoConnexion["user"], $infoConnexion["password"]);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getPiece($idLogement){
            $sql = $this->pdo->prepare("SELECT * FROM piece WHERE id_Logement=:id");
            $sql->bindParam(":id", $idLogement, PDO::PARAM_INT);
            $sql->execute();
            $res = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        public function ajoutPiece($libelle, $surface, $idLogement){
            $sql = $this->pdo->prepare("INSERT INTO piece(libelle, surface, id_Logement) VALUES(:libelle, :surface, :id)");
            $sql->bindParam(":libelle", $libelle, PDO::PARAM_STR);
            $sql->bindParam(":surface", $surface, PDO::PARAM_INT);
            $sql->bindParam(":id", $idLogement, PDO::PARAM_INT);
            return $sql->execute();
        }

        public function modifPiece($libelle = null, $surface = null, $idLogement){
            $sql = $this->pdo->prepare("UPDATE piece SET libelle = :libelle, surface = :surface WHERE id_Logement = :id");
            $sql->bindParam(":libelle", $libelle, PDO::PARAM_STR);
            $sql->bindParam(":surface", $surface, PDO::PARAM_INT);
            $sql->bindParam(":id", $idLogement, PDO::PARAM_INT);
            return $sql->execute();
        }


        
    }


?>