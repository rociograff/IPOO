<?php
class Nacional extends Torneo{
    //Constructor
    public function __construct($idTorneo, $colPartidos, $montoPremio, $nombreLocalidad) {
        //Invoco el constructor de la clase Torneo 
        parent::__construct($idTorneo, $colPartidos, $montoPremio, $nombreLocalidad);
    }
    
    //Metodos
    /*Metodo obtenerPremioTorneo() que si se trata de un 
    torneo Nacional al premio economico se adiciona 10% del monto del premio por la cantidad de partidos ganados */
    public function obtenerPremioTorneo() {
        $ganadorTorneo = parent::obtenerEquipoGanadorTorneo();
        $cantidadPartidosGanados = $ganadorTorneo["partidosGanados"];
        $montoPremio = parent::obtenerPremioTorneo(); //Redefiniendo el metodo 

        $montoPremio = ($montoPremio * 1.10) * $cantidadPartidosGanados;

        return $montoPremio;
    }
}