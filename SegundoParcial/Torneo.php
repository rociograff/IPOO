<?php
class Torneo {
    //Atributos
    private $idTorneo;
    private $colPartidos;
    private $montoPremio;
    private $nombreLocalidad;
    
    //Constructor
    public function __construct($idTorneo, $colPartidos, $montoPremio, $nombreLocalidad) {
        $this->idTorneo = $idTorneo;
        $this->colPartidos = $colPartidos;
        $this->montoPremio = $montoPremio;
        $this->nombreLocalidad = $nombreLocalidad;
    }
    
    //Observadores
    public function getIdTorneo() {
        return $this->idTorneo;
    }
    
    public function getColPartidos() {
        return $this->colPartidos;
    }
    
    public function getMontoPremio() {
        return $this->montoPremio;
    }
    
    public function getNombreLocalidad() {
        return $this->nombreLocalidad;
    }
    
    //Modificadores
    public function setIdTorneo($idTorneo) {
        $this->idTorneo = $idTorneo;
    }
    
    public function setColPartidos($colPartidos) {
        $this->colPartidos = $colPartidos;
    }
    
    public function setMontoPremio($montoPremio) {
        $this->montoPremio = $montoPremio;
    }
    
    public function setNombreLocalidad($nombreLocalidad) {
        $this->nombreLocalidad = $nombreLocalidad;
    }
    
    //Metodos
    /*Metodo __toString() para mostrar los datos del Torneo */
    public function __toString() {
        return "ID Torneo: ".$this->getIdTorneo()."\n". 
        "------PARTIDOS------\n".$this->mostrarColeccion($this->getColPartidos())."\n".
        "Monto del premio: ". $this->getMontoPremio()."\n".
        "Nombre localidad donde se juega: ".$this->getNombreLocalidad()."\n";
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

    /*Metodo obtenerEquipoGanadorTorneo() que recorre la lista de partidos y se queda con aquel equipo que gano mas
    partidos. El metodo debe retornar un arreglo asociativo con el objeto de la clase Equipo (correspondiente al 
    equipo ganador del Torneo) y otra clave con la cantidad de goles realizados en todo el torneo. */
    public function obtenerEquipoGanadorTorneo() {    
        $colPartidos = $this->getColPartidos();
        $coleccionEquipos = $this->obtenerEquipos($colPartidos);
        $coleccionEquiposGanadores = [];

        foreach ($coleccionEquipos as $equipo) {
            $nombre = $equipo->getNombre();
            $partidosGanados = $this->obtenerPartidosGanadosPorEquipo($nombre, $colPartidos);
            $golesHechos = $this->obtenerGolesRealizadosPorEquipo($nombre, $colPartidos);
            $arregloInfoEquipo = array('objEquipo'=>$equipo, 'partidosGanados'=>$partidosGanados, 'golesConvertidos'=>$golesHechos);
            array_push($coleccionEquiposGanadores, $arregloInfoEquipo);
        }
        $cantPartidosGanadosMax = 0;
        $arrayGanador = null;
        foreach ($coleccionEquiposGanadores as $equipoGanador) {
            if($equipoGanador['partidosGanados'] > $cantPartidosGanadosMax) {
                $cantPartidosGanadosMax = $equipoGanador['partidosGanados'];
                $arrayGanador = $equipoGanador;
            }
        }

        return $arrayGanador;
    }

    public function obtenerEquipos($partidos) {  //Metodo auxiliar
        $coleccionEquipos = [];
        // Primer foreach para sacar los equipos participantes del torneo
        foreach ($partidos as $partido) {
            $equipo1 = $partido->getEquipo1();
            $equipo2 = $partido->getEquipo2();
            $existeEquipo1 = false;
            $existeEquipo2 = false;
            foreach ($coleccionEquipos as $equipo) {
                if($equipo1 == $equipo) {
                    $existeEquipo1 = true;
                }
                if($equipo2 == $equipo) {
                    $existeEquipo2 = true;
                }
            }
            if(!$existeEquipo1) {
                array_push($coleccionEquipos, $equipo1);
            }
            if(!$existeEquipo2) {
                array_push($coleccionEquipos, $equipo2);
            }
        }

        return $coleccionEquipos;
    }

    public function obtenerGolesRealizadosPorEquipo($nombreEquipo, $colPartidos) {  //Metodo auxiliar
        $golesEquipo = 0;
        foreach ($colPartidos as $partido) {
            $equipo1 = $partido->getEquipo1();
            $equipo2 = $partido->getEquipo2();
            $cantGolesEquipo1 = $partido->getCantGolesEq1();
            $cantGolesEquipo2 = $partido->getCantGolesEq2();

            if($nombreEquipo == $equipo1->getNombreEquipo()) {
                $golesEquipo = $golesEquipo + $cantGolesEquipo1;
            }
            if($nombreEquipo == $equipo2->getNombreEquipo()) {
                $golesEquipo = $golesEquipo + $cantGolesEquipo2;
            }
        }

        return $golesEquipo;
    }

    public function obtenerPartidosGanadosPorEquipo($nombreEquipo, $colPartidos) {  //Metodo auxiliar
        $partidosGanados = 0;
        foreach ($colPartidos as $partido) {
            $cantGolesEquipo1 = $partido->getCantGolesEq1();
            $cantGolesEquipo2 = $partido->getCantGolesEq2();

            if($cantGolesEquipo1 > $cantGolesEquipo2) {
                $equipoGanador = $partido->getEquipo1(); 
            }else if($cantGolesEquipo1<$cantGolesEquipo2) {
                $equipoGanador = $partido->getEquipo2();
            }else {
                $equipoGanador = null;
            }

            if($equipoGanador <> null) {
                if($nombreEquipo == ($equipoGanador->getNombreEquipo())) {
                    $partidosGanados = $partidosGanados + 1;
                }
            }
        }

        return $partidosGanados;
    }

    /*Metodo obtenerPremioTorneo() que calcula el premio economico que debe ser otorgado al equipo ganador del Torneo 
    Provincial o Nacional. El premio economico es otorgado al equipo que ha ganado mas partidos. */
    public function obtenerPremioTorneo() {
        $premio = $this->getMontoPremio();
        return $premio;
    }   
}