<?php
class Destino {
    //Atributos
    private $nombreDestino;
    private $descripcionDestino;

    //Constructor
    public function __construct($nombreDestino, $descripcionDestino) {
        $this->nombreDestino = $nombreDestino;
        $this->descripcionDestino = $descripcionDestino;
    }

    //Observadores
    public function getNombreDestino() {
        return $this->nombreDestino;
    }

    public function getDescripcionDestino() {
        return $this->descripcionDestino;
    }

    //Modificadores
    public function setNombreDestino($nombreDestino) {
        $this->nombreDestino = $nombreDestino;
    }

    public function setDescripcionDestino($descripcionDestino) {
        $this->descripcionDestino = $descripcionDestino;
    }

    //Metodos
    /*Metodo __toString() para mostrar la informacion del Destino */
    public function __toString() {
        return "Nombre del Destino: ".$this->getNombreDestino()."\n".
        "Descripcion: ".$this->getDescripcionDestino()."\n";
    }
}