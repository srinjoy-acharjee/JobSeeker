<?php
require_once(dirname(dirname(__FILE__)) . '/config/config.php');

if ( !empty($_SESSION['AdminLoggedIn']) ) {
    header('location:http://localhost/jobseeker/admin/dashboard.php'); 
    exit();
}

$page_name = 'Login';
require_once(dirname(__FILE__) . '/templates/header.php'); ?>

  <body>
    <div class="page login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>JobSeeker Admin</h1>
                  </div>
                  <p class="text-center">Administrate all information for JobSeeker.</p>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                  <form class="form-signin" name="admin-login" id="admin-login" method="post" action="http://localhost/jobseeker/admin/ajax/admin-ajax.php/?case=AdminLoginProcess">
                    <div class="form-group">
                      <input type="text" name="adminUsername" id="adminUsername" class="form-control" placeholder="Admin Username" required autofocus>
                    </div>
                    <div class="form-group">
                      <input type="password" name="adminPassword" id="adminPassword" class="form-control" placeholder="Admin Password" required>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
                  </form>
                  <a href="http://localhost/jobseeker/admin/forgot-password" class="forgot-pass">Forgot Password?</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="copyrights text-center">
        <p>
          JobSeeker &copy; <?php echo date('Y').'-'.date('Y', strtotime('+2 years')); ?> &nbsp;|&nbsp;
          Design by <a href="#" class="external">Priyanka Pramanik</a>
        </p>
      </div>
    </div>

    <!-- Javascript files-->
    <script src="http://localhost/jobseeker/admin/assets/js/jquery-3.2.1.min.js"></script>
    <script src="http://localhost/jobseeker/admin/assets/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="http://localhost/jobseeker/admin/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="http://localhost/jobseeker/admin/assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="http://localhost/jobseeker/admin/assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="http://localhost/jobseeker/admin/assets/js/Chart.min.js"></script>
    <script src="http://localhost/jobseeker/admin/assets/js/charts-home.js"></script>
    <script src="http://localhost/jobseeker/admin/assets/js/front.js"></script>
    <script type="text/javascript">var siteurl = "http://localhost/jobseeker/admin/";</script>
    <script type="text/javascript">var admin = "http://localhost/jobseeker/admin/";</script>
    <script type="text/javascript" src="http://localhost/jobseeker/admin/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="http://localhost/jobseeker/admin/assets/js/tether.min.js"></script>
    <script type="text/javascript" src="http://localhost/jobseeker/admin/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://localhost/jobseeker/admin/assets/js/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="http://localhost/jobseeker/admin/assets/js/bootstrapValidator.min.js"></script>
    <script type="text/javascript" src="http://localhost/jobseeker/admin/assets/js/functions.js"></script>
  </body>
</html>