<?php

namespace Framework\Http\Router;

use Framework\Http\Context;

/** @package Framework\Http\Router */
class RouteContainer
{

    public array $routes;
    /**
     * @param Context $context 
     * @return void 
     */
    public function __construct(private Context $context) {}

    /**
     * @param string $route 
     * @return string 
     */
    private function validateRoute(string $route): string
    {
        if ($route[-1] != '/') {
            $route = $route . '/';
        }

        return $route;
    }

    /**
     * @param string $route 
     * @return array 
     */
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
     * @param string $route 
     * @param callable $handler 
     * @return RouteContainer 
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
     * @param string $route 
     * @param callable $handler 
     * @return RouteContainer 
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
     * @param string $route 
     * @param callable $handler 
     * @return RouteContainer 
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
     * @param string $route 
     * @param callable $handler 
     * @return RouteContainer 
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
     * @param string $route 
     * @param callable $handler 
     * @return RouteContainer 
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
     * @param string $method 
     * @param string $route 
     * @param callable $handler 
     * @return RouteContainer 
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

    /**
     * @param string $method 
     * @param string $route 
     * @return null|callable 
     */
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

                return function () use ($routeEntry, $params) {
                    return call_user_func($routeEntry['handler'], $params,$this->context);
                };
            }
        }

        return null;
    }
}
