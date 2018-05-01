<?php

require_once("support.php");
require_once("dbAccessInfo.php");
require_once("DatabaseInstance.php");
require_once('navbar.php');

$navbar = navbar();

$bookList = "";

$sumPrice = 0;
$sumName = 0;
$score = 0;
$match = 0;

$u = "";
if (isset($_SESSION['username'])) {
    
    $u = $_SESSION['username'];
}

$seller = $user_table->getUserByUsername($_SESSION['username']);
$data2 = $items_table->getBooks($seller['user_id']);
error_reporting(E_ERROR | E_PARSE);
foreach($data2 as $item2) {
    $name = $item2['item_name'];
    preg_match_all('!\d+!', $name, $matches, PREG_PATTERN_ORDER);

    error_reporting(E_ERROR | E_PARSE);

    $match = (int)$matches[0][0];
    $sumName += $match;
    $price = $item2['item_price'];
    if ($price <= 0)
        $price = 1;
    $sumPrice += $price;

        $list .= <<<EOBODY
            <tr>
                <td>$name</td>
                <td>$match</td>
                <td>$$price</td>
            </tr>
EOBODY;

}
$score = ($sumName * $sumPrice) / 20000;
error_reporting(E_ERROR | E_PARSE);
$list .= <<<EOBODY
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
EOBODY;

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

    <body style="margin-top: 50px;">
        $navbar

        <div style="margin-bottom: 20px;">
            <table style="width:25%">
                <thead>
                    <tr>
                        <th>CLASS</th>
                        <th>VALUE</th>
                        <th>PRICE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    $list
                </tbody>
                <tfoot>
                    <tr>
                        <td><strong>SCORE</strong></td>
                        <td></td>
                        <td>$score</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <script src="bootstrap/jquery-3.3.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <footer>Copyright &copy; Book Sellers</footer>
    </body>
</html>
EOBODY;

echo $page;
?>