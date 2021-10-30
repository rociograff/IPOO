<?php
include 'CuentaBancaria.php';

//PROGRAMA PRINCIPAL
//int $cuenta $numCuenta, $dni, $saldo, $interes, $cant, $retira

echo "Ingrese su numero de cuenta: ";
$numCuenta = trim(fgets(STDIN));
echo "Ingrese su dni: ";
$dni = trim(fgets(STDIN));
echo "Ingrese su saldo actual: ";
$saldo = trim(fgets(STDIN));
echo "Ingrese su interes anual: ";
$interes = trim(fgets(STDIN));

$cuenta = new CuentaBancaria($numCuenta, $dni, $saldo, $interes);
	
$cuenta -> actualizarSaldo();
echo "\n----------------------\n";

echo $cuenta;
echo "\n Ingrese la cantidad de dinero que deposita: ";
$cant = trim(fgets(STDIN));
$cuenta -> depositar($cant);
echo "\n----------------------\n";

echo $cuenta;
echo "\n Ingrese la cantidad de dinero que retira: ";
$retira = trim(fgets(STDIN));
$cuenta -> retirar($retira);
echo "Se pudo hacer la operacion su saldo es: ".$cuenta -> getSaldoActual();
echo "\n----------------------\n";
echo $cuenta;