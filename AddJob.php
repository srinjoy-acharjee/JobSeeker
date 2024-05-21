<?php
require_once(dirname(__FILE__) . '/config/config.php');

if( empty($_SESSION['CompanyLoggedIn']) ) {
    header("Location: http://localhost/job/AddJob.php");
    exit;
}

$allError = '';$succMSG = '';$jobtitleError = '';$descriptionError = '';$categoryError = '';$jobtypeError = '';$locationError = '';$educationskillError = '';$technicalskillError = '';$salaryError = '';$postrequireError = '';$imageError = '';

if( isset( $_POST['submit_job'] ) ) {
    $Characters              = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $UniqueID                = substr( str_shuffle( $Characters ), 0, 7 );
    $companyid               = $_SESSION['CompanyLoggedIn']['UserID'];
    $jobtitle                = addslashes($_POST['jobtitle']);
    $description             = addslashes($_POST['description']);
    $category                = addslashes($_POST['category']);
    $jobtype                 = addslashes($_POST['jobtype']);
    $location                = addslashes($_POST['location']);
    $educationskill          = addslashes($_POST['educationskill']);
    $technicalskill          = addslashes($_POST['technicalskill']);
    $salary                  = addslashes($_POST['salary']);
    $postrequire            = addslashes($_POST['postrequire']);
    $image                   = $_FILES['image']['name'];
    $datetime                = date('Y-m-d H:i:s');

    if( $jobtitle == "" && $description == "" && $category == ""&& $jobtype == "" && $location == "" && $educationskill == "" && $technicalskill == "" && $salary == "" && $postrequire == "" && $image == "" ) {
        $allError            = 'All fields are required!';
        $jobtitleError       = 'Please enter suitable Job Title!';
        $descriptionError    = 'Please enter suitable Job Description!';
        $categoryError       = 'Select Category for Job!';
        $jobtypeError        = 'Select Type for Job!';
        $locationError       = 'Select Location for Job!';
        $educationskillError = 'Enter Education Skills!';
        $technicalskillError = 'Enter Technical Skills!';
        $salaryError         = 'Enter Salary for the Job!';
        $postrequireError    = 'Enter number of Posts Require!';
        $imageError          = 'Select Job image!';
    } elseif( $jobtitle == "" ) {
        $jobtitleError = 'Please enter suitable Job Title!';
    } elseif( $description == "" ) {
        $descriptionError = 'Please enter suitable Job Description!';
    } elseif( $category == "" ){
        $categoryError = 'Select Category for Job!';
    } elseif( $jobtype == "" ) {
        $jobtypeError = 'Select Type for Job!';
    } elseif( $location == "" ) {
        $locationError = 'Select Location for Job!';
    } elseif( $educationskill == "" ) {
        $educationskillError = 'Enter Education Skills!';
    } elseif( $technicalskill == "" ) {
        $technicalskillError = 'Enter Technical Skills!';
    } elseif( $salary == "" ) {
        $salaryError = 'Enter Salary for the Job!';
    } elseif( !is_numeric($salary) ) {
        $salaryError = 'Salary should be in numbers!';
    } elseif( $postrequire == "" ) {
        $postrequireError = 'Enter number of Posts Require!';
    } elseif( !is_numeric($postrequire) ) {
        $postrequireError = 'Post require should be in numbers!';
    } elseif( $postrequire >= 1000 ) {
        $postrequireError = 'Numbers not more than 1000!';   
    } elseif( $image == "" ) {
        $imageError = 'Select Job image!';
    } else {
        $insertSQL = mysqli_query($db, "INSERT INTO `js_job`(`Job_Unique_ID`, `Job_Company_ID`, `Job_title`, `Job_Description`, `Job_Category`, `Job_Type`, `Job_Location`, `Job_Education_Skill`, `Job_Technical_Skill`, `Job_Salary`, `Job_Post_Require`, `Job_Image`, `Job_Posted_On`) VALUES ('".$UniqueID."',".$companyid.",'".$jobtitle."','".$description."','".$category."','".$jobtype."','".$location."','".$educationskill."','".$technicalskill."',".$salary.",".$postrequire.",'".$image."','".$datetime."')");
        if( $insertSQL ) {
            if( !file_exists( dirname(__FILE__).'/uploads/job/'.$UniqueID) ) {
                /* Creating Directory */
                mkdir( dirname(__FILE__).'/uploads/job/'.$UniqueID );

                /* Uploading image */
                $image_file  = dirname(__FILE__).'/uploads/job/'.$UniqueID.'/'.$image;
                move_uploaded_file( $_FILES["image"]["tmp_name"], $image_file );

                unset($_POST);
                $succMSG = 'Job Posted successfully!';
            } else {
                $allError = 'Oops! Job could not be posted. Please try again!'; 
            }
        } else {
            $allError = 'Oops! Something went wrong. Please try again!';
        }
    }
}

