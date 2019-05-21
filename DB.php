<?php

class DB 
{
    private $data = array();

    public function insert($id, $obj)
    {
        return $this->data[$id] = $obj;
    }
    public function delete($id)
    {
        unset($this->data[$id]);
    }
    public function get($id)
    {
        return $this->data[$id];
    }
    public function getAll()
    {
        return $this->data;
    }
}