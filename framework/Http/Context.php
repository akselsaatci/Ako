<?php

namespace Framework\Http;

use Exception;

class Context
{
    // I want to use this class as a shared utilites like logger
    // I should make an standart enum for some of the standard utilites like logger

    private array $services = [];

    public function set(string $key, mixed $service): void
    {
        $this->services[$key] = $service;
    }

    public function get(string $key): mixed
    {
        if (!isset($this->services[$key])) {
            throw new Exception("Service " . $key . " not found.");
        }
        return $this->services[$key];
    }
}
