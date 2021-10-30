<?php
include "Empresa.php";
include "Venta.php";
include "Producto.php";
include "Cliente.php";

main();

function main() {
    //INCISO 1
    echo "EJECUTANDO INCISO 1...\n";
    $cliente1 = new Cliente("Jose", "Perez", "DNI", 23568419, true);
    $cliente2 = new Cliente("Juan", "Hernandez", "DNI", 21586720, false);
    $colCliente = [$cliente1, $cliente2];

    //INCISO 2
    echo "EJECUTANDO INCISO 2...\n";
    $producto1 = new Producto(11, 50000, 2018, "Cemento loma Negra", 70, true);
    $producto2 = new Producto(12, 10000, 2019, "Hierro del 12", 60, true);
    $producto3 = new Producto(13, 10000, 2020, "Cal Santa Clara", 50, false);
    $colProducto = [$producto1, $producto2, $producto3];

    $colVenta = [];

    //INCISO 3
    echo "EJECUTANDO INCISO 3...\n";
    $empresa = new Empresa("Cosmos", "Av Argentina 123", $colCliente, $colProducto, $colVenta);

    //INCISO 4
    echo "EJECUTANDO INCISO 4...\n";
    $colCodigosProductos = [11, 12, 13];
    $empresa->registrarVenta($colCodigosProductos, $cliente2);
    echo $empresa->mostrarVentas();

    //INCISO 5
    echo "EJECUTANDO INCISO 5...\n";
    $colCodigosProductos = [11];
    $empresa->registrarVenta($colCodigosProductos, $cliente2);
    echo $empresa->mostrarVentas();

    //INCISO 6
    echo "EJECUTANDO INCISO 6...\n";
    $colCodigosProductos = [2];
    $empresa->registrarVenta($colCodigosProductos, $cliente2);
    echo $empresa->mostrarVentas();

    //INCISO 7
    echo "EJECUTANDO INCISO 7...\n";
    $ventas = $empresa->retornarVentasPorCliente("DNI", 23568419);
    imprimirArreglo($ventas);

    //INCISO 8
    echo "EJECUTANDO INCISO 8...\n";
    $ventas = $empresa->retornarVentasPorCliente("DNI", 21586720);
    imprimirArreglo($ventas);

    //INCISO 9
    echo "EJECUTANDO INCISO 9...\n";
    echo $empresa;
}

function imprimirArreglo($ventas) {
    for ($i=0; $i < count($ventas); $i++) { 
        echo $ventas[$i] . "\n";
    }
}