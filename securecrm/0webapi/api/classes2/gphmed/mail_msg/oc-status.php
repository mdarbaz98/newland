<?php
$sql = 'SELECT * FROM `orders` WHERE id="'.$id.'"';
$result = $dbgpmz->query($sql);
$row = $result->fetch_assoc();
$invid = "#".$row['orderno'];
$smsinvid = $row['orderno'];
$cid = $row['cust_id'];
$date = $row['paymentDate'];

$sql1 = 'select * from shippinginfo where cid="'.$row['cust_id'].'"';	
$result1 = $dbgpmz->query($sql1);
$rowsadd = $result1->fetch_assoc();
$toemail = mb_convert_encoding($rowsadd['email'], "UTF-8", "UTF-8");

$tids = array();
$tsql = "SELECT * FROM `tbl_traking_ids` WHERE order_id='".$id."'";
$tresult = $dbgpmz->query($tsql);
while($rows1 = $tresult->fetch_assoc()) {
	array_push($tids, $rows1);
}

$customer_data = "SELECT * FROM shippinginfo WHERE cid='$cid'";
$customerresult = $dbgpmz->query($customer_data);
while($cutomerlist=$customerresult->fetch_assoc()){
    $name = $cutomerlist['fname'];
}

$result = $dbgpmz->query("select * from order_details Where order_id='".$id."'");

$str = '';
$str1 = '';
$total = 0; 
$arr = array();
$productId = array();
while($rows = $result->fetch_assoc()) {
	$sql = "select * from subcategory where sid='".$rows['pid']."' AND id=".$rows['cid']."";
			$pid = $rows['pid'];
			array_push($productId,$pid);
	$result1 = $dbgpmz->query($sql);
	$rows2 = $result1->fetch_assoc();
	
	$sql2 = "select * from pdetails where pid='".$rows['strength']."'";	
	$result2 = $dbgpmz->query($sql2);
	$rows3 = $result2->fetch_assoc();

	$stren = empty($rows3['strength'])?"":$rows3['strength'];
	$array['pname'] = empty($rows2['productname'])?"":$rows2['productname'].": ".$stren;
	$array['qty'] = $rows['qty'];
	$array['price'] = $rows['price'];
	
	$str1.='
			    <tr style="padding-bottom: 85px;">
			    <td class="esdev-mso-td" style="margin-top:30px;" valign="top" >
                                                    <table cellpadding="0" cellspacing="0" class="es-left" align="left">
                                                        <tbody>
                                                            <tr>
                                                                <td width="350" class="es-m-p0r esd-container-frame" align="center">
                                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="left" class="esd-block-text">
                                                                                    <p style="margin:0 !improtant"><b>'.$array['pname'].'</p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td class="esdev-mso-td" valign="top">
                                                    <table cellpadding="0" cellspacing="0" class="es-left" align="left">
                                                        <tbody>
                                                            <tr>
                                                                <td width="80" class="esd-container-frame" align="center">
                                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="left" class="esd-block-text">
                                                                                    <p style="margin:0 !improtant">'.$array['qty'].'</p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td class="esdev-mso-td" valign="top">
                                                    <table cellpadding="0" cellspacing="0" class="es-left" align="left">
                                                        <tbody>
                                                            <tr>
                                                                <td width="60" class="esd-container-frame" align="center">
                                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="left" class="esd-block-text">
                                                                                    <p style="margin:0 !improtant">$'.$array['price'].'</p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td class="esdev-mso-td" valign="top" >
                                                    <table cellpadding="0" cellspacing="0" class="es-left" align="left">
                                                        <tbody>
                                                            <tr>
                                                                <td width="80" class="esd-container-frame" align="center">
                                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="left" class="esd-block-text">
                                                                                    <p style="margin:0 !improtant">$'.$array['qty']*$array['price'].'</p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                </tr>
                                            <tr><td style="padding-bottom: 0px;"></td></tr>
			';
	
	$total = $total + ($array['qty']*$array['price']);
}
		
		
$str .= '<tr>
			<td></td>
			<th colspan="2" align="right" style="border-top:2px solid gray;"><b>Sub Total: </b></th>
			<td style="border-top:2px solid gray;">$'.$total.'</td>
		</tr>';
		
		
	if($total>250) {
		$str .= '<tr>
					<th colspan="3" align="right"><b>Shipping Free: </b></th>
					<td>$00.00</td>
				</tr>';
	} else {
		$str .= '<tr>
					<th colspan="3" align="right"><b>Shipping: </b></th>
					<td>$25.00</td>
				</tr>';
	}
	$dis = 00;
	if($total>250) {
		$str .='<tr>
				<td></td>
				<th colspan="2" align="right"><b>Total: </b></th>
				<td>$'.($total-$dis).'</td>
			</tr>';
			$total = $total-$dis;
	} else {
		$str .='<tr>
				<td></td>
				<th colspan="2" align="right"><b>Total: </b></th>
				<td>$'.($total+25).'</td>
			</tr>';
			$total = $total+25;
	}
	
	$dis = 00;
		
		if($total>250 && in_array(1288, $productId)) {
		    $priceInfo = '<p style="margin:0 !improtant">$'.$total.'</p>
                          <p style="margin:0 !improtant">$50.00</p>
                          <p style="margin:0 !improtant">$'.($total+50).'</p>';
                $total = $total+50;                    
		}
		elseif($total>250) {
			$priceInfo = '<p style="margin:0 !improtant">$'.$total.'</p>
                          <p style="margin:0 !improtant">FREE</p>
                          <p style="margin:0 !improtant">$'.($total-$dis).'</p>';
                $total = $total-$dis;
		}
		else {
			$priceInfo = '<p style="margin:0 !improtant">$'.$total.'</p>
                          <p style="margin:0 !improtant">$25</p>
                          <p style="margin:0 !improtant">$'.($total+25).'</p>';
                $total = $total+25;
		}
		
				
				
				
$msg ='';

