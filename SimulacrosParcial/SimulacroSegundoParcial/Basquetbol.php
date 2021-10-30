<?php 
class Basquetbol extends Partido {
    //Atributos
    private $cantInfracciones;

    //Constructor
    public function __construct($idPartido, $equipo1, $equipo2, $fecha, $cantGolesEq1, $cantGolesEq2, $cantInfracciones) {
        //Invoco el constructor de la clase Partido
        parent::__construct($idPartido, $equipo1, $equipo2, $fecha, $cantGolesEq1, $cantGolesEq2);
        $this->cantInfracciones = $cantInfracciones;
    }

    //Observador
    public function getCantInfracciones() {
        return $this->cantInfracciones;
    }

    //Modificador
    public function setCantInfracciones($cantInfracciones) {
        $this->cantInfracciones = $cantInfracciones;
    }

    //Netodos 
    /*Metodo __toString() para mostrar los datos del partido de Basquetbol*/
    public function __toString() {
        return parent::__toString()."\n".
        "Cantidad de infracciones: ".$this->getCantInfracciones()."\n";
    }

    /*Metodo coeficientePartido() que si se trata de un partido de basquetbol se almacena la cantidad de 
    infracciones de manera tal que al coeficiente base se debe restar 0,75 * la cantidad de infracciones. */
    public function coeficientePartido() {
        //Redefiniendo el metodo coeficicientePartido() de la clase Partido 
        $coeficiente = parent::coeficientePartido();

        $coeficiente -= 0.75 * $this->getCantInfracciones();

        return $coeficiente;
    }
}