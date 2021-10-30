<?php
class EmpresaCable {
    //Atributos
    private $colPlanes;
    private $colContratos;

    //Constructor
    public function __construct($colPlanes, $colContratos) {
        $this->colPlanes = $colPlanes;
        $this->colContratos = $colContratos;
    }

    //Observadores
    public function getColPlanes() {
        return $this->colPlanes;
    }

    public function getColContratos() {
        return $this->colContratos;
    }

    //Modificadores
    public function setColPlanes($colPlanes) {
        $this->colPlanes = $colPlanes;
    }

    public function setColContratos($colContratos) {
        $this->colContratos = $colContratos;
    }

    //Metodos 
    /*Metodo __toString() para mostrar los datos de la Empresa Cable */
    public function __toString() {
        return "----PLANES----\n".$this->mostrarColeccion($this->getColPlanes())."\n".
        "----CONTRATOS----\n".$this->mostrarColeccion($this->getColContratos())."\n";
    }

    /* Metodo para mostrar colecciones */
    private function mostrarColeccion($coleccion) {
        $arreglo = "";
        foreach ($coleccion as $obj) {
            $arreglo .= $obj . "\n";
            $arreglo .= "--------------------------\n";
        }
        return $arreglo;
    }

    /*Metodo incorporarPlan(): que incorpora a la colección de planes un nuevo plan siempre y cuando no haya un
    plan con los mismos canales y los mismos MG (en caso de que el plan incluyera). */
    public function incorporarPlan($objPlan) {
        $coleccionPlanes = $this->getColPlanes();
        $i = 0;
        $valido = true;
        while ($valido && $i < count($coleccionPlanes)) { //Primero verifico que no tengan la misma cantidad de MG
            if ($coleccionPlanes[$i]->getIncluyeMG() == $objPlan->getIncluyeMG()) {
                $valido = false;
            }
            $i++;
        }

        if ($valido) { //Si no se encontró uno igual empieza un recorrido mas minucioso
            $j = 0;
            while ($j < count($coleccionPlanes) && $valido) { //Recorro la coleccion de planes
                $k = 0;
                $coleccionCanales = $coleccionPlanes[$j]->getColCanales();
                $coleccionNuevosCanales = $objPlan->getColCanales();
                while ($k < count($coleccionCanales) && $k < count($coleccionNuevosCanales) && $valido) { //Recorro la coleccion de canales de cada uno de los planes guardados, y los comparo con los del plan nuevo
                    if ($coleccionCanales[$k] == $coleccionNuevosCanales[$k]) {
                        $valido = false;
                    }
                    $k++;
                }
                $j++;
            }
        }

        if ($valido) { //Si el nuevo plan paso correctamente por todas las verificaciones, lo guardo en la coleccion
            array_push($coleccionPlanes, $objPlan);
            $this->setColPlanes($coleccionPlanes);
        }

        return $valido;
    }

    /*Metodo incorporarContrato(): recibe por parámetro el plan, una referencia al cliente, la fecha de
    inicio y de vencimiento del mismo y si se trata de un contrato realizado en la empresa o via web (si el
    valor del parámetro es True se trata de un nuevoContrato realizado via web). */
    public function incorporarContrato($objPlan, $objCliente, $fechaInicio, $fechaVencimiento, $tipoContrato) {
        $coleccionContratos = $this->getColContratos();

        if($tipoContrato) {
            $nuevoContrato = new ContratoWeb($fechaInicio, $fechaVencimiento, $objPlan, "Al dia", 0, true, $objCliente);
        }else {
            $nuevoContrato =new ContratoEmpresa($fechaInicio, $fechaVencimiento, $objPlan, "Al dia", 0, true, $objCliente);
        }

        array_push($coleccionContratos, $nuevoContrato);
        $this->setColContratos($coleccionContratos);

        return $nuevoContrato;
    }

    /*Metodo retornarImporteContratos(): recibe por parámetro el código de un plan y retorna la suma
    de los importes de los contratos realizados usando ese plan. */
    public function  retornarImporteContratos($codigoRecibido) {
        $importeContrato = 0;
        $coleccionContratos = $this->getColContratos();

        foreach ($coleccionContratos as $objContrato) {
            $objPlan = $objContrato->getObjPlan();
            $codigoPlan = $objPlan->getCodigoPlan();

            if($codigoPlan == $codigoRecibido){
                $importeContrato += $objContrato->calcularImporte(); 
            }    
        }

        return $importeContrato;
    }

    /*Metodo pagarContrato(): recibe como parámetro un nuevoContrato, actualiza su estado y retorna el importe
    final que debe ser abonado por el cliente. */
    public function pagarContrato($objContrato) {
        $objContrato->actualizarEstadoContrato();        
        $importe = $objContrato->calcularImporte();
        
        return $importe;    
    }
}