$msg .='
<head>
    <style>
        #outlook a {
            padding: 0;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }

        .es-button {
            mso-style-priority: 100 !important;
            text-decoration: none !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        .es-desk-hidden {
            display: none;
            float: left;
            overflow: hidden;
            width: 0;
            max-height: 0;
            line-height: 0;
            mso-hide: all;
        }

        [data-ogsb] .es-button {
            border-width: 0 !important;
            padding: 10px 20px 10px 20px !important;
        }

        [data-ogsb] .es-button.es-button-1635331926528 {
            padding: 10px 20px !important;
        }

        s {
            text-decoration: line-through;
        }

        html,
        body {
            width: 100%;
            font-family: Arial, sans-serif;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            border-collapse: collapse;
            border-spacing: 0px;
        }

        table td,
        html,
        body,
        .es-wrapper {
            padding: 0;
            Margin: 0;
        }

        .es-content,
        .es-header,
        .es-footer {
            table-layout: fixed !important;
            width: 100%;
        }

        img {
            display: block;
            border: 0;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        table tr {
            border-collapse: collapse;
        }

        p,
        hr {
            Margin: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            Margin: 0;
            line-height: 120%;
            mso-line-height-rule: exactly;
            font-family: Arial, sans-serif;
        }

        p,
        ul li,
        ol li,
        a {
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
            mso-line-height-rule: exactly;
        }

        .es-left {
            float: left;
        }

        .es-right {
            float: right;
        }

        .es-p5 {
            padding: 5px;
        }

        .es-p5t {
            padding-top: 5px;
        }

        .es-p5b {
            padding-bottom: 5px;
        }

        .es-p5l {
            padding-left: 5px;
        }

        .es-p5r {
            padding-right: 5px;
        }

        .es-p10 {
            padding: 10px;
        }

        .es-p10t {
            padding-top: 10px;
        }

        .es-p10b {
            padding-bottom: 10px;
        }

        .es-p10l {
            padding-left: 10px;
        }

        .es-p10r {
            padding-right: 10px;
        }

        .es-p15 {
            padding: 15px;
        }

        .es-p15t {
            padding-top: 15px;
        }

        .es-p15b {
            padding-bottom: 15px;
        }

        .es-p15l {
            padding-left: 15px;
        }

        .es-p15r {
            padding-right: 15px;
        }

        .es-p20 {
            padding: 20px;
        }

        .es-p20t {
            padding-top: 20px;
        }

        .es-p20b {
            padding-bottom: 20px;
        }

        .es-p20l {
            padding-left: 20px;
        }

        .es-p20r {
            padding-right: 20px;
        }

        .es-p25 {
            padding: 25px;
        }

        .es-p25t {
            padding-top: 25px;
        }

        .es-p25b {
            padding-bottom: 25px;
        }

        .es-p25l {
            padding-left: 25px;
        }

        .es-p25r {
            padding-right: 25px;
        }

        .es-p30 {
            padding: 30px;
        }

        .es-p30t {
            padding-top: 30px;
        }

        .es-p30b {
            padding-bottom: 30px;
        }

        .es-p30l {
            padding-left: 30px;
        }

        .es-p30r {
            padding-right: 30px;
        }

        .es-p35 {
            padding: 35px;
        }

        .es-p35t {
            padding-top: 35px;
        }

        .es-p35b {
            padding-bottom: 35px;
        }

        .es-p35l {
            padding-left: 35px;
        }

        .es-p35r {
            padding-right: 35px;
        }

        .es-p40 {
            padding: 40px;
        }

        .es-p40t {
            padding-top: 40px;
        }

        .es-p40b {
            padding-bottom: 40px;
        }

        .es-p40l {
            padding-left: 40px;
        }

        .es-p40r {
            padding-right: 40px;
        }

        .es-menu td {
            border: 0;
        }

        .es-menu td a img {
            display: inline-block !important;
        }

        a {
            text-decoration: none;
        }

        p,
        ul li,
        ol li {
            font-family: Arial, sans-serif;
            line-height: 150%;
        }

        ul li,
        ol li {
            Margin-bottom: 15px;
        }

        .es-menu td a {
            text-decoration: none;
            display: block;
            font-family: Arial, sans-serif;
        }

        .es-wrapper {
            width: 100%;
            height: 100%;
            background-image: ;
            background-repeat: repeat;
            background-position: center top;
        }

        .es-wrapper-color {
            background-color: #555555;
        }

        .es-header {
            background-color: transparent;
            background-image: ;
            background-repeat: repeat;
            background-position: center top;
        }

        .es-header-body {
            background-color: transparent;
        }

        .es-header-body p,
        .es-header-body ul li,
        .es-header-body ol li {
            color: #a0a7ac;
            font-size: 14px;
        }

        .es-header-body a {
            color: #a0a7ac;
            font-size: 14px;
        }

        .es-content-body {
            background-color: #f8f8f8;
        }

        .es-content-body p,
        .es-content-body ul li,
        .es-content-body ol li {
            color: #333333;
            font-size: 14px;
        }

        .es-content-body a {
            color: #3ca7f1;
            font-size: 14px;
        }

        .es-footer {
            background-color: transparent;
            background-image: ;
            background-repeat: repeat;
            background-position: center top;
        }

        .es-footer-body {
            background-color: #242424;
        }

        .es-footer-body p,
        .es-footer-body ul li,
        .es-footer-body ol li {
            color: #888888;
            font-size: 13px;
        }

        .es-footer-body a {
            color: #aaaaaa;
            font-size: 13px;
        }

        .es-infoblock,
        .es-infoblock p,
        .es-infoblock ul li,
        .es-infoblock ol li {
            line-height: 120%;
            font-size: 12px;
            color: #a0a7ac;
        }

        .es-infoblock a {
            font-size: 12px;
            color: #a0a7ac;
        }

        h1 {
            font-size: 30px;
            font-style: normal;
            font-weight: normal;
            color: #333333;
        }

        h2 {
            font-size: 24px;
            font-style: normal;
            font-weight: normal;
            color: #333333;
        }

        h3 {
            font-size: 20px;
            font-style: normal;
            font-weight: bold;
            color: #333333;
        }

        .es-header-body h1 a,
        .es-content-body h1 a,
        .es-footer-body h1 a {
            font-size: 30px;
        }

        .es-header-body h2 a,
        .es-content-body h2 a,
        .es-footer-body h2 a {
            font-size: 24px;
        }

        .es-header-body h3 a,
        .es-content-body h3 a,
        .es-footer-body h3 a {
            font-size: 20px;
        }

        a.es-button,
        button.es-button {
            border-style: solid;
            border-color: #242424;
            border-width: 10px 20px 10px 20px;
            display: inline-block;
            background: #242424;
            border-radius: 20px;
            font-size: 18px;
            font-family: \'lucida sans unicode\', \'lucida grande\', sans-serif;
            font-weight: normal;
            font-style: normal;
            line-height: 120%;
            color: #ffffff;
            text-decoration: none;
            width: auto;
            text-align: center;
        }

        .es-button-border {
            border-style: solid solid solid solid;
            border-color: #242424 #242424 #242424 #242424;
            background: #2cb543;
            border-width: 0px 0px 0px 0px;
            display: inline-block;
            border-radius: 20px;
            width: auto;
        }
        @media only screen and (max-width: 600px) {

            p,
            ul li,
            ol li,
            a {
                line-height: 150% !important;
            }

            h1,
            h2,
            h3,
            h1 a,
            h2 a,
            h3 a {
                line-height: 120% !important;
            }

            h1 {
                font-size: 30px !important;
                text-align: center;
            }

            h2 {
                font-size: 26px !important;
                text-align: center;
            }

            h3 {
                font-size: 20px !important;
                text-align: center;
            }

            .es-header-body h1 a,
            .es-content-body h1 a,
            .es-footer-body h1 a {
                font-size: 30px !important;
            }

            .es-header-body h2 a,
            .es-content-body h2 a,
            .es-footer-body h2 a {
                font-size: 26px !important;
            }

            .es-header-body h3 a,
            .es-content-body h3 a,
            .es-footer-body h3 a {
                font-size: 20px !important;
            }

            .es-header-body p,
            .es-header-body ul li,
            .es-header-body ol li,
            .es-header-body a {
                font-size: 16px !important;
            }

            .es-content-body p,
            .es-content-body ul li,
            .es-content-body ol li,
            .es-content-body a {
                font-size: 16px !important;
            }

            .es-footer-body p,
            .es-footer-body ul li,
            .es-footer-body ol li,
            .es-footer-body a {
                font-size: 16px !important;
            }

            .es-infoblock p,
            .es-infoblock ul li,
            .es-infoblock ol li,
            .es-infoblock a {
                font-size: 12px !important;
            }

            *[class="gmail-fix"] {
                display: none !important;
            }

            .es-m-txt-c,
            .es-m-txt-c h1,
            .es-m-txt-c h2,
            .es-m-txt-c h3 {
                text-align: center !important;
            }

            .es-m-txt-r,
            .es-m-txt-r h1,
            .es-m-txt-r h2,
            .es-m-txt-r h3 {
                text-align: right !important;
            }

            .es-m-txt-l,
            .es-m-txt-l h1,
            .es-m-txt-l h2,
            .es-m-txt-l h3 {
                text-align: left !important;
            }

            .es-m-txt-r img,
            .es-m-txt-c img,
            .es-m-txt-l img {
                display: inline !important;
            }

            .es-button-border {
                display: block !important;
            }

            a.es-button,
            button.es-button {
                font-size: 20px !important;
                display: block !important;
                border-width: 10px 20px 10px 20px !important;
            }

            .es-btn-fw {
                border-width: 10px 0px !important;
                text-align: center !important;
            }

            .es-adaptive table,
            .es-btn-fw,
            .es-btn-fw-brdr,
            .es-left,
            .es-right {
                width: 100% !important;
            }

            .es-content table,
            .es-header table,
            .es-footer table,
            .es-content,
            .es-footer,
            .es-header {
                width: 100% !important;
                max-width: 600px !important;
            }

            .es-adapt-td {
                display: block !important;
                width: 100% !important;
            }

            .adapt-img {
                width: 100% !important;
                height: auto !important;
            }

            .es-m-p0 {
                padding: 0px !important;
            }

            .es-m-p0r {
                padding-right: 0px !important;
            }

            .es-m-p0l {
                padding-left: 0px !important;
            }

            .es-m-p0t {
                padding-top: 0px !important;
            }

            .es-m-p0b {
                padding-bottom: 0 !important;
            }

            .es-m-p20b {
                padding-bottom: 20px !important;
            }

            .es-mobile-hidden,
            .es-hidden {
                display: none !important;
            }

            tr.es-desk-hidden,
            td.es-desk-hidden,
            table.es-desk-hidden {
                width: auto !important;
                overflow: visible !important;
                float: none !important;
                max-height: inherit !important;
                line-height: inherit !important;
            }

            tr.es-desk-hidden {
                display: table-row !important;
            }

            table.es-desk-hidden {
                display: table !important;
            }

            td.es-desk-menu-hidden {
                display: table-cell !important;
            }

            .es-menu td {
                width: 1% !important;
            }

            table.es-table-not-adapt,
            .esd-block-html table {
                width: auto !important;
            }

            table.es-social {
                display: inline-block !important;
            }

            table.es-social td {
                display: inline-block !important;
            }
        }

    </style>
</head>

        <table class="es-content esd-header-popover" cellspacing="0" cellpadding="0" align="center" width="600">
	<tbody style="background: aliceblue;"> 
		<tr>
			<td colspan="2" align="center">
				 ';
				 if($row['status']=="Processed"){
				     $mail_subject = 'Your Order has been proceed successfully | ONEGLOBALPHARMA.COM';
				     
				     $post_data = [
                        'username'=>'Newlands Pharmacy', 
                        'key'=>'Newlands Pharmacy@2022', 
                        'method'=>'http', 
                        'to'=>$rowsadd['phone'], 
                        'message'=>'Hello '.$rowsadd['fname'].', payment of $'.$total.' for invoice number #'.$smsinvid.' is received. Your order is being processed & will be shipped within 2 business days. -GlobalPharma', 
                        'senderid'=>'mycompany'];
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
                    // var_dump($postResult);
                
                
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                  CURLOPT_URL => "https://api.ultramsg.com/instance5491/messages/chat",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                  CURLOPT_POSTFIELDS => "token=mp15jsuyuzvpfrhz&to=".$rowsadd['phone']."&body=Hello ".$rowsadd['fname'].", payment of $".$total." for invoice number #".$smsinvid." is received. Your order is being processed and will be shipped within 2 business days. - GlobalPharma&priority=0&referenceId=",
                  CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded"
                  ),
                ));
                
                $response = curl_exec($curl);
                $err = curl_error($curl);
                
                curl_close($curl);
                
                if ($err) {
                //   echo "cURL Error #:" . $err;
                } else {
                //   echo $response;
                }
				     
				     $msg .= '
				     
				<tr>
                   <td class="esd-structure es-p5" style="background-color: #fefbfa;"
                      esd-general-paddings-checked="false" bgcolor="#fefbfa" align="left">
                      <table width="100%" cellspacing="0" cellpadding="0" style="padding: 3px;border: 1px solid #0a9d7b;">
                         <tbody>
                            <tr>
                                <td style="display:flex;width: 80%;">
                                    <img class="adapt-img" src="https://oneglobalpharma.com/assets/img/global-pharma-logo.png" alt width="130" style="display: block;">
                                </td>
                                <td style="text-align: center;width: 20%;background: #0a9d7b;color: #fff;">
                                    <p style="font-weight: 600;font-size: 14px;">'.$invid.'</p>
                                </td>
                            </tr>
                         </tbody>
                      </table>
                   </td>
                </tr>
                <br style="margin-bottom: -4px !important;">
                <tr>
                   <td class="esd-structure es-p20" align="left" bgcolor="#87c6ec" style="background-color: #87c6ec;">
                      <table cellpadding="0" cellspacing="0" width="100%">
                         <tbody>
                            <tr>
                               <td width="560" class="esd-container-frame" align="center" valign="top">
                                  <table cellpadding="0" cellspacing="0" width="100%">
                                     <tbody>
                                        <tr>
                                           <td align="center" style="background-color:#ffffff;border:1px solid #0a9d7b;margin-top:52px;padding: 0 19px;" class="esd-block-text">
                                              <p style="text-align: left;font-weight: 600;">Hello '.$rowsadd['fname'].' '.$rowsadd['lname'].'</p>
                                              <p style="text-align: left;">Thank you! We have received payment of $'.$total.' for your order, 
                                              placed on '.$date.'. We will update you with shipping details in 24 to 48 business hours.</p>
                                              
                                              <p style="text-decoration:underline;text-align: center;font-weight: 600;">Note: Name on bank statement for your order of $'.$total.' will be <span style="color:#0a9d7b;">Newlands Pharmacy</span>. 
                                              This name will also appear on your  credit or debit card statement</p>
                                              
                                              <p style="color: #0e810e;font-style: italic;font-weight: 900;font-size: 15px;text-decoration: underline;"><b>Sit back and Relax, Your order will be shipped in 2 business days.</b></p>
                                              
                                              <img src="https://i.ibb.co/Kj7v6zW/36035487-1.jpg" style="width: 245px;">
                                              
                                              
                                           </td>
                                        </tr>
                                     </tbody>
                                  </table>
                               </td>
                            </tr>
                         </tbody>
                      </table>
                   </td>
                </tr>
                <br>
                
                
                <tr><td style="padding-bottom: 10px;"></td></tr>     
				    ';
				 } else if($row['status']=="Shipped") {
				     $mail_subject = 'Your Order has been Shipped successfully | ONEGLOBALPHARMA.COM';
				     $post_data = [
                        'username'=>'Newlands Pharmacy', 
                        'key'=>'Newlands Pharmacy@2022', 
                        'method'=>'http', 
                        'to'=>$rowsadd['phone'], 
                        'message'=>'Congratulations '.$rowsadd['fname'].', your package of invoice number #'.$smsinvid.' is received. Your order is being processed & will be shipped within 2 business days. - GlobalPharma', 
                        'senderid'=>'mycompany'];
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
                    // var_dump($postResult);
                
                
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                  CURLOPT_URL => "https://api.ultramsg.com/instance5491/messages/chat",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                  CURLOPT_POSTFIELDS => "token=mp15jsuyuzvpfrhz&to=".$rowsadd['phone']."&body=Congratulations ".$rowsadd['fname'].", your package of invoice number #".$smsinvid." is shipped. Tracking number of your order will be generated in 24 to 48 business hours. - GlobalPharma&priority=0&referenceId=",
                  CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded"
                  ),
                ));
                
                $response = curl_exec($curl);
                $err = curl_error($curl);
                
                curl_close($curl);
                
                if ($err) {
                //   echo "cURL Error #:" . $err;
                } else {
                //   echo $response;
                }
				     $msg .= '
				     <tr>
                   <td class="esd-structure es-p5" style="background-color: #fefbfa;"
                      esd-general-paddings-checked="false" bgcolor="#fefbfa" align="left">
                      <table width="100%" cellspacing="0" cellpadding="0" style="padding: 3px;border: 1px solid #0a9d7b;">
                         <tbody>
                            <tr>
                                <td style="display:flex;width: 80%;">
                                    <img class="adapt-img" src="https://oneglobalpharma.com/assets/img/global-pharma-logo.png" alt width="130" style="display: block;">
                                </td>
                                <td style="text-align: center;width: 20%;background: #0a9d7b;color: #fff;">
                                    <p style="font-weight: 600;font-size: 14px;">'.$invid.'</p>
                                </td>
                            </tr>
                         </tbody>
                      </table>
                   </td>
                </tr>
                <br style="margin-bottom: -4px !important;">
                <tr>
                   <td class="esd-structure es-p20" align="left" bgcolor="#87c6ec" style="background-color: #87c6ec;">
                      <table cellpadding="0" cellspacing="0" width="100%">
                         <tbody>
                            <tr>
                               <td width="560" class="esd-container-frame" align="center" valign="top">
                                  <table cellpadding="0" cellspacing="0" width="100%">
                                     <tbody>
                                        <tr>
                                           <td align="center" style="background-color:#ffffff;border:1px solid #0a9d7b;margin-top:52px;padding: 0 19px;" class="esd-block-text">
                                              <p style="text-align: left;font-weight: 600;">Hello '.$rowsadd['fname'].' '.$rowsadd['lname'].'</p>
                                              <p style="text-align: left;">We are glad to inform you that we have shipped your order dated '.$date.' & we will 
                                              share the tracking details with you once it gets generated.</p>
                                              
                                              <p style="text-decoration:underline;text-align: center;font-weight: 600;">Note: Standard shipping time in the US to the US generally takes anywhere between 7-10 Days and Overseas takes between 15-20 Days.</p>
                                              
                                              <p style="color: #0e810e;font-style: italic;font-weight: 900;font-size: 15px;text-decoration: underline;"><b>Shipping process starts now!</b></p>
                                              
                                              
                                              
                                           </td>
                                        </tr>
                                     </tbody>
                                  </table>
                               </td>
                            </tr>
                         </tbody>
                      </table>
                   </td>
                </tr>
                <br>
                
                
                <tr><td style="padding-bottom: 10px;"></td></tr>     
				 ';
				 }
				 else if($row['status']=="Tracking") {
				     $mail_subject = 'Your Tracking Details has beed updated successfully | ONEGLOBALPHARMA.COM';
				     
				    
				     
				     $msg .= '
				     <tr>
                   <td class="esd-structure es-p5" style="background-color: #fefbfa;"
                      esd-general-paddings-checked="false" bgcolor="#fefbfa" align="left">
                      <table width="100%" cellspacing="0" cellpadding="0" style="padding: 3px;border: 1px solid #0a9d7b;">
                         <tbody>
                            <tr>
                                <td style="display:flex;width: 80%;">
                                    <img class="adapt-img" src="https://oneglobalpharma.com/assets/img/global-pharma-logo.png" alt width="130" style="display: block;">
                                </td>
                                <td style="text-align: center;width: 20%;background: #0a9d7b;color: #fff;">
                                    <p style="font-weight: 600;font-size: 14px;">'.$invid.'</p>
                                </td>
                            </tr>
                         </tbody>
                      </table>
                   </td>
                </tr>
                <br style="margin-bottom: -4px !important;">
                <tr>
                   <td class="esd-structure es-p20" align="left" bgcolor="#87c6ec" style="background-color: #87c6ec;">
                      <table cellpadding="0" cellspacing="0" width="100%">
                         <tbody>
                            <tr>
                               <td width="560" class="esd-container-frame" align="center" valign="top">
                                  <table cellpadding="0" cellspacing="0" width="100%">
                                     <tbody>
                                        <tr>
                                           <td align="center" style="background-color:#ffffff;border:1px solid #0a9d7b;margin-top:52px;padding: 0 19px;" class="esd-block-text">
                                              <p style="text-align: center;font-weight: 600;">Hello '.$rowsadd['fname'].' '.$rowsadd['lname'].'</p>
                                              <p style="text-align: center;font-weight: 600;">Your Order Is On Its Way</p>
                                              <p style="text-align:center">Tracking progress of your order is just a click away</p>
                                              
                                              <p style="text-decoration:underline;text-align: center;font-weight: 600;">Note: Standard shipping time in the US 
                                              to US roughly takes 7 to 9 days & Overseas takes between 15 to 18 days.</p>
                                              
                                              <p style="color:#0e810e;font-weight:900;font-size:15px;"><b>Tracking order is now at your fingertips.</b></p>
                                              
                                              <img src="https://gcdnb.pbrd.co/images/yXUMoXstPPe2.jpg?o=1" style="width: 245px;">
                                              
                                              
                                           </td>
                                        </tr>
                                     </tbody>
                                  </table>
                               </td>
                            </tr>
                         </tbody>
                      </table>
                   </td>
                     
				
				     
				     
				     <tr>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td class="esd-structure es-p20t es-p25b es-p20r es-p20l" esd-general-paddings-checked="false"
                        style="background-color: #335e90; padding:10px 25px !important;" bgcolor="#335e90" align="left">
                        <table width="100%" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td class="esd-container-frame" width="560" valign="top" align="center">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td align="center" class="esd-block-text es-p15t">
                                                            ';
                                                            
                                                            if($row['status']=="Tracking" || $row['status']=="Delivered") {
                            									foreach($tids as $key=> $value):
                            										if(empty($value['tracking_link'])) {
                            											$msg .= '<br>'.$value['tracking_id'].''.($key+1).'. <a href="https://t.17track.net/en#nums='.$value['tracking_id'].'" style="border-radius:5px;text-decoration: none;font-weight:bold;padding:12px;border-width:10px 20px;color:#ffffff;background:#001100;border-color:#001100;display: inline-block;width:fit-content;margin:11px 5px;">Package - </a>';
                            										} else {
                            											$msg .= '<a href="'.$value['tracking_link'].'" style="border-radius:5px;text-decoration: none;font-weight:bold;padding:12px;border-width:10px 20px;color:#ffffff;background:#001100;border-color:#001100;display: inline-block;width:fit-content;margin:11px 5px;">Package - '.$value['tracking_id'].'</a>';
                            											$trackingid = strval($value['tracking_id']);
                                                            $name  =$rowsadd['fname']." ".$rowsadd['lname'];
                                                            $phones = '+'.$rowsadd['phone'];
                                                            $email = $rowsadd['email'];
                                                            
                                                            $curl = curl_init();
                                                                curl_setopt_array($curl, array(
                                                                CURLOPT_URL => "https://hideuri.com/api/v1/shorten",
                                                                CURLOPT_RETURNTRANSFER => true,
                                                                CURLOPT_ENCODING => "",
                                                                CURLOPT_MAXREDIRS => 10,
                                                                CURLOPT_TIMEOUT => 30,
                                                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                                CURLOPT_CUSTOMREQUEST => "POST",
                                                                CURLOPT_POSTFIELDS => "url=https://Newlands Pharmacy4d.aftership.com/".str_replace(" ","",$trackingid)."",
                                                                CURLOPT_HTTPHEADER => array(
                                                                    "content-type: application/x-www-form-urlencoded"
                                                                ),
                                                                ));
                                                                $response = curl_exec($curl);
                                                                $err = curl_error($curl);
                                                                curl_close($curl);
                                                                if ($err) {
                                                                echo "cURL Error #:" . $err;
                                                                } else {
                                                                $trackURL = json_decode($response, true)['result_url'];
                                                            }
                                                            
                                        				     
                                        				     $post_data = [
                                                                'username'=>'Newlands Pharmacy', 
                                                                'key'=>'Newlands Pharmacy@2022', 
                                                                'method'=>'http', 
                                                                'to'=>$rowsadd['phone'], 
                                                                'message'=>'Hello '.$rowsadd['fname'].', the tracking id of your invoice number #'.$smsinvid.' has been successfully generated. ('.$trackURL.'). Tracking will be live within 2 business days. - GlobalPharma', 
                                                                'senderid'=>'mycompany'];
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
                                                            // var_dump($postResult);
                                                        
                                                        
                                                        $curl = curl_init();
                                                        
                                                        curl_setopt_array($curl, array(
                                                          CURLOPT_URL => "https://api.ultramsg.com/instance5491/messages/chat",
                                                          CURLOPT_RETURNTRANSFER => true,
                                                          CURLOPT_ENCODING => "",
                                                          CURLOPT_MAXREDIRS => 10,
                                                          CURLOPT_TIMEOUT => 30,
                                                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                          CURLOPT_CUSTOMREQUEST => "POST",
                                                          CURLOPT_POSTFIELDS => "token=mp15jsuyuzvpfrhz&to=".$rowsadd['phone']."&body=Hello ".$rowsadd['fname'].", the tracking id of your invoice number #".$smsinvid." has been successfully generated. (".$trackURL."). Tracking will be live within 2 business days. - GlobalPharma&priority=0&referenceId=",
                                                          CURLOPT_HTTPHEADER => array(
                                                            "content-type: application/x-www-form-urlencoded"
                                                          ),
                                                        ));
                                                        
                                                        $response = curl_exec($curl);
                                                        $err = curl_error($curl);
                                                        
                                                        curl_close($curl);
                                                        
                                                        if ($err) {
                                                        //   echo "cURL Error #:" . $err;
                                                        } else {
                                                        //   echo $response;
                                                        }
                            								
                                                            
                                                            $curl = curl_init();
                                                            curl_setopt_array($curl, [
                                                              CURLOPT_URL => "https://api.aftership.com/v4/trackings",
                                                              CURLOPT_RETURNTRANSFER => true,
                                                              CURLOPT_ENCODING => "",
                                                              CURLOPT_MAXREDIRS => 10,
                                                              CURLOPT_TIMEOUT => 30,
                                                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                              CURLOPT_CUSTOMREQUEST => "POST",
                                                              CURLOPT_POSTFIELDS => "{\"tracking\":{\"title\":\"$name\",\"tracking_number\":\"$trackingid\",\"smses\":[\"$phones\"],\"emails\":\"$email\",\"order_number\":\"$smsinvid\",\"customer_name\":\"$name\"}}",
                                                              CURLOPT_HTTPHEADER => [
                                                                "Accept: application/json",
                                                                "Content-Type: application/json",
                                                                "aftership-api-key: e3770e63-5b2c-4d63-8e65-dec689bf6d17"
                                                              ],
                                                            ]);
                                                            
                                                            $response = curl_exec($curl);
                                                            $err = curl_error($curl);
                                                            
                                                            curl_close($curl);
                                                            
                                                            if ($err) {
                                                            //   echo "cURL Error #:" . $err;
                                                            } else {
                                                            //   echo "<pre>";
                                                            //   var_dump($response);
                                                            }
                                                            
                            										}
                            									endforeach;
                            								} 
                            								
                            								addTrackingTimeLine($trackingid, $smsinvid);
                            								
                            								
                                                            $msg.='
                                                                
                                                                
                                                        </p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
				
                
                <tr><td style="padding-bottom: 10px;"></td></tr>  ';
				 }
				  else {
				      $mail_subject = 'Your Order with ONE Newlands Pharmacy is Delivered | ONEGLOBALPHARMA.COM';
				      $post_data = [
                        'username'=>'Newlands Pharmacy', 
                        'key'=>'Newlands Pharmacy@2022', 
                        'method'=>'http', 
                        'to'=>$rowsadd['phone'], 
                        'message'=>'Hello'.$rowsadd['fname'].', your package of invoice number #'.$smsinvid.' has been successfully delivered. Thank you for your vote of confidence. We’d love to hear about your overall experience of shopping with GlobalPharma', 
                        'senderid'=>'mycompany'];
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
                    // var_dump($postResult);
                
                
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                  CURLOPT_URL => "https://api.ultramsg.com/instance5491/messages/chat",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                  CURLOPT_POSTFIELDS => "token=mp15jsuyuzvpfrhz&to=".$rowsadd['phone']."&body=Hello ".$rowsadd['fname'].", your package of invoice number #".$smsinvid." has been successfully delivered. Thank you for your vote of confidence. We’d love to hear about your overall experience of shopping with GlobalPharma&priority=0&referenceId=",
                  CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded"
                  ),
                ));
                
                $response = curl_exec($curl);
                $err = curl_error($curl);
                
                curl_close($curl);
                
                if ($err) {
                //   echo "cURL Error #:" . $err;
                } else {
                //   echo $response;
                }
				     $msg .= '
				     <tr>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td class="esd-structure es-p20t es-p25b es-p20r es-p20l" esd-general-paddings-checked="false"
                        style="background-color: #ffffff;padding: 0;" bgcolor="#335e90" align="left">
                        <table width="100%" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td class="esd-container-frame" width="560" valign="top" align="center">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td align="center" class="esd-block-text es-p15t">
                                                        <tr>
                   <td class="esd-structure es-p5" style="background-color: #fefbfa;"
                      esd-general-paddings-checked="false" bgcolor="#fefbfa" align="left">
                      <table width="100%" cellspacing="0" cellpadding="0" style="padding: 3px;border: 1px solid #0a9d7b;">
                         <tbody>
                            <tr>
                                <td style="display:flex;width: 80%;">
                                    <img class="adapt-img" src="https://oneglobalpharma.com/assets/img/global-pharma-logo.png" alt width="130" style="display: block;">
                                </td>
                                <td style="text-align: center;width: 20%;background: #0a9d7b;color: #fff;">
                                    <p style="font-weight: 600;font-size: 14px;">'.$invid.'</p>
                                </td>
                            </tr>
                         </tbody>
                      </table>
                   </td>
                </tr>
                <br style="margin-bottom: -4px !important;">
                <tr>
                   <td class="esd-structure es-p20" align="left" bgcolor="#87c6ec" style="background-color: #87c6ec;">
                      <table cellpadding="0" cellspacing="0" width="100%">
                         <tbody>
                            <tr>
                               <td width="560" class="esd-container-frame" align="center" valign="top">
                                  <table cellpadding="0" cellspacing="0" width="100%">
                                     <tbody>
                                        <tr>
                                           <td align="center" style="background-color:#ffffff;border:1px solid #0a9d7b;margin-top:52px;padding: 0 19px;" class="esd-block-text">
                                              <p style="text-align: left;font-weight: 600;">Hello '.$rowsadd['fname'].' '.$rowsadd['lname'].'</p>
                                              <p style="text-align: left;font-weight: 600;">Hope you\'re doing well.</p>
                                              <p style="text-align: left;">Congratulations, your order has been delivered. 
                                              If you have any suggestion/query regarding your package/order feel free to contact 
                                              us through call, email or WhatsApp</p>
                                              
                                              <p style="text-decoration:underline;text-align: center;font-weight: 600;">Note: Name on bank statement for your order of $'.$total.' will be <span style="color:#0a9d7b;">Newlands Pharmacy</span>. 
                                              This name will also appear on your  credit or debit card statement</p>
                                              
                                              
                                              <img src="https://gcdnb.pbrd.co/images/EfgVoG1NuHG6.jpg?o=1" style="width: 245px;">
                                              
                                           </td>
                                        </tr>
                                     </tbody>
                                  </table>
                               </td>
                            </tr>
                         </tbody>
                      </table>
                   </td>
                </tr>
                <br>
                
                
                <tr><td style="padding-bottom: 10px;"></td></tr>     
				
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
				
                <tr><td style="padding-bottom: 10px;"></td></tr>  ';
				 }
				 
		$msg .='
			';
				 
				 
		 $msg .='
			</td>
		</tr>
		
		<td style="padding: 17px 20px 13px 20px;background: #fff;border: 1px solid #0a9d7b;">';
					
				
				if($row['status']=="Processed"){
                	$msg .= '
                		<img src="https://oneglobalpharma.com/assets/img/preceed1.png" style="width:100%; margin: 0 auto;">
                	';
                	} else if($row['status']=="Shipped") {
                	$msg .= '
                		<img src="https://oneglobalpharma.com/assets/img/shipped1.png" style="width:100%; margin: 0 auto;">
                	';
                	}
                	else if($row['status']=="Tracking") {
                	$msg .= '
                		<img src="https://oneglobalpharma.com/assets/img/tracking1.png" style="width:100%; margin: 0 auto;">
                	';
                	}
                	else{
                	$msg .= '
                		<img src="https://oneglobalpharma.com/assets/img/delivered1.png" style="width:100%; margin: 0 auto;">
                	';
                }
				
				$msg.='
						<br>
					</td>
				</tr>
				<br>
				<tr>
					<td style="padding-top: 0px;" colspan="2">
						<table cellspacing="0" border="0" cellpadding="0" width="550px" align="center" >
							<tr>
								<td></td>
								<td></td>';
								
								if($row['status']=="Tracking" || $row['status']=="Delivered") {
									$msg .= '<td style="text-align: center;position: relative;right: -46px;color: #00a820;"></td>';
								} else {
									$msg .= '<td></td>';
								}
								$msg .='<td></td>
							</tr>
							
							<tr>';
							
								
								$msg .= '</tr>
										<tr>';
								
				
				
				
						$msg .= '</tr>
							<tr>
							<td></td>
								<td colspan="2" style=" display: flex; flex-direction: inherit; align-items: start; ">';
								
								// if($row['status']=="Tracking" || $row['status']=="Delivered") {
									
								// 	foreach($tids as $key=> $value):
								// 		if(empty($value['tracking_link'])) {
								// 			$msg .= '<br>'.$value['tracking_id'].''.($key+1).'. <a href="https://t.17track.net/en#nums='.$value['tracking_id'].'" style="margin-bottom: 10px;color: #fff;text-decoration: none;background-color: #8cb3ff;padding: 5px 21px;border-radius: 3px;display: inline-block;">Track Now</a>';
								// 		} else {
								// 			$msg .= '<a href="'.$value['tracking_link'].'" style="margin-bottom:10px;color:#fff;display: block;margin: 0 auto;margin-top: 37px;width: fit-content;text-decoration:none;background-color: #007cf5;font-size: 17px;padding: 3px 30px;">Track Now '.($key+1).'</a>';
								// 		}
								// 	endforeach;
								// } 
								
								$msg .='</td>
								<td></td>
								
							</tr>
						</table>
					</td>
				</tr>
				<br>
				<tr>
                    <td class="esd-structure es-p20" esd-general-paddings-checked="false"
                        style="background-color:#f8f8f8;padding:20px!important;border: 1px solid #0e810e;" bgcolor="#f8f8f8"  esd-custom-block-id="482536">
                        <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]-->
                        <span class="es-button-border" style="border-radius: 5px; background: #010101;"> 
                                        <a href="https://oneglobalpharma.com/confirm/receive_order/'.str_replace("#","",$invid).'" style="border-radius:5px!important;font-weight:bold!important;padding: 4px 8px!important;text-decoration:none!important;border-width:10px 20px!important;color:#ffffff!important;background: #b1b1b1!important;border-color: #008b00!important;display:block!important;width:fit-content!important;margin:11px auto!important">
                                            Terms & Condition
                                        </a>
                                      </span>
                        <table class="es-left" cellspacing="0" cellpadding="0" style="width:100%; margin:0 auto; display: block;">
                            <tbody>
                                <tr>
                                    <td class="es-m-p20b esd-container-frame" width="270">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-block-text es-p10b" align="center">
                                                        <h3 style="color:#2b3445;margin: 0;">24/7 assistance</h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="esd-block-text" align="center" esd-links-color="#335e90">
                                                        <p style="line-height:150%;color:#242424;margin: 0;">Call <a
                                                                target="_blank"
                                                                style="line-height: 150%; color: #335e90;"
                                                                href="tel:13155154364">+1 315 515
                                                                4364<br></a>Email&nbsp;<a target="_blank"
                                                                style="color: #335e90;"
                                                                href="mailto:admin@oneglobalpharma.com">admin@oneglobalpharma.com</a>
                                                            or<br><a target="_blank" href=""
                                                                style="color: #335e90;">Visit Newlands Pharmacy</a> for
                                                            expert assistance.</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]-->
                        <table class="es-right" cellspacing="0" cellpadding="0" style="width:100%; margin:0 auto; display: block;">
                            <tbody>
                                <tr>
                                    <td class="esd-container-frame" width="270">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-block-text es-p10b" align="center">
                                                        <h3 style="color: #2b3445; margin: 0;">Our guarantee</h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="esd-block-text" align="center" esd-links-color="#335e90">
                                                        <p style="line-height:150%;color:#242424;margin: 0;">Your satisfaction
                                                            is 100% guaranteed.</p>
                                                        <p style="line-height:150%;color:#242424;margin: 0;">See our <a
                                                                target="_blank"
                                                                href="https://oneglobalpharma.com/order_return"
                                                                style="color: #335e90;">Returns and Exchanges
                                                                policy.</a></p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--[if mso]></td></tr></table><![endif]-->
                    </td>
                </tr>
                
                
                <br>
        
                <tr>
                    <td class="esd-structure es-p20t es-p20r es-p20l" align="left" bgcolor="#010101"
                        style="background-color: #ffffff;border: 1px solid #0e810e;" esd-custom-block-id="481465">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td width="560" class="esd-container-frame" align="center" valign="top">
                                        <table cellpadding="0" cellspacing="0" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-block-text" align="center">
                                                        <p><strong><a target="_blank" style="line-height: 150%;"
                                                                    href="https://oneglobalpharma.com/allmeds">Browse
                                                                    all medicines</a></strong></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" class="esd-block-text es-p20t es-p20b"
                                                        esd-links-underline="none">
                                                        <p style="line-height: 1;color: #000; margin: 0;">Global
                                                            Pharma,<br>Ohio, USA<br><br></p>
                                                        <p style="line-height: 1;color: #000; margin: 0;"><a target="_blank"
                                                                href="tel:13155154364" style="text-decoration: none;">+1
                                                                315 515 4364</a></p>
                                                        <p style="line-height: 1;color: #000; margin: 0;"><a target="_blank"
                                                                href="mailto:admin@oneglobalpharma.com"
                                                                style="line-height: 120%; text-decoration: none;">admin@oneglobalpharma.com</a>
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="esd-block-text es-p10t es-p10b" align="center">
                                                        <p style="color: #000;"><em><span
                                                                    style="font-size: 11px; line-height: 150%;">You are
                                                                    receiving this email because you have visited our
                                                                    site or ordered product from our site</span></em>
                                                        </p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
				
				
			</table>
			</td>
		</tr>
	</tbody>
