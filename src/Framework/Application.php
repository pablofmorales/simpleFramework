<?php

namespace Framework;

class Application
{
    private $routes = [
        'GET' => [],
        'POST' => [],
        'PATCH' => [],
        'OPTION' => [],
    ];

    public function post($route, $controller)
    {
        $this->routes['POST'][$route] = $controller;
    }

    public function get($route, $controller)
    {
        $this->routes['GET'][$route] = $controller;
    }

    public function run($server)
    {
        $route = $this->routes[$server['REQUEST_METHOD']];
        if (\array_key_exists($server['REQUEST_URI'], $route)) {
            return $route[$server['REQUEST_URI']]();
        }


    }
}
