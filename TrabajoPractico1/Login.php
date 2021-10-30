<?php
class Login
{

    private $nombreUsuario;
    private $contrasenia;
    private $fraseAyuda;
    private $arregloContras;
    private $indiceArreglo;

    public function __construct($usuario, $pass, $frase)
    {
        $this->nombreUsuario = $usuario;
        $this->contrasenia = $pass;
        $this->fraseAyuda = $frase;
        $this->arregloContras = [4];
        $this->indiceArreglo = 0;
        $this->arregloContras[$this->indiceArreglo] = $this->contrasenia;
        $this->indiceArreglo++;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function setFraseAyuda($nuevaFrase)
    {
        $this->fraseAyuda = $nuevaFrase;
    }

    public function contraseniaValida($pass)
    {
        if ($this->contrasenia == $pass) {
            $retorno = true;
        } else {
            $retorno = false;
        }
        return $retorno;
    }

    public function cambiarContrasenia($nuevaContrasenia)
    {
        $i = 0;
        $valida = true;
        while ($i < count($this->arregloContras) && $valida) {
            if ($this->arregloContras[$i] == $nuevaContrasenia) {
                $valida = false;
                echo "La contrasenia ingresada no puede ser igual a una anterior\n";
            } else {
                $i++;
            }
        }
        if ($valida) {
            $this->arregloContras[$this->indiceArreglo] = $nuevaContrasenia;
            $this->indiceArreglo = ($this->indiceArreglo + 1) % 4;
        }
        return $valida;
    }

    public function recordar($usuario)
    {
        //String $retorno
        if ($this->nombreUsuario == $usuario) {
            $retorno = $this->fraseAyuda;
        } else {
            $retorno = "Usuario incorrecto\n";
        }
        return $retorno;
    }

    public function __destruct()
    {
        echo $this . " instancia destruida, no hay referencias a este objeto";
    }
}
