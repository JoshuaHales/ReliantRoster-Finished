<!-- PHP Code To Insure User Is Logged In -->
<?php
$id = session_id();
if ($id == "") { //If session id is null start new session 
    session_start();
}

if (!isset($_SESSION['username'])) { //If no session bring to login screen 
    header("Location: Login.php");
}