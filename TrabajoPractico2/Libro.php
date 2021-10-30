<?php
class Libro {
    //Atributos
	private $ISBN;
	private $titulo;
	private $edicion;
	private $editorial;
	private $cantPaginas;
    private $sinopsis;
    private $Persona;

    //Constructor
	public function __construct($isbn, $titulo, $anio, $editorial, $cantPag, $sinopsis, $persona) {
		$this->ISBN = $isbn;
		$this->titulo = $titulo;
		$this->edicion = $anio;
		$this->editorial = $editorial;
		$this->cantPaginas = $cantPag;
        $this->sinopsis = $sinopsis;
        $this->Persona = $persona;
	}

    //Observadoras
	public function getISBN() {
		return $this->ISBN;
	}

	public function getTitulo() {
		return $this->titulo;
	}

	public function getAnioEdicion() {
		return $this->edicion;
	}

	public function getEditorial() {
		return $this->editorial;
	}

    public function getCantPaginas() {
        return $this->cantPaginas;
    }

    public function getSinopsis() {
        return $this->sinopsis;
    }

    public function getPersona() {
        return $this->Persona;
    }

    //Modificadoras
	public function setISBN($isbn) {
		$this->ISBN = $isbn;
	}

	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}

	public function setAnioEdicion($anio) {
		$this->anioDeEdicion = $anio;
	}

	public function setEditorial($editorial) {
		$this->editorial = $editorial;
	}

	public function setCantPaginas($cantPag) {
        $this->cantPaginas = $cantPag;
    }

    public function setSinopsis($sinopsis) {
        $this->sinopsis = $sinopsis;
    }

    public function setPersona($persona) {
        $this->Persona = $persona;
    }

    //Metodos
	/**
     * Indica si el libro pertenece a una editorial dada.
     *  Recibe como parámetro una editorial y devuelve un valor verdadero/falso.
     */
    public function perteneceEditorial($pEditorial){
        $pertenece = false;
        if($pEditorial == $this->getEditorial()){
            $pertenece = true;
        }
        return $pertenece;
    }
    
    //Dada una colección de libros, indica si el libro pasado por parámetro ya se encuentra en dicha colección
    public function iguales($pLibro, $pArreglo){
        $retorno = false;
        $i = 0;
        $tamanio = count($pArreglo);
        $libroBuscar = $pLibro->getISBN();
        
        while ($i < $tamanio && !$retorno){
            if($pArreglo[$i]->getISBN() == $libroBuscar){
                $retorno = true;
            }
            $i++;
        }
        return $retorno;
    }
    
    //Método que retorna los años que han pasado desde que el libro fue editado.
    public function aniosDesdeEdicion(){
        $anioActual = 2021;
        $anioArray = $this->getAnioEdicion();
        $retorno = $anioActual - $anioArray;
        return $retorno;
    }
    
    //Método que retorna un arreglo asociativo con todos los libros publicados por la editorial dada.
    public function libroDeEditoriales($arregloAutor, $pEditorial){
        $librosEditorial = array(); // arreglo con los libros
        $cant = 0;
        for($i = 0; $i < count($arregloAutor); $i++) {
            if($arregloAutor[$i]->getEditorial() == $pEditorial) {
                $librosEditorial[$cant] = $arregloAutor[$i];
                $cant++;
            }
        }
        return $librosEditorial;
    }

    public function __toString() {
		return "-----------------\n ISBN: ".$this->getISBN(). "\n TITULO: ".$this->getTitulo(). 
		"\n EDICION: ".$this->getAnioEdicion(). 
        "\n EDITORIAL: ".$this->getEditorial(). "\n CANTIDAD DE PAGINAS: ".$this->getCantPaginas(). 
        "\n SINOPSIS: ".$this->getSinopsis(). "\n AUTOR: ".$this->getPersona().
		"\n----------------- ";
	}
}