<?php
include 'Producto.php';
include 'Item.php';
include 'Venta.php';
include 'Tienda.php';

$producto1 = new Producto("0001", "Camiseta", "Nike", "Azul y amarilla", "M", "Camiseta futbol Club Atletico Boca Juniors", 3);
$producto2 = new Producto("0002", "Botines", "Nike", "Negro", "40", "Botines rugby tapones acero", 5);
$producto3 = new Producto("0003", "Protector Bucal", "Everlast", "Blanco", "Termomoldeable", "Protector bucal termomoldeable", 4);
$producto4 = new Producto("0004", "Pelota", "Nike", "Blanca", "19", "Pelota futbol seleccion Argentina", 7);

$coleccionProductos = [$producto1, $producto2, $producto3, $producto4];
$coleciconVentasRealizadas = [];

$tienda = new Tienda("Nombre copado", "Calle Falsa 1234", 123456789, $coleccionProductos, $coleciconVentasRealizadas);

$arregloVentas = [
    ["codigoBarra" => "0001", "cantidad" => 2],
    ["codigoBarra" => "0002", "cantidad" => 2],
    ["codigoBarra" => "0003", "cantidad" => 2],
];

// Inciso 4
echo "Inciso 4: \n";
$ventas = $tienda->realizarVenta($arregloVentas);
echo $ventas;

// Inciso 5
echo "Inciso 5: \n";
echo $tienda . "\n";