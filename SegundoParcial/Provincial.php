<?php
class Provincial extends Torneo {
    //Atributos
    private $nombreProvincia;

    //Constructor
    public function __construct($idTorneo, $colPartidos, $montoPremio, $nombreLocalidad, $nombreProvincia) {
        //Invoco el constructor de la clase Torneo
        parent::__construct($idTorneo, $colPartidos, $montoPremio, $nombreLocalidad);
        $this->nombreProvincia = $nombreProvincia;
    }

    //Observador
    public function getNombreProvincia() {
        return $this->nombreProvincia;
    }

    //Modificador
    public function setNombreProvincia($nombreProvincia) {
        $this->nombreProvincia = $nombreProvincia;
    }

    //Metodos
    /*Metodo __toString() para mostrar los datos del Torneo Provincial */
    public function __toString() {
        return parent::__toString()."\n".
        "Nombre Provincia donde se juega: ".$this->getNombreProvincia()."\n";
    }
}