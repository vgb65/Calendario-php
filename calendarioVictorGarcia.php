<?php
/**
 * @author Victor Garcia Baez
 * Dado el mes y año almacenados en variables, escribir un programa que muestre el
 * calendario mensual correspondiente. Marcar el día actual en verde y los festivos
 * en rojo.
 */

// variables
$fechaActual = new DateTime();
$month = $fechaActual->format("m");
$year = $fechaActual->format("Y");
$day = $fechaActual->format("d");
$aDias = ["L","M","X","J","V","S","D"];

$primerDia = new DateTime("$year-$month-01");
$diasDelMes = $primerDia->format("t");


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
    table{
        border: 1px solid black;
        width: 500px;
        height: 250px;
        margin: auto;
    }

    td{
        width: 50px;
        height: 50px;
        border: 1px solid black;
        text-align: center;
    }
</style>
    <table>
        <?php
    // Dias Semana
    foreach ($aDias as $Dia) {
        echo "<td>$Dia</td>";
    }
            for ($fila=0; $fila < 5 ; $fila++) { 
                echo "<tr>";
                for ($colum=0; $colum < 7 ; $colum++) { 
                    echo "<td></td>";
                }
                echo "</tr>";
            }



        ?>
    </table>
</body>
</html>