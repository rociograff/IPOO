<?php
class Cuadrado {
    //Atributos
	private $puntoA;
	private $puntoB;
	private $puntoC;
	private $puntoD;

	/**
	 * Constructor
	 * @param point $a
	 *        	va a ser de la forma ["x"=>x , "y"=>y]
	 * @param point $b
	 *        	va a ser de la forma ["x"=>x , "y"=>y]
	 * @param point $c
	 *        	va a ser de la forma ["x"=>x , "y"=>y]
	 * @param point $d
	 *        	va a ser de la forma ["x"=>x , "y"=>y]
	 *        	y ^
	 *        	| A........B
	 *        	| . .
	 *        	| . .
	 *        	| . .
	 *        	| C........D
	 *        	°---------------------->
	 *        	x
	 *        	
	 */
	public function __construct($a, $b, $c, $d) {
		$this->puntoA = $a;
		$this->puntoB = $b;
		$this->puntoC = $c;
		$this->puntoD = $d;
	}

    //Modificadoras
	public function setA($a) {
		$this->puntoA = $a;
	}

	public function setB($b) {
		$this->puntoB = $b;
	}

	public function setC($c) {
		$this->puntoC = $c;
	}

	public function setD($d) {
		$this->puntoD = $d;
	}

    //Observadoras
	public function getAx() {
		return $this->puntoA ["x"];
	}

	public function getBx() {
		return $this->puntoB ["x"];
	}

	public function getCx() {
		return $this->puntoC ["x"];
	}

	public function getDx() {
		return $this->puntoD ["x"];
	}

	public function getAy() {
		return $this->puntoA ["y"];
	}

	public function getBy() {
		return $this->puntoB ["y"];
	}

	public function getCy() {
		return $this->puntoC ["y"];
	}

	public function getDy() {
		return $this->puntoD ["y"];
	}

    //Metodos
	public function area() {
		$area = ($this -> getAy() - $this -> getCy()) * ($this -> getDx() - $this -> getCx());
		return $area;
	}

	/**
	 * desplaza al cuadrado en otras coordenadas
	 *
	 * @param point $otroPunto
	 *        	es un punto de la forma: ["x"=>x , "y"=>y]
	 *        	
	 */
	public function desplazar($otroPunto) {
		$aX = $this->getAx() + $otroPunto ["x"]-1;
		$aY = $this->getAy() + $otroPunto ["y"]-1;
		$a = array (
				"x" => $aX,
				"y" => $aY 
		);
		
		$bX = $this->getBx() + $otroPunto ["x"]-1;
		$bY = $this->getBy() + $otroPunto ["y"]-1;
		$b = array (
				"x" => $bX,
				"y" => $bY 
		);
		
		$c = array (
				"x" => $this->getCx() + $otroPunto ["x"]-1,
				"y" => $this->getCy() + $otroPunto ["y"]-1 
		);
		
		$dX = $this->getDx() + $otroPunto ["x"]-1;
		$dY = $this->getDy() + $otroPunto ["y"]-1;
		$d = array (
				"x" => $dX,
				"y" => $dY 
		);
		
		$this->setA($a);
		$this->setB($b);
		$this->setC($c);
		$this->setD($d);
	}

	public function aumentarTamanio($m) {
		$this->setA(array(
				"x" => $this -> getCx(),
				"y" => $this -> getAy() + $m 
		) );
		
		$this->setD(array(
				"x" => $this -> getDx() + $m,
				"y" => $this -> getCy() 
		) );
		$this->setB(array(
				"x" => $this -> getDx(),
				"y" => $this -> getAy() 
		) );
	}

	public function __toString() {
		$sale = "Cuadrado\n-----------\n" . "PuntoA x:" . $this -> getAx() . " y:" . $this -> getAy() . "\n" . "PuntoB x:" . $this -> getBx() . " y:" . $this->getBy () . " \n" . "PuntoC x:" . $this->getCx () . " y:" . $this->getCy () . "\n" . "PuntoD x:" . $this->getDx () . " y:" . $this->getDy () . " \n";
		return $sale;
	}
}