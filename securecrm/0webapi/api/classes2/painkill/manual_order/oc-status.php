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
				<td>$'.($total+25).'</td>
			</tr>';
			$total = $total+25;
	}
		
				
				
				
$msg ='';

$msg .='<table class="es-content esd-header-popover" cellspacing="0" cellpadding="0" align="center" width="600">
	<tbody>
		<tr>
			<td colspan="2" style="background-color:#fff">
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
		
		
		
		<tr>
			<td colspan="2" align="center">
			';
			if($row['pprice']=="Processed"){
				     $mail_subject = 'Your Order has been proceed successfully | ONEGLOBALPHARMA.COM';
				     
				     $post_data = [
                        'username'=>'Newlands Pharmacy', 
                        'key'=>'Newlands Pharmacy@2022', 
                        'method'=>'http', 
                        'to'=>$row['cmono'], 
                        'message'=>'Hello '.explode(" ",$row['cname'])[0].', payment of $'.$total.' for invoice number #'.$invid.' is received. Your order is being processed & will be shipped within 2 business days. -GlobalPharma', 
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
                  CURLOPT_POSTFIELDS => "token=mp15jsuyuzvpfrhz&to=".$row['cmono']."&body=Hello ".explode(" ",$row['cname'])[0].", payment of $".$total." for invoice number #".$invid." is received. Your order is being processed and will be shipped within 2 business days. - GlobalPharma&priority=0&referenceId=",
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
				        <table cellpadding="0" cellspacing="0" width="100%">
                                         <tbody>
                                            <tr>
                                               <td align="center" style="background-color:#ffffff;border:1px solid #0a9d7b;margin-top:52px;padding: 0 19px;" class="esd-block-text">
                                                  <p style="text-align: left;font-weight: 600;">Hello '.$row['cname'].'</p>
                                                  <p style="text-align: left;">Thank you! We have received payment of $'.$total.' for your order, 
                                                  placed on '.date("d M, Y", strtotime($row['paymentDate'])).'. We will update you with shipping details in 24 to 48 business hours.</p>
                                                  
                                                  <p style="text-decoration:underline;text-align: center;font-weight: 600;">Note: Name on bank statement for your order of $'.$total.' will be <span style="color:#0a9d7b;">Newlands Pharmacy</span>. 
                                                  This name will also appear on your  credit or debit card statement</p>
                                                  
                                                  <p style="color: #0e810e;font-style: italic;font-weight: 900;font-size: 15px;text-decoration: underline;"><b>Sit back and Relax, Your order will be shipped in 2 business days.</b></p>
                                                  
                                                  <img src="https://i.ibb.co/Kj7v6zW/36035487-1.jpg" style="width: 245px;">
                                                  
                                                  
                                               </td>
                                            </tr>
                                         </tbody>
                                      </table>
				    ';
				    
				    
				 } else if($row['pprice']=="Shipped") {
				     $mail_subject = 'Your Order has been Shipped successfully | ONEGLOBALPHARMA.COM';
				     
				     $post_data = [
                        'username'=>'Newlands Pharmacy', 
                        'key'=>'Newlands Pharmacy@2022', 
                        'method'=>'http', 
                        'to'=>$row['cmono'], 
                        'message'=>'Congratulations '.explode(" ",$row['cname'])[0].', your package of invoice number #'.$invid.' is received. Your order is being processed & will be shipped within 2 business days. - GlobalPharma', 
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
                  CURLOPT_POSTFIELDS => "token=mp15jsuyuzvpfrhz&to=".$row['cmono']."&body=Congratulations ".explode(" ",$row['cname'])[0].", your package of invoice number #".$invid." is shipped. Tracking number of your order will be generated in 24 to 48 business hours. - GlobalPharma&priority=0&referenceId=",
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
				     <table cellpadding="0" cellspacing="0" width="100%">
                                     <tbody>
                                        <tr>
                                           <td align="center" style="background-color:#ffffff;border:1px solid #0a9d7b;margin-top:52px;padding: 0 19px;" class="esd-block-text">
                                              <p style="text-align: left;font-weight: 600;">Hello '.$row['cname'].'</p>
                                              <p style="text-align: left;">We are glad to inform you that we have shipped your order dated '.date("d M, Y", strtotime($row['paymentDate'])).' & we will 
                                              share the tracking details with you once it gets generated.</p>
                                              
                                              <p style="text-decoration:underline;text-align: center;font-weight: 600;">Note: Standard shipping time in the US to the US generally takes anywhere between 7-10 Days and Overseas takes between 15-20 Days.</p>
                                              
                                              <p style="color: #0e810e;font-style: italic;font-weight: 900;font-size: 15px;text-decoration: underline;"><b>Shipping process starts now!</b></p>
                                              
                                              
                                              
                                           </td>
                                        </tr>
                                     </tbody>
                                  </table>
				     ';
				 }
				 else if($row['pprice']=="Tracking") {
				     $mail_subject = 'Your Tracking Details has beed updated successfully | ONEGLOBALPHARMA.COM';
				     $msg .= '
				     <span><img src="https://oneglobalpharma.com/assets/img/tracking-mail.png" style="width:128px; margin: 0 auto;"></span>
				     <br><br>
				     <h3 style="color: #007CF5;font-size: 22px; text-transform: uppercase;">Thank You! Your tracking details is mentioned below.</h3><p style="font-weight: 800;font-size: 15px;">What\'s next? You will recived your items 15-20 days from the order date.</p>';
				 }
				  else if($row['pprice']=="Delivered") {
				      $mail_subject = 'Your Order with ONE Newlands Pharmacy is Delivered | ONEGLOBALPHARMA.COM';
				     $msg .= '
				     +<p>What\'s next? We will send your tracking number & inform you </p>';
				 }
				 
				 
				 
$msg .= '				 
			</td>
		</tr>
		<tr>
            <td colspan="2" class="esd-structure es-p20t es-p20r es-p20l" align="left" bgcolor="#010101"
                        style="background-color: #ffffff;border: 1px solid #0e810e; padding: 9px 16px;" esd-custom-block-id="481465">
                ';
                
            if($row['pprice']=="Processed"){
                            	$msg .= '
                            		<img src="https://oneglobalpharma.com/assets/img/preceed1.png" style="width:100%; margin: 0 auto;">
                            	';
                            	} else if($row['pprice']=="Shipped") {
                            	$msg .= '
                            		<img src="https://oneglobalpharma.com/assets/img/shipped1.png" style="width:100%; margin: 0 auto;">
                            	';
                            	}
                            	else if($row['pprice']=="Tracking") {
                            	$msg .= '
                            		<img src="https://oneglobalpharma.com/assets/img/tracking1.png" style="width:100%; margin: 0 auto;">
                            	';
                            	}
                            	else if($row['pprice']=="Delivered") {
                            	$msg .= '
                            		<img src="https://oneglobalpharma.com/assets/img/delivered1.png" style="width:100%; margin: 0 auto;">
                            	';
                            }
                
    $msg .='
            </td>
        </tr>
		        <tr>
					<td colspan="2" class="esd-structure es-p20" esd-general-paddings-checked="false"
                        style="background-color:#f8f8f8;padding:20px!important;border: 1px solid #0e810e;" bgcolor="#f8f8f8" align="left" esd-custom-block-id="482536">
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
                
				';
					
			
		
            				
				
						$msg .= '</tr>
							<tr>
							<td></td>
								<td colspan="2" style=" display: flex; flex-direction: inherit; align-items: start; ">';
								
								if($row['status']=="Tracking" || $row['status']=="Delivered") {
									
									foreach($tids as $key=> $value):
										if(empty($value['tracking_link'])) {
											$msg .= '<br>'.$value['tracking_id'].''.($key+1).'. <a href="https://t.17track.net/en#nums='.$value['tracking_id'].'" style="margin-bottom: 10px;color: #fff;text-decoration: none;background-color: #8cb3ff;padding: 5px 21px;border-radius: 3px;display: inline-block;">Track Now</a>';
										} else {
											$msg .= '<a href="'.$value['tracking_link'].'" style="margin-bottom:10px;color:#fff;display: block;margin: 0 auto;margin-top: 37px;width: fit-content;text-decoration:none;background-color: #007cf5;font-size: 17px;padding: 3px 30px;">Track Now '.($key+1).'</a>';
										}
									endforeach;
								} 
								
								$msg .='</td>
								<td></td>
								
							</tr>
						</table>
					</td>
				</tr>
				
				
				
				
				
				
				
				
			</table>
			</td>
		</tr>
	</tbody>
</table>';

sendmail("admin@globalpharmameds.com", "Newlands Pharmacy", $toemail, "Your Order status | Globalpharmameds.com", $msg);
// include('/home/oneglobalpharma/public_html/securecrm/0webapi/api/classes/sendMail.php');
// sendGridMailSender("Your Order status | Globalpharmameds.com", $toemail, $row['cname'], (string) $msg);
?>