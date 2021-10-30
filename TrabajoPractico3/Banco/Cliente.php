<?php

class Cliente extends Persona {
    //Atributos
    private $numeroCliente;

    //Constructor
    public function __construct($doc, $nom, $ape, $numCliente) {
        //Invoco al constructor de Persona
        parent::__construct($doc, $nom, $ape);
        $this->numeroCliente = $numCliente;
    }

    //Metodos Observadores
    public function getNumeroCliente() {
        return $this->numeroCliente;
    }

    //Metodos Modificadores
    public function setNumeroCliente($numeroCliente) {
        $this->numeroCliente = $numeroCliente;
    }

    public function __toString() {
        $cadena = parent::__toString();
        return $cadena . "\nNumero Cliente: ".$this->getNumeroCliente()."\n";
    }
}