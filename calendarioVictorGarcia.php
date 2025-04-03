<?php
/**
 * @author Victor Garcia Baez
 * Dado el mes y año almacenados en variables, escribir un programa que muestre el
 * calendario mensual correspondiente. Marcar el día actual en verde y los festivos
 * en rojo.
 */

// variables
// Obtener la fecha actual
$fechaActual = date("Y-m-d");

// Variables de mes y año
$month = 4;  // Julio
$year = 2025;

// Obtener el mes y año actual (para evitar errores en el formulario)
$mesActual = date('n');
$añoActual = date('Y');

if(isset($_POST['año']) && isset($_POST['mes'])){
    $year = $_POST['año'];
    $month = $_POST['mes'];
}

// Obtener día actual
$day = date("d", strtotime($fechaActual));

// Nombres cortos de los días de la semana
$aDias = ["L", "M", "X", "J", "V", "S", "D"];

// Obtener el primer día del mes
$primerDia = strtotime("$year-$month-01");

// Obtener el nombre del mes
setlocale(LC_TIME, 'es_ES.UTF-8');
$mes_texto = strftime("%B", $primerDia);
$mes_texto = ucfirst($mes_texto);

// Número de días en el mes
$diasDelMes = date("t", $primerDia);

// Día de la semana del primer día (0=domingo, 6=sábado)
$primerDiaMes = date("w", $primerDia);

// Ajustar para que lunes sea 0 y domingo sea 6
$diaSemanaInicio = ($primerDiaMes == 0) ? 6 : $primerDiaMes - 1;

// Función para obtener el nombre del día
function nombreDia($dia, $mes, $año) {
    $fecha = strtotime("$año-$mes-$dia");
    $diaActual = strftime("%A", $fecha);
    return ucfirst($diaActual);
}
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

        .titulo {
            text-align: center;
            margin: 20px;
        }
        .formCaln {
            text-align: center;
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="titulo">
        <h1>CALENDARIO</h1>
        <h2><?php echo $mes_texto . " " . $year; ?></h2>
    </div>
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
                // Casillas vacías 
                echo "<td></td>";
            } else {
                // dia actual
                $clase = "";
                // Solo marcamos el día como "hoy" si corresponde al mes y año actual
                if ($dia == $day && $month == $mesActual && $year == $añoActual) {
                $clase = "hoy";
                } elseif ($columna == 6) {
                // festivos (solo domingo)
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
    <div class ="formCaln">
        <h2>introduce el año y el mes</h2>
        <form method="post">
            <label for="anio">Año:</label>
            <input type="number" id="anio" name="año" min="1900" max="2100"required>
            <label for="mes">Mes:</label>
            <select id="mes" name="mes" required>
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
            <button type="submit">enviar</button>
        </form>
    </div>
</body>
</html>