<?php

require_once 'DB.php';
require_once 'Cluster.php';
require_once 'Cola.php';
require_once 'Persona.php';

$cluster = new Cluster(new Cola());
$cluster->agregarDB(new DB());
// $cluster->migrar();
$cluster->agregarDB(new DB());
// $cluster->migrar();
$cluster->agregarDB(new DB());
// $cluster->migrar();

$cluster->guardar(new Persona("Pepe", 32));
$cluster->guardar(new Persona("Matias", 10));
$cluster->guardar(new Persona("Julian", 9));
$cluster->guardar(new Persona("Jose", 44));
$cluster->guardar(new Persona("Adrian", 55));
$cluster->guardar(new Persona("KP", 60));
$cluster->guardar(new Persona("Tomy", 70));

$cluster->agregarDB(new DB());
$cluster->migrar();

$cluster->mostarResumen();
