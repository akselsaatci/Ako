<?php

namespace App\app\layouts;

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
            <link rel="stylesheet" href="/output.css">
            <?php echo $arguments["styles"] ?? "" ?>
            <link rel="icon" href="./favicon.ico" type="image/x-icon">
        </head>

        <body class="min-h-screen bg-background text-foreground">
            <?php echo $arguments["body"] ?? "" ?>

            <script src="<?php echo $arguments["script"] ?? "" ?>"></script>

        </body>

        </html>
<?php
    }
}
