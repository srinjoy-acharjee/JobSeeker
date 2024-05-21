<?php
require_once(dirname(__FILE__) . '/config/config.php');

if( !empty($_SESSION['CompanyLoggedIn']) ) {
    header("Location: http://localhost/jobseeker/CompanyDashboard.php");
    exit;
}

$allError = '';$succMSG = '';$emailError = '';$nameError = '';$passError = '';$cpassError = '';$addressError = '';$phoneError = '';$bioError = '';$emp_numError = '';$estd_onError= '';$websiteError = '';$photoError = '';

if( isset( $_POST['submit_company_register'] ) ) {
    $Characters         = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $UniqueID           = substr( str_shuffle( $Characters ), 0, 7 );
    $email              = addslashes($_POST['email']);
    $name               = addslashes($_POST['companyname']);
    $pass               = addslashes($_POST['pass']);
    $cpass              = addslashes($_POST['cpass']);
    $address            = addslashes($_POST['address']);
    $phone              = addslashes($_POST['phone']);
    $bio                = addslashes($_POST['bio']);
    $emp_num            = addslashes($_POST['emp_num']);
    $estd_on            = addslashes($_POST['estd_on']);
    $website            = addslashes($_POST['website']);
    $photo              = $_FILES['companyimage']['name'];
    $datetime           = date('Y-m-d H:i:s');

    if( $email == "" && $name == "" && $pass == "" && $cpass == "" && $address == "" && $phone == "" && $bio == "" && $emp_num == "" && $estd_on == "" && $website == "" && $photo == "" ) {
        $allError = 'All fields are required!';
        $emailError = 'Email address is required!';
        $nameError = 'Company Name is required!';
        $passError = 'Password is required!';
        $cpassError = 'Confirm Password is required!';
        $addressError = 'Company Address is required!';
        $phoneError = 'Enter Phone number!';
        $bioError = 'Enter Company Description!';
        $emp_numError = 'Enter Employee numbers!';
        $estd_onError = 'Enter Company Establishment year!';
        $websiteError = 'Enter your Company website!';
        $photoError = 'Select Company photo!';
    } elseif( $email == "" ) {
        $emailError = 'Email address is required!';
    } elseif( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        $emailError = 'Email address is not valid!';
    } elseif( $name == "" ) {
        $nameError = 'Company Name is required!';  
    } elseif( $pass == "" ) {
        $passError = 'Password is required!';
    } elseif( strlen($pass) < 6 ) {
        $passError = 'Password must be 6 characters long!';
    } elseif( $cpass == "" ) {
        $cpassError = 'Confirm Password is required!';
    } elseif( strlen($cpass) < 6 ) {
        $cpassError = 'Confirm Password must be 6 characters long!';
    } elseif( $pass != $cpass ) {
        $cpassError = 'Password and Confirm Password Missmatch!'; 
    } elseif( $address == "" ) {
        $addressError = 'Company Address is required!';
    } elseif( $phone == "" ) {
        $phoneError = 'Enter Phone number!';
    } elseif( $bio == "" ) {
        $bioError = 'Enter Company Description!';
    } elseif( $emp_num == "" ) {
        $emp_numError = 'Enter Employee numbers!';
    } elseif( $estd_on == "" ) {
        $estd_onError = 'Enter Company Establishment year!';
    } elseif( $website == "" ) {
        $websiteError = 'Enter your Company website!';
    } elseif( $photo == "" ) {
        $photoError = 'Select Company photo!';
    } else {
       $insertSQL = mysqli_query($db, "INSERT INTO `js_company`(`Company_Unique_ID`, `Company_Email`, `Company_Password`, `Company_Name`,`Company_Address`, `Company_Phone`, `Company_Bio`, `Company_Emp_Num`, `Company_Estd_On`, `Company_Website`, `Company_Photo`, `Company_Regd_On`) VALUES ('".$UniqueID."','".$email."','".sha1($pass)."','".$name."','".$address."','".$phone."','".$bio."',".$emp_num.",'".$estd_on."','".$website."','".$photo."','".$datetime."')");
        if( $insertSQL ) {
            if( !file_exists( dirname(__FILE__).'/uploads/company/'.$UniqueID) ) {
                /* Creating Directory */
                mkdir( dirname(__FILE__).'/uploads/company/'.$UniqueID );

                /* Uploading Photo */
                $photo_file  = dirname(__FILE__).'/uploads/company/'.$UniqueID.'/'.$photo;
                move_uploaded_file( $_FILES["companyimage"]["tmp_name"], $photo_file );

                /* Mail Function */
                $mail->setFrom('jobseeker.supp@gmail.com', 'JobSeeker');
                $mail->addReplyTo('jobseeker.supp@gmail.com', 'JobSeeker');
                $mail->addAddress($email, $name);
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
                              <span>Dear <strong>' . $name . '</strong>,<br /><br />You have joined JobSeeker as a <b>Company</b>.</span>
                            </font><br /><br />
                          </td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" style="padding:0 20px;">
                              <font color="#161616" size="2">
                                <span>Please login with the following credentials:</span>
                              </font><br /><br />
                            </td>
                          </tr>
                          <tr>
                            <td align="left" valign="top" style="padding-left:20px;">
                              <font color="#0e59ac" size="3">
                                <span>
                                  Username: <strong>' . $email . '</strong><br />
                                  Password: <strong>' . $pass . '</strong>
                                </span>
                              </font><br /><br />
                              <font color="#0e59ac" size="3">
                                To activate your account please <a href="http://localhost/jobseeker/CompanyLogin.php/?uid='.$UniqueID.'">Click Here</a>
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
                
                $mail->Subject = 'Welcome to JobSeeker';
                $mail->Body    = $message;

                if( !$mail->send() ) {
                    $allError = 'Oops! Mail not sent! Mailer Error: ' . $mail->ErrorInfo; 
                } else {
                    unset($_POST);
                    $succMSG = 'Registration successful! To active your account, check mail.';
                }
            }
        } else {
            $allError = 'Oops! Something went wrong. Please try again!';
        }
    }
}

