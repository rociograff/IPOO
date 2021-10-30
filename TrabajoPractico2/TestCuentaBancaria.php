<?php
include 'Persona.php';
include 'CuentaBancaria.php';

echo "Ingrese el nombre de la persona: ";
$nombre = trim(fgets(STDIN));
echo "Ingrese el apellido de la persona: ";
$apellido = trim(fgets(STDIN));
echo "Ingrese el tipo de documento: ";
$tipoDocumento = trim(fgets(STDIN));
echo "Ingrese el numero de documento: ";
$numeroDocumento = trim(fgets(STDIN));

$persona = new Persona($nombre, $apellido, $tipoDocumento, $numeroDocumento);

echo "\n----------------------------------------\n";
echo "Ingrese su numero de cuenta: ";
$numCuenta = trim(fgets(STDIN));
echo "Ingrese su saldo actual: ";
$saldo = trim(fgets(STDIN));
echo "Ingrese su interes anual: ";
$interes = trim(fgets(STDIN));

$cuenta = new CuentaBancaria($numCuenta, $persona, $saldo, $interes);
	
echo "\n----------------------------------------\n";
echo "Los datos son: ","\n",$cuenta;