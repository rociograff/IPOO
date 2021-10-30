<?php
class Venta {
    //Atributos
    private $numero;
    private $fecha;
    private $objCliente;
    private $colProductos;
    private $precioFinal;

    //Constructor
    public function __construct($num, $fecha, $cliente) {
        $this->numero = $num;
        $this->fecha = $fecha;
        $this->objCliente = $cliente;
        $this->colProductos = [];
        $this->precioFinal = 0;
    }

    //Observadores
    public function getNumero() {
        return $this->numero;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getCliente() {
        return $this->objCliente;
    }

    public function getColProductos() {
        return $this->colProductos;
    }

    public function getPrecioFinal() {
        return $this->precioFinal;
    }

    //Modificadores
    public function setNumero($num) {
        $this->numero = $num;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setCliente($cliente) {
        $this->objCliente = $cliente;
    }

    public function setColProductos($arreglo) {
        $this->colProductos = $arreglo;
    }

    public function setPrecioFinal($precio) {
        $this->precioFinal = $precio;
    }

    /**
    * Metodo toString() para mostrar los datos de la venta
    */
    public function __toString() {
        return "Venta numero: " . $this->getNumero() . "\n" .
        "Fecha: " . $this->getFecha() . "\n" .
        "Cliente: " . $this->getCliente() . "\n" .
        "Productos: " . $this->mostrarProductos() . "\n" .
        "Precio final: $" . $this->getPrecioFinal();
    }

    /**
    * Metodo para mostrar los datos del arreglo de Productos
    * Declaracion de variables 
    * Array Producto $arreglo
    * @return String $retorno
    */
    private function mostrarProductos() {
        $retorno = "";
        $arreglo = $this->getColProductos();
        for ($i = 0; $i < count($arreglo); $i++) {
            $retorno .= $arreglo[$i] . "\n";
            $retorno .= "-------------------------";
        }
        return $retorno;
    }

    /**
    * Metodo que recibe por parámetro un objeto producto y lo incorpora, si es posible la venta,
    * a la colección de productos de la venta. El método cada vez que incorpora
    * un producto a la venta, debe actualizar la variable instancia precio final de la venta.
    * @param $objProducto
    */
    public function incorporarProducto($objProducto) {
        //Array Producto $colProductos
        //int $precio
        $arregloProductos = $this->getColProductos();
        $precio = $this->getPrecioFinal();
        if ($objProducto->getActivo()) {
            $arregloProductos[count($arregloProductos)] = $objProducto;
            $this->setColProductos($arregloProductos);
            $precio += $objProducto->darPrecioVenta(); //Utilizo un metodo de la clase Producto
            $this->setPrecioFinal($precio);
        }
    }
}