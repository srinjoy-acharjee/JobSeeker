<?php
require_once(dirname(__FILE__) . '/config/config.php');

$page_name = 'Blog';
require_once(dirname(__FILE__) . '/templates/header.php'); ?>

<body>

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- Body content -->
  
    <?php require_once(dirname(__FILE__) . '/templates/navbar.php'); ?>

    <div class="content-area">
        <div class="banner-area">
            <img src="http://localhost/jobseeker/assets/img/blog_banner.jpg" alt="Blog" />
        </div>
        <div class="container">
            <div class="row">
                <h1 class="text-center">Blog</h1>
            </div>
        </div>
        <div class="container">
            <div class="row blog-row">
                <div class="col-md-6 col-sm-6 col-xs-12 margin_bottom30">
                    <a href="javascript:;">
                        <img class="img-responsive center-block" src="http://localhost/jobseeker/assets/img/infotech.jpg" height="250">
                    </a>
                    <div class="blog-content bg-white">
                        <h3>Lorem Ipsum Dolor Sit Amet</h3>
                        <p>Category : <a href="javascript:;">Information Technology</a></p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sed pretium nunc, nec lobortis orci. Fusce fringilla facilisis sollicitudin. Suspendisse dignissim ultrices sollicitudin. Nulla facilisi. In feugiat in augue sed elementum. Vestibulum ante ipsum primis in faucibus orci luctus....<a href="javascript:;" class="heading_color">Continue Reading</a>
                        </p>
                        <hr>
                        <p>
                            <span>Share : 
                                <a href="javascript:;"><i class="fa fa-facebook margin_left10" aria-hidden="true"></i></a>
                                <a href="javascript:;"><i class="fa fa-twitter margin_left10" aria-hidden="true"></i></a>
                                <a href="javascript:;"><i class="fa fa-google-plus margin_left10" aria-hidden="true"></i></a>
                            </span> 
                            <span class="pull-right">By : <strong>Priyanka Pramanik</strong></span>
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 margin_bottom30">
                    <a href="javascript:;">
                        <img class="img-responsive center-block" src="http://localhost/jobseeker/assets/img/masscomm.jpg" height="250">
                    </a>
                    <div class="blog-content bg-white">
                        <h3>Nullam Feugiat Tortor Elit</h3>
                        <p>Category : <a href="javascript:;">Mass Communication</a></p>
                        <p>
                            Nullam feugiat tortor elit, quis vulputate est elementum sit amet. Suspendisse pharetra ultrices nulla non pulvinar. Mauris quam tortor, cursus eu nisi in, porttitor sagittis sem. Quisque euismod, nulla quis tristique dignissim, felis eros eleifend tortor, nec fermentum risus libero ut tortor....<a href="javascript:;" class="heading_color">Continue Reading</a>
                        </p>
                        <hr>
                        <p>
                            <span>Share : 
                                <a href="javascript:;"><i class="fa fa-facebook margin_left10" aria-hidden="true"></i></a>
                                <a href="javascript:;"><i class="fa fa-twitter margin_left10" aria-hidden="true"></i></a>
                                <a href="javascript:;"><i class="fa fa-google-plus margin_left10" aria-hidden="true"></i></a>
                            </span> 
                            <span class="pull-right">By : <strong>Priyanka Pramanik</strong></span>
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 margin_bottom30">
                    <a href="javascript:;">
                        <img class="img-responsive center-block" src="http://localhost/jobseeker/assets/img/telecomm.jpg" height="250">
                    </a>
                    <div class="blog-content bg-white">
                        <h3>Aenean Pretium Non Nibh</h3>
                        <p>Category : <a href="javascript:;">Telecommunication</a></p>
                        <p>
                            Aenean pretium non nibh vitae bibendum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc posuere pharetra turpis accumsan convallis. Nulla sodales, justo et dignissim pulvinar, ipsum tortor tincidunt ipsum, non dapibus tellus tellus a velit.....<a href="javascript:;" class="heading_color">Continue Reading</a>
                        </p>
                        <hr>
                        <p>
                            <span>Share : 
                                <a href="javascript:;"><i class="fa fa-facebook margin_left10" aria-hidden="true"></i></a>
                                <a href="javascript:;"><i class="fa fa-twitter margin_left10" aria-hidden="true"></i></a>
                                <a href="javascript:;"><i class="fa fa-google-plus margin_left10" aria-hidden="true"></i></a>
                            </span> 
                            <span class="pull-right">By : <strong>Priyanka Pramanik</strong></span>
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 margin_bottom30">
                    <a href="javascript:;">
                        <img class="img-responsive center-block" src="http://localhost/jobseeker/assets/img/dataanalytics.jpg" height="250">
                    </a>
                    <div class="blog-content bg-white">
                        <h3>Vivamus Congue Sit Amet</h3>
                        <p>Category : <a href="javascript:;">Data Analytics</a></p>
                        <p>
                            Vivamus congue sit amet elit ac ullamcorper. Aenean lobortis augue quis lorem fermentum, id vehicula est facilisis. Vivamus venenatis justo enim, id placerat magna luctus sed. Mauris convallis est nec risus maximus dictum. Morbi ac dapibus magna....<a href="javascript:;" class="heading_color">Continue Reading</a>
                        </p>
                        <hr>
                        <p>
                            <span>Share : 
                                <a href="javascript:;"><i class="fa fa-facebook margin_left10" aria-hidden="true"></i></a>
                                <a href="javascript:;"><i class="fa fa-twitter margin_left10" aria-hidden="true"></i></a>
                                <a href="javascript:;"><i class="fa fa-google-plus margin_left10" aria-hidden="true"></i></a>
                            </span> 
                            <span class="pull-right">By : <strong>Priyanka Pramanik</strong></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once(dirname(__FILE__) . '/templates/footer.php'); ?>