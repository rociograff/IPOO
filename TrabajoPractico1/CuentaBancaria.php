<?php
class CuentaBancaria {
    //Atributos
	private $numeroDeCuenta;
	private $dni;
	private $saldoActual;
	private $interesAnual;

    //Constructor
	public function __construct($cuenta, $documento, $saldo, $interes) {
		$this -> numeroDeCuenta = $cuenta;
		$this -> dni = $documento;
		$this -> saldoActual = $saldo;
		$this -> interesAnual = $interes;
	}

    //Observadoras
	public function getNumeroCuenta() {
		return $this -> numeroDeCuenta;
	}

	public function getDni() {
		return $this -> dni;
	}

	public function getSaldoActual() {
		return $this -> saldoActual;
	}

	public function getInteresAnual() {
		return $this -> interesAnual;
	}
	
	//Modificadoras
	public function setNumeroCuenta($cuenta) {
		$this -> numeroDeCuenta = $cuenta;
	}

	public function setDni($documento) {
		$this -> dni = $documento;
	}

	public function setSaldoActual($saldo) {
		$this -> saldoActual = $saldo;
	}

	public function setInteresAnual($interes) {
		$this -> interesAnual = $interes;
	}

	//Metodos
	public function actualizarSaldo() {
		$this -> setSaldoActual($this -> saldoActual + ($this -> interesAnual / 365));;
	}

	public function depositar($cant) {
		$this -> setSaldoActual($this -> saldoActual + $cant);
	}

	/*
	 * esta función sirve para retirar de la cuenta bancaria $
	 * se ingresa:
	 * @param double $cant que es la cantidad a retirar
	 * y retorno:
	 * @return boolean $retorno que es si se pudo o no retirar del banco
	 * *
	 */
	public function retirar($cant) {
		$retorno = false;
		
		$saldoFinal = $this -> saldoActual - $cant;
		if ($saldoFinal > 0) {
			$this -> saldoActual = $saldoFinal;
			$retorno = true;
		}
		return $retorno;
	}

	public function __toString() {
        return "Numero de cuenta: ".$this -> getNumeroCuenta().
        "\n DNI: ".$this -> getDni().
        "\n El saldo actual es: ".$this -> getSaldoActual().
        "\n El interes es: ".$this -> getInteresAnual();
	}
}