<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "lim12001@byui.edu";
    $email_subject = "Testing Photography Website";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $comments = $_POST['comments']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
 
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="general.css">
		<title>DJ's Cinematography Website</title>
	</head>
	<body>
		<div id="mainTitle">
			<h1><a href="website.html"><strong>DJ's Cinematography Website</strong></a></h1>
		</div>
		<div id="customer">
			<h2>Customer</h2><br>
			<p><a href="createCustomer.html"><strong>Register your customer info! &raquo;</strong></a></p>
			<p><a href="updateCustomer.html"><strong>Update your customer info! &raquo;</strong></a></p>
		</div>
		<div id="about">
			<h2>About</h2><br>
			<p><a href="About.html"><strong>My Life &raquo;</strong></a></p>
			<p><a href="SessionInfo.html"><strong>Session Info &raquo;</strong></a></p>
		</div>
		<div id="portfolio">
			<h2>Portfolio</h2><br>
			<p><a href="photography.html"><strong>Pictures &raquo;</strong></a></p>
			<p><a href="videography.html"><strong>Videos &raquo;</strong></a></p>
		</div>
		<div id="contact">
			<h2>Info</h2><br>
			<p><a href="contact.html"><strong>Contact Me &raquo;</strong></a></p>
			<p><a href="price.html"><strong>Price &raquo;</strong></a></p>
		</div>
		<div style="height: 300px;">
			<p></p>
		</div>
		<hr>
		<p id="thankYou">
			Thank you for contacting us. <br> We will be in touch with you very soon.
		</p>
		<hr>
		<footer class="footer-distributed">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <div class="footer-left">
                <h3>DJ Lim's Cinematography</h3>
                <p class="footer-company-name">Lim Photography © 2018</p>
                <div class="footer-icons">
                    <a href="https://www.facebook.com/elizabethlimphoto/"><i class="fa fa-facebook"></i></a>
                    <a href="https://www.youtube.com/channel/UCjGWC3N0DibPnIhQtYDgONg"><i class="fa fa-youtube"></i></a>
                    <a href="https://www.instagram.com/elizabethlimphotography/"><i class="fa fa-instagram"></i></a>
                    <a href="https://elizabethkaylim.com"><i class="fa fa-share-alt"></i></a>
                </div>
            </div>
            <br><br>
        </footer>
	</body>
</html>
 
<?php
 
}
?>