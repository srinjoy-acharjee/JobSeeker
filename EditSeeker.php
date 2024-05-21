<?php
require_once(dirname(__FILE__) . '/config/config.php');

if( empty($_SESSION['SeekerLoggedIn']) ) {
    header("Location: http://localhost/jobseeker/SeekerLogin.php");
    exit;
}

$SeekerSQL = mysqli_query($db, "SELECT * FROM `js_seeker` WHERE `Seeker_ID` = ".$_SESSION['SeekerLoggedIn']['UserID']." LIMIT 0, 1");
$Seeker    = mysqli_fetch_assoc($SeekerSQL);
$UniqueID  = $Seeker['Seeker_Unique_ID'];
$Exp       = $Seeker['Seeker_Experience'];
$ExpYear   = substr(round(($Exp / 12), 1), 0, 1);
$ExpMonth  = $Exp - ($ExpYear * 12);

$allError = '';$succMSG = '';$fullnameError = '';$addressError = '';$genderError = '';$phoneError = '';$educationError = '';$skillError = '';$experienceError = '';$bioError = '';$hobbyError = '';$photoError = '';$resumeError = '';

if( isset( $_POST['submit_seeker_update'] ) ) {
    $fullname           = addslashes($_POST['fullname']);
    $address            = addslashes($_POST['address']);
    $gender             = addslashes($_POST['gender']);
    $phone              = addslashes($_POST['phone']);
    $education          = addslashes($_POST['education']);
    $skill              = addslashes($_POST['skill']);
    $experience         = ($_POST['years'] * 12) + $_POST['months'];
    $bio                = addslashes($_POST['selfdescription']);
    $hobby              = addslashes($_POST['hobby']);
    $photo              = !empty($_FILES['profileimage']['name']) ? $_FILES['profileimage']['name'] : $_POST['oldPhoto'];
    $resume             = !empty($_FILES['resume']['name']) ? $_FILES['resume']['name'] : $_POST['oldCV'];
    $datetime           = date('Y-m-d H:i:s');

    if( $fullname == "" && $address == "" && $phone == "" && $education == "" && $skill == "" && $experience == "" && $bio == "" && $functional == "" && $hobby == "" && $photo == "" && $resume == "" ) {
        $allError = 'All fields are required!';        
        $fullnameError = 'Fullname is required!';        
        $addressError = 'Address is required!';
        $phoneError = 'Enter Phone number!';
        $educationError = 'Enter Education details!';
        $skillError = 'Enter Technical skills!';
        $experienceError = 'Select your work Experience!';
        $bioError = 'Enter your Biography!';
        $hobbyError = 'Enter your hobby!';
        $photoError = 'Select your photo!';
        $resumeError = 'Select your Resume!';
    } elseif( $fullname == "" ) {
        $fullnameError = 'Fullname is required!';  
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
        $updateSQL = mysqli_query($db, "UPDATE `js_seeker` SET `Seeker_Name` = '".$fullname."', `Seeker_Address` = '".$address."', `Seeker_Gender` = '".$gender."', `Seeker_Phone` = '".$phone."', `Seeker_Education` = '".$education."', `Seeker_Skill` = '".$skill."', `Seeker_Experience` = '".$experience."', `Seeker_Bio` = '".$bio."', `Seeker_Hobby` = '".$hobby."', `Seeker_Photo` = '".$photo."', `Seeker_CV` = '".$resume."' WHERE `Seeker_ID` = ".$_SESSION['SeekerLoggedIn']['UserID']);
        if( $updateSQL ) {
            if( isset($_FILES['profileimage']['name'] )) {
                /* Uploading Photo */
                $photo_file  = dirname(__FILE__).'/uploads/seeker/'.$UniqueID.'/'.$photo;
                move_uploaded_file( $_FILES["profileimage"]["tmp_name"], $photo_file );
            }
            if( isset($_FILES['resume']['name'] )) {
                /* Uploading Resume */
                $resume_file = dirname(__FILE__).'/uploads/seeker/'.$UniqueID.'/'.$resume;
                move_uploaded_file( $_FILES["resume"]["tmp_name"], $resume_file );
            }
            $succMSG = 'Profile updated successfully!';
            echo '<script>setTimeout(function() { window.location.href=window.location.href; }, 3000);</script>';
        } else {
            $allError = 'Oops! Something went wrong. Please try again!';
        }
    }
}

