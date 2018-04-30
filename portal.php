<?php

require_once("support.php");
require_once("dbAccessInfo.php");
require_once("DatabaseInstance.php");


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