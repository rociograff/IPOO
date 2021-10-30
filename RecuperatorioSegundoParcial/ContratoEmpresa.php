<?php
class ContratoEmpresa extends Contrato {
    //Constructor
    public function __construct($fechaInicio, $fechaVencimiento, $objPlan, $estado, $costo, $seRenueva, $objCliente) {
        //Invoco el constructor de la clase Contrato
        parent::__construct($fechaInicio, $fechaVencimiento, $objPlan, $estado, $costo, $seRenueva, $objCliente); 
    }
}