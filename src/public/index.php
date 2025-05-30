<?php

declare(strict_types=1);

namespace App\public;

use Framework\Http\Enums\HttpContentTypes;
use Framework\Http\Kernel;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Http\Router\RouteContainer;
use Framework\Http\Router\Router;
use Framework\Logger\Handlers\FileLogHandler;
use Framework\Logger\Logger;

require_once dirname(__DIR__) . '../../vendor/autoload.php';

$request = Request::createFromGlobals();

$container = new RouteContainer();
$container->get('/aksel/', function () {
    $response = new Response(200,[],"");
    $response->setContentTypeHeader(HttpContentTypes::TextHtml);
    $response->setContent('<!doctypehtml><h2>HTML Forms</h2><form action=/action_page.php><label for=fname>First name:</label><br><input value=John id=fname name=fname><br><label for=lname>Last name:</label><br><input value=Doe id=lname name=lname><br><br><input value=Submit type=submit></form><p>If you click the "Submit" button, the form-data will be sent to a page called "/action_page.php".');
    $response->send();
});

$router = new Router($container);
$logHandler = new FileLogHandler(__DIR__ . "/logs.txt");
$logger = new Logger($logHandler);
$kernel = new Kernel($router, $request,$logger);
$kernel->handle();
