<?php
/**
 * Created by PhpStorm.
 * User: Vinay
 * Date: 4/30/2018
 * Time: 10:55 PM
 */

require_once("support.php");
require_once("dbAccessInfo.php");
require_once("DatabaseInstance.php");

session_start();

if(isset($_GET['item_id']) && isset($_SESSION['username'])) {
    $seller = $user_table->getUserByUsername($_SESSION['username']);
    $item = $items_table->getItemById($_GET['item_id']);
    if($item['item_seller'] !== $seller['user_id']) {
        header("Location: portal.php");
    }
    $items_table->deleteItemById($_GET['item_id']);
    $page = <<<EOBODY
        <script>
            alert('Item Deleted');
            var path = window.location.pathname;
            path = path.substring(0, path.lastIndexOf("/"));
            path = path + '/portal.php';
            window.location = path;
        </script>";
EOBODY;

    echo $page;
} else {
    echo $_GET['item_id'];
    header("Location: portal.php");
}

?>