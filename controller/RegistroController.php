<?php
class RegistroController
{
    private $registroModel;
    private $renderer;

    public function __construct($registroModel, $renderer)
    {
        $this->registroModel = $registroModel;
        $this->renderer = $renderer;
    }

    public function mostrarVista()
    {
        $this->renderer->render("registro");
    }

    public function registrarNuevoUsuario()
{
    if (isset($_POST["enviar"])) {
        if (isset($_POST["nombreUser"]) && isset($_POST["pw"])) {
            $nombreUser = $_POST["nombreUser"];
            $pw = $_POST["pw"];

            // Verificar si el usuario ya existe
            $existe = $this->registroModel->buscarUsuario($nombreUser);

            if (!$existe) {
                // Verificar si la contraseña cumple con los requisitos
                if ($this->registroModel->validarContrasenia($pw)) {
                    // Insertar nuevo usuario si la contraseña es válida
                    $resultado = $this->registroModel->registrarNuevoUsuario($nombreUser, $pw);
                    if ($resultado) {
                        // Redirigir al usuario a la página de inicio de sesión o donde sea apropiado
                        header("Location: /view/homeLogueado");
                        exit(); // ¡No olvides salir después de redirigir!
                    } else {
                        // Error al insertar usuario en la base de datos
                        $data["error"] = "Ocurrió un error al registrar el usuario. Por favor, inténtalo de nuevo.";
                    }
                } else {
                    // Contraseña no cumple con los requisitos
                    $data["error"] = "La contraseña debe tener al menos una letra, un número, un carácter especial y hasta 8 caracteres.";
                }
            } else {
                // Usuario ya existe en la base de datos
                $data["error"] = "El usuario ya existe.";
            }
        } else {
            // Campos del formulario no están configurados correctamente
            $data["error"] = "Por favor, completa todos los campos del formulario.";
        }
    } else {
        // El formulario no ha sido enviado
        $data["error"] = "Por favor, envía el formulario antes de intentar registrar un nuevo usuario.";
    }

    // Renderizar la vista con el mensaje de error correspondiente
    $this->renderer->render("registro", $data);
}

}