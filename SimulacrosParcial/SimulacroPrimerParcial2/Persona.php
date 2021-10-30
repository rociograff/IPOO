<?php
class Persona {
    //Atributos
    private $tipoDocumento;
    private $numeroDocumento;
    private $nombre;
    private $apellido;
    private $telefono;

    //Constructor
    public function __construct($tipoDoc, $numDoc, $nom, $ape, $tel) {
        $this->tipoDocumento = $tipoDoc;
        $this->numeroDocumento = $numDoc;
        $this->nombre = $nom;
        $this->apellido = $ape;
        $this->telefono = $tel;
    }

    //Observadoras
    public function getTipoDocumento() {
        return $this->tipoDocumento;
    }

    public function getNumeroDocumento() {
        return $this->numeroDocumento;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    //Modificadoras
    public function setTipoDocumento($tipoDoc) {
        $this->tipoDocumento = $tipoDoc;
    }

    public function setNumeroDocumento($numDoc) {
        $this->numeroDocumento = $numDoc;
    }

    public function setNombre($nom) {
        $this->nombre = $nom;
    }

    public function setApellido($ape) {
        $this->apellido = $ape;
    }

    public function setTelefono($tel) {
        $this->telefono = $tel;
    }

    /**
     * Metodo __toString() para mostrar los datos de la Persona
     */
    public function __toString() {
        return "Tipo Documento: ".$this->getTipoDocumento()."\n".
        "Numero Documento: ".$this->getNumeroDocumento()."\n".
        "Nombre: ".$this->getNombre()."\n".
        "Apellido: ".$this->getApellido()."\n".
        "Telefono: ".$this->getTelefono();
    }
}
