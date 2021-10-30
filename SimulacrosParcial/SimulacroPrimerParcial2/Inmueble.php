<?php
class Inmueble {
    //Atributos
    private $codigoReferencia;
    private $numeroPiso;
    private $tipoInmueble;  //Local comercial o departamento
    private $costoMensual;
    private $objPersona;

    //Constructor
    public function __construct($codRef, $numPiso, $tipoIn, $costo, $inquilino) {
        $this->codigoReferencia = $codRef;
        $this->numeroPiso = $numPiso;
        $this->tipoInmueble = $tipoIn;
        $this->costoMensual = $costo;
        $this->objPersona = $inquilino;
    }

    //Observadoras
    public function getCodigoReferencia() {
        return $this->codigoReferencia;
    }

    public function getNumeroPiso() {
        return $this->numeroPiso;
    }

    public function getTipoInmueble() {
        return $this->tipoInmueble;
    }

    public function getCostoMensual() {
        return $this->costoMensual;
    }

    public function getObjPersona() {
        return $this->objPersona;
    }

    //Modificadoras
    public function setCodigoReferencia($codRef) {
        $this->codigoReferencia = $codRef;
    }

    public function setNumeroPiso($numPiso) {
        $this->numeroPiso = $numPiso;
    }

    public function setTipoInmueble($tipoIn) {
        $this->tipoInmueble = $tipoIn;
    }

    public function setCostoMensual($costo) {
        $this->costoMensual = $costo;
    }

    public function setObjPersona($inquilino) {
        $this->objPersona = $inquilino;
    }

    //Metodos
    /**
     * Metodo __toString() para mostrar todos los datos del Inmueble
     */
    public function __toString() {
        return "\nCodigo de referencia: ".$this->getCodigoReferencia()."\n".
        "Numero de piso: ".$this->getNumeroPiso()."\n".
        "Tipo Inmueble: ".$this->getTipoInmueble()."\n".
        "Costo mensual: ".$this->getCostoMensual()."\n".
        "----INQUILINO----\n".$this->getObjPersona();
    }

    /**
     * Metodo alquilarInmueble: Tener en cuenta que un inmueble solo puede ser alquilado si no se encuentra alquilado en ese momento.
     * @param Persona $objPersona referencia al nuevo inquilino del inmueble
     * @return boolean $alquilado
     */
    public function alquilarInmueble($objPersona) {
        $alquilado = false;
        if ($this->getObjPersona() == null) {
            $this->setObjPersona($objPersona);
            $alquilado = true;
        }
        return $alquilado;
    }
}