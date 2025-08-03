<?php



namespace App\app\pages;

use App\app\layouts\Layout;
use Framework\Http\Context;
use Framework\Http\Enums\HttpContentTypes;
use Framework\Http\PageAbstractClass;
use Framework\Http\Response;

class IndexPage extends PageAbstractClass
{
    public function get(): Response
    {

        $html = $this->renderPageHtmlWithLayout(new Layout());
        $respone = new Response(200, [], HttpContentTypes::TextHtml,  $html);
        return $respone;
    }

    public function post(): Response
    {
        $html = $this->renderPageHtmlWithLayout(new Layout());
        $respone = new Response(200, [], HttpContentTypes::TextHtml, $html);
        return $respone;
    }

    public function pageHtml()
    {

        $opcacheData =       var_dump(opcache_get_status()['jit']);

?>
        <html>

        <body>
            <h1>AKSEL <?php echo $this->arguments["id"] ?? "ZORT YOK LA" ?>
            </h1>
            <p><?php echo $opcacheData ?></p>
        </body>

        </html>

<?php
    }
}
