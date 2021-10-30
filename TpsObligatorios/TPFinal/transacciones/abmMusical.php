<?php
class abmMusical{
    /** Constructor de la clase */
    public function __construct(){}

    /**
     * Crea una nueva funcion
     * @param array $datos
     * @return boolean $exito
     */
    public function crearFuncion($datos){
        $musical = new Musical();
        $exito = false;
        $musical->cargar($datos);
        $this->darCosto($musical);
        
        if($musical->insertar()){
            $exito = true;
        }
        return $exito;
    }

    /**
     * Recupera una funcion de la BD
     * @param int $idFuncion
     * @return object $musical
     */
    public function recuperarMusical($idFuncion){
        $musical = new Musical();
        $exito = $musical->buscar($idFuncion);
        if(!$exito){
            $musical = null;
        }
        return $musical;
    }


    /**
     * Elimina un musical
     * @param object $idMusical
     * @return boolean $exito
     */
    public function eliminarMusical($idMusical){
        $musical = new Musical();
        $musical->Buscar($idMusical);
        $exito = $musical->eliminar();

        return $exito;
    }

     /**
     * Calcula el costo de un Musical
     */
    public function darCosto($objMusical){
        $costo = $objMusical->getPrecio();
        $costo = $costo + (($costo * 12) / 100);  //12% incremento

        $objMusical->setCostoSala($costo);
    }

    /**
     * Retorna un string con la informacion de los musicales 
     * @return string $strFuncion
     */
    public function mostrarMusicales(){
        $objFuncion = new Musical();
        $colFuncion = $objFuncion->listar();
        $strFuncion = "";
        foreach($colFuncion as $funcion){
            $strFuncion.=$funcion."*--------------------------------*\n";
        }
        return $strFuncion;
    }
}