<?php

declare(strict_types=1);

namespace App\public;

use Framework\Http\Context;
use Framework\Http\Enums\HttpContentTypes;
use Framework\Http\Kernel;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Http\Router\FileBasedRouteFinder;
use Framework\Http\Router\RouteContainer;
use Framework\Http\Router\Router;
use Framework\Logger\Handlers\FileLogHandler;
use Framework\Logger\Logger;

require_once dirname(__DIR__) . '../../vendor/autoload.php';

$request = Request::createFromGlobals();

$logHandler = new FileLogHandler(__DIR__ . "/logs.txt");
$logger = new Logger($logHandler);
$context = new Context($request, $logger);
$finder = new FileBasedRouteFinder($context);
$routes = $finder->getFileBasedPages(__DIR__ . '/Pages');
$container = new RouteContainer($context);

foreach ($routes as $route) {
    $container->registerRoute($route["method"], $route["route"], [$route["class"], $route["method"]]);
}

$router = new Router($container, $context);

$kernel = new Kernel($router, $request, $context);
$kernel->handle();
