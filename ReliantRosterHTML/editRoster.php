<?php
//requiring Event.php as some of its elements are needed in this page
require_once 'Roster.php';
require_once 'Connection.php';
require_once 'RosterTableGateway.php';
require_once 'EmployeeTableGateway.php';

/* Starts a new session if session is == to nothing */
$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance(); //Creating connections to tables 
$gateway = new RosterTableGateway($connection);
$employeeGateway = new EmployeeTableGateway($connection);
$employees = $employeeGateway->getEmployees("name");

$weekNumber = date("W"); //week number
//$weekNumSub = substr($weekNumber, 1); // returns number without the 0
$weekNumberInt = (int) $weekNumber; //week number as an int

$NextWeekNumberInt = $weekNumberInt + 1; // checks if new year started
if ($NextWeekNumberInt > 52) {
    $NextWeekNumberInt = 1; //value of week 1 assigned
}

$mondayDate = date('d', time() + ( 1 - date('w')) * 24 * 3600); //gives date of monday of current week
$sundayDate = date('d', time() + ( 7 - date('w')) * 24 * 3600); //gives date of sunday of current week
$nextMondayDate = date('d', time() + ( 8 - date('w')) * 24 * 3600); //monday of next week
$nextSundayDate = date('d', time() + ( 14 - date('w')) * 24 * 3600); //sunday of next week
$mondayDateTwoWeekAhead = date('d', time() + ( 15 - date('w')) * 24 * 3600); //monday of TWO weeks ahead
$sundayDateTwoWeekAhead = date('d', time() + ( 21 - date('w')) * 24 * 3600); //sunday of TWO weeks ahead
$mondayDateThreeWeekAhead = date('d', time() + ( 22 - date('w')) * 24 * 3600); //monday of Three weeks ahead
$sundayDateThreeWeekAhead = date('d', time() + ( 28 - date('w')) * 24 * 3600); //sunday of Three weeks ahead
$mondayDateFourWeekAhead = date('d', time() + ( 29 - date('w')) * 24 * 3600); //monday of FOUR weeks ahead
$sundayDateFourWeekAhead = date('d', time() + ( 35 - date('w')) * 24 * 3600); //sunday of FOUR weeks ahead
//Filtering User Intput:
$rosterID = filter_input(INPUT_POST, 'rosterID', FILTER_SANITIZE_STRING);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$monday = filter_input(INPUT_POST, 'monday', FILTER_SANITIZE_STRING);
$monday2 = filter_input(INPUT_POST, 'monday2', FILTER_SANITIZE_STRING);
$tuesday = filter_input(INPUT_POST, 'tuesday', FILTER_SANITIZE_STRING);
$tuesday2 = filter_input(INPUT_POST, 'tuesday2', FILTER_SANITIZE_STRING);
$wednesday = filter_input(INPUT_POST, 'wednesday', FILTER_SANITIZE_STRING);
$wednesday2 = filter_input(INPUT_POST, 'wednesday2', FILTER_SANITIZE_STRING);
$thursday = filter_input(INPUT_POST, 'thursday', FILTER_SANITIZE_STRING);
$thursday2 = filter_input(INPUT_POST, 'thursday2', FILTER_SANITIZE_STRING);
$friday = filter_input(INPUT_POST, 'friday', FILTER_SANITIZE_STRING);
$friday2 = filter_input(INPUT_POST, 'friday2', FILTER_SANITIZE_STRING);
$saturday = filter_input(INPUT_POST, 'saturday', FILTER_SANITIZE_STRING);
$saturday2 = filter_input(INPUT_POST, 'saturday2', FILTER_SANITIZE_STRING);
$sunday = filter_input(INPUT_POST, 'sunday', FILTER_SANITIZE_STRING);
$sunday2 = filter_input(INPUT_POST, 'sunday2', FILTER_SANITIZE_STRING);
//$total = filter_input(INPUT_POST, 'total', FILTER_SANITIZE_NUMBER_FLOAT);
$employeeID = filter_input(INPUT_POST, 'employeeID', FILTER_SANITIZE_STRING);

