<?php
class Equipo {
    //Atributos
    private $nombreEquipo;
    private $nombreCapitan;
    private $cantJugadores;
    private $objCategoria;

    //Constructor
    public function __construct($nombreEquipo, $nombreCapitan, $cantJugadores, $objCateoria) {
        $this->nombreEquipo = $nombreEquipo;
        $this->nombreCapitan = $nombreCapitan;
        $this->cantJugadores = $cantJugadores;
        $this->objCategoria = $objCateoria;
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

    public function getObjCategoria() {
        return $this->objCategoria;
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
    
    public function setObjCategoria($objCategoria) {
        $this->objCategoria = $objCategoria;
    }

    //Metodos
    /*Metodo __toString() para mostrar los datos del Equipo */
    public function __toString() {
        return "Nombre del Equipo: ".$this->getNombreEquipo()."\n".
        "Nombre del Capitan: ".$this->getNombreCapitan()."\n".
        "Cantidad de jugadores: ".$this->getCantJugadores()."\n".
        "Categoria: ".$this->getCategoriaEquipo()."\n";
    }
}