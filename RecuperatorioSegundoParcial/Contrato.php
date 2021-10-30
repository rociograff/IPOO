<?php
class Contrato {
    //Atributos
    private $fechaInicio;
    private $fechaVencimiento;
    private $objPlan;
    private $estado;
    private $costo;
    private $seRenueva;
    private $objCliente;  //Referencia al Cliente que lo adquirio

    //Constructor
    public function __construct($fechaInicio, $fechaVencimiento, $objPlan, $estado, $costo, $seRenueva, $objCliente) {
        $this->fechaInicio = $fechaInicio;
        $this->fechaVencimiento = $fechaVencimiento;
        $this->objPlan = $objPlan;
        $this->estado = $estado;
        $this->costo = $costo;
        $this->seRenueva = $seRenueva;
        $this->objCliente = $objCliente;
    }

    //Observadores
    public function getFechaInicio() {
        return $this->fechaInicio;
    }

    public function getFechaVencimiento() {
        return $this->fechaVencimiento;
    }

    public function getObjPlan() {
        return $this->objPlan;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getCosto() {
        return $this->costo;
    }

    public function getSeRenueva() {
        return $this->seRenueva;
    }

    public function getObjCliente() {
        return $this->objCliente;
    }

    //Modificadores
    public function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    public function setFechaVencimiento($fechaVencimiento) {
        $this->fechaVencimiento = $fechaVencimiento;
    }

    public function setObjPlan($objPlan) {
        $this->objPlan = $objPlan;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setCosto($costo) {
        $this->costo = $costo;
    }

    public function setSeRenueva($seRenueva) {
        $this->seRenueva = $seRenueva;
    }

    public function setObjCliente($objCliente) {
        $this->objCliente = $objCliente;
    }

    //Metodos 
    /*Metodo __toString() para mostrar los datos del Contrato */
    public function __toString() {
        return "Fecha de inicio: ".$this->getFechaInicio()."\n".
        "Fecha de vencimiento: ".$this->getFechaVencimiento()."\n".
        "Plan: ".$this->getObjPlan()."\n".
        "Estado: ".$this->getEstado()."\n".
        "Costo: ".$this->getCosto()."\n".
        "Se renueva: ".$this->getSeRenueva()."\n".
        "Cliente: ".$this->getObjCliente()."\n";
    }

    /*En la clase contrato implementar el método actualizarEstadoContrato(): que actualiza el estado del
    contrato según corresponda según lo descripto. (Utilizar el método diasContratoVencido ) */
    public function actualizarEstadoContrato() {
        $diasVencido = $this->diasContratoVencido();

        /*Un contrato se considera en estado moroso cuando su fecha de vencimiento ha sido superada, en caso de que
        pasen 10 días al vencimiento el estado cambiará de moroso a suspendido; caso contrario el contrato se
        encuentra al día. */
        if($diasVencido > 10) {
            $this->setEstado("Suspendido");
            $this->setSeRenueva(false);
        }else if($diasVencido <= 10 && $diasVencido > 0) {
            $this->setEstado("Moroso");
        }else {
            $this->setEstado("Al dia");
        }

        return $diasVencido;
    }

    /*Metodo diasContratoVencido() que retorna la cantidad de dias que el contrado estuvo vencido */
    private function diasContratoVencido() {
        $diferencia = -1;
        $fechaActual = strtotime(date('d/m/Y'));
        $fechaVencimiento = strtotime($this->getFechaVencimiento());

        if ($fechaActual > $fechaVencimiento) {
            $diferencia = $fechaActual - $fechaVencimiento;
        } else if($fechaActual == $fechaVencimiento){
            $diferencia = 0;
        }

        return $diferencia;
    }

    /*Implementar y redefinir el método calcularImporte() que retorna el importe final correspondiente al
    importe del contrato. */
    public function calcularImporte() {
        $objPlan = $this->getObjPlan();
        $importeFinal = $objPlan->getImportePlan();
        $coleccionCanales = $objPlan->getColCanales();
        $diasVencido = $this->actualizarEstadoContrato();
        $incremento = 0.10;  //10% de incremento por cada dia que pase sin pagar
        $maximoDeDias = 10;  //maximo de dias que es 10 antes que pase de moroso a suspendido

        foreach ($coleccionCanales as $objCanal) {
            $importeFinal += $objCanal->getImporteCanal();
        }

        //Antes de que un cliente realice un pago se debe verificar su estado
        if($this->getEstado() == "Moroso") {
            $importeFinal += $importeFinal * $incremento * $diasVencido;
        }else if($this->getEstado() == "Suspendido") {
            $importeFinal += $importeFinal * $incremento * $maximoDeDias;
        }

        return $importeFinal;
    }
}