<?php
include_once("controller/HomeController.php");
include_once("controller/RegistroController.php");
include_once("controller/IniciarSesionController.php");
include_once("controller/AdminController.php");

include_once("helpers/MustacheRenderer.php");
include_once("helpers/MySqlDatabase.php");
include_once("helpers/Router.php");
include_once('helpers/Logger.php');

include_once("model/HomeModel.php");
include_once("model/RegistroModel.php");
include_once("model/IniciarSesionModel.php");
include_once("model/AdminModel.php");



include_once('third-party/mustache/src/Mustache/Autoloader.php');
class Configuration
{
    private $configFile = 'config/config.ini';

    public function __construct()
    {
    }

    public function getHomeController()
    {
        return new HomeController(new HomeModel($this->getDatabase()), $this->getRenderer());
    }

    public function getRegistroController()
    {
        return new RegistroController(new RegistroModel($this->getDatabase()), $this->getRenderer());
    }

    public function getIniciarSesionController(){
        return new IniciarSesionController(new IniciarSesionModel($this->getDatabase()), $this->getRenderer());
    }

    public function getAdminController(){
        return new AdminController(new AdminModel($this->getDatabase()), $this->getRenderer());
    }

    private function getRenderer()
    {
        return new MustacheRenderer('view/partial');
    }

    private function getArrayConfig()
    {
        return parse_ini_file($this->configFile);
    }

    public function getDatabase()
    {
        $config = $this->getArrayConfig();
        return new MySqlDatabase(
            $config['servername'],
            $config['user'],
            $config['pw'],
            $config['dbname']
        );
    }

    public function getRouter()
    {
        return new Router(
            $this,
            "getHomeController",
            "list"
        );
    }
}
