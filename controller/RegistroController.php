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

    public function procesar()
    {

        if (isset($_POST["enviar"])) {
            if (isset($_POST["nombreUser"]) && isset($_POST["pw"]) && !empty($_POST["nombreUser"]) && !empty($_POST["pw"])) {
                $nombreUser = $_POST["nombreUser"];
                $pw = $_POST["pw"];
                $this->registrarNuevoUsuario($nombreUser, $pw);
            } else {
                $data["error"] = "Los campos no puede estar vacíos";
                $this->renderer->render("registro", $data);
            }
        }
    }
    public function registrarNuevoUsuario($nombreUser, $pw)
    {
        $existe = $this->registroModel->buscarUsuario($nombreUser);
        $pwValida = $this->registroModel->validarContrasenia($pw);

        if ($existe) {
            $data["error"] = "El usuario ya existe.";
        } else {
            if (!$pwValida) {
                $data["error"] = "La contraseña debe tener al menos una letra, un número, un carácter especial y hasta 8 caracteres.";
            } else {
                $this->registroModel->registrarNuevoUsuario($nombreUser, $pw);
                $data["msjOk"] = "Usuario creado correctamente";
            }
        }
        $this->renderer->render("registro", $data);
    }


}