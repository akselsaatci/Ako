<?php

namespace Framework\Http;

use Exception;
use Framework\Http\Exceptions\RouteNotFoundException;
use Framework\Http\Request;
use Framework\Http\Router\Router;
use Psr\Log\LoggerInterface;
use Throwable;

/** @package Framework\Http */
class Kernel
{

    private readonly Router $router;
    private readonly Request $request;
    private readonly Context $context;
    private readonly LoggerInterface $logger;


    /**
     * @param Router $router 
     * @param Request $request 
     * @param Context $context 
     * @return void 
     */
    public function __construct(Router $router, Request $request, Context $context)
    {
        $this->router = $router;
        $this->request = $request;
        $this->context = $context;
        $this->logger = $this->context->logger;
        $this->logger->info("Ako Kernel Initilized Date : {datetime}", ["datetime" => date("h:i:sa")]);
    }

    /** @return void  */
    public function handle(): void
    {
        try {
            $handler =  $this->router->dispatch($this->request->getMethod(), $this->request->getUri());
            $response = $this->router->resolve($handler);
            $response->send();
        } catch (RouteNotFoundException $ex) {
            http_response_code(404);
            echo '404';
        } catch (Throwable $ex) {
            $this->context->logger->critical($ex);
            http_response_code(505);
            echo $ex;
        }
    }
}
