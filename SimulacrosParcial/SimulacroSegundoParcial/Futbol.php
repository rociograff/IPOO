<?php 
class Futbol extends Partido {
    //Constructor
    public function __construct($idPartido, $equipo1, $equipo2, $fecha, $cantGolesEq1, $cantGolesEq2) {
        //Invoco el constructor de la clase Partido 
        parent::__construct($idPartido, $equipo1, $equipo2, $fecha, $cantGolesEq1, $cantGolesEq2);
    }

    //Metodos
    /*Metodo coeficientePartido() que si se trata de un partido de fútbol, el coeficiente también
     tiene en cuenta la categoría de los jugadores del equipo.*/
    public function coeficientePartido() {
        //Redefiniendo el metodo coeficientePartido() de la clase Partido
        $coeficiente = parent::coeficientePartido();

        //Teniendo en cuenta la categoria de los jugadores
        switch($this->getEquipo1()->getCategoriaEquipo()) { 
            /*Se detalla el incremento del coeficiente base si es un partido de fútbol, donde para cada tipo de
             categoría corresponden los siguientes valores: */
            case "menores":
                $coeficiente += $coeficiente * 0.11; //0.11 es el coeficiente de la categoria 'Menores'
                break;
            case "juveniles":
                $coeficiente += $coeficiente * 0.17; //0.17 es el coeficiente de la categoria 'Juveniles'
                break;
            case "mayores":
                $coeficiente += $coeficiente * 0.23; //0.23 es el coeficiente de la categoria 'Mayores'
                break;
        }

        return $coeficiente;
    }
}