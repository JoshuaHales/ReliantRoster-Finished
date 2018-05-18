<script type="text/javascript" src="js/roster.js"></script>
<?php
//requiring Event.php as some of its elements are needed in this page
require 'Styles2.php';
require 'Styles.php';
require 'Scripts.php';
require_once 'Roster.php';
require_once 'Connection.php';
require_once 'RosterTableGateway.php';
require 'ensureUserLoggedIn.php';
require_once 'EmployeeTableGateway.php';
require 'UserTableGateway.php';

$weekNumber = date("W");                //week number
$weekNumberInt = (int) $weekNumber;

$NextWeekNumberInt = $weekNumberInt + 1;
if ($NextWeekNumberInt > 52) {          //checks if new week started
    $NextWeekNumberInt = 1;             //assigns value of week 1
}
$username = $_SESSION['username'];
$id = session_id();
if ($id == "") {
    session_start();
}
require 'ensureUserLoggedIn.php';

/* Starts a new session if session is == to nothing */
if (!isset($_GET) || !isset($_GET['id'])) {
    die('Invalid request');
}
$rosterID = $_GET['id'];
$connection = Connection::getInstance();
$gateway = new RosterTableGateway($connection);
$conn = Connection::getInstance();
$employeeGateway = new EmployeeTableGateway($conn);
$employees = $employeeGateway->getEmployees("name");


$statement = $gateway->getRosterByID($rosterID);
if ($statement->rowCount() !== 1) {
    die("Illegal request");
}
$row = $statement->fetch(PDO::FETCH_ASSOC);


$userGateway = new UserTableGateway($conn);
$usersIDRetrieved = $userGateway->getUser("id");
$theUsersID = $userGateway->getUserIDByUsername($username);
$theUserIDValue = $theUsersID->fetch(PDO::FETCH_ASSOC);
$fff = $theUserIDValue['id']; //change these variable names
$users = $userGateway->getUserByID($fff);
$user = $users->fetch(PDO::FETCH_ASSOC);

$customeWeeks = $user['customTime'];
list($customWeek1, $customWeek2, $customWeek3, $customStartTime1, $customStartTime2, $customStartTime3, $customEndTime1, $customEndTime2, $customEndTime3) = explode('#', $customeWeeks); //parses until comes along #
//chopping up each to get the start and end time
list($customWeek1Start, $customWeek1End) = explode('-', $customWeek1); //parses until comes along -
list($customWeek2Start, $customWeek2End) = explode('-', $customWeek2); //parses until comes along -
list($customWeek3Start, $customWeek3End) = explode('-', $customWeek3); //parses until comes along -


/* Check if user is logged in */
if (!isset($_SESSION['username'])) {
    header("Location: checkLogin.php");
}
?>