$page_name = 'Add Job';
require_once(dirname(__FILE__) . '/templates/header.php'); ?>

<body>

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- Body content -->
  
    <?php require_once(dirname(__FILE__) . '/templates/navbar.php'); ?>

    <div class="content-area">
        <div class="banner-area">
            <img src="http://localhost/jobseeker/assets/img/addjob_banner.jpg" alt="Add Job" />
        </div>
        <div class="container">
            <div class="row">
                <h1 class="text-center">Add New Job</h1>
                <div class="row text-center">
                    <span class="error-text"><?php echo $allError; ?></span>
                    <span class="success-text"><?php echo $succMSG; ?></span>
                </div>
                <div class="col-sm-12">
                    <h6 class="pull-right error-text"><span>* </span>Required Fields</h6>
                </div>
                <form name="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="col-sm-6">
                        <h3 class="text-center">Job Details</h3>
                        <div class="form-group">
                            <label>Job Title: <span class="require">* </span> </label>
                            <input class="form-control" type="text" name="jobtitle" id="jobtitle" tabindex="1" placeholder="Enter Job Title" value="<?php echo (isset($_POST['jobtitle']) != "") ? $_POST['jobtitle'] : '';?>"/>
                            <span class="error-text pull-right"><?php echo $jobtitleError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Job Description: <span class="require">* </span> </label>
                            <textarea class="form-control" name="description" id="description" tabindex="5" placeholder="Please Enter Job Description"><?php echo (isset($_POST['description']) != "") ? $_POST['description'] : '';?></textarea>
                            <span class="error-text pull-right"><?php echo $descriptionError; ?></span>
                        </div>                        
                        <div class="form-group">
                            <label>Job Category: <span class="require">* </span> </label>
                            <select class="form-control" name="category" id="category">
                                <option value="">~Select Job Category~</option>
                                <option value="Accounting">Accounting</option>
                                <option value="General Business">General Business</option>                                
                                <option value="Admin & Clerical">Admin & Clerical</option>
                                <option value="General Labor">General Labor</option>
                                <option value="Pharmaceutical">Pharmaceutical</option>
                                <option value="Automotive">Automotive</option>
                                <option value="Government">Government</option>
                                <option value="Professional Services">Professional Services</option>
                                <option value="Banking">Banking</option>
                                <option value="Grocery">Grocery</option>
                                <option value="Purchasing">Purchasing </option>
                                <option value="Procurement">Procurement</option>
                                <option value="Biotech">Biotech</option>
                                <option value="Health Care">Health Care</option>
                                <option value="QA">QA</option>
                                <option value="Quality Control">Quality Control</option>
                                <option value="Broadcast">Broadcast</option>
                                <option value="Journalism">Journalism</option>
                                <option value="Hotel">Hotel</option>
                                <option value="Hospitality">Hospitality</option>
                                <option value="Real Estate">Real Estate</option>
                                <option value="Business Development">Business Development</option>
                                <option value="Human Resources">Human Resources</option>
                                <option value="Research">Research</option>
                                <option value="Construction">Construction</option>
                                <option value="Information Technology">Information Technology</option>
                                <option value="Restaurant">Restaurant</option>
                                <option value="Food Service">Food Service</option>
                                <option value="Consultant">Consultant</option>
                                <option value="Installation">Installation</option>
                                <option value="Maint">Maint</option>
                                <option value="Repair">Repair</option>
                                <option value="Retail">Retail</option>
                                <option value="Customer Service">Customer Service</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Sales">Sales</option>
                                <option value="Design">Design</option>
                                <option value="Inventory">Inventory</option>
                                <option value="Science">Science</option>
                                <option value="Distribution">Distribution</option>
                                <option value="Shipping">Shipping</option>
                                <option value="Legal">Legal</option>
                                <option value="Skilled Labor">Skilled Labor</option>
                                <option value="Trades">Trades</option>
                                <option value="Education">Education</option>
                                <option value="Teaching">Teaching</option>
                                <option value="Legal Admin">Legal Admin</option>
                                <option value="Strategy">Strategy</option>
                                <option value="Planning">Planning</option>
                                <option value="Engineering">Engineering</option>
                                <option value="Management">Management</option>
                                <option value="Supply Chain">Supply Chain</option>
                                <option value="Entry Level">Entry Level</option>
                                <option value="New Grad">New Grad</option>
                                <option value="Manufacturing">Manufacturing</option>
                                <option value="Telecommunications">Telecommunications</option>
                                <option value="Executive">Executive</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Training">Training</option>
                                <option value="Facilities">Facilities</option>
                                <option value="Media">Media</option>
                                <option value="Journalism">Journalism</option>
                                <option value="Newspaper">Newspaper</option>
                                <option value="Transportation">Transportation</option>
                                <option value="Finance">Finance</option>
                                <option value="Nonprofit">Nonprofit</option>
                                <option value="Social Services">Social Services</option>
                                <option value="Warehouse">Warehouse</option>
                                <option value="Franchise">Franchise</option>
                                <option value="Nurse">Nurse</option>
                                <option value="Other">Other</option>
                            </select>
                            <span class="error-text pull-right"><?php echo $categoryError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Job Type: <span class="require">* </span> </label>
                            <select class="form-control" name="jobtype" id="jobtype">
                                <option value="">~Select Job Type~</option>
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                            </select>
                            <span class="error-text pull-right"><?php echo $jobtypeError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Job Location: <span class="require">* </span> </label>
                            <select class="form-control" name="location" id="location">
                                <option value="">-Select Job Location-</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Top Metropolitan Cities-</i>
                                </option>
                                <option value="Ahmedabad">Ahmedabad</option> 
                                <option value="Bengaluru/Bangalore">Bengaluru/Bangalore</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Chennai">Chennai</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Gurgaon">Gurgaon</option>
                                <option value="Hyderabad/Secunderabad">Hyderabad/Secunderabad</option>
                                <option value="Kolkata">Kolkata</option>
                                <option value="Mumbai">Mumbai</option>
                                <option value="Noida">Noida</option>
                                <option value="Pune">Pune</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Andhra Pradesh-</i>
                                </option>
                                <option value="Anantapur">Anantapur</option>
                                <option value="Guntakal">Guntakal</option>
                                <option value="Guntur">Guntur</option>
                                <option value="Hyderabad/Secunderabad">Hyderabad/Secunderabad</option>
                                <option value="kakinada">kakinada</option>
                                <option value="kurnool">kurnool</option>
                                <option value="Nellore">Nellore</option>
                                <option value="Nizamabad">Nizamabad</option>
                                <option value="Rajahmundry">Rajahmundry</option>
                                <option value="Tirupati">Tirupati</option>
                                <option value="Vijayawada">Vijayawada</option>
                                <option value="Visakhapatnam">Visakhapatnam</option>
                                <option value="Warangal">Warangal</option>
                                <option value="Andra Pradesh-Other">Andra Pradesh-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Arunachal Pradesh-</i>
                                </option>
                                <option value="Itanagar">Itanagar</option>
                                <option value="Arunachal Pradesh-Other">Arunachal Pradesh-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Assam-</i>
                                </option>
                                <option value="Guwahati">Guwahati</option>
                                <option value="Silchar">Silchar</option>
                                <option value="Assam-Other">Assam-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Bihar-</i>
                                </option>
                                <option value="Bhagalpur">Bhagalpur</option>
                                <option value="Patna">Patna</option>
                                <option value="Bihar-Other">Bihar-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Chhattisgarh-</i>
                                </option>
                                <option value="Bhillai">Bhillai</option>
                                <option value="Bilaspur">Bilaspur</option>
                                <option value="Raipur">Raipur</option>
                                <option value="Chhattisgarh-Other">Chhattisgarh-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Goa-</i>
                                </option>
                                <option value="Panjim/Panaji">Panjim/Panaji</option>
                                <option value="Vasco Da Gama">Vasco Da Gama</option>
                                <option value="Goa-Other">Goa-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Gujarat-</i>
                                </option>
                                <option value="Ahmedabad">Ahmedabad</option>
                                <option value="Anand">Anand</option>
                                <option value="Ankleshwar">Ankleshwar</option>
                                <option value="Bharuch">Bharuch</option>
                                <option value="Bhavnagar">Bhavnagar</option>
                                <option value="Bhuj">Bhuj</option>
                                <option value="Gandhinagar">Gandhinagar</option>
                                <option value="Gir">Gir</option>
                                <option value="Jamnagar">Jamnagar</option>
                                <option value="Kandla">Kandla</option>
                                <option value="Porbandar">Porbandar</option>
                                <option value="Rajkot">Rajkot</option>
                                <option value="Surat">Surat</option>
                                <option value="Vadodara/Baroda">Vadodara/Baroda</option>
                                <option value="Valsad">Valsad</option>
                                <option value="Vapi">Vapi</option>
                                <option value="Gujarat-Other">Gujarat-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Haryana-</i>
                                </option>
                                <option value="Ambala">Ambala</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Faridabad">Faridabad</option>
                                <option value="Gurgaon">Gurgaon</option>
                                <option value="Hisar">Hisar</option>
                                <option value="Karnal">Karnal</option>
                                <option value="Kurukshetra">Kurukshetra</option>
                                <option value="Panipat">Panipat</option>
                                <option value="Rohtak">Rohtak</option>
                                <option value="Haryana-Other">Haryana-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Himachal Pradesh-</i>
                                </option>
                                <option value="Dalhousie">Dalhousie</option>
                                <option value="Dharmasala">Dharmasala</option>
                                <option value="Kulu/Manali">Kulu/Manali</option>
                                <option value="Shimla">Shimla</option>
                                <option value="Himachal Pradesh-Other">Himachal Pradesh-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Jammu and Kashmir-</i>
                                </option>
                                <option value="Jammu">Jammu</option>
                                <option value="Srinagar">Srinagar</option>
                                <option value="Jammu and Kashmir-Other">Jammu and Kashmir-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Jharkhand-</i>
                                </option>
                                <option value="Bokaro">Bokaro</option>
                                <option value="Dhanbad">Dhanbad</option>
                                <option value="Jamshedpur">Jamshedpur</option>
                                <option value="Ranchi">Ranchi</option>
                                <option value="Jharkhand-Other">Jharkhand-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Karnataka-</i>
                                </option>
                                <option value="Bengaluru/Bangalore">Bengaluru/Bangalore</option>
                                <option value="Belgaum">Belgaum</option>
                                <option value="Bellary">Bellary</option>
                                <option value="Bidar">Bidar</option>
                                <option value="Dharwad">Dharwad</option>
                                <option value="Gulbarga">Gulbarga</option>
                                <option value="Hubli">Hubli</option>
                                <option value="Kolar">Kolar</option>
                                <option value="Mangalore">Mangalore</option>
                                <option value="Mysoru/Mysore">Mysoru/Mysore</option>
                                <option value="Karnataka-Other">Karnataka-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Kerala-</i>
                                </option>
                                <option value="Calicut">Calicut</option>
                                <option value="Cochin">Cochin</option>
                                <option value="Ernakulam">Ernakulam</option>
                                <option value="Kannur">Kannur</option>
                                <option value="Kochi">Kochi</option>
                                <option value="Kollam">Kollam</option>
                                <option value="Kottayam">Kottayam</option>
                                <option value="Kozhikode">Kozhikode</option>
                                <option value="Palakkad">Palakkad</option>
                                <option value="Palghat">Palghat</option>
                                <option value="Thrissur">Thrissur</option>
                                <option value="Trivandrum">Trivandrum</option>
                                <option value="Kerela-Other">Kerela-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Madhya Pradesh-</i>
                                </option>
                                <option value="Bhopal">Bhopal</option>
                                <option value="Gwalior">Gwalior</option>
                                <option value="Indore">Indore</option>
                                <option value="Jabalpur">Jabalpur</option>
                                <option value="Ujjain">Ujjain</option>
                                <option value="Madhya Pradesh-Other">Madhya Pradesh-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Maharashtra-</i>
                                </option>
                                <option value="Ahmednagar">Ahmednagar</option>
                                <option value="Aurangabad">Aurangabad</option>
                                <option value="Jalgaon">Jalgaon</option>
                                <option value="Kolhapur">Kolhapur</option>
                                <option value="Mumbai">Mumbai</option>
                                <option value="Mumbai Suburbs">Mumbai Suburbs</option>
                                <option value="Nagpur">Nagpur</option>
                                <option value="Nasik">Nasik</option>
                                <option value="Navi Mumbai">Navi Mumbai</option>
                                <option value="Pune">Pune</option>
                                <option value="Solapur">Solapur</option>
                                <option value="Maharashtra-Other">Maharashtra-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Manipur-</i>
                                </option>
                                <option value="Imphal">Imphal</option>
                                <option value="Manipur-Other">Manipur-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Meghalaya-</i>
                                </option>
                                <option value="Shillong">Shillong</option>
                                <option value="Meghalaya-Other">Meghalaya-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Mizoram-</i>
                                </option>
                                <option value="Aizawal">Aizawal</option>
                                <option value="Mizoram-Other">Mizoram-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Nagaland-</i>
                                </option>
                                <option value="Dimapur">Dimapur</option>
                                <option value="Nagaland-Other">Nagaland-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Orissa-</i>
                                </option>
                                <option value="Bhubaneshwar">Bhubaneshwar</option>
                                <option value="Cuttak">Cuttak</option>
                                <option value="Paradeep">Paradeep</option>
                                <option value="Puri">Puri</option>
                                <option value="Rourkela">Rourkela</option>
                                <option value="Orissa-Other">Orissa-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Punjab-</i>
                                </option>
                                <option value="Amritsar">Amritsar</option>
                                <option value="Bathinda">Bathinda</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Jalandhar">Jalandhar</option>
                                <option value="Ludhiana">Ludhiana</option>
                                <option value="Mohali">Mohali</option>
                                <option value="Pathankot">Pathankot</option>
                                <option value="Patiala">Patiala</option>
                                <option value="Punjab-Other">Punjab-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Rajasthan-</i>
                                </option>
                                <option value="Ajmer">Ajmer</option>
                                <option value="Jaipur">Jaipur</option>
                                <option value="Jaisalmer">Jaisalmer</option>
                                <option value="Jodhpur">Jodhpur</option>
                                <option value="Kota">Kota</option>
                                <option value="Udaipur">Udaipur</option>
                                <option value="Rajasthan-Other">Rajasthan-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Sikkim-</i>
                                </option>
                                <option value="Gangtok">Gangtok</option>
                                <option value="Sikkim-Other">Sikkim-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Tamil Nadu-</i>
                                </option>
                                <option value="Chennai">Chennai</option>
                                <option value="Coimbatore">Coimbatore</option>
                                <option value="Cuddalore">Cuddalore</option>
                                <option value="Erode">Erode</option>
                                <option value="Hosur">Hosur</option>
                                <option value="Madurai">Madurai</option>
                                <option value="Nagerkoil">Nagerkoil</option>
                                <option value="Ooty">Ooty</option>
                                <option value="Salem">Salem</option>
                                <option value="Thanjavur">Thanjavur</option>
                                <option value="Tirunalveli">Tirunalveli</option>
                                <option value="Trichy">Trichy</option>
                                <option value="Tuticorin">Tuticorin</option>
                                <option value="Vellore">Vellore</option>
                                <option value="Tamil Nadu-Other">Tamil Nadu-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Tripura-</i>
                                </option>
                                <option value="Agartala">Agartala</option>
                                <option value="Tripura-Other">Tripura-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Union Territories-</i>
                                </option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Dadra & Nagar Haveli-Silvassa">Dadra & Nagar Haveli-Silvassa</option>
                                <option value="Daman & Diu">Daman & Diu</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Pondichery">Pondichery</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Uttar Pradesh-</i>
                                </option>
                                <option value="Agra">Agra</option>
                                <option value="Aligarh">Aligarh</option>
                                <option value="Allahabad">Allahabad</option>
                                <option value="Bareilly">Bareilly</option>
                                <option value="Faizabad">Faizabad</option>
                                <option value="Ghaziabad">Ghaziabad</option>
                                <option value="Gorakhpur">Gorakhpur</option>
                                <option value="Kanpur">Kanpur</option>
                                <option value="Lucknow">Lucknow</option>
                                <option value="Mathura">Mathura</option>
                                <option value="Meerut">Meerut</option>
                                <option value="Moradabad">Moradabad</option>
                                <option value="Noida">Noida</option>
                                <option value="Varanasi/Banaras">Varanasi/Banaras</option>
                                <option value="Uttar Pradesh-Other">Uttar Pradesh-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Uttaranchal-</i>
                                </option>
                                <option value="Dehradun">Dehradun</option>
                                <option value="Roorkee">Roorkee</option>
                                <option value="Uttaranchal-Other">Uttaranchal-Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-West Bengal-</i>
                                </option>
                                <option value="Asansol">Asansol</option>
                                <option value="Durgapur">Durgapur</option>
                                <option value="Haldia">Haldia</option>
                                <option value="Kharagpur">Kharagpur</option>
                                <option value="Kolkata">Kolkata</option>
                                <option value="Siliguri">Siliguri</option>
                                <option value="West Bengal - Other">West Bengal - Other</option>
                                <option disabled="disabled" style="background-color:#000000;color:#00AEEF;">
                                    <i>-Other-</i>
                                </option>
                                <option value="Other">Other</option>
                                </select>
                            <span class="error-text pull-right"><?php echo $locationError; ?></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h3 class="text-center">Requirements</h3>
                        <div class="form-group">
                            <label>Educational Skill: <span class="require">* </span> </label>
                            <input class="form-control" type="text" name="educationskill" id="educationskill" tabindex="10" placeholder="Enter Education Skill" value="<?php echo (isset($_POST['educationskill']) != "") ? $_POST['educationskill'] : '';?>" />
                            <span class="error-text pull-right"><?php echo $educationskillError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Technical Skill: </label>
                            <input class="form-control" type="text" name="technicalskill" id="technicalskill" placeholder="Enter Technical Skill" tabindex="11" value="<?php echo (isset($_POST['technicalskill']) != "") ? $_POST['technicalskill'] : '';?>" />
                            <span class="error-text pull-right"><?php echo $technicalskillError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Posts Require: <span class="require">* </span> </label>
                            <input class="form-control" type="text" name="postrequire" id="postrequire" tabindex="1" placeholder="Enter Number of Employee Require" value="<?php echo (isset($_POST['postrequire']) != "") ? $_POST['postrequire'] : '';?>"/>
                            <span class="error-text pull-right"><?php echo $postrequireError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Salary: <span class="require">* </span> </label>
                            <input class="form-control" type="text" name="salary" id="salary" tabindex="1" placeholder="Enter Salary for the Post" value="<?php echo (isset($_POST['salary']) != "") ? $_POST['salary'] : '';?>"/>
                            <span class="error-text pull-right"><?php echo $salaryError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Job Image: </label>
                            <input class="form-control" type="file" size="30" name="image" id="image" tabindex="20" />
                            <span class="error-text pull-right"><?php echo $imageError; ?></span>
                        </div>
                        <div class="form-group text-right">
                            <label>&nbsp;</label>
                            <input class="btn btn-success" type="submit" name="submit_job" id="submit_job" value="Submit" class="signup-bttn" tabindex="19" />
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