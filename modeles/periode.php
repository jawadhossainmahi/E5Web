<?php 
    class periode{
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

        public function getPeriode($idLoge){
            $sql = $this->pdo->prepare("SELECT * from periodes_de_reservation WHERE id_Logements = :idLoge");
            $sql->bindParam(':idLoge',$idLoge,PDO::PARAM_STR);
            $sql->execute();
            $res = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        public function ajouterPeriode($idLoge, $dateDebut, $dateFin, $prix){
            $sql = $this->pdo->prepare("INSERT INTO `periodes_de_reservation`(`ID_Logements`, `dateDebut`, `dateFin`, `prix`) VALUES (:idLoge, :dateDebut, :dateFin, :prix)");
            $sql->bindParam(':idLoge',$idLoge, PDO::PARAM_INT);
            $sql->bindParam(':dateDebut',$dateDebut, PDO::PARAM_STR);
            $sql->bindParam(':dateFin',$dateFin, PDO::PARAM_STR);
            $sql->bindParam(':prix',$prix, PDO::PARAM_STR);
            return $sql->execute();
        }
        public function annulerPeriode($idLoge){
            $sql = $this->pdo->prepare("DELETE from periodes_de_reservation WHERE ID_Logements = :idLoge");
            $sql->bindParam(':idLoge',$idLoge, PDO::PARAM_INT);
            return $sql->execute();
        }

        

    }