<?php
class abmCine{
    /** Constructor de la clase */
    public function __construct(){}

    /**
     * Crea una nueva funcion de cine y la inserta en la BD
     * @param array $datos
     * @return boolean $exito
     */
    public function crearFuncion($datos){
        $cine = new Cine();
        $exito = false;
        $cine->cargar($datos);
        $this->darCosto($cine);

        if ($cine->insertar()) {
            $exito = true;
        }
        return $exito;
    }

    /**
     * Recupera una funcion de cine de la BD
     * @param int $idCine
     * @return object $cine
     */
    public function recuperarCine($idCine){
        $cine = new Cine();
        $exito = $cine->buscar($idCine);
        if (!$exito) {
            $cine = null;
        }
        return $cine;
    }


    /**
     * Elimina un funcion de cine
     * @param object $idCine
     * @return boolean $exito
     */
    public function eliminarCine($idCine){
        $cine = new Cine();
        $cine->Buscar($idCine);
        $exito = $cine->eliminar();

        return $exito;
    }

    /**
     * Calcula el costo de una funcion de cine
     * @param object $objCine
     * @return float $costo
     */
    public function darCosto($objCine){
        $costo = $objCine->getPrecio();
        $costo = $costo + (($costo * 65) / 100);  //65% incremento

        $objCine->setCostoSala($costo);
    }

    /**
     * Retorna un string con la informacion del la funciones
     * @return string $strFuncion
     */
    public function mostrarCines(){
        $objFuncion = new Cine();
        $colFuncion = $objFuncion->listar();
        $strFuncion = "";
        foreach ($colFuncion as $funcion) {
            $strFuncion .= $funcion . "*--------------------------------*\n";
        }
        return $strFuncion;
    }
}