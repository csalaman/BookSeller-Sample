<?php

require_once("support.php");
require_once("dbAccessInfo.php");
require_once("DatabaseInstance.php");
require_once("navbar.php");

error_reporting(E_ERROR | E_PARSE);

$bookList = "";
$seller = $user_table->getUserByUsername($_SESSION['username']);
$data = $items_table->getBooks($seller['user_id']);
if(!$data) {
    $bookList = "No books to display <br>";
} else {
    foreach ($data as $item) {
        $name = $item['item_name'];
        $desc = $item['item_description'];
        $id = $item['item_id'];
        $bookList
            .= <<<EOBODY
            <a href="itemDes.php?id=$id" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between"><h5 class="mb-1">$name</h5></div>
                <p class="mb-1">$desc</p>
            </a>
EOBODY;
    }
}


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
            <br>
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