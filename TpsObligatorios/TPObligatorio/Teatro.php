<?php
class Teatro {
    //Atributos
    private $nombreTeatro;
    private $direccionTeatro;
    private $colFunciones;

    //Constructor
    private function __construct($nombre, $direccion, $funcion) {
        $this -> nombreTeatro = $nombre;
        $this -> direccionTeatro = $direccion;
        $this -> colFunciones = $funcion;
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

    public function setDireccion ($direccion) {
        $this -> direccionTeatro = $direccion;
    }
    public function setColFunciones($funcion) {
        $this -> colFunciones = $funcion;
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
         * Array Teatro $conFunciones
         * */

        // Inicializacion de variables
        $pos = -1;
        $i = 0;
        $colFunciones = $this -> getColFunciones();
        while ($i < count($colFunciones) && $pos == -1) {
            if ($colFunciones[$i]["nombre"] == $funcionBuscada) {
                $pos = $i;
            } else {
                $i++;
            }
        }
        return $pos;
    }

    /**
     * Modifica y reemplaza valores de un funcion existente por unos nuevos
     */
    public function cambiarFuncion($pos, $nuevoNombre, $nuevoPrecio) {
        //boolean $exito
        //Array Teatro $colFunciones
        $colFunciones = $this -> getColFunciones();
        if ($pos < 4 && $pos >= 0) {
            $arregloAux = array ("Nombre"=> $nuevoNombre, "Precio"=>$nuevoPrecio);
                $colFunciones[$pos] = $arregloAux;
                $this->setFunciones($colFunciones);
            $exito = true;
        } else {
            $exito = false;
        }
        return $exito;
    }

    public function __toString() {
        return "Nombre: " . $this->getNombre() . "\n" .
        "Direccion: " . $this->getDireccion() . "\n";
        "Funciones: ".$this->mostrarFunciones();
    }

    public function mostrarFunciones() {
        //String $retorno
        //Array Teatro $col
        $retorno = "";
        $col = $this->getColFunciones();
        for ($i = 0; $i < count($col); $i++) {
            $retorno .= $col[$i] . "\n";
            $retorno .= "-------------------------\n";
        }
        return $retorno;
    }
}