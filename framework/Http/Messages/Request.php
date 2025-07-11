<?php

namespace Framework\Http\Messages;


use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\StreamInterface;

/** @package Framework\Http */
class Request implements RequestInterface
{
    use MessageTrait;

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
        $this->version = $VERSION ?? "1.0";
        $this->method = $SERVER['REQUEST_METHOD'];
        $this->uri = $SERVER["REQUEST_URI"];
    }

    private function deepCopySelf(): Request
    {
        $newRequest = unserialize(serialize($this));
        return $newRequest;
    }

    public function withRequestTarget(string $requestTarget): RequestInterface {}

    public function withUri(UriInterface $uri, bool $preserveHost = false): RequestInterface {}

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
    public function withMethod(string $method): RequestInterface
    {
        $newRequest = $this->deepCopySelf();
        $newRequest->method = $method;
        return $newRequest;
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

    /** @return Request  */
    public static function createFromGlobals(): Request
    {
        return new self($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER, null);
    }
}
