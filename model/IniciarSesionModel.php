<?php
class IniciarSesionModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function validarCredenciales($nombreUser, $pw)
    {
        $sql = "select * from usuario where nombreUser = '$nombreUser' && pw = '$pw'";
        return $resultado = $this->database->query($sql);

    }


}