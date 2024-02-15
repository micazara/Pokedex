<?php
include_once("controller/HomeController.php");

include_once("helpers/MustacheRenderer.php");
include_once("helpers/MySqlDatabase.php");
include_once("helpers/Router.php");
include_once('helpers/Logger.php');

include_once("model/HomeModel.php");

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
