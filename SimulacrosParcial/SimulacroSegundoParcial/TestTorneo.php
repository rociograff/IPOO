<?php
include_once 'Torneo.php';
include_once 'Equipo.php';
include_once 'Categoria.php';
include_once 'Partido.php';
include_once 'Futbol.php';
include_once 'Basquetbol.php';

$objE1 = new Equipo('river', 'pepito', 6, 'juveniles');
$objE2 = new Equipo('boca', 'jose', 6, 'juveniles');
$objE3 = new Equipo('racing', 'matias', 7, 'menores');
$objE4 = new Equipo('san lorenzo', 'tomas', 7, 'menores');
$objE5 = new Equipo('dr', 'pedro', 5, 'mayores');
$objE6 = new Equipo('asd', 'lucho', 5, 'juveniles');
$objE7 = new Equipo('lkf', 'maria', 10, 'mayores');
$objE8 = new Equipo('bhdas', 'pablo', 10, 'mayores');
$objE9 = new Equipo('ewr', 'paula', 6, 'menores');
$objE10 = new Equipo('asq', 'lucia', 6, 'menores');
$objE11 = new Equipo('lpm', 'ruben', 10, 'mayores');
$objE12 = new Equipo('pqw', 'liliana', 9, 'juveniles');

//INCISO 1
$objPart1 = new Basquetbol(1, $objE7, $objE8, '2020-10-10', 80, 120, 75);
$objPart2 = new Basquetbol(2, $objE9, $objE10, '2020-10-25', 81, 110, 70);
$objPart3 = new Basquetbol(3, $objE11, $objE12, '2020-11-25', 115, 85, 110);
$objPart4 = new Futbol(4, $objE1, $objE2, '2020-10-25', 3, 2);
$objPart5 = new Futbol(5, $objE3, $objE4, '2020-11-13', 0, 1);
$objPart6 = new Futbol(6, $objE5, $objE6, '2020-11-30', 2, 3);

$coleccionPartidos = [$objPart1, $objPart2, $objPart3, $objPart4, $objPart5, $objPart6];

$torneo = new Torneo($coleccionPartidos, 100000);

//INCISO 2
echo "----------EJECUTANDO INCISO 2----------\n";
$partido = $torneo->ingresarPartido($objE7, $objE11, '10-11-20', 'basquetbol');
echo (($partido) ? "Exito" : "Error")."\n";  //Deberia retornar true porque los dos equipos tienen misma categoria y cantidad de jugadores

//INCISO 3
echo "----------EJECUTANDO INCISO 3----------\n";
$ganadores = $torneo->darGanadores('basquetbol');
foreach ($ganadores as $objEquipo) {
    echo $objEquipo . "\n";
}

//INCISO 4
echo "----------EJECUTANDO INCISO 4----------\n";
$ganadores = $torneo->darGanadores('futbol');
foreach ($ganadores as $objEquipo) {
    echo $objEquipo . "\n";
}

//INCISO 5
echo "----------EJECUTANDO INCISO 5----------\n";
$calcularPremio = $torneo->calcularPremioPartido($objPart1);
print_r($calcularPremio);
$calcularPremio = $torneo->calcularPremioPartido($objPart2);
print_r($calcularPremio);
$calcularPremio = $torneo->calcularPremioPartido($objPart3);
print_r($calcularPremio);
$calcularPremio = $torneo->calcularPremioPartido($objPart4);
print_r($calcularPremio);
$calcularPremio = $torneo->calcularPremioPartido($objPart5);
print_r($calcularPremio);
$calcularPremio = $torneo->calcularPremioPartido($objPart6);
print_r($calcularPremio);
