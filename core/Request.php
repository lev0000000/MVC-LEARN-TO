<?php

namespace PHPFramework;

class Request
{

    public string $uri;

    public function __construct($uri)
    {
        $this->uri = trim(urldecode($uri), '/');
    }

    public function getMethod(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public function isGet(): bool
    {
        return $this->getMethod() === 'GET';
    }
    public function isPost(): bool
    {
        return $this->getMethod() === 'POST';
    }

    public function get($name, $default = null): ?string
    {
        return $_GET[$name] ?? $default;
    }

    public function post($name, $default = null): ?string
    {
        return $_POST[$name] ?? $default;
    }

    public function getPath() :string
    {
      return $this->removeQueryPath($this->uri);
    }

    public function getData(){
        return $this->isPost() ? $_POST : $_GET;
    }

    protected function removeQueryPath($uri) :string
    {
        if ($uri){
            $params = explode('?', $uri);
            return trim($params[0],'/');
        }

        return '/';
    }

    public function isAjax(){
        
    }
}
