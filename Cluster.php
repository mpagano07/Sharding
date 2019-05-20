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
        // no va mas con arreglos, ahora son DB
        // dbs[donde]->insert(id, usuario)
        $a_donde = $persona->dameDNI() % count($this->dbs);
        $this->dbs[$a_donde]->insert($persona->dameDNI(),$persona);
        // $this->dbs[$a_donde][$persona->dameDNI()] = $persona;
    }


    public function borrar(Persona $persona)
    {
        // aca no va mas el unset deberia ser
        // dbs[donde]->delete( id )
        $a_donde = $persona->dameDNI() % count($this->dbs);
        $this->dbs[$a_donde]->delete($persona->dameDNI());
        // unset($this->dbs[$a_donde][$persona->dameDNI()]);
    }


    public function agregarDB($db)
    {
        $this->dbs[] = $db;
        //$data = $db->getAll();
        foreach ($this->dbs as $dbKey => $db) {
            foreach ($db->getAll() as $keyUsuario => $usuario) {
                $a_donde = $usuario->dameDNI() % count($this->dbs);
                if ($a_donde != $dbKey) {
                    $this->cola->encolar($usuario);
                }
            }
        }
    }


    public function migrar()
    {
        while (!$this->cola->estaVacia()) {
            $usuario = $this->cola->desencolar();
            // estas cuentas quedan igual que antes
            $viejoLugar = $usuario->dameDNI() % (count($this->dbs) - 1);
            $nuevoLugar = $usuario->dameDNI() % count($this->dbs);
            // esto ya no van, deberian ser
            // db->delete
            // db->insert
            $this->dbs[$viejoLugar]->delete($usuario->dameDNI());
            $this->dbs[$nuevoLugar]->insert($usuario->dameDNI(),$usuario);
            // unset($this->dbs[$viejoLugar][$usuario->dameDNI()]);
            // $this->dbs[$nuevoLugar][$usuario->dameDNI()] = $usuario;
        }
    }


    public function mostarResumen()
    {
        foreach ($this->dbs as $dbKey => $db) {
            // echo "DB: $dbKey - Cantidad: " . count($db) . "\n";
            echo "DB: $dbKey - Cantidad: ".count($db->getAll())."\n";
        }
    }
}

