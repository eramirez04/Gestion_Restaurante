<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Restaurante</title>
    <link rel="stylesheet" type="text/css" href="estilos/index.css">
</head>
<body>

<h2>Bienvenidos al restaurante de Doña Juana</h2>

<div class="box-inputs">
    <form action="" method="post">
        <div class="box">
            <label for="">nombre</label>
            <input type="text" name="nombre" id="">
        </div> <br>
        <div class="box">
            <label for="">cedula</label>
            <input type="number" name="cedula" id="">
        </div><br>
        <div class="box">
            <label for="">telefono</label>
            <input type="text" name="phone" id="">
        </div><br>
        <div class="box">
            <label for="">email</label>
            <input type="email" name="email" id="">
        </div><br>
        <div class="box">
            <label for="">Pasword</label>
            <input type="password" name="clave" id="">
        </div><br>

        <input type="submit" value="enviar">
    </form> <br>
</div>

<a href="login.php">Iniciar sesion</a> <br>

</body>
</html>

<?php
    require_once("autoload.php");
    require_once ("classItem.php");

    function data($dato){
        $imp = print_r("<pre>");
        $imp .= print_r($dato);
        $imp .= print_r("</pre>");
        return $imp;
    }

    if ((isset($_POST['nombre'])) && (isset($_POST['cedula']))  && (isset($_POST['phone']))  && (isset($_POST['email'])) && (isset($_POST['clave'])) ){

        $nombre = $_POST['nombre'];
        $cedula = intval($_POST['cedula']) ;
        $telefono = $_POST['phone'];
        $email = $_POST['email'];
        $clave = $_POST['clave'];

        if(empty($nombre) && empty($clave) && empty($cedula) && empty($email) && empty($telefono)){

            echo "los campos estan vacios";

        }else{

            $objregistro = new registrar();
            $objregistro->setOperadore($nombre,$cedula,$telefono,$email,$clave);
            unset($objregistro);

            echo "se registro exitosamente   . <br>";
        }
    }
?>