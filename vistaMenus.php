<?php
    require_once ("classItem.php");
    require_once ("classMesa.php");

    if ((isset($_POST['idMesa'])) && (isset($_POST["idItem"])) && isset($_POST['Cantidad'])){

        $idMesa = intval($_POST['idMesa']);
        $idItem = intval($_POST["idItem"]);
        $cantidad= intval($_POST['Cantidad']);
        $estado = "debe";

        $items = new item();

        if ($items->getItemsId($idItem)){

            $objComprar = new comprarProductos();
            $objComprar->setCompraPoducto($idItem,$idMesa,$estado,$cantidad);

            echo "se registro compra de producto";
        }else{

            echo "no se pudo registrar compra";
        }
    }

    ///######## Agregar items a la base de datos

    if ((isset( $_POST['nombreItem'])) && (isset($_POST['precio']))){
        $nombre = $_POST['nombreItem'];
        $precio = $_POST['precio'];

        if (!empty($nombre) && (!empty($precio))){

            $objItems = new item();
            $can = intval(10) ;
            $objItems->registrarItem($nombre,$precio,$can);
        }else{

            echo "no se regitro";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lista de menus</title>
    <link rel="stylesheet" href="estilos/vistaMenu.css">

</head>

<body>
<header>
    <h2>lista de menus</h2>
    <a href="updateItems.php">Actualizar datos de los items</a>
</header>


<div class="items">
    <div class="comprar-items">

        <form class="form-inputs" action="" method="post">

            <label>ingrese el ID de mesa</label>
            <input type="number" name="idMesa">

            <label>Ingrese Id del Producto</label>

            <input type="number" name="idItem">

            <label>Cantidad de productos</label>
            <select name="Cantidad" id="">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>

            <input type="submit" value="enviar">
        </form>
    </div>
    <div class="registrar-item">


        <form name="" action="" method="post" class="form-inputs">
            <h3>Registrar item</h3>
            <label>ingrese Nombre del producto</label>
            <input type="text" name="nombreItem">
            <label>ingrese precio del producto</label>
            <input type="number" name="precio">

            <input type="submit" value="Enviar">
        </form>
    </div>
</div>
<h2>Productos:</h2>
<div class="box-items">
    <div class="box-pro id-items">ID
        <div class="box-items">
            <?php
                $objId = new item();
                $aux = $objId->getItems();

                foreach ($aux as $clave){
                    $id = $clave['id_item'];
                    echo $id ."<br>";
                }
            ?>
        </div>
    </div>
    <div class="box-pro noombre-items">NOMBRE
        <div>
            <?php
                $objId = new item();
                $aux = $objId->getItems();

                foreach ($aux as $clave){
                    $id = $clave['nombre'];
                    echo $id ."<br>";
                }
            ?>

        </div>
    </div>
    <div class="box-pro precio">PRECIO
        <div>
            <?php
                $objId = new item();
                $aux = $objId->getItems();

                foreach ($aux as $clave){
                    $id = $clave['precio'];
                    echo $id ."<br>";
                }
            ?>
        </div>
    </div>
    <div class="box-pro precio">CANTIDAD
        <div>
            <?php
                $objCantidad = new item();
                $auxCan = $objCantidad->getItems();

                foreach ($auxCan as $clave) {
                    $id = $clave['cantidad'];
                    echo $id . "<br>";
                }

            ?>
        </div>
    </div>
</div>


</body>

</html>

