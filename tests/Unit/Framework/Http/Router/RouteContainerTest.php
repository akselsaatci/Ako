<?php

namespace Tests\Framework\Http\Router;

use Framework\Http\Router\RouteContainer;
use Framework\Http\Context;

beforeEach(function () {
    $this->context = $this->createMock(Context::class);
    $this->container = new RouteContainer($this->context);
});

test('registers and retrieves a GET route', function () {
    $called = false;
    $this->container->get('/home', function ($params, $context) use (&$called) {
        $called = true;
        return 'Hello, world!';
    });

    $handler = $this->container->getHandler('GET', '/home');
    expect($handler)->not->toBeNull();
    $result = $handler();
    expect($result)->toBe('Hello, world!');
    expect($called)->toBeTrue();
});

test('normalizes routes to end with a slash', function () {
    $this->container->get('/foo', fn() => 'bar');
    $handler = $this->container->getHandler('GET', '/foo');
    expect($handler)->not->toBeNull();
    expect($handler())->toBe('bar');
});

test('extracts parameters from route', function () {
    $receivedParams = null;
    $this->container->get('/user/:id', function ($params) use (&$receivedParams) {
        $receivedParams = $params;
        return 'user:' . $params['id'];
    });
    $handler = $this->container->getHandler('GET', '/user/42');
    expect($handler)->not->toBeNull();
    $result = $handler();
    expect($result)->toBe('user:42');
    expect($receivedParams)->toBe(['id' => '42']);
});

test('returns null for unknown method', function () {
    $this->container->get('/foo', fn() => 'bar');
    $handler = $this->container->getHandler('POST', '/foo');
    expect($handler)->toBeNull();
});

test('returns null for unknown route', function () {
    $this->container->get('/foo', fn() => 'bar');
    $handler = $this->container->getHandler('GET', '/unknown');
    expect($handler)->toBeNull();
});

test('registers and retrieves POST, PUT, DELETE, PATCH routes', function () {
    $this->container->post('/p', fn() => 'post');
    $this->container->put('/u', fn() => 'put');
    $this->container->delete('/d', fn() => 'delete');
    $this->container->patch('/pa', fn() => 'patch');
    
    expect($this->container->getHandler('POST', '/p')())->toBe('post');
    expect($this->container->getHandler('PUT', '/u')())->toBe('put');
    expect($this->container->getHandler('DELETE', '/d')())->toBe('delete');
    expect($this->container->getHandler('PATCH', '/pa')())->toBe('patch');
});

test('registerRoute works for custom methods', function () {
    $this->container->registerRoute('OPTIONS', '/opt', fn() => 'options');
    $handler = $this->container->getHandler('OPTIONS', '/opt');
    expect($handler)->not->toBeNull();
    expect($handler())->toBe('options');
});

test('handler receives context instance', function () {
    $receivedContext = null;
    $this->container->get('/ctx', function ($params, $context) use (&$receivedContext) {
        $receivedContext = $context;
        return 'ok';
    });
    $handler = $this->container->getHandler('GET', '/ctx');
    $handler();
    expect($receivedContext)->toBe($this->context);
});
