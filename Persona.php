<?php

class Persona
{
    private $nombre;
    private $dni;

    public function __construct($nombre, $dni)
    {
        $this->nombre = $nombre;
        $this->dni = $dni;
    }

    public function dameNombre()
    {
        return $this->nombre;
    }
    public function dameDNI()
    {
        return $this->dni;
    }
}
