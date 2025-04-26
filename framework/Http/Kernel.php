<?php

namespace Framework\Http;

use Exception;
use Framework\Http\Request;
use Framework\Http\Router\Router;

class Kernel
{

    private readonly Router $router;
    private readonly Request $request;


    public function __construct($router, $request)
    {
        $this->router = $router;
        $this->request = $request;
    }

    public function handle()
    {
        try {
            $handler =  $this->router->dispatch($this->request->getMethod(), $this->request->getUri());
            $response = $this->router->resolve($handler);
            echo $response;
        } catch (Exception $ex) {
            echo '404';
        }
    }
}
