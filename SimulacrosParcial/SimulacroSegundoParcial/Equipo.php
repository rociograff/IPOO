<?php
class Equipo {
    //Atributos
    private $nombreEquipo;
    private $nombreCapitan;
    private $cantJugadores;
    private $categoriaEquipo;  //Referencia de su categoria

    //Constructor
    public function __construct($nombreEquipo, $nombreCapitan, $cantJugadores, $categoriaEquipo) {
        $this->nombreEquipo = $nombreEquipo;
        $this->nombreCapitan = $nombreCapitan;
        $this->cantJugadores = $cantJugadores;
        $this->categoriaEquipo = $categoriaEquipo;
    }

    //Observadores
    public function getNombreEquipo() {
        return $this->nombreEquipo;
    }

    public function getNombreCapitan() {
        return $this->nombreCapitan;
    }

    public function getCantJugadores() {
        return $this->cantJugadores;
    }

    public function getCategoriaEquipo() {
        return $this->categoriaEquipo;
    }

    //Modificadores
    public function setNombreEquipo($nombreEquipo) {
        $this->nombreEquipo = $nombreEquipo;
    }

    public function setNombreCapitan($nombreCapitan) {
        $this->nombreCapitan = $nombreCapitan;
    }

    public function setCantJugadores($cantJugadores) {
        $this->cantJugadores = $cantJugadores;
    }

    public function setCategoriaEquipo($categoriaEquipo) {
        $this->categoriaEquipo = $categoriaEquipo;
    }

    //Metodos
    /*Metodo __toString() para mostrar los datos del Equipo*/
    public function __toString() {
        return "\nNombre del Equipo: ".$this->getNombreEquipo()."\n".
        "Nombre del Capitan: ".$this->getNombreCapitan()."\n".
        "Cantidad de jugadores del Equipo: ".$this->getCantJugadores()."\n".
        "Categoria del Equipo: ".$this->getCategoriaEquipo()."\n";
    }
}