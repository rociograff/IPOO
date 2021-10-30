<?php

class Cine extends Funciones {
    //Atributos
    private $genero;
    private $paisOrigen;
    private $porcentajeIncremento;

    //Constructor
    public function __construct($nom, $pre, $horaIni, $time, $gen, $pais) {
        //Invoco el constructor de la clase Funciones
        parent::__construct($nom, $pre, $horaIni, $time);
        $this->genero = $gen;
        $this->paisOrigen = $pais;
        $this->porcentajeIncremento = 1.65;  //65% incremento
    }

    //Observadores
    public function getGenero() {
        return $this->genero;
    }

    public function getPaisOrigen() {
        return $this->paisOrigen;
    }

    public function getPorcentajeIncremento() {
        return $this->porcentajeIncremento;
    }

    //Modificadores
    public function setGenero($gen) {
        $this->genero = $gen;
    }

    public function setPaisOrigen($pais) {
        $this->paisOrigen = $pais;
    }

    public function setPorcentajeIncremento($incremento) {
        $this->porcentajeIncremento = $incremento;
    }

    //Metodos
    /**
    * Metodo __toString() para mostrar los datos del Cine
    * @return $cadena
    */
    public function __toString() {
        $cadena = parent::__toString();
        return $cadena."\nGenero de la pelicula: ".$this->getGenero()."\n".
        "Pais de origen de la pelicula: ".$this->getPaisOrigen()."\n".
        "Porcentaje Incremento del Cine: ".$this->getPorcentajeIncremento()." %\n";
    }

    /*
	* Metodo darCostos() que aplica un incremento sobre el precio de la pelicula en el Cine y retorna un costo
	* @return int $costo
	*/
    public function darCostos(){
		/*variables: int $valor, float $costo*/
		$valor = parent::darCostos();
		$costo = $valor + ($valor * $this->getPorcentajeIncremento());  //65% incremento
		return $costo;
	}
}