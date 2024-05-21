<?php
require_once(dirname(__FILE__) . '/config/config.php');

if( !empty($_SESSION['SeekerLoggedIn']) ) {
    header("Location: http://localhost/jobseeker/SeekerDashboard.php");
    exit;
}

$allError = '';$succMSG = '';$emailError = '';$fullnameError = '';$passError = '';$cpassError = '';$addressError = '';$genderError = '';$phoneError = '';$educationError = '';$skillError = '';$experienceError = '';$bioError = '';$hobbyError = '';$photoError = '';$resumeError = '';

if( isset( $_POST['submit_seeker_register'] ) ) {
    $Characters         = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $UniqueID           = substr( str_shuffle( $Characters ), 0, 7 );
    $email              = addslashes($_POST['email']);
    $fullname           = addslashes($_POST['fullname']);
    $pass               = addslashes($_POST['pass']);
    $cpass              = addslashes($_POST['cpass']);
    $address            = addslashes($_POST['address']);
    $gender             = addslashes($_POST['gender']);
    $phone              = addslashes($_POST['phone']);
    $education          = addslashes($_POST['education']);
    $skill              = addslashes($_POST['skill']);
    $experience         = ($_POST['years'] * 12) + $_POST['months'];
    $bio                = addslashes($_POST['selfdescription']);
    $hobby              = addslashes($_POST['hobby']);
    $photo              = $_FILES['profileimage']['name'];
    $resume             = $_FILES['resume']['name'];
    $datetime           = date('Y-m-d H:i:s');

    if( $email == "" && $fullname == "" && $pass == "" && $cpass == "" && $address == "" && $phone == "" && $education == "" && $skill == "" && $experience == "" && $bio == "" && $hobby == "" && $photo == "" && $resume == "" ) {
        $allError = 'All fields are required!';
        $emailError = 'Email address is required!';
        $fullnameError = 'Fullname is required!';
        $passError = 'Password is required!';
        $cpassError = 'Confirm Password is required!';
        $addressError = 'Address is required!';
        $phoneError = 'Enter Phone number!';
        $educationError = 'Enter Education details!';
        $skillError = 'Enter Technical skills!';
        $experienceError = 'Select your work Experience!';
        $bioError = 'Enter your Biography!';
        $hobbyError = 'Enter your hobby!';
        $photoError = 'Select your photo!';
        $resumeError = 'Select your Resume!';
    } elseif( $email == "" ) {
        $emailError = 'Email address is required!';
    } elseif( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        $emailError = 'Email address is not valid!';
    } elseif( $fullname == "" ) {
        $fullnameError = 'Fullname is required!';  
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
        $addressError = 'Address is required!';
    } elseif( $gender == "" ) {
        $genderError = 'Select your Gender!';
    } elseif( $phone == "" ) {
        $phoneError = 'Enter Phone number!';
    } elseif( $education == "" ) {
        $educationError = 'Enter Education details!';
    } elseif( $skill == "" ) {
        $skillError = 'Enter Technical skills!';
    } elseif( $experience == "" ) {
        $experienceError = 'Select your work Experience!';
    } elseif( $bio == "" ) {
        $bioError = 'Enter your Biography!';
   } elseif( $hobby == "" ) {
        $hobbyError = 'Enter your hobby!';
    } elseif( $photo == "" ) {
        $photoError = 'Select your photo!';
    } elseif( $resume == "" ) {
        $resumeError = 'Select your Resume!';
    } else {
        $insertSQL = mysqli_query($db, "INSERT INTO `js_seeker`(`Seeker_Unique_ID`, `Seeker_Email`, `Seeker_Password`, `Seeker_Name`,`Seeker_Address`, `Seeker_Gender`, `Seeker_Phone`, `Seeker_Education`, `Seeker_Skill`, `Seeker_Experience`, `Seeker_Bio`, `Seeker_Hobby`, `Seeker_Photo`, `Seeker_CV`, `Seeker_Regd_On`) VALUES ('".$UniqueID."','".$email."','".sha1($pass)."','".$fullname."','".$address."','".$gender."','".$phone."','".$education."','".$skill."','".$experience."','".$bio."','".$hobby."','".$photo."','".$resume."','".$datetime."')");
        if( $insertSQL ) {
            if( !file_exists( dirname(__FILE__).'/uploads/seeker/'.$UniqueID) ) {
                /* Creating Directory */
                mkdir( dirname(__FILE__).'/uploads/seeker/'.$UniqueID );

                /* Uploading Photo */
                $photo_file  = dirname(__FILE__).'/uploads/seeker/'.$UniqueID.'/'.$photo;
                move_uploaded_file( $_FILES["profileimage"]["tmp_name"], $photo_file );

                /* Uploading Resume */
                $resume_file = dirname(__FILE__).'/uploads/seeker/'.$UniqueID.'/'.$resume;
                move_uploaded_file( $_FILES["resume"]["tmp_name"], $resume_file );

                /* Mail Function */
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
                            <font color="#c31629" size="5">Welcome to JobSeeker</font><br/><br/>
                            <font color="#5cb85c" size="2">
                              <span>Thank you for registering with us.</span>
                            </font><br /><br />
                          </td>
                        </tr>
                        <tr>
                          <td align="left" valign="top" style="padding:0 20px;">
                            <font color="#161616" size="2">
                              <span>Dear <strong>' . $fullname . '</strong>,<br /><br />You have joined JobSeeker as a <b>Job Seeker</b>.</span>
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
                                To activate your account please <a href="http://localhost/jobseeker/SeekerLogin.php/?uid='.$UniqueID.'">Click Here</a>
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

$page_name = 'Seeker Registration';
require_once(dirname(__FILE__) . '/templates/header.php'); ?>

<body>

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- Body content -->
  
    <?php require_once(dirname(__FILE__) . '/templates/navbar.php'); ?>

    <div class="content-area">
        <div class="banner-area">
            <img src="http://localhost/jobseeker/assets/img/registration_banner.jpg" alt="Seeker Registration" />
        </div>
        <div class="container">
            <div class="row">
                <h1 class="text-center">Seeker Registration</h1>
                <div class="row text-center">
                    <span class="error-text"><?php echo $allError; ?></span>
                    <span class="success-text"><?php echo $succMSG; ?></span>
                </div>
                <div class="col-sm-12">
                    <h6 class="pull-right error-text"><span>* </span>Required Fields</h6>
                </div>
                <form name="seeker_form_registration" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="col-sm-6">
                        <h3 class="text-center">Registration Details</h3>
                      	<div class="form-group">
                            <label>Email Address :<span class="require">* </span> </label>
                            <input class="form-control" type="text" name="email" id="email" tabindex="1" placeholder="Enter Email Address" value="<?php echo (isset($_POST['email']) != "") ? $_POST['email'] : '';?>" />
                            <span class="error-text pull-right"><?php echo $emailError; ?></span>
                      	</div>
                      	<div class="form-group">
                            <label>Full Name :<span class="require">* </span> </label>
                            <input class="form-control" type="text" name="fullname" id="fullname" tabindex="2" placeholder="Enter First Name" value="<?php echo (isset($_POST['fullname']) != "") ? $_POST['fullname'] : '';?>" />
                            <span class="error-text pull-right"><?php echo $fullnameError; ?></span>
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
                            <label>Self Description :<span class="require">* </span> </label>
                            <textarea class="form-control" name="selfdescription" id="selfdescription" tabindex="6" placeholder="Self Description"><?php echo (isset($_POST['selfdescription']) != "") ? $_POST['selfdescription'] : '';?></textarea>
                            <span class="error-text pull-right"><?php echo $bioError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Phone :<span class="require">* </span> </label>
                            <input class="form-control" type="text" name="phone" id="phone" tabindex="7" placeholder="Please Enter Phone Number" value="<?php echo (isset($_POST['phone']) != "") ? $_POST['phone'] : '';?>" />
                            <span class="error-text pull-right"><?php echo $phoneError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Gender : </label>
                            <div class="row">
                                <div class="col-sm-2">
                                    <input type="radio" name="gender" value="Male" id="male" class="gender" checked="checked" />&nbsp;&nbsp;Male
                                </div>
                                <div class="col-sm-3">
                                    <input type="radio" name="gender" value="Female" id="female" class="gender" />&nbsp;&nbsp;Female
                                </div>
                                <div class="col-sm-7">
                                    <input type="radio" name="gender" value="Other" id="other" class="gender" />&nbsp;&nbsp;Other
                                </div>
                            </div>
                            <span class="error-text pull-right"><?php echo $genderError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Profile Image : </label>
                            <input class="form-control" type="file" size="30" name="profileimage" id="profileimage" tabindex="20" />
                            <span class="error-text pull-right"><?php echo $photoError; ?></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h3 class="text-center">Professional Details</h3>
                        <div class="form-group">
                            <label>Total Experience : </label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <select class="form-control" name="years" id="years" tabindex="8">
                                        <option value="">~Select Year(s)~</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10+</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control" name="months" id="months" tabindex="9">
                                        <option value="">~Select Month(s)~</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                    </select>
                                </div>
                                <span class="error-text pull-right"><?php echo $experienceError; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Education :<span class="require">* </span> </label>
                            <input class="form-control" type="text" name="education" id="education" tabindex="10" placeholder="Enter Education" value="<?php echo (isset($_POST['education']) != "") ? $_POST['education'] : '';?>" />
                            <span class="error-text pull-right"><?php echo $educationError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Key Skills :<span class="require">* </span> </label>
                            <textarea class="form-control" id="skill" name="skill" tabindex="10" ><?php echo (isset($_POST['skill']) != "") ? $_POST['skill'] : '';?></textarea>
                            <span class="error-text pull-right"><?php echo $skillError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Hobby : </label>
                            <textarea class="form-control" name="hobby" id="hobby" tabindex="17"><?php echo (isset($_POST['email']) != "") ? $_POST['email'] : '';?></textarea>
                            <span class="error-text pull-right"><?php echo $hobbyError; ?></span>
                        </div>
                        <font>Have a Resume? Upoad it from here.</font>
                        <div class="form-group">
                            <label>Resume File : </label>
                            <input class="form-control" type="file" size="30" name="resume" id="resume" tabindex="19" />
                            <span class="error-text pull-right"><?php echo $resumeError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <input type="submit" name="submit_seeker_register" id="submit_seeker_register" value="Submit" class="btn btn-success" tabindex="19" />
                            <input type="reset" name="reset" id="reset" value="Reset" class="btn btn-default" tabindex="21" />
                        </div>
                        <div class="form-group">
                            Already registered? Then <a href="http://localhost/jobseeker/SeekerLogin.php">Login</a> from here.
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