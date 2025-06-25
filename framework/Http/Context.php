<?php

namespace Framework\Http;

use Exception;
use Psr\Log\LoggerInterface;

/** @package Framework\Http */
class Context
{
    // I want to use this class as a shared utilites like logger
    // I should make an standart enum for some of the standard utilites like logger

    private array $services = [];

    public Request $request;
    public LoggerInterface $logger;

    /**
     * @param Request $request 
     * @param LoggerInterface $logger 
     * @return void 
     */
    public function  __construct(Request $request, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->request = $request;
    }
    
    /**
     * @param string $key 
     * @param mixed $service 
     * @return void 
     */
    public function set(string $key, mixed $service): void
    {
        $this->services[$key] = $service;
    }

    /**
     * @param string $key 
     * @return mixed 
     * @throws Exception 
     */
    public function get(string $key): mixed
    {
        if (!isset($this->services[$key])) {
            throw new Exception("Service " . $key . " not found.");
        }
        return $this->services[$key];
    }
}
