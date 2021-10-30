<?php
class Financiera {
    //Atributos
    private $denominacion;
    private $direccion;
    private $colPrestamo;  //coleccion de Prestamos

    public function __construct($deno, $dire) {
        $this->denominacion = $deno;
        $this->direccion = $dire;
        $this->colPrestamo = [];
    }

    //Observadoras
    public function getDenominacion() {
        return $this->denominacion;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getColPrestamo() {
        return $this->colPrestamo;
    }

    //Modificadoras
    public function setDenominacion($deno) {
        $this->denominacion = $deno;
    }

    public function setDireccion($dire) {
        $this->direccion = $dire;
    }

    public function setColPrestamo($arreglo) {
        $this->colPrestamo = $arreglo;
    }

    //Metodos 
    /**
     * Metodo __toString() para mostrar los datos de la Financiera
     */
    public function __toString() {
        return "\nDenominacion: ".$this->getDenominacion()."\n".
        "Direccion: ".$this->getDireccion()."\n".
        "------PRESTAMOS------".$this->mostrarPrestamos();
    }

    /**
     * Metodo para mostrar la coleccion de prestamos
     */
    public function mostrarPrestamos() {
        //String $retorno
        //Array Prestamo $col
        $retorno = "";
        $col = $this->getColPrestamo();
        for ($i = 0; $i < count($col); $i++) {
            $retorno .= $col[$i] . "\n";
            $retorno .= "----------------------------\n";
        }
        return $retorno;
    }

    /**
     * Metodo incorporarPrestamo() que recibe por parámetro un nuevo préstamo.
     */
    public function incorporarPrestamo($nuevoPrestamo) {
        $colPrestamo = $this->getColPrestamo();
        array_push($colPrestamo, $nuevoPrestamo);
        $this->setColPrestamo($colPrestamo);
    }

    /**
     * Método que recorre la lista de prestamos que no
     * han sido generadas sus cuotas. Por cada préstamo, se corrobora que su monto dividido la
     * cantidad_de_cuotas no supere el 40 % del neto del solicitante, si la verificación es satisfactoria se invoca
     * al método otorgarPrestamo().
     */
    public function otorgarPrestamoSiCalifica() {
        $coleccion = $this->getColPrestamo();
        foreach ($coleccion as $prestamo) {
            if (count($prestamo->getColCuota()) == 0) { //Verifica que aun no se haya aprobado el prestamo
                $monto = $prestamo->getMonto();
                $cantCuotas = $prestamo->getCantCuotas();
                $persona = $prestamo->getObjPersona();
                if (($monto / $cantCuotas) <= ($persona->getNeto() * 0.4)) { //Verifica que el valor de las cuotas no supere el 40% del neto de la persona solicitante
                    $prestamo->otorgarPrestamo();
                }
            }
        }
        $this->setColPrestamo($coleccion); //Actualizo la coleccion de prestamos luego de las modificaciones
    }

    /**
     * Metodo informarCuotaPagar() que recibe por parámetro la identificación del
     * préstamo, se busca el préstamo en la colección de prestamos y si es encontrado se obtiene la siguiente
     * cuota a pagar. El método debe retornar la referencia a la cuota.
     */
    public function informarCuotaPagar($idPrestamo) {
        $objCuota = null;
        $encontre = false;
        $i = 0;
        $coleccionPrestamos = $this->getColPrestamo();

        while($i < count($coleccionPrestamos) && !$encontre) {
            $objPrestamo = $coleccionPrestamos[$i];

            if ($objPrestamo->getIdentificacion() == $idPrestamo) {
                $objCuota = $objPrestamo->darSiguienteCuotaPagar();
                $encontre = true;
            }
            $i++;
        }

        return $objCuota;
    }
}