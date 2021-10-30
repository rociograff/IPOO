<?php

class CajaAhorro extends Cuenta {
    //Constructor
    public function __construct($num, $cash, $duenio) {
        //Invodo al constructor de Cuenta
        parent::__construct($num, $cash, $duenio);
    }
}