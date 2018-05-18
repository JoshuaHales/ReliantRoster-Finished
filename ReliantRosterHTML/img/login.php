<?php
//THIS CLASS ALLOWS USER TO LOGIN USING VARIABLES IN DATABASE
require "init.php"; //Require "init.php" class to allow code to connect to database
$employee_userName = $_POST["login_name"]; //Dummy test data for inserting "employee_userName" to database
$employee_password = $_POST["login_pass"]; //Dummy test data for inserting "employee_password" to database

$sql_query = "SELECT id, name FROM employee WHERE userName LIKE '$employee_userName' AND password LIKE '$employee_password';"; //Will retrieve employee name from database if the two varaibles set above are correct
$result = mysqli_query($con, $sql_query); //Creating a query for the database connection and SQL query and storing info in "$result" variable
if (mysqli_num_rows($result) > 0) { //Checks if number of rows stored in database is greater then 0
    $row = mysqli_fetch_assoc($result); //This code will return the first row
    $row['status'] = 200; //Set status to 200(OK)
    //$name = $row["name"]; //Returns the name in that row
    //echo "Login Successful, Welcome employee: ".$name; //Print out the name to the user
} else { //Else no rows are found
    //echo "Incorrect username or password"; //Print message to user 
    $row['status'] = 403; //Set status to 403 (forbidden)
}
echo json_encode($row); //Encode $row response status in JSON format for android to read
?>

