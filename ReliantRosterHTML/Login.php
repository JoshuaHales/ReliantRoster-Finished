<!-- Script requiring Start -->
<?php
require 'Styles.php';
require 'Styles2.php';
?>
<!-- Script requiring End -->

<!-- HTML start -->
<html>
    <style>
        body{
            background-color: #e2dddd !important;
            width: 100%;
            height: 100% ;
            overflow:hidden; /*Removes scrollbar*/
        }
    </style>
    <head>
        <title>Reliant Roster</title>
    </head>
    <body >
        <!-- If $username  is set then make blank or null -->
        <?php
        if (!isset($username)) {
            $username = '';
        }
        ?>
        <?php require 'navBar.php' ?> <!--  Navigation bar  -->
        <!-- Main Container Start -->
        <div data-wow-delay="0s"id="LoginContainer" class=" animated wow fadeInDown pushDown2 col-lg-12 col-md-12 col-sm-12 col-xs-10 col-xs-offset-1 col-lg-offset-0 col-md-offset-0 ">
            <div class="container">
                <div class="row ">
                    <!-- Login Form POST Start -->
                    <form class="center-block form-signin mg-btm " action="checkLogin.php" method="POST"> 
                        <div > <h3 class="heading-desc animated slideInDown"><img class ="img-responsive col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-7 col-sm-offset-2 col-xs-6 col-xs-offset-3" src="img/RR_logo.png"/></h3></div> <!-- Main Logo -->
                        <div class="logReg pushDown1 main col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h3 class="text-center">Login</h3> 
                            <label>Username</label> <!-- Username input -->
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text"
                                    class="form-control"
                                    placeholder="Username"
                                    name="username"
                                    value="<?php
                                    if (isset($_POST) && isset($_POST['username'])) {
                                        echo $_POST['username'];
                                    }
                                    ?>" />
                            </div>
                            <label>Password</label> <!-- Password input -->
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" name="password" value="" class="form-control" placeholder="Password">
                                <span id="passwordError" class="error">
                                    <?php
                                    if (isset($errorMessage) && isset($errorMessage['password'])) {
                                        echo $errorMessage['password'];
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-md-6 col-lg-6 pull-left">
                                    <button type="submit" class="btn btn-large blue_btn pull-left col-lg-12">Login</button> <!-- Submit login form -->
                                </div>
                                <div class="col-xs-6 col-md-6 col-lg-6 pull-right">
                                    <button type="button"
                                            value="Register"
                                            name="register"
                                            class="btn btn-large orange_btn pull-right col-lg-12"
                                            onclick="document.location.href = 'Register.php'">
                                        Register</button> <!-- Go to register page -->
                                </div>
                            </div>
                        </div>
                        <span class="clearfix"></span>
                    </form>
                    <!-- Login Form POST End -->
                </div>
            </div>
        </div>
        <!-- Main Container End -->
    </body>
</html>
<!-- HTML End -->
