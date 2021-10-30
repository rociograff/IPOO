<?php

class Cuenta {
    //Atributos
    private $numeroCuenta;
    private $saldo;
    private $referenciaDuenio;

    //Constructor
    public function __construct($num, $cash, $duenio) {
        $this->numeroCuenta = $num;
        $this->saldo = $cash;
        $this->referenciaDuenio = $duenio;
    }

    //Metodos Observadores
    public function getNumeroCuenta() {
        return $this->numeroCuenta;
    }

    public function getSaldo() {
        return $this->saldo;
    }

    public function getReferenciaDuenio() {
        return $this->referenciaDuenio;
    }

    //Metodos Modificadores
    public function setNumeroCuenta($numeroCuenta) {
        $this->numeroCuenta = $numeroCuenta;
    }

    public function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

    public function setReferenciaDuenio($referenciaDuenio) {
        $this->referenciaDuenio = $referenciaDuenio;
    }

    //Metodos
    public function __toString() {
        return "Numero Cuenta: ".$this->getNumeroCuenta()."\n".
        "Saldo de la cuenta: ".$this->getSaldo()."\n".
        "Dueño: ".$this->getReferenciaDuenio()."\n";
    }

    //Metodo saldoCuenta() que retorna el saldo de la cuenta
    public function saldoCuenta() {
        return $this->getSaldo();
    }

    //Metodo realizarDeposito() que permite realizar un deposito a la cuenta una cantidad "monto" de dinero
    public function realizarDeposito($monto) {
        $importe = $this->getSaldo();
        $deposito = $importe + $monto;
        $this->setSaldo($deposito);
    }

    //Metodo realizarRetiro() que permite realizar un retiro de la cuenta por una cantidad "monto" de dinero
    public function realizarRetiro($monto) {
        $exito = false;
        $importe = $this->getSaldo();
        if($importe >= $monto) {
            $retiro = $importe - $monto;
            $this->setSaldo($retiro);
            $exito = true;
        }

        return $exito;
    }
}