$page_name = 'Seeker Profile Update';
require_once(dirname(__FILE__) . '/templates/header.php'); ?>

<body>

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- Body content -->
  
    <?php require_once(dirname(__FILE__) . '/templates/navbar.php'); ?>

    <div class="content-area">
        <div class="banner-area">
            <img src="http://localhost/jobseeker/assets/img/edit-profile.jpg" alt="Seeker Profile Update" />
        </div>
        <div class="container">
            <div class="row">
                <h1 class="text-center">Seeker Profile Update</h1>
                <div class="row text-center">
                    <span class="error-text"><?php echo $allError; ?></span>
                    <span class="success-text"><?php echo $succMSG; ?></span>
                </div>
                <form name="seeker_form_update" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="col-sm-6">
                        <h3 class="text-center">Profile Details</h3>
                      	<div class="form-group">
                            <label>Full Name :<span class="require">* </span> </label>
                            <input class="form-control" type="text" name="fullname" id="fullname" tabindex="2" placeholder="Enter First Name" value="<?php echo $Seeker['Seeker_Name']; ?>" />
                            <span class="error-text pull-right"><?php echo $fullnameError; ?></span>
                      	</div>
                        <div class="form-group">
                            <label>Address :<span class="require">* </span> </label>
                            <textarea class="form-control" name="address" id="address" tabindex="5" placeholder="Please Enter Your Current Address"><?php echo $Seeker['Seeker_Address']; ?></textarea>
                            <span class="error-text pull-right"><?php echo $addressError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Self Description :<span class="require">* </span> </label>
                            <textarea class="form-control" name="selfdescription" id="selfdescription" tabindex="6" placeholder="Self Description"><?php echo $Seeker['Seeker_Bio']; ?></textarea>
                            <span class="error-text pull-right"><?php echo $bioError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Phone :<span class="require">* </span> </label>
                            <input class="form-control" type="text" name="phone" id="phone" tabindex="7" placeholder="Please Enter Phone Number" value="<?php echo $Seeker['Seeker_Phone']; ?>" />
                            <span class="error-text pull-right"><?php echo $phoneError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Gender : </label>
                            <div class="row">
                                <div class="col-sm-2">
                                    <input type="radio" name="gender" value="Male" id="male" class="gender" <?php echo ($Seeker['Seeker_Gender'] == 'Male' ? 'checked="checked"' : ''); ?> />&nbsp;&nbsp;Male
                                </div>
                                <div class="col-sm-3">
                                    <input type="radio" name="gender" value="Female" id="female" class="gender" <?php echo ($Seeker['Seeker_Gender'] == 'Female' ? 'checked="checked"' : ''); ?> />&nbsp;&nbsp;Female
                                </div>
                                <div class="col-sm-7">
                                    <input type="radio" name="gender" value="Other" id="other" class="gender" <?php echo ($Seeker['Seeker_Gender'] == 'Other' ? 'checked="checked"' : ''); ?> />&nbsp;&nbsp;Other
                                </div>
                            </div>
                            <span class="error-text pull-right"><?php echo $genderError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Profile Image : </label>
                            <input type="hidden" name="oldPhoto" id="oldPhoto" value="<?php echo $Seeker['Seeker_Photo']; ?>" />
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
                                        <option <?php echo ($ExpYear == "") ? "selected" : ""; ?> value="">~Select Year(s)~</option>
                                        <option <?php echo ($ExpYear == "1")  ? "selected" : "1"; ?> value="1">1</option>
                                        <option <?php echo ($ExpYear == "2")  ? "selected" : "2"; ?> value="2">2</option>
                                        <option <?php echo ($ExpYear == "3")  ? "selected" : "3"; ?> value="3">3</option>
                                        <option <?php echo ($ExpYear == "4")  ? "selected" : "4"; ?> value="4">4</option>
                                        <option <?php echo ($ExpYear == "5")  ? "selected" : "5"; ?> value="5">5</option>
                                        <option <?php echo ($ExpYear == "6")  ? "selected" : "6"; ?> value="6">6</option>
                                        <option <?php echo ($ExpYear == "7")  ? "selected" : "7"; ?> value="7">7</option>
                                        <option <?php echo ($ExpYear == "8")  ? "selected" : "8"; ?> value="8">8</option>
                                        <option <?php echo ($ExpYear == "9")  ? "selected" : "9"; ?> value="9">9</option>
                                        <option <?php echo ($ExpYear == "10")  ? "selected" : "10"; ?> value="10">10+</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control" name="months" id="months" tabindex="9">
                                        <option <?php echo ($ExpMonth == "") ? "selected" : ""; ?> value="">~Select Month(s)~</option>
                                        <option <?php echo ($ExpMonth == "1")  ? "selected" : "1"; ?> value="1">1</option>
                                        <option <?php echo ($ExpMonth == "2")  ? "selected" : "2"; ?> value="2">2</option>
                                        <option <?php echo ($ExpMonth == "3")  ? "selected" : "3"; ?> value="3">3</option>
                                        <option <?php echo ($ExpMonth == "4")  ? "selected" : "4"; ?> value="4">4</option>
                                        <option <?php echo ($ExpMonth == "5")  ? "selected" : "5"; ?> value="5">5</option>
                                        <option <?php echo ($ExpMonth == "6")  ? "selected" : "6"; ?> value="6">6</option>
                                        <option <?php echo ($ExpMonth == "7")  ? "selected" : "7"; ?> value="7">7</option>
                                        <option <?php echo ($ExpMonth == "8")  ? "selected" : "8"; ?> value="8">8</option>
                                        <option <?php echo ($ExpMonth == "9")  ? "selected" : "9"; ?> value="9">9</option>
                                        <option <?php echo ($ExpMonth == "10")  ? "selected" : "10"; ?> value="10">10</option>
                                        <option <?php echo ($ExpMonth == "11")  ? "selected" : "11"; ?> value="11">11</option>
                                    </select>
                                </div>
                                <span class="error-text pull-right"><?php echo $experienceError; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Education :<span class="require">* </span> </label>
                            <input class="form-control" type="text" name="education" id="education" tabindex="10" placeholder="Enter Education" value="<?php echo $Seeker['Seeker_Education']; ?>" />
                            <span class="error-text pull-right"><?php echo $educationError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Key Skills :<span class="require">* </span> </label>
                            <textarea class="form-control" id="skill" name="skill" tabindex="10" ><?php echo $Seeker['Seeker_Skill']; ?></textarea>
                            <span class="error-text pull-right"><?php echo $skillError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Hobby : </label>
                            <textarea class="form-control" name="hobby" id="hobby" tabindex="17"><?php echo $Seeker['Seeker_Hobby'];; ?></textarea>
                            <span class="error-text pull-right"><?php echo $hobbyError; ?></span>
                        </div>
                        <font>Want to Update Resume? Upoad it from here.</font>
                        <div class="form-group">
                            <label>Resume File : </label>
                            <input type="hidden" name="oldCV" id="oldCV" value="<?php echo $Seeker['Seeker_CV']; ?>" />
                            <input class="form-control" type="file" size="30" name="resume" id="resume" tabindex="19" />
                            <span class="error-text pull-right"><?php echo $resumeError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <input type="submit" name="submit_seeker_update" id="submit_seeker_update" value="Update" class="btn btn-success" tabindex="19" />
                            <input type="reset" name="reset" id="reset" value="Reset" class="btn btn-default" tabindex="21" />
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