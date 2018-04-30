<?php

require_once("support.php");
require_once("dbAccessInfo.php");
require_once("DatabaseInstance.php");
require_once("navbar.php");

error_reporting(E_ERROR | E_PARSE);

$navbar = navbar();

$body = <<< EOBODY
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Book Sellers</title>
        <meta charset="UTF-8">
        <link rel="icon" href="bootstrap/images/book.png">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="bootstrap/css/mainstyle.css">
    </head>

    <body>
        $navbar

        <header>
            <h1>My Books</h1><hr>
        </header>
        

        <div class="list-group">
            $bookList
            <form action="newItem.php" method="get">
                <input class='btn-lg' type="submit" value="New Book Submission"/>
            </form>
        </div>

        <script src="bootstrap/jquery-3.3.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <footer>Copyright &copy; Book Sellers</footer>
    </body>
</html>
EOBODY;

echo $body;
?>