<?php
class Cuota {
    //Atributos
    private $numero;
    private $montoCuota;
    private $montoInteres;
    private $cancelada;  //atributo que va a contener un valor true, si la cuota esta paga y false en caso contrario

    //Constructor
    public function __construct($num, $cuota, $interes) {
        $this->numero = $num;
        $this->montoCuota = $cuota;
        $this->montoInteres = $interes;
        $this->cancelada = false;  //Por defecto todas las cuotas deben ser generadas como false.
    }

    //Metodos Observadoras
    public function getNumeroCuota() {
        return $this->numero;
    }

    public function getMontoCuota() {
        return $this->montoCuota;
    }

    public function getMontoInteres() {
        return $this->montoInteres;
    }

    public function getCancelada() {
        return $this->cancelada;
    }

    //Metodos Modificadoras
    public function setNumeroCuota($num) {
        $this->numero = $num;
    }

    public function setMontoCuota($cuota) {
        $this->montoCuota = $cuota;
    }

    public function setMontoInteres($interes) {
        $this->montoInteres = $interes;
    }

    public function setCancelada($seCancela) {
        $this->cancelada = $seCancela;
    }

    //Metodos
    /**
     * Metodo __toString() para mostrar todos los datos de la Cuota
     */
    public function __toString() {
        //String $si, $no
        $si = "Si";
        $no = "No";
        return "\nNumero de cuota: ".$this->getNumeroCuota()."\n".
        "Monto de la cuota: ".$this->getMontoCuota()."\n".
        "Monto interes de la cuota: ".$this->getMontoInteres()."\n".
        "Esta cancelada: ".(($this->getCancelada()) ? $si : $no);
    }
    
    /**
     * Metodo darMontoFinalCuota() que retorna el importe total de la cuota mas los intereses que deben ser aplicados.
     */
    public function darMontoFinalCuota() {
        $montoCuota = $this->getMontoCuota();
        $intereses = $this->getMontoInteres();

        $importeTotal = $montoCuota + $intereses;

        return $importeTotal;
    }
}