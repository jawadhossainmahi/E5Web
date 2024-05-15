<?php 
    class type{
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

        public function getType($id){
            $sql = $this->pdo->prepare("SELECT * FROM type WHERE id=:id");
            $sql->bindParam(":id", $id, PDO::PARAM_INT);
            $sql->execute();
            $res = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }        
    }


?>