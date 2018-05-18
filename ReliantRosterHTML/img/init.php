<?php
    //THIS CLASS CREATES A CONNECTION TO THE PHP DATABASE
    $server_name = "daneel"; //Declaring the database server name
    $db_name = "N00134315"; //Declaring database name
    $mysql_user = "N00134315"; //Declaring database login username
    $mysql_pass = "N00134315"; //Declaring database login password
    //$server_name = "localhost"; //Declaring the database server name
    //$db_name = "reliant_roster"; //Declaring database name
    //$mysql_user = "root"; //Declaring database login username
    //$mysql_pass = "Selah7"; //Declaring database login password
    $con = mysqli_connect($server_name, $mysql_user, $mysql_pass, $db_name); //Establishing connection to database with passed in variables
    if (!$con) { //Checks if there is a connection
        echo "Connection Error: " . mysqli_connect_error(); //If there is no connection to database print out errror
    } else { //Connection to database is successful 
        //echo "<h3>Database connection successful</h3>"; //Print message to user 
    }
?>