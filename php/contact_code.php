<?php
if(isset($_POST['email'])) {

  if($_POST['name'] != ""){
     echo('Spamming Detected!');
     die();
  }
  function died($error) {
    // your error code can go here
    echo "We are very sorry, but there were error(s) found with the form you submitted. <br />";
    echo "These errors appear below.<br /><br />";
    echo $error."<br /><br />";
    echo "Please go back and fix these errors.<br /><br />";
    die();
  }

  // validation expected data exists
 if(!isset($_POST['firstName']) || !isset($_POST['lastName']) || !isset($_POST['email'])){
    died('We are sorry, but there appears to be a problem with the form you submitted.');      
  } 

  $firstName = $_POST['firstName']; // required
  $lastName = $_POST['lastName']; // required
  $email_from = $_POST['email']; // required
  $phone = $_POST['phone']; // not required
  $message = $_POST['message']; // not required
  $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  $error_message = "";

  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }

  if(strlen($firstName) < 2) {
    $error_message .= 'The First name you entered does not appear to be valid.<br />';
  }

  if(strlen($lastName) < 2) {
    $error_message .= 'The Last name you entered does not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
  $email_message = "Form details below.\n\n";
     
  function clean_string($string) {
    $bad = array("content-type","bcc:","to:","cc:","href");
    return str_replace($bad,"",$string);
  }

  $email_message .= "Name: ".clean_string($firstName)." ".clean_string($lastName)."\n";
  $email_message .= "Email: ".clean_string($email_from)."\n";
  $email_message .= "Phone: ".clean_string($phone)."\n";
  $email_message .= "Message: "."\n";
  $email_message .= $message;
 
  // create email headers
  // EDIT THE 2 LINES BELOW AS REQUIRED
  //$email_to = "rajdeep.das.developer@gmail.com";
  $email_to = "info@wembleyinterior.in";
  $email_subject = "Clients for wembleyinterior.in";
  $headers = 'From: '."wembleyinterior.in"."\r\n".
  'Reply-To: '.$email_from."\r\n" .
  'X-Mailer: PHP/' . phpversion();
  if(@mail($email_to, $email_subject, $email_message, $headers)){
    echo '<h1 style="position:absolute;left:50%;top:50%;transform: translate(-50%, -50%);max-width:750px;font-size: 50px;text-align: center;font-family: arial;">Thank you for contacting us, we will get back to you as soon as possible.</h1>';
  }
}
else{
  header('Location: http://www.wembleyinterior.in/');
} 
?>