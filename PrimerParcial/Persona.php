<?php
class Persona {
    //Atributos
    private $nombre;
    private $apellido;
    private $dni;
    private $direccion;
    private $mail;
    private $telefono;
    private $neto;

    //Constructor
    public function __construct($nom, $ape, $doc, $dire, $correo, $tel, $neto) {
        $this->nombre = $nom;
        $this->apellido = $ape;
        $this->dni = $doc;
        $this->direccion = $dire;
        $this->mail = $correo;
        $this->telefono = $tel;
        $this->neto = $neto;
    }

    //Metodos Observadoras
    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getNeto() {
        return $this->neto;
    }

    //Metodos Modificadoras
    public function setNombre($nom) {
        $this->nombre = $nom;
    }

    public function setApellido($ape) {
        $this->apellido = $ape;
    }

    public function setDni($doc) {
        $this->dni = $doc;
    }

    public function setDireccion($dire) {
        $this->direccion = $dire;
    }

    public function setMail ($correo) {
        $this->mail = $correo;
    }

    public function setTelefono($tel) {
        $this->telefono = $tel;
    }

    public function setNeto($neto) {
        $this->neto = $neto;
    }

    //Metodos
    /**
     * Metodo __toString() para mostrar los datos de la Persona
     */
    public function __toString() {
        return "\nNombre: ".$this->getNombre()."\n".
        "Apellido: ".$this->getApellido()."\n".
        "Dni: ".$this->getDni()."\n".
        "Direccion: ".$this->getDireccion()."\n".
        "Mail: ".$this->getMail()."\n".
        "Telefono: ".$this->getTelefono()."\n".
        "Neto: ".$this->getNeto();
    }
}