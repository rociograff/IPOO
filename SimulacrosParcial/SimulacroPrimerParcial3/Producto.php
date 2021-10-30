<?php
class Producto {
    //Se registra la siguiente información: código barra, nombre, marca, color, talle, descripción y cantidad en stock.
    // Atributos 
    private $codigoBarra;
    private $nombreProducto;
    private $marca;
    private $color;
    private $talle;
    private $descripcion;
    private $cantidadStock;

    // Constructor
    public function __construct($codigo, $nombre, $marca, $color, $talle, $desc, $cantStock) {
        $this->codigoBarra = $codigo;
        $this->nombreProducto = $nombre;
        $this->marca = $marca;
        $this->color = $color;
        $this->talle = $talle;
        $this->descripcion = $desc;
        $this->cantidadStock = $cantStock;
    }

    // Observadoras
    public function getCodigoBarraProducto() {
        return $this->codigoBarra;
    }

    public function getNombreProducto() {
        return $this->nombreProducto;
    }

    public function getMarcaProducto() {
        return $this->marca;
    }

    public function getColorProducto() {
        return $this->color;
    }

    public function getTalleProducto() {
        return $this->talle;
    }

    public function getDescripcionProducto() {
        return $this->descripcion;
    }

    public function getCantStockProducto() {
        return $this->cantidadStock;
    }

    // Modificadoras
    public function setCodigoBarraProducto($codigo) {
        $this->codigoBarra = $codigo;
    }

    public function setNombreProducto($nombre) {
        $this->nombreProducto = $nombre;
    }

    public function setMarcaProducto($marca) {
        $this->marca = $marca;
    }

    public function setColorProducto($color) {
        $this->color = $color;
    }

    public function setTalleProducto($talle) {
        $this->talle = $talle;
    }

    public function setDescripcionProducto($desc) {
        $this->decripcion = $desc;
    }

    public function setCantStockProducto($cantStock) {
        $this->cantidadStock = $cantStock;
    }

    // Metodos
    public function __toString() {
        return "\tCodigo barra: " . $this->getCodigoBarraProducto() . "\n" .
        "\t\tNombre: " . $this->getNombreProducto() . "\n" .
        "\t\tMarca: " . $this->getMarcaProducto() . "\n" .
        "\t\tColor: " . $this->getColorProducto() . "\n" .
        "\t\tTalle: " . $this->getTalleProducto() . "\n" .
        "\t\tDescripcion: " . $this->getDescripcionProducto() . "\n" .
        "\t\tCantidad en stock: " . $this->getCantStockProducto() . "\n";
    }
/*
Implementar el método actualizarStock que recibe por parámetro una cantidad y actualiza el valor del
stock del producto según corresponda. Si el valor recibido por parámetro es >0, entonces se incrementa el
stock y si el valor es <0 se decrementa el stock del producto.
*/
    public function actualizarStock($cantidadProductos) {
        if ($cantidadProductos > 0) {
            $total = $this->getCantStockProducto() + $cantidadProductos;
            $this->setCantStockProducto($total);
        } else {
            $total = $this->getCantStockProducto() - $cantidadProductos;
            $this->setCantStockProducto($total);
        }
    }
}