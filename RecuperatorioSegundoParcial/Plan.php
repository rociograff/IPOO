<?php
class Plan {
    //Atributos
    private $codigoPlan;
    private $colCanales;
    private $importePlan;
    private $incluyeMG;

    //Constructor
    public function __construct($codigoPlan, $colCanales, $importePlan, $incluyeMG) {
        $this->codigoPlan = $codigoPlan;
        $this->colCanales = $colCanales;
        $this->importePlan = $importePlan;
        $this->incluyeMG = $incluyeMG;  //Por defecto incluye 50MG
    }

    //Observadores
    public function getCodigoPlan() {
        return $this->codigoPlan;
    }

    public function getColCanales() {
        return $this->colCanales;
    }

    public function getImportePlan() {
        return $this->importePlan;
    }

    public function getIncluyeMG() {
        return $this->incluyeMG;
    }

    //Modificadores
    public function setCodigoPlan($codigoPlan) {
        $this->codigoPlan = $codigoPlan;
    }

    public function setColCanales($colCanales) {
        $this->colCanales = $colCanales;
    }

    public function setImportePlan($importePlan) {
        $this->importePlan = $importePlan;
    }

    public function setIncluyeMG($incluyeMG) {
        $this->incluyeMG = $incluyeMG;
    }

    //Metodos
    /*Metodo __toString() para mostrar los datos del Plan */
    public function __toString() {
        return "Codigo: ".$this->getCodigoPlan()."\n".
        "----CANALES----\n".$this->mostrarColeccion($this->getColCanales())."\n".
        "Importe: ".$this->getImportePlan()."\n".
        "Incluye MG: ".($this->getIncluyeMG()) ? "Si" : "No"."\n";
    }

    /* Metodo para mostrar colecciones */
    private function mostrarColeccion($coleccion) {
        $arreglo = "";
        foreach ($coleccion as $obj) {
            $arreglo .= $obj . "\n";
            $arreglo .= "--------------------------\n";
        }
        return $arreglo;
    }
}