<?php
    require_once ("conexion.php");

    class mesa extends  conexion {

        private $strMesa;
        private $intIDMesa;
        private $strStatus;
        private $coneccion;

        public function __construct()
        {
            $this->coneccion = new conexion();
            $this->coneccion = $this->coneccion->connect();
        }

        public function addMesa(string $tipoMesa, int $idMesa){

            $this->strMesa = $tipoMesa;
            $this->intIDMesa = $idMesa;

            $sql = "INSERT INTO mesas(id_mesa, tipo) VALUES(:id ,:tipo)";

            $arrData = array(":tipo" =>$this->strMesa, ":id" => $this->intIDMesa);
            $insert = $this->coneccion->prepare($sql);
            $res = $insert->execute($arrData);
            $insert->closeCursor();

        }

        public function updateMesa(int $id, string $estado){
            $this->intIDMesa = $id;
            $this->strStatus = $estado;
            $sql = "UPDATE mesas SET status=:status WHERE id_mesa=:id";

            $arrData =[
                ":status" => $this->strStatus,
                ":id"=>$this->intIDMesa
            ];

            $update = $this->coneccion->prepare($sql);
            $resUpdate = $update->execute($arrData);
            $update->closeCursor();
        }

        public function getMesa(){
            try{

                $sql = "SELECT * FROM mesas";
                $execute = $this->coneccion->query($sql);
                $request = $execute->fetchAll();
                $execute->closeCursor();
                return $request;

            }catch (Exception $exception){
                echo "ERROR" . $exception->getMessage();
            }
        }
        public function getMesaId(int $id){
            $this->intIDMesa = $id;
            $sql = "SELECT * FROM mesas WHERE id_mesa= :id";
            $arrdata = array(":id" => $this->intIDMesa);
            $query = $this->coneccion->prepare($sql);
            $query->execute($arrdata);
            $request = $query->fetch(PDO::FETCH_ASSOC);
            $query->closeCursor();
            return $request;
        }
    }


    require_once ("registrar.php");

    class reservarMesa extends registrar {
        private $intidUsuario;
        private $intidMesa;

        private $conectar;
        private $idMesa;

       public function __construct()
       {
           $this->conectar = new conexion();
           $this->conectar = $this->conectar->connect();
       }

       public function getReservas(){
           try {

               $sql = "SELECT * FROM reservar";
               $execute = $this->conectar->query($sql);
               $request = $execute->fetchAll();
               $execute->closeCursor();

               return $request;

           }catch (Exception $exception){
               echo "ERROR" . $exception->getMessage();
           }
       }

       public function validaIdMesa(int $id){
           $this->idMesa = $id;
           $sql = "SELECT * FROM reservar WHERE FK_id_mesa = :id";
           $arra = array(
               ':id'=>$this->idMesa
           );
           $query = $this->conectar->prepare($sql);
           $query->execute($arra) ;
           $request = $query->fetch(PDO::FETCH_ASSOC);

           $query->closeCursor();

           return $request;
       }

       public function reservarMesa(int $idusuario, int $idmesa){
           $this->intidUsuario = $idusuario;
           $this->intidMesa = $idmesa;

           $sql = "INSERT INTO reservar (FK_cedula, FK_id_mesa) VALUES (:cel, :mes)";

           $arr = array(
               "cel" => $this->intidUsuario,
               ":mes" => $this->intidMesa
           );
           $insert = $this->conectar->prepare($sql);

           $resinsert = $insert->execute($arr);

           $insert ->closeCursor();
       }
    }