<?php

class Musical extends Funcion{
    //Atributos de clase
    private $director;
    private $personasEnEscena;

    /** Constructor de la clase */
    public function __construct(){
        parent::__construct();
        $this->director = "";
        $this->personasEnEscena = 0;
    }

    /** 
	 * Carga un musical
	 * @param array $datos
	 */
    public function cargar($datos){
        parent::cargar($datos);
        $this->setDirector($datos["director"]);
        $this->setPersonasEnEscena($datos["personasEnEscena"]);
    }

    //Observadores
    public function getDirector(){
        return $this->director;
    }
    
    public function getPersonasEnEscena(){
        return $this->personasEnEscena;
    }

    //Modificadores
    public function setDirector($director){
        $this->director = $director;
    }
    
    public function setPersonasEnEscena($personasEnEscena){
        $this->personasEnEscena = $personasEnEscena;
    }

    /** Retorna un string con la informacion del Musical
     * @return string
     */
    public function __toString(){
        return "Musical"."\n".parent::__toString() . "Director: " . $this->getDirector() . "\n" .
            "Personas en escena: " . $this->getPersonasEnEscena() . "\n";
    }

	/*****************************METODOS DE LA BASE DE DATOS******************************/
    /**
	 * Recupera los datos de un Musical por su id
	 * @param int 
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($id){
		$base=new BaseDatos();
		$consulta="SELECT * FROM musical WHERE idFuncion=".$id;
		$resp= false;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){
				if($row2=$base->Registro()){	
				    parent::Buscar($id);
				    $this->setDirector($row2['director']);
                    $this->setPersonasEnEscena($row2['personasEnEscena']);
					$resp= true;
				}				
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 }		
		 return $resp;
	}	
    
	/** 
	 * Retorna un string de musicales
	 * @param string 
	 * @return array
	 */
    public function listar($condicion=""){
	    $arreglo = null;
		$base=new BaseDatos();

		$consulta="SELECT * FROM musical INNER JOIN funcion ON musical.idFuncion=funcion.idFuncion ";
		if ($condicion!=""){
		    $consulta=$consulta.' where '.$condicion;
		}
		$consulta.=" ORDER BY musical.idFuncion ";
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo= array();
				while($row2=$base->Registro()){
					$obj=new Musical();
					$obj->Buscar($row2['idFuncion']);
					array_push($arreglo,$obj);
				}
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 }	
		 return $arreglo;
	}

	/**
     * Inserta una funcion en la BD
     * @return boolean 
     */
    public function insertar(){
		$base=new BaseDatos();
		$resp= false;

		if(parent::insertar()){
		    $consultaInsertar="INSERT INTO musical(idFuncion, director, personasEnEscena)
				VALUES (".parent::getIdFuncion().",'".$this->getDirector()."',".$this->getPersonasEnEscena().")";
		    if($base->Iniciar()){
		        if($base->Ejecutar($consultaInsertar)){
		            $resp=  true;
		        }	else {
		            $this->setmensajeoperacion($base->getError());
		        }
		    } else {
		        $this->setmensajeoperacion($base->getError());
		    }
		 }
		return $resp;
	}

	/**
     * Realiza una modificacion de un registro de la BD
     * @return boolean 
     */
    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
	    if(parent::modificar()){
	        $consultaModifica="UPDATE musical SET director='".$this->getDirector()."',"."personasEnEscena='".$this->getPersonasEnEscena()."' WHERE idFuncion=". parent::getIdFuncion();
	        if($base->Iniciar()){
	            if($base->Ejecutar($consultaModifica)){
	                $resp=  true;
	            }else{
	                $this->setmensajeoperacion($base->getError());
	            }
	        }else{
	            $this->setmensajeoperacion($base->getError());
	        }
	    }
		return $resp;
	}

	/**
     * Elimina un registro de la BD
     * @return boolean 
     */
    public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM musical WHERE idFuncion=".parent::getIdFuncion();
				if($base->Ejecutar($consultaBorra)){
				    if(parent::eliminar()){
				        $resp=  true;
				    }
				}else{
						$this->setmensajeoperacion($base->getError());	
				}
		}else{
				$this->setmensajeoperacion($base->getError());
		}
		return $resp; 
	}

}