<!-- Code To Log The User Out, Resetting The Session:
<?php

$id = session_id(); 
if ($id == "") { //If session id is null create session 
    session_start();
}

unset($_SESSION['username']); //Unset session id
header("Location: Login.php"); //Start login screen 

