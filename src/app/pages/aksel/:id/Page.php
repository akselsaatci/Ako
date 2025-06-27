<?php

namespace App\app\pages;

use App\app\layouts\Layout;
use Framework\Http\Context;
use Framework\Http\Enums\HttpContentTypes;
use Framework\Http\PageAbstractClass;
use Framework\Http\Response;

class Page extends PageAbstractClass
{
    public static function get(array $arguments, Context $context): Response
    {
        $html = Page::renderPageHtmlWithLayout($arguments, $context, Layout::class);
        $respone = new Response(200, [],HttpContentTypes::TextHtml, $html);
        return $respone->send();
    }

    public static function post(array $arguments, Context $context)
    {
        Page::renderPageHtml($arguments, $context);
    }

    public function pageHtml()
    {
?>
        <html>

        <body>
            <h1>AKSEL <?php echo $this->arguments["id"] ?? "ZORT YOK LA" ?>
            </h1>
        </body>

        </html>

<?php
    }
}
