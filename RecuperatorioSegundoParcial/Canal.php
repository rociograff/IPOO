<?php
class Canal {
    //Atributos
    private $tipoCanal;
    private $importeCanal;
    private $esHD;

    //Constructor
    public function __construct($tipoCanal, $importeCanal, $esHD) {
        $this->tipoCanal = $tipoCanal;
        $this->importeCanal = $importeCanal;
        $this->esHD = $esHD;
    }

    //Observadores
    public function getTipoCanal() {
        return $this->tipoCanal;
    }

    public function getImporteCanal() {
        return $this->importeCanal;
    }

    public function getEsHD() {
        return $this->esHD;
    }

    //Modificadores
    public function setTipoCanal($tipoCanal) {
        $this->tipoCanal = $tipoCanal;
    }

    public function setImporteCanal($importeCanal) {
        $this->importeCanal = $importeCanal;
    }

    public function setEsHD($esHD) {
        $this->esHD = $esHD;
    }

    //Metodos
    /*Metodo __toString() para mostrar los datos del Canal */
    public function __toString() {
        return "Tipo de Canal: ".$this->getTipoCanal()."\n".
        "Importe: ".$this->getImporteCanal()."\n".
        "Es HD: ".($this->getEsHD()) ? "Si" : "No"."\n";
    }
}