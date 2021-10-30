<?php
class Persona {
    //Atributos
	private $nombre;
	private $apellido;
	private $edad;
	private $fechaNac; // dd/mm/aaaa

	/**
     * Constructor
	 * @param String $n nombre de la persona
	 * @param String $a apellido de la persona
	 * @param Int $e edad de la persona
	 * @param String fecha de nacimiento de la forma dd/mm/aaaa
	 * */
	public function __construct($nom,$ape,$edad,$fechaNacimiento){
		$this->nombre =$nom;
		$this->apellido = $ape;
		$this->edad = $edad;
		$this->fechaNac = $fechaNacimiento;
	}

    //Observadoras
	/**
	 * Devuelve el nombre de la persona
	 * */
	public function getNombre(){
		return $this -> nombre;		
	}

	/**
	 * Devuelve el apellido de la persona 
	 * */
	public function getApellido(){
		return $this -> apellido;	
	}

	/**
	 * Devuelve le edad de la persona
	 * */
	public function getEdad(){
		return $this -> edad;
	}

	/**
	 * Devuelve la fecha de nacimiento de la persona
	 * */
	public function getFechaNacimiento(){
		return $this -> fechaNac;
	}

    //Modificadoras
	/**
	 * Para setear el nombre de la persona
	 * @param String $nombre nombre de la persona 
	 * */
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	
    /**
	 * Para setear el apellido de la persona
	 * @param String $apellido apellido de la persona 
	 * */
	public function setApellido($apellido){
		$this->apellido = $apellido;
	}
	
    /**
	 * Para setear la edad de la persona
	 * @param int $edad edad de la persona 
	 * */
	public function setEdad($edad){
		$this->edad = $edad;
	}

    /**
	 * Para setear la fecha de nacimiento de la persona
	 * @param String $fecha fecha de nacimiento de la persona 
	 * */
	public function setFechaNacimiento($fecha){
		$this->fechaNac = $fecha;
	}

    /**
	 * Imprime los datos de la Persona
	 * */
	public function __toString(){
		return ("Nombre: $this->nombre \n Apellido: $this->apellido \n Edad: $this->edad 
				\n Fecha De Nacimiento: $this->fechaNac ");
	}
}
