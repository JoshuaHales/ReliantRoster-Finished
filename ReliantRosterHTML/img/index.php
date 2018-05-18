<?php
require 'Slim/Slim.php'; //Requiring Slim.php variables 
\Slim\Slim::registerAutoloader(); //Load Slim elements with autoloader 
$app = new \Slim\Slim(); //Create app variable which equals new Slim properties 

function getConnection() { //Function to create connection between Slim api and database 
    /* College connection code Start */
    $dbhost = "daneel"; //Declaring the database server name
    $dbuser = "N00134315"; //Declaring database login username
    $dbpass = "N00134315"; //Declaring database login password
    $dbname = "N00134315"; //Declaring database name
    /* College connection code End */
    
    /* Home connection code Start */
    //http://192.168.1.132/ReliantRosterWebApp/api/roster/1
    //$dbhost="localhost"; //Declaring the database server name
    //$dbuser="root"; //Declaring database login username
    //$dbpass="Selah7"; //Declaring database login password
    //$dbname="reliant_roster"; //Declaring database name
    /* Home connection code End */
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass); //Establishing connection to database with passed in variables
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Setting PDO connection elements 
    return $dbh; //Returning connection values 
}

$app->get('/roster', function () { //Code to pull all rosters by there Title value 
    $sql = "SELECT * FROM roster ORDER BY title"; //SQL statment to select all from rosters ordering by its the title value 
    try { //Try connect and get values from database using SQL query above
        $db = getConnection(); //Get the database connection set above
        $stmt = $db->query($sql); //Run the SQL query set above using the connection code
        $roster = $stmt->fetchAll(PDO::FETCH_OBJ); //Fetch values from database using SQL query above
        $db = null; //Then set db to null, closing the connection 
        echo json_encode($roster); //Output values from SQL query in JSON format so the android can read
    } catch (PDOException $e) { //If connection is not made 
        echo '{"error":{"text":' . $e->getMessage() . '}}'; //Output error message to user 
    }
});

$app->get('/roster/:employeeID', function ($employeeID) { //Code to pull individual rosters value by the employeeID value 
    $sql = "SELECT * FROM roster WHERE employeeID = :employeeID"; //SQL statment to select all from rosters where employeeID equals employeeID
    try { //Try connect and get values from database using SQL query above
        $db = getConnection(); //Get the database connection set above
        $stmt = $db->prepare($sql); //Run the SQL query set above using the connection code
        $params = array("employeeID" => $employeeID); //Run the SQL query set above using the connection code with the value of employeeID
        $stmt->execute($params); //Run statement 
        $roster = $stmt->fetchAll(PDO::FETCH_OBJ); //Fetch values from database using SQL query above
        $db = null; //Then set db to null, closing the connection 
        echo json_encode($roster);
    } catch (PDOException $e) { //Output values from SQL query in JSON format so the android can read
        echo '{"error":{"text":' . $e->getMessage() . '}}'; //Output error message to user 
    }
});

$app->run(); //Runs the Slim api with variable set above 
