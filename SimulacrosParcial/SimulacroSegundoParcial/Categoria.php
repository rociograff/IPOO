<?php 
class Categoria {
    //Atributos
    private $idCategoria;
    private $descripcionCategoria;

    //Constructor
    public function __construct($idCategoria, $descripcionCategoria) {
        $this->idCategoria = $idCategoria;
        $this->descripcionCategoria = $descripcionCategoria;
    }

    //Observadores
    public function getIdCategoria() {
        return $this->idCategoria;
    }

    public function getDescripcionCategoria() {
        return $this->descripcionCategoria;
    }

    //Modificadores
    public function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    public function setDescripcionCategoria($descripcionCategoria) {
        $this->descripcionCategoria = $descripcionCategoria;
    }

    //Metodos
    /*Metodo __toString() para mostrar los datos de la Categoria*/
    public function __toString() {
        return "\nCategoria: ".$this->getIdCategoria()."\n".
        "Descripcion: ".$this->getDescripcionCategoria()."\n";
    }
}