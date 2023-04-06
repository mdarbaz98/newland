<?php
$sql = 'SELECT * FROM `tbl_manual_order` WHERE id="'.$id.'"';
$result = $db->query($sql);
$row = $result->fetch_assoc();
$toemail = $row['cemail'];
$invid = "#INV-".$row['id']."".substr(strtotime($row["timestamp"]), 0, 4);

$tids = array();
$tsql = "SELECT * FROM `tbl_traking_ids` WHERE order_id='M_".$id."'";
$tresult = $db->query($tsql);
while($rows1 = $tresult->fetch_assoc()) {
	array_push($tids, $rows1['tracking_id']);
}
				


$str = '';
$str .='<tr>
			<td>'.$row['pname'].'</td>
			<td>'.$row['pqty'].'</td>
			<td>$'.$row['ptot'].'</td>
			<td>$'.$row['ptot'].'</td>
		  </tr>';
		  $total = $row['ptot'];
		  
$str .= '<tr>
			<td></td>
			<th colspan="2" align="right" style="border-top:2px solid gray;"><b>Sub Total: </b></th>
			<td style="border-top:2px solid gray;">$'.$total.'</td>
		</tr>';
		
		
	if($total>350) {
		$str .= '<tr>
					<th colspan="3" align="right"><b>Shipping Free: </b></th>
					<td>$00.00</td>
				</tr>';
	} else {
		$str .= '<tr>
					<th colspan="3" align="right"><b>Shipping: </b></th>
					<td>$20.00</td>
				</tr>';
	}
	$dis = 00;
	if($total>350) {
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
				<td>$'.($total+20).'</td>
			</tr>';
			$total = $total+20;
	}
		
				
				
				
$msg ='';

$msg .='<table class="es-content esd-header-popover" cellspacing="0" cellpadding="0" align="center" width="600">
	<tbody>
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
                                    <p style="font-weight: 600;font-size: 14px;">'."INV-".$row['id']."".substr(strtotime($row["timestamp"]), 0, 4).'</p>
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
                                              <p style="text-align: left;font-weight: 600;">Hello '.$row['cname'].'</p>
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
		<br>
		<tr>
			<td colspan="2" class="esd-structure es-p20t es-p20r es-p20l" align="left" bgcolor="#010101"
                        style="background-color: #ffffff;border: 1px solid #0e810e; padding: 9px 16px;" esd-custom-block-id="481465">
			    <img src="https://oneglobalpharma.com/assets/img/delivered1.png" style="width:100%; margin: 0 auto;">
			</td>
		</tr>
		<br>
		<tr>
                    <td class="esd-structure es-p20t es-p25b es-p20r es-p20l" esd-general-paddings-checked="false"
                        style="padding:3px;background: #fff;border:1px solid #0a9d7b" bgcolor="#335e90" align="left">
                        <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]-->
                        <span class="es-button-border" style="border-radius: 5px; background: #010101;"> 
                                        <a href="https://oneglobalpharma.com/confirm/receive_order/'.str_replace("#","",$invid).'" style="border-radius:5px!important;font-weight:bold!important;padding: 4px 8px!important;text-decoration:none!important;border-width:10px 20px!important;color:#ffffff!important;background: #b1b1b1!important;border-color: #008b00!important;display:block!important;width:fit-content!important;margin:11px auto!important">
                                            Terms & Condition
                                        </a>
                                      </span>
                        <table class="es-left" cellspacing="0" cellpadding="0" align="left">
                            <tbody>
                                <tr>
                                    <td class="es-m-p20b esd-container-frame" width="270" align="left">
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
                        <table class="es-right" cellspacing="0" cellpadding="0" align="right">
                            <tbody>
                                <tr>
                                    <td class="esd-container-frame" width="270" align="left">
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
                    <td colspan="2" class="esd-structure es-p20t es-p20r es-p20l" align="left" bgcolor="#010101"
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

sendmail("admin@globalpharmameds.com", "Newlands Pharmacy", $toemail, "Your Order Delivered Successfully | Globalpharmameds.com", $msg);
// include('/home/oneglobalpharma/public_html/securecrm/0webapi/api/classes/sendMail.php');
// sendGridMailSender("Your Order Delivered Successfully | Globalpharmameds.com", $toemail, $row['cname'], (string) $msg);
$post_data = [
                        'username'=>'Newlands Pharmacy', 
                        'key'=>'Newlands Pharmacy@2022', 
                        'method'=>'http', 
                        'to'=>$row['cmono'], 
                        'message'=>'Hello'.explode(" ",$row['cname'])[0].', your package of invoice number #'.$invid.' has been successfully delivered. Thank you for your vote of confidence. We’d love to hear about your overall experience of shopping with GlobalPharma', 
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
                  CURLOPT_POSTFIELDS => "token=mp15jsuyuzvpfrhz&to=".$row['cmono']."&body=Hello ".explode(" ",$row['cname'])[0].", your package of invoice number #".$invid." has been successfully delivered. Thank you for your vote of confidence. We’d love to hear about your overall experience of shopping with GlobalPharma&priority=0&referenceId=",
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
?>