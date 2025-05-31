<?php

namespace Framework\Http;

use Exception;
use Framework\Http\Exceptions\RouteNotFoundException;
use Framework\Http\Request;
use Framework\Http\Router\Router;
use Psr\Log\LoggerInterface;

class Kernel
{

    private readonly Router $router;
    private readonly Request $request;
    private readonly Context $context;
    private readonly LoggerInterface $logger;


    public function __construct(Router $router, Request $request, Context $context)
    {
        $this->router = $router;
        $this->request = $request;
        $this->context = $context;
        $this->logger = $this->context->logger;

        $this->logger->info("Ako Kernel Initilized Date : {datetime}", ["datetime" => date("h:i:sa")]);
    }

    public function handle(): void
    {
        try {
            $handler =  $this->router->dispatch($this->request->getMethod(), $this->request->getUri());
            $response = $this->router->resolve($handler);
            echo $response;
        } catch (RouteNotFoundException $ex) {
            echo '404';
        }
    }
}
