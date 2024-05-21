<?php
require_once(dirname(__FILE__) . '/config/config.php');

if( !empty($_SESSION['CompanyLoggedIn']) ) {
    header("Location: http://localhost/jobseeker/CompanyDashboard.php");
    exit;
}

$allError = '';$usernameError = '';$passwordError = '';

if( isset($_GET['uid']) ) {
    $UniqueID = $_GET['uid'];
    $checkSQL = mysqli_query($db, "SELECT * FROM `js_company` WHERE `Company_Unique_ID` = '".$UniqueID."' LIMIT 0, 1");
    if( $checkSQL ) {
        if( mysqli_num_rows($checkSQL) > 0 ) {
            mysqli_query($db, "UPDATE `js_company` SET `Company_Status` = 'Active' WHERE `Company_Unique_ID` = '".$UniqueID."'");
            $_SESSION['ActiveMessage'] = 'User successfully activated.';
        } else {
            $allError = 'No record found!';
        }
    }
}

if( isset($_POST['submit_company_login']) ) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if( $username == "" && $password == "" ) {
        $allError = 'All fields are required!';
        $usernameError = 'Username is required!';
        $passwordError = 'Password is required!';
    } elseif( $username == "" ) {
        $usernameError = 'Username is required!';
    } elseif( $password == "" ) {
        $passwordError = 'Password is required!';
    } else {
        $loginSQL = mysqli_query($db, "SELECT * FROM `js_company` WHERE `Company_Email` = '".$username."' AND `Company_Password` = '".sha1($password)."' LIMIT 0, 1");
        if( $loginSQL ) {
            if( mysqli_num_rows($loginSQL) > 0 ) {
                $companyData = mysqli_fetch_assoc($loginSQL);
                if( $companyData['Company_Status'] == 'Inactive' ) {
                    $allError = 'Company is not active!';
                } else {
                    $Company = array(
                        'UserID'    => $companyData['Company_ID'],
                        'UniqueID'  => $companyData['Company_Unique_ID'],
                        'Email'     => $companyData['Company_Email'],
                        'Name'      => $companyData['Company_Name'],
                        'Status'    => $companyData['Company_Status'],
                        'LastLogin' => $companyData['Company_Last_Login']
                    );
                    $_SESSION['CompanyLoggedIn'] = $Company;
                    header('Location: http://localhost/jobseeker/CompanyDashboard.php');
                }
            } else {
                $allError = 'No record found!';
            }
        }
    }
}

$page_name = 'Company Login';
require_once(dirname(__FILE__) . '/templates/header.php'); ?>

<body>

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- Body content -->
  
    <?php require_once(dirname(__FILE__) . '/templates/navbar.php'); ?>

    <div class="content-area">
        <div class="banner-area">
            <img src="http://localhost/jobseeker/assets/img/login_banner.jpg" alt="Company Login" />
        </div>
        <div class="container">
            <div class="row">
                <h1 class="text-center">Company Login</h1>
                <div class="row text-center">
                    <span class="error-text"><?php echo $allError; ?></span>
                    <?php if( isset($_SESSION['ActiveMessage']) ) { ?>
                        <span class="success-text"><?php echo $_SESSION['ActiveMessage']; ?></span>
                    <?php } ?>
                    <?php unset($_SESSION['ActiveMessage']); ?>
                </div>
                <form action="" method="post">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Username: </label>
                            <input type="text" name="username" id="username" placeholder="Enter Username" class="form-control" />
                            <span class="error-text pull-right"><?php echo $usernameError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Password: </label>
                            <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control" />
                            <span class="error-text pull-right"><?php echo $passwordError; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit_company_login" id="submit_company_login" value="Login" class="btn btn-success" />
                            <a href="ForgotPasswordCompany.php" class="btn btn-danger">Forgot Password?</a>
                        </div>
                        <div class="form-group">
                            Not registered yet? Then <a href="CompanyRegistration.php">Register</a> from here.
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