/* empty ErrorMessage array that if elements are met or not runs, either runs the error messege( Reloads createRosterForm.php ) or continues to HomeRosters.php */
$errorMessage = array(); //Creeating the error message array 
if ($title === FALSE || $title === '') {
    $errorMessage['title'] = 'Title must not be blank<br/>'; //If values are null notify the user with a error message 
} else if ($title === TRUE || $title != '') {
    $errorMessage['title'] = 'Title ISNT blank<br/>';
}
$month = date('F', strtotime('1 Jan + ' . $title . ' weeks')); //Takes title value and gets the month value in relation to that week of the year e.g (Week 6 = Febuary)
$monthResult = substr($month, 0, 3); //Keep only the first three letters of the month value 

/* MONDAY START */
if ($monday === FALSE || $monday === '') {
    $errorMessage['monday'] = 'Monday must not be blank<br/>'; //If values are null notify the user with a error message, done the same for each day below
}
if ($monday2 === FALSE || $monday2 === '') {
    $errorMessage['monday2'] = 'Monday2 must not be blank<br/>'; //If values are null notify the user with a error message , done the same for each day below
}
if ($monday === TRUE || $monday != '' || $monday2 === TRUE || $monday2 != '') { //If values are not empty 
    $data1 = $monday;
    $data2 = $monday2;
    $diff_seconds1 = strtotime($monday) - strtotime($monday2); //Get the value of the first time minus the second time 
    $stat1 = floor($diff_seconds1 / 3600 * -1) . 'H:' . floor(($diff_seconds1 % 3600) / 60 * -1) . 'M'; //Round value down to just hrs and mins
    $monday = $data1 . '-' . $data2; //Value is no equals to new values 
}
if ($monday === TRUE || $monday === 'OFF' || $monday2 === TRUE || $monday2 === 'OFF') {
    $monday = 'OFF';
}
if ($monday === 'OFF' && $monday2 != 'OFF') {
    $errorMessage['monday2'] = 'Incorrect times<br/>';
}
if ($monday != 'OFF' && $monday2 === 'OFF') {
    $errorMessage['monday2'] = 'Incorrect times<br/>';
}
/* MONDAY END */

/* TUESDAY START */
if ($tuesday === FALSE || $tuesday === '') {
    $errorMessage['tuesday'] = 'Tuesday must not be blank<br/>';
}
if ($tuesday2 === FALSE || $tuesday2 === '') {
    $errorMessage['tuesday2'] = 'Tuesday2 must not be blank<br/>';
}
if ($tuesday === TRUE || $tuesday != '' || $tuesday2 === TRUE || $tuesday2 != '') {
    $data3 = $tuesday;
    $data4 = $tuesday2;
    $diff_seconds2 = strtotime($tuesday) - strtotime($tuesday2);
    $stat2 = floor($diff_seconds2 / 3600 * -1) . 'H:' . floor(($diff_seconds2 % 3600) / 60 * -1) . 'M';
    $tuesday = $data3 . '-' . $data4;
}
if ($tuesday === TRUE || $tuesday === 'OFF' || $tuesday2 === TRUE || $tuesday2 === 'OFF') {
    $tuesday = 'OFF';
}
if ($tuesday === 'OFF' && $tuesday2 != 'OFF') {
    $errorMessage['tuesday2'] = 'Incorrect times<br/>';
}
if ($tuesday != 'OFF' && $tuesday2 === 'OFF') {
    $errorMessage['tuesday2'] = 'Incorrect times<br/>';
}
/* TUESDAY END */

