<?php
    require_once ("classItem.php");
    require_once ("classFactura.php");
    require_once ("classMesa.php");

    if ((isset($_POST['idMesa'])) && (isset($_POST['idCompra'])) && (isset($_POST['descripcion'])) && (isset($_POST['precioTotal']))){

        $descripcion = strval($_POST['descripcion']);
        $compra = intval($_POST['idCompra']);
        $mesaId = intval($_POST['idMesa']);
        $precio = intval($_POST['precioTotal']);

        if (!empty($descripcion) && !empty($compra) && !empty($mesaId) && !empty($precio)){

            $factura = new factura();
            $factura->setRegistraFactura($descripcion,$compra,$mesaId,$precio);

            $mesa = new mesa();

            if($mesa->getMesaId($mesaId)){
                $estadoDis = "disponible";
                $mesa->updateMesa($mesaId,$estadoDis);
                echo "se genero factura";

                $estado = "pago";
                $compraItem = new comprarProductos();
                $compraItem->updatePagoCompra($compra,$estado);

                $estadoMesa = "disponible";

                $mesa = new mesa();
                $mesa ->updateMesa($mesaId,$estadoMesa);

            }else{
                echo "no se genero Factura";
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caja Registradora</title>
    <link rel="stylesheet" href="estilos/vistaCaja.css">
</head>

<body>
<header>
   <h2>Caja Registradora</h2>
</header>

<div>

    <form method="post" class="box-caja">
        <label>ingrese Id de Mesa para generar Factura</label>
        <input type="number" name="idMesa">
        <label>Ingrese id de compra</label>
        <input type="number" name="idCompra">
        <label>Descripcion</label>
        <input type="text" name="descripcion">
        <label>Precio Total a pagar</label>
        <input type="number" name="precioTotal">
        <input type="submit" value="Enviar">
    </form>

</div>


<div class="box-factura">
    <div class="box factura">
        <h2>Facturas </h2>
        <?php
            function data($dato){
                $imp = print_r("<pre>");
                $imp .= print_r($dato);
                $imp .= print_r("</pre>");
                return $imp;
            }
            $factura = new factura();                                         //
           $auxFac = $factura->getFacturas();                                //
           foreach ($auxFac as $clave){
               $idFactura = $clave['id_factura'];
               $idCompre = $clave['fk_compra'];
               $fecha = $clave['fecha_factura'];
               $precioTo = $clave['precio_total'];
               $mesa = $clave['fk_mesa'];

               $new = new comprarProductos();
               $asss = $new->getComprasId($idCompre);

               $idItem = $asss['fk_item'];

               $pro = new item();
               $auxItem = $pro->getItemsId($idItem);
               $nombreItem = $auxItem['nombre'];      // del metodo getItemsId se toma el nombre
                                                        // de los items para poder mostrarlos en pantalla

               echo "<h3>". "ID de factura: ". $idFactura."</h3>" ."<br>";
               echo "ID de compra: ".$idCompre . "<br>";
               echo "ID de Mesa: " .$mesa. "<br>";
               echo "ID de Producto: " . $idItem. " producto : ".$nombreItem ."<br>";
               echo "fecha: " . $fecha. "<br>";
               echo "Valor Total : ".$precioTo ."<br>";
           }


        ?>

    </div>
    <div class="box debe">
        <h2>Mesas que deben</h2>
        <?php
            $compra = new comprarProductos();
            $adsf = $compra->getCompras();

            foreach ($adsf as $clave){

                $idMesa = $clave['fk_id_mesa'];
                $idItems= $clave['fk_item'];
                $estad= $clave['estado'];
                $cantidad = $clave['cantidad'];
                $idCompra= $clave['id_compra'];


                $items = new item();
                $aaa = $items->getItemsId($idItems);

                $precio = $aaa['precio'];

                $can = $cantidad * $precio;

                if($estad === "debe"){                                           // solo muestra en pantalla solo los productos
                    echo "<h4>"."ID Compra: ". $idCompra ."</h4>" . "<br>";     // que estan en estado "debe"
                    echo "ID de mesa: " . $idMesa . "<br>";
                    echo "estado: " . $estad ."<br>";
                    echo "precio total: " . $can;
                }
            }
        ?>

    </div>
</div>

<!--  -->

</body>

</html>