<?php
//requiring Event.php as some of its elements are needed in this page
require_once 'Connection.php';
require 'ensureUserLoggedIn.php';
require_once 'User.php';
require_once 'UserTableGateway.php';
require_once 'Styles.php';
require_once 'Styles2.php';
require_once 'Scripts.php';

//setting session id if one does not already exist
$idU = session_id();
if ($idU == "") {
    session_start();
}
if (!isset($_GET) || !isset($_GET['idU'])) {
    die('Invalid request');
}

$userID = $_GET['idU'];
$connection = Connection::getInstance();        //connection object
$gateway = new UserTableGateway($connection);   //user Gateway object
$users = $gateway->getUser("id");               //PDO object of users
$statement = $gateway->getUserByID($userID);    //gets employee by their ID
$row = $statement->fetch(PDO::FETCH_ASSOC);     //holds values for this user

if ($statement->rowCount() !== 1) {
    die("Illegal request");
}

/* Check if user is logged in */
if (!isset($_SESSION['username'])) {
    header("Location: checkLogin.php");
}
?>
<?php
require 'navBar.php'; //Vavigation Bar-
require_once 'sideBar.php'; //start Sidebar 
?>  

<!DOCTYPE html>
<!-- All the CSS and HTML Code -->
<html>
    <head>
        <script type="text/javascript" src="Js/jquery.timepicker.js"></script>
        <script type="text/javascript" src="Js/bootstrap-datepicker.js"></script>
    </head>
    <!-- JavaScipt code To Check All Boxes(Master): -->
    <div >
        <body style="background-color: #f8f7f7;">
            <?php
            if (isset($message)) {
                echo '<p>' . $message . '</p>';
            }
            ?>
            <div id="page-wrapper " >
                <div class="container-fluid col-lg-10 col-md-10 col-sm-10 col-xs-10">
                    <div class="row">
                        <div id="page-inner ">
                            <div class=" pushDown2 col-lg-10 col-md-10 col-sm-10 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-4 col-xs-offset-1">
                                <?php
                                require 'BubbleButtons.php';
                                ?>
                                <h1 class="editUserTitle darkBlueFont"><?php echo $_SESSION['username'] . " 's "; ?>Custom Roster Autofill's</h1>
                                <div class="panel panel-default ">
                                    <div class="panel-body blue-border">
                                        <form class="form-horizontal" name="editUserForm" role="form" id="editEmployeeForm" action="editUser.php" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $userID; ?>" />
                                            <table class="col-lg-4 col-md-5 col-sm-12 col-xs-12 editCustomWeekDiv"  >
                                                <h1 class="blueFont  col-lg-3 col-md-3 col-sm-4 col-xs-12 col-lg-push-1 col-md-push-1 col-sm-push-5 col-xs-push-4">Custom Weeks</h1>
                                                <h1 class="blueFont hidden-sm hidden-xs col-lg-3 col-md-4 col-lg-push-2 col-md-push-2">Custom Start Times</h1>
                                                <h1 class="blueFont hidden-sm hidden-xs col-lg-3 col-md-4 col-lg-push-3 col-md-push-2">Custom End Times</h1>
                                                <tr>    
                                                    <td class="col-lg-4 col-md-4 col-sm-3 col-xs-5 " >Week 1</td>
                                                    <td>
                                                        <input class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-lg-pull-1 col-md-pull-1 col-sm-pull-1 col-xs-pull-3       " id="timeformatExample1" type="text" class="time" name="customWeek1Start" placeholder="Start-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['customWeek1Start'])) {
                                                            echo $_POST['customWeek1Start'];
                                                        } else {
                                                            $customeWeeks = $row['customTime'];
                                                            list($customWeek1, $customWeek2) = explode('#', $customeWeeks);
                                                            list($start, $finish) = explode('-', $customWeek1);
                                                            echo $start;
                                                        }
                                                        ?>" />
                                                        <input class="col-lg-6  col-md-6 col-sm-6 col-xs-6 col-lg-pull-1 col-md-pull-1 col-sm-pull-1 col-xs-pull-3 " id="timeformatExample2" type="text" class="time" name="customWeek1End" placeholder="End-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['customWeek1End'])) {
                                                            echo $_POST['customWeek1End'];
                                                        } else {
                                                            $customeWeeks = $row['customTime'];         //get all data from that cell in database
                                                            list($customWeek1, $customWeek2) = explode('#', $customeWeeks); //divide it up into weeks

                                                            list($start, $finish) = explode('-', $customWeek1); //divide week into start and end times
                                                            echo $finish; //echo out the time
                                                        }
                                                        ?>" />
                                                        <!--giving the input box an id and error code id to call it later to check for errors etc-->
                                                        <span id="customWeekError" class="error">
                                                            <?php
                                                            if (isset($errorMessage) && isset($errorMessage['customWeek1'])) {
                                                                echo $errorMessage['customWeek1'];
                                                            }
                                                            ?>
                                                        </span>
                                                        <script>
                                                            $(function() {
                                                                //Dropdown time selector
                                                                $('#timeformatExample1').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                                $('#timeformatExample2').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                            });
                                                        </script>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-lg-4 col-md-4 col-sm-3 col-xs-5">Week 2</td>
                                                    <td>
                                                        <input class="col-lg-6  col-md-6 col-sm-6 col-xs-6 col-lg-pull-1 col-md-pull-1 col-sm-pull-1 col-xs-pull-3" id="timeformatExample3" type="text" class="time" name="customWeek2Start" placeholder="Start-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['customWeek2Start'])) {
                                                            echo $_POST['customWeek2Start'];
                                                        } else {
                                                            $customeWeeks = $row['customTime'];
                                                            list($customWeek1, $customWeek2) = explode('#', $customeWeeks);

                                                            list($start, $finish) = explode('-', $customWeek2);
                                                            echo $start;
                                                        }
                                                        ?>" />
                                                        <input class="col-lg-6  col-md-6 col-sm-6 col-xs-6 col-lg-pull-1 col-md-pull-1 col-sm-pull-1 col-xs-pull-3" id="timeformatExample4" type="text" class="time" name="customWeek2End" placeholder="End-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['customWeek2End'])) {
                                                            echo $_POST['customWeek2End'];
                                                        } else {
                                                            $customeWeeks = $row['customTime'];
                                                            list($customWeek1, $customWeek2) = explode('#', $customeWeeks);

                                                            list($start, $finish) = explode('-', $customWeek2);
                                                            echo $finish;
                                                        }
                                                        ?>" />
                                                        <!--giving the input box an id and error code id to call it later to check for errors etc-->
                                                        <span id="customWeek2Error" class="error">
                                                            <?php
                                                            if (isset($errorMessage) && isset($errorMessage['customWeek2'])) {
                                                                echo $errorMessage['customWeek2'];
                                                            }
                                                            ?>
                                                        </span>
                                                        <script>
                                                            $(function() {
                                                                //Dropdown time selector
                                                                $('#timeformatExample3').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                                $('#timeformatExample4').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                            });
                                                        </script>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-lg-4 col-md-4 col-sm-3 col-xs-5" >Week 3</td>
                                                    <td>
                                                        <input class="col-lg-6  col-md-6 col-sm-6 col-xs-6 col-lg-pull-1 col-md-pull-1 col-sm-pull-1 col-xs-pull-3 " id="timeformatExample5" type="text" class="time" name="customWeek3Start" placeholder="Start-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['customWeek3Start'])) {
                                                            echo $_POST['customWeek3Start'];
                                                        } else {
                                                            $customeWeeks = $row['customTime'];
                                                            list($customWeek1, $customWeek2, $customWeek3) = explode('#', $customeWeeks);

                                                            list($start, $finish) = explode('-', $customWeek3);
                                                            echo $start;
                                                        }
                                                        ?>" />
                                                        <input class="col-lg-6  col-md-6 col-sm-6 col-xs-6  col-lg-pull-1 col-md-pull-1 col-sm-pull-1 col-xs-pull-3" id="timeformatExample6" type="text" class="time" name="customWeek3End" placeholder="End-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['customWeek3End'])) {
                                                            echo $_POST['customWeek3End'];
                                                        } else {
                                                            $customeWeeks = $row['customTime'];
                                                            list($customWeek1, $customWeek2, $customWeek3) = explode('#', $customeWeeks);

                                                            list($start, $finish) = explode('-', $customWeek3);
                                                            echo $finish;
                                                        }
                                                        ?>" />
                                                        <!--giving the input box an id and error code id to call it later to check for errors etc-->
                                                        <span id="customWeek3Error" class="error">
                                                            <?php
                                                            if (isset($errorMessage) && isset($errorMessage['customWeek3'])) {
                                                                echo $errorMessage['customWeek3'];
                                                            }
                                                            ?>
                                                        </span>
                                                        <script>
                                                            $(function() {
                                                                //Dropdown time selector
                                                                $('#timeformatExample5').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                                $('#timeformatExample6').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                            });
                                                        </script>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="col-lg-3 col-md-3 col-sm-5  col-lg-push-1  editCustomStartTimeDiv"  >
                                                <h1 class="blueFont visible-sm visible-xs col-sm-6 col-xs-12 col-sm-push-2 col-xs-push-4 ">Start Times</h1>
                                                <h1 class="blueFont visible-sm  col-sm-6 col-xs-6 col-sm-push-2 ">End Times</h1>
                                                <tr>
                                                    <!--next table data-->
                                                    <td class="col-lg-5 col-md-6 col-sm-5 col-xs-4" >Start 1</td>
                                                    <td>
                                                        <input class="col-lg-10 col-md-11 col-sm-12  col-xs-10  col-sm-push-1 col-xs-pull-1   " id="timeformatExample7" type="text" class="time" name="customStartTime1" placeholder="Start-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['customStartTime1'])) {
                                                            echo $_POST['customStartTime1'];
                                                        } else {
                                                            $customeWeeks = $row['customTime'];
                                                            list($customWeek1, $customWeek2, $customWeek3, $customStartTime1) = explode('#', $customeWeeks);
                                                            //list($start, $finish) = explode('-', $customWeek1);
                                                            echo $customStartTime1;
                                                        }
                                                        ?>" />
                                                        <!--giving the input box an id and error code id to call it later to check for errors etc-->
                                                        <span id="customStartTimeError" class="error">
                                                            <?php
                                                            if (isset($errorMessage) && isset($errorMessage['customStart1Time'])) {
                                                                echo $errorMessage['customStart1Time'];
                                                            }
                                                            ?>
                                                        </span>
                                                        <script>
                                                            $(function() {
                                                                //Dropdown time selector
                                                                $('#timeformatExample7').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});

                                                            });
                                                        </script>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-lg-5 col-md-6 col-sm-5 col-xs-4" >Start 2</td>
                                                    <td>
                                                        <input class="col-lg-10 col-md-11  col-sm-12 col-xs-10 col-sm-push-1 col-xs-pull-1" id="timeformatExample8" type="text" class="time" name="customStartTime2" placeholder="Start-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['customStartTime2'])) {
                                                            echo $_POST['customStartTime2'];
                                                        } else {
                                                            $customeWeeks = $row['customTime'];
                                                            list($customWeek1, $customWeek2, $customWeek3, $customStartTime1, $customStartTime2) = explode('#', $customeWeeks);
                                                            //list($start, $finish) = explode('-', $customWeek1);
                                                            echo $customStartTime2;
                                                        }
                                                        ?>" />

                                                        <!--giving the input box an id and error code id to call it later to check for errors etc-->
                                                        <span id="customStartTime2Error" class="error">
                                                            <?php
                                                            if (isset($errorMessage) && isset($errorMessage['customStartTime2'])) {
                                                                echo $errorMessage['customStartTime2'];
                                                            }
                                                            ?>
                                                        </span>
                                                        <script>
                                                            $(function() {
                                                                //Dropdown time selector
                                                                $('#timeformatExample8').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                            });
                                                        </script>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-lg-5 col-md-6 col-md-5 col-sm-5 col-xs-4 "  >Start 3</td>
                                                    <td>
                                                        <input class="col-lg-10 col-md-11 col-sm-12 col-xs-10 col-sm-push-1  col-lg-pull-2 col-md-pull-2 col-xs-pull-1" id="timeformatExample9" type="text" class="time" name="customStartTime3" placeholder="Start-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['customStartTime3'])) {
                                                            echo $_POST['customStartTime3'];
                                                        } else {
                                                            $customeWeeks = $row['customTime'];
                                                            list($customWeek1, $customWeek2, $customWeek3, $customStartTime1, $customStartTime2, $customStartTime3) = explode('#', $customeWeeks);
                                                            echo $customStartTime3;
                                                        }
                                                        ?>" />

                                                        <!--giving the input box an id and error code id to call it later to check for errors etc-->
                                                        <span id="customStartTime3Error" class="error">
                                                            <?php
                                                            if (isset($errorMessage) && isset($errorMessage['customStartTime3'])) {
                                                                echo $errorMessage['customStartTime3'];
                                                            }
                                                            ?>
                                                        </span>
                                                        <script>
                                                            $(function() {
                                                                //Dropdown time selector
                                                                $('#timeformatExample9').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});
                                                            });
                                                        </script>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!-- end time -->
                                            <table class="col-lg-3 col-md-3 col-sm-5  col-sm-push-1 col-md-push-0 col-lg-push-2   editCustomStartTimeDiv" style="margin-left: 1em;">
                                                <h1 class="blueFont visible-xs col-xs-12 col-xs-push-4 ">Start Times</h1>
                                                <tr>
                                                    <!--next table data-->
                                                    <td class="col-lg-5 col-md-5 col-sm-5 col-xs-4 ">End 1</td>
                                                    <td>
                                                        <input class="col-lg-10 col-md-12 col-sm-12 col-sm-pull-1 col-xs-10 col-md-pull-1 col-lg-pull-3 col-xs-pull-1" id="timeformatExample10" type="text" class="time" name="customEndTime1" placeholder="Start-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['customEndTime1'])) {
                                                            echo $_POST['customEndTime1'];
                                                        } else {
                                                            $customeWeeks = $row['customTime'];
                                                            list($customWeek1, $customWeek2, $customWeek3, $customStartTime1, $customStartTime2, $customStartTime3, $customEndTime1) = explode('#', $customeWeeks);
                                                            echo $customEndTime1;
                                                        }
                                                        ?>" />
                                                        <!--giving the input box an id and error code id to call it later to check for errors etc-->
                                                        <span id="customEndTimeError" class="error">
                                                            <?php
                                                            if (isset($errorMessage) && isset($errorMessage['customEndTime1'])) {
                                                                echo $errorMessage['customEndTime1'];
                                                            }
                                                            ?>
                                                        </span>
                                                        <script>
                                                            $(function() {
                                                                //Dropdown time selector
                                                                $('#timeformatExample10').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});

                                                            });
                                                        </script>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <!--next table data-->
                                                    <td class="col-lg-5 col-md-5 col-sm-5 col-xs-4">End 2</td>
                                                    <td>
                                                        <input class="col-lg-10 col-md-12 col-sm-12 col-sm-pull-1 col-xs-10 col-lg-pull-3 col-md-pull-1 col-xs-pull-1 " id="timeformatExample11" type="text" class="time" name="customEndTime2" placeholder="Start-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['customEndTime2'])) {
                                                            echo $_POST['customEndTime2'];
                                                        } else {
                                                            $customeWeeks = $row['customTime'];
                                                            list($customWeek1, $customWeek2, $customWeek3, $customStartTime1, $customStartTime2, $customStartTime3, $customEndTime1, $customEndTime2) = explode('#', $customeWeeks);
                                                            echo $customEndTime2;
                                                        }
                                                        ?>" />
                                                        <!--giving the input box an id and error code id to call it later to check for errors etc-->
                                                        <span id="customEndTimeError" class="error">
                                                            <?php
                                                            if (isset($errorMessage) && isset($errorMessage['customEndTime2'])) {
                                                                echo $errorMessage['customEndTime2'];
                                                            }
                                                            ?>
                                                        </span>
                                                        <script>
                                                            $(function() {
                                                                //Dropdown time selector
                                                                $('#timeformatExample11').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});

                                                            });
                                                        </script>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <!--next table data-->
                                                    <td class="col-lg-5 col-md-5 col-sm-5 col-xs-4 ">End 3</td>
                                                    <td>
                                                        <input class="col-lg-10 col-md-12 col-sm-12 col-xs-10 col-md-pull-1 col-sm-pull-1 col-lg-pull-3 col-xs-pull-1" id="timeformatExample12" type="text" class="time" name="customEndTime3" placeholder="Start-Time" value="<?php
                                                        if (isset($_POST) && isset($_POST['customEndTime3'])) {
                                                            echo $_POST['customEndTime3'];
                                                        } else {
                                                            $customeWeeks = $row['customTime'];
                                                            list($customWeek1, $customWeek2, $customWeek3, $customStartTime1, $customStartTime2, $customStartTime3, $customEndTime1, $customEndTime2, $customEndTime3) = explode('#', $customeWeeks);
                                                            echo $customEndTime3;
                                                        }
                                                        ?>" />
                                                        <!--giving the input box an id and error code id to call it later to check for errors etc-->
                                                        <span id="customEndTimeError" class="error">
                                                            <?php
                                                            if (isset($errorMessage) && isset($errorMessage['customEndTime3'])) {
                                                                echo $errorMessage['customEndTime3'];
                                                            }
                                                            ?>
                                                        </span>
                                                        <script>
                                                            $(function() {
                                                                //Dropdown time selector
                                                                $('#timeformatExample12').timepicker({'noneOption': [{'label': 'OFF', 'className': 'shibby', 'value': 'OFF'}]});

                                                            });
                                                        </script>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div class="col-lg-12 col-md-12 pushDown2">
                                                <button type="submit" name="updateYser" style="background-color: #00BCD4;" value="update User" class="btn5 btn btn-sm col-lg-3 col-md-4 col-sm-5 col-lg-offset-4  col-md-offset-3 col-sm-offset-2">
                                                    Update Customizations</button>
                                                <button class="btn6 btn-success btn-sm col-lg-2 col-md-2 col-sm-3  ">
                                                    <a href="createRosterForm.php">Cancel</a></button>
                                            </div>
                                        </form>
                                    </div>      
                                </div>
                            </div><!-- End of panel-->
                        </div> <!-- Container for all panels-->
                    </div>
                </div>
            </div>
        </body>
</html>