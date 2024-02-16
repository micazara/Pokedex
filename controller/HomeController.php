<?php
class HomeController
{
    private $homeModel;
    private $renderer;

    public function __construct($homeModel, $renderer)
    {
        $this->homeModel = $homeModel;
        $this->renderer = $renderer;
    }

    public function list()
    {
        $data["pokemon"] = $this->homeModel->getPokemons();
        $this->renderer->render("home", $data);
    }

    public function buscar(){
        if (isset($_GET["busqueda"])) {
            $campoABuscar = $_GET["campoABuscar"];
            $data["encontrado"] = $this->homeModel->buscar($campoABuscar);
            var_dump($data["encontrado"]);
            $this->renderer->render("home", $data);
        } else {
           echo "error";
        }
        
    }
}
