<?php
class IniciarSesionController
{
    private $iniciarSesionModel;
    private $renderer;

    public function __construct($iniciarSesionModel, $renderer)
    {
        $this->iniciarSesionModel = $iniciarSesionModel;
        $this->renderer = $renderer;
    }

    public function show()
    {
        $this->renderer->render("iniciarSesion");
    }

    public function procesar()
    {
        if (isset($_POST["enviar"])) {
            if (isset($_POST["nombreUser"]) && isset($_POST["pw"]) && !empty($_POST["nombreUser"]) && !empty($_POST["pw"])) {
                $nombreUser = $_POST["nombreUser"];
                $pw = $_POST["pw"];
                $resultados = $this->iniciarSesionModel->validarCredenciales($nombreUser, $pw);

                if (!empty($resultados)) {
                    $credencialesValidas = false;
                    foreach ($resultados as $fila) {
                        if ($fila["nombreUser"] === $nombreUser && $fila["pw"] === $pw) {
                            // Las credenciales son válidas
                            $credencialesValidas = true;
                            // Iniciar sesión
                            $this->iniciarSesion($nombreUser, $pw);
                            // Redirigir según el rol
                            if ($fila["rol"] === 'c') {
                                $data["sesionOk"] = "Bienvenido, " . $_SESSION["nombreUser"];
                                $this->renderer->render("homeLogueadoUsuarioComun", $data);

                            } elseif ($fila["rol"] === 'a') {
                                $data["sesionOk"] = "Bienvenido, " . $_SESSION["nombreUser"];
                                $this->renderer->render("homeLogueadoAdmin", $data);
                            }
                        }
                    }
                    // Si las credenciales no coinciden con ningún registro en la base de datos
                    if (!$credencialesValidas) {
                        $data["error"] = "Las credenciales son incorrectas";
                        $this->renderer->render("iniciarSesion", $data);
                    }
                } else {
                    // Si no se encontraron resultados en la base de datos
                    $data["error"] = "Las credenciales son incorrectas";
                    $this->renderer->render("iniciarSesion", $data);
                }
            } else {
                // Si los campos del formulario están vacíos
                $data["error"] = "Los campos no pueden estar vacíos";
                $this->renderer->render("iniciarSesion", $data);
            }
        }
    }


    public function iniciarSesion($nombreUser, $pw)
    {
        session_start();
        $_SESSION["nombreUser"] = $nombreUser;
        $_SESSION["pw"] = $pw;
    }

}