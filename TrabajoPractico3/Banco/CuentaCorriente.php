<?php 

class CuentaCorriente extends Cuenta  {
    //Atributo 
    private $montoMaximo;

    public function __construct($num, $cash, $duenio, $monto){
        //Invoco el constructor de Cuenta
        parent::__construct($num, $cash, $duenio);
        $this->montoMaximo = $monto;
    }

    //Metodo Observador
    public function getMontoMaximo() {
        return $this->montoMaximo;
    }

    //Metodo Modificador
    public function setMontoMaximo($montoMaximo) {
        $this->montoMaximo = $montoMaximo;
    }

    //Metodos
    public function __toString() {
        $cadena=parent::__toString();
        return $cadena . "\nMonto maximo para girar en descubierto: ".$this->getMontoMaximo()."\n";
    }

    //Metodo realizarRetiro() que devuelve true si puede realizar el retiro y false en caso contrario
    public function realizarRetiro($monto) {
        $saldoCuenta = $this->getSaldo();
        $montoMax = $this->getMontoMaximo();
        $operacion = parent::realizarRetiro($monto);

        if($operacion == false) {
            $importe = $saldoCuenta + $montoMax;
            if($importe >= $monto) {
                $retiro = $importe - $monto;
                $this->setSaldo($retiro);
            }
        }

        return $operacion;
    }
}