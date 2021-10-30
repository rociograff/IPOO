<?php
include 'Categoria.php';
include 'Equipo.php';
include 'Torneo.php';
include 'Nacional.php';
include 'Provinciales.php';
include 'Partido.php';
include 'MinisterioDeporte.php';

// Creo las categorias
$categoriaMayores = new Categoria(3, 'mayores');

// Creo los equipos
$objE1 = new Equipo('pepe1', 'Enrique Iglesias', 17, $categoriaMayores);
$objE2 = new Equipo('pepe2', 'Juan Gabriel', 17, $categoriaMayores);
$objE3 = new Equipo('pepe3', 'Eminem', 14, $categoriaMayores);
$objE4 = new Equipo('pepe4', 'Bizarrap', 14, $categoriaMayores);
$objE5 = new Equipo('pepe5', 'JBalvin', 16, $categoriaMayores);
$objE6 = new Equipo('pepe6', 'Fer Palacios', 16, $categoriaMayores);
$objE7 = new Equipo('pepe7', 'Daddy Yankee', 22, $categoriaMayores);
$objE8 = new Equipo('pepe8', 'Bad Bunny', 22, $categoriaMayores);

// Creo los partidos de futbol provinciales
$objPartido1 = new Partido(1, '1/10/2020', $objE1, 3, $objE2, 2);
$objPartido2 = new Partido(2, '1/10/2020', $objE3, 0, $objE4, 2);
$objPartido3 = new Partido(3, '2/10/2020', $objE1, 2, $objE3, 3);
$objPartido4 = new Partido(4, '2/10/2020', $objE2, 4, $objE4, 2);
$objPartido5 = new Partido(5, '3/10/2020', $objE1, 2, $objE4, 2);
$objPartido6 = new Partido(6, '3/10/2020', $objE2, 0, $objE3, 1);
$objPartido7 = new Partido(7, '4/10/2020', $objE1, 1, $objE2, 0);
$objPartido8 = new Partido(8, '4/10/2020', $objE3, 4, $objE4, 1);
$objPartido9 = new Partido(9, '5/10/2020', $objE1, 3, $objE3, 1);
$objPartido10 = new Partido(10, '5/10/2020', $objE2, 5, $objE4, 3);
$objPartido11 = new Partido(11, '6/10/2020', $objE1, 1, $objE4, 2);
$objPartido12 = new Partido(12, '6/10/2020', $objE2, 0, $objE3, 1);

// Creo los partidos de nacionales
$objPartido13 = new Partido(13, '1/11/2020', $objE1, 2, $objE2, 4);
$objPartido14 = new Partido(14, '1/11/2020', $objE3, 5, $objE4, 3);
$objPartido15 = new Partido(15, '2/11/2020', $objE1, 3, $objE3, 6);
$objPartido16 = new Partido(16, '2/11/2020', $objE2, 1, $objE4, 3);
$objPartido17 = new Partido(17, '3/11/2020', $objE1, 0, $objE4, 5);
$objPartido18 = new Partido(18, '3/11/2020', $objE2, 3, $objE3, 1);
$objPartido19 = new Partido(19, '4/11/2020', $objE1, 6, $objE2, 0);
$objPartido20 = new Partido(20, '4/11/2020', $objE3, 0, $objE4, 3);
$objPartido21 = new Partido(21, '5/11/2020', $objE1, 0, $objE3, 5);
$objPartido22 = new Partido(22, '5/11/2020', $objE2, 3, $objE4, 2);
$objPartido23 = new Partido(23, '6/11/2020', $objE1, 1, $objE4, 3);
$objPartido24 = new Partido(24, '6/11/2020', $objE2, 3, $objE3, 5);

$coleccionPartidosProvinciales = array($objPartido1, $objPartido2, $objPartido3, $objPartido4, $objPartido5, $objPartido6, $objPartido7, $objPartido8, $objPartido9, $objPartido10, $objPartido11, $objPartido12);

$coleccionPartidosNacionales = array($objPartido13, $objPartido14, $objPartido15, $objPartido16, $objPartido17, $objPartido18, $objPartido19, $objPartido20, $objPartido21, $objPartido22, $objPartido23, $objPartido24);

$coleccionTorneos = array('provincial'=>[], 'nacional'=>[]);

$ministerioDeporte = new MinisterioDeporte(2020, $coleccionTorneos);

// echo $ministerioDeporte;

echo "--------------------" . "\n";

echo "PUNTO 5: REGISTRANDO TORNEO PROVINCIAL" . "\n";

echo "--------------------" . "\n";

$arrayAsociativoInfoTorneo = array('identificacion'=>1, 'importePremioTorneo'=>50000, 'localidad'=>'Neuquen Capital', 'nombreProvincia'=>'Neuquen');

$torneoNuevoProvincial = $ministerioDeporte->registrarTorneo($coleccionPartidosProvinciales, 'provincial', $arrayAsociativoInfoTorneo);

echo '---------TORNEO---------' . "\n";

echo $torneoNuevoProvincial;

echo "--------------------" . "\n";

echo "PUNTO 6: REGISTRANDO TORNEO NACIONAL" . "\n";

echo "--------------------" . "\n";

$arrayAsociativoInfoTorneo = array('identificacion'=>2, 'importePremioTorneo'=>100000, 'localidad'=>'San Justo');

$torneoNuevoNacional = $ministerioDeporte->registrarTorneo($coleccionPartidosProvinciales, 'nacional', $arrayAsociativoInfoTorneo);

echo '---------TORNEO---------' . "\n";

echo $torneoNuevoNacional;

echo "--------------------------------" . "\n";

echo "PUNTO 7: PREMIO TORNEO PROVINCIAL" . "\n";

echo "--------------------------------" . "\n";

$idTorneoProvincial = $torneoNuevoProvincial->getIdTorneo();

$premioTorneoProvincial = $ministerioDeporte->otorgarPremioTorneo($idTorneoProvincial);

$importeGanadorProvincial = $premioTorneoProvincial['importeGanado'];

$ganadorTorneoProvincial = $premioTorneoProvincial['equipoGanador'];

$nombreEquipo = $ganadorTorneoProvincial->getNombreEquipo();

echo "\n" . "El equipo " . $nombreEquipo . " han ganado el torneo provincial y se llevan $" . $importeGanadorProvincial . "\n";

echo "--------------------------------" . "\n";

echo "PUNTO 8: PREMIO TORNEO NACIONAL" . "\n";

echo "--------------------------------" . "\n";

$idTorneoNacional = $torneoNuevoNacional->getIdTorneo();

$premioTorneoNacional = $ministerioDeporte->otorgarPremioTorneo($idTorneoNacional);

$importeGanadorNacional = $premioTorneoNacional['importeGanado'];

$ganadorTorneoNacional = $premioTorneoNacional['equipoGanador'];

$nombreEquipo = $ganadorTorneoNacional->getNombreEquipo();

echo "\n" . "El equipo " . $nombreEquipo . " han ganado el Torneo Nacional y se llevan $" . $importeGanadorNacional . "\n";

echo "--------------------------------" . "\n";

echo "PUNTO 9: MINISTERIO DE DEPORTE" . "\n";

echo "--------------------------------" . "\n";

echo $ministerioDeporte;


