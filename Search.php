<?php
require_once(dirname(__FILE__) . '/config/config.php');

$Keyword  = isset($_GET['search_keyword']) ? $_GET['search_keyword'] : '';
$City 	  = isset($_GET['search_city']) ? $_GET['search_city'] : '';
$Category = isset($_GET['search_category']) ? $_GET['search_category'] : '';

$perpage 	 = 5;
if( isset($_GET['page']) & !empty($_GET['page']) ) {
	$curpage = $_GET['page'];
} else {
	$curpage = 1;
}
$start 	  	  = ($curpage * $perpage) - $perpage;
$PageSQL  	  = mysqli_query($db, "SELECT * FROM `js_job` WHERE `Job_Location` LIKE '%".$City."%' OR `Job_Category` = '".$Category."' OR (`Job_Title` LIKE '%".$Keyword."%' OR `Job_Description` LIKE '%".$Keyword."%' OR `Job_Type` LIKE '%".$Keyword."%' OR `Job_Education_Skill` LIKE '%".$Keyword."%' OR `Job_Technical_Skill` LIKE '%".$Keyword."%' OR `Job_Salary` LIKE '%".$Keyword."%')");
$totalres 	  = mysqli_num_rows($PageSQL);

$endpage 	  = ceil($totalres / $perpage);
$startpage 	  = 1;
$nextpage 	  = $curpage + 1;
$previouspage = $curpage - 1;

$JobsSQL      = mysqli_query($db, "SELECT * FROM `js_job` WHERE `Job_Location` LIKE '%".$City."%' OR `Job_Category` = '".$Category."' OR (`Job_Title` LIKE '%".$Keyword."%' OR `Job_Description` LIKE '%".$Keyword."%' OR `Job_Type` LIKE '%".$Keyword."%' OR `Job_Education_Skill` LIKE '%".$Keyword."%' OR `Job_Technical_Skill` LIKE '%".$Keyword."%' OR `Job_Salary` LIKE '%".$Keyword."%') LIMIT $start, $perpage");

$page_name = 'Search Results';
require_once(dirname(__FILE__) . '/templates/header.php'); ?>

