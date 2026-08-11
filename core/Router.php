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

    public function add($path, $callback, $method): self
    {

        if (is_array($method)) {
            $method = array_map('strtoupper', $method);
        } else {
            $method = [strtoupper($method)];
        }
        $this->routes[] = [
            'path' => "/$path",
            'callback' => $callback,
            'middleware' => '',
            'method' => $method,
            'needToken' => true,
        ];

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
        $path = $this->request->getPath(); // из класса реквест получаем патч роута 
        $route = $this->matchRoutes($path); // мэтчим роут 
        if(!$route){
            abort('404 Not Found', 404);
        }
        if(is_array($route['callback'])){
            $route['callback'][0] = new $route['callback'][0];
        }
        return call_user_func($route['callback']); // вызываем колбэк роута 
    }

    public function getRoutes($routes)
    {
        return $this->routes;
    }

    protected function matchRoutes($path):mixed
    {
        foreach ($this->routes as $route) {
            if(
                preg_match("#^{$route['path']}$#", "/{$path}", $matches) && in_array($this->request->getMethod(), $route['method'])){
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $this->route_params[$key] = $match;
                    }
                }

                return $route;
            }
        }

        return false;
    }
}
