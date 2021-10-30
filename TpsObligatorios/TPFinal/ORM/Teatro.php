<?php
class Teatro{
    //Atributos de clase
    private $idTeatro;
    private $nombre;
    private $direccion;
    private $colFunciones;
    private $mensajeoperacion;

    /** Constructor de la clase  */
    public function __construct(){
        $this->idTeatro = 0;
        $this->nombre = "";
        $this->direccion = "";
        $this->colFunciones = array();
    }

    /**
     * Carga los valores del teatro 
     * @param string $nombre
     * @param string $direccion
     */
    public function cargarTeatro($nombre, $direccion){
        $this->setNombre($nombre);
        $this->setDireccion($direccion);
    }

    //Observadores
    public function getIdTeatro(){
        return $this->idTeatro;
    }
    
    public function getNombre(){
        return $this->nombre;
    }
    
    public function getDireccion(){
        return $this->direccion;
    }
    
    /**
     * Utilizo la coleccion de funciones para no setear continuamente las funciones nuevas
     */
    public function getColFunciones(){
        if(count($this->colFunciones)==0){
            $nuevoCine = new Cine();
            $nuevoMusical = new Musical();
            $nuevaObra = new Obra();
            
            $condicion = "idTeatro=".$this->getIdTeatro();
            $colCine = $nuevoCine->listar($condicion);
            $colMusical = $nuevoMusical->listar($condicion);
            $colObra = $nuevaObra->listar($condicion);
            $colFunciones = array_merge($colCine,$colMusical,$colObra);
            $this->setColFunciones($colFunciones);
        }
        return $this->colFunciones;
    }
    
    public function getMensajeOperacion(){
        return $this->mensajeoperacion;
    }

    //Modificadores
    public function setIdTeatro($idTeatro){
        $this->idTeatro=$idTeatro;
    }
    
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    
    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }
    
    public function setColFunciones($colFunciones){
        $this->colFunciones = $colFunciones;
    }

    public function setMensajeOperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    /**
     * Retorna un string con la informacion de un teatro
     * @return string 
     */
    public function __toString(){
        $mensaje = "-ID Teatro: ".$this->getIdTeatro()."\n".
        "-Nombre del Teatro: " . $this->getNombre() . "\n" .
        "-Direccion del Teatro: " . $this->getDireccion() . "\n".
        "----Funciones----\n".$this->mostrarColeccion($this->getColFunciones());
        return $mensaje;
    }

    /**
    * Metodo para mostrar colecciones
    * @return $arreglo
    */
    private function mostrarColeccion($coleccion) {
        //Array Funciones $arreglo
        $arreglo = "";
        foreach ($coleccion as $obj) {
            $arreglo .= $obj . "\n";
            $arreglo .= "--------------------------\n";
        }
        return $arreglo;
    }

    /*****************************METODOS DE LA BASE DE DATOS******************************/
    /**
	 * Recupera los datos de un teatro por su nombre
	 * @param string
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */	
    public function Buscar($idT){
        $base = new BaseDatos();
        $consultaTeatro = "SELECT * FROM teatro WHERE idTeatro=" . "'" . $idT . "'";
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaTeatro)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdTeatro($row2['idTeatro']);
                    $this->setNombre($row2['nombre']);
                    $this->setDireccion($row2['direccion']);                    
                    $resp = true;
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    /**
     * Retorna un string con la info de los teatros cargados
     * @param string 
     * @return string 
     */
    public function listar($condicion = ""){
        $arregloTeatro = null;
        $base = new BaseDatos();
        $consultaTeatro = "SELECT * FROM teatro ";
        if ($condicion != "") {
            $consultaTeatro = $consultaTeatro . ' where ' . $condicion;
        }
        $consultaTeatro .= " ORDER BY idTeatro ";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaTeatro)) {
                $arregloTeatro = array();
                while ($row2 = $base->Registro()) {
                    $idT=$row2['idTeatro'];
                    $nombre = $row2['nombre'];
                    $direccion = $row2['direccion'];

                    $teatro = new Teatro();
                    $teatro->cargarTeatro($nombre, $direccion);
                    $teatro->setIdTeatro($idT);
                    array_push($arregloTeatro,$teatro);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arregloTeatro;
    }

    /**
     * Inserta un teatro en la BD
     * @return boolean 
     */
    public function insertar(){
        $base = new BaseDatos();
        $resp = false;
        $consultaInsertar = "INSERT INTO teatro(nombre, direccion) VALUES (" . "'" . $this->getNombre() . "'" . ",'" . $this->getDireccion() . "')";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaInsertar)) {
                $resp =  true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
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
        $consultaModifica = "UPDATE teatro SET idTeatro=".$this->getIdTeatro(). ",nombre=" . "'" . $this->getNombre() . "'" . ",direccion=" . "'" . $this->getDireccion() . "'" . " WHERE idTeatro=" . "'" . $this->getIdTeatro() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModifica)) {
                $resp =  true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    /**
     * Elimina un registro de la BD
     * @return boolean 
     */
    public function eliminar(){
        $base = new BaseDatos();
        $resp = true;
        $i = 0;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM teatro WHERE idTeatro=" . "'" . $this->getIdTeatro() . "'";
            while ($resp && $i < count($this->getColFunciones())) {
                $resp = $this->getColFunciones()[$i]->eliminar();
                $i++;
            }
            if ($base->Ejecutar($consultaBorra)) {
                $resp =  true;
            } else {
                $this->setmensajeoperacion($base->getError());
                $resp = false;
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }
}