<?php
class Persona {
    //Atributos
	private $nombre;
	private $apellido;
	private $tipoDocumento;
	private $numeroDocumento;

	/**
     * Constructor
	 * @param String $nombre de la persona
	 * @param String $apellido de la persona
	 * @param String $tipoDocumento de documento de la persona
	 * @param int $numeroDocumento de la persona
	 * */
	public function __construct($nom, $ape, $tipo, $dni){
		$this -> nombre =$nom;
		$this -> apellido = $ape;
		$this -> tipoDocumento = $tipo;
		$this -> numeroDocumento = $dni;
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
	 * Devuelve el tipo de documento de la persona
	 * */
	public function getTipoDocumento(){
		return $this -> tipoDocumento;
	}

	/**
	 * Devuelve el numero de documento de la persona
	 * */
	public function getNumeroDocumento(){
		return $this -> numeroDocumento;
	}

    //Modificadoras
	/**
	 * Para setear el nombre de la persona
	 * @param String $nombre nombre de la persona 
	 * */
	public function setNombre($nom){
		$this -> nombre = $nom;
	}
	
    /**
	 * Para setear el apellido de la persona
	 * @param String $apellido apellido de la persona 
	 * */
	public function setApellido($ape){
		$this -> apellido = $ape;
	}
	
    /**
	 * Para setear el tipo de documento de la persona
	 * @param int $tipo tipo de documento de la persona 
	 * */
	public function setTipoDocumento($tipo){
		$this -> tipoDocumento = $tipo;
	}

    /**
	 * Para setear el numero de documento de la persona
	 * @param String $numero numero de documento de la persona 
	 * */
	public function setNumeroDocumento($dni){
		$this -> numeroDocumento = $dni;
	}

    /**
	 * Imprime los datos de la Persona
	 * */
	public function __toString(){
		return "\n Nombre: ". $this -> getNombre().
		 "\n Apellido: ". $this -> getApellido(). 
		 "\n Tipo de documento: ". $this -> getTipoDocumento(). 
		 "\n Numero de documento: ". $this -> getNumeroDocumento();
	}
}
