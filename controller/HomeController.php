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
}