<body>

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- Body content -->
  
    <?php require_once(dirname(__FILE__) . '/templates/navbar.php'); ?>

    <div class="content-area">
        <div class="container">
        	<div class="col-sm-12">
                <div class="search-form wow pulse text-center" data-wow-delay="0.8s">
                    <form action="Search.php" class="form-inline" method="get">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search_keyword" id="search_keyword" placeholder="Job Key Word" value="<?php echo $Keyword; ?>" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="search_city" id="search_city" placeholder="Enter City" value="<?php echo $City; ?>" />
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="search_category" id="search_category">
                                <option <?php if($Category == "") { ?> selected="selected" <?php } ?> value="">~Select Job Category~</option>
                                <option <?php if($Category == "Accounting") { ?> selected="selected" <?php } ?> value="Accounting">Accounting</option>
                                <option <?php if($Category == "General Business") { ?> selected="selected" <?php } ?> value="General Business">General Business</option>                                
                                <option <?php if($Category == "Admin & Clerical") { ?> selected="selected" <?php } ?> value="Admin & Clerical">Admin & Clerical</option>
                                <option <?php if($Category == "General Labor") { ?> selected="selected" <?php } ?> value="General Labor">General Labor</option>
                                <option <?php if($Category == "Pharmaceutical") { ?> selected="selected" <?php } ?> value="Pharmaceutical">Pharmaceutical</option>
                                <option <?php if($Category == "Automotive") { ?> selected="selected" <?php } ?> value="Automotive">Automotive</option>
                                <option <?php if($Category == "Government") { ?> selected="selected" <?php } ?> value="Government">Government</option>
                                <option <?php if($Category == "Professional Services") { ?> selected="selected" <?php } ?> value="Professional Services">Professional Services</option>
                                <option <?php if($Category == "Banking") { ?> selected="selected" <?php } ?> value="Banking">Banking</option>
                                <option <?php if($Category == "Grocery") { ?> selected="selected" <?php } ?> value="Grocery">Grocery</option>
                                <option <?php if($Category == "Purchasing") { ?> selected="selected" <?php } ?> value="Purchasing">Purchasing </option>
                                <option <?php if($Category == "Procurement") { ?> selected="selected" <?php } ?> value="Procurement">Procurement</option>
                                <option <?php if($Category == "Biotech") { ?> selected="selected" <?php } ?> value="Biotech">Biotech</option>
                                <option <?php if($Category == "Health Care") { ?> selected="selected" <?php } ?> value="Health Care">Health Care</option>
                                <option <?php if($Category == "QA") { ?> selected="selected" <?php } ?> value="QA">QA</option>
                                <option <?php if($Category == "Quality Control") { ?> selected="selected" <?php } ?> value="Quality Control">Quality Control</option>
                                <option <?php if($Category == "Broadcast") { ?> selected="selected" <?php } ?> value="Broadcast">Broadcast</option>
                                <option <?php if($Category == "Journalism") { ?> selected="selected" <?php } ?> value="Journalism">Journalism</option>
                                <option <?php if($Category == "Hotel") { ?> selected="selected" <?php } ?> value="Hotel">Hotel</option>
                                <option <?php if($Category == "Hospitality") { ?> selected="selected" <?php } ?> value="Hospitality">Hospitality</option>
                                <option <?php if($Category == "Real Estate") { ?> selected="selected" <?php } ?> value="Real Estate">Real Estate</option>
                                <option <?php if($Category == "Business Development") { ?> selected="selected" <?php } ?> value="Business Development">Business Development</option>
                                <option <?php if($Category == "Human Resources") { ?> selected="selected" <?php } ?> value="Human Resources">Human Resources</option>
                                <option <?php if($Category == "Research") { ?> selected="selected" <?php } ?> value="Research">Research</option>
                                <option <?php if($Category == "Construction") { ?> selected="selected" <?php } ?> value="Construction">Construction</option>
                                <option <?php if($Category == "Information Technology") { ?> selected="selected" <?php } ?> value="Information Technology">Information Technology</option>
                                <option <?php if($Category == "Restaurant") { ?> selected="selected" <?php } ?> value="Restaurant">Restaurant</option>
                                <option <?php if($Category == "Food Service") { ?> selected="selected" <?php } ?> value="Food Service">Food Service</option>
                                <option <?php if($Category == "Consultant") { ?> selected="selected" <?php } ?> value="Consultant">Consultant</option>
                                <option <?php if($Category == "Installation") { ?> selected="selected" <?php } ?> value="Installation">Installation</option>
                                <option <?php if($Category == "Maint") { ?> selected="selected" <?php } ?> value="Maint">Maint</option>
                                <option <?php if($Category == "Repair") { ?> selected="selected" <?php } ?> value="Repair">Repair</option>
                                <option <?php if($Category == "Retail") { ?> selected="selected" <?php } ?> value="Retail">Retail</option>
                                <option <?php if($Category == "Customer Service") { ?> selected="selected" <?php } ?> value="Customer Service">Customer Service</option>
                                <option <?php if($Category == "Insurance") { ?> selected="selected" <?php } ?> value="Insurance">Insurance</option>
                                <option <?php if($Category == "Sales") { ?> selected="selected" <?php } ?> value="Sales">Sales</option>
                                <option <?php if($Category == "Design") { ?> selected="selected" <?php } ?> value="Design">Design</option>
                                <option <?php if($Category == "Inventory") { ?> selected="selected" <?php } ?> value="Inventory">Inventory</option>
                                <option <?php if($Category == "Science") { ?> selected="selected" <?php } ?> value="Science">Science</option>
                                <option <?php if($Category == "Distribution") { ?> selected="selected" <?php } ?> value="Distribution">Distribution</option>
                                <option <?php if($Category == "Shipping") { ?> selected="selected" <?php } ?> value="Shipping">Shipping</option>
                                <option <?php if($Category == "Legal") { ?> selected="selected" <?php } ?> value="Legal">Legal</option>
                                <option <?php if($Category == "Skilled Labor") { ?> selected="selected" <?php } ?> value="Skilled Labor">Skilled Labor</option>
                                <option <?php if($Category == "Trades") { ?> selected="selected" <?php } ?> value="Trades">Trades</option>
                                <option <?php if($Category == "Education") { ?> selected="selected" <?php } ?> value="Education">Education</option>
                                <option <?php if($Category == "Teaching") { ?> selected="selected" <?php } ?> value="Teaching">Teaching</option>
                                <option <?php if($Category == "Legal Admin") { ?> selected="selected" <?php } ?> value="Legal Admin">Legal Admin</option>
                                <option <?php if($Category == "Strategy") { ?> selected="selected" <?php } ?> value="Strategy">Strategy</option>
                                <option <?php if($Category == "Planning") { ?> selected="selected" <?php } ?> value="Planning">Planning</option>
                                <option <?php if($Category == "Engineering") { ?> selected="selected" <?php } ?> value="Engineering">Engineering</option>
                                <option <?php if($Category == "Management") { ?> selected="selected" <?php } ?> value="Management">Management</option>
                                <option <?php if($Category == "Supply Chain") { ?> selected="selected" <?php } ?> value="Supply Chain">Supply Chain</option>
                                <option <?php if($Category == "Entry Level") { ?> selected="selected" <?php } ?> value="Entry Level">Entry Level</option>
                                <option <?php if($Category == "New Grad") { ?> selected="selected" <?php } ?> value="New Grad">New Grad</option>
                                <option <?php if($Category == "Manufacturing") { ?> selected="selected" <?php } ?> value="Manufacturing">Manufacturing</option>
                                <option <?php if($Category == "Telecommunications") { ?> selected="selected" <?php } ?> value="Telecommunications">Telecommunications</option>
                                <option <?php if($Category == "Executive") { ?> selected="selected" <?php } ?> value="Executive">Executive</option>
                                <option <?php if($Category == "Marketing") { ?> selected="selected" <?php } ?> value="Marketing">Marketing</option>
                                <option <?php if($Category == "Training") { ?> selected="selected" <?php } ?> value="Training">Training</option>
                                <option <?php if($Category == "Facilities") { ?> selected="selected" <?php } ?> value="Facilities">Facilities</option>
                                <option <?php if($Category == "Media") { ?> selected="selected" <?php } ?> value="Media">Media</option>
                                <option <?php if($Category == "Journalism") { ?> selected="selected" <?php } ?> value="Journalism">Journalism</option>
                                <option <?php if($Category == "Newspaper") { ?> selected="selected" <?php } ?> value="Newspaper">Newspaper</option>
                                <option <?php if($Category == "Transportation") { ?> selected="selected" <?php } ?> value="Transportation">Transportation</option>
                                <option <?php if($Category == "Finance") { ?> selected="selected" <?php } ?> value="Finance">Finance</option>
                                <option <?php if($Category == "Nonprofit") { ?> selected="selected" <?php } ?> value="Nonprofit">Nonprofit</option>
                                <option <?php if($Category == "Social Services") { ?> selected="selected" <?php } ?> value="Social Services">Social Services</option>
                                <option <?php if($Category == "Warehouse") { ?> selected="selected" <?php } ?> value="Warehouse">Warehouse</option>
                                <option <?php if($Category == "Franchise") { ?> selected="selected" <?php } ?> value="Franchise">Franchise</option>
                                <option <?php if($Category == "Nurse") { ?> selected="selected" <?php } ?> value="Nurse">Nurse</option>
                                <option <?php if($Category == "Other") { ?> selected="selected" <?php } ?> value="Other">Other</option>
                            </select>
                        </div>
                        <input type="submit" class="btn" name="search" id="search" value="Search">
                    </form>
                </div>
                <?php if(isset($_GET['search_keyword']) && isset($_GET['search_city']) && isset($_GET['search_category'])) { ?>
                    <div class="hr"></div>
                    <div class="row">
    					<div class="col-md-12">
    	                    <div class="job-posts table-responsive">
    	                    	<?php if($totalres != 0) { ?>
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
    								<nav aria-label="Page navigation" class="pull-right">
    									<ul class="pagination">
    									<?php if( $curpage != $startpage ) { ?>
    										<li class="page-item">
    											<a class="page-link" href="?page=<?php echo $startpage; ?>" tabindex="-1" aria-label="Previous">
    												<span aria-hidden="true">&laquo;</span>
    												<span class="sr-only">First</span>
    											</a>
    										</li>
    									<?php } ?>
    									<?php if( $curpage >= 2 ) { ?>
    										<li class="page-item">
    											<a class="page-link" href="?page=<?php echo $previouspage; ?>">
    												<?php echo $previouspage ?>
    											</a>
    										</li>
    									<?php } ?>
    										<li class="page-item active">
    											<a class="page-link" href="?page=<?php echo $curpage; ?>">
    												<?php echo $curpage ?>
    											</a>
    										</li>
    									<?php if( $curpage != $endpage ) { ?>
    										<li class="page-item">
    											<a class="page-link" href="?page=<?php echo $nextpage; ?>">
    												<?php echo $nextpage ?>
    											</a>
    										</li>
    										<li class="page-item">
    											<a class="page-link" href="?page=<?php echo $endpage; ?>" aria-label="Next">
    												<span aria-hidden="true">&raquo;</span>
    												<span class="sr-only">Last</span>
    											</a>
    										</li>
    									<?php } ?>
    									</ul>
    								</nav>
    							<?php } else { ?>
    								<div>
    									<h1>Sorry! No results found for your searched keywords.</h1>
    								</div>
    							<?php } ?>
    	                    </div>
    					</div>
    				</div>
                <?php } ?>
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