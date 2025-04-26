<?php

declare(strict_types=1);

namespace Framework\Http\Router;

use Exception;
use Framework\Http\Router\RouteContainer;

class Router
{

    private readonly RouteContainer $routeContainer;

    function __construct(RouteContainer $routeContainer)
    {
        $this->routeContainer = $routeContainer;
    }


    public function dispatch(string $method, string $path)
    {
        $handler = $this->routeContainer->getHandler($method, $path);

        if ($handler === null) {
            throw new Exception('404');
        }

        return $handler;
    }

    public function resolve($handler)
    {
        if (is_callable($handler)) {
            return $handler();
        }

        throw new \Exception('Invalid handler.');
    }
}
