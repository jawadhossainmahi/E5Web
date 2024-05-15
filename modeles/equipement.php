<?php 
    class equipement{
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

        public function getAllEquipement(){
            $sql = $this->pdo->prepare("SELECT * from equipement");
            $sql->execute();
            $res = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        public function ajouterEquipement($libelle, $idPiece){
            $sql = $this->pdo->prepare("INSERT INTO annonces(`libelle`, `id_Piece`, `ID_Utilisateurs`, `ID_Logements`) VALUES (:libelle,:idPiece)");
            $sql->bindParam(':libelle',$libelle, PDO::PARAM_STR);
            $sql->bindParam(':idPiece',$idPiece, PDO::PARAM_INT);
            return $sql->execute();
        }

    }