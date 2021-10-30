<?php 
class Torneo {
    //Atributos
    private $colPartidos;
    private $importePremio;

    //Constructor 
    public function __construct($colPartidos, $importePremio) {
        $this->colPartidos = $colPartidos;
        $this->importePremio = $importePremio;
    }
    
    //Observadores
    public function getColPartidos() {
        return $this->colPartidos;
    }

    public function getImportePremio() {
        return $this->importePremio;
    }

    //Modificadores
    public function setColPartidos($colPartidos) {
        $this->colPartidos = $colPartidos;
    }

    public function setImportePremio($importePremio) {
        $this->importePremio = $importePremio;
    }

    //Metodos
    /*Metodo __toString() para mostrar los datos del Torneo*/
    public function __toString() {
        return "\n--------PARTIDOS--------\n".$this->mostrarColeccion($this->getColPartidos())."\n".
        "Premio: $".$this->getImportePremio()."\n";
    }

    /* Metodo para mostrar colecciones */
    private function mostrarColeccion($coleccion) {
        $arreglo = "";
        foreach ($coleccion as $obj) {
            $arreglo .= $obj . "\n";
            $arreglo .= "--------------------------\n";
        }
        return $arreglo;
    }

    /*Método ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipo) el cual recibe por parámetro 2 equipos, la fecha
    en la que se realizará el partido y si se trata de un partido de futbol o basquetbol. El método debe crear y
    retornar una instancia de la clase Partido que corresponda y almacenarla en la colección. Se debe chequear que los
    2 equipos tengan la misma categoría y cantidad de jugadores. */
    public function ingresarPartido($objEquipo1, $objEquipo2, $fecha, $tipo) {
        $coleccionPartidos = $this->getColPartidos();
        $exito = false;
        $idPartido = count($coleccionPartidos);
        $categoriaEq1 = $objEquipo1->getCategoriaEquipo();
        $categoriaEq2 = $objEquipo2->getCategoriaEquipo();

        $cantJugadoresEq1 = $objEquipo1->getCantJugadores();
        $cantJugadoresEq2 = $objEquipo2->getCantJugadores();

        //Chequeo que los dos equipos tengan la misma categoria y cantidad de jugadores
        if($categoriaEq1 == $categoriaEq2 && $cantJugadoresEq1 == $cantJugadoresEq2) {
            //De acuerdo al tipo de partido...
            if($tipo == "futbol") { 
                //Creo la instancia de la clase Futbol
                $partido = new Futbol($idPartido, $objEquipo1, $objEquipo2, $fecha, 0, 0);
                array_push($coleccionPartidos, $partido);
                $this->setColPartidos($coleccionPartidos);
                $exito = true;
            } else if($tipo == "basquetbol") {
                //Creo la intancia de la clase Basquetbol
                $partido = new Basquetbol($idPartido, $objEquipo1, $objEquipo2, $fecha, 0, 0, 0);
                array_push($coleccionPartidos, $partido);
                $this->setColPartidos($coleccionPartidos);
                $exito = true;
            }
        }
        //Retorno la instancia correspondiente
        return $exito;
    }

    /*Método darGanadores($deporte) que recibe por parámetro si se trata de un partido de futbol o de basquetbol y
    en base al parámetro busca entre esos partidos los equipos ganadores (equipo con mayor cantidad de goles).
    El método retorna una colección con los objetos de los equipos encontrados. */
    public function darGanadores($deporte) {
        $coleccionPartidos = $this->getColPartidos();
        $coleccionEquipos = array();

        foreach($coleccionPartidos as $objPartido) {
            //Compruebo si el objeto dado por $objPartido es de la clase $deporte buscada 
            if(is_a($objPartido, $deporte)) {
                $equipoGanador = $objPartido->equipoGanador(); //Invoco el metodo equipoGanador() con la mayor cantidad de goles
                if(!is_null($equipoGanador)) {
                    array_push($coleccionEquipos, $equipoGanador);
                }
            }
        }
        //Retorno la coleccion de los equipos encontrados ganadores
        return $coleccionEquipos;
    }

    /*Método calcularPremioPartido($OBJPartido) que debe retornar un arreglo asociativo donde una de sus
    claves es ‘equipoGanador’ y contiene la referencia al equipo ganador; y la otra clave es ‘premioPartido’ que
    contiene el valor obtenido del coeficiente del Partido por el importe configurado para el torneo. */
    public function calcularPremioPartido($objPartido) {
        $equipoGanador = $objPartido->equipoGanador();
        $importePremio = $this->getImportePremio();
        $arreglo = [
            "equipoGanador" => null,
            "premioPartido" => 0,
        ];

        if (!is_null($equipoGanador)) {
            $arreglo = [
                "equipoGanador" => $equipoGanador, //Contiene la referencia al equipo ganador
                "premioPartido" => $importePremio * $objPartido->coeficientePartido(), //Contiene el valor obtenido del coeficiente del Partido por el importe configurado para el torneo
            ];
        }
        //Retorno el arreglo asociativo
        return $arreglo;
    }
}