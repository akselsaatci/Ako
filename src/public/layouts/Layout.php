<?php

namespace App\public\layouts;

use Framework\Http\LayoutInterface;

class Layout implements LayoutInterface
{
    public static function getLayout(array $arguments): void
    {
?>
        <!DOCTYPE html>
        <html lang="<?php echo $arguments["lang"] ?? "en" ?>">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title><?php echo $arguments["Title"] ?? "My Ako Framework Application" ?></title>
            <?php echo $arguments["styles"] ?? "" ?>
            <link rel="icon" href="./favicon.ico" type="image/x-icon">
        </head>

        <body>
            <?php echo $arguments["body"] ?? "" ?>
            <?php echo $arguments["scripts"] ?? "" ?>
        </body>

        </html>
<?php
    }
}
