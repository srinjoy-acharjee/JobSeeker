<?php
require_once(dirname(dirname(__FILE__)) . '/config/config.php');

if( empty($_SESSION['SeekerLoggedIn']) ) {
	header("Location: http://localhost/jobseeker/SeekerLogin.php");
	exit;
}

$html = [];
if( isset($_POST['UniqueID']) ) {
	$UniqueID = $_POST['UniqueID'];
	$SeekerID = $_SESSION['SeekerLoggedIn']['UserID'];
	$JobSQL   = mysqli_query($db, "SELECT * FROM `js_job` WHERE `Job_Unique_ID` = '".$UniqueID."' LIMIT 0, 1");
	if( $JobSQL ) {
		$Job  = mysqli_fetch_assoc($JobSQL);
		$CheckSQL = mysqli_query($db, "SELECT * FROM `js_apply` WHERE `Apply_Job_ID` = ".$Job['Job_ID']." AND `Apply_Seeker_ID` = ".$SeekerID);
		if( mysqli_num_rows($CheckSQL) > 0 ) {
			$html['msg'] = 1;
		} else {
			$html['msg'] = 0;
		}
		$html['html'] = '<div class="row">';
            $html['html'] .= '<div>';
                $html['html'] .= '<div class="col-sm-2">';
                    $html['html'] .= '<img src="http://localhost/jobseeker/uploads/job/'.$Job['Job_Unique_ID'].'/'.$Job['Job_Image'].'" alt="'.$Job['Job_Title'].'" width="72" height="72" />';
                $html['html'] .= '</div>';
                $html['html'] .= '<div class="col-sm-5">';
	                $html['html'] .= '<div class="tbl-title">';
	                    $html['html'] .= '<h4>'.$Job['Job_Title'].'</h4>';
	                    $html['html'] .= '<span class="job-type">'.$Job['Job_Type'].'</span>';
	                $html['html'] .= '</div>';
	            $html['html'] .= '</div>';
	            $html['html'] .= '<div class="col-sm-5">';
	                $html['html'] .= '<div style="margin-left:-5px;"><p><i class="icon-location"></i>'.$Job['Job_Location'].'</p></div>';
	                $html['html'] .= '<div><p>&#8377; '.$Job['Job_Salary'].'/-</p></div>';
	                $html['html'] .= '<div><p>'.date('jS F, Y', strtotime($Job['Job_Posted_On'])).'</p></div>';
	            $html['html'] .= '</div>';
            $html['html'] .= '</div>';
        $html['html'] .= '</div>';

        $html['jobID'] = $UniqueID;
	} else{
		$html['html']  = '<p>No job details found</p>';
		$html['jobID'] = '';
	}	
} else {
	$html['html']  = '<p>Oops! Something went wrong.</p>';
	$html['jobID'] = '';
}

echo json_encode($html);