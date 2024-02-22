<?php
class AdminController
{

    private $adminModel;
    private $renderer;

    public function __construct($adminModel, $renderer)
    {
        $this->adminModel = $adminModel;
        $this->renderer = $renderer;
    }

    public function list()
    {
        session_start();
        $nombreUser = $_SESSION["nombreUser"];
        $data["sesionOk"] = "Bienvenido admin, " . $nombreUser;
        $data["pokemon"] = $this->adminModel->getPokemons();
        $this->renderer->render("homeLogueadoAdmin", $data);
    }

    public function procesarAlta()
    {
        $data = array();
        if (isset($_POST["enviar"])) {
            if (isset($_POST["nombre"]) && !empty($_POST["nombre"]) && isset($_POST["tipo"]) && !empty($_POST["tipo"])) {
                $nombre = ucfirst($_POST["nombre"]);
                $tipo = strtolower($_POST["tipo"]);

                $directorioImagen = "public/img_pokemons/";
                $nombreImagen = $_FILES["imagen"]["name"];
                $rutaImagen = $directorioImagen . $nombreImagen;

                $rutaTipo = "/public/" . $tipo . ".png";

                if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaImagen)) {
                    $resultado = $this->alta($nombre, $rutaTipo, $rutaImagen);
                    if ($resultado == true) {
                        $data["altaOk"] = "Los datos fueron ingresados correctamente";
                    } else {
                        $data["error"] = "Los datos no pudieron ser ingresados";
                    }
                } else {
                    $data["error"] = "Error al subir la imagen";
                }
            } else {
                $data["error"] = "Los campos no pueden estar vacíos";
            }

            $this->renderer->render("alta", $data);
        }
    }

    public function alta($nombre, $rutaTipo, $rutaImagen)
    {
        $rutaImagen = '/' . $rutaImagen;
        return $this->adminModel->alta($nombre, $rutaTipo, $rutaImagen);
    }

    public function showAlta()
    {
        $this->renderer->render("alta");
    }

    public function borrar()
    {
        $id = $_GET["id"];
        $this->adminModel->borrar($id);
        Redirect::to("/admin/list");
    }

    public function estadisticas(){
        $data["cantUsuariosLogueadoss"] = $this->adminModel->obtenerCantidadDeUsuariosLogueados();
        $data["cantPokemones"] = $this->adminModel->obtenerCantidadDePokemones();
        $this->renderer->render("estadisticas", $data);
    }
}