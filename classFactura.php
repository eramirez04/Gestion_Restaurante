<?php
require_once ("conexion.php");
    class factura extends conexion {

        private $conexionBD;
        private $strDescripcion;
        private $intCompra;
        private $intMesa;
        private $intPrecio;

        public function __construct(){
            $this->conexionBD = new conexion();
            $this->conexionBD =$this->conexionBD->connect();
        }

        ###########  METODOS ######
        public function setRegistraFactura(string $descripcion, int $idCompra, int $idMesa,int $precio){
            $this->strDescripcion = $descripcion;
            $this->intCompra = $idCompra;
            $this->intMesa = $idMesa;
            $this->intPrecio = $precio;

            $sql = "INSERT INTO factura(descripcion,fk_compra,fk_mesa,precio_total) VALUES (:des,:compra,:mesa,:pre)";
            $insert = $this->conexionBD->prepare($sql);

            $arrData = [
                ":des"=> $this->strDescripcion,
                ":compra"=>$this->intCompra,
                ":mesa" => $this->intMesa,
                ":pre" => $this->intPrecio
            ];
            $resInsert = $insert->execute($arrData);

            $insert->closeCursor();
        }

        public function getFacturas(){
            $sql = "SELECT * FROM factura";
            $executar = $this->conexionBD->query($sql);
            $request = $executar->fetchAll();
            $executar->closeCursor();
            return $request;
        }
    }
