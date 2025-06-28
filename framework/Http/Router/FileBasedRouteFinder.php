<?php

namespace Framework\Http\Router;

use Framework\Http\Context;
use Framework\Http\PageAbstractClass;

/** @package Framework\Http\Router */
class FileBasedRouteFinder
{
    private Context $context;

    /**
     * @param Context $context 
     * @return void 
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * @param string $dir 
     * @return array 
     */
    public function getFileBasedPages(string $dir): array
    {
        $result = $this->scanDirectory($dir, $dir);
        return $result;
    }

    /**
     * @param string $dir 
     * @param string $initDir 
     * @return array 
     */
    private function scanDirectory(string $dir, string $initDir): array
    {
        $result = [];

        foreach (scandir($dir) as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $fullPath = $dir . '/' . $file;
            $this->context->logger->alert($file);

            if (is_dir($fullPath)) {
                $subResult = $this->scanDirectory($fullPath, $initDir);
                $result = array_merge($result, $subResult);
                continue;
            }

            if (pathinfo($file, PATHINFO_EXTENSION) !== 'php') {
                continue;
            }

            require_once $fullPath;
            $className = pathinfo($file, PATHINFO_FILENAME);
            //FIX: TOO BAD IMPLEMENTED CHANGE THIS
            $selectedClass = "App\\app\\Pages\\$className";

            if (class_exists($selectedClass) && is_subclass_of($selectedClass, PageAbstractClass::class)) {


                $route = str_replace($initDir, "", $fullPath);
                $route = str_replace('.php', '', $route);
                $route = str_replace($className, '', $route);
                $route = ltrim($route, '/');
                $route = '/' . $route;

                $addResult = [
                    "method" => "get",
                    "route" => $route,
                    "class" => $selectedClass,
                    "handler" => null,
                ];

                $context = $this->context;

                if (method_exists($selectedClass, 'get')) {
                    $addResult["method"] = "GET";
                    $handler = $this->getHandlerMethod($context, $selectedClass, 'get');
                    $addResult["handler"] = $handler;
                    $result[] = $addResult;
                }
                if (method_exists($selectedClass, 'post')) {
                    $addResult["method"] = "POST";
                    $handler = $this->getHandlerMethod($context, $selectedClass, 'post');
                    $addResult["handler"] = $handler;
                    $result[] = $addResult;
                }
                if (method_exists($selectedClass, 'put')) {
                    $addResult["method"] = "PUT";
                    $handler = $this->getHandlerMethod($context, $selectedClass, 'put');
                    $addResult["handler"] = $handler;
                    $result[] = $addResult;
                }

                if (method_exists($selectedClass, 'delete')) {
                    $addResult["method"] = "DELETE";
                    $handler = $this->getHandlerMethod($context, $selectedClass, 'delete');
                    $addResult["handler"] = $handler;
                    $result[] = $addResult;
                }
            }
        }

        return $result;
    }

    private function getHandlerMethod(Context $context, string $selectedClass, string $method): callable
    {
        return function (...$params) use ($context, $selectedClass, $method) {
            $pageInstance = new $selectedClass($params[0] ?? [], $context);

            if (!method_exists($pageInstance, $method)) {
                throw new \Exception("Route handler for " . $selectedClass . "::" . $method . " is not valid.");
            }

            return call_user_func([$pageInstance, $method]);
        };
    }
}
