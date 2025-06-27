<?php

namespace Framework\Http;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\StreamInterface;

/** @package Framework\Http */
class Request implements RequestInterface
{

    /* https://symfony.com/doc/current/components/http_foundation.html#request */

    private array $get;
    private array $post;
    private array $cookie;
    private array $files;
    private array $server;

    /**
     * @param array $GET 
     * @param array $POST 
     * @param array $COOKIE 
     * @param array $FILES 
     * @param array $SERVER 
     * @return void 
     */
    function __construct(array $GET, array  $POST, array  $COOKIE, array  $FILES, array  $SERVER)
    {
        $this->get = $GET;
        $this->post =  $POST;
        $this->cookie =  $COOKIE;
        $this->files =  $FILES;
        $this->server =  $SERVER;
    }

    public function getRequestTarget(): string { }

    public function withRequestTarget(string $requestTarget): RequestInterface { }

    public function withMethod(string $method): RequestInterface { }

    public function withUri(UriInterface $uri, bool $preserveHost = false): RequestInterface { }

    public function getProtocolVersion(): string { }

    public function withProtocolVersion(string $version): MessageInterface { }

    public function getHeaders(): array { }

    public function hasHeader(string $name): bool { }

    public function getHeader(string $name): array { }

    public function getHeaderLine(string $name): string { }

    public function withHeader(string $name, $value): MessageInterface { }

    public function withAddedHeader(string $name, $value): MessageInterface { }

    public function withoutHeader(string $name): MessageInterface { }

    public function getBody(): StreamInterface { }

    public function withBody(StreamInterface $body): MessageInterface { }

    /** @return Request  */
    public static function createFromGlobals(): Request
    {
        return new self($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
    }

    /** @return mixed  */
    public function getMethod()
    {

        return $this->server["REQUEST_METHOD"];
    }


    /** @return mixed  */
    public function getUri()
    {

        return $this->server["REQUEST_URI"];
    }
}
