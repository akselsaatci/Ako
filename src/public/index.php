<?php

declare(strict_types=1);

namespace App\public;

use Framework\Http\Kernel;
use Framework\Http\Request;
use Framework\Http\Router\RouteContainer;
use Framework\Http\Router\Router;

require_once dirname(__DIR__) . '../../vendor/autoload.php';

$request = Request::createFromGlobals();

$container = new RouteContainer();
$container->get('/home/home', function () {
    echo 'HOMEEE';
});

$router = new Router($container);
$kernel = new Kernel($router, $request);
$kernel->handle();
