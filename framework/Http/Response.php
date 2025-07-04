<?php

namespace Framework\Http;

use Framework\Http\Enums\HttpContentTypes;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/** @package Framework\Http */
class Response 
{

    /* https://symfony.com/doc/current/components/http_foundation.html#response*/


    private int $statusCode;
    private array $headers;
    private string $content;
    const VERSION = 1.1;


    /**
     * @param int $statusCode 
     * @param array $headers 
     * @param null|string $content 
     * @return void 
     */
    function __construct(int $statusCode, array $headers,HttpContentTypes $httpContent, ?string $content = "")
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->content = $content;
        $this->setContentTypeHeader($httpContent);
    }



    /**
     * @param null|string $content 
     * @return $this 
     */
    public function setContent(?string $content)
    {
        $this->content = $content ?? '';

        return $this;
    }

    /** @return string|null  */
    public function getContent(): string | null
    {
        return $this->content;
    }

    /**
     * @param int $statusCode 
     * @return $this 
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /** @return int  */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param HttpContentTypes $type 
     * @return string 
     */
    public function setContentTypeHeader(HttpContentTypes $type)
    {
        return $this->headers["Content-Type"] = $type->value;
    }
    /** @return void  */
    private function prepareHeaders()
    {
        foreach ($this->headers as $header => $value) {
            header($header . ': ' . $value);
        }
        http_response_code($this->getStatusCode());
    }




    // TODO: Implement the set and prepare methods

    // Prepare is for validating the headers and overall of the request

    /** @return never  */
    public function send()
    {
        $this->prepareHeaders();
        echo $this->content;
        exit;
        
    }

    // TODO: Implement those 
    public function view(){}
    public function json(){}
    public function text(){}
}
