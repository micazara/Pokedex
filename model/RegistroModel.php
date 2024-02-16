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

        $resultado = $this->database->query("SELECT * FROM USUARIO WHERE nombreUser = '$nombreUser'");
        if (!$resultado) {
            // si esta vacio es porque no se encontró un usuario en la tabla con ese user, por ende se puede crear un nombreUser con ese nombreUser ingresado
            // si no existe procedo a verificar la contraseña
            if (preg_match($this->patronContrasenia, $pw)) {
                $conexion = $this->database->getConnection();
                $nombreUserEscaped = $conexion->real_escape_string($nombreUser);
                $pwEscaped = $conexion->real_escape_string($pw);
                $sql = "INSERT INTO usuario(nombreUser, pw) VALUES ('$nombreUserEscaped', '$pwEscaped')";
                $this->database->execute($sql);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
            // si ya existe ese user en la tabla devuelvo false y en controller un mensaje de error
        }
        

    }



}
