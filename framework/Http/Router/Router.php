<?php

namespace Framework\Http\Router;

use Exception;
use Framework\Http\Context;
use Framework\Http\Exceptions\RouteNotFoundException;
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

        if ($handler === null) {
            $this->context->logger->info($method . ' for ' . $path . ' not found!');
            throw new RouteNotFoundException($method . ' for ' . $path . ' not found!');
        }

        return $handler;
    }

    public function resolve($handler):mixed
    {
        if (is_callable($handler)) {
            return $handler();
        }

        throw new Exception('Invalid handler.');
    }
}
