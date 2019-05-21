<?php

class Cola
{
    private $_data = array();
    public function encolar($elemento)
    {
        $this->_data [] = $elemento;
    }
    public function desencolar()
    {
        return array_shift($this->_data);
    }
    public function estaVacia()
    {
        return count($this->_data == 0);
    }
}