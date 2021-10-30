<?php
class Cliente {
    //Atributos
    private $nombre;
    private $apellido;
    private $tipoDocumento;
    private $numeroDocumento;
    private $dadoDeBaja;

    //Constructor
    public function __construct($nom, $ape, $tipo, $num, $deBaja) {
        $this->nombre = $nom;
        $this->apellido = $ape;
        $this->tipoDocumento = $tipo;
        $this->numeroDocumento = $num;
        $this->dadoDeBaja = $deBaja;
    }

    //Observadores
    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getTipoDocumento() {
        return $this->tipoDocumento;
    }

    public function getNumeroDocumento() {
        return $this->numeroDocumento;
    }

    public function getDadoDeBaja() {
        return $this->dadoDeBaja;
    }

    //Modificadores
    public function setNombre($nom) {
        $this->nombre = $nom;
    }

    public function setApellido($ape) {
        $this->apellido = $ape;
    }

    public function setTipoDocumento($tipo) {
        $this->tipoDocumento = $tipo;
    }

    public function setNumeroDocumento($num) {
        $this->numeroDocumento = $num;
    }

    public function setDadoDeBaja($deBaja) {
        $this->dadoDeBaja = $deBaja;
    }

    /**
     * Metodo toString() para devolver todos los datos del cliente
     */
    public function __toString() {
        $si = "Si";
        $no = "No";
        return "\nNombre: " . $this->getNombre() . "\n" .
        "Apellido: " . $this->getApellido() . "\n" .
        $this->getTipoDocumento() . " " . $this->getNumeroDocumento() . "\n" .
        "Dado de baja: " . (($this->getDadoDeBaja()) ? $si : $no) . "\n";
    }
}