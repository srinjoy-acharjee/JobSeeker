<?php
require(dirname(__FILE__) . '/config/config.php');

if( !empty($_SESSION['SeekerLoggedIn']) ) {
	mysqli_query($db, "UPDATE `js_seeker` SET `Seeker_Last_Login` = '".date('Y-m-d H:i:s')."' WHERE `Seeker_ID` = ".$_SESSION['SeekerLoggedIn']['UserID']);
	unset($_SESSION['SeekerLoggedIn']);
	header('Location: http://localhost/jobseeker/SeekerLogin.php');
}

if( !empty($_SESSION['CompanyLoggedIn']) ) {
	mysqli_query($db, "UPDATE `js_company` SET `Company_Last_Login` = '".date('Y-m-d H:i:s')."' WHERE `Company_ID` = ".$_SESSION['CompanyLoggedIn']['UserID']);
	unset($_SESSION['CompanyLoggedIn']);
	header('Location: http://localhost/jobseeker/CompanyLogin.php');
}