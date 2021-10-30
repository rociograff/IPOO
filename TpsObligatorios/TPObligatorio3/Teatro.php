<?php
class Teatro {
    //Atributos
    private $nombreTeatro;
    private $direccionTeatro;
    private $colFunciones;

    //Constructor
    public function __construct($nombre, $direccion) {
        $this -> nombreTeatro = $nombre;
        $this -> direccionTeatro = $direccion;
        $this -> colFunciones = array();
    }

    //Observadores
    public function getNombre() {
        return $this -> nombreTeatro;
    }

    public function getDireccion() {
        return $this -> direccionTeatro;
    }

    public function getColFunciones() {
        return $this -> colFunciones;
    }

    //Modificadores
    public function setNombre($nombre) {
        $this -> nombreTeatro = $nombre;
    }

    public function setDireccion($direccion) {
        $this -> direccionTeatro = $direccion;
    }

    public function setColFunciones($arreglo) {
        $this -> colFunciones = $arreglo;
    }

    //Metodos
    /**
    * Busca la existencia de una funcion requerida
    * De ser asi, devuelve la posicion en la que se encuentra
    */
    public function buscarFuncion($funcionBuscada) {
        /**
         * Declaracion de variables
         * int $indiceFuncion, $i
         * string $funcionBuscada
         * */
        $pos = -1;
        $i = 0;
        $colFunciones = $this->getColFunciones();
        while ($i < count($colFunciones) && $pos == -1) {
            if ($colFunciones[$i]->getNombre() == $funcionBuscada) {
                $pos = $i;
            } else {
                $i++;
            }
        }
        return $pos;
    }

    /**
    * Metodo que verifica que el horario de las funciones no se solapen en un mismo teatro
    * @param $funcion
    * @return $seSolapa
    */
    public function seSolapan($funcion) {
        $seSolapa = false;
        $i = 0;

        $colFunciones = $this->getColFunciones();
        while (!$seSolapa && $i < count($colFunciones)) {
            if($funcion->getNombre() != $colFunciones[$i]->getNombre()) {
                $duracion = $colFunciones[$i]->getDuracion();
                $horaFuncion = $colFunciones[$i]->horaAMinutos();
                $total = $duracion + $horaFuncion;
                if ($funcion->horaAMinutos() > $total || $horaFuncion > ($funcion->horaAMinutos() + $funcion->getDuracion())) {
                    $seSolapa = false;
                    $i++;
                } else {
                    $seSolapa = true;
                }
            }else {
                $i++;
            }
        }
        return $seSolapa;
    }

    /**
    * Metodo calcularCostoTotal() el cual determina según las actividades del teatro cuál debería ser el cobro obtenido.
    * @return $cadena variable que muestra cada costo de las actividades y la suma total
    */
    public function calcularCostoTotal() {
        /*variable: array $colFunciones, int $costoTotal, int $precioFuncion*/
        //La coleccion tiene instancias de Obra, Musical y Cine
        $colFunciones = $this->getColFunciones();
        $costoObra = 0;
        $costoCine = 0;
        $costoMusical = 0;
        $costoTotal = 0;
        foreach ($colFunciones as $actividad) {
            $precioFuncion = $actividad->darCostos();
            //Sumo los precios de cada tipo de actividad y aplico un incremento por actividad segun se detalla en cada clase
            switch (get_class($actividad)) {
                case "Obra":
                    $costoObra += $precioFuncion;
                    break;
                case "Cine":
                    $costoCine += $precioFuncion;
                    break;
                case "Musical":
                    $costoMusical += $precioFuncion;
                    break;
            }
            //Sumo el costo total
            $costoTotal = $costoCine + $costoMusical + $costoObra;
        }
        return "\nObras: $".$costoObra."\n".
        "Cine: $".$costoCine."\n".
        "Musicales: $".$costoMusical."\n". 
        "Costo total: $".$costoTotal."\n";
    }

    /**
    * Metodo __toString() para mostrar los datos del Teatro
    * @return $cadena 
    */
    public function __toString() {
        return "Teatro: " . $this->getNombre() . "\n" .
        "Direccion: " . $this->getDireccion() . "\n" .
        "Funciones: " . $this->mostrarColeccion($this->getColFunciones())."\n";
    }

    /**
    * Metodo para mostrar colecciones
    * @return $arreglo
    */
    private function mostrarColeccion($coleccion) {
        //Array Funciones $arreglo
        $arreglo = "";
        foreach ($coleccion as $obj) {
            $arreglo .= $obj . "\n";
            $arreglo .= "--------------------------\n";
        }
        return $arreglo;
    }
}