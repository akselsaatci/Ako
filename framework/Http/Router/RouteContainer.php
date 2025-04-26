<?php

namespace Framework\Http\Router\RouteContainer;

use Error;

class RouteContainer
{

    private array $routes;


    // MAKING THEM FLUEEEENTT
    public function get(string $route, $handler)
    {
        $this->routes["GET"][$route] = $handler;
    }
    public function post(string $route, $handler)
    {

        $this->routes["POST"][$route] = $handler;
    }
    public function put(string $route, $handler)
    {
        $this->routes["PUT"][$route] = $handler;
    }
    public function delete(string $route, $handler)
    {
        $this->routes["DELETE"][$route] = $handler;
    }
    public function patch(string $route, $handler)
    {
        $this->routes["PATCH"][$route] = $handler;
    }


    public function getHandler(string $route)
    {

        $handler = $this->routes[$route];

        if ($handler == null) {
            // TODO: Make custom errors and better error messages
            throw new Error("There is no route matching this route.");
        }
        return $handler;
    }
}
