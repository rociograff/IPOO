<?php
include "Teatro.php";
include "Funciones.php";
include "Obra.php";
include "Musical.php";
include "Cine.php0";

//Muestra un menu para el usuario con todas las opciones disponibles 
function menu() {
    echo "Ingrese la opcion que desea realizar:\n";
    echo "0) Fin del programa.\n";
    echo "1) Cargar una funcion.\n";
    echo "2) Mostrar las funciones.\n";
    echo "3) Cambiar el nombre del Teatro.\n";
    echo "4) Cambiar la direccion del Teatro.\n";
    echo "5) Cambiar los datos de una funcion.\n";
    echo "6) Mostrar los costos del Teatro"."\n";
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
    $longitud = count($teatro->getColFunciones());
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
        case 6:  //Mostrar los costos del Teatro
            mostrarCostos($teatro);
            break;
        default:
            echo "Opcion invalida, por favor ingrese una opcion valida\n";
    }
} while ($opcion != 0);

//OPCION 1
function cargarFunciones($teatro) {
    /*String $nombre, $horaInicio, $director, $genero, $paisOrigen
    int $precio, $duracion, $cantPersonasEscena
    Funciones $nuevaFuncion
    boolean $seSolapa, $existe
    char $agregarFuncion, $tipoFuncion*/
    do {
        echo "Ingrese el tipo de funcion (t/m/c): ";
        $tipoFuncion = trim(fgets(STDIN));
    } while ($tipoFuncion != 'o' && $tipoFuncion != 'm' && $tipoFuncion != 'c');
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

    switch($tipoFuncion) {  //De acuerdo el tipo de funcion que se elija, cargo los datos
        case 'o':
            $nuevaFuncion = new Obra($nombre, $precio, $horaInicio, $duracion);
            break;
        case 'm':
            echo "Ingrese el nombre del director del musical: ";
            $director = trim(fgets(STDIN));
            echo "Ingrese la cantidad de personas en escena: ";
            $cantPersonasEscena = trim(fgets(STDIN));
            $nuevaFuncion = new Musical($nombre, $precio, $horaInicio, $duracion, $director, $cantPersonasEscena);
            break;
        case 'c':
            echo "Ingrese el genero de la pelicula: ";
            $genero = trim(fgets(STDIN));
            echo "Ingrese el pais de origen de la pelicula: ";
            $paisOrigen = trim(fgets(STDIN));
            $nuevaFuncion = new Cine($nombre, $precio, $horaInicio, $duracion, $genero, $paisOrigen);
            break;
    }

    //Verifico si la funcion se solapa con otra funcion en ese mismo horario
    $seSolapa = $teatro->seSolapan($nuevaFuncion);  

    while ($seSolapa) {
        echo "Ingrese un nuevo horario para la funcion: ";
        $horaInicio = trim(fgets(STDIN));
        $nuevaFuncion->setHoraInicio($horaInicio);
        $seSolapa = $teatro->seSolapan($nuevaFuncion);  //Verifico de nuevo si la funcion se solapa con otra funcion
    }

    //Agrego en la ultima posicion del arreglo de funciones la funcion ingresada
    $arregloFunciones = $teatro->getColFunciones();
    $arregloFunciones[count($arregloFunciones)] = $nuevaFuncion;
    $teatro->setColFunciones($arregloFunciones);
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
    $teatro->setDireccion($nuevaDireccion);  //Reemplazo la direccion anterior por la nueva
}

//OPCION 5
function cambiarDatosFuncion($teatro) {
    /*array $coleccionFuncionesTeatro
    String $funcionBuscada, $nuevoNombreFuncion, $nuevoHorarioFuncion
    int $numeroFuncion, $nuevaDuracionFuncion
    float $nuevoPrecioFuncion*/
    echo "Ingrese el nombre de la funcion a modificar: ";
    $funcionBuscada = trim(fgets(STDIN));
    $numeroFuncion = $teatro->buscarFuncion($funcionBuscada);

    if ($numeroFuncion >= 0) {
        $coleccionFuncionesTeatro = $teatro->getColFunciones();

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
        $teatro->setColFunciones($coleccionFuncionesTeatro);
    }
}

//OPCION 6
function mostrarCostos($teatro) {
    //int $costoTotal
    $costoTotal = $teatro->calcularCostoTotal();
    echo $costoTotal."\n";
}



