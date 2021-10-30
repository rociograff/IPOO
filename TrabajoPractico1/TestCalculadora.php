<?php
include 'Calculadora.php';

/**
 * PRGRAMA PRINCIPAL
 * Declaracion de variables
 * int $numero1, $numero2
 */

echo "Ingrese el primer numero: ";
$numero1 = trim(fgets(STDIN));
echo "Ingrese el segundo numero: ";
$numero2 = trim(fgets(STDIN));

$resultado = new Calculadora($numero1, $numero2);

echo "El resultado de la suma entre ".$numero1." y ".$numero2." es: ". $resultado -> suma($numero1, $numero2)."\n";
echo "El resultado de la resta entre ".$numero1." y ".$numero2." es: ".$resultado -> resta($numero1, $numero2)."\n";
echo "El resultado de multiplicar entre ".$numero1." y ".$numero2." es: ".$resultado -> multiplicar($numero1, $numero2)."\n";
echo "El resultado de dividir entre ".$numero1." y ".$numero2." es: ".$resultado -> dividir($numero1, $numero2)."\n";
            
