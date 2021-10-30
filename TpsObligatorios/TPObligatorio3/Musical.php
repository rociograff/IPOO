<?php

class Musical extends Funciones {
    //Atributos
    private $director;
    private $cantPersonasEscena;
    private $porcentajeIncremento;

    //Constructor
    public function __construct($nom, $pre, $horaIni, $time, $direc, $personasEscena) {
        //invoco el constructor de la clase Funciones
        parent::__construct($nom, $pre, $horaIni, $time);
        $this->director = $direc;
        $this->cantPersonas = $personasEscena;
        $this->porcentajeIncremento = 1.12;  //12% incremento
    }

    //Observadores
    public function getDirector() {
        return $this->director;
    }

    public function getCantPersonasEscena() {
        return $this->cantPersonasEscena;
    }

    public function getPorcentajeIncremento() {
        return $this->porcentajeIncremento;
    }

    //Modificadores
    public function setDirector($direc) {
        $this->director = $direc;
    }

    public function setCantPersonasEscena($personasEscena) {
        $this->cantPersonasEscena = $personasEscena;
    }

    public function setPorcentajeIncremento($incremento) {
        $this->porcentajeIncremento = $incremento;
    }

    //Metodos
    /**
    * Metodo __toString() para mostrar los datos del Musical
    * @return $cadena
    */
    public function __toString() {
        $cadena = parent::__toString();
        return $cadena."\nDirector del musical: ".$this->getDirector()."\n".
        "Cantidad de personas en escena: ".$this->getCantPersonasEscena()."\n".
        "Porcentaje Incremento del Musical: ".$this->getPorcentajeIncremento()." %\n";
    }

    /*
	* Metodo darCostos() que aplica un incremento sobre el precio del Musical y retorna un costo
	* @return int $costo
	*/
    public function darCostos(){
		/*variables: int $valor, float $costo*/
		$valor = parent::darCostos();
		$costo = $valor + ($valor * $this->getPorcentajeIncremento());  //12% incremento
		return $costo;
	}
}