<?php
class Disquera{
    //Atributos
    private $hora_desde;
    private $hora_hasta;
    private $estado;
    private $direccion;
    
    //Constructor
    public function __construct($horaDesde, $horaHasta, $estado , $dire, $persona){
        $this -> hora_desde = $horaDesde;
        $this -> hora_hasta = $horaHasta;
        $this -> estado = $estado;
        $this -> direccion = $dire;
        $this -> objPersona = $persona;
    }
    
    //Observadores
    public function getHoraDesde() {
        return $this -> hora_desde;
    }

    public function getHoraHasta() {
        return $this -> hora_hasta;
    }

    public function getEstado() {
        return $this -> estado;
    }

    public function getDireccion() {
        return $this -> direccion;
    }

    public function getObjPersona() {
        return $this -> objPersona;
    }

    //Modificadores
    public function setHoraDesde($horaDesde) { 
        $this -> hora_desde = $horaDesde;
    }

    public function setHoraHasta($horaHasta) { 
        $this -> hora_hasta = $horaHasta;
    }

    public function setEstado($estado) {
        $this -> estado = $estado;
    }

    public function setDireccion($dire) {
        $this -> direccion = $dire;
    }

    public function setObjPersona($persona) {
        $this -> objPersona = $persona;
    }
    
    /**
     * Dada una hora y minutos retorna true si la tienda debe
     *  encontrarse abierta en ese horario y false en caso contrario.
     */
    public function dentroHorarioAtencion($hora) { 
        $retorno = false;
        if(($hora >= $this -> getHoraDesde()) && ($hora <= $this -> getHoraHasta())) {  
            $retorno = true;
        }
        return $retorno;
    }
    
    /**
     * Dada una hora y minutos corrobora que se encuentra dentro del horario de atención
     *  y cambia el estado de la disquera solo si es un horario válido para su apertura.
     */
    public function abrirDisquera($hora) {
        if($hora = $this -> setHoraDesde($hora)) {
            $this -> getEstado("Abierto");
        }
    }
    
    /**
     * Dada una hora y minutos corrobora que se encuentra fuera del 
     * horario de atención y cambia el estado de la disquera solo si es un horario válido para su cierre.
     */
    public function cerrarDisquera($hora){
        if($hora = $this -> setHoraHasta($hora)) {
            $this -> getEstado("Cerrado");
        }
    }
    
    //Método _ _toString() para que retorne la información de los atributos de la clase.
    public function __toString() {
        return "La disquera abre desde las ".$this->getHoraDesde()." hs y cierra ".$this->getHoraHasta()." hs\n".
                "Actualmente se encuentra ".$this->getEstado()."\n"."Ubicada en la calle ".$this->getDireccion()."\n".
                "y pertenece a ".$this->getObjPersona()."\n";
    }
} 