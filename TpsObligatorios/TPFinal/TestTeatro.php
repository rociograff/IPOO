<?php
include_once "ORM/BaseDatos.php";
include_once "ORM/Funcion.php";
include_once "ORM/Teatro.php";
include_once "ORM/Cine.php";
include_once "ORM/Musical.php";
include_once "ORM/Obra.php";
include_once "transacciones/abmFuncion.php";
include_once "transacciones/abmTeatro.php";
include_once "transacciones/abmCine.php";
include_once "transacciones/abmMusical.php";
include_once "transacciones/abmObra.php";

//PROGRAMA PRINCIPAL
opcion();

/**
 * Funcion que llama al menu, y redirecciona segun la opcion recibida
 */
function opcion(){
    do {
        $opcion = menu();
        switch ($opcion) {
            case 1:
                cargaTeatro();
                break;
            case 2:
                cargaFuncion();
                break;
            case 3:
                modificarNombreTeatro();
                break;
            case 4:
                modificarDireccionTeatro();
                break;
            case 5:
                cambiarNombreFuncion();
                break;
            case 6:
                cambiarPrecioFuncion();
                break;
            case 7:
                darCostoDelTeatro();
                break;
            case 8:
                mostrarInformacionTeatro();
                break;
            case 9:
                mostrarInformacioFuncion();
                break;
            case 10:
                eliminarFuncion();
                break;
            case 11:
                eliminarTeatro();
                break;
        }
    } while ($opcion != 12);
}

/**
 * Funcion que muestra un menu, permitiendo elegir una de las opciones
 * @return int $opcion
 */
function menu(){
    $esValido = false;
    echo "\nSeleccione una opcion:" . "\n";
    echo "-----------------------------------" . "\n";
    echo " 1) Cargar Teatro" . "\n" .
        " 2) Cargar Funcion" . "\n" .
        " 3) Modificar nombre de un Teatro" . "\n" .
        " 4) Modificar direccion de un Teatro" . "\n" .
        " 5) Modificar nombre de una Funcion" . "\n" .
        " 6) Modificar precio de una Funcion" . "\n" .
        " 7) Dar costo del uso de un teatro" . "\n" .
        " 8) Mostrar informacion Teatros" . "\n" .
        " 9) Mostrar informacion Funciones" . "\n" .
        " 10) Eliminar Funcion" . "\n" .
        " 11) Eliminar Teatro" . "\n" .
        " 12) Salir" . "\n";
    echo "-----------------------------------" . "\n";

    do {
        $opcion = trim(fgets(STDIN));

        if ($opcion >= 1 && $opcion <= 12) {
            $esValido = true;
        } else {
            echo "Ingrese una opcion valida." . "\n";
        }
    } while (!$esValido);

    return $opcion;
}

/**
 * Funcion que carga los datos solicitados del teatro
 */
function cargaTeatro(){
    $abmT = new abmTeatro();
    echo "Ingrese nombre del teatro:" . "\n";
    $nombre = trim(fgets(STDIN));
    echo "Ingrese direccion del teatro:" . "\n";
    $direccion = trim(fgets(STDIN));
    $exito = $abmT->crearTeatro($nombre, $direccion);
    if ($exito) {
        echo "\n* El teatro se cargo con exito * \n\n";
    } else {
        echo "\n* El teatro no se cargo * \n\n";
    }
}

/**
 * Func. Carga una funcion y muestra si la operacion tuvo exito
 */
function cargaFuncion(){
    $objTeatro = seleccionarTeatro();

    $exito = cargaDatosFuncion($objTeatro);

    if ($exito) {
        echo "\n* La funcion se cargo correctamente *" . "\n" . "\n";
    } else {
        echo "\n* La fecha y horario de la funcion es invalido *" . "\n" . "\n";
    }
}

/**
 * Func. pide y carga los datos de una funcion a la coleccion del Teatro
 * @param object $objTeatro
 */
