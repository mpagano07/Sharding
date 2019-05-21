<?php

class Cluster
{
    private $dbs = array();
    private $cola;

    public function __construct($cola)
    {
        $this->cola = $cola;
    }

    public function guardar(Persona $persona)
    {
        $a_donde = $persona->dameDni() % count($this->dbs);
        $this->dbs[$a_donde]->insert($persona->dameDni(), persona);
    }
    public function borrar(Persona $persona)
    {
        $a_donde = $persona->dameDni() % count($this->dbs);
        $this->dbs[$a_donde]->delete($persona->dameDni);
    }
    public function agregarDB($db)
    {
        $this->dbs[] = $db;
        foreach ($this->dbs as $dbKey => $db) {
            foreach ($db->getAll() as $usuarioKey => $usuario) {
                $a_donde = $usuario->dameDni() % count($this->dbs);
                if ($a_donde != $dbKey) {
                    $this->cola->enconlar($usuario);
                }
            }
        }
    }
    public function migrar()
    {
        while (!$this->cola->estaVacia()) {
            $usuario = $this->cola->desencolar();
            $viejoLugar = $usuario->dameDNI() % (count($this->dbs) - 1);
            $nuevoLugar = $usuario->dameDNI() % count($this->dbs);
            $this->dbs[$viejoLugar]->delete($usuario->dameDNI());
            $this->dbs[$nuevoLugar]->insert($usuario->dameDNI(), $usuario);
        }
    }
    public function mostrarResumen()
    {
        foreach ($this->dbs as $dbKey => $db) {
            echo "DB: $dbKey - Cantidad: " . count($db->getAll()) . "\n";
        }
    }
}
