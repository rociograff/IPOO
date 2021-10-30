<?php
class Venta {
/*Se registra la siguiente información: fechaVenta, denominación del cliente, numero de factura, tipo de comprobante
(Tipo A o B) y la colección de items vendidos.
*/
    // Atributos
    private $fechaVenta;
    private $denominacionCliente;
    private $numeroFactura;
    private $tipoComprobante;
    private $colItemsVendidos;

    // Constructor
    public function __construct($fecha, $denominacion, $num, $comprobante, $items) {
        $this->fechaVenta = $fecha;
        $this->denominacionCliente = $denominacion;
        $this->numeroFactura = $num;
        $this->tipoComprobante = $comprobante;
        $this->colItemsVendidos = $items;
    }

    // Observadoras
    public function getFechaVenta() {
        return $this->fechaVenta;
    }

    public function getDenominacionCliente() {
        return $this->denominacionCliente;
    }

    public function getNumeroFactura() {
        return $this->numeroFactura;
    }

    public function getTipoComprobante() {
        return $this->tipoComprobante;
    }

    public function getColItems() {
        return $this->colItemsVendidos;
    }

    // Modificadoras
    public function setFecha($fecha) {
        $this->fechaVenta = $fecha;
    }

    public function setDenominacion($denominacion) {
        $this->denominacionCliente = $denominacion;
    }

    public function setNumFactura($num) {
        $this->numeroFactura = $num;
    }

    public function setTipoComp($comprobante) {
        $this->tipoComprobante = $comprobante;
    }

    public function setColItems($items) {
        $this->colItemsVendidos = $items;
    }

    // Metodos
    public function __toString() {
        return "Fecha de venta: " . $this->getFechaVenta() . "\n" .
        "Denominacion del cliente: " . $this->getDenominacionCliente() . "\n" .
        "Numero de factura: " . $this->getNumeroFactura() . "\n" .
        "Tipo de comprobante: " . $this->getTipoComprobante() . "\n" .
        "Items vendidos: \n" . $this->mostrarItems() . "\n";
    }

/*
Metodo mostrarItems() para listar la coleccion de items vendidos
*/
    public function mostrarItems() {
        $retorno = "";
        $col = $this->getColItems();
        for ($i = 0; $i < count($col); $i++) {
            $retorno .= $col[$i] . "\n";
            $retorno .= "-------------------------\n";
        }
        return $retorno;
    }

/*
Implementar el método incorporarProducto que recibe por parámetro un producto y la cantidad que desea
registrarse en la venta. Si es posible realizar la venta, teniendo en cuenta la cantidad solicitada y la
cantidad en stock del producto, se crea un item y se incorpora a la colección de items de la venta. Recordar
que debe actualizarse el stock del producto si la venta se realiza con éxito. El método debe retornar verdadero
en caso para el caso que se pueda incorporar el producto para vender o falso en caso contrario.
*/
    public function incorporarProducto($objProducto, $cantidad) {
        $exito = false;
        if(($objProducto->getCantStockProducto()() - $cantidad) >= 0) {
            $coleccion = $this->getColItems();
            $objProducto->actualizarStock($cantidad);
            $nuevoItem = new Item($cantidad, $objProducto);
            array_push($coleccion, $nuevoItem);
            $this->setColItems($coleccion);
            $exito = true;
        }
        return $exito;
    }
}