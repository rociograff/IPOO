<?php
class Lectura {
    //Atributos
    private $libroLeido; //objeto libro.
    private $paginasLeidas;
    
    //Constructor    
    public function __construct($libro, $paginas) {
        $this->libroLeido = $libro;
        $this->paginasLeidas = $paginas;
    }

    //Observadoras
    public function getLibroLeido() {
        return $this->libroLeido;
    }

    public function getPaginasLeidas() {
        return $this->paginasLeidas;
    }

    //Modificadoras
    public function setLibroLeido($valor) {
        $this->libroLeido = $valor;
    }

    public function setPaginasLeidas($valor) {
        $this->paginasLeidas = $valor;
    }
    
    //Metodos
    /**
     * Método que retorna la página del libro y actualiza la variable que contiene la pagina actual.
     */
    public function siguientePagina() {
        $libro = $this->getLibroLeido();    //obtengo el objeto libro que ingresa por parametro en el constructor.
        $totalPaginas = $libro->getCantPaginas(); //obtengo el retorno del  metodo get que pertenece al objeto libro.
        
        $pagActual = $this->getPaginasLeidas();
        if($pagActual < $totalPaginas) {
            $pagSiguiente = $pagActual + 1;
            $this->setPaginasLeidas($pagSiguiente);    
        }
        return $this->getPaginasLeidas();
    }
    
    /**
     * Método que retorna la página anterior a la actual del libro y actualiza su valor.
     */
    public function retrocederPagina() {
        $libro = $this->getLibroLeido();
        $totalPaginas = $libro->getCantPaginas();

        $pagActual = $this->getPaginasLeidas();
        if($pagActual <= $totalPaginas && $pagActual > 0) {
            $pagAnterior = $pagActual - 1;
            $this->getPaginasLeidas($pagAnterior);
        }
        return $this->getPaginasLeidas();
    }
    
    /**
     * Método que retorna la página actual y setea como página actual al valor recibido por parámetro.
     */
    public function irPagina($x) {
        $libro = $this->getLibroLeido();
        $totalPaginas = $libro->getCantPaginas();
        
        if($x >= $totalPaginas && $x <= $totalPaginas) {
            $nuevoValor = $x;
            $this->setPaginasLeidas($nuevoValor);
        }
        return $this->getPaginasLeidas();
    }

    public function __toString() {
        $objLibro = $this->getLibroLeido();
        return "ISBN: \n".$objLibro->getISBN()."Titulo: \n".$objLibro->getTitulo()."Año de Edicion \n". $objLibro->getAnioEdicion().
                "Editorial: \n".$objLibro->getEditorial()."Cantidad de Páginas: \n".$objLibro->getCantPaginas().
                "Sinopsis: \n".$objLibro->getSinopsis(). "Paginas leidas actualmente: \n".$this->getPaginasLeidas();
    }
} 