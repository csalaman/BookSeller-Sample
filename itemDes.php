<?php

require_once("support.php");
require_once("dbAccessInfo.php");
require_once("DatabaseInstance.php");

session_start();

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $item = $items_table->getItemById($id);
    $seller = $user_table->getUserById($item['item_seller']);
    $subject = urlencode("I would like to purchase " . $item['item_name']);
    $contact = "";
    if($seller['username'] === $_SESSION['username']) {
        $contact = "<a href=\"deleteItem.php?item_id=$id\"><h3 class=\"my-3\">Delete Item</h3></a>";
    } else {
        $contact = "<a href=\"mailto:$seller[username]?Subject=$subject\"><h3 class=\"my-3\">Contact Seller</h3></a>";
    }
} else {
    header("Location: main.php");
}

$page = <<<EOBODY
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
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Navigation Part 1-->
                <div class="navbar-header">
                    <!-- button visible when navbar collapses -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarcontent">
                        <!-- displaying icon representing button -->
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- Navigation Part 2 has main content of navigation bar -->
                <div id="navbarcontent" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="main.php"><span class="glyphicon glyphicon-home"></span></a></li>
                        <li><a href="main.php">Home</a></li>
                    </ul>
                    <div class="col-sm-3 col-md-3 pull-right">
                        <form class="navbar-form" role="search" action="{$_SERVER["PHP_SELF"]}" method="post">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit" name="search"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <header>
            <h1>$item[item_name]</h1><hr>
        </header>

        <!-- Portfolio Item Row -->
        <div class="row" style="padding-bottom:20px;">
            <div class="col-md-3">
                <img src="$item[item_file_name]" alt="$item[item_name]" height="400">
            </div>
            <div class="col-md-4">
                <h3 class="my-3">Description</h3>
                <p>$item[item_description]</p>
                <h3 class="my-3">Post Date</h3>
                <p>$item[item_post_date]</p>
                <h3 class="my-3">Seller</h3>
                <p>$seller[name]</p>
                <h3 class="my-3">Price</h3>
                <p>$$item[item_price]</p>
                $contact
            </div>
        </div>

        <script src="bootstrap/jquery-3.3.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <footer>Copyright &copy; Book Sellers</footer>
    </body>
</html>
EOBODY;

echo $page;
?>