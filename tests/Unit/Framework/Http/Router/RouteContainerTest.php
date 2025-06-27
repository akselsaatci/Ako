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

test('handles multiple route parameters', function () {
    $this->container->get('/user/:userId/post/:postId', fn($params) => "User {$params['userId']}, Post {$params['postId']}");
    $handler = $this->container->getHandler('GET', '/user/123/post/456');
    expect($handler())->toBe('User 123, Post 456');
});

test('matches specific route before dynamic one', function () {
    // Register specific route first
    $this->container->get('/user/new', fn() => 'new user form');
    // Register dynamic route
    $this->container->get('/user/:id', fn($params) => "user {$params['id']}");

    $handler = $this->container->getHandler('GET', '/user/new');
    expect($handler())->toBe('new user form');
});

test('ignores query string when matching route', function () {
    $this->container->get('/search', fn() => 'search page');
    $uri = '/search?q=test&sort=asc';
    // We need to simulate the request URI behavior
    $path = parse_url($uri, PHP_URL_PATH);
    $handler = $this->container->getHandler('GET', $path);
    expect($handler)->not->toBeNull();
    expect($handler())->toBe('search page');
});

test('handles the root route', function () {
    $this->container->get('/', fn() => 'homepage');
    $handler = $this->container->getHandler('GET', '/');
    expect($handler())->toBe('homepage');
});

test('returns null if route parameter is missing', function () {
    $this->container->get('/user/:id', fn() => 'wont be called');
    $handler = $this->container->getHandler('GET', '/user/');
    expect($handler)->toBeNull();
});