$page_name = 'Company Registration';
require_once(dirname(__FILE__) . '/templates/header.php'); ?>

<body>

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- Body content -->
  
    <?php require_once(dirname(__FILE__) . '/templates/navbar.php'); ?>

    <div class="content-area">
        <div class="banner-area">
            <img src="http://localhost/jobseeker/assets/img/registration_banner.jpg" alt="Company Registration" />
        </div>
        <div class="container">
            <div class="row">                
                <h1 class="text-center">Company Registration</h1>
                <div class="row text-center">
                    <span class="error-text"><?php echo $allError; ?></span>
                    <span class="success-text"><?php echo $succMSG; ?></span>
                </div>
                <div class="col-sm-12">
                    <h6 class="pull-right error-text"><span>* </span>Required Fields</h6>
                </div>
                <form name="company_form_registration" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="col-sm-6">
                        <h3 class="text-center">Registration Details</h3>
                        <div class="form-group">
                            <label>Email Address :<span class="require">* </span> </label>
                            <input class="form-control" type="text" name="email" id="email" tabindex="1" placeholder="Enter Email Address" value="<?php echo (isset($_POST['email']) != "") ? $_POST['email'] : '';?>" />
                            <span class="error-text pull-right"><?php echo $emailError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Company Name :<span class="require">* </span> </label>
                            <input class="form-control" type="text" name="companyname" id="companyname" tabindex="2" placeholder="Enter Company Name" value="<?php echo (isset($_POST['companyname']) != "") ? $_POST['companyname'] : '';?>" />
                            <span class="error-text pull-right"><?php echo $nameError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Password :<span class="require">* </span> </label>
                            <input class="form-control" type="password" name="pass" id="pass" tabindex="3" placeholder="Enter Password" />
                            <span class="error-text pull-right"><?php echo $passError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Re-enter Password :<span class="require">* </span> </label>
                            <input class="form-control" type="password" name="cpass" id="cpass" tabindex="4" placeholder="Re-enter Password" />
                            <span class="error-text pull-right"><?php echo $cpassError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Address :<span class="require">* </span> </label>
                            <textarea class="form-control" name="address" id="address" tabindex="5" placeholder="Please Enter Your Current Address"><?php echo (isset($_POST['address']) != "") ? $_POST['address'] : '';?></textarea>
                            <span class="error-text pull-right"><?php echo $addressError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Phone :<span class="require">* </span> </label>
                            <input class="form-control" type="text" name="phone" id="phone" tabindex="7" placeholder="Please Enter Phone Number" value="<?php echo (isset($_POST['phone']) != "") ? $_POST['phone'] : '';?>" />
                            <span class="error-text pull-right"><?php echo $phoneError; ?></span>
                        </div> 
                    </div>
                    <div class="col-sm-6">
                        <h3 class="text-center">Company Details</h3>
                        <div class="form-group">
                            <label>Company Description :<span class="require">* </span> </label>
                            <textarea class="form-control" type="text" name="bio" id="bio" tabindex="7" placeholder="Please Enter Company Description"><?php echo (isset($_POST['bio']) != "") ? $_POST['bio'] : '';?></textarea>
                            <span class="error-text pull-right"><?php echo $bioError; ?></span>
                        </div>                        
                        <div class="form-group">
                            <label>Number of Employee :<span class="require">* </span> </label>
                            <input class="form-control" type="text" name="emp_num" id="emp_num" tabindex="10" placeholder="Enter Number of Employee" value="<?php echo (isset($_POST['emp_num']) != "") ? $_POST['emp_num'] : '';?>" />
                            <span class="error-text pull-right"><?php echo $emp_numError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Website : </label>
                            <input class="form-control" type="text" name="website" id="website" placeholder="Enter Website" tabindex="11" value="<?php echo (isset($_POST['website']) != "") ? $_POST['website'] : '';?>" />
                            <span class="error-text pull-right"><?php echo $websiteError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Established On: </label>
                            <input class="form-control" type="text" name="estd_on" id="estd_on" placeholder="Established On" value="<?php echo (isset($_POST['estd_on']) != "") ? $_POST['estd_on'] : '';?>" />
                            <span class="error-text pull-right"><?php echo $estd_onError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Company Image : </label>
                            <input class="form-control" type="file" size="30" name="companyimage" id="companyimage" tabindex="20" />
                            <span class="error-text pull-right"><?php echo $photoError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <input class="btn btn-success" type="submit" name="submit_company_register" id="submit_company_register" value="Submit" class="signup-bttn" tabindex="19" />
                            <input class="btn btn-default" type="reset" name="reset" id="reset" value="Reset" class="signup-bttn" tabindex="21" />
                        </div>
                        <div class="form-group">
                            Already registered? Then <a href="http://localhost/jobseeker/CompanyLogin.php">Login</a> from here.
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