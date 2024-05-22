<?php
require_once(dirname(dirname(dirname(__FILE__))) . "/config/config.php");

$case = isset($_REQUEST['case']) ? $_REQUEST['case'] : '';
switch ($case) {
	case 'AdminLoginProcess':
		AdminLoginProcess();
		break;
	default:
		echo '404 not found!';
		break;
}

function AdminLoginProcess() {
	global $db;
	
	$output   	 = array();
	$cookie_time = (3600 * 24 * 30);
    $username 	 = addslashes($_POST['adminUsername']);
    $password 	 = addslashes($_POST['adminPassword']);

	$AdminDetailsSql = mysqli_query($db, "SELECT * FROM `js_admin` WHERE `Admin_Email` = '".$username."' AND `Admin_Password` = '".sha1($password)."'");
	if( $AdminDetailsSql ) {
		if( mysqli_num_rows($AdminDetailsSql) > 0 ) {
			$AdminDetails = mysqli_fetch_assoc($AdminDetailsSql);
			$Admin = array(
	        	'Admin_ID'		=> $AdminDetails['Admin_ID'],
	            'Admin_Email'   => $AdminDetails['Admin_Email'],
	            'Admin_Name'    => $AdminDetails['Admin_Name']
	        );
			$_SESSION['AdminLoggedIn'] = $Admin;
			if ( isset($_POST['remember']) ) {
	            setcookie('__jsUn', $username, time() + $cookie_time, '/');
	            setcookie('__jsPs', $password, time() + $cookie_time, '/');
	        }
			$output['status'] = 1;
			$output['text']   = 'success';
		} else {
			$output['status'] = 0;
			$output['text']   = 'Invalid Username or Password!';
		}
	} else {
		$output['status'] = 0;
		$output['text']   = 'Server error! please try again later.';
	}
	echo json_encode($output);
}