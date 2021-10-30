<?php
class Reloj {
    //Atributos
    private $horas;
    private $minutos;
    private $segundos;

    //Constructor
    public function __construct($horas, $minutos, $segundos) {
        $this -> horas = $horas;
        $this -> minutos = $minutos;
        $this -> segundos = $segundos;
    }

    //Observadoras
    public function getHoras() {
        return $this -> horas;
    }

    public function getMinutos() {
        return $this -> minutos;
    }

    public function getSegundos() {
        return $this -> segundos;
    }

    //Modificadoras
    public function setHoras($horas) {
        $this -> horas = $horas;
    }

    public function setMinutos($minutos) {
        $this -> minutos = $minutos;
    }

    public function setSegundos($segundos) {
        $this -> segundos = $segundos;
    }

    //Metodos
    /**
     * Inicializa en cero a los atributos
     */
    public function puestaACero() {
        $this -> horas = 0;
        $this -> minutos = 0;
        $this -> segundos = 0;
    }

    /**
     * Devuelve un incremento de las horas, minutos y segundos
     */
    public function incremento() {
        if ($this -> segundos == 59) {
            $this -> segundos = 0;
            if ($this -> minutos == 59) {
                $this -> minutos = 0;
                if ($this -> horas == 23) {
                    $this -> horas = 0;
                }else {
                    $this -> horas++;
                }
            }else {
                $this -> minutos++;
            }
        }else {
            $this -> segundos++;
        }
    }

    /**
     * Imprime la hora como un cronometro
     * @return $retorno
     */
    public function __toString() {
        if ($this -> horas <= 9) {
            $retorno = "0".$this -> horas.":";
        }else {
            $retorno = $this -> horas.":";
        }

        if ($this -> minutos <= 9) {
            $retorno .= "0".$this -> minutos.":";
        }else {
            $retorno .= $this -> minutos.":";
        }

        if ($this -> segundos <= 9) {
            $retorno .= "0".$this -> segundos;
        }else {
            $retorno .= $this -> segundos;
        }
        return $retorno;
    }
}