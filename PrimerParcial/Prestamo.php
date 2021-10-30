<?php
class Prestamo {
    //Atributos
    private $identificacion;
    private $fechaOtorgamiento;
    private $monto;
    private $cantCuotas;
    private $tazaInteres;
    private $colCuota;  //coleccion de cuotas
    private $objPersona;  //referencia a la persona que solicito el préstamo.

    //Constructor
    public function __construct($ide, $monto, $cant, $interes, $persona) {
        $this->identificacion = $ide;
        $this->monto = $monto;
        $this->cantCuotas = $cant;
        $this->tazaInteres = $interes;
        $this->colCuota = [];
        $this->objPersona = $persona;
    }

    //Observadoras
    public function getIdentificacion() {
        return $this->identificacion;
    }

    public function getFechaOtorgamiento() {
        return $this->fechaOtorgamiento;
    }

    public function getMonto() {
        return $this->monto;
    }

    public function getCantCuotas() {
        return $this->cantCuotas;
    }

    public function getTazaInteres() {
        return $this->tazaInteres;
    }

    public function getColCuota() {
        return $this->colCuota;
    }

    public function getObjPersona() {
        return $this->objPersona;
    }

    //Modificadoras
    public function setIdentificacion($ide) {
        $this->identificacion = $ide;
    }

    public function setFechaOtorgamiento($fecha) {
        $this->fechaOtorgamiento = $fecha;
    }

    public function setMonto($monto) {
        $this->monto = $monto;
    }

    public function setCantCuotas($cant) {
        $this->cantCuotas = $cant;
    }

    public function setTazaInteres($interes) {
        $this->tazaInteres = $interes;
    }

    public function setColCuota($arreglo) {
        $this->colCuota = $arreglo;
    }

    public function setObjPersona($persona) {
        $this->objPersona = $persona;
    }

    //Metodos 
    /**
     * Metodo __toString() para mostrar los datos del Prestamo
     */
    public function __toString() {
        return "\nIdentificacion: ".$this->getIdentificacion()."\n".
        "Fecha Otorgamiento: ".$this->getFechaOtorgamiento()."\n".
        "Monto: ".$this->getMonto()."\n".
        "Cantidad de cuotas: ".$this->getCantCuotas()."\n".
        "Taza de interes: ".$this->getTazaInteres()."\n".
        "------CUOTAS------".$this->mostrarCuotas()."\n".
        "------PERSONA------".$this->getObjPersona();
    }
    
    /**
     * Metodo para mostrar la coleccion de cuotas
     */
    public function mostrarCuotas() {
        //String $retorno
        //Array Cuota $col
        $retorno = "";
        $col = $this->getColCuota();
        for ($i = 0; $i < count($col); $i++) {
            $retorno .= $col[$i] . "\n";
            $retorno .= "----------------------------\n";
        }
        return $retorno;
    }

    /**
     * Metodo privado calcularInteresPrestamo() que recibe por parámetro el numero
     * de la cuota y calcula el importe del interés sobre el saldo deudor.
     */
    private function calcularInteresPrestamo($numCuota) {
        $importe = 0;
        $monto = $this->getMonto();
        $cantidadDeCuotas = $this->getCantCuotas();
        $tazaDeInteres = $this->getTazaInteres();
        
        $importe = ($monto - (($monto / $cantidadDeCuotas) * $numCuota -1)) * $tazaDeInteres/0.01;

        return $importe;
    }

    /**
     * Metodo que setea la variable instancia fecha otorgamiento, con la
     * fecha actual y genera cada una de las cuotas dependiendo el valor almacenado en la variable instancia “cantidad_de_cuotas” y monto.
     * Y el monto correspondiente al interés debe ser el valor retornado por el método calcularInteresPrestamo(
     * numeroCuota) implementado en el inciso anterior.
     */
    public function otorgarPrestamo() {
        //setea la variable instancia fecha otorgamiento
        $fecha = getdate();
        $this->setFechaOtorgamiento($fecha);
        //genera cada una de las cuotas = generar la cantidad de objetos cuotas que corresponda
        $monto = $this->getMonto();
        $cantidadDeCuotas = $this->getCantCuotas();
        for($i = 1; $i <= $cantidadDeCuotas; $i++) {
            //El importe total de la cuota debe ser calculado de la siguiente manera: (monto / cantidad_de_cuotas)
            $montoCuota = $monto / $cantidadDeCuotas;
            //al interés debe ser el valor retornado por el método calcularInteresPrestamo(numeroCuota)
            $montoInteres = $this->calcularInteresPrestamo($i);
            $objCuota = new Cuota($i, $montoCuota, $montoInteres);
            $colCuotas = array_push($colCuotas, $objCuota);
        }
        $this->setColCuota($colCuotas);
    }

    /**
     * Método que retorna la referencia a la siguiente cuota
     * que debe ser abonada de un préstamo, si el préstamo tiene todas sus cuotas canceladas retorna null.
     */
    public function darSiguienteCuotaPagar() {
        $retorno = null;
        $cancelada = true;
        $colCuotas = $this->getColCuota();
        $i = 0;
        while ($i < count($colCuotas) && $cancelada) { //Itera mientras que las cuotas de la coleccion estén canceladas
            $cancelada = $colCuotas[$i]->getCancelada();
            if (!$cancelada) { //Si encuentra una cuota sin cancelar retorna la referencia
                $retorno = $colCuotas[$i];
            }
            $i++;
        }
        return $retorno;
    }
}