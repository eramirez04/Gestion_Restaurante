<?php
    require_once ("conexion.php");
    class item extends conexion {

        private $strNombre;
        private $floatPrecio;
        private $conexionI;
        private $idItem;
        private $intCantidad;

        public function __construct()
        {
            $this->conexionI = new conexion();
            $this->conexionI = $this->conexionI->connect();
        }

        public function registrarItem(string $nombre, float $precio,int $cantidad){

            $this->strNombre = $nombre;
            $this->floatPrecio = $precio;
            $this->intCantidad = $cantidad;

            $sql = "INSERT INTO items(nombre, precio,cantidad) VALUES (:nom,:pre,:can)";

            $arrData = array(
                "nom" => $this->strNombre,
                "pre" => $this->floatPrecio,
                ":can" =>$this->intCantidad
            );

            $insert = $this->conexionI->prepare($sql);
            $resInsert = $insert-> execute($arrData);
            $insert->closeCursor();
        }

        public function update(string $nombre, float $precio, int $id){

            $this->strNombre = $nombre;
            $this->idItem = $id;
            $this->floatPrecio = $precio;

            $sql = "UPDATE items SET nombre= :nom , precio= :pre WHERE id_item= :id";

            $arr = array(
                ":nom" => $this->strNombre,
                ":pre" => $this->floatPrecio,
                ":id" => $this-> idItem
            );

            $Update = $this->conexionI->prepare($sql);

            $resUpdate = $Update->execute($arr);

            $Update->closeCursor();

            return $resUpdate;

        }

        public function getItems(){

            $sql = "SELECT * FROM items";
            $execute = $this->conexionI->query($sql);
            $request = $execute->fetchAll();
            $execute->closeCursor();
            return$request;
        }

        public function getItemsId(int $id){

            $this->idItem = $id;

            $sql = "SELECT * FROM items WHERE id_item=:id";

            $arrData = [":id"=> $this->idItem];
            $query = $this->conexionI->prepare($sql);
            $query->execute($arrData);
            $request = $query->fetch(PDO::FETCH_ASSOC);
            $query->closeCursor();

            return $request;
        }

    }




    //########## class para registrar las compass de los usuarios en la base de datos ############
    //########## apartir de los items ya registrados########

    class comprarProductos extends conexion{

        private $intIDItems;
        private $intIdUsuario;
        private $intCantidad;
        private $strEstado;
        private $intIdCompra;
        private $conexionBD;

        public function __construct()
        {

            $this->conexionBD = new conexion();
            $this->conexionBD = $this->conexionBD->connect();
        }

        public function setCompraPoducto(int $idProducto, int $idUsuario, $estado,$cantidad)
        {

            $this->intIdUsuario = $idUsuario;
            $this->intIDItems = $idProducto;
            $this->strEstado = $estado;
            $this->intCantidad = $cantidad;

            $sql = "INSERT INTO compra_item(fk_id_mesa,fk_item,estado,cantidad) VALUES (:cel,:id,:estado,:can)";

            $arrData = [":cel" => $this->intIdUsuario, ":id" => $this->intIDItems, ":estado" => $this->strEstado,
                "can"=>$this->intCantidad];

            $insert = $this->conexionBD->prepare($sql);
            $resInsert = $insert->execute($arrData);
            $insert->closeCursor();
        }

        public function updatePagoCompra(int $idCompra, string $estado)
        {
            $this->intIdCompra = $idCompra;
            $this->strEstado = $estado;

            $sql = "UPDATE compra_item SET estado=:estado   WHERE id_compra=:id";

            $update = $this->conexionBD->prepare($sql);

            $arrData = [":estado" => $this->strEstado, ":id" => $this->intIdCompra];

            $resUpdate = $update->execute($arrData);

            $update->closeCursor();
        }

        public function getComprasId(int $id)
        {

            $this->intIdCompra = $id;

            $sql = "SELECT * FROM compra_item WHERE id_compra=:id";
            $arrData = ["id" => $this->intIdCompra];

            $query = $this->conexionBD->prepare($sql);
            $query->execute($arrData);
            $request = $query->fetch(PDO::FETCH_ASSOC);

            $query->closeCursor();

            return $request;

        }
        public function getCompras(){
            $sql = "SELECT * FROM compra_item";
            $executar = $this->conexionBD->query($sql);
            $request = $executar->fetchAll();
            $executar->closeCursor();
            return $request;
        }
    }