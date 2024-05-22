<?php require(dirname(dirname(__FILE__)) . '/config/config.php');

unset($_SESSION['AdminLoggedIn']);

header('location:http://localhost/jobseeker/admin');