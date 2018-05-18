<?php
$weekNumber = date("W");                                        //week number
$monday = date('d', time() + ( 1 - date('w')) * 24 * 3600);    //gives date of monday of current week
$sunday = date('d', time() + ( 7 - date('w')) * 24 * 3600);    //gives date of sunday of current week
//echo date('Y-m-d',time()+( 8 - date('w'))*24*3600); NEXT WEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEK


$month = date('F', strtotime('1 Jan + ' . $weekNumber . ' weeks')); //date('F', strtotime('2016-W200'));
$nextMonth = date('F', strtotime('1 Jan + ' . ($weekNumber + 1) . ' weeks')); //date('F', strtotime('2016-W200'));

if ($monday > $sunday) { //If monday value is greater then sunday value, means next month value 
    $month = $month . "-" . $nextMonth; //show current and next month values 
}
?>

<div class="hidden-xs col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <!-- Sidebar calender Start -->
        <div class="calander">
            <div class="weekTitle pushDown3">
                <h1 class="pushDown3 ">Week</h1> <!-- Sidebar heading -->
            </div>
            <div class="weekValue">
                <h1 class=" orangeText largeFont "><?php echo $weekNumber; ?></h1> <!-- Current week -->
                <h1 class="blackFont"><?php echo $monday . '-' . $sunday; ?></h1> <!-- Current wwek period -->
                <h1 class="monthTextSidebar"><?php echo $month; ?></h1> <!-- Current month -->
                <div class="blackLine"></div> <!-- Calender page effect -->
                <div class="blackLine"></div>
                <div class="blackLine"></div>
            </div>
        </div>
        <!-- Sidebar calender End -->

        <?php
        $username = $_SESSION['username'];
        echo '<h1 class="userW">Welcome: <i>' . $username . '</i></h1>'; //Display name of current user logged in
        ?>
        <li> <?php require_once 'calander.php'; ?></li> <!-- Show calender widget -->
        <li class="active1"><a href="#"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> Tables</a></li> <!-- More list items -->
        <li><a href="#"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Messages</a></li>

        <li  onclick="toggle_visibility('bubbleButtons')"><a href="#"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Toggle Table Buttons </a></li>
        <!--Script to toggle visibility of tables(Bubble buttons -->
        <script type="text/javascript">
            function toggle_visibility(id) {
                var e = document.getElementById(id);
                if (e.style.display == 'block')
                    e.style.display = 'none';
                else
                    e.style.display = 'block';
            }
        </script>
        <div class="Sdivider"></div>
        <?php require 'toolbar.php' ?> <!-- Code to check if user is logged in -->
    </ul>
</div>