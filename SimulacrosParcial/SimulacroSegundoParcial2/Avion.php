<?php
class Avion {
    //Atributos
    private $numeroAvion;
    private $cantPlazasEjecutivas; 
    private $cantPlazasEconomicas;

    //Constructor
    public function __construct($numeroAvion, $cantPlazasEjecutivas, $cantPlazasEconomicas) {
        $this->numeroAvion = $numeroAvion;
        $this->cantPlazasEjecutivas = $cantPlazasEjecutivas;
        $this->cantPlazasEconomicas = $cantPlazasEconomicas;
    }

    //Obsrvadoras
    public function getNumeroAvion() {
        return $this->numeroAvion;
    }

    public function getCantPlazasEjecutivas() {
        return $this->cantPlazasEjecutivas;
    }

    public function getcantPlazasEconomicas() {
        return $this->cantPlazasEconomicas;
    }

    //Modificadores
    public function setNumeroAvion($numeroAvion) {
        $this->numeroAvion = $numeroAvion;
    }
    
    public function setCantPlazasEjecutivas($cantPlazasEjecutivas) {
        $this->cantPlazasEjecutivas = $cantPlazasEjecutivas;
    }

    public function setcantPlazasEconomicas($cantPlazasEconomicas) {
        $this->cantPlazasEconomicas = $cantPlazasEconomicas;
    }

    //Metodos 
    /*Metodo __toString() para mostrar los datos del Avion */
    public function __toString() {
        return "Numero de Avion: ".$this->getNumeroAvion()."\n".
        "Cantidad de plaza Ejecutiva: ".$this->getCantPlazasEjecutivas()."\n".
        "Cantidad de plaza Economica: ".$this->getcantPlazasEconomicas()."\n";
    }
}