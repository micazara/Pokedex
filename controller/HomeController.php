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
        // escucho el boton de submit
        if (isset($_GET["busqueda"])) {
            if (isset($_GET["campoABuscar"])) {
                // agarro lo que se puso en el input
                $campoABuscar = $_GET["campoABuscar"];
                $data["pokemon"] = $this->homeModel->buscar($campoABuscar);
                $this->renderer->render("home", $data);
            }
            
        } else {
           echo "error";
        }
        
    }
}
