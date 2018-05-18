<?php
//requiring classes
require_once 'User.php';
require_once 'Connection.php';
require_once 'UserTableGateway.php';
/* Starts a new session if session is == to nothing */
$id = session_id();
if ($id == "") {
    session_start();
}
require 'ensureUserLoggedIn.php';
//Creating connection to userTableGateway 
$connection = Connection::getInstance();
$gateway = new UserTableGateway($connection);

//Filtering User Intput:
$userID = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
$customWeek1Start = filter_input(INPUT_POST, 'customWeek1Start', FILTER_SANITIZE_STRING);
$customWeek1End = filter_input(INPUT_POST, 'customWeek1End', FILTER_SANITIZE_STRING);
$customWeek2Start = filter_input(INPUT_POST, 'customWeek2Start', FILTER_SANITIZE_STRING);
$customWeek2End = filter_input(INPUT_POST, 'customWeek2End', FILTER_SANITIZE_STRING);
$customWeek3Start = filter_input(INPUT_POST, 'customWeek3Start', FILTER_SANITIZE_STRING);
$customWeek3End = filter_input(INPUT_POST, 'customWeek3End', FILTER_SANITIZE_STRING);
$customStartTime1 = filter_input(INPUT_POST, 'customStartTime1', FILTER_SANITIZE_STRING);
$customStartTime2 = filter_input(INPUT_POST, 'customStartTime2', FILTER_SANITIZE_STRING);
$customStartTime3 = filter_input(INPUT_POST, 'customStartTime3', FILTER_SANITIZE_STRING);
$customEndTime1 = filter_input(INPUT_POST, 'customEndTime1', FILTER_SANITIZE_STRING);
$customEndTime2 = filter_input(INPUT_POST, 'customEndTime2', FILTER_SANITIZE_STRING);
$customEndTime3 = filter_input(INPUT_POST, 'customEndTime3', FILTER_SANITIZE_STRING);

$errorMessage = array();
//custom week 1
if (( $customWeek1Start === '')) {
    $customWeek1Start = "Start"; //If values are null place either start or end value
}
if (( $customWeek1End === '')) {
    $customWeek1End = "End";
}
//custom week 2
if (( $customWeek2Start === '')) {
    $customWeek2Start = "Start";
}
if (( $customWeek2End === '')) {
    $customWeek2End = "End";
}
//custom week 3
if (( $customWeek3Start === '')) {
    $customWeek3Start = "Start";
}
if (( $customWeek3End === '')) {
    $customWeek3End = "End";
}
//Custom StartTime 1
if (( $customStartTime1 === '')) {
    $customStartTime1 = "Start";
}
//Custom StartTime 2
if (( $customStartTime2 === '')) {
    $customStartTime2 = "Start";
}
//Custom StartTime 3
if (( $customStartTime3 === '')) {
    $customStartTime3 = "Start";
}
//Custom EndTime 1
if (( $customEndTime1 === '')) {
    $customEndTime1 = "End";
}
//Custom EndTime 2
if (( $customEndTime2 === '')) {
    $customEndTime2 = "End";
}
//Custom EndTime 3
if (( $customEndTime3 === '')) {
    $customEndTime3 = "End";
}
$customWeek1Total = $customWeek1Start . '-' . $customWeek1End; //Creating new value which takes start and end week value and appends the two together 
$customWeek2Total = $customWeek2Start . '-' . $customWeek2End;
$customWeek3Total = $customWeek3Start . '-' . $customWeek3End;
$customTimeAdded = $customWeek1Total . "#" . $customWeek2Total . "#" . $customWeek3Total . "#" . $customStartTime1 . "#" . $customStartTime2 . "#" . $customStartTime3 . "#" . $customEndTime1 . "#" . $customEndTime2 . "#" . $customEndTime3; //Append all the new values together seperating them by # symbol 

if (empty($errorMessage)) { //If there is no error messages run code beneath 
    $gateway->updateUsers($userID, $customTimeAdded); //Update user database table values to now take customTimeAdded value
    header('Location: createRosterForm.php'); //Return to creatRosterForm 
}
/* when the array if/ else statements are not met */ else {
    require 'editUserForm.php'; //Return to editUserForm 
}
