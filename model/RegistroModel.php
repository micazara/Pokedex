<?php
class RegistroModel
{
    private $database;
    private $patronContrasenia;
    public function __construct($database)
    {
        $this->database = $database;
        $this->patronContrasenia = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{1,8}$/';
    }

    public function registrarNuevoUsuario($nombreUser, $pw)
    {
        $conexion = $this->database->getConnection();
        $nombreUserEscaped = $conexion->real_escape_string($nombreUser);
        $pwEscaped = $conexion->real_escape_string($pw);
        $sql = "INSERT INTO usuario(nombreUser, pw) VALUES ('$nombreUserEscaped', '$pwEscaped')";
        $resultado = $this->database->execute($sql);
        return $resultado;
    }

    public function buscarUsuario($nombreUser)
    {
        // Construir la consulta SQL para buscar el usuario por su nombre
        $sql = "SELECT * FROM usuario WHERE nombreUser = '$nombreUser'";

        // Ejecutar la consulta SQL
        $resultado = $this->database->query($sql);

        // Verificar si se encontró algún resultado
        if (!empty($resultado)) {
            // Si se encontraron resultados, el usuario existe
            return true;
        } else {
            // Si no se encontraron resultados, el usuario no existe
            return false;
        }
    }


    public function validarContrasenia($pw)
    {
        if (preg_match($this->patronContrasenia, $pw)) {
            return true;
        }
    }



}
