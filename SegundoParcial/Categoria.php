<?php
class Categoria {
    //Atributos
    private $idCategoria;
    private $descripcion;

    //Constructor
    public function __construct($idCategoria, $descripcion) {
        $this->idCategoria = $idCategoria;
        $this->descripcion = $descripcion;
    }

    //Observadores
    public function getIdCategoria() {
        return $this->idCategoria;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    //Modificadores
    public function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }
   
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    //Metodos
    /*Metodo __toString() para mostrar los datos de la Categoria */
    public function __toString() {
        return 'Numero de Categoria: ' . $this->getIdCategoria() . "\n" .
        'Descripcion: ' . $this->getDescripcion() . "\n";
    }
}
