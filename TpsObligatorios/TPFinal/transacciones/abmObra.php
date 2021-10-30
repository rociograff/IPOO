<?php

class abmObra{

    /** Constructor de la clase */
    public function __construct(){}

    /**
     * Crea una nueva funcion
     * @param array $datos
     * @return boolean $exito
     */
    public function crearFuncion($datos){
        $obraT=new Obra();
        $exito=false;
        $obraT->cargar($datos);
        $this->darCosto($obraT);
        
        if($obraT->insertar()){
            $exito=true;
        }
        return $exito;
    }

    /**
     * Recupera una funcion de la BD
     * @param int $idFuncion
     * @return object $obra
     */
    public function recuperarObraTeatro($idFuncion){
        $obra = new Obra();
        $exito = $obra->buscar($idFuncion);
        if(!$exito){
            $obra = null;
        }
        return $obra;
    }

    /**
     * Elimina una obra de teatro
     * @param int $idObra
     * @return boolean $exito
     */
    public function eliminarObra($idObra){
        $obra = new Obra();
        $obra->Buscar($idObra);
        $exito = $obra->eliminar();

        return $exito;
    }

     /**
     * Calcula el costo de una obra de teatro
     * @param object $objObra
     */
    public function darCosto($objObra){
        $costo = $objObra->getPrecio();
        $costo = $costo + (($costo * 45) / 100);  //45% incremento

        $objObra->setCostoSala($costo);
    }

    /**
     * Retorna un string con la informacion de las obras de teatro
     * @return string $strFuncion
     */
    public function mostrarObras(){
        $objFuncion = new Obra();
        $colFuncion = $objFuncion->listar();
        $strFuncion = "";
        foreach($colFuncion as $funcion){
            $strFuncion.=$funcion."*--------------------------------*\n";
        }
        return $strFuncion;
    }
}