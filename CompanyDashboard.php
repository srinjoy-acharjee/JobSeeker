<?php
require_once(dirname(__FILE__) . '/config/config.php');

if( empty($_SESSION['CompanyLoggedIn']) ) {
	header("Location: http://localhost/jobseeker/CompanyLogin.php");
	exit;
}

$CompanySQL = mysqli_query($db, "SELECT * FROM `js_company` WHERE `Company_ID` = ".$_SESSION['CompanyLoggedIn']['UserID']." LIMIT 0, 1");
$Company    = mysqli_fetch_assoc($CompanySQL);

$perpage 	 = 5;
if( isset($_GET['page']) & !empty($_GET['page']) ) {
	$curpage = $_GET['page'];
} else {
	$curpage = 1;
}
$start 	  	  = ($curpage * $perpage) - $perpage;
$PageSQL  	  = mysqli_query($db, "SELECT * FROM `js_job` WHERE `Job_Company_ID` = ".$_SESSION['CompanyLoggedIn']['UserID']);
$totalres 	  = mysqli_num_rows($PageSQL);

$endpage 	  = ceil($totalres / $perpage);
$startpage 	  = 1;
$nextpage 	  = $curpage + 1;
$previouspage = $curpage - 1;

$JobsSQL      = mysqli_query($db, "SELECT * FROM `js_job` WHERE `Job_Company_ID` = ".$_SESSION['CompanyLoggedIn']['UserID']." LIMIT $start, $perpage");

$page_name = 'Dashboard';
require_once(dirname(__FILE__) . '/templates/header.php'); ?>

<body>

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- Body content -->
  
    <?php require_once(dirname(__FILE__) . '/templates/navbar.php'); ?>

    <div class="content-area">
    	<div class="banner-area">
            <img src="http://localhost/jobseeker/assets/img/dashboard_banner.jpg" alt="Company Dashboard" />
        </div>
        <div class="container">
            <div class="row">
                <h1 class="text-center">Dashboard</h1>
                <div class="row">
					<div class="col-md-12">
			            <div class="col-sm-12">
			            	<div class="col-xs-12 col-sm-3">
			                    <figure>
			                        <img src="http://localhost/jobseeker/uploads/company/<?php echo $Company['Company_Unique_ID']; ?>/<?php echo $Company['Company_Photo']; ?>" alt="<?php echo $Company['Company_Name']; ?>" class="img-circle" height="300" />
			                    </figure>
			                </div>
			                <div class="col-xs-12 col-sm-9">
			                    <h2><?php echo $Company['Company_Name']; ?></h2>
			                    <p><strong>Address: </strong> <?php echo $Company['Company_Address']; ?> </p>
			                    <p><strong>Phone: </strong> <?php echo $Company['Company_Phone']; ?> </p>
			                    <p><strong>Website: </strong> <a href="<?php echo $Company['Company_Website']; ?>" target="_blank"><?php echo $Company['Company_Website']; ?></a> </p>
			                    <p><strong>About: </strong> <?php echo $Company['Company_Bio']; ?> </p>
			                    <p><strong>ESTD On: </strong> <?php echo $Company['Company_Estd_On']; ?> </p>
			                    <p><strong>Employee: </strong> <?php echo $Company['Company_Emp_Num']; ?> </p>
			                </div>
			                <div class="col-sm-2">
			                    <a href="AddJob.php" class="btn btn-success">
			                    	<span class="fa fa-plus-circle"></span> Add Job 
			                    </a>
			                </div>
			                <div class="col-sm-2">
			                    <a href="JobApplication.php" class="btn btn-info">
			                    	<span class="fa fa-file-text"></span> Applications
			                    </a>
			                </div>
			                <div class="col-sm-2">
			                    <div class="btn-group dropup">
			                      <button type="button" class="btn btn-primary"><span class="fa fa-gear"></span> Settings </button>
			                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
			                        <span class="caret"></span>
			                        <span class="sr-only">Toggle Dropdown</span>
			                      </button>
			                      <ul class="dropdown-menu text-left" role="menu">
			                        <li>
			                        	<a href="#sendmailModal" role="button" data-toggle="modal">
			                        		<span class="fa fa-envelope pull-right"></span> Send Email 
			                        	</a>
			                        </li>
			                        <li><a href="EditCompany.php"><span class="fa fa-list pull-right"></span> Edit Profile </a></li>
			                        <li class="divider"></li>
			                        <li><a href="logout.php" class="btn" role="button"><span class="fa fa-sign-out pull-right"></span> Logout </a></li>
			                      </ul>
			                    </div>
			                </div>
						</div>						
			            <div class="hr"></div>
			            <div class="col-sm-12">
			            	<h1 class="text-center">All Posted Job</h1>
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
				                    </div>
				                </div>
				            </div>
			            </div>
					</div>
				</div>
                <div class="col-sm-12">
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="sendmailModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="sendmailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        	<div class="loader hide"></div>
            <div class="modal-content">
            	<form class="form-horizontal" name="send_mail_form" method="post">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                    <h4 class="modal-title">Send Mail</h4>
	                </div>
                	<div class="modal-body">
	                	<div class="sendmail_form">
	                        <div class="form-group">
	                            <label for="to" class="control-label">To</label>
	                            <input type="email" class="form-control" name="to" id="to" required />
	                        </div>
	                        <div class="form-group">
	                            <label for="toname" class="control-label">To Name</label>
	                            <input type="email" class="form-control" name="toname" id="toname" required />
	                        </div>
	                        <div class="form-group">
	                            <label for="subject" class="control-label">Subject</label>
	                            <input type="text" class="form-control" id="subject" name="subject" required />
	                        </div>
	                        <div class="form-group">
	                            <label for="message" class="control-label">Message</label>
	                            <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
	                        </div>
	                        <div class="form-group">
	                        	<span id="SendMessage" class="pull-left"></span>
	                        	<input type="hidden" id="from" name="from" value="<?php echo $Company['Company_Email']; ?>" />
	                        	<input type="hidden" id="fromname" name="fromname" value="<?php echo $Company['Company_Name']; ?>" />
	                        	<button type="button" class="btn btn-default pull-right" data-dismiss="modal" aria-hidden="true">Close</button>
			                	<button type="button" id="sendmail" class="btn btn-info pull-right">Submit</button>
			                </div>
	                    </div>
	                </div>
	            </form>
            </div>
        </div>
    </div>

<?php require_once(dirname(__FILE__) . '/templates/footer.php'); ?>