<?php
include 'Aerolinea.php';
include 'Avion.php';
include 'Destino.php';
include 'Pasajero.php';
include 'Vuelo.php';
include 'Internacional.php';
include 'Nacional.php';

//INCISO 1
$d1 = new Destino("Neuquen", "Neuquen");
$d2 = new Destino("Bariloche", "Rio Negro");

//INCISO 2
$av1 = new Avion(0, 1, 1);
$av2 = new Avion(1, 1, 1);

//INCISO 3
$aerolinea = new Aerolinea("Aerolineas Argentinas", []);

//INCISO 4
$p1 = new Pasajero(123456, 39614732, "Argentina", "Pablo", "Gonzalez");
$p2 = new Pasajero(456789, 42186347, "Argentina", "Laura", "Sabio");

//INCISO 5
echo "----------EJECUTANDO INCISO 5----------\n";
$coleccion = [
    "partida" => "22:00",
    "hora de llegada al destino" => "23:50",
    "importe" => 1000,
];
$vuelo1 = $aerolinea->configurarVuelo($d1, $av1, $coleccion, $tipoVuelo);
$coleccionVuelos = $aerolinea->getColVuelos();
array_push($coleccionVuelos, $vuelo1);
$aerolinea->setColVuelos($coleccionVuelos);

echo "VUELO 1:\n" . $vuelo1 . "\n";

$vuelo2 = $aerolinea->configurarVuelo($d2, $av2, $coleccion, $tipoVuelo);
$coleccionVuelos = $aerolinea->getColVuelos();
array_push($coleccionVuelos, $vuelo2);
$aerolinea->setColVuelos($coleccionVuelos);

echo "VUELO 2:\n" . $vuelo2 . "\n";

//INCISO 6
echo "----------EJECUTANDO INCISO 6----------\n";
$costo1 = $aerolinea->venderVuelo(0, $p1, "economica");
echo "$" . $costo1 . "\n";

//INCISO 7
echo "----------EJECUTANDO INCISO 7----------\n";
$costo2 = $aerolinea->venderVuelo(0, $p2, "economica");
echo "$" . $costo2 . "\n";