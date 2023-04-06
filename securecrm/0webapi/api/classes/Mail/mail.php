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

function sendmail2($from, $frname, $toemail, $subject, $msg){
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

function sendmail($from, $frname, $toemail, $subject, $msg){
    $mailjetApiKey = 'a6e20f63603953cd9ca2349265d2304b';
    $mailjetApiSecret = '4a228283087d8e09a63a01a990576bc3';
    $messageData = [
            'Messages' => [
                    [
                            'From' => [
                                    'Email' => 'orderonline@oneglobalpharma.com',
                                    'Name' => 'Newlands Pharmacy Order'
                            ],
                            'To' => [
                                    [
                                            'Email' => $toemail,
                                            'Name' => $frname
                                    ]
                            ],
                            //'Bcc' => [
                              //  [
                                //        'Email' => 'sandeepparekh120@gmail.com',
                                  //      'Name' => 'Sandeep Parekh'
                              //  ]
                            //],
                            'Subject' => $subject,
                            'TextPart' => '',
                            'HTMLPart' => $msg
                    ]
            ]
    ];
    $jsonData = json_encode($messageData);
    $ch = curl_init('https://api.mailjet.com/v3.1/send');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_USERPWD, "{$mailjetApiKey}:{$mailjetApiSecret}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
    ]);
    $response = json_decode(curl_exec($ch));
}


?>
