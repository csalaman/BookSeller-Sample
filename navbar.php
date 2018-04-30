<?php
/**
 * Created by PhpStorm.
 * User: Vinay
 * Date: 4/30/2018
 * Time: 1:04 PM
 */
session_start();
function navbar() {
    $nav = "";
    
    if(isset($_SESSION['username'])) {
        $nav = <<<EOBODY
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
                            <li><a href="portal.php">Portal</a></li>
                            <li><a href="devOps.php">P&C</a></li>
                        </ul>
                        <div class="col-sm-3 col-md-3 pull-right">
                            <form class="navbar-form" role="search" action="main.php" method="post">
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
EOBODY;

    } else {
        $nav = <<<EOBODY
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
                            <li><a href="" data-toggle="modal" data-target="#loginModal">Login</a></li>
                            <li><a href="" data-toggle="modal" data-target="#registerModal">Register</a></li>
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
    
            <div id="loginModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Login</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="loginform">
                                <p>
                                    <div class="form-group">
                                        <label for="usernameLogin">Email:</label>
                                        <input type="email" class="form-control" id="usernameLogin" name="usernameLogin" maxlength="100"
                                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required/>
                                        <script>
                                            var str=usernameLogin;
                                            usernameLogin=str.trim();
                                        </script>
                                    </div>
                                    <div class="form-group">
                                        <label for="passwordLogin">Password:</label>
                                        <input type="password" class="form-control" id="passwordLogin" name="passwordLogin" maxlength="16" required/>
                                    </div>
                                    <div class="form-group" align="right">
                                        <input type="submit" class="btn btn-primary" value="Login"/>&nbsp;
                                        <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancel"/>
                                    </div>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    
            <div id="registerModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Register</h4>
                        </div>
                        <div class="modal-body">
                            <form  method="post" id="registerform">
                                <p>
                                    <div class="form-group">
                                        <label for="nameRegister">Name:</label>
                                        <input type="text" class="form-control" id="nameRegister" name="nameRegister" maxlength="50" required/>
                                        <script>
                                            var str=nameRegister;
                                            nameRegister=str.trim();
                                        </script>
                                    </div>
                                    <div class="form-group">
                                        <label for="usernameRegister">Email:</label>
                                        <input type="email" class="form-control" id="usernameRegister" name="usernameRegister" maxlength="100"
                                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required/>
                                        <script>
                                            var str=usernameRegister;
                                            usernameRegister=str.trim();
                                        </script>
                                    </div>
                                    <div class="form-group">
                                        <label for="passwordRegister">Password:</label>
                                        <input type="password" class="form-control" id="passwordRegister" name="passwordRegister" maxlength="16" required/>
                                    </div>
                                    <div class="form-group" align="right">
                                        <input type="submit" class="btn btn-primary" value="Register"/>&nbsp;
                                        <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancel"/>
                                    </div>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
EOBODY;
    }
    
    
    return $nav;
}

?>