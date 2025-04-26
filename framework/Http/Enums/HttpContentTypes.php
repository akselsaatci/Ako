<?php


namespace Framework\Http\Enums;


enum HttpContentTypes: string
{
    case TextHtml = "text/html";
    case TextPlain = "text/plain";
    case ApplicationJson = "application/json";
}
