<?php
    require_once ("classMesa.php");
    require_once ("classItem.php");

    if ((isset($_POST['cedulaCliente'])) === false && (isset($_POST['idMesa'])) === false ){


    }else{
        $idCliente = intval($_POST['cedulaCliente']);
        $idMesa = intval($_POST['idMesa']);

        if (empty($idCliente) === true && empty($idMesa) === true){

             $datos = "ingrese datos por favor";
             echo $datos;
        }else{

            $reservar = new mesa();

            $auxReservar = $reservar->getMesaId($idMesa);

          if ($auxReservar['status'] === "disponible"){

                $res = new reservarMesa();
                $res->reservarMesa($idCliente,$idMesa);

                echo "se registro reserva de mesa";

                ///
              $estaddo = "ocupada";

              $staMesa = new mesa();
              $staMesa->updateMesa($idMesa,$estaddo);

          }else{
                echo "no se registro reserva, ";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante Doña Juana</title>
    <link rel="stylesheet" href="estilos/vistaInicio.css">
</head>
<body>

    <header>
        <h2>
            Restaurante Doña Juana
        </h2>
        <a href="vistaMenus.php">Menus</a>

        <a href="vistaCaja.php">Registra Pagos</a>
    </header>

    <div class="box-reservas">
        <div class="reservar">

            <div class="inputs-reservas">
                  <h2 class="title-reservas">Reservar mesa</h2>


                <form action="" method="post">
                    <label for="">Ingrese numero de cedula</label>
                    <input type="number" name="cedulaCliente" id="">

                    <label for="">Ingrese numero de Id de mesa</label>
                    <input type="number" name="idMesa" id="">

                    <input class="input-submit" type="submit" value="reservar">
                </form>
                <p class="respuesta">
                    <?php if (isset($mostrar) ){echo $mostrar;} ?></p>
            </div>

            <div class="mesas_disponibes">
                <h2> Mesas disponibles</h2>

                <?php

                    $objMesa = new mesa();

                    $aux =  $objMesa->getMesa();

                    foreach($aux as $clave){
                    $as = $clave['id_mesa'];
                    $estado = $clave['status'];

                    echo "<di> id mesa: " . "$as" ." tipo: "/*. "$tipo" */." estado: " . $estado  ."</di>" ."<br>";

                }
                ?>
            </div>
        </div>

        <div class="mesas-reservadas">
            <h2> Mesas reservadas</h2>
            <?php
                $obReserva = new reservarMesa();
                $aux = $obReserva->getReservas();

                foreach ($aux as $clave){
                    $id = $clave['id_reserva'];
                    $IdMesa = $clave['FK_id_mesa'];
                    $fecha = $clave['fecha_registro'];


                    $mesa = new mesa();
                    $auxMesa = $mesa->getMesaId($IdMesa);
                    $estado     =$auxMesa['status'];


                    $es = "ocupada";
                    if ($estado === $es){
                        echo "<h2>"."ID de reserva: ". $id ."</h2>" ."<br>";
                        echo "ID de Mesa: ".$IdMesa . "<br>";
                        echo "Estado de mesa: ".$estado . "<br>";

                        echo "Fecha: " . $fecha;
                    }
                }
            ?>
        </div>

    </div>
</body>
</html>
