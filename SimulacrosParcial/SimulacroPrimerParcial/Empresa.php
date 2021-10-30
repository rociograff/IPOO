<?php
class Empresa {
    //Atributos
    private $denominacion;
    private $direccion;
    private $colClientes;
    private $colProductos;
    private $colVentas;

    //Constructor
    public function __construct($den, $dire, $clientes, $productos, $ventas) {
        $this->denominacion = $den;
        $this->direccion = $dire;
        $this->colClientes = $clientes;
        $this->colProductos = $productos;
        $this->colVentas = $ventas;
    }

    //Observadores
    public function getDenominacion() {
        return $this->denominacion;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getColClientes() {
        return $this->colClientes;
    }

    public function getColProductos() {
        return $this->colProductos;
    }

    public function getColVentas() {
        return $this->colVentas;
    }

    //Modificadores
    public function setDenominacion($den) {
        $this->denominacion = $den;
    }

    public function setDireccion($dire) {
        $this->direccion = $dire;
    }

    public function setColClientes($clientes) {
        $this->colClientes = $clientes;
    }

    public function setColProductos($productos) {
        $this->colProductos = $productos;
    }

    public function setColVentas($ventas) {
        $this->colVentas = $ventas;
    }

    //Metodos
    /**
    * Metodo toString() para mostrar los datos de la Empresa
    */
    public function __toString() {
        return "Denominacion: " . $this->getDenominacion() . "\n" .
        "Direccion: " . $this->getDireccion() . "\n" .
        "Clientes:\n" . $this->mostrarClientes() .
        "Productos:\n" . $this->mostrarProductos() .
        "Ventas:\n" . $this->mostrarVentas();
    }

    /**
    * Metodo para mostrar los datos del arreglo de Productos
    * @return String $retorno
    */
    public function mostrarClientes() {
        //String $retorno
        //Array Cliente $col
        $retorno = "";
        $col = $this->getColClientes();
        for ($i = 0; $i < count($col); $i++) {
            $retorno .= $col[$i] . "\n";
            $retorno .= "----------------------------\n";
        }
        return $retorno;
    }

    /**
    * Metodo para mostrar los datos del arreglo de Productos
    * @return String $retorno
    */
    public function mostrarProductos() {
        //String $retorno
        //Array Producto $col
        $retorno = "";
        $col = $this->getColProductos();
        for ($i = 0; $i < count($col); $i++) {
            $retorno .= $col[$i] . "\n";
            $retorno .= "-------------------------\n";
        }
        return $retorno;
    }

    /**
    * Metodo para mostrar los datos del arreglo de Productos
    * @return String $retorno
    */
    public function mostrarVentas() {
        //String $retorno
        //Array Venta $col
        $retorno = "";
        $col = $this->getColVentas();
        for ($i = 0; $i < count($col); $i++) {
            $retorno .= $col[$i] . "\n";
            $retorno .= "-------------------------\n";
        }
        return $retorno;
    }

    /**
    * Metodo que recorre la colección de productos de la Empresa y retorna la
    * referencia al objeto producto cuyo código coincide con el recibido por parámetro.
    * 
    * @param $codigoProducto
    * @return Producto $retorno
    */
    public function retornarProducto($codigoProducto) {
        //Producto $retorno
        //int $i
        //boolean $encontrado
        $i = 0;
        $encontrado = false;
        $retorno = null;
        while ($i < count($this->getColProductos()) && !$encontrado) {
            if ($this->colProductos[$i]->getCodigo() == $codigoProducto) {
                $retorno = $this->colProductos[$i];
                $encontrado = true;
            }
            $i++;
        }
        return $retorno;
    }

    /**
    * Método que recibe por parámetro una colección de códigos de productos, la cual es recorrida, 
    * se busca el objeto producto correspondiente  al código y se incorpora a la colección de productos
    * de la instancia Venta que debe ser creada.
    * Recordar que no todos los clientes ni todos los productos, están disponibles para registrar una venta en
    * un momento determinado.
    * El método debe setear las variables instancias de venta que corresponda y retornar el importe final de la venta.
    *
    * @param $colCodigosProductos, $objCliente
    * @return boolean $exito
    */
    public function registrarVenta($colCodigosProductos, $objCliente) {
        //Venta $nuevaVenta
        //Producto $nuevoProducto
        //int $codigoProducto
        //Array Venta $colVentas
        $precioFinal = 0;
        $colVentas = $this->getColVentas();
        if (!$objCliente->getDadoDeBaja()) {
            $numero = count($this->colVentas);
            $fecha = date('Y');
            $nuevaVenta = new Venta($numero, $fecha, $objCliente);
            for ($i = 0; $i < count($colCodigosProductos); $i++) {
                $codigoProducto = $colCodigosProductos[$i];
                $nuevoProducto = $this->retornarProducto($codigoProducto); //Utilizo el metodo de esta clase
                if ($nuevoProducto != null) {
                    $nuevaVenta->incorporarProducto($nuevoProducto); //Utilizo un metodo de la clase Venta
                }
            }
            if (count($nuevaVenta->getColProductos()) != 0) {
                $colVentas[count($colVentas)] = $nuevaVenta;
                $this->setColVentas($colVentas);
                $precioFinal = $nuevaVenta->getPrecioFinal();
            }
        }
        return $precioFinal;
    }

    /**
    * Metodo que recibe por párametro el tipo y número de documento de un Cliente y 
    * retorna una colección con las ventas realizadas al cliente.
    * @param $tipo, $numDoc
    * @return Array Venta $ventasRealizadas
    */
    public function retornarVentasPorCliente($tipo, $numDoc) {
        //Array Venta $ventasRealizadas
        //Venta $objVenta
        //Cliente $objCliente
        $ventasRealizadas = [];
        foreach($this->getColVentas() as $objVenta) {
            //foreach recorre el array dado por $colVentas. En cada iteración, el valor del elemento actual se asigna a $objVenta y el puntero interno del array avanza una posición
            $objCliente = $objVenta->getCliente();
            if ($objCliente->getTipoDocumento() == $tipo && $objCliente->getNumeroDocumento() == $numDoc) {
                array_push($ventasRealizadas, $objVenta); // Igual a $ventasRealizadas[count($ventasRealizadas)] = $objVenta;
            }
        }
        return $ventasRealizadas;
    }
}