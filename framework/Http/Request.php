<?php

namespace Framework\Http;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\StreamInterface;

/** @package Framework\Http */
class Request 
{

    /* https://symfony.com/doc/current/components/http_foundation.html#request */

    private array $get;
    private array $post;
    private array $cookie;
    private array $files;
    private array $server;
    private array $headers;
    private string $version;
    private string $method;
    private string $uri;

    /**
     * @param array $GET 
     * @param array $POST 
     * @param array $COOKIE 
     * @param array $FILES 
     * @param array $SERVER 
     * @return void 
     */
    function __construct(array $GET, array  $POST, array  $COOKIE, array  $FILES, array  $SERVER, ?string $VERSION)
    {
        $this->get = $GET;
        $this->post =  $POST;
        $this->cookie =  $COOKIE;
        $this->files =  $FILES;
        $this->server =  $SERVER;
        $this->headers =  getallheaders();
        //FIX: Fix this later
        $this->version = $VERSION ?? "1.0";
        $this->method = $SERVER['REQUEST_METHOD'];
        $this->uri = $SERVER["REQUEST_URI"];
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): UriInterface {}

    private function setMethod(string $method)
    {

        $this->method = $method;
        $this->server['REQUEST_METHOD'] = $method;
    }

    private function setUri(string $uri)
    {

        $this->uri = $uri;
        $this->server['REQUEST_URI'] = $uri;
    }


    public function getRequestTarget(): string
    {
        return $this->uri;
    }

    public function withRequestTarget(string $requestTarget): RequestInterface
    {

        $newRequest = unserialize(serialize($this));
        $newRequest->setUri($requestTarget);
        return $newRequest;
    }

    public function withMethod(string $method): RequestInterface
    {
        $newRequest = unserialize(serialize($this));
        $newRequest->setMethod($method);
        return $newRequest;
    }

    public function withUri(UriInterface $uri, bool $preserveHost = false): RequestInterface {}

    public function getProtocolVersion(): string
    {
        return $this->version;
    }

    public function withProtocolVersion(string $version): MessageInterface {
        $newRequest = unserialize(serialize($this));
        $newRequest->$version = $version;
        return $newRequest;

}

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function hasHeader(string $name): bool
    {
        if ($this->headers[strtolower($name)] != null) {
            return true;
        }
        return false;
    }

    public function getHeader(string $name): array
    {
        return $this->headers[strtolower($name)] ?? [];
    }

    public function getHeaderLine(string $name): string
    {
        return implode(',', $this->headers[strtolower($name)] ?? []);
    }

    public function withHeader(string $name, $value): MessageInterface
    {

        $newRequest = unserialize(serialize($this));
        $newRequest->headers[$name] = $value;
        return $newRequest;
    }

    public function withAddedHeader(string $name, $value): MessageInterface
    {
        $newValues = is_array($value) ? array_values($value) : [$value];
        $newRequest = unserialize(serialize($this));

        foreach ($newRequest->headers as $key => $existingValues) {
            if (strtolower($key) === strtolower($name)) {
                $newRequest->headers[$key] = array_merge($existingValues, $newValues);
                return $newRequest;
            }
        }
        $newRequest->headers[$name] = $newValues;
        return $newRequest;
    }

    public function withoutHeader(string $name): MessageInterface
    {

        $newRequest = unserialize(serialize($this));
        unset($newRequest->headers[strtolower($name)]);
        return $newRequest;
    }

    public function getBody(): StreamInterface {}

    public function withBody(StreamInterface $body): MessageInterface {}

    /** @return Request  */
    public static function createFromGlobals(): Request
    {
        return new self($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER, null);
    }
}
