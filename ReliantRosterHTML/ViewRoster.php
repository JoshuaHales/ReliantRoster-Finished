<script type="text/javascript" src="js/roster.js"></script>
<?php
require_once 'Connection.php';
require_once 'Roster.php';
require_once 'RosterTableGateway.php';
require 'styles2.php';
require 'scripts.php';
require 'ensureUserLoggedIn.php';

/* Starts a new session if session is == to nothing */
$id = session_id();
if ($id == "") {
    session_start();
}

//if session is set add it to the array
if (!isset($_GET) || !isset($_GET['id'])) {
    die('Invalid request');
}
$id = $_GET['id'];                              //session id
$connection = Connection::getInstance();        //connection object
$gateway = new RosterTableGateway($connection); //employee Gateway object
$statement = $gateway->getRosterByID($id);      //PDO object of users 
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <script type="text/javascript" src="js/roster.js"></script>
    </head>
    <body>
        <?php require 'navBar.php' ?>
        <?php
        if (isset($message)) {
            echo '<p>' . $message . '</p>';
        }
         $row = $statement->fetch(PDO::FETCH_ASSOC);
        ?>     
        <div class="container-fluid">
            <div class="row">
                 <?php require 'sideBar.php';?><!-- start Sidebar -->
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h2 class="sub-header pushDown4 blueFont boldFont">  <text style="font-style:normal;">Roster for: </text> <?php echo $row['name']; ?> <?php echo '(week ' . $row['title'] . ')'; ?></h2>
                    <div id="page-wrapper" >
                        <?php require_once 'BubbleButtons.php'; ?>            <!-- Buttons to navigate between tables-->
                        <h2 class="sub-header darkBlueFont">Roster</h2>
                        <form id="homePageForm" method="POST" action="deleteSelectedBuses.php">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Monday</th>
                                            <th>Tuesday</th>
                                            <th>Wednesday</th>
                                            <th>Thursday</th>
                                            <th>Friday</th>
                                            <th>Saturday</th>
                                            <th>Sunday</th>
                                            <th>Employee</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //table data
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
                                        echo '<td> <a href="viewEmployee.php?id= ' . $row['employeeID'] . '">' . $row['name'] . '</td>';
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <br/>
                            <p>
                                 <button type="button" class="btn "><a href="editRosterForm.php?id= <?php echo $row['rosterID']  ?>">Edit Roster</a></button>        
                                 <button type="button" class="btn "><a href="deleteRoster.php?id= <?php echo $row['rosterID']  ?>">Delete Roster</a></button>        
                                <button type="button" class="btn "><a href="HomeRosters.php">Return</a></button>
                            </p>
                        </form>
                        <!-- End Table -->
                    </div>
                </div>
            </div>               
        </div> <!--Scroll To Top -->=
        <ul class="visible-xs nav pull-right scroll-top1">
            <li><a class="scrollup" href="#" title="Scroll to top"><i class="fa fa-arrow-up"></i></a></li>
        </ul>
</html>