<?php
/**
 * Created by PhpStorm.
 * User: Vinay
 * Date: 4/2/2018
 * Time: 3:08 PM
 */

require_once("dbAccessInfo.php");

$db_connection = new mysqli($host, $user, $password, $database);

if ($db_connection->connect_error) {
    die($db_connection->connect_error);
} else {
    echo "Connected Successfully";
}