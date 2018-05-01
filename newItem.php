<?php
/**
 * Created by PhpStorm.
 * User: csalaman
 * Date: 4/30/2018
 * Time: 1:09 AM
 */
require_once("DatabaseInstance.php");
require_once('navbar.php');

// TO REMOVE>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

$seller = $user_table->getUserByUsername($_SESSION['username']);
$navbar = navbar();

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
        $navbar;

        <header class="text-center">
            <h1>New Book</h1><hr>
        </header>
        

        <div class="list-group">
           <form action="{$_SERVER['PHP_SELF']}" method="post">
                <strong>Name</strong><br><input type="text" class='input-sm ' name="book_name" /><br><br>
                <strong>Description</strong><br>
                <textarea name="book_description" cols='30' class="input-lg"></textarea><br><br>
                <strong>Price($)</strong><br>
                <input type="text" name="price" class="input-sm"/><br><br><br>
                <strong>Image(Optional):</strong><input type="file" name="image_file" class="input-lg btn-lg " />
                <br><br>
                <input type="submit" class="btn-lg" value="Post For Sell"/><br><br><br>
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
    $items_table->insert([$_POST['book_name'],$_POST['image_file'],$seller['user_id'],$_POST['book_description'],floatval($_POST['price']),0,'None',date(DATE_RFC822)]);
    $echo = <<<HTML
<script>
    alert("You have successfully submitted an item!");
    var path = window.location.pathname;
    path = path.substring(0, path.lastIndexOf("/"));
    path = path + '/portal.php';
    window.location = path;
</script>
    
HTML;
    echo $echo;
}

echo $html;