<?php

namespace PHPFramework;

class Router
{


    protected array $routes = [];

    protected array $route_params = [];

    public function __construct(
        protected Request $request,
        protected Response $response
    ) {
        $this->request = $request;
        $this->response = $response;
    }

    public function add($patch, $callback, $method): self
    {
        $path = trim($patch, '/');
        if (is_array($method)) {
            $method = array_map('strtoupper', $method);
        } else {
            $method = [strtoupper($method)];
        }
        $this->routes[] = [
            'path' => $path,
            'callback' => $callback,
            'middleware' => '',
            'method' => $method
        ];

        dump($this->routes);
        return $this;
    }

    public function get($patch, $callback): self
    {
        return $this->add($patch, $callback, 'get');
    }

    public function post($patch, $callback): self
    {
        return $this->add($patch, $callback, 'post');
    }

    public function dispatch() :mixed {
        return "TEST";
    }

    public function getRoutes($routes)
    {
        return $this->routes;
    }
}
