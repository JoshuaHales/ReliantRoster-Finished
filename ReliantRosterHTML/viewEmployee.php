<script type="text/javascript" src="js/roster.js"></script>
<?php
require_once 'Connection.php';
require_once 'Employee.php';
require_once 'EmployeeTableGateway.php';
require_once 'RosterTableGateway.php';
require 'styles2.php';
require 'scripts.php';
require 'ensureUserLoggedIn.php';

//setting session id if one does not already exist
$id = session_id();
if ($id == "") {
    session_start();
}

//if events session is set add it to the array
if (!isset($_GET) || !isset($_GET['id'])) {
    die('Invalid request');
}

$id = $_GET['id'];                                      //id of employee is session id
$connection = Connection::getInstance();                //connection object
$gateway = new EmployeeTableGateway($connection);       //employee Gateway object
$rosterGateway = new RosterTableGateway($connection);   //Roster Gateway object
$statement = $gateway->getEmployeeByID($id);            //gets employee by their ID
$rosters = $rosterGateway->getRostersByEmployeeID($id); //gets roster by employee ID
?>

<!DOCTYPE html>
<!-- All the CSS and HTML Code -->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Title -->
        <title>Viewing Employee</title>
        <!-- Style & Script Code -->

        <script type="text/javascript" src="js/bus.js"></script>
    </head>
    <body>
        <?php require 'navBar.php' //navigation bar?>
        <?php
        if (isset($message)) {
            echo '<p>' . $message . '</p>';
        }
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        ?>     
        <div class="container-fluid">
            <div class="row">
                <?php require 'sideBar.php'; ?><!-- start Sidebar -->
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h2 class="sub-header pushDown4 darkBlueFont"><?php echo $row['name']; ?>'s  Details</h2>
                    <div id="page-wrapper" >
                        <?php require_once 'BubbleButtons.php'; ?>            <!-- Buttons to navigate between tables-->

                        <form id="homePageForm" method="POST" action="deleteSelectedBuses.php">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //print values from database for the user
                                        echo '<td>' . $row['id'] . '</td>';
                                        echo '<td>' . $row['name'] . '</td>';
                                        echo '<td>' . $row['email'] . '</td>';
                                        echo '<td>' . $row['username'] . '</td>';
                                        echo '<td>' . $row['password'] . '</td>';
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <br/>
                            <p>
                                <button type="button" class="btn "><a href="editEmployeeForm.php?id= <?php echo $row['id'] ?>">Edit Employee</a></button>        
                                <button type="button" class="btn "><a href="deleteEmployee.php?id= <?php echo $row['id'] ?>">Delete Employee</a></button>        
                                <button type="button" class="btn "><a href="HomeEmployee.php">Return</a></button>
                            </p>
                        </form>
                        <!-- End Table -->
                    </div>
                    <h2 class="sub-header darkBlueFont">Rosters Assigned To  <?php
                        echo '<td>' . $row['name'] . '</td>';
                        ?> </h2>
                    <hr>
                    <table class="table table-striped table-hover">
                        <?php if ($rosters->rowCount() !== 0) { ?>
                            <thead>
                                <tr>
                                    <th>Roster ID</th>
                                    <th>Week</th>
                                    <th>Period</th>
                                    <th>Monday</th>
                                    <th>Tuesday</th>
                                    <th>Wednesday</th>
                                    <th>Thursday</th>
                                    <th>Friday</th>
                                    <th>Saturday</th>
                                    <th>Sunday</th>
                                    <th>Total</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $row = $rosters->fetch(PDO::FETCH_ASSOC);
                                while ($row) {
                                    //print values from database for the roster
                                    echo '<td>' . $row['rosterID'] . '</td>';
                                    echo '<td>' . $row['title'] . '</td>';
                                    echo '<td>' . $row['description'] . '</td>';
                                    echo '<td>' . $row['monday'] . '</td>';
                                    echo '<td>' . $row['tuesday'] . '</td>';
                                    echo '<td>' . $row['wednesday'] . '</td>';
                                    echo '<td>' . $row['thursday'] . '</td>';
                                    echo '<td>' . $row['friday'] . '</td>';
                                    echo '<td>' . $row['saturday'] . '</td>';
                                    echo '<td>' . $row['sunday'] . '</td>';
                                    echo '<td>' . $row['total'] . 'Hrs' . '</td>';
                                    echo '<td>'
                                    . '<a data-tooltip="View This Roster" href="viewRoster.php?id=' . $row['rosterID'] . '"><span class = "glyphicon glyphicon-eye-open btn btn-view"></span></a> '
                                    . '<a data-tooltip1="Edit This Roster" href="editRosterForm.php?id=' . $row['rosterID'] . '"><span class = "glyphicon glyphicon-cog btn btn-edit"></span></a> '
                                    . '<a data-tooltip2="Delete This Roster" class="deleteRoster" <a href="deleteRoster.php?id=' . $row['rosterID'] . '"><span class = "glyphicon glyphicon-trash btn btn-delete"></span></a> '
                                    . '</td>';
                                    echo '</tr>';
                                    $row = $rosters->fetch(PDO::FETCH_ASSOC);
                                }
                                ?>
                            </tbody>
                        <?php } else { ?> <!-- Shows if there is no rosters-->
                            <p class="errorp">* There are no rosters assigned to this employee.</p>
                        <?php } ?>
                    </table>               
                </div>               
            </div>
        </div>
        <div class="br"></div> <!-- start Scroll To Top -->
        <ul class="hidden-xs nav pull-right scroll-top">
            <li><a class="scrollup" href="#" title="Scroll to top"><i class="fa fa-arrow-up"></i></a></li>
        </ul>
        <ul class="visible-xs nav pull-right scroll-top1">
            <li><a class="scrollup" href="#" title="Scroll to top"><i class="fa fa-arrow-up"></i></a></li>
        </ul>
        <!-- start Scroll To Top -->
    </body>
</html>