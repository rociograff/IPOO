<?php
include 'Persona.php';
include 'Disquera.php';

function menu() {
    echo "Elija la opcion correspondiente: \n";
    echo "0) Salir.\n";
    echo "1) Cargar datos.\n";
    echo "2) Abrir disquera.\n";
    echo "3) Cerrar disquera.\n";
    echo "4) Consultar horarios de atencion.\n";
    echo "5) Mostrar informacion de la disquera.\n";
    $opcion = trim(fgets(STDIN));
    return $opcion;
}

/**
 * PROGRAMA PRICIPAL
 * Declaracion de variables
 * $duenio, $disquera
 * int $opcion, $horaDesde, $horaHasta, $documento, $hora
 * String $estado, $direccion, $nombre, $apellido, $tipoDoc
 * boolean $datosCargados
 */
do{
    $opcion = menu();

    switch($opcion) {
        case 0:
            echo "Fin del programa.";
            break;
        case 1:
            echo "Ingrese horario de apertura: \n";
            $horaDesde = trim(fgets(STDIN));
            echo "Ingrese horario de cierre: \n";
            $horaHasta = trim(fgets(STDIN));
            echo "Ingrese estado (Abierto/Cerrado): \n";
            $estado = trim(fgets(STDIN));
            echo "Ingrese direccion: \n";
            $direccion = trim(fgets(STDIN));
            echo "\n -----------------------------------\n";
            echo "Datos del dueño de la disquera\n";    
            echo "Ingrese el nombre: \n";
            $nombre =  trim(fgets(STDIN));
            echo "Ingrese el apellido: \n";
            $apellido =  trim(fgets(STDIN));;
            echo "Ingrese tipo de Documento: \n";
            $tipoDoc = trim(fgets(STDIN));
            echo "Ingrese el número de documento: \n";
            $documento =  trim(fgets(STDIN));

            $duenio = new Persona($nombre, $apellido, $tipoDoc, $documento);
            $disquera = new Disquera($horaDesde, $horaHasta, $estado, $direccion, $duenio);
            $datosCargados = true;
            break;
        case 2:
            if ($datosCargados == true) {
                echo "Ingrese horario de apertura: \n";
                $hora = trim(fgets(STDIN));
                $disquera -> abrirDisquera($hora);
            }else {
                echo "ERROR NO HAY DATOS CARGADOS.\n";
            }
            break;
        case 3:
            if($datosCargados == true) {
                echo "Ingrese horario de cierre: \n";
                $hora = trim(fgets(STDIN));
                $disquera -> cerrarDisquera($hora);
            }else {
                echo "ERROR NO HAY DATOS CARGADOS.\n";
            }
            break;
        case 4:
            if($datosCargados == true) {
                echo "Ingrese horario de consulta: \n";
                $hora = trim(fgets(STDIN));
                if($disquera -> dentroHorarioAtencion($hora)) {
                    echo "La disquera se encuentra abrieta.\n";
                }else {
                    echo "La disquera se encuentra cerrada.\n";
                }
            }else {
                echo "ERROS NO HAY DATOS CARGADOS.\n";
            }
            break;
        case 5:
            if($datosCargados == true) {
                echo $disquera;
            }else {
                echo "ERROR NO HAY DATOS CARGADOS.\n";
            }
            break;
    }
}while($opcion != 0);