<?php
class Producto {
    //Atributos
    private $codigo;
    private $compra;
    private $anioFabricacion;
    private $descripcion;
    private $incrementoAnual;
    private $activo;

    //Constructor
    public function __construct($cod, $compra, $anio, $desc, $incremento, $activo) {
        $this->codigo = $cod;
        $this->compra = $compra;
        $this->anioFabricacion = $anio;
        $this->descripcion = $desc;
        $this->incrementoAnual = $incremento;
        $this->activo = $activo;
    }

    //Observadores
    public function getCodigo() {
        return $this->codigo;
    }

    public function getCosto() {
        return $this->compra;
    }

    public function getAnioFabricacion() {
        return $this->anioFabricacion;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getIncrementoAnual() {
        return $this->incrementoAnual;
    }

    public function getActivo() {
        return $this->activo;
    }

    //Modificadores
    public function setCodigo($cod) {
        $this->codigo = $cod;
    }

    public function setCosto($compra) {
        $this->compra = $compra;
    }

    public function setAnioFabricacion($anio) {
        $this->anioFabricacion = $anio;
    }

    public function setDescripcion($desc) {
        $this->descripcion = $desc;
    }

    public function setIncrementoAnual($incremento) {
        $this->incrementoAnual = $incremento;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
    }

    /**
    * Metodo toString() para mostrar los datos del producto
    */
    public function __toString() {
        //String $si, $no
        $si = "Si";
        $no = "No";
        return "\nCodigo: " . $this->getCodigo() . "\n" .
        "Costo: $" . $this->getCosto() . "\n" .
        "Anio de fabricacion: " . $this->getAnioFabricacion() . "\n" .
        "Descripcion: " . $this->getDescripcion() . "\n" .
        "Incremento anual: " . $this->getIncrementoAnual() . "%\n" . "Activo: " . (($this->getActivo()) ? $si : $no);
    }

    /**
    * Metodo el cual calcula el valor por el que puede ser vendido el producto
    * Declaracion de variables
    * float $compra: es el costo del producto.
    * int $anio: cantidad de años trascurridos desde que se fabrico el producto.
    * float $porIncAnual: porcentaje incremento anual del producto.
    * @return float $venta
    */
    public function darPrecioVenta() {
        //float $venta, $compra, $porIncAnual
        //int $anio
        if($this->getActivo()) {
            $compra = $this->getCosto();
            $anio = date('Y') - $this->getAnioFabricacion();
            $porIncAnual = $this->getIncrementoAnual();
            $venta = $compra + ($compra * $anio * ($porIncAnual / 100));
        } else {
            $venta = -1;
        }
        return $venta;
    }
}