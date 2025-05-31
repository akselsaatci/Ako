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
    // FIX: Here i think it shouldn't be public but when i make it protected 
    // i cant call it from the global scope
    public static function  renderPageHtml(array $arguments, Context $context): string
    {
        ob_start();
        $page = new static($arguments, $context);
        $page->pageHtml();
        $content = ob_get_clean();
        return $content;
    }
    public static function renderPageHtmlWithLayout(array $arguments, Context $context, mixed $layout): string
    {
        ob_start();
        $page = new static($arguments, $context);
        $page->pageHtml();
        $content = ob_get_clean();

        ob_start();
        $arguments["body"] = $content;
        $layout = $layout::getLayout($arguments);
        $layout = ob_get_clean();

        return $layout;
    }

    public abstract function pageHtml();
    /* public static function get(array $arguments, Context $context) {} */
    /* public static function post(array $arguments, Context $context) {} */
    /* public static function patch(array $arguments, Context $context) {} */
    /* public static function put(array $arguments, Context $context) {} */
}
