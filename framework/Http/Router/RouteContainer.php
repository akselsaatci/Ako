<?php

namespace Framework\Http\Router;

use Error;

class RouteContainer
{

    private array $routes;


    // MAKING THEM FLUEEEENTT
    public function get(string $route, callable $handler)
    {
        $this->routes["GET"][$route] = $handler;
        return $this;
    }
    public function post(string $route, callable $handler)
    {
        $this->routes["POST"][$route] = $handler;
        return $this;
    }
    public function put(string $route, callable  $handler)
    {
        $this->routes["PUT"][$route] = $handler;
        return $this;
    }
    public function delete(string $route, callable $handler)
    {
        $this->routes["DELETE"][$route] = $handler;
        return $this;
    }
    public function patch(string $route, callable $handler)
    {
        $this->routes["PATCH"][$route] = $handler;
        return $this;
    }


    public function getHandler(string $method, string $route)
    {
        // TODO: Should support dynamic paths ext... 
        $route = parse_url($route, PHP_URL_PATH);

        if (isset($this->routes[$method][$route])) {
            return $this->routes[$method][$route];
        }
        // TODO: get query params and also pass them ext.

        return null;
    }
}