<!DOCTYPE html>
<!-- All the CSS and HTML Code -->
<html>
    <head>
        <script type="text/javascript" src="Js/jquery.timepicker.js"></script>
        <script type="text/javascript" src="Js/bootstrap-datepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="Css/site.css" />
        <title>Edit Roster</title>
    </head>
    <body>
        <?php
        require 'navBar.php'; //Vavigation Bar-
        require 'sideBar.php'; //start Sidebar 
        ?>  
        <?php
        if (isset($message)) {
            echo '<p>' . $message . '</p>';
        }
        ?>
        <script>
            function setWeek9_5() {
                document.getElementById('timeformatExample1').value = '9:00am';
                document.getElementById('timeformatExample3').value = '9:00am';
                document.getElementById('timeformatExample5').value = '9:00am';
                document.getElementById('timeformatExample7').value = '9:00am';
                document.getElementById('timeformatExample9').value = '9:00am';
                document.getElementById('timeformatExample11').value = '9:00am';
                document.getElementById('timeformatExample13').value = '9:00am';
                document.getElementById('timeformatExample2').value = '5:00pm';
                document.getElementById('timeformatExample4').value = '5:00pm';
                document.getElementById('timeformatExample6').value = '5:00pm';
                document.getElementById('timeformatExample8').value = '5:00pm';
                document.getElementById('timeformatExample10').value = '5:00pm';
                document.getElementById('timeformatExample12').value = '5:00pm';
                document.getElementById('timeformatExample14').value = '5:00pm';
            }
            function setWeek8_4() {
                document.getElementById('timeformatExample1').value = '8:00am';
                document.getElementById('timeformatExample3').value = '8:00am';
                document.getElementById('timeformatExample5').value = '8:00am';
                document.getElementById('timeformatExample7').value = '8:00am';
                document.getElementById('timeformatExample9').value = '8:00am';
                document.getElementById('timeformatExample11').value = '8:00am';
                document.getElementById('timeformatExample13').value = '8:00am';
                document.getElementById('timeformatExample2').value = '4:00pm';
                document.getElementById('timeformatExample4').value = '4:00pm';
                document.getElementById('timeformatExample6').value = '4:00pm';
                document.getElementById('timeformatExample8').value = '4:00pm';
                document.getElementById('timeformatExample10').value = '4:00pm';
                document.getElementById('timeformatExample12').value = '4:00pm';
                document.getElementById('timeformatExample14').value = '4:00pm';
            }
            function setWeek7_3() {
                document.getElementById('timeformatExample1').value = '7:00am';
                document.getElementById('timeformatExample3').value = '7:00am';
                document.getElementById('timeformatExample5').value = '7:00am';
                document.getElementById('timeformatExample7').value = '7:00am';
                document.getElementById('timeformatExample9').value = '7:00am';
                document.getElementById('timeformatExample11').value = '7:00am';
                document.getElementById('timeformatExample13').value = '7:00am';
                document.getElementById('timeformatExample2').value = '3:00pm';
                document.getElementById('timeformatExample4').value = '3:00pm';
                document.getElementById('timeformatExample6').value = '3:00pm';
                document.getElementById('timeformatExample8').value = '3:00pm';
                document.getElementById('timeformatExample10').value = '3:00pm';
                document.getElementById('timeformatExample12').value = '3:00pm';
                document.getElementById('timeformatExample14').value = '3:00pm';
            }
            function setWeek6_2() {
                document.getElementById('timeformatExample1').value = '6:00am';
                document.getElementById('timeformatExample3').value = '6:00am';
                document.getElementById('timeformatExample5').value = '6:00am';
                document.getElementById('timeformatExample7').value = '6:00am';
                document.getElementById('timeformatExample9').value = '6:00am';
                document.getElementById('timeformatExample11').value = '6:00am';
                document.getElementById('timeformatExample13').value = '6:00am';
                document.getElementById('timeformatExample2').value = '2:00pm';
                document.getElementById('timeformatExample4').value = '2:00pm';
                document.getElementById('timeformatExample6').value = '2:00pm';
                document.getElementById('timeformatExample8').value = '2:00pm';
                document.getElementById('timeformatExample10').value = '2:00pm';
                document.getElementById('timeformatExample12').value = '2:00pm';
                document.getElementById('timeformatExample14').value = '2:00pm';
            }
            function setStart6() {
                document.getElementById('timeformatExample1').value = '6:00am';
                document.getElementById('timeformatExample3').value = '6:00am';
                document.getElementById('timeformatExample5').value = '6:00am';
                document.getElementById('timeformatExample7').value = '6:00am';
                document.getElementById('timeformatExample9').value = '6:00am';
                document.getElementById('timeformatExample11').value = '6:00am';
                document.getElementById('timeformatExample13').value = '6:00am';
            }
            function setStart7() {
                document.getElementById('timeformatExample1').value = '7:00am';
                document.getElementById('timeformatExample3').value = '7:00am';
                document.getElementById('timeformatExample5').value = '7:00am';
                document.getElementById('timeformatExample7').value = '7:00am';
                document.getElementById('timeformatExample9').value = '7:00am';
                document.getElementById('timeformatExample11').value = '7:00am';
                document.getElementById('timeformatExample13').value = '7:00am';
            }
            function setStart8() {
                document.getElementById('timeformatExample1').value = '8:00am';
                document.getElementById('timeformatExample3').value = '8:00am';
                document.getElementById('timeformatExample5').value = '8:00am';
                document.getElementById('timeformatExample7').value = '8:00am';
                document.getElementById('timeformatExample9').value = '8:00am';
                document.getElementById('timeformatExample11').value = '8:00am';
                document.getElementById('timeformatExample13').value = '8:00am';
            }
            function setStart9() {
                document.getElementById('timeformatExample1').value = '9:00am';
                document.getElementById('timeformatExample3').value = '9:00am';
                document.getElementById('timeformatExample5').value = '9:00am';
                document.getElementById('timeformatExample7').value = '9:00am';
                document.getElementById('timeformatExample9').value = '9:00am';
                document.getElementById('timeformatExample11').value = '9:00am';
                document.getElementById('timeformatExample13').value = '9:00am';
            }
            function setStart10() {
                document.getElementById('timeformatExample1').value = '10:00am';
                document.getElementById('timeformatExample3').value = '10:00am';
                document.getElementById('timeformatExample5').value = '10:00am';
                document.getElementById('timeformatExample7').value = '10:00am';
                document.getElementById('timeformatExample9').value = '10:00am';
                document.getElementById('timeformatExample11').value = '10:00am';
                document.getElementById('timeformatExample13').value = '10:00am';
            }
            function setStart11() {
                document.getElementById('timeformatExample1').value = '11:00am';
                document.getElementById('timeformatExample3').value = '11:00am';
                document.getElementById('timeformatExample5').value = '11:00am';
                document.getElementById('timeformatExample7').value = '11:00am';
                document.getElementById('timeformatExample9').value = '11:00am';
                document.getElementById('timeformatExample11').value = '11:00am';
                document.getElementById('timeformatExample13').value = '11:00am';
            }

            //End Times Autofill
            function setEnd2() {
                document.getElementById('timeformatExample2').value = '2:00pm';
                document.getElementById('timeformatExample4').value = '2:00pm';
                document.getElementById('timeformatExample6').value = '2:00pm';
                document.getElementById('timeformatExample8').value = '2:00pm';
                document.getElementById('timeformatExample10').value = '2:00pm';
                document.getElementById('timeformatExample12').value = '2:00pm';
                document.getElementById('timeformatExample14').value = '2:00pm';
            }
            function setEnd3() {
                document.getElementById('timeformatExample2').value = '3:00pm';
                document.getElementById('timeformatExample4').value = '3:00pm';
                document.getElementById('timeformatExample6').value = '3:00pm';
                document.getElementById('timeformatExample8').value = '3:00pm';
                document.getElementById('timeformatExample10').value = '3:00pm';
                document.getElementById('timeformatExample12').value = '3:00pm';
                document.getElementById('timeformatExample14').value = '3:00pm';
            }
            function setEnd4() {
                document.getElementById('timeformatExample2').value = '4:00pm';
                document.getElementById('timeformatExample4').value = '4:00pm';
                document.getElementById('timeformatExample6').value = '4:00pm';
                document.getElementById('timeformatExample8').value = '4:00pm';
                document.getElementById('timeformatExample10').value = '4:00pm';
                document.getElementById('timeformatExample12').value = '4:00pm';
                document.getElementById('timeformatExample14').value = '4:00pm';
            }
            function setEnd5() {
                document.getElementById('timeformatExample2').value = '5:00pm';
                document.getElementById('timeformatExample4').value = '5:00pm';
                document.getElementById('timeformatExample6').value = '5:00pm';
                document.getElementById('timeformatExample8').value = '5:00pm';
                document.getElementById('timeformatExample10').value = '5:00pm';
                document.getElementById('timeformatExample12').value = '5:00pm';
                document.getElementById('timeformatExample14').value = '5:00pm';
            }
            function setEnd6() {
                document.getElementById('timeformatExample2').value = '6:00pm';
                document.getElementById('timeformatExample4').value = '6:00pm';
                document.getElementById('timeformatExample6').value = '6:00pm';
                document.getElementById('timeformatExample8').value = '6:00pm';
                document.getElementById('timeformatExample10').value = '6:00pm';
                document.getElementById('timeformatExample12').value = '6:00pm';
                document.getElementById('timeformatExample14').value = '6:00pm';
            }
            function setEnd7() {
                document.getElementById('timeformatExample2').value = '7:00pm';
                document.getElementById('timeformatExample4').value = '7:00pm';
                document.getElementById('timeformatExample6').value = '7:00pm';
                document.getElementById('timeformatExample8').value = '7:00pm';
                document.getElementById('timeformatExample10').value = '7:00pm';
                document.getElementById('timeformatExample12').value = '7:00pm';
                document.getElementById('timeformatExample14').value = '7:00pm';
            }
            //custom week 1
            function setCustomWeek1() {
                //start time
                document.getElementById('timeformatExample1').value = <?php echo json_encode($customWeek1Start); ?>;
                document.getElementById('timeformatExample3').value = <?php echo json_encode($customWeek1Start); ?>;
                document.getElementById('timeformatExample5').value = <?php echo json_encode($customWeek1Start); ?>;
                document.getElementById('timeformatExample7').value = <?php echo json_encode($customWeek1Start); ?>;
                document.getElementById('timeformatExample9').value = <?php echo json_encode($customWeek1Start); ?>;
                document.getElementById('timeformatExample11').value = <?php echo json_encode($customWeek1Start); ?>;
                document.getElementById('timeformatExample13').value = <?php echo json_encode($customWeek1Start); ?>;
                //end time
                document.getElementById('timeformatExample2').value = <?php echo json_encode($customWeek1End); ?>;
                document.getElementById('timeformatExample4').value = <?php echo json_encode($customWeek1End); ?>;
                document.getElementById('timeformatExample6').value = <?php echo json_encode($customWeek1End); ?>;
                document.getElementById('timeformatExample8').value = <?php echo json_encode($customWeek1End); ?>;
                document.getElementById('timeformatExample10').value =<?php echo json_encode($customWeek1End); ?>;
                document.getElementById('timeformatExample12').value =<?php echo json_encode($customWeek1End); ?>;
                document.getElementById('timeformatExample14').value =<?php echo json_encode($customWeek1End); ?>;
            }
            //custom week 2
            function setCustomWeek2() {
                //start time
                document.getElementById('timeformatExample1').value = <?php echo json_encode($customWeek2Start); ?>;
                document.getElementById('timeformatExample3').value = <?php echo json_encode($customWeek2Start); ?>;
                document.getElementById('timeformatExample5').value = <?php echo json_encode($customWeek2Start); ?>;
                document.getElementById('timeformatExample7').value = <?php echo json_encode($customWeek2Start); ?>;
                document.getElementById('timeformatExample9').value = <?php echo json_encode($customWeek2Start); ?>;
                document.getElementById('timeformatExample11').value = <?php echo json_encode($customWeek2Start); ?>;
                document.getElementById('timeformatExample13').value = <?php echo json_encode($customWeek2Start); ?>;
                //end time
                document.getElementById('timeformatExample2').value = <?php echo json_encode($customWeek2End); ?>;
                document.getElementById('timeformatExample4').value = <?php echo json_encode($customWeek2End); ?>;
                document.getElementById('timeformatExample6').value = <?php echo json_encode($customWeek2End); ?>;
                document.getElementById('timeformatExample8').value = <?php echo json_encode($customWeek2End); ?>;
                document.getElementById('timeformatExample10').value =<?php echo json_encode($customWeek2End); ?>;
                document.getElementById('timeformatExample12').value =<?php echo json_encode($customWeek2End); ?>;
                document.getElementById('timeformatExample14').value =<?php echo json_encode($customWeek2End); ?>;

            }
            //custom week 3
            function setCustomWeek3() {
                document.getElementById('timeformatExample1').value = <?php echo json_encode($customWeek3Start); ?>;
                document.getElementById('timeformatExample3').value = <?php echo json_encode($customWeek3Start); ?>;
                document.getElementById('timeformatExample5').value = <?php echo json_encode($customWeek3Start); ?>;
                document.getElementById('timeformatExample7').value = <?php echo json_encode($customWeek3Start); ?>;
                document.getElementById('timeformatExample9').value = <?php echo json_encode($customWeek3Start); ?>;
                document.getElementById('timeformatExample11').value = <?php echo json_encode($customWeek3Start); ?>;
                document.getElementById('timeformatExample13').value = <?php echo json_encode($customWeek3Start); ?>;
                //end time
                document.getElementById('timeformatExample2').value = <?php echo json_encode($customWeek3End); ?>;
                document.getElementById('timeformatExample4').value = <?php echo json_encode($customWeek3End); ?>;
                document.getElementById('timeformatExample6').value = <?php echo json_encode($customWeek3End); ?>;
                document.getElementById('timeformatExample8').value = <?php echo json_encode($customWeek3End); ?>;
                document.getElementById('timeformatExample10').value =<?php echo json_encode($customWeek3End); ?>;
                document.getElementById('timeformatExample12').value =<?php echo json_encode($customWeek3End); ?>;
                document.getElementById('timeformatExample14').value =<?php echo json_encode($customWeek3End); ?>;
            }
            //custom start time 1
            function setCustomStartTime1() {
                document.getElementById('timeformatExample1').value = <?php echo json_encode($customStartTime1); ?>;
                document.getElementById('timeformatExample3').value = <?php echo json_encode($customStartTime1); ?>;
                document.getElementById('timeformatExample5').value = <?php echo json_encode($customStartTime1); ?>;
                document.getElementById('timeformatExample7').value = <?php echo json_encode($customStartTime1); ?>;
                document.getElementById('timeformatExample9').value = <?php echo json_encode($customStartTime1); ?>;
                document.getElementById('timeformatExample11').value = <?php echo json_encode($customStartTime1); ?>;
                document.getElementById('timeformatExample13').value = <?php echo json_encode($customStartTime1); ?>;
            }
            //custom start time 2
            function setCustomStartTime2() {
                document.getElementById('timeformatExample1').value = <?php echo json_encode($customStartTime2); ?>;
                document.getElementById('timeformatExample3').value = <?php echo json_encode($customStartTime2); ?>;
                document.getElementById('timeformatExample5').value = <?php echo json_encode($customStartTime2); ?>;
                document.getElementById('timeformatExample7').value = <?php echo json_encode($customStartTime2); ?>;
                document.getElementById('timeformatExample9').value = <?php echo json_encode($customStartTime2); ?>;
                document.getElementById('timeformatExample11').value = <?php echo json_encode($customStartTime2); ?>;
                document.getElementById('timeformatExample13').value = <?php echo json_encode($customStartTime2); ?>;
            }
            //custom start time 3
            function setCustomStartTime3() {
                document.getElementById('timeformatExample1').value = <?php echo json_encode($customStartTime3); ?>;
                document.getElementById('timeformatExample3').value = <?php echo json_encode($customStartTime3); ?>;
                document.getElementById('timeformatExample5').value = <?php echo json_encode($customStartTime3); ?>;
                document.getElementById('timeformatExample7').value = <?php echo json_encode($customStartTime3); ?>;
                document.getElementById('timeformatExample9').value = <?php echo json_encode($customStartTime3); ?>;
                document.getElementById('timeformatExample11').value = <?php echo json_encode($customStartTime3); ?>;
                document.getElementById('timeformatExample13').value = <?php echo json_encode($customStartTime3); ?>;
            }
            //custom end time 1
            function setCustomEndTime1() {
                document.getElementById('timeformatExample2').value = <?php echo json_encode($customEndTime1); ?>;
                document.getElementById('timeformatExample4').value = <?php echo json_encode($customEndTime1); ?>;
                document.getElementById('timeformatExample6').value = <?php echo json_encode($customEndTime1); ?>;
                document.getElementById('timeformatExample8').value = <?php echo json_encode($customEndTime1); ?>;
                document.getElementById('timeformatExample10').value =<?php echo json_encode($customEndTime1); ?>;
                document.getElementById('timeformatExample12').value =<?php echo json_encode($customEndTime1); ?>;
                document.getElementById('timeformatExample14').value =<?php echo json_encode($customEndTime1); ?>;
            }
            //custom end time 2
            function setCustomEndTime2() {
                document.getElementById('timeformatExample2').value = <?php echo json_encode($customEndTime2); ?>;
                document.getElementById('timeformatExample4').value = <?php echo json_encode($customEndTime2); ?>;
                document.getElementById('timeformatExample6').value = <?php echo json_encode($customEndTime2); ?>;
                document.getElementById('timeformatExample8').value = <?php echo json_encode($customEndTime2); ?>;
                document.getElementById('timeformatExample10').value =<?php echo json_encode($customEndTime2); ?>;
                document.getElementById('timeformatExample12').value =<?php echo json_encode($customEndTime2); ?>;
                document.getElementById('timeformatExample14').value =<?php echo json_encode($customEndTime2); ?>;
            }
            //custom end time 3
            function setCustomEndTime3() {
                document.getElementById('timeformatExample2').value = <?php echo json_encode($customEndTime3); ?>;
                document.getElementById('timeformatExample4').value = <?php echo json_encode($customEndTime3); ?>;
                document.getElementById('timeformatExample6').value = <?php echo json_encode($customEndTime3); ?>;
                document.getElementById('timeformatExample8').value = <?php echo json_encode($customEndTime3); ?>;
                document.getElementById('timeformatExample10').value =<?php echo json_encode($customEndTime3); ?>;
                document.getElementById('timeformatExample12').value =<?php echo json_encode($customEndTime3); ?>;
                document.getElementById('timeformatExample14').value =<?php echo json_encode($customEndTime3); ?>;
            }
        </script>
        <h1 class="col-lg-offset-4">Edit Roster</h1>
      
            <div class="col-lg-4 col-md-5 col-sm-12 col-sm-offset-3 col-md-offset-2 main pushDown5" >
                  
                <div id="page-wrapper" >
                    <?php //require 'BubbleButtons.php'; ?>
                    <div id="page-inner">
                        <div class="visible-xs" style="margin-top: 15%;"></div >
                        <div class="panel panel-default" style="margin-top: -.1%;">
                                <div class="panel-heading">
                                    <span class="glyphicon glyphicon-pencil"></span> Edit <?php echo $row['name']; ?>'s roster </div>
                                <div class="panel-body">  
                                    <form id="editRosterForm" name="editRosterForm" role="form" class="well col-lg-10 col-md-11 col-sm-9 col-lg-offset-1" action="editRoster.php" method="POST">
                                        <input type="hidden" name="rosterID" value="<?php echo $rosterID; ?>" />
                                        <table border="0"> 
                                            <tbody>
                                                <tr>
                                                    <!--table data-->
                                                    <td>Week</td>
                                                    <td>
                                                        <select type="number" class="inputFieldPush form-control" name="title" value="<?php
                                                        if (isset($_POST) && isset($_POST['title'])) {
                                                            echo $_POST['title'];
                                                        }
                                                        ?>" >
                                                                    <?php
                                                                    //$numOfWeeks = $weekNumber + 2;
                                                                    echo '<option>' . ($weekNumberInt) . '</option>';
                                                                    echo '<option>' . ($NextWeekNumberInt) . '</option>';
                                                                    echo '<option>' . ($NextWeekNumberInt + 1) . '</option>';
                                                                    echo '<option>' . ($NextWeekNumberInt + 2) . '</option>';
                                                                    echo '<option>' . ($NextWeekNumberInt + 3) . '</option>';
                                                                    //$numOfWeeks = $numOfWeeks - 1;
                                                                    ?>

                                                        </select>
                                                        <!--giving the input box an id and errorcode id to call it later to check for errors etc-->
                                                        <span id="titleError" class="error">
                                                            <?php
                                                            if (isset($errorMessage) && isset($errorMessage['title'])) {
                                                                echo $errorMessage['title'];
                                                            }
                                                            ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <!--next table data-->
                                                    <td>Monday</td>
                                                    <td>
                                                        <input id="timeformatExample1" type="text" class="time " name="monday" placeholder="Start-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['monday'])) {
                                                            echo $_POST['monday'];
                                                        } else {
                                                            //-----parses the string until it gets a '-' (this is the starting time----
                                                            if ($row['monday'] !== 'OFF') {
                                                                $extractTime = $row['monday'];
                                                                list($start, $finish) = explode('-', $extractTime);
                                                                echo $start;
                                                            } else {
                                                                echo "OFF";
                                                            }
                                                        }
                                                        ?>" />
                                                        <input id="timeformatExample2" type="text" class="time" name="monday2" placeholder="End-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['monday2'])) {
                                                            echo $_POST['monday2'];
                                                        } else {
                                                            //-----parses the string until it gets a '-' (this is the starting time----
                                                            if ($row['monday'] !== 'OFF') {
                                                                $extractTime = $row['monday'];
                                                                list($start, $finish) = explode('-', $extractTime);
                                                                echo $finish;
                                                            } else {
                                                                echo "OFF";
                                                            }
                                                        }
                                                        ?>" />
                                                        <!--giving the input box an id and error code id to call it later to check for errors etc-->
                                                        <span id="mondayError" class="error">
                                                            <?php
                                                            if (isset($errorMessage) && isset($errorMessage['monday'])) {
                                                                echo $errorMessage['monday'];
                                                            }
                                                            ?>
                                                        </span>
                                                        <script>
                                                            $(function() {
                                                                $('#timeformatExample1').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                                $('#timeformatExample2').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                            });
                                                        </script>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <!--next table data-->
                                                    <td>Tuesday</td>
                                                    <td>
                                                        <input id="timeformatExample3" type="text" class="time" name="tuesday" placeholder="Start-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['tuesday'])) {
                                                            echo $_POST['tuesday'];
                                                        } else {
                                                            //-----parses the string until it gets a '-' (this is the starting time----
                                                            if ($row['tuesday'] !== 'OFF') {
                                                                $extractTime = $row['tuesday'];
                                                                list($start, $finish) = explode('-', $extractTime);
                                                                echo $start;
                                                            } else {
                                                                echo "OFF";
                                                            }
                                                        }
                                                        ?>" />
                                                        <input id="timeformatExample4" type="text" class="time" name="tuesday2" placeholder="End-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['tuesday2'])) {
                                                            echo $_POST['tuesday2'];
                                                        } else {
                                                            //-----parses the string until it gets a '-' (this is the starting time----
                                                            if ($row['tuesday'] !== 'OFF') {
                                                                $extractTime = $row['tuesday'];
                                                                list($start, $finish) = explode('-', $extractTime);
                                                                echo $finish;
                                                            } else {
                                                                echo "OFF";
                                                            }
                                                        }
                                                        ?>" />
                                                        <!--giving the input box an id and error code id to call it later to check for errors etc-->
                                                        <span id="tuesdayError" class="error">
                                                            <?php
                                                            if (isset($errorMessage) && isset($errorMessage['tuesday'])) {
                                                                echo $errorMessage['tuesday'];
                                                            }
                                                            ?>
                                                        </span>
                                                        <script>
                                                            $(function() {
                                                                $('#timeformatExample3').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                                $('#timeformatExample4').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                            });
                                                        </script>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <!--next table data-->
                                                    <td>Wednesday</td>
                                                    <td>
                                                        <input id="timeformatExample5" type="text" class="time" name="wednesday" placeholder="Start-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['wednesday'])) {
                                                            echo $_POST['wednesday'];
                                                        } else {
                                                            //-----parses the string until it gets a '-' (this is the starting time----
                                                            if ($row['wednesday'] !== 'OFF') {
                                                                $extractTime = $row['wednesday'];
                                                                list($start, $finish) = explode('-', $extractTime);
                                                                echo $start;
                                                            } else {
                                                                echo"OFF";
                                                            }
                                                        }
                                                        ?>" />
                                                        <input id="timeformatExample6" type="text" class="time" name="wednesday2" placeholder="End-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['wednesday2'])) {
                                                            echo $_POST['wednesday2'];
                                                        } else {
                                                            //-----parses the string until it gets a '-' (this is the starting time----
                                                            if ($row['wednesday'] !== 'OFF') {
                                                                $extractTime = $row['wednesday'];
                                                                list($start, $finish) = explode('-', $extractTime);
                                                                echo $finish;
                                                            } else {
                                                                echo"OFF";
                                                            }
                                                        }
                                                        ?>" />
                                                        <!--giving the input box an id and error code id to call it later to check for errors etc-->
                                                        <span id="wednesdayError" class="error">
                                                            <?php
                                                            if (isset($errorMessage) && isset($errorMessage['wednesday'])) {
                                                                echo $errorMessage['wednesday'];
                                                            }
                                                            ?>
                                                        </span>
                                                        <script>
                                                            $(function() {
                                                                $('#timeformatExample5').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                                $('#timeformatExample6').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                            });
                                                        </script>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <!--next table data-->
                                                    <td>Thursday</td>
                                                    <td>
                                                        <input id="timeformatExample7" type="text" class="time" name="thursday" placeholder="Start-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['thursday'])) {
                                                            echo $_POST['thursday'];
                                                        } else {
                                                            //-----parses the string until it gets a '-' (this is the starting time----
                                                            if ($row['thursday'] !== 'OFF') {
                                                                $extractTime = $row['thursday'];
                                                                list($start, $finish) = explode('-', $extractTime);
                                                                echo $start;
                                                            } else {
                                                                echo"OFF";
                                                            }
                                                        }
                                                        ?>" />
                                                        </span>
                                                        <input id="timeformatExample8" type="text" class="time" name="thursday2" placeholder="End-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['thursday2'])) {
                                                            echo $_POST['thursday2'];
                                                        } else {
                                                            //-----parses the string until it gets a '-' (this is the starting time----
                                                            if ($row['thursday'] !== 'OFF') {
                                                                $extractTime = $row['thursday'];
                                                                list($start, $finish) = explode('-', $extractTime);
                                                                echo $finish;
                                                            } else {
                                                                echo"OFF";
                                                            }
                                                        }
                                                        ?>" />
                                                        <!--giving the input box an id and error code id to call it later to check for errors etc-->
                                                        <span id="thursdayError" class="error">
                                                            <?php
                                                            if (isset($errorMessage) && isset($errorMessage['thursday'])) {
                                                                echo $errorMessage['thursday'];
                                                            }
                                                            ?>
                                                            <script>
                                                                $(function() {
                                                                    $('#timeformatExample7').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                                    $('#timeformatExample8').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                                });
                                                            </script>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <!--next table data-->
                                                    <td>Friday</td>
                                                    <td>
                                                        <input id="timeformatExample9" type="text" class="time" name="friday" placeholder="Start-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['friday'])) {
                                                            echo $_POST['friday'];
                                                        } else {
                                                            //-----parses the string until it gets a '-' (this is the starting time----
                                                            if ($row['friday'] !== 'OFF') {
                                                                $extractTime = $row['friday'];
                                                                list($start, $finish) = explode('-', $extractTime);
                                                                echo $start;
                                                            } else {
                                                                echo"OFF";
                                                            }
                                                        }
                                                        ?>" />
                                                        <input id="timeformatExample10" type="text" class="time" name="friday2" placeholder="End-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['friday2'])) {
                                                            echo $_POST['friday2'];
                                                        } else {
                                                            //-----parses the string until it gets a '-' (this is the starting time----
                                                            if ($row['friday'] !== 'OFF') {
                                                                $extractTime = $row['friday'];
                                                                list($start, $finish) = explode('-', $extractTime);
                                                                echo $finish;
                                                            } else {
                                                                echo"OFF";
                                                            }
                                                        }
                                                        ?>" />
                                                        <!--giving the input box an id and error code id to call it later to check for errors etc-->
                                                        <span id="fridayError" class="error">
                                                            <?php
                                                            if (isset($errorMessage) && isset($errorMessage['friday'])) {
                                                                echo $errorMessage['friday'];
                                                            }
                                                            ?>
                                                        </span>
                                                        <script>
                                                            $(function() {
                                                                $('#timeformatExample9').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                                $('#timeformatExample10').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                            });
                                                        </script>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <!--next table data-->
                                                    <td>Saturday</td>
                                                    <td>
                                                        <input id="timeformatExample11" type="text" class="time" name="saturday" placeholder="Start-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['saturday'])) {
                                                            echo $_POST['saturday'];
                                                        } else {
                                                            //-----parses the string until it gets a '-' (this is the starting time----
                                                            if ($row['saturday'] !== 'OFF') {
                                                                $extractTime = $row['saturday'];
                                                                list($start, $finish) = explode('-', $extractTime);
                                                                echo $start;
                                                            } else {
                                                                echo"OFF";
                                                            }
                                                        }
                                                        ?>" />
                                                        <input id="timeformatExample12" type="text" class="time" name="saturday2" placeholder="End-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['saturday2'])) {
                                                            echo $_POST['saturday2'];
                                                        } else {
                                                            //-----parses the string until it gets a '-' (this is the starting time----
                                                            if ($row['saturday'] !== 'OFF') {
                                                                $extractTime = $row['saturday'];
                                                                list($start, $finish) = explode('-', $extractTime);
                                                                echo $finish;
                                                            } else {
                                                                echo "OFF";
                                                            }
                                                        }
                                                        ?>" />
                                                        <!--giving the input box an id and error code id to call it later to check for errors etc-->
                                                        <span id="saturdayError" class="error">
                                                            <?php
                                                            if (isset($errorMessage) && isset($errorMessage['saturday'])) {
                                                                echo $errorMessage['saturday'];
                                                            }
                                                            ?>
                                                        </span>
                                                        <script>
                                                            $(function() {
                                                                $('#timeformatExample11').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                                $('#timeformatExample12').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                            });
                                                        </script>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <!--next table data-->
                                                    <td>Sunday</td>
                                                    <td>
                                                        <input id="timeformatExample13" type="text" class="time " name="sunday" placeholder="Start-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['sunday'])) {
                                                            echo $_POST['sunday'];
                                                        } else {
                                                            //-----parses the string until it gets a '-' (this is the starting time----
                                                            if ($row['sunday'] !== 'OFF') {
                                                                $extractTime = $row['sunday'];
                                                                list($start, $finish) = explode('-', $extractTime);
                                                                echo $start;
                                                            } else {
                                                                echo"OFF";
                                                            }
                                                        }
                                                        ?>" />
                                                        <input id="timeformatExample14" type="text" class="time" name="sunday2" placeholder="End-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['sunday2'])) {
                                                            echo $_POST['sunday2'];
                                                        } else {
                                                            //-----parses the string until it gets a '-' (this is the starting time----
                                                            if ($row['sunday'] !== 'OFF') {
                                                                $extractTime = $row['sunday'];
                                                                list($start, $finish) = explode('-', $extractTime);
                                                                echo $finish;
                                                            } else {
                                                                echo "OFF";
                                                            }
                                                        }
                                                        ?>" />
                                                        <!--giving the input box an id and error code id to call it later to check for errors etc-->
                                                        <span id="sundayError" class="error">
                                                            <?php
                                                            if (isset($errorMessage) && isset($errorMessage['sunday'])) {
                                                                echo $errorMessage['sunday'];
                                                            }
                                                            ?>
                                                        </span>
                                                        <script>
                                                            $(function() {
                                                                $('#timeformatExample13').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                                $('#timeformatExample14').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                            });
                                                        </script>
                                                    </td>
                                                </tr>
                                                <tr> 
                                                    <td>Employee</td>
                                                    <td>

                                                        <select id="employeeID" class="inputFieldPush form-control" name="employeeID">            
                                                            <?php
                                                            $e = $employees->fetch(PDO::FETCH_ASSOC);
                                                            while ($e) {
                                                                $selected = "";
                                                                if ($e['id'] == $row['employeeID']) {
                                                                    $selected = "selected";
                                                                }
                                                                echo '<option value="' . $e['id'] . '" ' . $selected . '>' . $e['name'] . '</option>';
                                                                $e = $employees->fetch(PDO::FETCH_ASSOC);
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>      
                                                </tr> 
                                            <script>

                                            </script>

                                            <tr>
                                                <td></td>
                                                <td><!--creating the submit button that will be working with creating the event -->
                                                    <button type="submit" name="updateRoster" value="update Roster" class="btn5 btn-success btn-sm">
                                                        Update Roster</button>
                                                    <!--calling an function that will cancel a event -->
                                                    <input type="button" value="Cancel" class="btn btn-md createEventBTNs" name="cancel" onclick ="document.location.href = 'HomeRosters.php'" />
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <!--second Table to print out errors------------------------------------------------------------------------>
                                    </form>
                                </div>
                                <div class="panel-footer">
                                    Return <a class="registerP" href="HomeRosters.php">Click here</a></div>
                            </div>
                        </div>


                    </div>
                </div>





                <!-----------------Preset Autofill section -------------->
                <div class="col-lg-5 col-md-4 col-sm-9 col-lg-offset-1 col-md-offset-1 col-sm-offset-3 autofilOptions pushDown5">
                    <div class="col-lg-12 col-md-12 col-sm-12 "style="border-bottom:  2px solid #00BCD4; ">
                        <h1 class="autoFilTitleMain col-lg-12 col-md-12 col-lg-offset-4 col-md-offset-3" >Autofill Selections</h1>
                    </div>  
                    <!-- Options for full week -->
                    <h1 class="autoFilTitle col-lg-12 col-md-12 col-sm-12">Full Week</h1>
                    <button onclick="setWeek9_5()"type="button" class=" btn col-lg-3 col-md-3 col-sm-6 col-xs-3 col-lg-push-0col-xs-3 col-md-push-0 col-sm-push-0 autofillButton" >9AM-5PM</button>        
                    <button onclick="setWeek8_4()"type="button" class=" btn col-lg-3 col-md-3 col-sm-6 col-xs-3 col-lg-push-0 col-md-push-0 col-sm-push-0 autofillButton">8AM-4PM</button>        
                    <button onclick="setWeek7_3()"type="button" class=" btn col-lg-3 col-md-3 col-sm-6 col-xs-3 col-lg-push-0 col-md-push-0 col-sm-push-0 autofillButton">7AM-3PM</button>        
                    <button onclick="setWeek6_2()"type="button" class=" btn col-lg-3 col-md-3 col-sm-6 col-xs-3 col-lg-push-0 col-md-push-0 col-sm-push-0 autofillButton">6AM-2PM</button> 
                    <!-- Options for starting time -->
                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-6" >
                        <h1 class="autoFilTitle col-lg-12 col-md-12 col-sm-12">Start Time</h1>
                        <button onclick="setStart6()"type="button" class=" btn col-lg-2 col-md-4 col-sm-4 col-xs-6 autofillButton">6AM</button> 
                        <button onclick="setStart7()"type="button" class=" btn col-lg-2 col-md-4 col-sm-4 col-xs-6 autofillButton">7AM</button>  
                        <button onclick="setStart8()"type="button" class=" btn col-lg-2 col-md-4 col-sm-4 col-xs-6 autofillButton">8AM</button>  
                        <button onclick="setStart9()"type="button" class=" btn col-lg-2 col-md-4 col-sm-4 col-xs-6 autofillButton">9AM</button>        
                        <button onclick="setStart10()"type="button" class=" btn col-lg-2 col-md-4 col-sm-4 col-xs-6 autofillButton">10AM</button>        
                        <button onclick="setStart11()"type="button" class=" btn col-lg-2 col-md-4 col-sm-4 col-xs-6 autofillButton">11AM</button>   
                    </div>
                    <!-- Options for starting time -->
                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-6">
                        <h1 class="autoFilTitle col-lg-12 col-md-12 col-sm-12">End Time</h1>
                        <button onclick="setEnd2()"type="button" class=" btn col-lg-2 col-md-4 col-sm-4 col-xs-6 autofillButton">2PM</button> 
                        <button onclick="setEnd3()"type="button" class=" btn col-lg-2 col-md-4 col-sm-4 col-xs-6 autofillButton">3PM</button>  
                        <button onclick="setEnd4()"type="button" class=" btn col-lg-2 col-md-4 col-sm-4 col-xs-6 autofillButton">4PM</button>  
                        <button onclick="setEnd5()"type="button" class=" btn col-lg-2 col-md-4 col-sm-4 col-xs-6 autofillButton">5PM</button>        
                        <button onclick="setEnd6()"type="button" class=" btn col-lg-2 col-md-4 col-sm-4 col-xs-6 autofillButton">6PM</button>        
                        <button onclick="setEnd7()"type="button" class=" btn col-lg-2 col-md-4 col-sm-4 col-xs-6 autofillButton">7PM</button> 
                    </div>
                    <!-- button to change customised autofills -->
                    <div class="col-lg-12 col-md-12 col-sm-12 "style="border-bottom:  2px solid #00BCD4; ">
                        <h1 class="autoFilTitleMain col-lg-12 col-md-12 col-sm-12 col-md-pull-1 col-sm-offset-4" >Customised Autofill <?php
                            $row = $users->fetch(PDO::FETCH_ASSOC);
                            echo '<a data-tooltip="Set Custom Values" href="editUserForm.php?idU=' . $fff . '"><span class = "glyphicon glyphicon-cog btn btn-edit" style="margin-bottom: 2%;"></span></a> '
                            ?>
                        </h1>
                    </div> 
                    <!-----------------Customized Autofill section -------------->
                    <!--Custom Week -->
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6" >
                        <h1 class="orangeFont col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-push-2 col-md-push-1  col-lg-offset-0 col-md-offset-0 col-sm-offset-4  col-xs-offset-3 ">Week</h1>
                        <button  onclick="setCustomWeek1()"type="button" class=" btn col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-push-0 col-md-push-0 col-sm-push-1 col-xs-push-1 autofillButton" style="margin-left: -10%; margin-bottom: 4%;">
                            <?php
                            if (empty($customWeek1) || $customWeek1 == "-" || $customWeek1 == "Start-End") {
                                echo "Empty";   //checking if there is a value stored in db, if not set to "empty"
                            } else {
                                echo $customWeek1;  //if there is appropriate data in db display it
                            }
                            ?></button>
                        <button onclick="setCustomWeek2()"type="button" class=" btn col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-push-0 col-md-push-0 col-sm-push-1 col-xs-push-1 autofillButton" style="margin-left: -10%; margin-bottom: 4%;""><?php
                            if (empty($customWeek2) || $customWeek2 == "-" || $customWeek2 == "Start-End") {
                                echo "Empty";   //checking if there is a value stored in db, if not set to "empty"
                            } else {
                                echo $customWeek2;  //if there is appropriate data in db display it
                            }
                            ?></button> 
                        <button onclick="setCustomWeek3()"type="button" class=" btn col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-push-0 col-md-push-0 col-sm-push-1 col-xs-push-1 autofillButton" style="margin-left: -10%; margin-bottom: 4%;""><?php
                            if (empty($customWeek3) || $customWeek3 == "-" || $customWeek3 == "Start-End") {
                                echo "Empty";   //checking if there is a value stored in db, if not set to "empty"
                            } else {
                                echo $customWeek3;  //if there is appropriate data in db display it
                            }
                            ?></button> 
                    </div>
                    <!--Custom Start time -->
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" >
                        <h1 class="orangeFont col-lg-12 col-md-12 col-sm-12 col-xs-12 col-md-pull-1 col-lg-push-0 col-md-push-0 col-sm-push-4 col-xs-push-2 " >Starting</h1>
                        <button  onclick="setCustomStartTime1()"type="button" class=" btn col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-push-0 col-md-push-0 col-sm-push-1 col-xs-push-1 autofillButton" style="margin-left: -10%; margin-bottom: 4%;">
                            <?php
                            if (empty($customStartTime1) || $customStartTime1 == "Start") {
                                echo "Empty";   //checking if there is a value stored in db, if not set to "empty"
                            } else {
                                echo $customStartTime1; //if there is appropriate data in db display it
                            }
                            ?></button>
                        <button onclick="setCustomStartTime2()"type="button" class="btn col-lg-12 col-md-12 col-sm-12 col-xs-12  col-lg-push-0 col-md-push-0 col-sm-push-1 col-xs-push-1 autofillButton" style="margin-left: -10%; margin-bottom: 4%;""><?php
                            if (empty($customStartTime2) || $customStartTime2 == "Start") {
                                echo "Empty";   //checking if there is a value stored in db, if not set to "empty"
                            } else {
                                echo $customStartTime2; //if there is appropriate data in db display it
                            }
                            ?></button> 
                        <button onclick="setCustomStartTime3()"type="button" class="btn col-lg-12 col-md-12 col-sm-12  col-xs-12  col-lg-push-0 col-md-push-0 col-sm-push-1 col-xs-push-1 autofillButton" style="margin-left: -10%; margin-bottom: 4%;""><?php
                            if (empty($customStartTime3) || $customStartTime3 == "Start") {
                                echo "Empty";   //checking if there is a value stored in db, if not set to "empty"
                            } else {
                                echo $customStartTime3; //if there is appropriate data in db display it
                            }
                            ?></button> 
                    </div>
                    <!--Custom end time -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-lg-offset-0 col-md-offset-0 col-sm-offset-3 col-xs-offset-3" >
                        <h1 class="orangeFont col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-pull-3 col-md-pull-3 col-lg-push-0 col-md-push-0 col-sm-push-3 " >Finishing</h1>
                        <button  onclick="setCustomEndTime1()"type="button" class=" btn col-lg-12 col-md-12 col-sm-12 col-xs-12 autofillButton" style="margin-left: -10%; margin-bottom: 4%;">
                            <?php
                            if (empty($customEndTime1) || $customEndTime1 == "End") {
                                echo "Empty";   //checking if there is a value stored in db, if not set to "empty"
                            } else {
                                echo $customEndTime1;   //if there is appropriate data in db display it
                            }
                            ?></button>
                        <button onclick="setCustomEndTime2()"type="button" class=" btn col-lg-12 col-md-12 col-sm-12 col-xs-12 autofillButton" style="margin-left: -10%; margin-bottom: 4%;""><?php
                            if (empty($customEndTime2) || $customEndTime2 == "End") {
                                echo "Empty";   //checking if there is a value stored in db, if not set to "empty"
                            } else {
                                echo $customEndTime2;   //if there is appropriate data in db display it
                            }
                            ?></button> 
                        <button onclick="setCustomEndTime3()"type="button" class=" btn col-lg-12 col-md-12 col-sm-12 col-xs-12 autofillButton" style="margin-left: -10%; margin-bottom: 4%;""><?php
                            if (empty($customEndTime3) || $customEndTime3 == "End") {
                                echo "Empty";   //checking if there is a value stored in db, if not set to "empty"
                            } else {
                                echo $customEndTime3; //if there is appropriate data in db display it
                            }
                            ?></button> 
                    </div>
                </div>
          
        </div>


        <!-- Scroll To Top -->  
        <ul class="visible-xs nav pull-right scroll-top1">
            <li><a class="scrollup" href="#" title="Scroll to top"><i class="glyphicon glyphicon-chevron-up"></i></a></li>
        </ul>
    </body>
</html>