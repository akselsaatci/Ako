<?php

namespace Framework\Http;

abstract class PageAbstractClass
{

    protected array $arguments;
    protected Context $context;

    public function  __construct(array $arguments, Context $context)
    {
        $this->arguments = $arguments;
        $this->context = $context;
    }
    public static function  initPage(array $arguments, Context $context): string
    {
        ob_start();
        $page = new static($arguments, $context);
        $page->render();
        $content = ob_get_clean();
        return $content;
    }
    public abstract function render();
}

