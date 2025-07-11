<?php

namespace Tests\Unit\Framework\Http\Router;

use Exception;
use Framework\Http\Context;
use Framework\Http\Enums\HttpContentTypes;
use Framework\Http\Exceptions\RouteNotFoundException;
use Framework\Http\Response;
use Framework\Http\Router\RouteContainer;
use Framework\Http\Router\Router;
use Psr\Log\LoggerInterface;

beforeEach(function () {
    $this->routeContainer = $this->createMock(RouteContainer::class);
    $this->logger = $this->createMock(LoggerInterface::class);
    $this->context = $this->createMock(Context::class);
    $this->context->logger = $this->logger;
    $this->router = new Router($this->routeContainer, $this->context);
});

test('dispatch returns handler for existing route', function () {
    $handler = fn() => new Response(200, [], HttpContentTypes::TextPlain, 'OK');
    $this->routeContainer->method('getHandler')->with('GET', '/test')->willReturn($handler);

    $result = $this->router->dispatch('GET', '/test');

    expect($result)->toBe($handler);
});

test('dispatch throws exception for non-existing route', function () {
    $this->routeContainer->method('getHandler')->with('GET', '/not-found')->willReturn(null);

    $this->logger->expects($this->once())
        ->method('info')
        ->with('GET for /not-found not found!');

    $this->router->dispatch('GET', '/not-found');
})->throws(RouteNotFoundException::class, 'GET for /not-found not found!');

test('resolve executes callable handler', function () {
    $response = new Response(200, [], HttpContentTypes::TextPlain, 'Success');
    $handler = fn() => $response;

    $result = $this->router->resolve($handler);

    expect($result)->toBe($response);
});

test('resolve throws exception for non-callable handler', function () {
    $this->router->resolve('not a callable');
})->throws(Exception::class, 'Invalid handler.');