</table>';


sendmail("orderonline@oneglobalpharma.com", "Newlands Pharmacy", $toemail, $mail_subject, (string) $msg);
// include('/home/oneglobalpharma/public_html/securecrm/0webapi/api/classes/sendMail.php');
// sendGridMailSender($mail_subject, $toemail, $name, (string) $msg);

function getDateForSpecificDayBetweenDates($startDate, $endDate, $weekdayNumber){
            $startDate = strtotime($startDate);
            $endDate = strtotime($endDate);

            $dateArr = array();

            do
            {
                if (date("w", $startDate) != $weekdayNumber)
                {
                    $startDate += (24 * 3600); // add 1 day
                    
                }
            }
            while (date("w", $startDate) != $weekdayNumber);

            while ($startDate <= $endDate)
            {
                $dateArr[] = date('Y-m-d', $startDate);
                $startDate += (7 * 24 * 3600); // add 7 days
                
            }

            return ($dateArr);
        }
        
    function getDateData($date, $totalDays, $s, $t, $tl, $d){

        $Date = $date;
        $datefirst = date('Y-m-d', strtotime($Date . ' + 0 days'));
        $datesec = date('Y-m-d', strtotime($Date . ' + '.$totalDays.' days'));

        

        // echo "Start Date: " . $datefirst . "<br>";
        // echo "Last Date: " . $datesec;

        $sun = getDateForSpecificDayBetweenDates($datefirst, $datesec, 0);
        $sat = getDateForSpecificDayBetweenDates($datefirst, $datesec, 6);

        $weekend = array_merge($sat, $sun);

        $totalExtraDays = count($weekend);

        $days = $totalDays;
        $datefirst = date('Y-m-d', strtotime($Date . ' + 0 days'));
        $datesec = date('Y-m-d', strtotime($Date . ' + '.($days+$totalExtraDays).' days'));

        $start = new DateTime($datefirst);
        $end = new DateTime($datesec);
        $interval = new DateInterval("P1D");
        $range = new DatePeriod($start, $interval, $end);
        $i=0;

        $shippingDate;
        $trackingDate;
        $trackingLiveDate;
        $deliveringDate;

        $shipping = $s;
        $tracking = $t+$shipping;
        $trackingLive = $tl+$tracking;
        $delivering = $d+$trackingLive;
        foreach ($range as $date) {
            if($i==$shipping){
                if(in_array($date->format("Y-m-d"), $weekend)){
                    ++$shipping;
                    ++$tracking;
                    ++$trackingLive;
                    ++$delivering;
                }else {
                    $shippingDate=$date->format("Y-m-d");
                }
            }
            elseif($i==$tracking){
                if(in_array($date->format("Y-m-d"), $weekend)){
                    ++$tracking;
                    ++$trackingLive;
                    ++$delivering;
                    
                }else {
                    $trackingDate=$date->format("Y-m-d");
                }
            }
            elseif($i==$trackingLive){
                if(in_array($date->format("Y-m-d"), $weekend)){
                    ++$trackingLive;
                    ++$delivering;
                }else {
                    $trackingLiveDate=$date->format("Y-m-d");
                }
            }
            else{
                if(in_array($date->format("Y-m-d"), $weekend)){
                    ++$delivering;
                }else {
                    $deliveringDate=$date->format("Y-m-d");
                }
            }
            if(in_array($date->format("Y-m-d"), $weekend)){
                $is = "week";
            }else {
                $is ='';
            }++$i;
        }

        $orderTimeline = array(
            array('Processed', $datefirst, 0),
            array('Shipped', $shippingDate, $shipping),
            array('Tracking', $trackingDate, $tracking),
            array('Trackinglive', $trackingLiveDate, $trackingLive),
            array('Delivered', $deliveringDate, $delivering)
        );

        return $orderTimeline;

    }


