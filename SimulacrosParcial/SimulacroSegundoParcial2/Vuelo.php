<?php
class Vuelo {
    //Atributos
    private $numeroVuelo;
    private $plazasEjecutivasDisponibles;
    private $plazasEconomicasDisponibles;
    private $horaPartida;
    private $horaLlegada;
    private $destinoVuelo;  //Referencia a un objeto de la clase Destino
    private $avionAsignado; //Referencia a un objeto de la clase Avion
    private $importeVuelo;
    private $colPasajeros;

    //Constructor
    public function __construct($numeroVuelo, $plazasEjecutivasDisponibles, $plazasEconomicasDisponibles, $horaPartida, $horaLlegada, $destinoVuelo, $avionAsignado, $importeVuelo, $colPasajeros) {
        $this->numeroVuelo = $numeroVuelo;
        $this->plazasEjecutivasDisponibles = $plazasEjecutivasDisponibles;
        $this->plazasEconomicasDisponibles = $plazasEconomicasDisponibles;
        $this->horaPartida = $horaPartida;
        $this->horaLlegada = $horaLlegada;
        $this->destinoVuelo = $destinoVuelo;
        $this->avionAsignado = $avionAsignado;
        $this->importeVuelo = $importeVuelo;
        $this->colPasajeros = $colPasajeros;
    }

    //Observadores
    public function getNumeroVuelo() {
        return $this->numeroVuelo;
    }

    public function getPlazasEjecutivasDisponibles() {
        return $this->plazasEjecutivasDisponibles;
    }

    public function getPlazasEconomicasDisponibles() {
        return $this->plazasEconomicasDisponibles;
    }

    public function getHoraPartida() {
        return $this->horaPartida;
    }

    public function getHoraLlegada() {
        return $this->horaLlegada;
    }

    public function getDestinoVuelo() {
        return $this->destinoVuelo;
    }

    public function getAvionAsignado() {
        return $this->avionAsignado;
    }

    public function getImporteVuelo() {
        return $this->importeVuelo;
    }

    public function getColPasajeros() {
        return $this->colPasajeros;
    }

    //Modificadores
    public function setNumeroVuelo($numeroVuelo) {
        $this->numeroVuelo = $numeroVuelo;
    }

    public function setPlazasEjecutivasDisponibles($plazasEjecutivasDisponibles) {
        $this->plazasEjecutivasDisponibles = $plazasEjecutivasDisponibles;
    }

    public function setPlazasEconomicasDisponibles($plazasEconomicasDisponibles) {
        $this->plazasEconomicasDisponibles = $plazasEconomicasDisponibles;
    }

    public function setHoraPartida($horaPartida) {
        $this->horaPartida = $horaPartida;
    }

    public function setHoraLlegada($horaLlegada) {
        $this->horaLlegada = $horaLlegada;
    }

    public function setDestinoVuelo($destinoVuelo) {
        $this->destinoVuelo = $destinoVuelo;
    }

    public function setAvionAsignado($avionAsignado) {
        $this->avionAsignado = $avionAsignado;
    }

    public function setImporteVuelo($importeVuelo) {
        $this->importeVuelo = $importeVuelo;
    }

    public function setColPasajeros($colPasajeros) {
        $this->colPasajeros = $colPasajeros;
    }

    //Metodos
    /*Metodo __toString() para mostrar los datos del Vuelo */
    public function __toString() {
        return "Numero Vuelo: ".$this->getNumeroVuelo()."\n".
        "Cantidad de plazas Ejecutivas: ".$this->getPlazasEjecutivasDisponibles()."\n".
        "Cantidad de palzas Economicas: ".$this->getPlazasEconomicasDisponibles()."\n".
        "Hora de partida: ".$this->getHoraPartida()."\n".
        "Hora de llegada: ".$this->getHoraLlegada()."\n".
        "Destino: ".$this->getDestinoVuelo()."\n".
        "Avion asignado: ".$this->getAvionAsignado()."\n".
        "Importe del Vuelo: ".$this->getImporteVuelo()."\n".
        "------PASAJEROS------\n".$this->mostrarColeccion($this->getColPasajeros());
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

    /*Metodo calcularImporte($objPasajero) que recibe por parametro un objeto Pasajero el cual el costo de un
    pasaje (importe final del vuelo) se calcula sobre el importe del vuelo y si el pasajero es Argentino se aplica el 21%
    de IVA caso contrario el impuesto no es aplicable. */
    public function calcularImporte($objPasajero) {
        $costo = $this->getImporteVuelo();
        $nacionalidad = $objPasajero->getNacionalidad();

        if($nacionalidad == "argentina") {
            $costo = $costo * 0.21;
        }
        return $costo;
    }
}