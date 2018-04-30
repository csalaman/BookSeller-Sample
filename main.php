<?php

require_once("support.php");
require_once("dbAccessInfo.php");
require_once("DatabaseInstance.php");
require_once("navbar.php");

$bookList = "";

if (isset($_POST["search"])) {
    $search = $_POST["srch-term"];
    $data = $items_table->getItemsWithSearch($search);
    if (!$data) {
        $bookList .= "No results returned";
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
} else {
    $data = $items_table->getAllData();
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

$page
    = <<<EOBODY
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Book Sellers</title>
        <meta charset="UTF-8">
        <link rel="icon" href="bootstrap/images/book.png">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="bootstrap/css/mainstyle.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
			$(document).ready(function() {
                $('#loginform').submit(function(e) {
                    e.preventDefault();

                    $.ajax({
                       type: "POST",
                       url: 'login.php',
                       data: $(this).serialize(),
                       success: function(data)
                       {
                          if (data === 'success') {
                              var path = window.location.pathname;
                              path = path.substring(0, path.lastIndexOf("/"));
                              path = path + '/portal.php';
                              window.location = path;
                          }
                          else {
                            alert('Invalid Credentials');
                          }
                       }
                    });
                });

                $('#registerform').submit(function(e) {
                    e.preventDefault();

                    $.ajax({
                       type: "POST",
                       url: 'newUser.php',
                       data: $(this).serialize(),
                       success: function(data)
                       {
                          if (data === 'success') {
                              var path = window.location.pathname;
                              path = path.substring(0, path.lastIndexOf("/"));
                              path = path + '/portal.php';
                              window.location = path;
                          }
                          else if (data === 'duplicate'){
                              alert('Username already taken');
                          }
                       }
                    });
                });
            });
		</script>
    </head>
    <body>
        $navbar
        <header>
            <h1>Book Sellers</h1><hr>
        </header>

        <div class="list-group">
            $bookList
        </div>

        <script src="bootstrap/jquery-3.3.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <footer>Copyright &copy; Book Sellers</footer>
    </body>
</html>
EOBODY;

echo $page;

?>