<?php
//setting session id if one does not already exist
$sessionid = session_id();
if ($sessionid == "") {
    session_start();
}

//displayed If User Is Logged In:
if (isset($_SESSION['username'])) {
    echo '<li><a href="Logout.php"><i class="fa fa-power-off"></i> Logout</a></li>';
}
//displayed If User Is Not Logged In:
else {
    echo '<li><a href="Login.php"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Login</a></li>';
    echo '<li><a href="Register.php"><span class="glyphicon glyphicon-copy" aria-hidden="true"></span> Register</a></li>';
}