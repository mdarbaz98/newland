<?php

$sql = "SELECT * FROM `tbl_manual_order` WHERE id='".$id."'";
$result = $db->query($sql);
$row = $result->fetch_assoc();
$toemail = $row['cemail'];

$name = $row['cname'];
$data = date("d M, Y", strtotime($row['timestamp']));
$total = $row['ptot'];
$invid = "INV-".$row['id']."".substr(strtotime($row["timestamp"]), 0, 4);
											
$sql = 'SELECT * FROM tbl_traking_ids WHERE order_id="M_'.$id.'"';
$result = $db->query($sql);
$nor = $result->num_rows;
//print_r($row->tracking_id); die;

$str = '<table class="es-content esd-header-popover" cellspacing="0" cellpadding="0" align="center" width="600">
	<tbody>
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
                                              <p style="text-align: center;font-weight: 600;">Hello '.$name.'</p>
                                              <p style="text-align: center;font-weight: 600;">Your Order Is On Its Way</p>
                                              <p style="text-align:center">Tracking progress of your order is just a click away</p>
                                              
                                              <p style="text-align:center;text-decoration:underline;text-align: center;font-weight: 600;">
                                                <b>Note</b>
                                                <ul>
                                                    <li>Shipping time in US to US generally takes 5 to 7 Business Days</li>
                                                    <li>Overseas shipping takes between 12 to 18 Business Days</li>
                                                <ul>
                                              </p>
                                            
                                              
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
                    <td class="esd-structure es-p20t es-p25b es-p20r es-p20l" esd-general-paddings-checked="false"
                        style="padding:3px;background: #fff;border:1px solid #0a9d7b" bgcolor="#335e90" align="left">
                        <table width="100%" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td class="esd-container-frame" width="560" valign="top" align="center">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td align="center" class="esd-block-text es-p15t">';
                                                    $str .= ''; 
                            						$str .= '
                            								'; 
                            						$i = 0;
                            						while($rows = $result->fetch_assoc()) {
                            						    $totalData = count($rows);
                            						    ++$i;
                            							//print_r($rows);
                            							$str .='Package - '.$i.'-> <a href="https://t.17track.net/en#nums='.$rows['tracking_id'].'" style="background: #0a9d7b; text-decoration: none; color: #fff; display: inline-block; padding: 5px 9px; border-radius: 14px;margin-top: 5px;">Track Now</a><br>';
                            						    
                            						    $trackingid = strval($rows['tracking_id']);
                                                            $phones = '+'.$row['cmono'];
                                                            $email = $toemail;
                                                            if($i==$totalData){
                                                            
                                                            
                                                            }
                            						    
                            						}
                            						$str .= '</table>';  
                                                 
                                                $str .='        
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
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
                            </tbody>
                        </table>
                    </td>
                </tr>
                
                
                
		
		
	</tbody>
</table>';

sendmail("admin@globalpharmameds.com", "Newlands Pharmacy", $toemail, "Track Your Order | Globalpharmameds.com", $str);
// include('/home/oneglobalpharma/public_html/securecrm/0webapi/api/classes/sendMail.php');
// sendGridMailSender("Track Your Order | Globalpharmameds.com", $toemail, $name, (string) $str);

