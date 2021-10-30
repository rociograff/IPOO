<?php
include 'Punto.php';
$p = new Punto(5, 7); // se crea un objeto punto y se asigna a la variable p
echo $p->getCoordenada_x(); // se visualiza el valor contenido en la variable instancia x
echo $p->getCoordenada_y(); // se visualiza el valor contenido en la variable instancia y

$p2 = new Punto(10, 14);
echo $p2;
echo "La distancia entre los punto es: " . $p->distancia($p2) . "\n";

echo "La distancia entre los punto es: " . $p->distancia_2($p2) . "\n";