function cargaDatosFuncion($objTeatro){
    $abmT = new abmTeatro();
    echo "Ingrese el tipo de funcion a cargar: Musical, Cine, Obra." . "\n";
    $tipoFuncion = trim(fgets(STDIN));

    echo "Ingrese nombre de la funcion" . "\n";
    $nombreF = trim(fgets(STDIN));
    echo "Fecha de la funcion (numérica)" . "\n";
    echo "Dia: " . "\n";
    $dia = trim(fgets(STDIN));
    echo "Mes: " . "\n";
    $mes = trim(fgets(STDIN));
    echo "Año: " . "\n";
    $anio = trim(fgets(STDIN));
    echo "Horario de la funcion: " . "\n";
    echo "Hora: " . "\n";
    $hsInicio = trim(fgets(STDIN));
    echo "Minutos: " . "\n";
    $mintInicio = trim(fgets(STDIN));
    echo "Duracion de la funcion: " . "\n";
    echo "Hora: " . "\n";
    $hsDuracion = trim(fgets(STDIN));
    echo "Minutos: " . "\n";
    $mintDuracion = trim(fgets(STDIN));
    echo "Ingrese precio de la funcion" . "\n";
    $precioF = trim(fgets(STDIN));

    $inicio = pasarASegundos($hsInicio, $mintInicio);
    $duracion = pasarASegundos($hsDuracion, $mintDuracion);

    $fecha = $anio . "-" . $mes . "-" . $dia;
    $datos = ["nombre" => $nombreF, "hsInicio" => $inicio, "duracion" => $duracion, "precio" => $precioF, "fecha" => $fecha, "teatro" => $objTeatro, "tipo" => $tipoFuncion, "director" => "", "personasEnEscena" => 0, "genero" => "", "paisOrigen" => ""];
    if (strtolower($tipoFuncion) == "musical") {
        echo "Ingrese director del Musical" . "\n";
        $director = trim(fgets(STDIN));
        echo "Cantidad de personas en escena:" . "\n";
        $persEscena = trim(fgets(STDIN));
        $datos["director"] = $director;
        $datos["personasEnEscena"] = $persEscena;
    } else if (strtolower($tipoFuncion) == "cine") {
        echo "Ingrese genero de la pelicula" . "\n";
        $genero = trim(fgets(STDIN));
        echo "Ingrese pais de origen de la pelicula" . "\n";
        $origen = trim(fgets(STDIN));
        $datos["genero"] = $genero;
        $datos["paisOrigen"] = $origen;
    }
    $exito = $abmT->cargarFuncion($datos);

    return $exito;
}

/**
 * Funcion que modifica el nombre del teatro
 */
function modificarDireccionTeatro(){
    $abmT = new abmTeatro();
    $objTeatro = seleccionarTeatro();

    echo "Ingrese la nueva direccion del teatro \n";
    $direcTeatro = trim(fgets(STDIN));
    $exito = $abmT->modificarDireccion($objTeatro, $direcTeatro);
    if ($exito) {
        echo "\n* Modificacion exitosa *" . "\n" . "\n";
    } else {
        echo "\n* Modificacion Fallida: el teatro a modificar no existe *" . "\n" . "\n";
    }
}

/**
 * Modifica el nombre de un teatro
 */
function modificarNombreTeatro(){
    $abmT = new abmTeatro();
    $objTeatro = seleccionarTeatro();

    echo "Ingrese el nuevo nombre del teatro \n";
    $nomTeatro = trim(fgets(STDIN));
    $exito = $abmT->modificarNombre($objTeatro, $nomTeatro);
    if ($exito) {
        echo "\n* Modificacion exitosa *" . "\n" . "\n";
    } else {
        echo "\n* Modificacion Fallida: el teatro a modificar no existe *" . "\n" . "\n";
    }
}

/**
 * Func. cambia el nombre de una funcion y muestra si la operacion tuvo exito
 */
function cambiarNombreFuncion(){
    $objFuncion = seleccionarFuncion();
    $abm = new abmFuncion();
    echo "Ingrese el nuevo nombre de la funcion \n";
    $nomFuncion = trim(fgets(STDIN));
    $exito = $abm->modificarNombre($objFuncion, $nomFuncion);

    if ($exito) {
        echo "\n* Modificacion exitosa *" . "\n" . "\n";
    } else {
        echo "\n* Modificacion Fallida: la funcion a modificar no existe *" . "\n" . "\n";
    }
}

