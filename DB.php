<?php

class DB
{
    private $data = array();
    public function insert($id, $obj)
    {
        $this->data[$id] = $obj;
    }
    public function delete($id)
    {
        // borrar la key $id de data
        unset($this->data[$id]);
    }
    public function get($id)
    {
        // devolver data[$id]
        return $this->data[$id];
    }
    public function getAll()
    {
        // devolver data
        return $this->data;
    }
}