<?php
include 'Fecha.php';

$p = new fecha(05, 07, 2020);
echo "---------indica si el anio ingresado es bisiesto--------------" . "\n";
if ($p->bisiesto()) {
    echo "es anio bisiesto" . "\n";
} else {
    echo "no es anio bisiesto" . "\n";
}
echo "---------Fecho en forma abrebiada--------------" . "\n";
echo $p->fechaEscrita();
echo "---------Fecho en forma escrita--------------" . "\n";
$p->incrementarDias(27);
echo $p;