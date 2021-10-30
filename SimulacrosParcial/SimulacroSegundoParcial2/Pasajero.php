<?php
class Pasajero {
    //Atributos
    private $numeroPasaporte;
    private $numeroDocumento;
    private $nacionalidad;
    private $nombrePasajero;
    private $apellidoPasajero;

    //Constructor
    public function __construct($numeroPasaporte, $numeroDocumento, $nacionalidad, $nombrePasajero, $apellidoPasajero) {
        $this->numeroPasaporte = $numeroPasaporte;
        $this->numeroDocumento = $numeroDocumento;
        $this->nacionalidad = $nacionalidad;
        $this->nombrePasajero = $nombrePasajero;
        $this->apellidoPasajero = $apellidoPasajero;
    }

    //Observadores
    public function getNumeroPasaporte() {
        return $this->numeroPasaporte;
    }

    public function getNumeroDocumento() {
        return $this->numeroDocumento;
    }

    public function getNacionalidad() {
        return $this->nacionalidad;
    }

    public function getNombrePasajero() {
        return $this->nombrePasajero;
    }

    public function getApellidoPasajero() {
        return $this->apellidoPasajero;
    }

    //Modificadores
    public function setNumeroPasaporte($numeroPasaporte) {
        $this->numeroPasaporte = $numeroPasaporte;
    }

    public function setNumeroDocumento($numeroDocumento) {
        $this->numeroDocumento = $numeroDocumento;
    }

    public function setNacionalidad($nacionalidad) {
        $this->nacionalidad = $nacionalidad;
    }

    public function setNombrePasajero($nombrePasajero) {
        $this->nombrePasajero = $nombrePasajero;
    }

    public function setApellidoPasajero($apellidoPasajero) {
        $this->apellidoPasajero = $apellidoPasajero;
    }

    //Metodos 
    /*Metodo __toString() para mostrar los datos del Pasajero */
    public function __toString() {
        return "Numero pasaporte: ".$this->getNumeroPasaporte()."\n".
        "Numero Documero: ".$this->getNumeroDocumento()."\n".
        "Nacionalidad: ".$this->getNacionalidad()."\n".
        "Nombre del Pasajero: ".$this->getNombrePasajero()."\n".
        "Apellido del Pasajero: ".$this->getApellidoPasajero()."\n";
    }
}