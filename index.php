<?php 
require_once(dirname(__FILE__) . '/config/config.php');

$JobsSQL   = mysqli_query($db, "SELECT * FROM `js_job` ORDER BY `Job_ID` DESC LIMIT 0, 10");
$TotalJobs = mysqli_num_rows($JobsSQL);

$SeekersSQL   = mysqli_query($db, "SELECT * FROM `js_seeker` ORDER BY `Seeker_ID` DESC LIMIT 0, 10");
$CompaniesSQL = mysqli_query($db, "SELECT * FROM `js_company` ORDER BY `Company_ID` DESC LIMIT 0, 10");

$page_name = 'Home';
require_once(dirname(__FILE__) . '/templates/header.php'); ?>

<body>

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- Body content -->
	
    <?php require_once(dirname(__FILE__) . '/templates/navbar.php'); ?>

    <div class="slider-area">
        <div class="slider">
            <div id="bg-slider" class="owl-carousel owl-theme">
             
              <div class="item"><img src="http://localhost/jobseeker/assets/img/slider-image-3.jpg" alt="Mirror Edge"></div>
              <div class="item"><img src="http://localhost/jobseeker/assets/img/slider-image-2.jpg" alt="The Last of us"></div>
              <div class="item"><img src="http://localhost/jobseeker/assets/img/slider-image-1.jpg" alt="GTA V"></div>
             
            </div>
        </div>
        <div class="container slider-content">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                    <h2>Job Searching Just Got So Easy</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi deserunt deleniti, ullam commodi sit ipsam laboriosam velit adipisci quibusdam aliquam teneturo!</p>
                    <div class="search-form wow pulse" data-wow-delay="0.8s">
                        <form action="Search.php" class="form-inline" method="get">
                            <div class="form-group">
                                <input type="text" class="form-control" name="search_keyword" id="search_keyword" placeholder="Job Key Word" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="search_city" id="search_city" placeholder="Enter City" />
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="search_category" id="search_category">
                                    <option value="">~Select Job Category~</option>
                                    <option value="Accounting">Accounting</option>
                                    <option value="General Business">General Business</option>                                
                                    <option value="Admin & Clerical">Admin & Clerical</option>
                                    <option value="General Labor">General Labor</option>
                                    <option value="Pharmaceutical">Pharmaceutical</option>
                                    <option value="Automotive">Automotive</option>
                                    <option value="Government">Government</option>
                                    <option value="Professional Services">Professional Services</option>
                                    <option value="Banking">Banking</option>
                                    <option value="Grocery">Grocery</option>
                                    <option value="Purchasing">Purchasing </option>
                                    <option value="Procurement">Procurement</option>
                                    <option value="Biotech">Biotech</option>
                                    <option value="Health Care">Health Care</option>
                                    <option value="QA">QA</option>
                                    <option value="Quality Control">Quality Control</option>
                                    <option value="Broadcast">Broadcast</option>
                                    <option value="Journalism">Journalism</option>
                                    <option value="Hotel">Hotel</option>
                                    <option value="Hospitality">Hospitality</option>
                                    <option value="Real Estate">Real Estate</option>
                                    <option value="Business Development">Business Development</option>
                                    <option value="Human Resources">Human Resources</option>
                                    <option value="Research">Research</option>
                                    <option value="Construction">Construction</option>
                                    <option value="Information Technology">Information Technology</option>
                                    <option value="Restaurant">Restaurant</option>
                                    <option value="Food Service">Food Service</option>
                                    <option value="Consultant">Consultant</option>
                                    <option value="Installation">Installation</option>
                                    <option value="Maint">Maint</option>
                                    <option value="Repair">Repair</option>
                                    <option value="Retail">Retail</option>
                                    <option value="Customer Service">Customer Service</option>
                                    <option value="Insurance">Insurance</option>
                                    <option value="Sales">Sales</option>
                                    <option value="Design">Design</option>
                                    <option value="Inventory">Inventory</option>
                                    <option value="Science">Science</option>
                                    <option value="Distribution">Distribution</option>
                                    <option value="Shipping">Shipping</option>
                                    <option value="Legal">Legal</option>
                                    <option value="Skilled Labor">Skilled Labor</option>
                                    <option value="Trades">Trades</option>
                                    <option value="Education">Education</option>
                                    <option value="Teaching">Teaching</option>
                                    <option value="Legal Admin">Legal Admin</option>
                                    <option value="Strategy">Strategy</option>
                                    <option value="Planning">Planning</option>
                                    <option value="Engineering">Engineering</option>
                                    <option value="Management">Management</option>
                                    <option value="Supply Chain">Supply Chain</option>
                                    <option value="Entry Level">Entry Level</option>
                                    <option value="New Grad">New Grad</option>
                                    <option value="Manufacturing">Manufacturing</option>
                                    <option value="Telecommunications">Telecommunications</option>
                                    <option value="Executive">Executive</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Training">Training</option>
                                    <option value="Facilities">Facilities</option>
                                    <option value="Media">Media</option>
                                    <option value="Journalism">Journalism</option>
                                    <option value="Newspaper">Newspaper</option>
                                    <option value="Transportation">Transportation</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Nonprofit">Nonprofit</option>
                                    <option value="Social Services">Social Services</option>
                                    <option value="Warehouse">Warehouse</option>
                                    <option value="Franchise">Franchise</option>
                                    <option value="Nurse">Nurse</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <input type="submit" class="btn" name="search" id="search" value="Search">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-area">
        <div class="container">
            <div class="row page-title text-center wow zoomInDown" data-wow-delay="1s">
                <h5>Our Process</h5>
                <h2>How we work for you?</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae illum dolorem, rem officia, id explicabo sapiente</p>
            </div>
            <div class="row how-it-work text-center">
                <div class="col-md-4">
                    <div class="single-work wow fadeInUp" data-wow-delay="0.8s">
                        <img src="http://localhost/jobseeker/assets/img/how-work1.png" alt="">
                        <h3>Searching for the best job</h3>
                        <p>Using the outcomes from the job, we will put together a plan for the most effective marketing strategy to get the best results.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-work  wow fadeInUp"  data-wow-delay="0.9s">
                        <img src="http://localhost/jobseeker/assets/img/how-work2.png" alt="">
                        <h3>Searching for the best job</h3>
                        <p>Using the outcomes from the job, we will put together a plan for the most effective marketing strategy to get the best results.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-work wow fadeInUp"  data-wow-delay="1s">
                        <img src="http://localhost/jobseeker/assets/img/how-work3.png" alt="">
                        <h3>Searching for the best job</h3>
                        <p>Using the outcomes from the job, we will put together a plan for the most effective marketing strategy to get the best results.</p>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="container">
            <div class="row job-posting wow fadeInUp" data-wow-delay="1s">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#job-seekers" aria-controls="home" role="tab" data-toggle="tab">Job Seekers</a>
                        </li>
                        <li role="presentation">
                            <a href="#employeers" aria-controls="profile" role="tab" data-toggle="tab">Employeers</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="job-seekers">
                            <ul class="list-inline job-seeker">
                                <?php while( $Seekers = mysqli_fetch_assoc($SeekersSQL) ) { ?>
                                    <li>
                                        <a href="#">
                                            <img src="http://localhost/jobseeker/uploads/seeker/<?php echo $Seekers['Seeker_Unique_ID'].'/'.$Seekers['Seeker_Photo']; ?>" alt="<?php echo $Seekers['Seeker_Name']; ?>" width="170" height="190" />
                                            <div class="overlay">
                                                <h3><?php echo $Seekers['Seeker_Name']; ?></h3>
                                                <p><?php echo $Seekers['Seeker_Education']; ?></p>
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="employeers">
                            <ul class="list-inline">
                                <?php while( $Companies = mysqli_fetch_assoc($CompaniesSQL) ) { ?>
                                    <li>
                                        <a href="#">
                                            <img src="http://localhost/jobseeker/uploads/company/<?php echo $Companies['Company_Unique_ID'].'/'.$Companies['Company_Photo']; ?>" alt="" width="170" height="190" />
                                            <div class="overlay">
                                                <h3><?php echo $Companies['Company_Name']; ?></h3>
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="container">
            <div class="row page-title text-center wow bounce"  data-wow-delay="1s">
                <h5>Recent Jobs</h5>
                <h2><span><?php echo $TotalJobs; ?></span> Available jobs for you</h2>
            </div>
            <div class="row jobs">
                <div class="col-md-12">
                    <div class="job-posts table-responsive">
                        <table class="table">
                            <?php
                            $count = 0;
                            while( $Jobs = mysqli_fetch_assoc($JobsSQL) ) {
                            ?>  
                                <tr class="<?php echo (++$count%2 ? "odd" : "even"); ?> wow fadeInUp" data-wow-delay="1s">
                                    <td class="tbl-logo">
                                        <img src="http://localhost/jobseeker/uploads/job/<?php echo $Jobs['Job_Unique_ID'].'/'.$Jobs['Job_Image']; ?>" alt="<?php echo $Jobs['Job_Title']; ?>" width="72" height="72" />
                                    </td>
                                    <td class="tbl-title">
                                        <h4><?php echo $Jobs['Job_Title']; ?> <br>
                                            <span class="job-type"><?php echo $Jobs['Job_Type']; ?></span>
                                        </h4>
                                    </td>
                                    <td><p><?php echo $Jobs['Job_Category']; ?></p></td>
                                    <td><p><i class="icon-location"></i><?php echo $Jobs['Job_Location']; ?></p></td>
                                    <td><p>&#8377; <?php echo $Jobs['Job_Salary']; ?>/-</p></td>
                                    <td><p><?php echo date('jS F, Y', strtotime($Jobs['Job_Posted_On'])); ?></p></td>
                                    <td>
                                        <div class="fadeInRight" data-wow-delay="1.5s">
                                            <?php if( empty($_SESSION['SeekerLoggedIn']) ) { ?>
                                                <a class="btn btn-info" href="http://localhost/jobseeker/SeekerLogin.php">Apply Job</a>
                                            <?php } else { ?>
                                                <a class="btn btn-info ApplyJob" data-toggle="modal" data-target="#ApplyJob" data-uniqid="<?php echo $Jobs['Job_Unique_ID']; ?>">Apply Job</a>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="container">
            <div class="row page-title text-center  wow bounce"  data-wow-delay=".7s">
                <h5>TESTIMONIALS</h5>
                <h2>WHAT PEOPLES ARE SAYING</h2>
            </div>
            <div class="row testimonial">
                <div class="col-md-12">
                    <div id="testimonial-slider">
                        <div class="item">
                            <div class="client-text">                                
                                <p>JobSeeker offer an amazing service and I couldn’t be happier! They 
                                are dedicated to helping recruiters find great candidates, wonderful service!</p>
                                <h4><strong>John Berry, </strong><i>Human Resource</i></h4>
                            </div>
                            <div class="client-face wow fadeInRight" data-wow-delay=".9s"> 
                                <img src="http://localhost/jobseeker/assets/img/client-face1.png" alt="">
                            </div>
                        </div>
                        <div class="item">
                            <div class="client-text">                                
                                <p>JobSeeker offer an amazing service and I couldn’t be happier! They 
                                are dedicated to helping recruiters find great candidates, wonderful service!</p>
                                <h4><strong>Arnold Wright, </strong><i>CEO</i></h4>
                            </div>
                            <div class="client-face">
                                <img src="http://localhost/jobseeker/assets/img/client-face2.png" alt="">
                            </div>
                        </div>
                        <div class="item">
                            <div class="client-text">                                
                                <p>JobSeeker offer an amazing service and I couldn’t be happier! They 
                                are dedicated to helping recruiters find great candidates, wonderful service!</p>
                                <h4><strong>Robert Black, </strong><i>Human Resource</i></h4>
                            </div>
                            <div class="client-face">
                                <img src="http://localhost/jobseeker/assets/img/client-face3.png" alt="">
                            </div>
                        </div>
                        <div class="item">
                            <div class="client-text">                                
                                <p>JobSeeker offer an amazing service and I couldn’t be happier! They 
                                are dedicated to helping recruiters find great candidates, wonderful service!</p>
                                <h4><strong>Daniel Martin, </strong><i>CEO</i></h4>
                            </div>
                            <div class="client-face">
                                <img src="http://localhost/jobseeker/assets/img/client-face4.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="ApplyJob" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="loader"></div>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Are you sure you want to apply for this Job?</h4>
                </div>
                <div class="modal-body">                    
                    <div id="JobDescription"></div>
                </div>
                <div class="modal-footer">
                    <span id="JobMessage" class="pull-left"></span>
                    <input type="hidden" name="jobID" id="jobID" />
                    <button type="button" class="btn btn-success" id="SubmitJob">Apply</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

<?php require_once(dirname(__FILE__) . '/templates/footer.php'); ?>