<?php
require_once(dirname(__FILE__) . '/config/config.php');

$allError = '';$succMSG = '';$nameError = '';$emailError = '';$subjectError = '';$messageError = '';
if( isset($_POST['con_contactus']) ) {
    $name     = addslashes($_POST['con_name']);
    $email    = addslashes($_POST['con_email']);
    $subject  = addslashes($_POST['con_subject']);
    $message  = addslashes($_POST['con_message']);
    $datetime = date('Y-m-d H:i:s');

    if( $name == "" && $email == "" && $subject == "" && $message == "" ) {
        $allError     = 'All fields are required!';
        $nameError    = 'Enter your Name for Contact!';
        $emailError   = 'Email address is required!';
        $subjectError = 'Select Subject from the list!';
        $messageError = 'Enter Message for contact us!';
    } elseif( $name == "" ) {
        $nameError = 'Enter your Name for Contact!';
    } elseif( $email == "" ) {
        $emailError = 'Email address is required!';
    } elseif( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        $emailError = 'Email address is not valid!';
    } elseif( $subject == "" ) {
        $subjectError = 'Select Subject from the list!';
    } elseif( $message == "" ) {
        $messageError = 'Enter Message for contact us!';
    } else {
        $insertSQL = mysqli_query($db, "INSERT INTO `js_contact`(`Contact_Name`, `Contact_Email`, `Contact_Subject`, `Contact_Message`,`Contact_DateTime`) VALUES ('".$name."','".$email."','".$subject."','".$message."','".$datetime."')");
        if( $insertSQL ) {
            /* Mail Function */
            $mail->setFrom($email, $name);
            $mail->addReplyTo($email, $name);
            $mail->addAddress('jobseeker.supp@gmail.com', 'JobSeeker');
            $mail->isHTML(true);

            $body  = '
            <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid rgba(0, 0, 0, 0.15);font-family:Verdana,sans-serif;">
              <tr>
                <td>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="100" align="center">
                        <font color="#c31629" size="5">Contact from JobSeeker</font><br/><br/>
                        <font color="#5cb85c" size="2">
                          <span>Thank you for contacting with us.</span>
                        </font><br /><br />
                      </td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" style="padding:0 20px;">
                        <font color="#161616" size="2">
                          <span>Dear Administrator</strong>,<br /><br />You have a mail from JobSeeker.</span>
                        </font><br /><br />
                      </td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" style="padding:0 20px;">
                          <font color="#161616" size="2">
                            <span>Someone send you some query. Please check as follows:</span>
                          </font><br /><br />
                        </td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" style="padding-left:20px;">
                          <font color="#161616" size="2">
                            Name: <br /><strong>'.$name.'</strong>
                          </font><br /><br />
                          <font color="#161616" size="2">
                            Email: <br /><strong>'.$email.'</strong>
                          </font><br /><br />
                          <font color="#161616" size="2">
                            Subject: <br /><strong>'.$subject.'</strong>
                          </font><br /><br />
                          <font color="#161616" size="2">
                            Message: <br />'.$message.'
                          </font><br /><br />
                        </td>
                      </tr>
                  </table>
                </td>
              </tr>
            </table>';
            
            $mail->Subject = 'Contact from JobSeeker';
            $mail->Body    = $body;
            if( !$mail->send() ) {
                $allError = 'Oops! Mail not sent! Mailer Error: ' . $mail->ErrorInfo; 
            } else {
                unset($_POST);
                $succMSG = 'Your query has been successfully sent. We will get back to you soon.';
            }
        } else {
            $allError = 'Oops! Something went wrong. Please try again!';
        }
    }
}

$page_name = 'Contact Us';
require_once(dirname(__FILE__) . '/templates/header.php'); ?>

<body>

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- Body content -->
  
    <?php require_once(dirname(__FILE__) . '/templates/navbar.php'); ?>

    <div class="content-area">
        <div class="banner-area">
            <img src="http://localhost/jobseeker/assets/img/contact_banner.jpg" alt="Contact Us" />
        </div>
        <div class="container">
            <div class="row">
                <h1 class="text-center">Contact Us</h1>
            </div>
            <div class="row text-center">
                <span class="error-text"><?php echo $allError; ?></span>
                <span class="success-text"><?php echo $succMSG; ?></span>
            </div>
            <div class="clear"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="well well-sm">
                        <form name="contact-us" id="contact-us" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="con_name" id="con_name" placeholder="Enter name" value="<?php echo (isset($_POST['con_name']) != "") ? $_POST['con_name'] : '';?>" />
                                        <span class="error-text pull-left"><?php echo $nameError; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input type="email" class="form-control" name="con_email" id="con_email" placeholder="Enter email" value="<?php echo (isset($_POST['con_email']) != "") ? $_POST['con_email'] : '';?>" />
                                        </div>
                                        <span class="error-text pull-left"><?php echo $emailError; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <select name="con_subject" id="con_subject" class="form-control">
                                            <option <?php echo (isset($_POST['con_subject']) == "") ? "selected" : ""; ?> value="">Choose One:</option>
                                            <option <?php echo (isset($_POST['con_subject']) == "General Customer Service") ? "selected" : ""; ?> value="General Customer Service">General Customer Service</option>
                                            <option <?php echo (isset($_POST['con_subject']) == "Suggestions") ? "selected" : ""; ?> value="Suggestions">Suggestions</option>
                                            <option <?php echo (isset($_POST['con_subject']) == "Product Support") ? "selected" : ""; ?> value="Product Support">Product Support</option>
                                            <option <?php echo (isset($_POST['con_subject']) == "Other Service") ? "selected" : ""; ?> value="Other Service">Other Service</option>
                                        </select>
                                        <span class="error-text pull-left"><?php echo $subjectError; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Message</label>
                                        <textarea name="con_message" id="con_message" class="form-control" rows="9" cols="25" placeholder="Message"><?php echo (isset($_POST['con_message']) != "") ? $_POST['con_message'] : '';?></textarea>
                                        <span class="error-text pull-left"><?php echo $messageError; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary pull-right" name="con_contactus" id="con_contactus">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <form>
                        <legend><span class="fa fa-globe"></span> Our office</legend>
                        <address>
                            <strong>JobSeeker, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">
                                P:</abbr>
                            (123) 456-7890
                        </address>
                        <address>
                            <strong>Full Name</strong><br>
                            <a href="mailto:priyanka.pramanik710@gmail.com">priyanka.pramanik710@gmail.com</a>
                        </address>
                    </form>
                </div>
            </div>            
        </div>
    </div>
    <div class="clear"></div>
    <div class="content-area">
        <div class="map-area">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3673.01685097905!2d88.44338591431298!3d22.98640782344844!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f8952e9c083cfb%3A0x5889604b5cbe2432!2sKalyani+University!5e0!3m2!1sen!2sin!4v1522491315134" width="100%" height="400" frameborder="0" style="border:1"></iframe>
        </div>
    </div>

<?php require_once(dirname(__FILE__) . '/templates/footer.php'); ?>