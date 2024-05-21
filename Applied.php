<?php
require_once(dirname(__FILE__) . '/config/config.php');

if( empty($_SESSION['SeekerLoggedIn']) ) {
    header("Location: http://localhost/jobseeker/SeekerLogin.php");
    exit;
}

$SeekerSQL = mysqli_query($db, "SELECT * FROM `js_seeker` WHERE `Seeker_ID` = ".$_SESSION['SeekerLoggedIn']['UserID']." LIMIT 0, 1");
$Seeker    = mysqli_fetch_assoc($SeekerSQL);

$perpage     = 5;
if( isset($_GET['page']) & !empty($_GET['page']) ) {
    $curpage = $_GET['page'];
} else {
    $curpage = 1;
}
$start        = ($curpage * $perpage) - $perpage;
$PageSQL      = mysqli_query($db, "SELECT * FROM `js_apply` WHERE `Apply_Seeker_ID` = ".$_SESSION['SeekerLoggedIn']['UserID']);
$totalres     = mysqli_num_rows($PageSQL);

$endpage      = ceil($totalres / $perpage);
$startpage    = 1;
$nextpage     = $curpage + 1;
$previouspage = $curpage - 1;

$JobsSQL      = mysqli_query($db, "SELECT * FROM `js_apply` WHERE `Apply_Seeker_ID` = ".$_SESSION['SeekerLoggedIn']['UserID']." LIMIT $start, $perpage");

$page_name = 'Applied Jobs';
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
                <h1 class="text-center">Applied Jobs</h1>
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
                                        ?>  
                                            <tr class="<?php echo (++$count%2 ? "odd" : "even"); ?> wow fadeInUp" data-wow-delay="1s">
                                                <td class="tbl-logo">
                                                    <img src="http://localhost/jobseeker/uploads/job/<?php echo $GetJob['Job_Unique_ID'].'/'.$Jobs['Apply_Job_Image']; ?>" alt="<?php echo $Jobs['Apply_Job_Title']; ?>" width="72" height="72" />
                                                </td>
                                                <td class="tbl-title">
                                                    <h4><?php echo $Jobs['Apply_Job_Title']; ?> <br>
                                                        <span class="job-type"><?php echo $Jobs['Apply_Job_Type']; ?></span>
                                                    </h4>
                                                </td>
                                                <td><p><?php echo $GetJob['Job_Category']; ?></p></td>
                                                <td><p><i class="icon-location"></i><?php echo $Jobs['Apply_Job_Location']; ?></p></td>
                                                <td><p>&#8377; <?php echo $Jobs['Apply_Job_Salary']; ?>/-</p></td>
                                                <td><p><?php echo date('jS F, Y', strtotime($Jobs['Apply_Job_DateTime'])); ?></p></td>
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
                <div class="col-sm-12">
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>

<?php require_once(dirname(__FILE__) . '/templates/footer.php'); ?>