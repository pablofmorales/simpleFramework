<?php

namespace Framework;

use Framework\Exceptions\PageNotFoundException as PageNotFound;

class Application
{

    const NOT_FOUND = 404;

    private $parameter;

    private $routes = [
        'GET' => [],
        'POST' => [],
        'PATCH' => [],
        'OPTION' => [],
    ];

    public $postValues = [];
    public $getValues = [];

    public function __construct($server, $post, $get)
    {
        $this->server = $server;
        $this->postValues = $post;
        $this->getValues = $get;

        if  (! isset($this->server['PATH_INFO'])) {
            $this->server['PATH_INFO'] = '/';
        }
    }

    public function getParameter()
    {
        return $this->parameter;
    }

    public function post($route, $controller)
    {
        $this->routes['POST'][$route] = $controller;
    }

    private function complexUri($route)
    {
        preg_match('#\{(.*?)\}#', $route, $match);

        return count($match)
            ? \str_replace($match[0], '%d', $route)
            : $route;
    }

    public function get($route, $controller)
    {
        $route = $this->complexUri($route);
        $this->routes['GET'][$route] = $controller;
    }

    private function routeExists($path)
    {
        return \array_key_exists($path, $this->routes[$this->server['REQUEST_METHOD']]);
    }

    public function match($path)
    {
        if ($this->routeExists($path)) {
            return $this->routes[$this->server['REQUEST_METHOD']][$path]();
        }

        $parts = explode("/", $path);
        $this->parameter = (int)\end($parts);
        $parts[count($parts)-1] = '%d';
        if ($this->parameter > 0) {
            $routeAux = implode('/', $parts);
            if ($this->routeExists($routeAux)) {
                return $this->routes[$this->server['REQUEST_METHOD']][$routeAux]();
            }
        }

        return false;
    }

    public function run()
    {
        $response = $this->match($this->server['PATH_INFO']);

        if (! $response ) {
            \http_response_code(self::NOT_FOUND);
            throw new PageNotFound("Route not exists "
                . $this->server['PATH_INFO']);
        }

        return $response;
    }
}
