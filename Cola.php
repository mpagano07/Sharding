<?php

class Cola
{
    private $_data = array();
    public function encolar($element)
    {
        $this->_data[] = $element;
    }

    public function desencolar()
    {
        return array_shift($this->_data);
    }

    public function estaVacia()
    {
        return count($this->_data) == 0;
    }
}
