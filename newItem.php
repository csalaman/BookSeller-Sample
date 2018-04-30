<?php
/**
 * Created by PhpStorm.
 * User: csalaman
 * Date: 4/30/2018
 * Time: 1:09 AM
 */
require_once("DatabaseInstance.php");

session_start();


// TO REMOVE>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

$seller = $_SESSION['username'];


$html =<<<HTML
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

        <header class="text-center">
            <h1>New Book</h1><hr>
        </header>
        

        <div class="list-group text-center">
           <form action="{$_SERVER['PHP_SELF']}" method="post">
                <strong>Name</strong><br><input type="text" class='input-sm ' name="book_name" /><br><br>
                <strong>Description</strong><br>
                <textarea name="book_description" cols='30' class="input-lg"></textarea><br><br>
                <strong>Price($):</strong>
                <input type="text" name="price" class="input-sm"/><br><br><br><br>
                <input type="submit" class="btn-lg" value="Post For Sell"/>
           </form>
        </div>

        <script src="bootstrap/jquery-3.3.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        
        
        <br><br>
        <footer>Copyright &copy; Book Sellers</footer>
    </body>
</html>
HTML;



if(isset($_POST['book_name'])){
    $items_table->insert([$_POST['book_name'],'cmsc398n.jpg',$_SESSION['username'],$_POST['book_description'],floatval($_POST['price']),0,'None',date(DATE_RFC822)]);
    $echo = <<<HTML
<script>
    alert("You have successfully submitted an item!")
</script>
    
HTML;
    echo $echo;
}

echo $html;