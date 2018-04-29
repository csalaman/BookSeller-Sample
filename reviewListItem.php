<?php

require_once("support.php");
require_once("dbAccessInfo.php");
require_once("DatabaseInstance.php");

session_start();

$name=$_POST["bookName"];
$price=floatval($_POST["price"]);
$description=$_POST["description"];
$filename=$_POST["image"];

if(isset($_POST["submit"])){
    $db = mysqli_connect("localhost", "bookSellerAdmin", "groupProject4terps", "book_sellers");
    if (mysqli_connect_errno()) {
        $message = mysqli_connect_error();
        echo "<script>alert('$message');</script>";
    }
    $sqlQuery = sprintf("insert into items (item_name, item_file_name, item_description, item_price)
    values ('%s', '%s', '%s', '%f')", $name, $filename, $description, $price);
    $result = mysqli_query($db, $sqlQuery);
    if (!($result)) {
        $message = mysqli_error($db);
        echo "<script>alert('$message');</script>";
    } else header("Location: portal.php");

    mysqli_free_result($result);
    mysqli_close($db);

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
            <h1>Book Sellers</h1><hr>
        </header>
       <form action="{$_SERVER["PHP_SELF"]}" method="post">
			<!-- Textboxes and Password entry -->
			
			<p><strong>Book Name: </strong> $name </p> 
			   <p><strong>Description: </strong> $description </p>
			    <strong>Price: </strong> $price<br /><br />
				<strong>Upload Image (optional): $filename
			
			</p>
          
			
			<p>
				
				<input type="submit" name="submit" value="Confirm" />
			</p>
      </form>
      <a href="listItem.php"><input type="button" value="Go Back"></a>
      <br><br>

        <script src="bootstrap/jquery-3.3.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <footer>Copyright &copy; Book Sellers</footer>
    </body>
</html>
EOBODY;

echo $page;