// $curl = curl_init();
//                                                                 curl_setopt_array($curl, array(
//                                                                 CURLOPT_URL => "https://hideuri.com/api/v1/shorten",
//                                                                 CURLOPT_RETURNTRANSFER => true,
//                                                                 CURLOPT_ENCODING => "",
//                                                                 CURLOPT_MAXREDIRS => 10,
//                                                                 CURLOPT_TIMEOUT => 30,
//                                                                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                                                                 CURLOPT_CUSTOMREQUEST => "POST",
//                                                                 CURLOPT_POSTFIELDS => "url=https://Newlands Pharmacy4d.aftership.com/".str_replace(" ","",$trackingid)."",
//                                                                 CURLOPT_HTTPHEADER => array(
//                                                                     "content-type: application/x-www-form-urlencoded"
//                                                                 ),
//                                                                 ));
//                                                                 $response = curl_exec($curl);
//                                                                 $err = curl_error($curl);
//                                                                 curl_close($curl);
//                                                                 if ($err) {
//                                                                 // echo "cURL Error #:" . $err;
//                                                                 } else {
//                                                                 $trackURL = json_decode($response, true)['result_url'];
//                                                             }
                                                            
                                        				     
//                                         				     $post_data = [
//                                                                 'username'=>'Newlands Pharmacy', 
//                                                                 'key'=>'Newlands Pharmacy@2022', 
//                                                                 'method'=>'http', 
//                                                                 'to'=>$row['cmono'], 
//                                                                 'message'=>'Hello '.$row['cname'].', the tracking id of your invoice number #'.$invid.' has been successfully generated. ('.$trackURL.'). Tracking will be live within 2 business days. - GlobalPharma', 
//                                                                 'senderid'=>'mycompany'];
//                                                             $ch = curl_init(); 
//                                                             curl_setopt($ch, CURLOPT_URL, "https://api-mapper.clicksend.com/http/v2/send.php" );
//                                                             curl_setopt($ch, CURLOPT_POST, 1 );
//                                                             curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
//                                                             curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//                                                             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//                                                             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//                                                             $postResult = curl_exec($ch);
//                                                             if (curl_errno($ch)) {
//                                                                 // print curl_error($ch);
//                                                             }
//                                                             curl_close($ch);
//                                                             // var_dump($postResult);
                                                        
                                                        
//                                                         $curl = curl_init();
                                                        
//                                                         curl_setopt_array($curl, array(
//                                                           CURLOPT_URL => "https://api.ultramsg.com/instance5491/messages/chat",
//                                                           CURLOPT_RETURNTRANSFER => true,
//                                                           CURLOPT_ENCODING => "",
//                                                           CURLOPT_MAXREDIRS => 10,
//                                                           CURLOPT_TIMEOUT => 30,
//                                                           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                                                           CURLOPT_CUSTOMREQUEST => "POST",
//                                                           CURLOPT_POSTFIELDS => "token=mp15jsuyuzvpfrhz&to=".$row['cmono']."&body=Hello ".$row['cname'].", the tracking id of your invoice number #".$invid." has been successfully generated. (".$trackURL."). Tracking will be live within 2 business days. - GlobalPharma&priority=0&referenceId=",
//                                                           CURLOPT_HTTPHEADER => array(
//                                                             "content-type: application/x-www-form-urlencoded"
//                                                           ),
//                                                         ));
                                                        
//                                                         $response = curl_exec($curl);
//                                                         $err = curl_error($curl);
                                                        
//                                                         curl_close($curl);
                                                        
//                                                         if ($err) {
//                                                         //   echo "cURL Error #:" . $err;
//                                                         } else {
//                                                         //   echo $response;
//                                                         }
                            								
                                                            
//                                                             $curl = curl_init();
//                                                             curl_setopt_array($curl, [
//                                                               CURLOPT_URL => "https://api.aftership.com/v4/trackings",
//                                                               CURLOPT_RETURNTRANSFER => true,
//                                                               CURLOPT_ENCODING => "",
//                                                               CURLOPT_MAXREDIRS => 10,
//                                                               CURLOPT_TIMEOUT => 30,
//                                                               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                                                               CURLOPT_CUSTOMREQUEST => "POST",
//                                                               CURLOPT_POSTFIELDS => "{\"tracking\":{\"title\":\"$name\",\"tracking_number\":\"$trackingid\",\"smses\":[\"$phones\"],\"emails\":\"$email\",\"order_number\":\"$invid\",\"customer_name\":\"$name\"}}",
//                                                               CURLOPT_HTTPHEADER => [
//                                                                 "Accept: application/json",
//                                                                 "Content-Type: application/json",
//                                                                 "aftership-api-key: e3770e63-5b2c-4d63-8e65-dec689bf6d17"
//                                                               ],
//                                                             ]);
                                                            
//                                                             $response = curl_exec($curl);
//                                                             $err = curl_error($curl);
                                                            
//                                                             curl_close($curl);
                                                            
//                                                             if ($err) {
//                                                             //   echo "cURL Error #:" . $err;
//                                                             } else {
//                                                             //   echo "<pre>";
//                                                             //   var_dump($response);
//                                                             }

?>