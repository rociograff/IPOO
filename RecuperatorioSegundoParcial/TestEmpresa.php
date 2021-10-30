<?php
include_once 'Plan.php';
include_once 'Canal.php';
include_once 'Cliente.php';
include_once 'EmpresaCable.php';
include_once 'Contrato.php';
include_once 'ContratoWeb.php';
include_once 'ContratoEmpresa.php';

//INCISO A
echo "----EJECUTANDO INCISO A----\n";
//($colPlanes, $colContratos)
$empresa = new EmpresaCable([], []);

//INCISO B
echo "----EJECUTANDO INCISO B----\n";
//($tipoCanal, $importeCanal, $esHD)
$canal1 = new Canal("familiar", 100, "Si");
$canal2 = new Canal("accion", 100, "Si");
$canal3 = new Canal("deporte", 100, "Si");
$coleccionCanales = [$canal1, $canal2, $canal3];

//INCISO C
echo "----EJECUTANDO INCISO C----\n";
//($codigoPlan, $colCanales, $importePlan, $incluyeMG)
$plan1 = new Plan(111, $coleccionCanales, 500, "Si");
$plan2 = new Plan(100, $coleccionCanales, 4000, "Si");
$coleccionPlanes = [$plan1, $plan2];

//INCISO D
echo "----EJECUTANDO INCISO D----\n";
//($nombre, $apellido, $documento)
$cliente = new Cliente("Rocio", "Graff", 39584581);

//INCISO E
echo "----EJECUTANDO INCISO E----\n";
$fechaInicio1 = date('d-m-Y');
$fechaVencimiento1 = date('d-m-Y', strtotime($fechaInicio1 . "+ 1 month"));
//($fechaInicio, $fechaVencimiento, $objPlan, $estado, $costo, $seRenueva, $objCliente)
$contrato1 = New ContratoEmpresa($fechaInicio1, $fechaVencimiento1, $plan1, "Al dia", 0, "Si", $cliente);
$contrato2 = New ContratoWeb($fechaInicio1, $fechaVencimiento1, $plan2, "Al dia", 0, "Si", $cliente);
$contrato3 = New ContratoWeb($fechaInicio1, $fechaVencimiento1, $plan2, "Al dia", 0, "Si", $cliente);
$colesccionContratos = [$contrato1, $contrato2, $contrato3];

//INCISO F
echo "----EJECUTANDO INCISO F----\n";
$importe = $contrato1->calcularImporte();
echo "El importe del contrato1 es: ".$importe;

$importe = $contrato2->calcularImporte();
echo "El importe del contrato2 es: ".$importe;

$importe = $contrato3->calcularImporte();
echo "El importe del contrato3 es: ".$importe;

//INCISO G
echo "----EJECUTANDO INCISO G----\n";
echo ($empresaCable->incorporarPlan($plan1)) ? "EXITO\n" : "ERROR\n";

//INCISO H
echo "----EJECUTANDO INCISO H----\n";
//Si no se setea el valor de los datos incluidos a uno diferente de 50, devolvera error.
//$plan2->setDatosIncluidos(15);
//En caso de pasar por parametro el $plan1, retorna ERROR, sin importar si se cambia el valor de los datos incluidos
//$plan1->setDatosIncluidos(10);
echo ($empresaCable->incorporarPlan($plan2)) ? "EXITO\n" : "ERROR\n";

//INCISO I
echo "----EJECUTANDO INCISO I----\n";
$fechaInicio2 = date('d-m-Y');
$fechaVencimiento2 = date('d-m-Y', strtotime($fechaInicio2 . "+ 1 month"));
$agregarContrato = $empresa->incorporarContrato($plan1, $cliente, $fechaInicio2, $fechaVencimiento2, false);
echo $agregrarContrato;

//INCISO J
echo "----EJECUTANDO INCISO J----\n";
$agregarContrato = $empresa->incorporarContrato($plan2, $cliente, $fechaInicio2, $fechaVencimiento2, true);
echo $agregrarContrato;

//INCISO K
echo "----EJECUTANDO INCISO K----\n";
$pagar = $empresa->pagarContrato($contrato1);
echo "El importe a pagar es: ".$pagar."\n";

//INCISO L
echo "----EJECUTANDO INCISO L----\n";
$pagar = $empresa->pagarContrato($contrato3);
echo "El importe a pagar es: ".$pagar."\n";

//INCISO M
echo "----EJECUTANDO INCISO M----\n";
$retornar = $empresa->retornarImporteContratos(111);
echo $retornar;