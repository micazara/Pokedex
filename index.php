<?php
session_start();
include_once('Configuration.php');
$configuration = new Configuration();
$router = $configuration->getRouter();
$module = $_GET['module'] ?? 'home';
$method = $_GET['action'] ?? 'list';
$router->route($module, $method);
