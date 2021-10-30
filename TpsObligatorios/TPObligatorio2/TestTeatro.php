<?php
include "Teatro.php";
include "Funciones.php";

//Muestra un menu para el usuario con todas las opciones disponibles 
function menu() {
    echo "Ingrese la opcion que desea realizar:\n";
    echo "0) Fin del programa.\n";
    echo "1) Cargar una funcion.\n";
    echo "2) Mostrar las funciones.\n";
    echo "3) Cambiar el nombre del teatro.\n";
    echo "4) Cambiar la direccion del teatro.\n";
    echo "5) Cambiar los datos de una funcion.\n";
}

/**
 * PROGRAMA PRINCIPAL
 * Declaracion de variables
 * String $nombre, $direccion
 * Teatro $teatro
 * boolean $datosCargados
 * int $opcion, $longitud
 */
echo "Ingrese el nombre del teatro: ";
$nombre = trim(fgets(STDIN));
echo "Ingrese la direccion del teatro: ";
$direccion = trim(fgets(STDIN));

$teatro = new Teatro($nombre, $direccion);

do {
    menu();
    $longitud = count($teatro->getFunciones());
    $datosCargados = false;
    $opcion = trim(fgets(STDIN));
    switch ($opcion) {
        case 0:  //Salir del programa
            echo "FIN DEL PROGRAMA!";
            break;
        case 1:  //Cargar una funcion
            cargarFunciones($teatro);
            $datosCargados = true;
            break;
        case 2:  //Mostrar las funciones
            if ($longitud > 0) {
                echo $teatro;
            } else {
                echo "NO HAY FUNCIONES CARGADAS!\n";
            }
            break;
        case 3:  //Cambiar el nombre del Teatro
            cambiarNombreTeatro($teatro);
            break;
        case 4:  //Cambiar la direccion del Teatro
            cambiarDireccionTeatro($teatro);
            break;
        case 5:  //Cambiar los datos de una Funcion
            cambiarDatosFuncion($teatro);
            break;
        default:
            echo "Opcion invalida, por favor ingrese una opcion valida\n";
    }
} while ($opcion != 0);

//OPCION 1
function cargarFunciones($teatro) {
    //String $nombre, $horaInicio
    //int $precio, $duracion
    //Funcion $nuevaFuncion
    //boolean $seSolapa, $existe
    //char $agregarFuncion
    do {
        do {  //Verifico que la funcion ingresada no exista en la coleccion para poder cargarla
            echo "Ingrese el nombre de la funcion: ";
            $nombre = trim(fgets(STDIN));
            $existe = $teatro->buscarFuncion($nombre);
        } while ($existe != -1);
        echo "Ingrese el precio de la funcion: ";
        $precio = trim(fgets(STDIN));
        echo "Ingrese la hora de inicio de la funcion (hs:min): ";
        $horaInicio = trim(fgets(STDIN));
        echo "Ingrese la duracion de la funcion (en minutos): ";
        $duracion = trim(fgets(STDIN));

        $nuevaFuncion = new Funciones($nombre, $precio, $horaInicio, $duracion);
        $seSolapa = $teatro->seSolapan($nuevaFuncion);  //Verifico si la funcion se solapa con otra funcion en ese mismo horario

        while ($seSolapa) {
            echo "Ingrese un nuevo horario para la funcion: ";
            $horaInicio = trim(fgets(STDIN));
            $nuevaFuncion->setHoraInicio($horaInicio);
            $seSolapa = $teatro->seSolapan($nuevaFuncion);  //Verifico de nuevo si la funcion se solapa con otra funcion
        }

        //Agrego en la ultima posicion del arreglo de funciones la funcion ingresada
        $arregloFunciones = $teatro->getFunciones();
        $arregloFunciones[count($arregloFunciones)] = $nuevaFuncion;
        $teatro->setFunciones($arregloFunciones);

        echo  "¿Desea ingresar otra función? (s / n):" ;
        $agregarFuncion = trim(fgets(STDIN));
    } while ($agregarFuncion != 'n');
}

//OPCION 3
function cambiarNombreTeatro($teatro) {
    //String $nuevoNombre
    echo "Ingrese el nuevo nombre del teatro: ";
    $nuevoNombre = trim(fgets(STDIN));
    $teatro->setNombre($nuevoNombre);  //Reemplazo el nombre anterior por el nuevo 
}

//OPCION 4
function cambiarDireccionTeatro($teatro) {
    //String $nuevaDireccion
    echo "Ingrese la nueva direccion del teatro: ";
    $nuevaDireccion = trim(fgets(STDIN));
    $teatro->setDireccion($nuevaDireccion);  //Reemplazo la direccion anterior por la nueba
}

//OPCION 5
function cambiarDatosFuncion($teatro) {
    //array $coleccionFuncionesTeatro
    //string $funcionBuscada, $nuevoNombreFuncion, $nuevoHorarioFuncion
    //int $numeroFuncion, $nuevaDuracionFuncion
    //float $nuevoPrecioFuncion

    echo "Ingrese el nombre de la funcion a modificar: ";
    $funcionBuscada = trim(fgets(STDIN));
    $numeroFuncion = $teatro->buscarFuncion($funcionBuscada);

    if ($numeroFuncion >= 0) {
        $coleccionFuncionesTeatro = $teatro->getFunciones();

        echo "Ingrese el nuevo nombre de la funcion: ";
        $nuevoNombreFuncion = trim(fgets(STDIN));
        echo "Ingrese el nuevo horario (hh:mm): ";
        $nuevoHorarioFuncion = trim(fgets(STDIN));
        echo "Ingrese la nueva duracion (en minutos): ";
        $nuevaDuracionFuncion = (int) trim(fgets(STDIN));
        echo "Ingrese el nuevo precio: ";
        $nuevoPrecioFuncion = trim(fgets(STDIN));

        //Reemplazo por los nuevos valores
        $coleccionFuncionesTeatro[$numeroFuncion]->setNombre($nuevoNombreFuncion);
        $coleccionFuncionesTeatro[$numeroFuncion]->setHoraInicio($nuevoHorarioFuncion);
        $coleccionFuncionesTeatro[$numeroFuncion]->setDuracion($nuevaDuracionFuncion);
        $coleccionFuncionesTeatro[$numeroFuncion]->setPrecio($nuevoPrecioFuncion);

        //Mando los nuevos valores al objeto
        $teatro->setFunciones($coleccionFuncionesTeatro);
    }
}



