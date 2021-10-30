<?php
class Funciones {
    //Atributos
    private $nombre;
    private $precio;
    private $horaInicio;
    private $duracion;

    //Constructor
    public function __construct($nom, $pre, $horaIni, $time) {
        //La duracion de la funcion es en minutos
        $this->nombre = $nom;
        $this->precio = $pre;
        $this->horaInicio = $horaIni;
        $this->duracion = $time;
    }

    //Observadores
    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getHoraInicio() {
        return $this->horaInicio;
    }

    public function getDuracion() {
        return $this->duracion;
    }

    //Modificadores
    public function setNombre($nom) {
        $this->nombre = $nom;
    }

    public function setPrecio($pre) {
        $this->precio = $pre;
    }

    public function setHoraInicio($horaIni) {
        $this->horaInicio = $horaIni;
    }

    public function setDuracion($time) {
        $this->duracion = $time;
    }

    public function __toString() {
        return "\tNombre: " . $this->getNombre() . 
        "\n\tPrecio: $" . $this->getPrecio() . 
        "\n\tHora inicio: " . $this->getHoraInicio() . 
        "\n\tDuracion: " . $this->getDuracion() . " minutos";
    }

    /**
     * Metodo para convertir las horas con formato hh:mm a minutos
     * @return $totalMinutos
     */
    public function horaAMinutos() {
        //String $hora
        //int $horasPartes, $totalMinutos
        $hora = $this->getHoraInicio();  //Hora a convertir en minutos

        if(strpos($hora, ':') !== false) { //Encuentra la posición de la primera ocurrencia de un substring en un string
            //Realizo una particion que separe la parte de la hora y la parte de los minutos
            $horasPartes = explode(":", $hora);
        }
        //La parte de la hora la multiplicamos por 60 para pasarla a minutos y asi realizar la suma de los minutos totales
        $totalMinutos = ($horasPartes[0] * 60) + $horasPartes[1];

        return $totalMinutos;
    }
}