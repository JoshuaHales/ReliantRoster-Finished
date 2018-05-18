<script type="text/javascript" src="js/employee.js"></script>
<?php
//requiring Event.php as some of its elements are needed in this page
require_once 'Employee.php';
require_once 'EmployeeTableGateway.php';
require_once 'Connection.php';
require 'styles2.php';
require 'scripts.php';
require 'ensureUserLoggedIn.php';

//---holds value for sort order (order table of employess will be displayed in)--
if (isset($_GET) && isset($_GET['sortOrder'])) {
    $sortOrder = ($_GET['sortOrder']);
    $columnNames2 = array("id", "name", "email");
    if (!in_array($sortOrder, $columnNames2)) {
        $sortOrder = 'id';
    }
} else {
    $sortOrder = 'id';
}
$connection = Connection::getInstance();         //connection object
$gateway = new EmployeeTableGateway($connection);//roster Gateway object     
$statement = $gateway->getEmployees($sortOrder); //PDO object of employees

/* Starts a new session if session is == to nothing */
$id = session_id();
if ($id == "") {
    session_start();
}
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
        <title>Employees</title>
        <script type="text/javascript" src="js/employee.js"></script>
        <link href="Css/ihover.css" rel="stylesheet">   <!-- Bubbles-->
        <link href="Css/CSS.css" rel="stylesheet">      <!-- stylesheet-->
    </head>
    <body>
        <?php require 'navBar.php' ?>
        <div class="container-fluid">
            <div class="row">
                <?php require 'sideBar.php'; ?><!-- start Sidebar -->
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <!-- start Table Options -->
                    <h2 class="sub-header pushDown4 darkBlueFont">All Employees</h2>
                    <div id="page-wrapper" style="z-index: 10;">
                        <?php require_once 'BubbleButtons.php'; ?>            <!-- Buttons to navigate between tables-->
                        <form  id="homePageForm2" method="POST" action="deleteSelectedEmployee.php">
                            <div class="table-responsive" style="z-index: 10;">
                                <table class="table table-striped table-hover" style="z-index: 10;">
                                    <thead style="z-index: 10;">
                                        <!-- These buttons get clicked on and pass a value to $sortOrder-->
                                        <tr class="viewA" style="z-index: 10;">
                                            <th><input type="checkbox" onclick="checkAll(this)"></th >
                                            <th><a href="HomeEmployee.php?sortOrder=id">Employee ID</a></th>
                                            <th><a href="HomeEmployee.php?sortOrder=name">Name</a></th>
                                            <th><a href="HomeEmployee.php?sortOrder=email">Email Address</a></th>
                                            <th><a href="HomeEmployee.php?sortOrder=username">Username</a></th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $row = $statement->fetch(PDO::FETCH_ASSOC);     //object array of employees
                                        while ($row) {
                                            echo '<td><input class="deleteEmployees" type="checkbox" value="' . $row['id'] . '" name="employees[]" /></td>';
                                            echo '<td>' . $row['id'] . '</td>';
                                            echo '<td>' . $row['name'] . '</td>';
                                            echo '<td>' . $row['email'] . '</td>';
                                            echo '<td>' . $row['username'] . '</td>';
                                            echo '<td>'
                                            //options for view ,edit and delete
                                            . '<a data-tooltip="View Employee" href="viewEmployee.php?id=' . $row['id'] . '"><span class = "glyphicon glyphicon-eye-open btn btn-view"></span></a> '
                                            . '<a data-tooltip1="Edit Employee" href="editEmployeeForm.php?id=' . $row['id'] . '"><span class = "glyphicon glyphicon-cog btn btn-edit"></span></a> '
                                            . '<a data-tooltip2="Delete Employee" class="deleteEmployee" <a href="deleteEmployee.php?id=' . $row['id'] . '"><span class = "glyphicon glyphicon-trash btn btn-delete"></span></a> '
                                            . '</td>';
                                            echo '</tr>';
                                            $row = $statement->fetch(PDO::FETCH_ASSOC); //object array of employees
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <br/>
                            <input class="btn5 btnC" type="submit" id="deleteSelectedEmployees" name="deleteSelected" value ="Delete Selected Employees" />
                            <input class="btn5" type="button" value="Register Employee" name="forgot" onclick="document.location.href = 'createEmployeeForm.php'" />
                        </form>
                    </div>
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