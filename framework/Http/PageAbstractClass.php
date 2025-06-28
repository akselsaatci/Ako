<?php

namespace Framework\Http;

/** @package Framework\Http */
abstract class PageAbstractClass
{

    protected array $arguments;
    protected Context $context;

    /**
     * @param array $arguments 
     * @param Context $context 
     * @return void 
     */
    public final function  __construct(array $arguments, Context $context)
    {
        $this->arguments = $arguments;
        $this->context = $context;
    }
    // FIX: Here i think it shouldn't be public but when i make it protected 
    // i cant call it from the global scope

    /** @return string  */
    protected final function renderPageHtml(): string
    {
        ob_start();
        $page = new $this($this->arguments, $this->context);
        $page->pageHtml();
        $content = ob_get_clean();
        return $content;
    }
    /**
     * @param LayoutInterface $layout 
     * @return string 
     */
    protected final function renderPageHtmlWithLayout(LayoutInterface $layout): string
    {
        ob_start();
        $page = new $this($this->arguments, $this->context);
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
