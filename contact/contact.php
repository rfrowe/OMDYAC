<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/work/omdyac/files/recaptchalib.php');
  session_start();
  $privatekey = "REDACTED";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

	$email = $_POST['email'];
	$subject = $_POST['name']." says: ".$_POST['subject'];
	$body = $_POST['content'];
	$headers = "From: ".$email."\r\n" .
     "X-Mailer: php";

  if (!$resp->is_valid) {
    $_SESSION['captchaError'] = true;
	$_SESSION['content'] = $body;
	$_SESSION['name'] = $_POST['name'];
	$_SESSION['email'] = $email;
	$_SESSION['subject'] = $_POST['subject'];

	header("location:./#email");
  } else {

	 //
	 //EMAIL TO SEND TO, CHANGE IF WEBMASTER EMAIL CHANGES
	 $webmasterEmail = "REDACTED";
	 //
	 //
	 if(mail($webmasterEmail,$subject,$body,$headers)) {

	 	$_SESSION['mailSent'] = true;
		header("location:./");
	 } else {
		$_SESSION['mailSent'] = false;
		$_SESSION['content'] = $body;
		$_SESSION['name'] = $_POST['name'];
		$_SESSION['email'] = $email;
		$_SESSION['subject'] = $_POST['subject'];
		header("location:./#email");
	 }
  }
 ?>
