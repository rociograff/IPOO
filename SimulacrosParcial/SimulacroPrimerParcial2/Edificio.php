<?php
class Edificio {
    //Atributos
    private $direccion;
    private $colDepartamento; //Referencia a la coleccion de dpto que lo componen
    private $objPersona; //Referencia a una instacia de la clase Persona que representa al administrador del edificio

    //Constructor
    public function __construct($dire, $colDpto, $administrador) {
        $this->direccion = $dire;
        $this->colDepartamento = $colDpto;
        $this->objPersona = $administrador;
    }

    //Observadoras
    public function getDireccion() {
        return $this->direccion;
    }

    public function getColDepartamento() {
        return $this->colDepartamento;
    }

    public function getObjPersona() {
        return $this->objPersona;
    }

    //Modificadoras
    public function setDireccion($dire) {
        $this->direccion = $dire;
    }

    public function setColDepartamento($colDpto) {
        $this->colDepartamento = $colDpto;
    }

    public function setObjPersona($administrador) {
        $this->objPersona = $administrador;
    }

    //Metodos
    /**
     * Metodo __toString() para mostrar los datos del Edificio
     */
    public function __toString() {
        return "\nDireccion: ".$this->getDireccion()."\n".
        "-----COLECCION DEPARTAMENTO-----\n".$this->mostrarDepartamentos()."\n".
        "-----ADMINISTRADOR-----\n".$this->getObjPersona();
    }

    /**
     * Metodo mostrarDepartamentos() para listar la coleccion de departamentos del edificio
     */
    public function mostrarDepartamentos() {
        $retorno = "";
        $col = $this->getColDepartamento();
        for ($i = 0; $i < count($col); $i++) {
            $retorno .= $col[$i] . "\n";
            $retorno .= "-------------------------\n";
        }
        return $retorno;
    }

    /**
     * Método que retorna una colección de todos los departamentos del tipo recibido
     * por parámetro (unTipoInmueble) que se encuentran
     * disponibles para ser alquilados y cuyo costo mensual no supera el valor recibido en el parámetro costoMensual.
     * @param $unTipoInmueble, $costoMensual
     * @return Array $colDptoDisponibles
     */
    public function darInmueblesDisponiblesParaAlquiler($unTipoInmueble, $costoMensual) {
        $colDptoDisponibles = [];
        $colDpto = $this->getColDepartamento();
        foreach ($colDpto as $objDepartamento) {
            $tipo = $objDepartamento->getTipoInmueble();
            $costo = $objDepartamento->getCostoMensual();
            $inquilino = $objDepartamento->getObjPersona();
            if ($unTipoInmueble == $tipo && $costoMensual <= $costo && $inquilino == null) {
                array_push($colDptoDisponibles, $objDepartamento);
            }
        }
        return $colDptoDisponibles;
    }

    /**
     * Metodo que recibe por parámetro una referencia al inmueble que se desea alquilar y la referencia
     * a la persona que desea alquilar. Tener en cuenta que solo se va a poder realizar el alquiler de dicho 
     * inmueble si verifica la política de alquiler de la empresa. El método debe
     * retornar verdadero en caso de poder registrar el alquiler o falso en caso contrario.
     */
    public function registrarAlquilerInmueble($objInmueble, $objPersona) {
        $exito = false;
        if ($this->verificaPolitica($objInmueble)) {  //Verifico que cumpla la politica de la empresa
            $colInmuebles = $this->getColDepartamento();
            $i = 0;
            while ($i < count($colInmuebles)) {
                if ($colInmuebles[$i]->getCodigoReferencia() == $objInmueble->getCodigoReferencia()) {
                    $colInmuebles[$i]->alquilarInmueble($objPersona);
                    $exito = true;
                    $i = count($colInmuebles);
                }
                $i++;
            }
        }
        return $exito;
    }

    /**
     * Por política de la empresa los inmuebles de un edificio se deben ir ocupando por piso y por tipo. Es decir,
     * hasta que todos los inmuebles de un piso y de un tipo no se encuentren ocupados, no es posible alquilar un
     * inmueble de un piso superior.
     */
    public function verificaPolitica ($objInmueble) {
        $verifica = true;
        $colDepartamentos = $this->getColDepartamento();
        $pisoRef = $objInmueble->getNumeroPiso();
        $tipoRef = $objInmueble->getTipoInmueble();
        $i = 0;

        while (count ($colDepartamentos) > $i && !$verifica) {
            $objDepartamento = $colDepartamentos[$i];
            $piso = $objDepartamento->getNumeroPiso();
            $tipo = $objDepartamento->getTipoInmueble();
            $inquilino = $objDepartamento->getObjPersona();
            if ($piso < $pisoRef && $inquilino == null && $tipo == $tipoRef) {
                $verifica = false;
            }
            $i++;
        }
        return $verifica;
    }

    /**
     * Método que retorna el valor correspondiente a la suma de los costo de cada uno de los inmuebles que se encuentran alquilados.
     */
    public function calcularCostoEdificio() {
        $costoTotal = 0;
        $colDpto= $this->getColDepartamento();
        foreach ($colDpto as $objDepartamento) {
            $inquilino = $objDepartamento->getObjPersona();
            if ($inquilino != null) {
                $costoTotal += $objDepartamento->getCostoMensual();
            }         
        }
        return $costoTotal;
    }
}