if($row['status']=="Processed"){
    $servername = "localhost";
    $username = "onegloba_glomedz";
    $password = "Kumarakshay@195";
    $dbname = "onegloba_globalmedz";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    $selectOrder = $conn->prepare('SELECT * FROM orders WHERE orderno=?');
    $selectOrder->execute([$smsinvid]);
    $totalRow = $selectOrder->rowCount();
    $selectOrder->execute();
    $totalRow = $selectOrder->rowCount();
    while($row=$selectOrder->fetch(PDO::FETCH_ASSOC)){
        $orderno = $row['orderno'];
        $paymentDate = $row['paymentDate'];
        $id = $row['id'];
        $selectFromtimeline = $conn->prepare('SELECT * FROM ordertimeline WHERE orderid = ?');
        $selectFromtimeline->execute([$orderno]);
        $isTimeline = $selectFromtimeline->rowCount();
        if($isTimeline<1){
            

            $payDate = strtotime($paymentDate); 
            $payDate = date('Y-m-d', $payDate);

            $selectProductName = $conn->prepare('SELECT * FROM order_details LEFT JOIN subcategory ON order_details.pid = subcategory.sid WHERE order_details.order_id=?');
            $selectProductName->execute([$id]);
            // echo "<b>Order Number: ".$orderno."</b><br>";;
            while($rowPro = $selectProductName->fetch(PDO::FETCH_ASSOC)){
                $productName = $rowPro['productname'];
                // echo $productName."<br>";
                if(strpos($productName, 'to US')){
                    $orderTimeline = getDateData($payDate, 7, 1, 2, 1, 3);
    
                    foreach($orderTimeline AS $orderMeta){
                        $insertRecord = $conn->prepare('INSERT INTO ordertimeline(orderid, productname, status, expected_date, total_days, pos, type) VALUE(?,?,?,?,?,?,?)');
                        $insertRecord->execute([$orderno, $productName, $orderMeta[0], $orderMeta[1],$orderMeta[2], 'med', 'US to US']);
                    }
    
                }else {
                    $orderTimeline = getDateData($payDate, 16, 2, 2, 2, 10);
                    
                    foreach($orderTimeline AS $orderMeta){
                        $insertRecord = $conn->prepare('INSERT INTO ordertimeline(orderid, productname, status, expected_date, total_days, pos, type) VALUE(?,?,?,?,?,?,?)');
                        $insertRecord->execute([$orderno, $productName, $orderMeta[0], $orderMeta[1],$orderMeta[2],'med', 'Generic']);
                    }
                }
                // echo "<br><br><pre>";
                // print_r($orderTimeline);
                // echo "</pre>";
                
            }
            // echo "<br><hr>";
            


            // echo "<br><br><pre>";
            // print_r($orderTimeline);
        }
    }
    // echo $totalRow;



}
    function addTrackingTimeLine($tracking_number, $orderno){
	    
	    function getDateForSpecificDayBetweenDates1($startDate, $endDate, $weekdayNumber){
            $startDate = strtotime($startDate);
            $endDate = strtotime($endDate);

            $dateArr = array();

            do
            {
                if (date("w", $startDate) != $weekdayNumber)
                {
                    $startDate += (24 * 3600); // add 1 day
                    
                }
            }
            while (date("w", $startDate) != $weekdayNumber);

            while ($startDate <= $endDate)
            {
                $dateArr[] = date('Y-m-d', $startDate);
                $startDate += (7 * 24 * 3600); // add 7 days
                
            }

            return ($dateArr);
        }
        
        function getDateData1($date, $totalDays, $tl, $d){

            $Date = $date;
            $datefirst = date('Y-m-d', strtotime($Date . ' + 0 days'));
            $datesec = date('Y-m-d', strtotime($Date . ' + '.$totalDays.' days'));
    
            
    
            // echo "Start Date: " . $datefirst . "<br>";
            // echo "Last Date: " . $datesec;
    
            $sun = getDateForSpecificDayBetweenDates1($datefirst, $datesec, 0);
            $sat = getDateForSpecificDayBetweenDates1($datefirst, $datesec, 6);
    
            $weekend = array_merge($sat, $sun);
    
            $totalExtraDays = count($weekend);
    
            $days = $totalDays;
            $datefirst = date('Y-m-d', strtotime($Date . ' + 0 days'));
            $datesec = date('Y-m-d', strtotime($Date . ' + '.($days+$totalExtraDays).' days'));
    
            $start = new DateTime($datefirst);
            $end = new DateTime($datesec);
            $interval = new DateInterval("P1D");
            $range = new DatePeriod($start, $interval, $end);
            $i=0;
    
            $shippingDate;
            $trackingDate;
            $trackingLiveDate;
            $deliveringDate;
            
            $trackingLive = $tl;
            $delivering = $d+$trackingLive;
            foreach ($range as $date) {
                if($i==$trackingLive){
                    if(in_array($date->format("Y-m-d"), $weekend)){
                        ++$trackingLive;
                        ++$delivering;
                    }else {
                        $trackingLiveDate=$date->format("Y-m-d");
                    }
                }
                else{
                    if(in_array($date->format("Y-m-d"), $weekend)){
                        ++$delivering;
                    }else {
                        $deliveringDate=$date->format("Y-m-d");
                    }
                }
                if(in_array($date->format("Y-m-d"), $weekend)){
                    $is = "week";
                }else {
                    $is ='';
                }++$i;
            }
    
            $orderTimeline = array(
                array('Trackinglive', $trackingLiveDate, $trackingLive),
                array('Delivered', $deliveringDate, $delivering)
            );
    
            return $orderTimeline;

    }
        
	    
	    $productName = 
	    $servername = "localhost";
        $username = "onegloba_glomedz";
        $password = "Kumarakshay@195";
        $dbname = "onegloba_globalmedz";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    
        $date = date('Y-m-d');
        $trackingnumber = str_replace(" ","",$tracking_number);
        $checkTrack = $conn->prepare('SELECT * FROM ordertimeline WHERE productname=?');
        $checkTrack->execute([$trackingnumber]);
        $totalTrack=$checkTrack->rowCount();
        if($totalTrack<1){
            if(strpos($trackingnumber, 'EM') OR strpos($trackingnumber, 'IN') OR strpos($trackingnumber, 'RM')){
            	$orderTimeline = getDateData1($date, 12, 2,10);
                foreach($orderTimeline AS $orderMeta){
                    $insertRecord = $conn->prepare('INSERT INTO ordertimeline(orderid, productname, currentStatus, status, expected_date, total_days, pos, type) VALUE(?,?,?,?,?,?,?,?)');
                    $insertRecord->execute([$orderno, $trackingnumber, 'Tracking', $orderMeta[0], $orderMeta[1],$orderMeta[2], 'track', 'Genric']);
                }
            }else{
            	$orderTimeline = getDateData1($date, 4, 1, 3);
                foreach($orderTimeline AS $orderMeta){
                    $insertRecord = $conn->prepare('INSERT INTO ordertimeline(orderid, productname, currentStatus, status, expected_date, total_days, pos, type) VALUE(?,?,?,?,?,?,?,?)');
                    $insertRecord->execute([$orderno, $trackingnumber, 'Tracking',  $orderMeta[0], $orderMeta[1],$orderMeta[2], 'track','US to US']);
                }
            }
        }
	
}
?>