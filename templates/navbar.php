<?php
$url    = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$params = explode("/", $url);
?>
<div class="header-connect">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-8 col-xs-8">
                <div class="header-half header-call">
                    <p>
                        <span><i class="icon-cloud"></i>+91-98765-43210</span>
                        <span><i class="icon-mail"></i>jobseeker.supp@gmail.com</span>
                    </p>
                </div>
            </div>
            <div class="col-md-2 col-md-offset-5  col-sm-3 col-sm-offset-1  col-xs-3  col-xs-offset-1">
                <div class="header-half header-social">
                    <ul class="list-inline">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-vine"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://localhost/jobseeker">
                <img src="http://localhost/jobseeker/assets/img/logo.png" alt="JobSeeker">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="main-nav nav navbar-nav navbar-right">
                <li class="wow fadeInDown" data-wow-delay="0s">
                    <a <?php if( $params[4] == "index.php" || $params[4] == "" ) { ?>class="active"<?php } ?> href="./">Home</a>
                </li>
                <li class="wow fadeInDown" data-wow-delay="0.3s">
                    <a <?php if( $params[4] == "AboutUs.php") { ?>class="active"<?php } ?> href="AboutUs.php">About Us</a>
                </li>
                <li class="wow fadeInDown" data-wow-delay="0.4s">
                    <a <?php if( $params[4] == "Blog.php" ) { ?>class="active"<?php } ?> href="Blog.php">Blog</a>
                </li>
                <li class="wow fadeInDown" data-wow-delay="0.3s">
                    <a <?php if( $params[4] == "FAQ.php" ) { ?>class="active"<?php } ?> href="FAQ.php">FAQ</a>
                </li>
                <li class="wow fadeInDown" data-wow-delay="0.5s">
                    <a <?php if( $params[4] == "ContactUs.php" ) { ?>class="active"<?php } ?> href="ContactUs.php">Contact Us</a>
                </li>
                <?php if( empty($_SESSION['CompanyLoggedIn']) ) { ?>
                    <li class="wow fadeInDown" data-wow-delay="0.1s">
                        <?php if( empty($_SESSION['SeekerLoggedIn']) ) { ?>
                            <a <?php if( $params[4] == "SeekerLogin.php" ) { ?>class="active"<?php } ?> href="SeekerLogin.php">Job Seekers</a>
                        <?php } else { ?>
                            <a <?php if( $params[4] == "SeekerDashboard.php" ) { ?>class="active"<?php } ?> href="SeekerDashboard.php">Dashboard</a>
                        <?php } ?>
                    </li>
                <?php } ?>
                <?php if( empty($_SESSION['SeekerLoggedIn']) ) { ?>
                    <li class="wow fadeInDown" data-wow-delay="0.2s">
                        <?php if( empty($_SESSION['CompanyLoggedIn']) ) { ?>
                            <a <?php if( $params[4] == "CompanyLogin.php" ) { ?>class="active"<?php } ?> href="CompanyLogin.php">Company</a>
                        <?php } else { ?>
                            <a <?php if( $params[4] == "CompanyDashboard.php" ) { ?>class="active"<?php } ?> href="CompanyDashboard.php">Dashboard</a>
                        <?php } ?>
                    </li>
                <?php } ?>
                <?php if( !empty($_SESSION['SeekerLoggedIn']) || !empty($_SESSION['CompanyLoggedIn']) ) { ?>
                    <li class="wow fadeInDown" data-wow-delay="0.3s">
                        <a href="logout.php">Logout</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>