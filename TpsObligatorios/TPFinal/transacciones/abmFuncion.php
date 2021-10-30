<?php
class abmFuncion{

    /** Constructor de la clase */
    public function __construct(){}

    /**
     * Crea una nueva funcion
     * @param array $datos
     * @return boolean $exito
     */
    public function crearFuncion($datos){
        $funcion=new Funcion();
        $exito=false;
        $funcion->cargar($datos);
        $this->darCosto($funcion);
        
        if($funcion->insertar()){
            $exito=true;
        }
        return $exito;
    }

    /**
     * Recupera una funcion de la BD
     * @param int $idFuncion
     * @return object $funcion
     */
    public function recuperarFuncion($idFuncion){
        $funcion=new Funcion();
        $exito=$funcion->buscar($idFuncion);
        if(!$exito){
            $funcion=null;
        }
        return $funcion;
    }

    /**
     * Cambia el nombre de una funcion 
     * @param object $objFuncion
     * @param string $nombre
     * @return boolean $exito
     */
    public function modificarNombre($objFuncion, $nombre){
        $objFuncion->setNombre($nombre);
        $exito=$objFuncion->modificar();

        return $exito;
    }

    /**
     * Cabia el precio de una funcion
     * @param object $objFuncion
     * @param float $precio
     * @return boolean $exito
     */
    public function modificarPrecio($objFuncion, $precio){
        $objFuncion->setPrecio($precio);
        $exito=$objFuncion->modificar();

        return $exito;
    }

    /**
     * Elimina una funcion
     * @param object $objFuncion
     * @return boolean $exito
     */
    public function eliminarFuncion($objFuncion){
        $exito=$objFuncion->eliminar();

        return $exito;
    }

    /**
     * Calcula el costo de la funcion
     * @return float $costo
     */
    public function darCosto($objFuncion){
        $costo = $objFuncion->getPrecio();

        return $costo;
    }

    /**
     * Retorna un string con la informacion de las funciones cargadas
     * @return string $strFuncion
     */
    public function mostrarFunciones(){
        $objFuncion=new Funcion();
        $colFuncion=$objFuncion->listar();
        $strFuncion="Funciones: \n";
        foreach($colFuncion as $funcion){
            $strFuncion.="ID: ".$funcion->getIdFuncion()." "."Nombre: ".$funcion->getNombre()." "
            ."Precio $".$funcion->getPrecio()." idTeatro: ".$funcion->getObjTeatro()->getIdTeatro()."\n";
        }
        return $strFuncion;
    }
}