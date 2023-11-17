<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar items</title>
    <link rel="stylesheet" href="estilos/index.css">
</head>

<body>

<header>
    <h2>Actualizar datos de los items</h2>
</header>

<div class="box-inputs">
    <form method="post">
        <div class="box">
            <label>Ingrese Id del item</label>
            <input name="idItem" type="number">
        </div>

        <div class="box">
            <label>Ingrese precio</label>
            <input type="number" name="precioItem">
        </div>
        <div class="box">
            <label>ingrese Nombre</label>
            <input type="text" name="nombreItem">
        </div>
        <div class="box">
            <labe>Cantidad de productos</labe>
            <input type="number" name="cantidaItem">
        </div>
        <input type="submit" value="Enviar">
    </form>
</div>


<!--  -->


</body>

</html>
<?php
    require_once ("classItem.php");

    if ((isset($_POST['nombreItem'])) || (isset($_POST['precioItem'])) && (isset($_POST['idItem'])) && (isset($_POST['cantidad']))){

        $nombre = $_POST['nombreItem'];
        $id =$_POST['idItem'];
        $precio = intval($_POST['precioItem']);
        $cantidad = intval($_POST['cantidad']);

        if (!empty($nombre) && !empty($id) && !empty($precio) && !empty($cantidad)){

            $item = new item();
            $item->update($nombre,$precio,$id);

            echo "se actualizaron los datos";
        }
    }
?>