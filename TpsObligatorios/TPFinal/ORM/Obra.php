<?php

class Obra extends Funcion{
    /** Constructor de la clase  */
    public function __construct(){
        parent::__construct();
    }

	/** 
	 * Carga una obra de teatro
	 * @param array $datos
	 */
    public function cargar($datos){
        parent::cargar($datos); 
    }

    /**
     * Retorna un string con la informacion de la obra de teatro
     * @return string
     */
    public function __toString(){
        return "Obra de teatro"."\n".parent::__toString();
    }

	/*****************************METODOS DE LA BASE DE DATOS******************************/
    /**
	 * Recupera los datos de una obra de teatro por su id
	 * @param int 
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($id){
		$base = new BaseDatos();
		$consulta = "SELECT * FROM obra WHERE idFuncion=".$id;
		$resp = false;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){
				if($row2 = $base->Registro()){	
				    parent::Buscar($id);
					$resp = true;
				}				
		 	}else {
		 		$this->setmensajeoperacion($base->getError());
			}
		}else {
		 	$this->setmensajeoperacion($base->getError());
		}		
		return $resp;
	}

	/**
	 * Retorna un string con obras de teatros
	 * @param string 
	 * @return array
	 */
    public function listar($condicion=""){
	    $arreglo = null;
		$base = new BaseDatos();

		$consulta="SELECT * FROM obra INNER JOIN funcion ON obra.idFuncion=funcion.idFuncion ";
		if ($condicion!=""){
		    $consulta = $consulta.' where '.$condicion;
		}
		$consulta.=" ORDER BY obra.idFuncion ";
		
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo = array();
				while($row2 = $base->Registro()){
					$obj = new Obra();
					$obj->Buscar($row2['idFuncion']);
					array_push($arreglo,$obj);
				}
		 	}else {
		 		$this->setmensajeoperacion($base->getError());
			}
		}else {
		 	$this->setmensajeoperacion($base->getError());
		}	
		return $arreglo;
	}

	/**
     * Inserta una funcion en la BD
     * @return boolean 
     */
    public function insertar(){
		$base = new BaseDatos();
		$resp = false;

		if(parent::insertar()){
		    $consultaInsertar = "INSERT INTO Obra(idFuncion)
				VALUES (".parent::getIdFuncion().")";
		    if($base->Iniciar()){
		        if($base->Ejecutar($consultaInsertar)){
		            $resp = true;
		        }else {
		            $this->setmensajeoperacion($base->getError());
		        }
		    }else {
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
	    $resp = false; 
	    $base = new BaseDatos();
	    if(parent::modificar()){
	        $consultaModifica = "UPDATE obra SET idFuncion='".parent::getIdFuncion()."' WHERE idFuncion=". parent::getIdFuncion();
	        if($base->Iniciar()){
	            if($base->Ejecutar($consultaModifica)){
	                $resp = true;
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
		$base = new BaseDatos();
		$resp = false;
		if($base->Iniciar()){
			$consultaBorra = "DELETE FROM obra WHERE idFuncion=".parent::getIdFuncion();
			if($base->Ejecutar($consultaBorra)){
				if(parent::eliminar()){
				    $resp = true;
				}
			}else{
				$this->setmensajeoperacion($base->getError());	
			}
		}else {
			$this->setmensajeoperacion($base->getError());
		}
		return $resp; 
	}
}