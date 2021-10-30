<?php 
class Partido {
    //Atributos
    private $idPartido;
    private $equipo1;
    private $equipo2;
    private $fecha;
    private $cantGolesEq1;
    private $cantGolesEq2;

    //Constructor
    public function __construct($idPartido, $equipo1, $equipo2, $fecha, $cantGolesEq1, $cantGolesEq2) {
        $this->idPartido = $idPartido;
        $this->equipo1 = $equipo1;
        $this->equipo2 = $equipo2;
        $this->fecha = $fecha;
        $this->cantGolesEq1 = $cantGolesEq1;
        $this->cantGolesEq2 = $cantGolesEq2;
    }

    //Observadores
    public function getIdPartido() {
        return $this->idPartido;
    }

    public function getEquipo1() {
        return $this->equipo1;
    }

    public function getEquipo2() {
        return $this->equipo2;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getCantGolesEq1() {
        return $this->cantGolesEq1;
    }

    public function getCantGolesEq2() {
        return $this->cantGolesEq2;
    }

    //Modificadoras
    public function setIdPartido($idPartido) {
        $this->idPartido = $idPartido;
    }

    public function setEquipo1($equipo1) {
        $this->equipo1 = $equipo1;
    }

    public function setEquipo2($equipo2) {
        $this->equipo2 = $equipo2;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setCantGolesEq1($cantGolesEq1) {
        $this->cantGolesEq1 = $cantGolesEq1;
    }

    public function setCantGolesEq2($cantGolesEq2) {
        $this->cantGolesEq2 = $cantGolesEq2;
    }

    //Metodos
    /*Metodo __toString() que muetra todos los datos de los Partidos*/
    public function __toString() {
        return "\nId Partido: ".$this->getIdPartido()."\n".
        "Equipo 1: ".$this->getEquipo1()."\n".
        "Equipo 2: ".$this->getEquipo2()."\n".
        "Fecha: ".$this->getFecha()."\n".
        "Cantidad de goles del equipo 1: ".$this->getCantGolesEq1()."\n".
        "Cantidad de goles del equipo 2: ".$this->getCantGolesEq2()."\n";
    }

    /*Metodo coeficientePartido() que en cada partido se calcula un coeficiente base de 0,5 que es aplicado
     a la cantidad de goles y a la cantidad de jugadores de cada equipo. */
    public function coeficientePartido() {
        $coeficiente = 0.5;
        //$cantG = Variable que suma la cantidad de goles
        $cantG = $this->getCantGolesEq1() + $this->getCantGolesEq2();
        //$cantJ = Variable que suma la cantidad de jugadores
        $cantJ = $this->getEquipo1()->getCantJugadores() + $this->getEquipo2()->getCantJugadores();

        $coeficiente *= $cantG * $cantJ;
        
        return $coeficiente;
    }

    /*Metodo equipoGanador() que retorna el equipo ganador con la mayor cantidad de goles*/
    public function equipoGanador() {
        $equipoGanador = null;
        $golesE1 = $this->getCantGolesEq1();
        $golesE2 = $this->getCantGolesEq2();

        if($golesE1 > $golesE2) {
            $equipoGanador = $this->getEquipo1();
        } else if ($golesE2 > $golesE1) {
            $equipoGanador = $this->getEquipo2();
        }

        return $equipoGanador;
    }
}