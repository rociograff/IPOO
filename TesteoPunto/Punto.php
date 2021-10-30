<?php
class Punto
{
    // Representación de un punto en el plano
    // los atributos son: $coordenada_x e $coordenada_y que representan los valores de las coordenadas cartesianas.
    private $coordenada_x;

    private $coordenada_y;

    public function __construct($x, $y)
    {
        // Metodo constructor de la clase Punto
        $this->coordenada_x = $x;
        $this->coordenada_y = $y;

    }

    public function getCoordenada_x()
    {
        return $this->coordenada_x;
    }
    public function getCoordenada_y()
    {
        return $this->coordenada_y;
    }

    /**
     *Devuelve la distancia entre el objeto Punto y el recibido por parametro
     * @param unknown $otroPunto
     * @return number
     */
    public function distancia($otroPunto)
    {

        $dx = $this->getCoordenada_x() - $otroPunto->getCoordenada_x();
        $dy = $this->getCoordenada_y() - $otroPunto->getCoordenada_y();
        $laDistancia = pow(($dx * $dx + $dy * $dy), 0.5);
        return $laDistancia;
    }

    /**
     * Devuelve un nuevo punto, con la resta entre dos puntos.
     * @param unknown $otroPunto
     * @return Punto
     */
    public function restar($otroPunto)
    {
        $x = $this->getCoordenada_x() - $otroPunto->getCoordenada_x();
        $y = $this->getCoordenada_y() - $otroPunto->getCoordenada_y();
        $nuevoPunto = new Punto($x, $y);
        return $nuevoPunto;
    }
    /**
     * Devuelve la norma de un punto
     */
    public function norma()
    {
        $x2 = $this->getCoordenada_x() * $this->getCoordenada_x();
        $y2 = $this->getCoordenada_y() * $this->getCoordenada_y();
        return pow(($x2 + $y2), 0.5);
    }

    /**
     * Devuelve la distancia entre ambos puntos.
     * @param Punto $otroPunto
     * @return number
     */
    public function distancia_2($otroPunto)
    {

        $r = $this->restar($otroPunto);
        return $r->norma();
    }

    public function __toString()
    {
        return "(" . $this->getCoordenada_x() . "," . $this->getCoordenada_y() . ")\n";
    }

    public function __destruct()
    {
        echo $this . " instancia destruida, no hay referencias a este objeto \n";
    }
}