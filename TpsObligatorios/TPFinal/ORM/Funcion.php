<?php
class Funcion{
    //Atributos de clase
    private $idFuncion;
    private $nombre;
    private $horarioInicio;
    private $duracion;
    private $precio;
    private $costoSala;
    private $fecha;
    private $objTeatro;
    private $mensajeoperacion;

    /** Constructor de la clase */
    public function __construct(){
        $this->idFuncion = 0;
        $this->nombre = "";
        $this->horarioInicio = "";
        $this->duracion = 0;
        $this->precio = 0;
        $this->costoSala = 0;
        $this->fecha = 0;
        $this->objTeatro = null;
    }

    /** 
     * Carga una funcion 
     * @param array $datos
     */
    public function cargar($datos){
        $this->setNombre($datos["nombre"]);
        $this->setHorarioInicio($datos["hsInicio"]);
        $this->setDuracion($datos["duracion"]);
        $this->setPrecio($datos["precio"]);
        $this->setFecha($datos["fecha"]);
        $this->setObjTeatro($datos["teatro"]);
    }

    //Observadores
    public function getIdFuncion() {
        return $this->idFuncion;
    }
    
    public function getNombre(){
        return $this->nombre;
    }
    
    public function getHorarioInicio(){
        return $this->horarioInicio;
    }
    
    public function getDuracion(){
        return $this->duracion;
    }
    
    public function getPrecio(){
        return $this->precio;
    }
    
    public function getFecha(){
        return $this->fecha;
    }
    
    public function getCostoSala(){
        return $this->costoSala;
    }
    
    public function getObjTeatro(){
        return $this->objTeatro;
    }
    
    public function getMensajeOperacion(){
        return $this->mensajeoperacion;
    }
    
    //Modificadores
    public function setIdFuncion($idFuncion){
        $this->idFuncion = $idFuncion;
    }
    
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    
    public function setHorarioInicio($horarioInicio){
        $this->horarioInicio = $horarioInicio;
    }
    
    public function setDuracion($duracion){
        $this->duracion = $duracion;
    }
    
    public function setPrecio($precio){
        $this->precio = $precio;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    
    public function setCostoSala($costoSala){
        $this->costoSala = $costoSala;
    }
    
    public function setObjTeatro($objTeatro){
        $this->objTeatro = $objTeatro;
    }
    
    public function setMensajeOperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    /**
     * Retorna un string con la informacion de una funcion
     * @return string
     */
    public function __toString(){
        $inicioHs = intdiv(intval($this->getHorarioInicio()), 3600);
        $inicioMint = intdiv((intval($this->getHorarioInicio()) % 3600), 60);
        $duracionMint = intdiv(intval($this->getDuracion()), 60);

        return "ID Funcion: " . $this->getIdFuncion() . "\n" .
            "Nombre: " . $this->getNombre() . "\n" .
            "Fecha: " . $this->getFecha() . "\n" .
            "Horario de inicio: " . $inicioHs . ":" . $inicioMint . "\n" .
            "Duracion de funcion: " . $duracionMint . " minutos" . "\n" .
            "Precio: $" . $this->getPrecio() . "\n" .
            "Costo sala: $" . $this->getCostoSala() . "\n" .
            "Teatro al que pertenece: " . $this->getObjTeatro()->getnombre() . "\n";
    }

    /*****************************METODOS DE LA BASE DE DATOS******************************/
    /**
     * Recupera los datos de una funcion por su id
     * @param int 
     * @return true en caso de encontrar los datos, false en caso contrario 
     */
    public function Buscar($idF){
        $base = new BaseDatos();
        $consultaPersona = "Select * from funcion where idFuncion=" . $idF;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaPersona)) {
                if ($row2 = $base->Registro()) { //Verifica que el arreglo no es vacio 
                    $this->setIdFuncion($idF);
                    $this->setNombre($row2['nombre']);
                    $this->setHorarioInicio($row2['horarioInicio']);
                    $this->setDuracion($row2['duracion']);
                    $this->setPrecio($row2['precio']);
                    $this->setCostoSala($row2['costoSala']);
                    $this->setFecha($row2['fecha']);

                    $idTeatro = $row2['idTeatro'];
                    $teatro = new Teatro();
                    $teatro->Buscar($idTeatro);

                    $this->setObjTeatro($teatro);
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
     * Retorna un array de funciones que cumplan con una determinada condicion
     * @param string 
     * @return array
     */
    public function listar($condicion = ""){
        $arregloFuncion = null;
        $base = new BaseDatos();
        $consultaFuncion = "Select * from funcion ";
        if ($condicion != "") {
            $consultaFuncion = $consultaFuncion . ' where ' . $condicion;
        }
        $consultaFuncion .= " order by idFuncion ";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaFuncion)) {
                $arregloFuncion = array();
                while ($row2 = $base->Registro()) {
                    $funcion = new Funcion();
                    $funcion->Buscar($row2['idFuncion']);
                    array_push($arregloFuncion, $funcion);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arregloFuncion;
    }

      /**
     * Inserta una funcion en la BD
     * @return boolean 
     */
    public function insertar(){
        $base = new BaseDatos();
        $resp = false;
        $consultaInsertar = "INSERT INTO funcion(nombre, horarioInicio, duracion, precio, costoSala, fecha, idTeatro) 
				VALUES (" . "'" . $this->getNombre() . "','" . $this->getHorarioInicio() . "','" . $this->getDuracion() . "','"
            . $this->getPrecio() . "','" . $this->getCostoSala() . "','" . $this->getFecha() . "','" . $this->getObjTeatro()->getIdTeatro() . "')";

        if ($base->Iniciar()) {
            if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
                $this->setIdFuncion($id);
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
        $consultaModifica = "UPDATE funcion SET nombre=" . "'" . $this->getNombre() . "',horarioInicio=" . $this->getHorarioInicio() . "
                           ,duracion=" . $this->getDuracion() . ",precio=" . $this->getPrecio() . ",costoSala=" . $this->getCostoSala() . "
                           ,fecha='" . $this->getFecha() . "',idTeatro='" . $this->getObjTeatro()->getIdTeatro() . "' WHERE idFuncion=" .  $this->getIdFuncion();
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
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM funcion WHERE idFuncion="  . $this->getIdFuncion();
            if ($this->getIdFuncion() != 0) {
                if ($base->Ejecutar($consultaBorra)) {
                    $resp =  true;
                } else {
                    $this->setmensajeoperacion($base->getError());
                }
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }
}