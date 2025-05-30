<?php


namespace App\public;

use Framework\Http\PageAbstractClass;


class TestPage extends PageAbstractClass
{
    private $testParam = 11;

    public function render()
    {
?>
        <html>

        <body>
            <h1>AKSEL <?php echo $this->arguments["zort"] ?? "ZORT YOK LA"?>
            </h1>
        </body>

        </html>

<?php
    }
}
?>
