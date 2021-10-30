<?php

class Obra extends Funciones {
    //Atributos
    private $porcentajeIncremento;

    //Constructor
    public function __construct($nom, $pre, $horaIni, $time) {
        //Invoco el constructor de la clase Funciones
        parent::__construct($nom, $pre, $horaIni, $time);
        $this->porcentajeIncremento = 1.45; //45% incremento
    }

    //Observador
    public function getPorcentajeIncremento() {
        return $this->porcentajeIncremento;
    }

    //Modificador
    public function setPorcentajeIncremento($incremento) {
        $this->porcentajeIncremento = $incremento;
    }

    //Metodos
    /**
    * Metodo __toString() para mostrar los datos de la Obra
    * @return $cadena
    */
    public function __toString() {
        $cadena = parent::__toString();
        return $cadena."\nPorcentaje Incremento de la Obra: ".$this->getPorcentajeIncremento()." %\n";
    }

    /*
	* Metodo darCostos() que aplica un incremento sobre el precio de la Obra y retorna un costo
	* @return $costo
	*/
    public function darCostos(){
		/*variables: int $valor, float $costo*/
		$valor = parent::darCostos();
		$costo = $valor + ($valor * $this->getPorcentajeIncremento()); //45% incremento 
		return $costo;
	}
}