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
$aDias = ["L", "M", "X", "J", "V", "S", "D"];

$primerDia = new DateTime("$year-$month-01");
$diasDelMes = $primerDia->format("t");
$diaSemanaInicio = $primerDia->format("N") - 1;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario en PHP Victor Garcia</title>
    <style>
        table {
            border: 1px solid black;
            width: 500px;
            height: auto;
            margin: auto;
            border-collapse: collapse;
        }

        td {
            width: 50px;
            height: 50px;
            border: 1px solid black;
            text-align: center;
            vertical-align: middle;
        }

        .hoy {
            background-color: green;
            color: white;
        }

        .festivo {
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Calendario de <?php echo $month . "/" . $year; ?></h1>
    <table>
        <tr>
            <?php
            // Imprimir dias semana
            foreach ($aDias as $dia) {
                echo "<th>$dia</th>";
            }
            ?>
        </tr>
        <?php
        // Imprimir dias mes
        $dia = 1;
        for ($fila = 0; $fila < 6; $fila++) {
            echo "<tr>";
            for ($columna = 0; $columna < 7; $columna++) {
                if (($fila === 0 && $columna < $diaSemanaInicio) || $dia > $diasDelMes) {
                    // Casillas vacias 
                    echo "<td></td>";
                } else {
                    // Día actual
                    $clase = "";
                    if ($dia == $day) {
                        $clase = "hoy";
                    } elseif ($columna == 6) {
                        // Festivos (solo domingo)
                        $clase = "festivo";
                    }
                    echo "<td class='$clase'>$dia</td>";
                    $dia++;
                }
            }
            echo "</tr>";
            if ($dia > $diasDelMes) {
                break;
            }
        }
        ?>
    </table>
</body>
</html>
