<?php

namespace App;

class Router {

    private $routes;

    public function add_route($route, $class, $method, $view = null) {
        $arrArgs = [
            'route' => [
                'class' => $class,
                'method' => $method
            ],
            'view' => $view
        ];

        $this->routes[$route] = $arrArgs;
    }

    public function execute() {
        $v = new View();
        $path = !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (!empty($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '/');
        if(array_key_exists($path, $this->routes)) {
            $className = $this->routes[$path]['route']['class'];
            $methodName = $this->routes[$path]['route']['method'];
            $class = new $className;
            if (isset($class) && !empty($methodName)) {
                $data = [];
                $data = $class->$methodName();
                $v::generate($this->routes[$path]['view'], $data);
            }
        }
        else {
            $this->routes['/'];
            $v::generate($this->routes[$path]['view'], []);
        }
    }
}
