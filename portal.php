<?php
/**
 * Created by PhpStorm.
 * User: csalaman
 * Date: 3/21/2018
 * Time: 10:56 PM
 */

    /* Do the DB stuff later HERE and append to doc below*/

    $body = <<< EOBODY
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Book Sellers</title>
        <meta charset="UTF-8">
        <link rel="icon" href="bootstrap/images/book.png">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="bootstrap/css/mainstyle.css">

        <script>
            function validateLogin() {
                var username = document.getElementById("usernameLogin").value;
                var password = document.getElementById("passwordLogin").value;

                <!-- CHECK LOGIN USING DATABASE -->
                if (username === "admin" && password === "password")
                    document.getElementById("updateLogin").innerHTML = "Successful login.";
                else document.getElementById("updateLogin").innerHTML = "Invalid username and/or password.";
            }

            function validateRegister() {
                var username = document.getElementById("usernameRegister").value;
                var password = document.getElementById("passwordRegister").value;
                var name = document.getElementById("nameRegister").value;
                var email = document.getElementById("emailRegister").value;

                <!-- CHECK THAT USERNAME AND EMAIL HAVE NOT ALREADY BEEN REGISTERED -->
                document.getElementById("updateRegister").innerHTML = "Successful register.";
            }
        </script>
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
                        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                        <li><a href="#" data-toggle="modal" data-target="#loginModal">Login</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#registerModal">Register</a></li>
                    </ul>
                    <div class="col-sm-3 col-md-3 pull-right">
                        <form class="navbar-form" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

</body>
</html>
EOBODY;

    echo $body;


?>