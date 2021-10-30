<?php
include 'Libro.php';
include 'Persona.php';

function menuOpciones(){
    echo "0) SALIR. \n";
    echo "1) Cargar Libros. \n";
    echo "2) Verificar si un libro pertenece a la editorial. \n";
    echo "3) Dada una colección de libros, indica si el libro pasado por parámetro ya se encuentra en dicha colección. \n";
    echo "4) Retornar los años que han pasado desde que el libro fue editado.\n";
    echo "5) Retornar un arreglo asociativo con todos los libros publicados por la editorial dada.\n";
    echo "6) Mostrar informacion del arreglo de Libros.\n";
    $opcion = trim(fgets(STDIN));
    return $opcion;
}

/**
 * PROGRAMA PRINCIPAL
 * Declaracion de variables
 * String $isbn, $titulo, $editorial, $persona $arregloLibros, $libro, $otro, $isbnLibro
 * String $pEditorial, $isbnLibro2, $liabroABuscar, $editorialABuscar, $arraySegunEditorial, $sinopsis
 * String $tipoDocumento, $nombre, $apellido
 * boolean $terminar, $datosCargados, $seEncuentra, $libroEncontrado, $libroEncontrado2
 * int $cant, $anioEdicion, $i, $cantAnios, $cantPag, $numeroDocumento
 */
$terminar = false;
$datosCargados = false;
$arregloLibros = array();
while(!$terminar){
    $opcion = menuOpciones();
    switch($opcion) {
        case 1:
            $cant = 0;
            do {
                echo "Ingrese ISBN: \n";
                $isbn = trim(fgets(STDIN));
                echo "Ingrese titulo: \n";
                $titulo = trim(fgets(STDIN));
                echo "Ingrese año de edicion: \n";
                $anioEdicion = trim(fgets(STDIN));
                echo "Ingrese editorial: \n";
                $editorial = trim(fgets(STDIN));
                echo "Ingrese la cantidad de paginas: \n";
                $cantPag = trim(fgets(STDIN));
                echo "Ingrese la sinopsis: \n";
                $sinopsis = trim(fgets(STDIN));
                echo "\n----------------------------\n";
                echo "Datos del autor.\n";
                echo "Ingrese el nombre de la persona: \n";
                $nombre = trim(fgets(STDIN));
                echo "Ingrese el apellido de la persona: \n";
                $apellido = trim(fgets(STDIN));
                echo "Ingrese el tipo de documento: \n";
                $tipoDocumento = trim(fgets(STDIN));
                echo "Ingrese el numero de documento: \n";
                $numeroDocumento = trim(fgets(STDIN));

                $persona = new Persona($nombre, $apellido, $tipoDocumento, $numeroDocumento);
                $libro = new Libro($isbn, $titulo, $anio, $editorial, $cantPag, $sinopsis, $persona);
                $arregloLibros[$cant] = $libro; //Arreglo que guarda por cada espacio una instancia del objeto libro.
                $cant++;
                echo "Desea cargar otro libro? si/no\n";
                $otro = trim(fgets(STDIN));
            }while (strtoupper($otro) != "no");
            $datosCargados = true;
            break;
        case 2:
            if($datosCargados){
                $libroEncontrado = false;
                echo "Ingrese Isbn del libro: \n";
                $isbnLibro = trim(fgets(STDIN));
                for($i = 0; $i < count($arregloLibros); $i++){
                    if($arregloLibros[$i]->getISBN() == $isbnLibro){
                        $libroEncontrado = true;
                    }
                }
                if($libroEncontrado){
                    echo "Ingrese nombre de la editorial: \n";
                    $pEditorial = trim(fgets(STDIN));
                    if($libro->perteneceEditorial($pEditorial)){
                        echo "El libro pertenece a la editorial.\n";
                    }else {
                        echo "El libro no pertenece a la editorial.\n";
                    }
                }else {
                    echo "No hay ningun libro con ese ISBN en la coleccion.\n";
                }
            }else{
                echo "ERROR NO HAY DATOS CARGADOS.\n";
            }
            break;
        case 3:
            if($datosCargados){
                echo "Ingrese ISBN: \n";
                $isbn = trim(fgets(STDIN));
                echo "Ingrese titulo: \n";
                $titulo = trim(fgets(STDIN));
                echo "Ingrese año de edicion: \n";
                $anioEdicion = trim(fgets(STDIN));
                echo "ingrese editorial: \n";
                $editorial = trim(fgets(STDIN));
                echo "\n----------------------------\n";
                echo "Datos del autor.\n";
                echo "Ingrese el nombre de la persona: \n";
                $nombre = trim(fgets(STDIN));
                echo "Ingrese el apellido de la persona: \n";
                $apellido = trim(fgets(STDIN));
                echo "Ingrese el tipo de documento: \n";
                $tipoDocumento = trim(fgets(STDIN));
                echo "Ingrese el numero de documento: \n";
                $numeroDocumento = trim(fgets(STDIN));
      
                $persona = new Persona($nombre, $apellido, $tipoDocumento, $numeroDocumento);
                $libroABuscar = new Libro($isbn, $titulo, $anio, $editorial, $cantPag, $sinopsis, $persona);

                $seEncuentra = $libro->iguales($libroABuscar, $arregloLibros);
                if($seEncuentra){
                    echo "El libro se encuentra en la coleccion.\n";
                }else {
                    echo "El libro no se encuentra en la coleccion.\n";
                }
            }else {
                echo "ERROR NO HAY DATOS CARGADOS.\n";
            }
            break;
        case 4:
            if($datosCargados){
                $libroEncontrado2 = false;
                echo "Ingrese ISBN del libro: \n";
                $isbnLibro2 = trim(fgets(STDIN));
                for($i = 0; $i < count($arregloLibros); $i++){
                    if($arregloLibros[$i]->getISBN() == $isbnLibro2){
                        $libroEncontrado2 = true;
                    }
                }
                if($libroEncontrado2){
                    $cantAnios = $libro->aniosDesdeEdicion();
                    echo "El libro fue editado hace ".$cantAnios. " años.\n";
                }else {
                    echo "No hay ningun libro con ese ISBN en la coleccion.\n";
                }
            }else {
                echo "ERROR NO HAY DATOS CARGADOS.\n";
            }   
            break;
        case 5:
            if($datosCargados){
                echo "Ingrese editorial: \n";
                $editorialABuscar = trim(fgets(STDIN));
                $arraySegunEditorial = array(); 
                $arraySegunEditorial = $libro->libroDeEditoriales($arregloLibros, $editorialABuscar);
            
                print_r($arraySegunEditorial);
            }else {
                echo "ERROR NO HAY DATOS CARGADOS.\n";
            }
            break;
        case 6:
            if($datosCargados) {
                echo $libro;
            }else {
                echo "ERROR NO HAY DATOS CARGADOS.\n";
            }
    }
}