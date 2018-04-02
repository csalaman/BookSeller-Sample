<?php
/**
 * Created by PhpStorm.
 * User: csalaman
 * Date: 3/21/2018
 * Time: 10:56 PM
 */

require_once("support.php");
require_once("dbAccessInfo.php");
require_once("DatabaseInstance.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $database = new DatabaseInstance($host, $user, $password, $database, "items");
    
    $item = $database->getItemById($id);
    echo print_r($item);
} else {
    header("Location: main.php");
}
?>