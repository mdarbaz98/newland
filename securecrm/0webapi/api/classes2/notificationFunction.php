<?php
    function sendSms($to, $msg) {
        $post_data = [
            'username'=>'Newlands Pharmacy', 
            'key'=>'Newlands Pharmacy@2022', 
            'method'=>'http', 
            'to'=>$to, 
            'message'=>$msg, 
            'senderid'=>'GlobalPharma'
        ];
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, "https://api-mapper.clicksend.com/http/v2/send.php" );
        curl_setopt($ch, CURLOPT_POST, 1 );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $postResult = curl_exec($ch);
        if (curl_errno($ch)) {
            // print curl_error($ch);
        }
        curl_close($ch);
        // var_dump($ch);
    }
?>