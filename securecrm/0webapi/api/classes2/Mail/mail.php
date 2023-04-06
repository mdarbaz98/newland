<?php
// require_once 'mailerClass/class.php';
 require("class.phpmailer.php");
 
// $mail = new PHPMailer;
 
// $mail->IsSMTP();
// $mail->Host = "smtpout.asia.secureserver.net";

// $mail->SMTPAuth = true;
// $mail->SMTPSecure = "tls";
// $mail->Port = 80;
// $mail->Username = "admin@selcoenterprises.com";
// $mail->Password = "Alpapharma@123";

// //Replace the plain text body with one created manually
// $mail->AltBody = 'This is a plain-text message body';
// $mail->isHTML(true);  




// function sendmail($from, $frname, $toemail, $subject, $msg) {
// 	global $mail;
// 	//Set who the message is to be sent from 
// 	$mail->setFrom($from, $frname);
// 	//Set an alternative reply-to address
// 	//Set who the message is to be sent to
// 	$mail->addAddress($toemail);

// 	//Set the subject line
// 	$mail->Subject = $subject;
	
// 	$mail->Body = $msg;
// 	//$mail->AddCC('admin@tramadolsale.com');

// 	if (!$mail->send()) {
// 		echo "Mailer Error: " . $mail->ErrorInfo;
// 	} 
// }

function sendmail($from, $frname, $toemail, $subject, $msg){
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = "oneglobalpharma.com"; // Your Domain Name
    $mail->SMTPAuth = true;
    $mail->Port = 587;
    $mail->Username = "orderonline@oneglobalpharma.com"; // Your Email ID
    $mail->Password = ",ci9TYJCQ))="; // Password of your email id
    $mail->From = "orderonline@oneglobalpharma.com";
    $mail->FromName = $frname;
    $mail->AddAddress ($toemail);
    $mail->IsHTML(true);
    $mail->Subject = $subject; 
    $mail->Body = $msg;
    if(!$mail->Send()){
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}

?>