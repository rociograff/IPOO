<?php 
class Calculadora {
    //Atributos 
    private $numero1;
    private $numero2;

    //Constructor
    public function __construct($numero1, $numero2){
        $this -> numero1 = $numero1;
        $this -> numero2 = $numero2;
    }

    //Observadoras
    public function getNumero1() {
        return $this -> numero1;
    }

    public function getNumero2() {
        return $this -> numero2;
    }

    //Observadoras
    public function setNumero1($numero1) {
        $this -> numero1 = $numero1;
    }

    public function setNumero2($numero2) {
        $this -> numero2 = $numero2;
    }

    //Metodos
    /**
     * Devuelve la suma entre dos numeros
     * @return $valorSuma
     */
    public function suma () {
        $resultado = $this -> getNumero1() + $this -> getNumero2();
        return $resultado;
    }

    /**
     * Devuelve la resta entre dos numeros
     * @return $valorResta
     */
    public function resta() {
        $resultado = $this -> getNumero1() - $this -> getNumero2();
        return $resultado;
    }

    /**
     * Devuelve la multiplicacion entre dos numeros
     * @return $resultado
     */
    public function multiplicar() {
        $resultado = $this -> getNumero1() * $this -> getNumero2();
        return $resultado;
    }

    /**
     * Devuelve la division entre dos numeros 
     * @return $resultado
     */
    public function dividir() {
        $resultado = $this -> getNumero1() / $this -> getNumero2();
        return $resultado; 
    }
}
