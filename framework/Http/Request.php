<?php

namespace Framework\Http;


/** @package Framework\Http */
class Request
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
