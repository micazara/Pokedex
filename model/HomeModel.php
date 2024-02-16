<?php
class HomeModel{
    private $database;

    public function __construct($database){
    $this->database = $database;
    }

    public function getPokemons(){
        return $this->database->query('SELECT * FROM POKEMON');
    }

    public function buscar($campoABuscar){
        return $this->database->query("SELECT * FROM POKEMON WHERE id LIKE '%$campoABuscar%' OR nombre LIKE '%$campoABuscar%' OR tipo LIKE '%$campoABuscar%'");
    }
    
}