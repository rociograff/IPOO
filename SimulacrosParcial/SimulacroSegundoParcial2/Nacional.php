<?php
class Nacional extends Vuelo {
    //Atributos
    private $costoPasaje;

    //Constructor
    public function __construct($numeroVuelo, $plazasEjecutivasDisponibles, $plazasEconomicasDisponibles, $horaPartida, $horaLlegada, $destinoVuelo, $avionAsignado, $importeVuelo, $colPasajeros, $costoPasaje) {
        //Invoco el constructor de la clase Vuelo
        parent::__construct($numeroVuelo, $plazasEjecutivasDisponibles, $plazasEconomicasDisponibles, $horaPartida, $horaLlegada, $destinoVuelo, $avionAsignado, $importeVuelo, $colPasajeros);
        $this->costoPasaje = $costoPasaje;
    }

    //Observador
    public function getCostoPasaje() {
        return $this->costoPasaje;
    }

    //Modificador
    public function setCostoPasaje($costoPasaje) {
        $this->costoPasaje = $costoPasaje;
    }

    //Metodos
    /*Metodo __toString() para mostrar los datos del vuelo Nacional */
    public function __toString() {
        return parent::__toString()."\n".
        "Costo pasaje: ".$this->getCostoPasaje()."\n";
    }
}