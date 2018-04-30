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
    switch ($user_table->getErrno()) {
        case 1062:
            echo ("duplicate");
            break;
        default:
            echo $user_table->getErrno();
            break;
    }
} else {
    $_SESSION['username'] = $username;
    echo ("success");
}

?>