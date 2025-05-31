<?php

namespace Framework\Http\Router;

use Framework\Http\Context;

class RouteContainer
{

    public array $routes;
    public function __construct(private Context $context) {}
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

    private function getRegexAndParameters(string $route): array
    {
        preg_match_all('#:([\w]+)#', $route, $matches);
        $paramNames = $matches[1];

        foreach ($paramNames as $paramName) {
            $route = str_replace(':' . $paramName, '([^/]+)', $route);
        }

        $regex = '#^' . $route . '$#';

        return [
            'regex' => $regex,
            'paramNames' => $paramNames,
        ];
    }



    /**
     * @param callable(): mixed $handler
     */
    public function get(string $route, callable $handler): RouteContainer
    {
        $route = $this->validateRoute($route);

        $regexAndParameters = $this->getRegexAndParameters($route);

        $this->routes["GET"][] = [
            'pattern' => $route,
            'regex' => $regexAndParameters['regex'],
            'paramNames' => $regexAndParameters['paramNames'],
            'handler' => $handler,
        ];

        return $this;
    }
    /**
     * @param callable(): mixed $handler
     */
    public function post(string $route, callable $handler): RouteContainer
    {
        $route = $this->validateRoute($route);

        $regexAndParameters = $this->getRegexAndParameters($route);

        $this->routes["POST"][] = [
            'pattern' => $route,
            'regex' => $regexAndParameters['regex'],
            'paramNames' => $regexAndParameters['paramNames'],
            'handler' => $handler,
        ];

        return $this;
    }
    /**
     * @param callable(): mixed $handler
     */
    public function put(string $route, callable  $handler): RouteContainer
    {
        $route = $this->validateRoute($route);

        $regexAndParameters = $this->getRegexAndParameters($route);

        $this->routes["PUT"][] = [
            'pattern' => $route,
            'regex' => $regexAndParameters['regex'],
            'paramNames' => $regexAndParameters['paramNames'],
            'handler' => $handler,
        ];

        return $this;
    }
    /**
     * @param callable(): mixed $handler
     */
    public function delete(string $route, callable $handler): RouteContainer
    {
        $route = $this->validateRoute($route);

        $regexAndParameters = $this->getRegexAndParameters($route);

        $this->routes["DELETE"][] = [
            'pattern' => $route,
            'regex' => $regexAndParameters['regex'],
            'paramNames' => $regexAndParameters['paramNames'],
            'handler' => $handler,
        ];

        return $this;
    }
    /**
     * @param callable(): mixed $handler
     */
    public function patch(string $route, callable $handler): RouteContainer
    {
        $route = $this->validateRoute($route);

        $regexAndParameters = $this->getRegexAndParameters($route);

        $this->routes["PATCH"][] = [
            'pattern' => $route,
            'regex' => $regexAndParameters['regex'],
            'paramNames' => $regexAndParameters['paramNames'],
            'handler' => $handler,
        ];

        return $this;
    }

    /**
     * @param callable(): mixed $handler
     */
    public function registerRoute(string $method, string $route, callable $handler): RouteContainer
    {
        $route = $this->validateRoute($route);

        $regexAndParameters = $this->getRegexAndParameters($route);

        $this->routes[$method][] = [
            'pattern' => $route,
            'regex' => $regexAndParameters['regex'],
            'paramNames' => $regexAndParameters['paramNames'],
            'handler' => $handler,
        ];

        return $this;
    }

    public function getHandler(string $method, string $route): ?callable
    {
        if ($route[-1] != '/') {
            $route .= '/';
        }

        if (!isset($this->routes[$method])) {

            return null;
        }

        foreach ($this->routes[$method] as $routeEntry) {

            if (preg_match($routeEntry['regex'], $route, $matches)) {
                array_shift($matches);
                $params = array_combine($routeEntry['paramNames'], $matches);
                $context = $this->context;

                return function () use ($routeEntry, $params) {
                    return call_user_func($routeEntry['handler'], $params,$this->context);
                };
            }
        }

        return null;
    }
}
