<?php

$address = 'SELECT * FROM `tbl_cust_issues` Where id="'.$id.'"';
$res = $dbdp->query($address);
$rowsadd = $res->fetch_assoc();


$to_email = $rowsadd["cno"];
//print_r($rrr); die;

$web = $rowsadd['web'];
							



$str = '<html>
        <head>
        </head>
        <body>
        <p>'.$user_msg.'</p>
        <br>
		<a href="https://oneglobalpharma.com/support/order-report.php?id='.$id.'" style="background-color: #409c06;padding: 10px;color: #fff;text-decoration: none;">Resend Message</a>
        <br>
        <br>
        <p>Best regards,<br>
        Selco Enterprises,<br>
        109 East Street Road, Ohio, USA.<br>
        Email: admin@drugstoreplanet.com<br></p>
        </body>
        </html>
        ';

sendmail("admin@".$web, "Selco Enterprises", $to_email, "Your Order Report-".$rowsadd['order_id'], $str);

?>