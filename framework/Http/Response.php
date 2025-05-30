<?php

namespace Framework\Http;

use Framework\Http\Enums\HttpContentTypes;

class Response
{

    /* https://symfony.com/doc/current/components/http_foundation.html#response*/


    private int $statusCode;
    private array $headers;
    private string $content;
    const VERSION = 1.1;


    function __construct(int $statusCode, array $headers, ?string $content = "")
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->content = $content;
    }


    public function setContent(?string $content)
    {
        $this->content = $content ?? '';

        return $this;
    }

    public function getContent(): string | null
    {
        return $this->content;
    }

    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setContentTypeHeader(HttpContentTypes $type)
    {
        return $this->headers["Content-Type"] = $type->value;
    }
    private function prepareHeaders()
    {
        foreach ($this->headers as $header => $value) {
            header($header, $value);
        }
        http_response_code($this->getStatusCode());
    }




    // TODO: Implement the set and prepare methods

    // Prepare is for validating the headers and overall of the request

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
