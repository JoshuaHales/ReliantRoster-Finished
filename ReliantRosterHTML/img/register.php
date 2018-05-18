<?php
//THIS CLASS ADDS DATA TO PHP DATABASE 
require "init.php"; //Require "init.php" class to allow code to connect to database
$employee_ID = ""; //Dummy test data for inserting "employee_ID" to database, leave null as phpMyAdmin deals with ID primary key
$employee_name = $_POST["user"]; //Dummy test data for inserting "employee_name" to database
$employee_email = $_POST["user_email"]; //Dummy test data for inserting "$employee_email" to database
$employee_userName = $_POST["user_name"]; //Dummy test data for inserting "employee_userName" to database
$employee_password = $_POST["user_pass"]; //Dummy test data for inserting "employee_password" to database
$checkExist = "SELECT * FROM employee WHERE userName LIKE '$employee_userName'"; //Will retrieve employee name from database if the two varaibles set above are correct
$resultOne = mysqli_query($con, $checkExist); //Creating a query for the database connection and SQL query and storing info in "$result" variable
if (mysqli_num_rows($resultOne) > 0) { //Checks if number of rows stored in database is greater then 0
    echo "User Already exists"; //Echo message for android to read 
    //$row['status'] = 302;
} else if (mysqli_num_rows($resultOne) <= 0) {
    $sql_query = "INSERT INTO employee VALUES(NULL, '$employee_name', '$employee_email', '$employee_userName', '$employee_password');"; //Creating a query to insert data into database using varaibles made above
    //$resultTwo = mysqli_query($con, $sql_query); //Creating a query for the database connection and SQL query and storing info in "$result" variable
    if ($employee_name != null || $employee_email != null || $employee_userName != null || $employee_password != null) {
        if (mysqli_query($con, $sql_query)) { //Checks if code can make connection using "$con" and can insert data to database using "$sql_query"
            //$row = mysqli_fetch_assoc($mysqli_query); //This code will return the first row
            echo "Data insert successful"; //Prints message to user on success
            //$row['status'] = 201;
        }
    } else if ($employee_name == null || $employee_email == null || $employee_userName == null || $employee_password == null) { //if values are null run code beneath
        echo "Employee details must not be null"; //Echo message for android to read 
        //$row['status'] = 403;
    } else {
        echo "Data insertion error: " . mysqli_error($con); //Prints error message to user using varaible "$con"
        //$row['status'] = 204;
    }
}
?>