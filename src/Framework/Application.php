<?php

namespace Framework;

class Application
{
    private $routes = [];

    public function get($route, $controller)
    {
        $this->routes[$route] = $controller;
    }


    public function run($server)
    {
        if (\array_key_exists($server['uri'], $this->routes)) {
            return $this->routes[$server['uri']]();
        }
    }
}
