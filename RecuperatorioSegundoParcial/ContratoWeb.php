<?php
class ContratoWeb extends Contrato {
    //Atributos
    private $porcentajeDescuento;  //Por defecto es de 10%

    //Constructor
    public function __construct($fechaInicio, $fechaVencimiento, $objPlan, $estado, $costo, $seRenueva, $objCliente) {
        //Invoco el contructor de la clase Contrato
        parent::__construct($fechaInicio, $fechaVencimiento, $objPlan, $estado, $costo, $seRenueva, $objCliente);
        $this->porcentajeDescuento = 0.10;
    }

    //Observador
    public function getPorcentajeDescuento() {
        return $this->porcentajeDescuento;
    }

    //Modificador
    public function setPorcentajeDescuento($porcentajeDescuento) {
        $this->porcentajeDescuento = $porcentajeDescuento;
    }

    //Metodos
    /*Implementar y redefinir el método calcularImporte() que retorna el importe final correspondiente al
    importe del contrato. 
    Si se trata de un contrato realizado via web al
    importe del mismo se le aplica un porcentaje de descuento que por defecto es del 10%.*/
    public function calcularImporte() {
        $porcentaje = $this->getPorcentajeDescuento();
        //Redefiniendo el metodo calcularImporte()
        $importeFinal = parent::calcularImporte();
        $importeFinal = $importeFinal - ($importeFinal * $porcentaje);

        return $importeFinal;    
    }

    /*Metodo __toString() para mostrar los datos del Contrato via Web */
    public function __toString() {
        $cadena = parent::__toString();
        $cadena .= "Porcentaje Descuento Contrato web".$this->getPorcentajeDescuento()."\n";
        return $cadena;
    }
}