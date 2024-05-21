<?php
require_once(dirname(__FILE__) . '/config/config.php');

if( empty($_SESSION['CompanyLoggedIn']) ) {
    header("Location: http://localhost/jobseeker/CompanyLogin.php");
    exit;
}

$CompanySQL = mysqli_query($db, "SELECT * FROM `js_company` WHERE `Company_ID` = ".$_SESSION['CompanyLoggedIn']['UserID']." LIMIT 0, 1");
$Company    = mysqli_fetch_assoc($CompanySQL);
$UniqueID   = $Company['Company_Unique_ID'];

$allError = '';$succMSG = '';$nameError = '';$addressError = '';$phoneError = '';$bioError = '';$emp_numError = '';$estd_onError = '';$websiteError = '';$photoError = '';

if( isset( $_POST['submit_company_update'] ) ) {    
    $name               = addslashes($_POST['companyname']);
    $address            = addslashes($_POST['address']);
    $phone              = addslashes($_POST['phone']);
    $bio                = addslashes($_POST['bio']);
    $emp_num            = addslashes($_POST['emp_num']);
    $estd_on            = addslashes($_POST['estd_on']);
    $website            = addslashes($_POST['website']);
    $photo              = !empty($_FILES['companyimage']['name']) ? $_FILES['companyimage']['name'] : $_POST['oldPhoto'];

    if( $name == "" && $address == "" && $phone == "" && $bio == "" && $emp_num == "" && $estd_on == "" && $website == "" && $photo == "" ) {
        $allError = 'All fields are required!';
        $nameError = 'Company Name is required!';
        $addressError = 'Company Address is required!';
        $phoneError = 'Enter Phone number!';
        $bioError = 'Enter Company Description!';
        $emp_numError = 'Enter Employee numbers!';
        $estd_onError = 'Enter Company Establishment year!';
        $websiteError = 'Enter your Company website!';
        $photoError = 'Select Company photo!';
    } elseif( $name == "" ) {
        $nameError = 'Company Name is required!';  
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
       $updateSQL = mysqli_query($db, "UPDATE `js_company` SET `Company_Name` = '".$name."', `Company_Address` = '".$address."', `Company_Phone` = '".$phone."', `Company_Bio` = '".$bio."', `Company_Emp_Num` = ".$emp_num.", `Company_Estd_On` = '".$estd_on."', `Company_Website` = '".$website."', `Company_Photo` = '".$photo."' WHERE `Company_ID` = ".$_SESSION['CompanyLoggedIn']['UserID']);
        if( $updateSQL ) {
            if( isset($_FILES['companyimage']['name']) ) {
                $photo_file = dirname(__FILE__).'/uploads/company/'.$UniqueID.'/'.$photo;
                $uploadFile = move_uploaded_file( $_FILES["companyimage"]["tmp_name"], $photo_file );
            }
            $succMSG = 'Profile updated successfully!';
            echo '<script>setTimeout(function() { window.location.href=window.location.href; }, 3000);</script>';
        } else {
            $allError = 'Oops! Something went wrong. Please try again!';
        }
    }
}

$page_name = 'Company Profile Update';
require_once(dirname(__FILE__) . '/templates/header.php'); ?>

<body>

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- Body content -->
  
    <?php require_once(dirname(__FILE__) . '/templates/navbar.php'); ?>

    <div class="content-area">
        <div class="banner-area">
            <img src="http://localhost/jobseeker/assets/img/edit-profile.jpg" alt="Company Profile Update" />
        </div>
        <div class="container">
            <div class="row">                
                <h1 class="text-center">Company Profile Update</h1>
                <div class="row text-center">
                    <span class="error-text"><?php echo $allError; ?></span>
                    <span class="success-text"><?php echo $succMSG; ?></span>
                </div>
                <form name="company_form_update" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="col-sm-6">
                        <h3 class="text-center">Profile Details</h3>
                        <div class="form-group">
                            <label>Company Name :<span class="require">* </span> </label>
                            <input class="form-control" type="text" name="companyname" id="companyname" tabindex="2" placeholder="Enter Company Name" value="<?php echo $Company['Company_Name']; ?>" />
                            <span class="error-text pull-right"><?php echo $nameError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Address :<span class="require">* </span> </label>
                            <textarea class="form-control" name="address" id="address" tabindex="5" placeholder="Please Enter Your Current Address"><?php echo $Company['Company_Address']; ?></textarea>
                            <span class="error-text pull-right"><?php echo $addressError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Phone :<span class="require">* </span> </label>
                            <input class="form-control" type="text" name="phone" id="phone" tabindex="7" placeholder="Please Enter Phone Number" value="<?php echo $Company['Company_Phone']; ?>" />
                            <span class="error-text pull-right"><?php echo $phoneError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Company Description :<span class="require">* </span> </label>
                            <textarea class="form-control" type="text" name="bio" id="bio" tabindex="7" placeholder="Please Enter Company Description"><?php echo $Company['Company_Bio']; ?></textarea>
                            <span class="error-text pull-right"><?php echo $bioError; ?></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h3 class="text-center">Company Details</h3>                                                
                        <div class="form-group">
                            <label>Number of Employee :<span class="require">* </span> </label>
                            <input class="form-control" type="text" name="emp_num" id="emp_num" tabindex="10" placeholder="Enter Number of Employee" value="<?php echo $Company['Company_Emp_Num']; ?>" />
                            <span class="error-text pull-right"><?php echo $emp_numError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Website : </label>
                            <input class="form-control" type="text" name="website" id="website" placeholder="Enter Website" tabindex="11" value="<?php echo $Company['Company_Website']; ?>" />
                            <span class="error-text pull-right"><?php echo $websiteError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Established On: </label>
                            <input class="form-control" type="text" name="estd_on" id="estd_on" placeholder="Established On" value="<?php echo $Company['Company_Estd_On']; ?>" />
                            <span class="error-text pull-right"><?php echo $estd_onError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Company Image : </label>
                            <input type="hidden" name="oldPhoto" id="oldPhoto" value="<?php echo $Company['Company_Photo']; ?>" />
                            <input class="form-control" type="file" size="30" name="companyimage" id="companyimage" tabindex="20" />
                            <span class="error-text pull-right"><?php echo $photoError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <input class="btn btn-success" type="submit" name="submit_company_update" id="submit_company_update" value="Update" class="signup-bttn" tabindex="19" />
                            <input class="btn btn-default" type="reset" name="reset" id="reset" value="Reset" class="signup-bttn" tabindex="21" />
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