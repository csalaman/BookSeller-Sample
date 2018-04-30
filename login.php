<?php

require_once("support.php");
require_once("dbAccessInfo.php");
require_once("DatabaseInstance.php");
session_start();

$username = trim($_POST["usernameLogin"]);
$password = $_POST["passwordLogin"];

$result = $user_table->loginUser($username, $password);
if (!$result) {
    echo("failure");
} else {
    $_SESSION['username'] = $result['username'];
    echo("success");
}

?>