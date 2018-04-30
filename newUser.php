<?php

require_once("support.php");
require_once("dbAccessInfo.php");
require_once("DatabaseInstance.php");

session_start();

$name = trim($_POST["nameRegister"]);
$username = trim($_POST["usernameRegister"]);
$password = $_POST["passwordRegister"];

$result = $user_table->registerUser($name, $username, $password);
if (!$result) {
    echo $user_table->getErrno(); //1062 is duplicate user
} else header("Location: portal.php");

?>