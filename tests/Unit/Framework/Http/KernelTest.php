<?php

namespace Tests\Unit\Framework\Http;

use Exception;
use Framework\Http\Context;
use Framework\Http\Exceptions\RouteNotFoundException;
use Framework\Http\Kernel;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Http\Router\Router;
use Psr\Log\LoggerInterface;

beforeEach(function () {
    $this->router = $this->createMock(Router::class);
    $this->request = $this->createMock(Request::class);
    $this->context = $this->createMock(Context::class);
    $this->logger = $this->createMock(LoggerInterface::class);

    $this->context->logger = $this->logger;
});

test('kernel initialization logs info message', function() {
    $this->logger->expects($this->once())
        ->method('info')
        ->with($this->stringContains('Ako Kernel Initilized'));

    new Kernel($this->router, $this->request, $this->context);
});

test('handle successfully dispatches request and sends response', function () {
    // To avoid issues with the constructor log expectation from other tests
    $this->logger->method('info');
    $kernel = new Kernel($this->router, $this->request, $this->context);

    $method = 'GET';
    $uri = '/';
    $handler = fn() => 'dummy handler';
    $response = $this->createMock(Response::class);

    $this->request->method('getMethod')->willReturn($method);
    $this->request->method('getUri')->willReturn($uri);

    $this->router->expects($this->once())
        ->method('dispatch')
        ->with($method, $uri)
        ->willReturn($handler);

    $this->router->expects($this->once())
        ->method('resolve')
        ->with($handler)
        ->willReturn($response);

    $response->expects($this->once())->method('send');

    $kernel->handle();
});

test('handle catches RouteNotFoundException and returns 404', function () {
    $this->logger->method('info');
    $kernel = new Kernel($this->router, $this->request, $this->context);

    $method = 'GET';
    $uri = '/not-found';

    $this->request->method('getMethod')->willReturn($method);
    $this->request->method('getUri')->willReturn($uri);

    $this->router->method('dispatch')
        ->with($method, $uri)
        ->willThrowException(new RouteNotFoundException());

    ob_start();
    $kernel->handle();
    $output = ob_get_clean();

    expect($output)->toBe('404');
});

test('handle catches generic throwable and returns 500 level error', function () {
    $this->logger->method('info');
    $kernel = new Kernel($this->router, $this->request, $this->context);

    $method = 'GET';
    $uri = '/error';
    $exception = new Exception("Something went wrong");

    $this->request->method('getMethod')->willReturn($method);
    $this->request->method('getUri')->willReturn($uri);

    $this->router->method('dispatch')
        ->with($method, $uri)
        ->willThrowException($exception);

    $this->logger->expects($this->once())
        ->method('critical')
        ->with($exception);

    ob_start();
    $kernel->handle();
    $output = ob_get_clean();

    expect($output)->toBe((string) $exception);
});
