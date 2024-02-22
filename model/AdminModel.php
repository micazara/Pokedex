<?php
class AdminModel
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function alta($nombre, $rutaTipo, $rutaImagen)
    {
        $sql = "insert into pokemon (nombre, tipo, imagen) values ('$nombre', '$rutaTipo', '$rutaImagen')";
        return $this->database->execute($sql);
    }

    public function getPokemons()
    {
        return $this->database->query('SELECT * FROM POKEMON');
    }

    public function borrar($id)
    {
        $sql = "delete from pokemon where id = '$id'";
        return $this->database->execute($sql);
    }

    public function obtenerCantidadDeUsuariosLogueados()
    {
        return $this->database->query2("SELECT COUNT(*) AS cantidad FROM usuario WHERE rol != 'a' limit 1");
    }

    public function obtenerCantidadDePokemones()
    {
        return $this->database->query2("SELECT COUNT(*) FROM POKEMON");
    }

    public function filtrar($tipo)
    {
        return $this->database->query("select * from pokemon where tipo = '$tipo'");
    }
}