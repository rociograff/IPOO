<?php

class Persona {
    //Atributos
    private $DNI;
    private $nombre;
    private $apeliido;

    //Constructor
    public function __construct($doc, $nom, $ape) {
        $this->DNI = $doc;
        $this->nombre = $nom;
        $this->apeliido = $ape;
    }

    //Metodos Observadores
    public function getDNI() {
        return $this->DNI;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApeliido() {
        return $this->apeliido;
    }

    //Metodos Modificadores
    public function setDNI($DNI) {
        $this->DNI = $DNI;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApeliido($apeliido) {
        $this->apeliido = $apeliido;
    }

    public function __toString() {
        return "DNI: ".$this->getDNI()."\n".
        "Nombre: ".$this->getNombre()."\n".
        "Apellido: ".$this->getApeliido()."\n";
    }
}