<?php
require_once(dirname(__FILE__) . '/config/config.php');

if( empty($_SESSION['CompanyLoggedIn']) ) {
    header("Location: http://localhost/jobseeker/CompanyLogin.php");
    exit;
}

$CompanySQL = mysqli_query($db, "SELECT * FROM `js_company` WHERE `Company_ID` = ".$_SESSION['CompanyLoggedIn']['UserID']." LIMIT 0, 1");
$Company    = mysqli_fetch_assoc($CompanySQL);

$perpage     = 5;
if( isset($_GET['page']) & !empty($_GET['page']) ) {
    $curpage = $_GET['page'];
} else {
    $curpage = 1;
}
$start        = ($curpage * $perpage) - $perpage;
$PageSQL      = mysqli_query($db, "SELECT * FROM `js_apply` WHERE `Apply_Company_ID` = ".$_SESSION['CompanyLoggedIn']['UserID']);
$totalres     = mysqli_num_rows($PageSQL);

$endpage      = ceil($totalres / $perpage);
$startpage    = 1;
$nextpage     = $curpage + 1;
$previouspage = $curpage - 1;

$JobsSQL      = mysqli_query($db, "SELECT * FROM `js_apply` WHERE `Apply_Company_ID` = ".$_SESSION['CompanyLoggedIn']['UserID']." LIMIT $start, $perpage");

$succMSG = '';$errorMSG = '';
if( isset($_POST['accept_job']) ) {
    $apply_id  = addslashes($_POST['apply_id']);
    $updateSQL = mysqli_query($db, "UPDATE `js_apply` SET `Apply_Job_Status` = 'Accept' WHERE `Apply_ID` = ".$apply_id);
    if( $updateSQL ) {
        $succMSG = 'Successfully accepted the application for the job.';
        echo '<script>setTimeout(function() { window.location.href=window.location.href; }, 3000);</script>';
    } else {
        $errorMSG = 'Oops! Something went wrong. Please try again!';
    }
}

if( isset($_POST['reject_job']) ) {
    $apply_id  = addslashes($_POST['apply_id']);
    $updateSQL = mysqli_query($db, "UPDATE `js_apply` SET `Apply_Job_Status` = 'Reject' WHERE `Apply_ID` = ".$apply_id);
    if( $updateSQL ) {
        $succMSG = 'Successfully rejected the application for the job.';
        echo '<script>setTimeout(function() { window.location.href=window.location.href; }, 3000);</script>';
    } else {
        $errorMSG = 'Oops! Something went wrong. Please try again!';
    }
}

$page_name = 'Jobs Application';
require_once(dirname(__FILE__) . '/templates/header.php'); ?>

<body>

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- Body content -->
  
    <?php require_once(dirname(__FILE__) . '/templates/navbar.php'); ?>

    <div class="content-area">
        <div class="banner-area">
            <img src="http://localhost/jobseeker/assets/img/dashboard_banner.jpg" alt="Seeker Dashboard" />
        </div>
        <div class="container">
            <div class="row">
                <h1 class="text-center">Jobs Application</h1>
                <div class="row text-center">
                    <span class="error-text"><?php echo $errorMSG; ?></span>
                    <span class="success-text"><?php echo $succMSG; ?></span>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row jobs">
                            <div class="col-md-12">
                                <div class="job-posts table-responsive">
                                    <table class="table">
                                        <?php
                                        $count = 0;
                                        while( $Jobs = mysqli_fetch_assoc($JobsSQL) ) {
                                            $GetJobSQL = mysqli_query($db, "SELECT * FROM `js_job` WHERE `Job_ID` = ".$Jobs['Apply_Job_ID']." LIMIT 0, 1");
                                            $GetJob = mysqli_fetch_assoc($GetJobSQL);

                                            $GetSeekerSQL = mysqli_query($db, "SELECT * FROM `js_seeker` WHERE `Seeker_ID` = ".$Jobs['Apply_Seeker_ID']);
                                            $GetSeeker = mysqli_fetch_assoc($GetSeekerSQL);
                                        ?>  
                                            <form method="post" id="job-status">
                                                <input type="hidden" name="apply_id" value="<?php echo $Jobs['Apply_ID']; ?>" />
                                                <tr class="<?php echo (++$count%2 ? "odd" : "even"); ?> wow fadeInUp" data-wow-delay="1s">
                                                    <td class="tbl-logo">
                                                        <img src="http://localhost/jobseeker/uploads/job/<?php echo $GetJob['Job_Unique_ID'].'/'.$Jobs['Apply_Job_Image']; ?>" alt="<?php echo $Jobs['Apply_Job_Title']; ?>" width="72" height="72" />
                                                    </td>
                                                    <td class="tbl-title">
                                                        <h4><?php echo $Jobs['Apply_Job_Title']; ?> <br>
                                                            <span class="job-type"><?php echo $Jobs['Apply_Job_Type']; ?></span>
                                                        </h4>
                                                        <p><?php echo $GetJob['Job_Category']; ?></p>
                                                    </td>                                                
                                                    <td><p><i class="icon-location"></i><?php echo $Jobs['Apply_Job_Location']; ?></p></td>
                                                    <td><p>&#8377; <?php echo $Jobs['Apply_Job_Salary']; ?>/-</p></td>
                                                    <td><p><?php echo date('jS F, Y', strtotime($Jobs['Apply_Job_DateTime'])); ?></p></td>
                                                    <td>
                                                        <p><?php echo $GetSeeker['Seeker_Name']; ?></p>
                                                        <?php if( $Jobs['Apply_Job_Status'] == 'Accept' ) { ?>
                                                            <p><span class="accepted text-success">Accepted</span></p>
                                                        <?php } elseif( $Jobs['Apply_Job_Status'] == 'Reject' ) { ?>
                                                            <p><span class="rejected text-danger">Rejected</span></p>
                                                        <?php } else { ?>                                                            
                                                            <p>                                                                
                                                                <button type="submit" name="accept_job" class="acceptBtn btn btn-success btn-sm">
                                                                    <i class="fa fa-check"></i> Accept
                                                                </button>&nbsp;&nbsp;
                                                                <button type="submit" name="reject_job" class="rejectBtn btn btn-danger btn-sm">
                                                                    <i class="fa fa-times"></i> Reject
                                                                </button>
                                                            </p>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            </form>
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
                <div class="col-sm-12">
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>

<?php require_once(dirname(__FILE__) . '/templates/footer.php'); ?>