/**
 * Func. cambia el precio de una funcion y muestra si la operacion tuvo exito
 */
function cambiarPrecioFuncion(){
    $objFuncion = seleccionarFuncion();
    $abm = new abmFuncion();
    echo "Ingrese el nuevo precio de la funcion \n";
    $preFuncion = trim(fgets(STDIN));
    $exito = $abm->modificarPrecio($objFuncion, $preFuncion);

    if ($exito) {
        echo "\n* Modificacion exitosa *" . "\n" . "\n";
    } else {
        echo "\n* Modificacion Fallida: la funcion a modificar no existe *" . "\n" . "\n";
    }
}

/**
 * Retorna el obFuncion con el que se desea trabajar
 * @return object $objFuncion
 */
function seleccionarFuncion(){
    $abmF = new abmFuncion();
    echo "Ingrese el id de la funcion con el que desea operar\n";
    echo $abmF->mostrarFunciones();
    $idFuncion = trim(fgets(STDIN));
    $objFuncion = $abmF->recuperarFuncion($idFuncion);

    return $objFuncion;
}

/**
 * Retorna el objTeatro con el que se desea trabajar
 * @return object $objTeatro
 */
function seleccionarTeatro(){
    $abmT = new abmTeatro();
    echo "Ingrese el ID del teatro con el que desea operar\n";
    echo $abmT->mostrarTeatros();
    $idT = trim(fgets(STDIN));
    $objTeatro = $abmT->recuperarTeatro($idT);

    return $objTeatro;
}

/**
 * Muestra el costo final del uso de un teatro para un mes dado
 */
function darCostoDelTeatro(){
    $abmT = new abmTeatro();
    $objTeatro = seleccionarTeatro();

    echo "Ingrese mes (1-12) del que quiere conocer el costo: " . "\n";
    $mes = trim(fgets(STDIN));
    $costoFinal = $abmT->darCostoTeatro($mes, $objTeatro);

    echo "Teatro: " . $objTeatro->getNombre() . " - Costo del mes " . $mes . " $" . round($costoFinal, 2) . "\n" . "\n";
}

/**
 * Funcion que muestra la informacion de los teatros cargados
 */
function mostrarInformacionTeatro(){
    $abmT = new abmTeatro();
    echo $abmT->mostrarTeatros();
}

/**
 * Muestra la informacion de las funciones cargadas
 */
function mostrarInformacioFuncion(){
    $ambF = new abmCine();
    echo $ambF->mostrarCines();
    $ambF = new abmMusical();
    echo $ambF->mostrarMusicales();
    $ambF = new abmObra();
    echo $ambF->mostrarObras();
}

/**
 * Func. Que pasa un horario de Hs:Mint a su equivalente en segundos
 * @param int $hs
 * @param int $mint
 * @return int $segTotales
 */
function pasarASegundos($hs, $mint){
    $segTotales = ($hs * 3600) + ($mint * 60);

    return $segTotales;
}

/**
 * Elimina un teatro 
 */
function eliminarTeatro(){
    $abmT = new abmTeatro();
    $objTeatro = seleccionarTeatro();
    $exito = $abmT->eliminarTeatro($objTeatro);
    if ($exito) {
        echo "\n* El teatro fue eliminado con exito * \n";
    } else {
        echo "\n* El teatro no pudo ser eliminado * \n";
    }
}

/**
 * Elimina una funcion
 */
function eliminarFuncion(){
    $abm = new abmFuncion();
    echo $abm->mostrarFunciones();
    echo "Ingrese el id de la funcion a eliminar \n";
    $id = trim(fgets(STDIN));

    $abm = new abmCine();
    $exito = $abm->eliminarCine($id);
    if (!$exito) {
        $abm = new abmMusical();
        $exito = $abm->eliminarMusical($id);
        if (!$exito) {
            $abm = new abmObra();
            $exito = $abm->eliminarObra($id);
        }
    }
    if ($exito) {
        echo "\n* Funcion eliminada con exito * \n";
    } else {
        echo "\n* La funcion no se ha podido eliminar * \n";
    }
}
    