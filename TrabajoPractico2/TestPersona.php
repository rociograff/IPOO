<?php 
include 'Persona.php';

/**
 * PROGRAMA PRINCIPAL
 * Declaracion de variables
 * $nombre, $apellido, $tipoDocumento, $numeroDocumento, $persona
 */
echo "Ingrese el nombre de la persona: ";
$nombre = trim(fgets(STDIN));
echo "Ingrese el apellido de la persona: ";
$apellido = trim(fgets(STDIN));
echo "Ingrese el tipo de documento: ";
$tipoDocumento = trim(fgets(STDIN));
echo "Ingrese el numero de documento: ";
$numeroDocumento = trim(fgets(STDIN));

$persona = new Persona($nombre, $apellido, $tipoDocumento, $numeroDocumento);

echo "Los datos de la persona son: ", $persona;