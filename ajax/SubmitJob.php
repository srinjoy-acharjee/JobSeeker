<?php
require_once(dirname(dirname(__FILE__)) . '/config/config.php');

if( empty($_SESSION['SeekerLoggedIn']) ) {
	header("Location: http://localhost/jobseeker/SeekerLogin.php");
	exit;
}

$msg['msg'] = [];
if( isset($_POST['UniqueID']) ) {	
	$UniqueID  = $_POST['UniqueID'];
	$SeekerID  = $_SESSION['SeekerLoggedIn']['UserID'];
	$JobSQL    = mysqli_query($db, "SELECT * FROM `js_job` WHERE `Job_Unique_ID` = '".$UniqueID."' LIMIT 0, 1");
	$SeekerSQL = mysqli_query($db, "SELECT * FROM `js_seeker` WHERE `Seeker_ID` = '".$SeekerID."' LIMIT 0, 1"); 
	if( $JobSQL && $SeekerSQL ) {
		$Job     = mysqli_fetch_assoc($JobSQL);
		$Seeker  = mysqli_fetch_assoc($SeekerSQL);
		$AppySQL = mysqli_query($db, "INSERT INTO `js_apply`(`Apply_Job_ID`, `Apply_Company_ID`, `Apply_Seeker_ID`, `Apply_Job_Title`, `Apply_Job_Type`, `Apply_Job_Location`, `Apply_Job_Salary`, `Apply_Job_Image`, `Apply_Job_DateTime`) VALUES (".$Job['Job_ID'].", ".$Job['Job_Company_ID'].", ".$SeekerID.", '".$Job['Job_Title']."', '".$Job['Job_Type']."', '".$Job['Job_Location']."', ".$Job['Job_Salary'].", '".$Job['Job_Image']."', '".date('Y-m-d H:i:s')."')");
		if( $AppySQL ) {
			$msg['msg'] = 1;
		} else {
        	$msg['msg'] = 0;
        }
	} else{
		$msg['msg']  = 0;
	}	
} else {
	$msg['msg'] = 0;
}

echo json_encode($msg);