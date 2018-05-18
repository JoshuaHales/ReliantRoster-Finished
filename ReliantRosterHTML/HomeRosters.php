<script type="text/javascript" src="js/roster.js"></script>
<?php
//requiring Event.php as some of its elements are needed in this page
require_once 'Connection.php';
require_once 'Roster.php';
require_once 'RosterTableGateway.php';
require 'ensureUserLoggedIn.php';
require_once 'Styles2.php';
require_once 'Scripts.php';

$weekNumber = date("W");                //week number
//$weekNumSub = substr($weekNumber, 0 ,2); // returns number without the 0
$weekNumberInt = (int) $weekNumber;   //week number as an int

$NextWeekNumberInt = $weekNumberInt + 1;
if ($NextWeekNumberInt > 52) {
    $NextWeekNumberInt = 1;
}

$sortByWeek = NULL;
if (isset($_GET) && isset($_GET['sortOrder'])) {
    $sortOrder = ($_GET['sortOrder']);
    $columnNames = array("rosterID", "title", "description", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday", "total", "employeeID");
    if (!in_array($sortOrder, $columnNames)) {
        $sortOrder = 'rosterID';
    }
} else {
    $sortOrder = 'rosterID';
}
if (isset($_GET) && isset($_GET['sortByWeek'])) {
    $sortByWeek = filter_input(INPUT_GET, 'sortByWeek', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
} else {
    $sortByWeek = NULL;
}


if (isset($_GET) && isset($_GET['title'])) {
    $title = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
} else {
    $title = NULL;
}
$connection = Connection::getInstance();
$gateway = new RosterTableGateway($connection);

if (true) {
    $statement = $gateway->getRosters($sortOrder, $sortByWeek);
} else {
    $statement = $gateway->getRostersByWeek($sortByWeek);
}
/* Starts a new session if session is == to nothing */
$id = session_id();
if ($id == "") {
    session_start();
}

//if events session is set add it to the array
if (!isset($_SESSION['roster'])) { ///////////could be rosters
    $rosters = array();
    //hard coding variables into the array through parameters in another page

    $_SESSION['roster'] = $rosters;
} else {
    //making this session events
    $rosters = $_SESSION['roster'];
}
?>
<html>
    <head>
        <title>Reliant Roster</title>
        <!-- Style & Script Code -->
        <?php
        require 'styles2.php';
        require 'scripts.php';
        ?> 
         <link href="Css/style.css" rel="stylesheet">

    </head>
    <!-- JavaScipt code To Check All Boxes(Master): -->
    <script language="javascript">
        function checkAll(master) {
            var checked = master.checked;
            var col = document.getElementsByClassName("deleteRosters");
            for (var i = 0; i < col.length; i++) {
                col[i].checked = checked;
            }
        }
    </script>
    <body>
        <?php require 'navBar.php' ?>
        <?php
        if (isset($message)) {
            echo '<p>' . $message . '</p>';
        }
        ?>
        <div class="container-fluid">
            <div class="row">
                <!-- SideBar -->
                <?php
                require 'sideBar.php';
                ?><!-- start Sidebar -->
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h2 class="sub-header pushDown4 darkBlueFont">All Rosters</h2>
                    
                    <div id="page-wrapper" >
                        <div id="page-inner">
                            <?php require_once 'BubbleButtons.php';?>          <!-- Buttons to navigate between tables-->
                            <div>
                                <h4 style="color: #0097A7; font-weight: bold;">Filter By: </h4>
                                <button type="button" class="btn filterByWeekButton "><a href="HomeRosters.php">All Weeks</a></button>        
                                <button type="button" class="btn filterByWeekButton"><?php echo'<a href="HomeRosters.php?sortByWeek=' . $weekNumberInt . '">' . '  This Week(' . ($weekNumberInt) . ')</a>'; ?></button>        
                                <button type="button" class="btn filterByWeekButton"><?php echo'<a href="HomeRosters.php?sortByWeek=' . ($NextWeekNumberInt) . '">' . '  Next Week (' . ($NextWeekNumberInt) . ')</a>'; ?></button>        
                                <button type="button" class="btn filterByWeekButton"><?php echo'<a href="HomeRosters.php?sortByWeek=' . ($NextWeekNumberInt + 1) . '">' . '  Week ' . ($NextWeekNumberInt + 1) . '</a>'; ?></button>        
                                <button type="button" class="btn filterByWeekButton"><?php echo'<a href="HomeRosters.php?sortByWeek=' . ($NextWeekNumberInt + 2) . '">' . '  Week ' . ($NextWeekNumberInt + 2) . '</a>'; ?></button>        
                                <button type="button" class="btn filterByWeekButton"><?php echo'<a href="HomeRosters.php?sortByWeek=' . ($NextWeekNumberInt + 3) . '">' . '  Week ' . ($NextWeekNumberInt + 3) . '</a>'; ?></button>        
                            </div>
                            <form id="homePageForm" method="POST" action="deleteSelectedRosters.php">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <?php if ($statement->rowCount() !== 0) { ?>
                                        <thead>
                                            
                                            <tr class="viewA">
                                                <th><input type="checkbox" onclick="checkAll(this)"></th>
                                                <th><a href="HomeRosters.php?sortOrder=title">Week</a></th>
                                                <th><a href="HomeRosters.php?sortOrder=description">Period</a></th>
                                                <th class="thPush"><a href="HomeRosters.php?sortOrder=monday">Monday</a></th>
                                                <th class="thPush"><a href="HomeRosters.php?sortOrder=tuesday">Tuesday</a></th>
                                                <th><a href="HomeRosters.php?sortOrder=wednesday">Wednesday</a></th>
                                                <th><a href="HomeRosters.php?sortOrder=thursday">Thursday</a></th>
                                                <th><a href="HomeRosters.php?sortOrder=friday">Friday</a></th>
                                                <th><a href="HomeRosters.php?sortOrder=saturday">Saturday</a></th>
                                                <th><a href="HomeRosters.php?sortOrder=sunday">Sunday</a></th>
                                                <th><a href="HomeRosters.php?sortOrder=total">Total</a></th>
                                                <th><a href="HomeRosters.php?sortOrder=employeeID">Employee</a></th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php
                                            $row = $statement->fetch(PDO::FETCH_ASSOC);
                                            while ($row) {
                                                echo '<td><input class="deleteRosters" type="checkbox" value="' . $row['rosterID'] . '" name="rosters[]" /></td>';
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
                                                echo '<td> <a href="viewEmployee.php?id= ' . $row['employeeID'] . '">' . $row['name'] . '</td>';
                                                echo '<td>'
                                                . '<a data-tooltip="View Roster" href="viewRoster.php?id=' . $row['rosterID'] . '"><span class = "glyphicon glyphicon-eye-open btn btn-view"></span></a> '
                                                . '<a data-tooltip1="Edit Roster" href="editRosterForm.php?id=' . $row['rosterID'] . '"><span class = "glyphicon glyphicon-cog btn btn-edit"></span></a> '
                                                . '<a data-tooltip2="Delete Roster" class="deleteRoster" <a href="deleteRoster.php?id=' . $row['rosterID'] . '"><span class = "glyphicon glyphicon-trash btn btn-delete"></span></a> '
                                                . '</td>';
                                                echo '</tr>';
                                                $row = $statement->fetch(PDO::FETCH_ASSOC);
                                            }
                                            ?>
                                        </tbody>
                                       <?php } else { ?>
                                            <p class="errorp">* There are no rosters assigned to this week.</p>
                                       <?php } ?>
                                    </table>
                                </div>
                                <br/>
                                <input class="btn5 btnC" type="submit" id="deleteSelectedRosters" name="deleteSelected" value ="Delete Selected Rosters" />
                                <input class="btn5" type="button" value="Create Roster" name="forgot" onclick="document.location.href = 'createRosterForm.php'" />
                            </form>
                        </div>
                        <br>
                    </div>               
                </div>
            </div>
            <ul class="hidden-xs nav pull-right scroll-top">
                <li><a class="scrollup" href="#" title="Scroll to top"><i class="fa fa-arrow-up"></i></a></li>
            </ul>
            <ul class="visible-xs nav pull-right scroll-top1">
                <li><a class="scrollup" href="#" title="Scroll to top"><i class="fa fa-arrow-up"></i></a></li>
            </ul>
    </body>
</html>
