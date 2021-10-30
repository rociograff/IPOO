<?php
class Cliente {
    //Atributos
    private $nombre;
    private $apellido;
    private $documento;

    //Constructor
    public function __construct($nombre, $apellido, $documento) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->documento = $documento;
    }

    //Observadores
    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getDocumento() {
        return $this->documento;
    }

    //Modificadores
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function setDocumento($documento) {
        $this->documento = $documento;
    }

    //Metodos
    /*Metodo __toString() para mostrar los datos del Cliente */
    public function __toString() {
        return "Nombre: ".$this->getNombre()."\n".
        "Apellido: ".$this->getApeliido()."\n".
        "Documento: ".$this->getDocumento()."\n";
    }
}