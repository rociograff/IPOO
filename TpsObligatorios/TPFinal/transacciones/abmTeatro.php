<?php
class abmTeatro{

    /** Constructor de la clase */
    public function __construct(){ }

    /**
     * Crea un nuevo teatro
     * @param string $nombre, $direccion
     * @return boolean $exito
     */
    public function crearTeatro($nombre,$direccion){
        $teatro = new Teatro();
        $teatro->cargarTeatro($nombre,$direccion);
        $exito = false;
        if($teatro->insertar()){
            $exito = true;
        }
        return $exito;
    }

    /**
     * Recupera un Teatro de la BD
     * @param int $id
     * @return object $teatro 
     */
    public function recuperarTeatro($id){
        $teatro = new Teatro();
        $exito = $teatro->buscar($id);
        $teatro->getColFunciones();
        if(!$exito){
            $teatro = null;
        }
        return $teatro;
    }

    /**
     * Elimina un teatro 
     * @param object $objTeatro
     * @return boolean $exito
     */
    public function eliminarTeatro($objTeatro){
        $exito=$objTeatro->eliminar();

        return $exito;
    }

    /**
     * Func. Modifica el nombre de un teatro
     * @param object $objTeatro
     * @param string $nombre
     * @return boolean $exito
     */
    public function modificarNombre($objTeatro, $nombre){
        $objTeatro->setNombre($nombre);
        $exito=$objTeatro->modificar();

        return $exito;
    }

    /**
     * Func. Modifica la direccion de un teatro
     * @param object $objTeatro
     * @param string $direccion
     * @return boolean $exito
     */
    public function modificarDireccion($objTeatro, $direccion){
        $objTeatro->setDireccion($direccion);
        $exito=$objTeatro->modificar();

        return $exito;
    }

    /**
     * Carga una nueva funcion  
     * @param array $datos
     * @return boolean $exito
     */
    public function cargarFuncion($datos){
        $exito = false;
        $tipo=strtolower($datos["tipo"]);

        $verificacion = $this->verificarDisponibilidad($datos["hsInicio"], $datos["duracion"], $datos["fecha"],$datos["teatro"]);
        if ($verificacion) {
            if($tipo=="cine"){
                $abm= new abmCine();
            }else if($tipo=="musical"){
                $abm=new abmMusical();
            }else{
                $abm=new abmObra();
            }
            $exito=$abm->crearFuncion($datos);
        }
        return $exito;
    }
  
    /**
     * Verifica que el horario de una funcion no se solape en una determinada fecha con los horarios de las funciones existentes en la coleccion
     * @param int $hsInicio
     * @param int $duracion
     * @param string $fecha
     * @param object $objTeatro
     * @return boolean $verificacion
     */
    private function verificarDisponibilidad($hsInicio,$duracion,$fecha,$objTeatro){
        $verificacion = true;
        $finFuncion = $hsInicio + $duracion;
        $i = 0;
        $funciones = $objTeatro->getColFunciones();
        while ($verificacion && $i < count($funciones)) {
            $inicio = $funciones[$i]->getHorarioInicio();
            $final = $inicio + $funciones[$i]->getDuracion();
            $fechaFunc = $funciones[$i]->getFecha();

            if ($fechaFunc == $fecha) {
                if (($hsInicio >= $inicio && $hsInicio <= $final) || ($finFuncion >= $inicio && $finFuncion <= $final)) {
                    $verificacion = false;
                }
            }
            $i++;
        }
        return $verificacion;
    }

    /**
     * Retorna el costo de usar el teatro(el costo se obtiene sumamdo los precios de cada tipo de actividad programada con sus respetivos incrementos)
     * @param int $mes
     * @param object $objTeatro
     * @return float
     */
    public function darCostoTeatro($mes,$objTeatro){
        $costo = 0;
        foreach ($objTeatro->getColFunciones() as $funcion) {
            $fechaEntero = strtotime($funcion->getfecha());
            $mesFuncion = date('m', $fechaEntero);

            if ($mesFuncion == $mes) {
                $costo += $funcion->getCostoSala();
            }
        }
        return $costo;
    }

    /**
     * Retorna un strin con la informacion de los teatros cargados
     * @return string $strTeatros
     */
    public function mostrarTeatros(){
        /**
         * @var object $objTeatro
         * @var array $colTeatro
         * @var string $strTeatros
         */
        $objTeatro = new Teatro();
        $colTeatro = $objTeatro->listar();
        $strTeatros = "Teatros: \n";
        foreach($colTeatro as $teatro){
            $strTeatros.="* \n".$teatro;
        }
        return $strTeatros;
    }
}