/* WEDNESDAY START */
if ($wednesday === FALSE || $wednesday === '') {
    $errorMessage['wednesday'] = 'Wednesday must not be blank<br/>';
}
if ($wednesday2 === FALSE || $wednesday2 === '') {
    $errorMessage['wednesday2'] = 'Wednesday2 must not be blank<br/>';
}
if ($wednesday === TRUE || $wednesday != '' || $wednesday2 === TRUE || $wednesday2 != '') {
    $data5 = $wednesday;
    $data6 = $wednesday2;
    $diff_seconds3 = strtotime($wednesday) - strtotime($wednesday2);
    $stat3 = floor($diff_seconds3 / 3600 * -1) . 'H:' . floor(($diff_seconds3 % 3600) / 60 * -1) . 'M';
    $wednesday = $data5 . '-' . $data6;
}
if ($wednesday === TRUE || $wednesday === 'OFF' || $wednesday2 === TRUE || $wednesday2 === 'OFF') {
    $wednesday = 'OFF';
}
if ($wednesday === 'OFF' && $wednesday2 != 'OFF') {
    $errorMessage['wednesday'] = 'Incorrect times<br/>';
}
if ($wednesday != 'OFF' && $wednesday2 === 'OFF') {
    $errorMessage['tuesday2'] = 'Incorrect times<br/>';
}
/* WEDNESDAY END */

/* THURSDAY START */
if ($thursday === FALSE || $thursday === '') {
    $errorMessage['thursday'] = 'Thursday must not be blank<br/>';
}
if ($thursday2 === FALSE || $thursday2 === '') {
    $errorMessage['thursday2'] = 'Thursday2 must not be blank<br/>';
}
if ($thursday === TRUE || $thursday != '' || $thursday2 === TRUE || $thursday2 != '') {
    $data7 = $thursday;
    $data8 = $thursday2;
    $diff_seconds4 = strtotime($thursday) - strtotime($thursday2);
    $stat4 = floor($diff_seconds4 / 3600 * -1) . 'H:' . floor(($diff_seconds4 % 3600) / 60 * -1) . 'M';
    $thursday = $data7 . '-' . $data8;
}
if ($thursday === TRUE || $thursday === 'OFF' || $thursday2 === TRUE || $thursday2 === 'OFF') {
    $thursday = 'OFF';
}
if ($thursday === 'OFF' && $thursday2 != 'OFF') {
    $errorMessage['thursday2'] = 'Incorrect times<br/>';
}
if ($thursday != 'OFF' && $thursday2 === 'OFF') {
    $errorMessage['thursday2'] = 'Incorrect times<br/>';
}
/* THURSDAY END */

/* FRIDAY START */
if ($friday === FALSE || $friday === '') {
    $errorMessage['friday'] = 'Friday must not be blank<br/>';
}
if ($friday2 === FALSE || $friday2 === '') {
    $errorMessage['friday2'] = 'Friday2 must not be blank<br/>';
}
if ($friday === TRUE || $friday != '' || $friday2 === TRUE || $friday2 != '') {
    $data9 = $friday;
    $data10 = $friday2;
    $diff_seconds5 = strtotime($friday) - strtotime($friday2);
    $stat5 = floor($diff_seconds5 / 3600 * -1) . 'H:' . floor(($diff_seconds5 % 3600) / 60 * -1) . 'M';
    $friday = $data9 . '-' . $data10;
}
if ($friday === TRUE || $friday === 'OFF' || $friday2 === TRUE || $friday2 === 'OFF') {
    $friday = 'OFF';
}
if ($friday === 'OFF' && $friday2 != 'OFF') {
    $errorMessage['friday2'] = 'Incorrect times<br/>';
}
if ($friday != 'OFF' && $friday2 === 'OFF') {
    $errorMessage['friday2'] = 'Incorrect times<br/>';
}
/* FRIDAY END */

