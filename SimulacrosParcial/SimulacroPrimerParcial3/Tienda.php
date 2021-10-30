<?php
class Tienda {
/*
Se registra la siguiente información: nombre, dirección, teléfono, la colección de productos y la colección de
ventas realizadas.
*/
    // Atributos
    private $nombreTienda;
    private $direccion;
    private $telefono;
    private $colProductos;
    private $colVentasRealizadas;

    // Constructor
    public function __construct($nombre, $dire, $tel, $productos, $ventas) {
        $this->nombreTienda = $nombre;
        $this->direccion = $dire;
        $this->telefono = $tel;
        $this->colProductos = $productos;
        $this->colVentasRealizadas = $ventas;
    }

    // Observadoras
    public function getNombreTienda() {
        return $this->nombreTienda;
    }

    public function getDireccionTienda() {
        return $this->direccion;
    }

    public function getTelefonoTienda() {
        return $this->telefono;
    }

    public function getColProductos() {
        return $this->colProductos;
    }

    public function getColVentasRealizadas() {
        return $this->colVentasRealizadas;
    }

    // Modificadoras
    public function setNombreTienda($nombre) {
        $this->nombreTienda = $nombre;
    }

    public function setDireccionTienda($dire) {
        $this->direccion = $dire;
    }

    public function setTelefonoTienda($tel) {
        $this->telefono = $tel;
    }

    public function setColProductos($productos) {
        $this->colProductos = $productos;
    }

    public function setColVentasRealizadas($ventas) {
        $this->colVentasRealizadas = $ventas;
    }

    // Metodos
    public function __toString() {
        return "Nombre de la tienda: " . $this->getNombreTienda() . "\n" .
        "Direccion: " . $this->getDireccionTienda() . "\n" .
        "Telefono: " . $this->getTelefonoTienda() . "\n" .
        "Productos: \n" . $this->mostrarProductos() . "\n" .
        "Ventas realizadas: \n" . $this->mostrarVentas();
    }

/*
Metodo mostrarProductos() para listar la coleccion de productos
*/
    public function mostrarProductos() {
        $retorno = "";
        $col = $this->getColProductos();
        for ($i = 0; $i < count($col); $i++) {
            $retorno .= $col[$i] . "\n";
            $retorno .= "-------------------------\n";
        }
        return $retorno;
    }

/*
Metodo mostrarVentas() para listar la coleccion de ventas realizadas
*/
    public function mostrarVentas() {
        $retorno = "";
        $col = $this->getColVentasRealizadas();
        for ($i = 0; $i < count($col); $i++) {
            $retorno .= $col[$i] . "\n";
            $retorno .= "-------------------------\n";
        }
        return $retorno;
    }

/*
Implementar el método buscarProducto que dado un código de barra por parámetro, retorna la referencia
a un objeto producto con ese código de barra. En caso de no encontrar el código de barra en la colección
de productos retornar null.
*/    
    public function buscarProducto($codigoBuscado) {
        $colProductos = $this->getColProductos();
        $i = 0;
        $codigoEncontrado = false;

        while ($i < count($colProductos) && !$codigoEncontrado) {
            $objProducto = $colProductos[$i];
            if ($objProducto->getCodigoBarraProducto() == $codigoBuscado) {
                $objProducto = $colProductos[$i];
                $codigoEncontrado = true;
            }
            $i++;
        }
        return $objProducto;
    }

/*
Implementar el metodo realizarVenta que recibe por parámetro un arreglo asociativo con las siguientes
claves:”codigoBarra” (código barra correspondiente a un producto) y “cantidad” (cantidad de ejemplares del
producto que desea venderse). El procedimiento debe buscar los productos según el código de barra, verificar
el stock disponible y realizar el registro de la venta en caso de ser posible. El procedimiento debe retornar
un objeto Venta con los ítem correspondientes a aquellos producto que pudo vender. En la implementación
del método deben utilizarse los siguientes métodos: buscarProducto , incorporarProducto,
actualizarStock.
*/
    public function realizarVenta($arregloVentas) {
        $colVentasRealizadas = $this->getColVentasRealizadas();
        $colProductos = $this->getColProductos();

        for ($i = 0; $i < count($arregloVentas); $i++) {
            $codigoNuevaVenta = $arregloVentas[$i]["codigoBarra"];
            $cantidadVenta = $arregloVentas[$i]["cantidad"];
            $objProducto = $this->buscarProducto($codigoNuevaVenta);

            echo "objProductoif: " . $objProducto;

            if (!is_null($objProducto)) {
                array_push($colVentasRealizadas, $objProducto);
                $this->setColVentasRealizadas($colVentasRealizadas);

                foreach ($colVentasRealizadas as $objVentas) {
                    $productoIncorporado = $colVentasRealizadas->incorporarProducto($objProducto, $cantidadVenta);

                    if ($productoIncorporado) {
                        $objVentas = $this->getColVentasRealizadas();
                    }
                }
            }
        }
        return $objVenta;  //NO FUNCIONA
    }
}