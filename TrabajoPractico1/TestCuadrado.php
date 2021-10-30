<?php
include 'Cuadrado.php';

$a = array("x" => 1 , "y" => 5);
$b = array("x" => 5 , "y" => 5);
$c = array("x" => 1 , "y" => 1);
$d = array("x" => 5 , "y" => 1);
$cuadrado = new Cuadrado($a, $b, $c, $d);
		
echo $cuadrado;
echo "el area del cuadrado es: ".$cuadrado -> area()."\n";
$cuadrado -> desplazar(array("x" => 2, "y" => 2));
echo $cuadrado;
echo "el area del cuadrado es: ".$cuadrado -> area()."\n";
echo $cuadrado -> aumentarTamanio(5);
echo "el area del cuadrado es: ".$cuadrado -> area();		
echo $cuadrado;