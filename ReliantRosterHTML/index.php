<!DOCTYPE html>
<?php
require 'Styles.php';
require_once 'Styles2.php';
require 'Scripts.php';

/* Creating session Start */
$id = session_id();
if ($id == "") {
    session_start(); //setting session id if one does not already exist
}
/* Creating session End */
?>
<!-- Main html content Start -->
<html>
    <head>
        <title>Reliant Roaster</title>
    </head>
    <body>
        <?php require 'navBar2.php' ?><!--  Navigation bar  -->
        <!-- Hero Section Start -->
        <section class="hero" id="hero">
            <div class="container">
                <div class="caption">
                    <h1 class="text-uppercase  animated wow fadeInLeft"><span style="background-color: rgba(255,152,0,0.7)">Reliant Roster.</span></h1> <!-- Main hero text -->
                    <p class="animated wow fadeInLeft">Roster's Made Simple </p> <!-- Sub hero text -->
                    <a href="./AndroidAPK/app-release.apk" download="Reliant Roster Android App" class="app_store_btn text-uppercase animated wow fadeInLeft">
                        <i class="android_icon"></i>
                        <span class="downloadButtonFont">Android App</span> <!-- Android button link -->
                    </a>
                </div>			
            </div>
        </section>
        <!--  Hero Section End -->

        <!-- About Section Start -->
        <section class="about" id="about">
            <div class="container">
                <h4 class="text-center"><b>About ReliantRoster<b></h4> <!-- About section main header -->
                <br><br>
                <div class="row">
                    <div class="col-md-6 text-center animated wow fadeInLeft">
                        <div class="iphone"><img src="img/Android.png"></div> <!-- About section phone image -->
                    </div>
                    <div class="col-md-6 animated wow fadeInRight">
                        <div class="features_list">
                            <h1 class="text-uppercase">Roster's easily made|Roster's easily received</h1> <!-- About section sub headings -->
                            <p>Get the app get your roster's. . . its really simple</p>
                            <ul class="list-unstyled">
                                <li class="camera_icon">
                                    <span>Always up to date version of your Roster</span> <!-- About section list features -->
                                </li>
                                <li class="video_icon">
                                    <span>Clearly displayed work schedule</span>
                                </li>
                                <li class="eye_icon">
                                    <span>Array of roster configuration options.</span>
                                </li>
                                <li class="pic_icon">
                                    <span>Easy to manage work rosters.</span>
                                </li>
                                <li class="loc_icon">
                                    <span>Secure online access.</span>
                                </li>
                            </ul>
                            <a href="#" class="app_about_btn text-uppercase">
                                <i class="play_icon"></i> 
                                <span>Learn More</span> <!-- Features link button -->
                            </a>
                            <a href="./AndroidAPK/app-release.apk" download="Reliant Roster Android App" class="app_link">Get the app</a> <!-- Download the app link -->
                        </div>					
                    </div>
                </div>
            </div>
            <div class="about_video show_video">
                <a href="" class="close_video"></a>
            </div>
        </section>
        <!-- About Section End -->

        <!-- Main Features Section Start -->
        <section class="app_features" id="app_features">
            <div class="container">
                <h4 class="text-center"><b>Main Features</b></h4> <!-- Main features header -->
                <br><br>
                <div class="row text-center">
                    <div class="col-sm-4 col-md-4 details animated wow fadeInDown" data-wow-delay="0s">
                        <img src="img/f_icon1.png" alt="" title=""> <!-- Features icons -->
                        <h1 class="text-uppercase">Essential time reducing features</h1> <!-- Features heading -->
                        <hr style="border: 1px solid #ff9800"> <!-- Break line --> 
                        <p>With the use of Reliant Rosters beneficial work schedule creation tools, hundreds of work rosters can be made in no time.</p> <!-- Features content -->
                    </div>
                    <div class="col-sm-4 col-md-4 details animated wow fadeInDown" data-wow-delay=".1s">
                        <img src="img/f_icon2.png" alt="" title="">
                        <h1 class="text-uppercase">Connecting employers/employees</h1>
                        <hr style="border: 1px solid #ff9800">
                        <p>Abilities are present that will allow for the changing of adding employees, updating their details, and assigning them rosters.</p>
                    </div>
                    <div class="col-sm-4 col-md-4 details animated wow fadeInDown" data-wow-delay=".2s">
                        <img src="img/f_icon3.png" alt="" title="">
                        <h1 class="text-uppercase">Multitude of roster config options</h1>
                        <hr style="border: 1px solid #ff9800">
                        <p>Make life easier, configure your own custom work schedule's times, ranging from start,end times to day by day rosters.</p>
                    </div>
                    <div class="col-sm-4 col-md-4 details animated wow fadeInDown" data-wow-delay="0s">
                        <img src="img/f_icon4.png" alt="" title="">
                        <h1 class="text-uppercase">Secure and reliable services and features</h1>
                        <hr style="border: 1px solid #ff9800">
                        <p>Secure and reliable services and features while creating and receiving rosters that wont let you down.</p>
                    </div>
                    <div class="col-sm-4 col-md-4 details animated wow fadeInDown" data-wow-delay=".1s">
                        <img src="img/f_icon5.png" alt="" title="">
                        <h1 class="text-uppercase">Easy access of current work rosters</h1>
                        <hr style="border: 1px solid #ff9800">
                        <p>With the user of Reliant Rosters android application, receiving weekly work rosters has never been easier.</p>
                    </div>
                    <div class="col-sm-4 col-md-4 details animated wow fadeInDown" data-wow-delay=".2s">
                        <img src="img/f_icon6.png" alt="" title="">
                        <h1 class="text-uppercase">Always up to date work roster schedules</h1>
                        <hr style="border: 1px solid #ff9800">
                        <p>Reliant Roster provides its users there work rosters as soon as they are created, never leaving outdated information.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main Features Section End -->

        <!-- Team Members Start -->
        <section class="testimonials animated wow fadeIn" id="testimonials" data-wow-duration="2s">
            <div class="container">
                <h4 class="text-center"><b>Our Team</b></h4> <!-- Our team main heading -->
                <br>
                <div class="testimonials_list"> <!-- Scroll list for team members -->
                    <ul class="list-unstyled text-center slides clearfix" id="tslider">
                        <li>
                            <blockquote>
                                <img class="img img-circle" src="img/Team/Joshua.jpg" height="120px" width="120px" alt=""> <!-- Team member profile picture -->
                                <br><br>
                                <span class="author text-uppercase">Joshua Hales</span> <!-- Team member name -->
                                <span class="job">Android developer/PHP developer</span> <!-- Team member work title -->
                                <hr width="50%" style="border: 1px solid #ff9800"> 
                                <br>
                                <a href="#"><i class="fa fa-twitter social-tw2"></i></a> <!-- Team member social accounts -->
                                <a href="#""><i class="fa fa-facebook social-fb2"></i></a>
                                <a href="#"><i class="fa fa-google-plus social-gp2"></i></a>
                                <a href="#"><i class="fa fa-envelope social-em2"></i></a>
                                <!-- Team member details -->
                                <p>Born and raised in Dublin Ireland, Joshua attended primary school at St. Sylvester’s until graduating in 2007, he later went on to study in St. 
                                    Fintans High School. By 2013 he started attending Dun Laoghaire Institute of Art, Design and Technology to study Multimedia Systems and Web Engineering.
                                    <br>
                                    <span style="color: #0097A7;"><font size="3">Outside of college, Joshua has a keen interest in all things Tec related, he also interested in sports, rugby, 
                                        football and fitness. Joshua is a creative and technical minded individual, u will often find him cracking jokes with his mates while he isn’t in programming mode.</font></span></p>
                            </blockquote>
                        </li>
                        <li>
                            <blockquote>
                                <img class="img img-circle" src="img/Team/Ryan.jpg" height="120px" width="120px" alt=""> <!-- Team member profile picture -->
                                <br><br>
                                <span class="author text-uppercase">Ryan Dowler</span> <!-- Team member name -->
                                <span class="job">Android developer/PHP developer</span> <!-- Team member work title -->
                                <hr width="50%" style="border: 1px solid #ff9800">
                                <br>
                                <a href="#"><i class="fa fa-twitter social-tw2"></i></a> <!-- Team member social accounts -->
                                <a href="#"><i class="fa fa-facebook social-fb2"></i></a>
                                <a href="#"><i class="fa fa-google-plus social-gp2"></i></a>
                                <a href="#"><i class="fa fa-envelope social-em2"></i></a>
                                <!-- Team member details -->
                                <p>
                                    Ryan is a Dublin guy who is obsessed with retro gaming and fascinated by technology. Once Ryan finished secondary school he went on to do Electronic & Electrical Technology,
                                    there he got to build great things and be introduced to coding. To pursue his love of programming Ryan began to attend IADT but during the summer before first semester Ryan made use of
                                    his new electronic skills by hacking & fixing many Playstations.
                                    <br>
                                    <span style="color: #0097A7;">
                                        <font size="3">Outside of college, Ryan likes to spend time with his girlfriend & dog Scooby and playing rubbish games for the NES.....Hot chocolate is also nice 
                                        </font>
                                    </span>
                                </p>
                            </blockquote>
                        </li>
                    </ul>
                    <div id="slider_nav"> <!-- Scroll image options -->
                        <div id="prev_arrow"></div>
                        <div id="next_arrow"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Team Members End -->

        <!--  Email Subscription & Footer Section Start -->
        <section class="sub_box">
            <p class="cta_text animated wow fadeInDown">Join Our List and stay updated!</p> <!-- Footer main heading -->
            <form class="animated wow fadeIn" data-wow-duration="2s">
                <input type="email" id="mc-email" placeholder="Enter your email"/> <!-- Email box input -->
                <button type="submit" id="mc_submit">
                    <i class="icon"></i>
                </button>
            </form>
            <br><br>
            <ul class="list-unstyled list-inline app_platform">
                <li class="animated wow fadeInDown" data-wow-delay="0s">
                    <a href=""><img src="img/android_icon.png" alt="" title=""></a> <!-- Device options links -->
                </li>
                <li class="animated wow fadeInDown" data-wow-delay=".2s">
                    <a href=""><img src="img/windows_icon.png" alt="" title=""></a> <!-- Device options links -->
                </li>
            </ul>
            <p class="copyright animated wow fadeIn" data-wow-duration="2s">© 2016 <a href="">ReliantRoster.com</a> All Rights Reserved</p> <!-- Copyright footer -->
            <br><br>
        </section>
        <!--  Email Subscription & Footer Section End -->

        <!-- Back To Top -->
        <ul class="hidden-xs nav pull-right scroll-top">
            <li><a class="scrollup" href="#" title="Scroll to top"><i class="fa fa-arrow-up"></i></a></li> <!-- Scroll to top image logo -->
        </ul>
        <!-- End Back To Top -->
    </body>
</html>
<!-- Main html content End -->