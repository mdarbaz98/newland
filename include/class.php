<?php
    class MailSmsOtp {
        
        function mail($to, $subject, $msg){
    	    $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = "Newlands Pharmacy.com"; // Your Domain Name
            $mail->SMTPAuth = true;
            $mail->Port = 587;
            $mail->Username = "order@Newlands Pharmacy.com"; // Your Email ID
            $mail->Password = "%~xx9GI5z]lk"; // Password of your email id
            $mail->From = "order@Newlands Pharmacy.com";
            $mail->FromName = "OneGlobalPharma.com";
            $mail->AddAddress ($to);
            $mail->IsHTML(true);
            $mail->Subject = $subject; 
            $mail->Body = $msg;
    		if(!$mail->Send()){
    			return 0;
    		}else{
    			return 1;
    		}
        }


        function sms($to, $msg){
        	$url = "http://203.129.225.68/API/WebSMS/Http/v2.0a/index.php";
            $fields_string=''; 
            $fields = array( 
                'secretkey' => urlencode('5f318599e6'),
                'sender' => urlencode('SSENET'),
                'to' => urlencode($to),
                'message' => urlencode($msg),
                'msgtype' => 'text',
                'reqid' => urlencode('1'),
                'callbackurl'=>urlencode('http://yourdomain.php/index.php'),
            ); 
            foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
            rtrim($fields_string, '&');
            $ch = curl_init( $url );
            curl_setopt( $ch, CURLOPT_POST, 1);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt( $ch, CURLOPT_HEADER, 0);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        	$result = curl_exec($ch);
            $err = curl_error($ch);
            if ($err) {
                return 0;
            } else {
        		return 1;
            }

        }
    }
?>