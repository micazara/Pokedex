<?php
class AdminController
{

    private $adminController;
    private $renderer;

    public function __construct($adminController, $renderer)
    {
        $this->adminController = $adminController;
        $this->renderer = $renderer;
    }


}