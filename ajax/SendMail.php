<?php
require_once(dirname(dirname(__FILE__)) . '/config/config.php');

if( empty($_SESSION['SeekerLoggedIn']) ) {
	header("Location: http://localhost/jobseeker/SeekerLogin.php");
	exit;
}

if( empty($_SESSION['CompanyLoggedIn']) ) {
	header("Location: http://localhost/jobseeker/CompanyLogin.php");
	exit;
}

$html = [];
if(isset($_POST['sendmail'])) {
	$to 	  = $_POST['to'];
	$toname	  = $_POST['toname'];
	$from 	  = $_POST['from'];
	$fromname = $_POST['fromname'];
	$subject  = $_POST['subject'];
	$message  = $_POST['message'];

	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	$string_exp = "/^[A-Za-z\s.'-]+$/";

	if(!preg_match($email_exp, $to)) {
		$html['code'] = 1;
		$html['text'] = 'Invalid Email Address.';
	} elseif(!preg_match($string_exp, $toname)) {
		$html['code'] = 1;
		$html['text'] = 'Invalid Name.';
	} else {
	    $mail->setFrom('jobseeker.supp@gmail.com', 'JobSeeker');
	    $mail->addReplyTo('jobseeker.supp@gmail.com', 'JobSeeker');
	    $mail->addAddress($to, $toname);
	    $mail->isHTML(true);

	    $message  = '
	    <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid rgba(0, 0, 0, 0.15);font-family:Verdana,sans-serif;">
	      <tr>
	        <td>
	          <table width="100%" border="0" cellspacing="0" cellpadding="0">
	            <tr>
	              <td height="100" align="center">
	                <font color="#c31629" size="5">Welcome to JobSeeker</font><br/><br/>
	                <font color="#5cb85c" size="2">
	                  <span>Thank you for registering with us.</span>
	                </font><br /><br />
	              </td>
	            </tr>
	            <tr>
	              <td align="left" valign="top" style="padding:0 20px;">
	                <font color="#161616" size="2">
	                  <span>Dear <strong>' . $fromname . '</strong>,</span>
	                </font><br /><br />
	              </td>
	            </tr>
	            <tr>
	                <td align="left" valign="top" style="padding-left:20px;">                  
	                  <font color="#161616" size="2">
	                    <span>'.$message.'</span>
	                  </font><br /><br />
	                </td>
	            </tr>
	            <tr>
	              <td align="left" valign="top" style="padding-left:20px;">
	                <font color="#000" size="2">
	                  <span>Regards,<br />The <a href="http://localhost/jobseeker/" target="_blank" style="color:#0e59ac;line-height:20px;">'.$fromname.'</a></span>
	                </font><br /><br />
	              </td>
	            </tr>
	          </table>
	        </td>
	      </tr>
	    </table>';
	    
	    $mail->Subject = $subject;
	    $mail->Body    = $message;

	    if(!$mail->send()) {
	    	$html['code'] = 1;
	        $html['text'] = 'Oops! Mail not sent!'; 
	    } else {
	    	$html['code'] = 0;
	        $html['text'] = 'Mail successfully sent.';
	    }
	}
}

echo json_encode($html);