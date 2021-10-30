<?php

class Banco {
    //Atributos
    private $colCuentaCorriente; //Variable que contiene una coleccion de instancias de la clase Cuenta Corriente
    private $colCajaAhorro; //Variable que contiene una coleccion de instancias de la clase Caja de Ahorro
    private $ultimoValorCuentaAsignado; //Variable que contiene el ultimo valor asignado a una cuenta del banco (Numero de Cuenta)
    private $colCliente; //Variable que contiene una coleccion de instancias de la clase Cliente

    //Constructor
    public function __construct($cliente) {
        $this->colCuentaCorriente = array();
        $this->colCajaAhorro = array();
        $this->ultimoValorCuentaAsignado = 1;
        $this->colCliente = $cliente;
    }

    //Metodos Observadores
    public function getColCuentaCorriente() {
        return $this->colCuentaCorriente;
    }

    public function getColCajaAhorro() {
        return $this->colCajaAhorro;
    }

    public function getUltimoValorCuentaAsignado() {
        return $this->ultimoValorCuentaAsignado;
    }

    public function getColCliente() {
        return $this->colCliente;
    }

    //Metodos Modificadores
    public function setColCuentaCorriente($colCuentaCorriente) {
        $this->colCuentaCorriente = $colCuentaCorriente;
    }

    public function setColCajaAhorro($colCajaAhorro) {
        $this->colCajaAhorro = $colCajaAhorro;
    }

    public function setUltimoValorCuentaAsignado($ultimoValorCuentaAsignado) {
        $this->ultimoValorCuentaAsignado = $ultimoValorCuentaAsignado;
    }

    public function setColCliente($cliente) {
        $this->colCliente = $cliente;
    }

    //Metodos 
    public function __toString() {
        return "\nCUENTAS CORRIENTES: ".$this->mostrarColecciones($this->getColCuentaCorriente())."\n".
        "CAJAS DE AHORRO: ".$this->mostrarColecciones($this->getColCajaAhorro())."\n".
        "Ultimo valor asignado: ".$this->getUltimoValorCuentaAsignado()."\n".
        "CLIENTES: ".$this->mostrarColecciones($this->getColCliente())."\n";
    }

    //Metodo mostrarColecciones() para mostrar las colecciones de las instancias
    public function mostrarColecciones($coleccion) {
        $coleccionStr = "";
        foreach ($coleccion as $objeto) {
            $coleccionStr .= $objeto;
            $coleccionStr .= "-----------------\n";
        }
        return $coleccionStr;
    }

    //Metodo incorporarCliente() que permite agregar un nuevo cliente al Banco
    public function incorporarCliente($objCliente) {
        if(is_null($this->existeCliente($objCliente))) {
            $colClientes = $this->getColCliente();
            array_push($colClientes, $objCliente);
            $this->setColCliente($colClientes);
        }
    }

    //Metodo existeCliente() para verificar que ya hay un cliente existente en el Banco
    private function existeCliente($objClienteNuevo) {
        $dniClienteNuevo = $objClienteNuevo->getDNI(); //Utilizo el DNI de la clase Persona como un identificador para el cliente
        $encontrado = false;
        $i = 0;
        $objCliente = null;
        $colClientes = $this->getColCliente();
        while($i < count($colClientes) && !$encontrado) {
            $dni = $colClientes[$i]->getDNI();
            if($dni == $dniClienteNuevo) {
                $encontrado = true;
                $objCliente = $colClientes[$i];
            }
            $i++;
        }
        return $objCliente;
    }

    //Metodo verificarNumCliente() para verificar si existe el numero del cliente en el banco
    private function verificarNumCliente($nroCliente) {
        $encontrado = false;
        $objCliente = null;
        $i = 0;
        $colClientes = $this->getColCliente();

        while($i < count($colClientes) && !$encontrado) {
            $nroClienteExistente = $colClientes[$i]->getNumeroCliente();
            if($nroClienteExistente == $nroCliente) {
                $encontrado = true;
                $objCliente = $colClientes[$i];
            }
            $i++;
        }
        return $objCliente;
    }

    /**
     * Metodo incorporarCuentaCorriente() para agregar una nueva Cuenta a la 
     * coleccion de cuentas, verificando que el cliente dueño de la cuenta es cliente del Banco
     */
    public function incorporarCuentaCorriente($numeroCliente) {
        $objPersona = $this->verificarNumCliente($numeroCliente); //Referencia al dueño de la cuenta
        $objCuentaCorriente = null;

        if(!is_null($objPersona)) {
            $nroCuenta = $this->getUltimoValorCuentaAsignado();
            $saldo = 0;
            $monto = 0;
            $objCuentaCorriente = new CuentaCorriente($nroCuenta, $saldo, $objPersona, $monto);
            $colCuentaCorriente = $this->getColCuentaCorriente();
            array_push($colCuentaCorriente, $objCuentaCorriente);
            $this->setColCuentaCorriente($colCuentaCorriente);
            $this->setUltimoValorCuentaAsignado($nroCuenta + 1);
        }
        return $objCuentaCorriente;
    }

    /**
     * Metodo incorporarCajaAhorro() para agregar una nueva Caja de Ahorro a la coleccion
     * de cuentas, verificando que el cliente dueño de la cuenta es cliente del Banco
     */
    public function incorporarCajaAhorro($numeroCliente) {
        $objPersona = $this->verificarNumCliente($numeroCliente); //Referencia al dueño de la cuenta
        $objCajaAhorro = null;

        if(!is_null($objPersona)) {
            $nroCuenta = $this->getUltimoValorCuentaAsignado();
            $saldo = 0;
            $objCajaAhorro = new CajaAhorro($nroCuenta, $saldo, $objPersona);
            $colCajaAhorro = $this->getColCajaAhorro();
            array_push($colCajaAhorro, $objCajaAhorro);
            $this->setColCajaAhorro($colCajaAhorro);
            $this->setUltimoValorCuentaAsignado($nroCuenta + 1);
        }
        return $objCajaAhorro;
    }

    //Metodo obtenerCuenta() que retorna un objeto Cuenta
    private function obtenerCuenta($numCuenta) {
        $i = 0;
        $colCajaAhorro = $this->getColCajaAhorro();
        $colCuentaCorriente = $this->getColCuentaCorriente();
        $colCuenta = array_merge($colCajaAhorro, $colCuentaCorriente);  //Combino los dos arrays
        $encontrado = false;
        $objCuenta = null;

        while($i < count($colCuenta) && !$encontrado) {
            $numCuentaExistente = $colCuenta[$i]->getNumeroCuenta();
            if($numCuentaExistente == $numCuenta) {
                $encontrado = true;
                $objCuenta = $colCuenta[$i];
            }
            $i++;
        }
        return $objCuenta;
    }

    //Metodo realizarDeposito() que dado un numero de Cuenta y un monto, realiza el deposito
    public function realizarDeposito($numCuenta, $monto) {
        $objCuenta = $this->obtenerCuenta($numCuenta);
        if(!is_null($objCuenta)) {
            $deposito = $objCuenta->realizarDeposito($monto); 
        }
        return $deposito;
    }

    //Metodo realizarRetiro() que dado un numero de Cuenta y un monto, realiza el retirno
    public function realizarRetiro($numCuenta, $monto) {
        $objCuenta = $this->obtenerCuenta($numCuenta);
        if(!is_null($objCuenta)) {
            $retiro = $objCuenta->realizarRetiro($monto);
        }
        return $retiro;
    }
}