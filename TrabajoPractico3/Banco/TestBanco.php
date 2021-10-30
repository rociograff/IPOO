<?php
include_once "Banco.php";
include_once "Persona.php";
include_once "Cliente.php";
include_once "Cuenta.php";
include_once "CajaAhorro.php";
include_once "CuentaCorriente.php";

$cliente1 = new Cliente("39647251", "Maria", "Gonzalez", 1);
$cliente2 = new Cliente("42713951", "Pablo", "Martinez", 2);
$colClientes = [$cliente1, $cliente2];

$banco = new Banco($colClientes);
$cuenta1 = $banco->incorporarCuentaCorriente(1);
$banco->incorporarCuentaCorriente(3);
$banco->incorporarCajaAhorro(1);
$banco->incorporarCajaAhorro(1);
$cuenta2 = $banco->incorporarCajaAhorro(2);
$banco->incorporarCajaAhorro(3);
$cuentaCorriente = $banco->getColCuentaCorriente();
$colCajaAhorro = $banco->getColCajaAhorro();
$colCuenta = array_merge($colCajaAhorro, $cuentaCorriente);
foreach($colCuenta as $objCuenta) {
    $numCuenta = $objCuenta->getNumeroCuenta();
    $banco->realizarDeposito($numCuenta, 100000);
}

$retiro = $cuenta1->realizarRetiro(350);
$deposito = $cuenta2->realizarDeposito(350);

$banco->realizarDeposito($cuenta1->getNumeroCuenta(), 1350);

echo $banco;