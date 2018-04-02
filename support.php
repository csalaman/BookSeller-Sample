<?php

function generatePage($body, $title)
{
    $page = <<<EOPAGE
<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="mainstyle.css"/>
        <title>$title</title>
    </head>
    
    <body>
        $body

    </body>
</html>
EOPAGE;
    
    return $page;
}

?>