<?php
$url    = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$params = explode("/", $url);
?>

<nav class="side-navbar">
  <div class="sidebar-header d-flex align-items-center">
    <div class="avatar">
      <img src="http://localhost/jobseeker/admin/assets/img/admin.png" alt="JobSeeker Administrator" class="img-fluid rounded-circle">
    </div>
    <div class="title">
      <h1 class="h4">JobSeeker</h1>
      <p>Administrator</p>
    </div>
  </div>
  <ul class="list-unstyled">
    <li <?php if( $params[5] == "dashboard.php" ) { ?>class="active"<?php } ?>>
      <a href="http://localhost/jobseeker/admin/dashboard.php"><i class="icon-home"></i>Dashboard</a>
    </li>
    <li <?php if( $params[5] == "companies.php" ) { ?>class="active"<?php } ?>>
      <a href="http://localhost/jobseeker/admin/companies.php"><i class="icon-grid"></i>Companies </a>
    </li>
    <li <?php if( $params[5] == "seekers.php" ) { ?>class="active"<?php } ?>>
      <a href="http://localhost/jobseeker/admin/seekers.php"><i class="fa fa-bar-chart"></i>Seekers </a>
    </li>
    <li <?php if( $params[5] == "jobs.php" ) { ?>class="active"<?php } ?>>
      <a href="http://localhost/jobseeker/admin/jobs.php"><i class="icon-padnote"></i>Jobs </a>
    </li>
  </ul>
</nav>