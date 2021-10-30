<?php
include 'Teatro.php';

/**
 * Esta funcion muestra por pantalla el menu de usuario y obtiene una opcion de menú
 * @return int $opcion
 */
function menu() {
    /**
     * Declaracion de variables
     * int $opcion
     */

    /**
     * Menu que se muestra al usuario
     */
    echo "--------------------------------------------------------------\n";
    echo "0) Salir del programa. \n";
    echo "1) Ingresar datos del teatro. \n";
    echo "2) Mostrar datos del teatro. \n";
    echo "3) Modificar datos del teatro. \n";
    echo "4) Modificar datos de una funcion. \n";
    echo "--------------------------------------------------------------\n";

    echo "Ingrese una opcion: ";
    $opcion = (int) trim(fgets(STDIN));

    return $opcion;
}

/**
 * PROGRAMA PRINCIPAL
 * int $opcion, $i, $numeroFuncion
 * float $precioFuncion
 * array $funcionesTeatro
 * string $direccionTeatro, $nombreFuncion, $nombreTeatro
 */

// Inicializacion de variables
$funcionesTeatro = [];

do {
    $opcion = menu();

    switch ($opcion) {
        case 0:
            echo "Fin del programa! \n";
            break;
        case 1: //Ingresar datos teatro
            echo "Ingrese el nombre del teatro: ";
            $nombreTeatro = trim(fgets(STDIN));
            echo "Ingrese la direccion del teatro: ";
            $direccionTeatro = trim(fgets(STDIN));

            // Armo un array con una cantidad de 4 funciones con su nombre y precio correspondiente
            for ($i = 0; $i < 4; $i++) {
                echo "Ingrese el nombre de la funcion: ";
                $funcionesTeatro[$i]["nombre"] = trim(fgets(STDIN));
                echo "Ingrese el precio de la funcion: ";
                $funcionesTeatro[$i]["precio"] = trim(fgets(STDIN));
            }

            $teatro = new Teatro($nombreTeatro, $direccionTeatro, $funcionesTeatro);
            break;
        case 2: // Mostrar datos del teatro (nombre, direccion, funciones)
            echo $teatro . "\n";
            break;
        case 3: // Modificar datos del teatro (nombre y direccion)
            echo "Ingrese el nuevo nombre del teatro: ";
            $nombreTeatro = trim(fgets(STDIN));
            echo "Ingrese la nueva direccion del teatro: ";
            $direccionTeatro = trim(fgets(STDIN));

            $teatro -> setNombre($nombreTeatro);
            $teatro -> setDireccion($direccionTeatro);
            break;
        case 4: // Modificar datos de una funcion del teatro (nombre y precio)
            echo "Ingrese el nombre de la funcion a modificar: ";
            $nombreFuncion = trim(fgets(STDIN));
            $numeroFuncion = $teatro -> buscarFuncion($nombreFuncion);

            // Si el numero de la funcion buscada esta dentro del margen, se prodece a modificar los valores. De lo contrario, error
            if ($numeroFuncion >= 0 && $numeroFuncion <= 3) {
                echo "Ingrese el nuevo nombre de la funcion: ";
                $nombreFuncion = trim(fgets(STDIN));
                echo "Ingrese el precio de la funcion: ";
                $precioFuncion = trim(fgets(STDIN));
                $teatro-> cambiarFuncion($numeroFuncion, $nombreFuncion, $precioFuncion);
            } else {
                echo "No se ha encontrado una funcion con ese nombre, verifique por favor. \n";
            }
            break;
        default:
            echo "Opcion incorrecta, verifique por favor! \n";
            break;
    }
} while ($opcion != 0);