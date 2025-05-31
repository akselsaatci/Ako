<?php



namespace App\app\pages;

use Framework\Http\Context;
use Framework\Http\PageAbstractClass;
use Framework\Http\Response;

class IndexPage extends PageAbstractClass
{
    public static function get(array $arguments, Context $context) : Response
    {
        $html = IndexPage::renderPageHtml($arguments, $context);
        $respone = new Response(200,[],$html);
        return $respone->send();
    }

    public static function post(array $arguments, Context $context)
    {
        IndexPage::renderPageHtml($arguments, $context);
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



