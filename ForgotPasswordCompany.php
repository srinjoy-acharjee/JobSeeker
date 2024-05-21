<?php
require_once(dirname(__FILE__) . '/config/config.php');

if( !empty($_SESSION['CompanyLoggedIn']) ) {
    header("Location: http://localhost/jobseeker/CompanyDashboard.php");
    exit;
}

if( !empty($_SESSION['SeekerLoggedIn']) ) {
    header("Location: http://localhost/jobseeker/SeekerDashboard.php");
    exit;
}

$allError = '';$succMSG = '';$emailError = '';

if( isset($_POST['submit_company_forgot']) ) {
    $email = $_POST['email'];
    if( $email == "" ) {
        $emailError = 'Email Address is required!';
    } elseif( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        $emailError = 'Email address is not valid!';
    } else {
        $checkSQL = mysqli_query($db, "SELECT * FROM `js_company` WHERE `Company_Email` = '".$email."' LIMIT 0, 1");
        if( $checkSQL ) {
            if( mysqli_num_rows($checkSQL) > 0 ) {
                $seeker    = mysqli_fetch_assoc($checkSQL);
                $fullname  = $seeker['Company_Name'];
                $chars     = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $password  = substr( str_shuffle( $chars ), 0, 7 );
                $updateSQL = mysqli_query($db, "UPDATE `js_company` SET `Company_Password` = '".sha1($password)."' WHERE `Company_Email` = '".$email."'");
                $mail->setFrom('jobseeker.supp@gmail.com', 'JobSeeker');
                $mail->addReplyTo('jobseeker.supp@gmail.com', 'JobSeeker');
                $mail->addAddress($email, $fullname);
                $mail->isHTML(true);

                $message  = '
                <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid rgba(0, 0, 0, 0.15);font-family:Verdana,sans-serif;">
                  <tr>
                    <td>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="100" align="center">
                            <font color="#c31629" size="5">Password Reset Mail</font><br/><br/>
                          </td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" style="padding:0 20px;">
                            <font color="#161616" size="2">
                              <span>Dear <strong>' . $fullname . '</strong>,<br /><br />Your password has been reset successfully.</span>
                            </font><br /><br />
                          </td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" style="padding:0 20px;">
                              <font color="#161616" size="2">
                                <span>Here is the new Credential. Please login with the following credentials:</span>
                              </font><br /><br />
                            </td>
                          </tr>
                          <tr>
                            <td align="left" valign="top" style="padding-left:20px;">
                              <font color="#0e59ac" size="3">
                                <span>
                                  Username: <strong>' . $email . '</strong><br />
                                  Password: <strong>' . $password . '</strong>
                                </span>
                              </font><br /><br />
                              <font color="#161616" size="2">
                                <span>Please keep this information safe and secure.</span>
                              </font><br /><br />
                              <font color="#f000" size="2">
                                <span>Important! For security purpose, after you use the above password <br />to sign in to JobSeeker you should set a new password.</span>
                              </font><br /><br />
                              <font color="#000" size="2">
                                <span>We are here to help you!<br /><br />Thank you for choosing&nbsp;&nbsp;<a href="http://localhost/jobseeker/" style="color:#0e59ac; line-height:20px;">JobSeeker!</a><br /></span>
                              </font><br /><br />
                            </td>
                          </tr>
                        <tr>
                          <td align="left" valign="top" style="padding-left:20px;">
                            <font color="#000" size="2">
                              <span>Regards,<br />The <a href="http://localhost/jobseeker/" target="_blank" style="color:#0e59ac;line-height:20px;">JobSeeker</a> Team.</span>
                            </font><br /><br />
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>';

                $mail->Subject = 'Password Reset Success';
                $mail->Body    = $message;

                if( !$mail->send() ) {
                    $allError = 'Oops! Mail not sent! Mailer Error: ' . $mail->ErrorInfo; 
                } else {
                    unset($_POST);
                    $succMSG = 'Password Reset successful! To get new password, check mail.';
                }
            } else {
                $allError = 'No record found for this Email!';
            }
        } else {
            $allError = 'Oops! Something went wrong. Please try again.';
        }
    }
}

$page_name = 'Company Forgot Password';
require_once(dirname(__FILE__) . '/templates/header.php'); ?>

<body>

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- Body content -->
  
    <?php require_once(dirname(__FILE__) . '/templates/navbar.php'); ?>

    <div class="content-area">
        <div class="banner-area">
            <img src="http://localhost/jobseeker/assets/img/login_banner.jpg" alt="Company Forgot Password" />
        </div>
        <div class="container">
            <div class="row">
                <h1 class="text-center">Company Forgot Password</h1>
                <div class="row text-center">
                    <span class="error-text"><?php echo $allError; ?></span>
                    <span class="success-text"><?php echo $succMSG; ?></span>
                </div>
                <form action="" method="post">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Email: </label>
                            <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control" />
                            <span class="error-text pull-right"><?php echo $emailError; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit_company_forgot" id="submit_company_forgot" value="Reset" class="btn btn-success" />
                        </div>
                    </div>
                </form>
                <div class="col-sm-12">
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>

<?php require_once(dirname(__FILE__) . '/templates/footer.php'); ?>