<?php

$address = 'SELECT * FROM `contact` Where id="'.$id.'"';
$res = $dbtrx->query($address);
$rowsadd = $res->fetch_assoc();


$to_email = $rowsadd["email"];
//print_r($rrr); die;							



$str = '<html>
        <head>
        </head>
        <body>
        <p>'.$user_msg.'</p>
        <br>
		<a href="https://oneglobalpharma.com/support/send-message.php?id='.$id.'" style="background-color: #409c06;padding: 10px;color: #fff;text-decoration: none;">Resend Message</a>
        <br>
        <br>
        <p>Best regards,<br>
        Selco Enterprises,<br>
        109 East Street Road, Ohio, USA.<br>
        Email: admin@drugstoreplanet.com<br></p>
        </body>
        </html>
        ';

sendmail("admin@tramadolexport.com", "Selco Enterprises", $to_email, $rowsadd['sub'], $str);

?>