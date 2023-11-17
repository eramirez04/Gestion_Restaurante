<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
    <link rel="stylesheet" href="estilos/login.css">

</head>

<body>

<div class="box-login">
    <form action="" method="post" class="form-box">
        <h3>Inicio de Sesion</h3>
        <div class="box">
            <label>Email :</label>
            <input type="email" name="emailCom" id="" class="input-box" placeholder="ingrese correo">
        </div>

        <div class="box">
            <label>Contraseña</label>
            <input type="password" name="claveCom" id="" class="input-box" placeholder="Ingrese Contraseña">
        </div>

        <input type="submit" value="Iniciar" class="button-iniciar">

    </form>
</div>
</body>

</html>

<?php
require_once ("registrar.php");

if ((isset($_POST['emailCom'])) && (isset($_POST['claveCom'])) ){

    $email = $_POST['emailCom'];
    $clave = strval($_POST['claveCom']);

    if (!empty($clave) && !empty($email)) {

        $obj = new registrar();
        $aux = $obj ->getUsuarios($clave);

        $pass = $aux['clave'];
        $correo = $aux['email'];

        if ($pass === $clave && $correo === $email){
             header("location: vistaInicio.php");

            //$llevar = "<a href='vistaInicio.php'>Iniciar</a>";
          //  echo $llevar;

        }else{
            echo "usuario noo encontrado";
        }
    }
}





