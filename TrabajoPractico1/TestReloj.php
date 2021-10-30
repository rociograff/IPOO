<?php
include 'Reloj.php';

//PROGRAMA PRINCIPAL
/**
 * Declaracion de variables
 * int $reloj, $reloj2
 */
$reloj = new Reloj(23,59,58);
echo $reloj. "\n";
$reloj -> incremento();
echo $reloj. "\n";
$reloj -> incremento();
echo $reloj. "\n";

$reloj2 = new Reloj(13,50,8);
echo $reloj2."\n";
$reloj2 -> puestaACero();
echo $reloj2."\n";
