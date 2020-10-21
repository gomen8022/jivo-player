<?php

namespace App;

abstract class ControllerBase {

    private $model;
    private $view;
    protected $container;

    public function __construct()  {
        $this->view = new View();
        $this->container = new Container();
    }

}
