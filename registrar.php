<?php
//require_once("autoload.php");
require_once("conexion.php");

class registrar extends conexion{

    // propiedades
    private $strNombre;
    private $intCedula;
    private $strTelefono;
    private $strClave;
    private $strEmail;
    private $conexion;

    // metodos
    public function __construct(){
        $this -> conexion = new conexion();
        $this ->conexion = $this ->conexion ->connect();
       /*  $this -> conexion = $this-> conexion()-> connect(); */
    }

    public function setOperadore(string $nombre, int $cedula, string $telefono, string $email,string $clave){
        $this-> strNombre = $nombre;
        $this-> intCedula = $cedula;
        $this-> strTelefono = $telefono;
        $this-> strEmail = $email;
        $this->strClave = $clave;

        $sql = "INSERT INTO usuarios(nombre, cedula,clave, telefono, email) VALUES(:nom,:cel, :cla, :tel, :email)";

        $arrData = array(
            ":nom" => $this->strNombre,
            ":cel" => $this->intCedula,
            ":cla" => $this->strClave,
            ":tel" => $this->strTelefono,
            ":email" => $this->strEmail
        );

        $insert = $this->conexion->prepare($sql);

        $resInsert = $insert-> execute($arrData);

        $insert->closeCursor();
    }
    public function getUsuarios(string $clave){

        $this->strClave = $clave;

        $sql = "SELECT clave,email,nombre FROM usuarios WHERE clave=:cla";
        $arrdata = array(":cla" => $this->strClave);
        $query = $this->conexion->prepare($sql);
        $query->execute($arrdata);
        $request = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $request;
    }

    public function getUsuarioPorId(int $id){

        $this->intCedula = $id;
        $sql = "SELECT nombre,email FROM usuarios WHERE cedula = :cel";
        $arra = array(
            ':cel'=>$this->intCedula
        );
        $query = $this->conexion->prepare($sql);
        $query->execute($arra) ;
        $request = $query->fetch(PDO::FETCH_ASSOC);

        $query->closeCursor();

        return $request;
    }


    public function update(int $cedula, string $nombre, string $telefono, string $email, string $clave){

        try {
            $this-> intCedula = $cedula;
            $this->strNombre= $nombre;
            $this->strTelefono = $telefono;
            $this->strEmail = $email;
            $this->strClave = $clave;

            $sql = "UPDATE usuarios SET nombre = :nom,cedula = :cel, telefono = :tel, email = :email WHERE clave = :cla";
            $update = $this->conexion->prepare($sql);
            $arrdat = [
                ":nom" => $this->strNombre,
                ":tel" => $this->strTelefono,
                ":email" => $this->strEmail,
                ":cel" => $this ->intCedula,
                ":cla"=> $this->strClave
            ];
            $resUpdate = $update->execute($arrdat);
            $update->closeCursor();
            return $resUpdate;

        }catch (Exception $e){
            echo "error" . $e ->getMessage();
        }
    }
}