<?php

namespace Framework;

use Framework\Exceptions\PageNotFoundException as PageNotFound;

class Application
{

    const NOT_FOUND = 404;

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
    }

    public function post($route, $controller)
    {
        $this->routes['POST'][$route] = $controller;
    }

    public function get($route, $controller)
    {
        $this->routes['GET'][$route] = $controller;
    }

    public function run()
    {
        $route = $this->routes[$this->server['REQUEST_METHOD']];
        if (\array_key_exists($this->server['PATH_INFO'], $route)) {
            return $route[$this->server['PATH_INFO']]();
        }

        \http_response_code(self::NOT_FOUND);

        throw new PageNotFound("Route not exists "
            . $this->server['PATH_INFO']);
    }
}