/* SATURDAY START */
if ($saturday === FALSE || $saturday === '') {
    $errorMessage['saturday'] = 'Saturday must not be blank<br/>';
}
if ($saturday2 === FALSE || $saturday2 === '') {
    $errorMessage['saturday2'] = 'Saturday2 must not be blank<br/>';
}
if ($saturday === TRUE || $saturday != '' || $saturday2 === TRUE || $saturday2 != '') {
    $data11 = $saturday;
    $data12 = $saturday2;
    $diff_seconds6 = strtotime($saturday) - strtotime($saturday2);
    $stat6 = floor($diff_seconds6 / 3600 * -1) . 'H:' . floor(($diff_seconds6 % 3600) / 60 * -1) . 'M';
    $saturday = $data11 . '-' . $data12;
}
if ($saturday === TRUE || $saturday === 'OFF' || $saturday2 === TRUE || $saturday2 === 'OFF') {
    $saturday = 'OFF';
}
if ($saturday === 'OFF' && $saturday2 != 'OFF') {
    $errorMessage['saturday2'] = 'Incorrect times<br/>';
}
if ($saturday != 'OFF' && $saturday2 === 'OFF') {
    $errorMessage['saturday2'] = 'Incorrect times<br/>';
}
/* SATURDAY END */

/* SUNDAY START */
if ($sunday === FALSE || $sunday === '') {
    $errorMessage['sunday'] = 'Sunday must not be blank<br/>';
}
if ($sunday2 === FALSE || $sunday2 === '') {
    $errorMessage['sunday2'] = 'Sunday2 must not be blank<br/>';
}
if ($sunday === TRUE || $sunday != '' || $sunday2 === TRUE || $sunday2 != '') {
    $data13 = $sunday;
    $data14 = $sunday2;
    $diff_seconds7 = strtotime($sunday) - strtotime($sunday2);
    $stat7 = floor($diff_seconds7 / 3600 * -1) . 'H:' . floor(($diff_seconds7 % 3600) / 60 * -1) . 'M';
    $sunday = $data13 . '-' . $data14;
}
if ($sunday === TRUE || $sunday === 'OFF' || $sunday2 === TRUE || $sunday2 === 'OFF') {
    $sunday = 'OFF';
}
if ($sunday === 'OFF' && $sunday2 != 'OFF') {
    $errorMessage['sunday2'] = 'Incorrect times<br/>';
}
if ($sunday != 'OFF' && $sunday2 === 'OFF') {
    $errorMessage['sunday2'] = 'Incorrect times<br/>';
}
/* SUNDAY END */
if ($employeeID === FALSE || $employeeID === '') {
    $errorMessage['employeeID'] = '* Employee ID ID must not be blank<br/>';
}
$total = $stat1 + $stat2 + $stat3 + $stat4 + $stat5 + $stat6 + $stat7;
if ($total === 0 . 'Hrs') {
    $total = 'Null';
}

$titleInt = (int) $title; //convert title to integer
if ($titleInt === $weekNumberInt) { //check if roster is made for current week
    $description = $mondayDate . '-' . $sundayDate . '(' . $monthResult . ')';
} else if ($titleInt === ($NextWeekNumberInt)) { //check if roster is made for Next week
    $description = $nextMondayDate . '-' . $nextSundayDate . '(' . $monthResult . ')';
} else if ($titleInt === ($NextWeekNumberInt + 1)) { //check if roster is made for Next week
    $description = $mondayDateTwoWeekAhead . '-' . $sundayDateTwoWeekAhead . '(' . $monthResult . ')';
} else if ($titleInt === ($NextWeekNumberInt + 2)) { //check if roster is made for Next week
    $description = $mondayDateThreeWeekAhead . '-' . $sundayDateThreeWeekAhead . '(' . $monthResult . ')'; //Value takes start week date and end week date plus current month value e.g (01-08(Feb))
} else if ($titleInt === ($NextWeekNumberInt + 3)) { //check if roster is made for Next week
    $description = $mondayDateFourWeekAhead . '-' . $sundayDateFourWeekAhead . '(' . $monthResult . ')';
}

if (true) { //If there is no errors
    $gateway->updateRoster($rosterID, $title, $description, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday, $total, $employeeID); //Pass values in to be updated in th database table roster
    header('Location: HomeRosters.php'); //Return to HomeRosters 
}
/* when the array if/ else statements are not met */ else {
    require 'editRosterForm.php'; //Return to editRosterForm class
}
