<?php
require_once(dirname(dirname(__FILE__)) . '/config/config.php');

if ( empty($_SESSION['AdminLoggedIn']) ) { 
    $helper->go(ADMIN_URL);
    exit(); 
}

$CompanySQL   = mysqli_query($db, "SELECT * FROM `js_company`");
$CompanyCount = mysqli_num_rows($CompanySQL);

$SeekerSQL    = mysqli_query($db, "SELECT * FROM `js_seeker`");
$SeekerCount  = mysqli_num_rows($SeekerSQL);

$JobSQL       = mysqli_query($db, "SELECT * FROM `js_job`");
$JobCount     = mysqli_num_rows($JobSQL);

$LatestJobSQL = mysqli_query($db, "SELECT * FROM `js_job` ORDER BY `Job_ID` DESC LIMIT 0, 5");

$ApplySQL     = mysqli_query($db, "SELECT * FROM `js_apply`");
$ApplyCount   = mysqli_num_rows($ApplySQL);

$page_name = 'Dashboard';
require_once(dirname(__FILE__) . '/templates/header.php'); ?>

  <body>
    <div class="page home-page">
      
      <?php require_once(dirname(__FILE__) . '/templates/navbar.php'); ?>

      <div class="page-content d-flex align-items-stretch">
        
        <?php require_once(dirname(__FILE__) . '/templates/sidebar.php'); ?>

        <div class="content-inner">
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom"><?php echo $page_name; ?></h2>
            </div>
          </header>

          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                    <div class="title"><span>Total<br>Companies</span>
                      <div class="progress">
                        <div role="progressbar" style="width:100%;height:4px;" aria-valuenow="{#val.value}" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo $CompanyCount; ?></strong></div>
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-red"><i class="icon-padnote"></i></div>
                    <div class="title"><span>Total<br>Seekers</span>
                      <div class="progress">
                        <div role="progressbar" style="width:100%;height:4px;" aria-valuenow="{#val.value}" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo $SeekerCount; ?></strong></div>
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-green"><i class="icon-bill"></i></div>
                    <div class="title"><span>Total<br>Jobs</span>
                      <div class="progress">
                        <div role="progressbar" style="width:100%;height:4px;" aria-valuenow="{#val.value}" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo $JobCount; ?></strong></div>
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-orange"><i class="icon-check"></i></div>
                    <div class="title"><span>Total<br>Applies</span>
                      <div class="progress">
                        <div role="progressbar" style="width:100%;height:4px;" aria-valuenow="{#val.value}" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo $ApplyCount; ?></strong></div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <!-- Projects Section-->
          <section class="projects">
            <div class="container-fluid">
              <?php while( $LatestJob = mysqli_fetch_assoc($LatestJobSQL) ) { ?>
                <div class="project">
                  <div class="row bg-white has-shadow">
                    <div class="left-col col-lg-3 d-flex align-items-center justify-content-between">
                      <div class="project-title d-flex align-items-center">
                        <div class="image has-shadow">
                          <img src="http://localhost/jobseeker/uploads/job/<?php echo $LatestJob['Job_Unique_ID']; ?>/<?php echo $LatestJob['Job_Image']; ?>" alt="<?php echo $LatestJob['Job_Title']; ?>" class="img-fluid" height="60" />
                        </div>
                        <div class="text">
                          <h3 class="h4"><?php echo $LatestJob['Job_Title']; ?></h3>
                          <small><?php echo $LatestJob['Job_Category']; ?></small><br>
                          <small><?php echo date('jS F, Y \a\t g:i A', strtotime($LatestJob['Job_Posted_On'])); ?></small>
                        </div>
                      </div>
                    </div>
                    <div class="right-col col-lg-9 d-flex align-items-center">
                      <small><?php echo $LatestJob['Job_Description']; ?></small>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </section>

<?php require_once(dirname(__FILE__) . '/templates/footer.php'); ?>