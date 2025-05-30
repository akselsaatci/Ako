<?php

namespace Framework\Http\Router;

use Exception;
use Framework\Http\Context;
use Framework\Http\Router\RouteContainer;

class Router
{

    private readonly RouteContainer $routeContainer;
    private readonly Context $context;

    function __construct(RouteContainer $routeContainer, Context $context)
    {
        $this->routeContainer = $routeContainer;
        $this->context = $context;
    }


    public function dispatch(string $method, string $path): callable
    {
        $handler = $this->routeContainer->getHandler($method, $path);

        //WARNING: It is a so bad way to use should change this logger

        $this->context->get('logger')->warning('PATH :' . $path . "\n");

        if ($handler === null) {
            throw new Exception('404');
        }

        return $handler;
    }

    public function resolve($handler): callable
    {
        if (is_callable($handler)) {
            return $handler();
        }

        throw new Exception('Invalid handler.');
    }
}
