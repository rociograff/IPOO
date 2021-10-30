<?php
include 'Persona.php';
include 'Inmueble.php';
include 'Edificio.php';

$persona1 = new Persona("DNI", 12333456, "Pepe", "Suarez", 4456722);
$persona2 = new Persona("DNI", 12333422, "Pedro", "Suarez", 446678);
$administrador = new Persona("DNI", 27432561, "Carlos", "Martinez", 154321233);

//INCISO 2
$inmueble1 = new Inmueble(11, 1, "local comercial", 50000, $persona1);
$inmueble2 = new Inmueble(12, 1, "local comercial", 50000, null);
$inmueble3 = new Inmueble(13, 2, "departamento", 35000, $persona2);
$inmueble4 = new Inmueble(14, 2, "departamento", 35000, null);
$inmueble5 = new Inmueble(15, 3, "departamento", 35000, null);

$coleccionDepartamentos = [$inmueble1, $inmueble2, $inmueble3, $inmueble4, $inmueble5];
//INCISO 1
$edificio = new Edificio("Juan B. Justo 3456", $coleccionDepartamentos, $administrador);

//INCISO 4
echo "-------EJECUTANDO INCISO 4-------\n";
$inmueblesDisponibles = $edificio->darInmueblesDisponiblesParaAlquiler("local comercial", 4000);
mostrarColeccion($inmueblesDisponibles);

//INCISO 5
echo "-------EJECUTANDO INCISO 5-------\n";
$persona3 = new Persona("DNI", 28765436, "Mariela", "Suarez", 25543562);
echo ($edificio->registrarAlquilerInmueble($inmueble5, $persona3)) ? "OK!\n\n" : "ERROR\n\n";

//INCISO 6
echo "-------EJECUTANDO INCISO 6-------\n";
echo ($edificio->registrarAlquilerInmueble($inmueble4, $persona3)) ? "OK!\n\n" : "ERROR\n\n";

//INCISO 7
echo "-------EJECUTANDO INCISO 7-------\n";
echo "$" . $edificio->calcularCostoEdificio() . "\n\n";

//INCISO 8
echo "-------EJECUTANDO INCISO 8-------\n";
echo $edificio . "\n";

function mostrarColeccion($coleccion) {
    for ($i = 0; $i < count($coleccion); $i++) {
        echo $coleccion[$i] . "\n";
    }
}