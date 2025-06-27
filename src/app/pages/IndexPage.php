<?php



namespace App\app\pages;

use App\app\layouts\Layout;
use Framework\Http\Context;
use Framework\Http\Enums\HttpContentTypes;
use Framework\Http\PageAbstractClass;
use Framework\Http\Response;

class IndexPage extends PageAbstractClass
{
    /**
     * @param array $arguments 
     * @param Context $context 
     * @return Response 
     */
    public static function get(array $arguments, Context $context): Response
    {
        $html = Page::renderPageHtmlWithLayout($arguments, $context, Layout::class);
        $respone = new Response(200, [], HttpContentTypes::TextHtml,  $html);
        return $respone;
    }

    public static function post(array $arguments, Context $context): Response
    {
        $html = Page::renderPageHtmlWithLayout($arguments, $context, Layout::class);
        $respone = new Response(200, [], HttpContentTypes::TextHtml, $html);
        return $respone;
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
