<?php

namespace Framework\Http\Request;


class Request
{

    /* https://symfony.com/doc/current/components/http_foundation.html#request */

    private array $get;
    private array $post;
    private array $cookie;
    private array $files;
    private array $server;

    function __construct(array $GET, array  $POST, array  $COOKIE, array  $FILES, array  $SERVER)
    {
        $this->get = $GET;
        $this->post =  $POST;
        $this->cookie =  $COOKIE;
        $this->files =  $FILES;
        $this->server =  $SERVER;
    }

    public static function createFromGlobals() : Request
    {
        return new self($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
    }
}
