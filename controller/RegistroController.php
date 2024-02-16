<?php
class RegistroController
{
    private $registroModel;
    private $renderer;
    private $msjDeError;

    public function __construct($registroModel, $renderer)
    {
        $this->registroModel = $registroModel;
        $this->renderer = $renderer;
        $this->msjDeError = "La contraseña debe tener al menos una letra, un número, un carácter especial y hasta 8 caracteres.";
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
                $resultado = $this->registroModel->registrarNuevoUsuario($nombreUser, $pw);
                if ($resultado) {
                    header("/view/homeLogueado");
                } else {
                    $data["error"] = $this->msjDeError;
                    $this->renderer->render("registro", $data);
                }
            }
        } else {
            echo "error";
        }
    }
}