<!-- Script requiring Start -->
<?php
require 'Styles.php';
require 'styles2.php';
?>
<!-- Script requiring End -->

<!-- HTML start -->
<html>
    <!-- Setting background color and placement -->
    <style>
        body{
            background-color: #e2dddd !important;
            width: 100%;
            height: 100% ; 
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
        <?php require 'navBar.php' ?><!--  Navigation bar  -->
        <script type="text/javascript" src="js/register.js"></script> <!-- Calling registered script -->         
        <!-- Main Container Start -->
        <div data-wow-delay="0s"id="LoginContainer" class=" animated wow fadeInDown pushDown2 col-lg-12 col-md-12 col-sm-12 col-xs-10 col-xs-offset-1 col-lg-offset-0 col-md-offset-0 ">
            <div class="container">
                <div class="row ">
                    <form class="center-block form-signin mg-btm " id="registerForm" action="checkRegister.php" method="POST">
                        <div > <h3 class="heading-desc animated slideInDown"></h3></div>
                        <div class="logReg main col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h2 class="text-center">Register</h2> <!-- Register main header -->
                            <label class="pushdown">Username</label> <!-- Login input -->
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text"
                                       class="form-control"
                                       placeholder="Username"
                                       name="username"
                                       id="inputUsername"
                                       value="<?php
                                       if (isset($_POST) && isset($_POST['username'])) {
                                           echo $_POST['username'];
                                       }
                                       ?>" />
                                <!-- If $errorMessage isset to username then it prints out the message from checkRegsiter.php (Same for all the rest) -->
                                <span id="usernameError" class="error">
                                    <?php
                                    if (isset($errorMessage) && isset($errorMessage['username'])) {
                                        echo $errorMessage['username']; //Error message output 
                                    }
                                    ?>
                                </span>
                            </div>
                            <label>Password</label> <!-- Password input -->
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" name="password" class="form-control" id="inputPassword1" placeholder="Password" value="" />
                                <span id="passwordError" class="error">
                                    <?php
                                    if (isset($errorMessage) && isset($errorMessage['password'])) {
                                        echo $errorMessage['password']; //Error message output 
                                    }
                                    ?>
                                </span>
                            </div>
                            <label>Confirmation</label> <!-- Password confirmation  input -->
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" name="password2" class="form-control" id="inputPassword2" placeholder="Confirm Password" value="" />
                                <span id="password2Error" class="error">
                                    <?php
                                    if (isset($errorMessage) && isset($errorMessage['password2'])) {
                                        echo $errorMessage['password2']; //Error message output 
                                    }
                                    ?>
                                </span>
                            </div>
                            <label>Full Name</label> <!-- Full name input -->     
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                                <input type="text" name="fullname" class="form-control" id="inputFullname" placeholder="Full Name" value="<?php
                                if (isset($_POST) && isset($_POST['fullname'])) {
                                    echo $_POST['fullname']; 
                                }
                                ?>" />     
                                <span id="fullnameError" class="error">
                                    <!--using internal PHP code to check everything its told to do in the other page
                                    (no blanks etc), and the id to link up to the correct one -->
                                    <?php
                                    if (isset($errorMessage) && isset($errorMessage['fullname'])) {
                                        echo $errorMessage['fullname']; //Error message output 
                                    }
                                    ?>
                                </span>
                            </div>
                            <label>Email Address</label> <!-- Email address  input -->    
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input type="text" name="emailaddress" class="form-control" id="inputEmail" placeholder="Email Address" value="<?php
                                if (isset($_POST) && isset($_POST['emailaddress'])) {
                                    echo $_POST['emailaddress'];
                                }
                                ?>" />     
                                <span id="emailaddressError" class="error">
                                    <!--using internal PHP code to check everything its told to do in the other page
                                    (no blanks etc), and the id to link up to the correct one -->
                                    <?php
                                    if (isset($errorMessage) && isset($errorMessage['emailaddress'])) {
                                        echo $errorMessage['emailaddress']; //Error message output 
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-md-6 col-lg-6 pull-left">
                                    <button type="submit" class="btn btn-large blue_btn pull-left col-lg-12">Register</button> <!-- Submit register form -->
                                </div>
                                <div class="col-xs-6 col-md-6 col-lg-6 pull-right">
                                    <button type="button"
                                            value="Register"
                                            name="register"
                                            class="btn btn-large orange_btn pull-right col-lg-12"
                                            onclick="document.location.href = 'Login.php'">
                                        Return</button> <!-- Return to login button -->
                                </div>
                            </div>
                        </div>
                        <span class="clearfix"></span>
                    </form>
                </div>
            </div>
        </div>
        <!-- Main Container End -->
    </body>
</html>