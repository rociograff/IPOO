<?php
include_once '../datos/Persona.php';
include_once '../datos/Estudiante.php';

$obj=  new Estudiante();
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$nombre = substr(str_shuffle($permitted_chars), 0, 16);
$apellido = substr(str_shuffle($permitted_chars), 0, 16);
$nrodoc = rand (8212412,58212412);
echo " Voy a insertar el DNI: ".$nrodoc;
$obj->cargar(null,$nrodoc, $nombre,$apellido, "yo@mail.com","IPOO");
$respuesta=$obj->insertar();

/* 



//echo 'Versión actual de PHP: ' . phpversion();
	// creo un obj Estudiante
	$obj=  new Estudiante();
	//Busco todos los estudiantes almacenadas en la BD
	$coleccion =$obj->listar();
	foreach ($coleccion as $un){
	    echo $un;
		echo "-------------------------------------------------------";
	}
	
	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$nombre = substr(str_shuffle($permitted_chars), 0, 16);
	$apellido = substr(str_shuffle($permitted_chars), 0, 16);
	$nrodoc = rand (8212412,58212412);
	echo " Voy a insertar el DNI: ".$nrodoc;
	$obj->cargar($nrodoc, $nombre,$apellido, "yo@mail.com","IPOO");
	$respuesta=$obj->insertar();
	// Inserto el OBj Estudiante en la base de datos
	if ($respuesta==true) {
			echo "\nOP INSERCION;  La persona fue ingresada en la BD";
			$coleccion =$obj->listar();
			foreach ($coleccion as $un){
			    
			    echo $un;
			    echo "-------------------------------------------------------";
			}
	}else 
	    echo $obj->getmensajeoperacion();
	
	
	// modifico el estudiante
	$obj->setNombre("Nombre Modificado");
	$obj->setCarrera("IP");
	$respuesta = $obj->modificar();
	if ($respuesta==true) {
			
			echo " \nOP MODIFICACION: Los datos fueron actualizados correctamente";
			$coleccion =$obj->listar();
			foreach ($coleccion as $un){
			    
			    echo $un;
			    echo "-------------------------------------------------------";
			}
	}else
	    echo $obj->getmensajeoperacion();
	
	// elimino un estudiante
	    $respuesta =$obj->eliminar();
	if ($respuesta==true) {
		//Busco todas las personas almacenadas en la BD y veo la modificacion realizada
		echo " \nOP ELIMINACION tos fueron eliminados correctamente";
		$coleccion =$obj->listar();
		foreach ($coleccion as $un){
		    
		    echo $un;
		    echo "-------------------------------------------------------";
		}
	}else
	    echo $obj->getmensajeoperacion();
 */
?>