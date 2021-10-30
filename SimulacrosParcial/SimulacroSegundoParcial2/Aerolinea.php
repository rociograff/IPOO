<?php
class Aerolinea {
    //Atributos
    private $nombreAerolinea;
    private $colVuelos;

    //Constructor
    public function __construct($nombreAerolinea, $colVuelos) {
        $this->nombreAerolinea = $nombreAerolinea;
        $this->colVuelos = $colVuelos;
    }

    //Observadores
    public function getNombreAerolinea() {
        return $this->nombreAerolinea;
    }

    public function getColVuelos() {
        return $this->colVuelos;
    }

    //Modificadores
    public function setNombreAerolinea($nombreAerolinea) {
        $this->nombreAerolinea = $nombreAerolinea;
    }

    public function setColVuelos($colVuelos) {
        $this->colVuelos = $colVuelos;
    }

    //Metodos
    /*Metodo __toString() para mostrar la informacion de las Aerolineas */
    public function __toString() {
        return "Nombre de la Aerolinea: ".$this->getNombreAerolinea()."\n".
        "------VUELOS------\n".$this->mostrarColeccion($this->getColVuelos())."\n";
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

    /*Método configurarVuelo($objDestino, $objAvion, $arreglo) que recibe por parámetro un objeto
    Destino, un objeto avión y un arreglo asociativo con las siguientes claves (partida, hora de llegada al
    destino, importe). Este método es el encargado de crear un objeto Vuelo y dejarlo listo para ser
    comercializado. La cantidad de plazas disponibles del vuelo va a coincidir con la cantidad de plazas del
    avión y la colección de pasajeros que van a realizar el vuelo debe crearse vacía, El método retorna la
    instancia de vuelo creada. (Ayuda: puede utilizar como numero de vuelo el subíndice de la colección de
    vuelos de la aerolinea) */
    public function configurarVuelo($objDestino, $objAvion, $arreglo, $tipoVuelo) {
        //Claves del arreglo asociativo
        $horaPartida = $arreglo["partida"];
        $horaLlegada = $arreglo["hora de llegada al destino"];
        $importe = $arreglo["importe"];
        $numeroVuelo = count($this->getColVuelos());
        //La cantidad de plazas del Avion
        $plazasEjecutivas = $objAvion->getCantPlazasEjecutivas();
        $plazasEconomicas = $objAvion->getcantPlazasEconomicas();
        $coleccionPasajeros = array(); //Creo la coleccion de Pasajeros vacia
        //De acuerdo al tipo de vuelo...
        if($tipoVuelo == "internacional") {
            $vuelo = new Internacional($numeroVuelo, $plazasEjecutivas, $plazasEconomicas, $horaPartida, $horaLlegada, $objDestino, $objAvion, $importe, $coleccionPasajeros, 0);
        }else {
            $vuelo = new Nacional($numeroVuelo, $plazasEjecutivas, $plazasEconomicas, $horaPartida, $horaLlegada, $objDestino, $objAvion, $importe, $coleccionPasajeros, 0);
        }
        //Retorno la instancia $vuelo creada segun su tipo de vuelo
        return $vuelo;
    }

    /*Método venderVuelo($numeroVuelo, $objPasajero, $clase) que recibe por parámetro un número de vuelo, el objeto pasajero,
    la clase en la que desea viajar (ejecutiva/económica) y retorna el importe que debe abonar el pasajero si
    la operación pudo realizarse con éxito. Este método debe chequear las plazas disponibles, actualizarlas si la venta
    se realiza y vincular el pasajero a la colección de pasajeros del vuelo, */
    public function venderVuelo($numeroVuelo, $objPasajero, $clase) {
        $coleccionVuelos = $this->getColVuelos();
        $encontrado = false;
        $i = -1;
        $costo = -1; //En caso de que no se pueda vender el vuelo, retorna -1
        do { //Verifico si existe el numero de vuelo ingresado
            $i++;
            if ($coleccionVuelos[$i]->getNumeroVuelo() == $numeroVuelo) {
                $encontrado = true;
            }
        } while (!$encontrado && $i < count($coleccionVuelos));

        if ($encontrado) { //Si existe asigno el vuelo a una variable
            $objVuelo = $coleccionVuelos[$i];
            $pasajerosVuelo = $objVuelo->getColPasajeros();
            if ($clase == "economica") { //Si la clase es economica verifico que queden plazas disponibles
                $plazasEc = $objVuelo->getPlazasEconomicasDisponibles();
                if ($plazasEc > 0) { //Si hay plazas disponibles modifica la cantidad y agrega el pasajero a las colecciones
                    $plazasEc--;
                    $objVuelo->setPlazasEconomicasDisponibles($plazasEc);
                    $costo = $objVuelo->calcularImporte($objPasajero);
                    array_push($pasajerosVuelo, $objPasajero);
                }
            } else {
                $plazasEj = $objVuelo->getPlazasEjecutivasDisponibles();
                if ($plazasEj > 0) { //Si hay plazas disponibles modifica la cantidad y agrega el pasajero a las colecciones
                    $plazasEj--;
                    $objVuelo->setPlazasEjecutivasDisponibles($plazasEj);
                    $costo = $objVuelo->calcularImporte($objPasajero);
                    array_push($pasajerosVuelo, $objPasajero);
                }
            }
            //Actualizo las colecciones segun los cambios realizados
            $objVuelo->setColPasajeros($pasajerosVuelo);
            $coleccionVuelos[$i] = $objVuelo;
            $this->setColVuelos($coleccionVuelos);
        }
        //Retorno el importe que abona el pasajero
        return $costo;
    }
}