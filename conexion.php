<?php
class conexion{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $db = "restaurante";
    private $conect;

    public function __construct(){
        try {
            $conecctionString = "mysql:host=". $this ->host.";dbname=".$this ->db.";charse=utf8";
            $this->conect = new PDO($conecctionString,$this->user,$this->password);
            $this -> conect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch (PDOException $e){
            $this -> conect = "error";
            echo "ERROR ". $e ->getMessage();
        }
    }
    public function connect(){
        return $this->conect;
    }
}
?>