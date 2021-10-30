<?php
class Item {
    //Se registra la siguiente información: cantidad vendida y la referencia al producto.
    // Atributos
    private $cantidadVendida;
    private $objProducto;

    // Constructor
    public function __construct($cantVendida, $producto) {
        $this->cantidadVendida = $cantVendida;
        $this->objProducto = $producto;
    }

    // Observadoras
    public function getCantVendidaItem() {
        return $this->cantidadVendida;
    }

    public function getObjProducto() {
        return $this->objProducto;
    }

    // Modificadoras
    public function setCantVendida($cantVendida) {
        $this->cantidadVendida = $cantVendida;
    }

    public function setObjProducto($producto) {
        $this->objProducto = $producto;
    }

    // Metodos
    public function __toString() {
        return "\tProducto: " . $this->getObjProducto() . "\n" .
        "\tCantidad vendida: " . $this->getCantVendidaItem() . "\n";
    }
}