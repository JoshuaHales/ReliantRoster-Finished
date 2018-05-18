<!DOCTYPE html>
<!-- Navbar html code for only the index page -->
<html lang="en">
    <head>
        <?php
        require 'Styles.php'; //Pull in style values 
        ?>
        <!-- Meta Data -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Javascript -->
        <script src="js/respond.js"></script> 
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script> <!-- Boostrap code to allow sidebar functons -->
    </head>

    <body>
        <!-- Navigation Start -->
        <nav class="navbar navbar-inverse navbar-fixed-top " role="navigation">
            <!-- container Start -->
            <div class="container">
                <!-- List values get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> <!-- Mobile display toggle -->
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand  " href="index.php"><span class="glyphicon glyphicon-calendar"> </span><strong> Reliant Roster</strong></a> <!-- Site main nav link -->
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse    " id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="animated wow fadeInLeft" data-wow-delay="0s">
                        <a href="Index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <!-- Home link -->
                        </li>
                        <li class="animated wow fadeInLeft" data-wow-delay=".1s">
                            <a href="index.php #about"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> About</a> <!-- About link -->
                        </li>
                        <li class="animated wow fadeInLeft" data-wow-delay=".1s">
                            <a href="index.php #testimonials"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Team</a> <!-- Team link -->
                        </li>
                       
                        <li class="animated wow fadeInLeft" data-wow-delay=".2s">
                            <a href="HomeRosters.php"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Dashboard</a> <!-- Dashboard drop down menu -->
                        </li>
                        <li class="dropdown animated wow fadeInRight" data-wow-delay=".2s">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle loginBtn"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Account <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="HomeRosters.php"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Bookings</a></li> <!-- Drop down options -->
                                <li><a href="HomeRosters.php"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Account</a></li>
                                <li><a href="HomeRosters.php"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Settings</a></li>
                                <li class="divider"></li>
                                    <?php require 'toolbar.php' ?> <!-- Show login or logout options -->                           
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- container End -->
        </nav>
        <!-- Navigation End -->
    </body>
</html>