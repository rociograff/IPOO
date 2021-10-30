<?php
//PROGRAMA PRINCIPAL
//array $arregloVinos
//array $datosVinos

$arregloVinos = [
    "Malbec" => [
        0 => ["cantidadBotellas" => 12, "anioProduccion" => 1996, "precioUnidad" => 369],
        1 => ["cantidadBotellas" => 30, "anioProduccion" => 1914, "precioUnidad" => 899],
        2 => ["cantidadBotellas" => 5, "anioProduccion" => 2018, "precioUnidad" => 198],
    ],
    "Merlot" => [
        0 => ["cantidadBotellas" => 20, "anioProduccion" => 2005, "precioUnidad" => 333],
        1 => ["cantidadBotellas" => 15, "anioProduccion" => 2015, "precioUnidad" => 320],
        2 => ["cantidadBotellas" => 10, "anioProduccion" => 2010, "precioUnidad" => 315],
    ],
    "Cabernet Sauvignon" => [
        0 => ["cantidadBotellas" => 40, "anioProduccion" => 2008, "precioUnidad" => 455],
        1 => ["cantidadBotellas" => 26, "anioProduccion" => 2019, "precioUnidad" => 243],
        2 => ["cantidadBotellas" => 15, "anioProduccion" => 2012, "precioUnidad" => 315],
    ],
];

print_r($arregloVinos);
$datosVinos = cantidadYPromedio($arregloVinos);

print_r($datosVinos);

/**
 * MODULO cantidadYPromedio
 * @param array $vinoteca
 * @return array $datos
 */
function cantidadYPromedio($vinoteca) {
    //String $variedad
    //int $i, $j, $sumaBotellas, $contador
    //float $precioTotal, $precioPromedio

    $datos = [];
    $i = 0;
    while ($i < count($vinoteca)) {
        switch ($i) {
            case 0:
                $variedad = "Malbec";
                break;
            case 1:
                $variedad = "Merlot";
                break;
            case 2:
                $variedad = "Cabernet Sauvignon";
                break;
        }

        $sumaBotellas = 0;
        $precioTotal = 0;
        for ($j = 0; $j < count($vinoteca[$variedad]); $j++) {
            $sumaBotellas += $vinoteca[$variedad][$j]["cantidadBotellas"];
            $precioTotal += $vinoteca[$variedad][$j]["precioUnidad"];
        }

        $precioPromedio = $precioTotal / $sumaBotellas;

        $botellasYPrecio = [
            "totalBotellas" => $sumaBotellas,
            "precioPromedio" => $precioPromedio,
        ];

        $datos[count($datos)] = $botellasYPrecio;
        $i++;
    }
    return $datos;
}