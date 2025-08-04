<?php

namespace Framework\Http\Router;

use Exception;
use Framework\Http\Context;
use Framework\Http\Exceptions\RouteNotFoundException;
use Framework\Http\Response;
use Framework\Http\Router\RouteContainer;
use Psr\Http\Message\ResponseInterface;

/** @package Framework\Http\Router */
class Router
{

    private readonly RouteContainer $routeContainer;
    private readonly Context $context;

    /**
     * @param RouteContainer $routeContainer 
     * @param Context $context 
     * @return void 
     */
    function __construct(RouteContainer $routeContainer, Context $context)
    {
        $this->routeContainer = $routeContainer;
        $this->context = $context;
    }


    /**
     * @param string $method 
     * @param string $path 
     * @return callable 
     * @throws RouteNotFoundException 
     */
    public function dispatch(string $method, string $path): callable
    {
        $handler = $this->routeContainer->getHandler($method, $path);

        if ($handler === null) {
            $this->context->logger->info($method . ' for ' . $path . ' not found!');
            throw new RouteNotFoundException($method . ' for ' . $path . ' not found!');
        }

        return $handler;
    }

    /**
     * @param mixed $handler 
     * @return Response
     * @throws Exception 
     */
    public function resolve($handler): ResponseInterface
    {
        if (is_callable($handler)) {
            return $handler();
        }

        throw new Exception('Invalid handler.');
    }
}
