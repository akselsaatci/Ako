<?php

namespace Framework\Http\Router;


class RouteContainer
{

    private array $routes;
    /**
     * @param mixed $route
     */
    private function validateRoute($route): string
    {
        if ($route[-1] != '/') {
            $route = $route . '/';
        }

        return $route;
    }
    /**
     * @param callable(): mixed $handler
     */
    public function get(string $route, callable $handler): RouteContainer
    {
        $route = $this->validateRoute($route);
        $this->routes["GET"][$route] = $handler;
        return $this;
    }
    /**
     * @param callable(): mixed $handler
     */
    public function post(string $route, callable $handler): RouteContainer
    {
        $route = $this->validateRoute($route);
        $this->routes["POST"][$route] = $handler;
        return $this;
    }
    /**
     * @param callable(): mixed $handler
     */
    public function put(string $route, callable  $handler): RouteContainer
    {
        $route = $this->validateRoute($route);
        $this->routes["PUT"][$route] = $handler;
        return $this;
    }
    /**
     * @param callable(): mixed $handler
     */
    public function delete(string $route, callable $handler): RouteContainer
    {
        $route = $this->validateRoute($route);
        $this->routes["DELETE"][$route] = $handler;
        return $this;
    }
    /**
     * @param callable(): mixed $handler
     */
    public function patch(string $route, callable $handler): RouteContainer
    {
        $route = $this->validateRoute($route);
        $this->routes["PATCH"][$route] = $handler;
        return $this;
    }


    public function getHandler(string $method, string $route): callable | null
    {
        if ($route[-1] != '/') {
            $route = $route . '/';
        }

        // TODO: Should support dynamic paths ext... 
        $route = parse_url($route, PHP_URL_PATH);


        if (isset($this->routes[$method][$route])) {
            return $this->routes[$method][$route];
        }
        // TODO: get query params and also pass them ext.

        return null;
    }
}
