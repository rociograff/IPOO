<?php
class fecha {
    //Atributos
    private $dia;
    private $mes;
    private $anio;
    private $numeroMes;

    //Constructor
    public function __construct($d, $m, $a) {
        $this->dia = $d;
        $this->mes = $m;
        $this->anio = $a;
        $this->numeroMes = array(
            1 => "Enero",
            2 => "Febrero",
            3 => "Marzo",
            4 => "Abril",
            5 => "Mayo",
            6 => "Junio",
            7 => "Julio",
            8 => "Agosto",
            9 => "Septiembre",
            10 => "Octubre",
            11 => "Noviembre",
            12 => "Diciembre");
    }

    //Observadoras
    public function getDia() {
        return $this->dia;
    }

    public function getMes() {
        return $this->mes;
    }

    public function getAnio() {
        return $this->anio;
    }

    //Modificadoras
    public function setDia($d) {
        $this->dia = $d;
    }

    public function setMes($m) {
        $this->mes = $m;
    }

    public function setAnio($a) {
        $this->anio = $a;
    }

    //Metodos
    public function bisiesto() {
        $x = $this->getAnio();
        $a = false;
        if ($x % 4 == 0 && $x % 100 != 0) {
            $a = true;
        } elseif ($x % 400 == 0) {
            $a = true;
        }
        return $a;
    }

    private function sumarDiasA31($d) {
        if (($this->getDia() + $d) > 31) {
            $this->incrementarMes(1);
            $this->setDia(1);
        } else {
            $incDia = $this->getDia() + $d;
            $this->setDia($incDia);
        }
    }

    private function sumarDiasA30($d) {
        if (($this->getDia() + $d) > 30) {
            $this->incrementarMes(1);
            $this->setDia(1);
        } else {
            $incDia = $this->getDia() + $d;
            $this->setDia($incDia);
        }
    }

    private function sumarDiasAFebrero($d) {
        if ($this->bisiesto()) {
            if (($this->getDia() + $d) > 29) {
                $this->incrementarMes(1);
                $this->setDia(1);
            } else {
                $incDia = $this->getDia() + $d;
                $this->setDia($incDia);
            }
        } else {
            if (($this->getDia() + $d) > 28) {
                $this->incrementarMes(1);
                $this->setDia(1);
            } else {
                $incDia = $this->getDia() + $d;
                $this->setDia($incDia);
            }
        }
    }

    public function incrementarDias($n) {
        $mesActual = $this->getMes();
        for ($i = 0; $i < $n; $i++) {
            if ($mesActual == 1 || $mesActual == 3 || $mesActual == 5 || $mesActual == 7 || $mesActual == 8 || $mesActual == 10 || $mesActual == 12) {
                $this->sumarDiasA31(1);
            } elseif ($mesActual == 4 || $mesActual == 6 || $mesActual == 9 || $mesActual == 11) {
                $this->sumarDiasA30(1);
            } else {
                $this->sumarDiasAFebrero(1);
            }
        }
    }

    public function incrementarMes($m) {
        if (($this->getMes() + $m) > 12) {
            $this->incrementarAnio(1);
            $incMes = 1;
            $this->setMes($incMes);
        } else {
            $incMes = $this->getMes() + $m;
            $this->setMes($incMes);
        }
    }

    public function incrementarAnio($anio) {
        $incAnio = $this->getAnio() + $anio;
        $this->setAnio($incAnio);
    }

    public function fechaEscrita() {
        $salida = "";
        if (($this->getDia() / 10) < 1) {
            $salida = "0" . $this->getDia();
        } else {
            $salida = $this->getDia();
        }
        if (($this->getMes() / 10) < 1) {
            $salida = $salida . "/0" . $this->getMes();
        } else {
            $salida = $salida . "/" . $this->mes;
        }
        if (($this->getAnio() / 10) < 1) {
            $salida = $salida . "/0" . $this->getAnio() . "\n";
        } else {
            $salida = $salida . "/" . $this->getAnio() . "\n";
        }
        return $salida;
    }

    public function __toString() {
        $cadena = $this->getDia() . " de " . $this->numeroMes[($this->getMes())] . " del anio " . $this->getAnio() . "\n ";
        return $cadena;
    }
}