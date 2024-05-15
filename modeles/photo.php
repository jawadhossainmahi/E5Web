<?php 

class photo{
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

    public function getAllPhoto(){
        $sql = $this->pdo->prepare("SELECT * FROM PHOTO");
        $sql->execute();
        $res = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function ajoutPhoto($photo){
        $sql = $this->pdo->prepare("INSERT into photo(photo) VALUES(:photo)");
        $sql->bindParam(":photo", $photo);
        return $sql->execute();
    }

    public function getPhoto($idLoge){
        $sql = $this->pdo->prepare("SELECT * FROM PHOTO WHERE id_Logement = :id");
        $sql->bindParam(':id', $idLoge, PDO::PARAM_INT);
        $sql->execute();
        $res = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

}

?>