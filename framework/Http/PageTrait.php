<?php

namespace Framework\Http;

trait PageTrait
{
    public static function  initPage(): string
    {
        ob_start();
        $page = new static();
        $page->render();
        $content = ob_get_clean();
        return $content;
    }
    public function render() {}
}
