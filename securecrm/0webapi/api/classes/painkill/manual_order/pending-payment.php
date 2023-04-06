<?php

$msg = '';
$sql = "SELECT * FROM `tbl_manual_order` WHERE id='".$id."'";
$result = $db->query($sql);
$row = $result->fetch_assoc();

$toemail = $row['cemail'];

$msg .= '<style type="text/css">
  #outlook a {
  padding:0;
  }
  .ExternalClass {
  width:100%;
  }
  .ExternalClass,
  .ExternalClass p,
  .ExternalClass span,
  .ExternalClass font,
  .ExternalClass td,
  .ExternalClass div {
  line-height:100%;
  }
  .es-button {
  mso-style-priority:100!important;
  text-decoration:none!important;
  }
  a[x-apple-data-detectors] {
  color:inherit!important;
  text-decoration:none!important;
  font-size:inherit!important;
  font-family:inherit!important;
  font-weight:inherit!important;
  line-height:inherit!important;
  }
  .es-desk-hidden {
  display:none;
  float:left;
  overflow:hidden;
  width:0;
  max-height:0;
  line-height:0;
  mso-hide:all;
  }
  [data-ogsb] .es-button {
  border-width:0!important;
  padding:10px 20px 10px 20px!important;
  }
  [data-ogsb] .es-button.es-button-1 {
  padding:10px 35px!important;
  }
  @media only screen and (max-width:600px) {p, ul li, ol li, a { line-height:150%!important } h1, h2, h3, h1 a, h2 a, h3 a { line-height:120%!important } h1 { font-size:30px!important; text-align:center } h2 { font-size:26px!important; text-align:center } h3 { font-size:20px!important; text-align:center } .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a { font-size:30px!important } .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a { font-size:26px!important } .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a { font-size:20px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:16px!important } .es-content-body p, .es-content-body ul li, .es-content-body ol li, .es-content-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:16px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } a.es-button, button.es-button { font-size:20px!important; display:block!important; border-width:10px 20px 10px 20px!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } .es-menu td { width:1%!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } }
</style>
<body style="width:100%;font-family:Arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
  <div class="es-wrapper-color">
     <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse; max-width:670px;width:100%;margin:0 auto;background-color:#fff;border-radius:3px;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top">
        <tr style="border-collapse:collapse">
           <td valign="top" style="padding:0;Margin:0">
              <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                 <tr style="border-collapse:collapse">
                    <td align="center" style="padding:0;Margin:0">
                       <table class="es-content-body" cellspacing="0" cellpadding="0" align="center" bgcolor="#2b3445" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#2b3445;width:600px">
                        <tr>
                			<td colspan="2" style="background-color:#fff">
                				<table width="100%" cellspacing="0" cellpadding="0" style="padding: 3px;border: 1px solid #0a9d7b;">
                                         <tbody>
                                            <tr>
                                                <td style="display:flex;width: 80%;">
                                                    <img class="adapt-img" src="https://oneglobalpharma.com/assets/img/global-pharma-logo.png" alt width="130" style="display: block;">
                                                </td>
                                                <td style="text-align: center;width: 20%;background: #0a9d7b;color: #fff;">
                                                    <p style="font-weight: 600;font-size: 14px;">#INV-'.$row['id']."".substr(strtotime($row["timestamp"]), 0, 4).'</p>
                                                </td>
                                            </tr>
                                         </tbody>
                                      </table>
                			</td>
                		</tr> 
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
                                                      <p style="text-align: left;">Thank you for your order. Your Invoice Id is #INV-'.$row['id']."".substr(strtotime($row["timestamp"]), 0, 4).'.  You will soon receive the payment link and invoice copy of $'.$row["ptot"].' for your order. You can review your order as mentioned below and if want to make any changes, kindly call our representative at <?php  echo $_SESSION['phone1'] ?> or email us at </p>
                                                      
                                                      <p style="text-decoration:underline;text-align: center;font-weight: 600;">Note: Name on bank statement for your order of $'.$row["ptot"].' will be <span style="color:#0a9d7b;">Newlands Pharmacy</span>. 
                                                      This name will also appear on your credit or debit card statement</p>
                                                     
                                                      <img src="https://i.ibb.co/gtbRXMw/orderplace.jpg" style="width: 155px;">
                                                      
                                                      
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
                        <tr>
                           <td align="left" bgcolor="#87c6ec" style="background-color:#87c6ec">
                              <table cellpadding="0" cellspacing="0" width="100%">
                                 <tbody>
                                    <tr>
                                       <td width="560" valign="top">
                                          <table cellpadding="0" cellspacing="0" width="100%">
                                             <tbody>
                                                <tr>
                                                   <td style="background-color:#ffffff;min-width: 320px !important; border: 1px solid #cccccc;border-top: 0px;margin-top:52px;/* padding:0 19px; */border-right: 0px !important;" valign="top">
                                                      <h2 style="margin: 0px;background: white;border-bottom: 1px solid #cccccc;text-align: center;font-size: 15px;padding: 3px 10px;">Order Details</h2>
                                                      <div style="padding: 7px 15px;">
                                                         <p style="font-size: 15px;margin: 0;"><b>'.$row["pname"].'</b></p>
                                                         <p style="margin: 0;"><b>Order Id: </b>#INV'.$row['id']."".substr(strtotime($row["timestamp"]), 0, 4).'</p>
                                                         <p style="margin: 0;"><b>Order Date: </b>'.date("d M, Y", strtotime($row['timestamp'])).'</p>
                                                         <p style="margin: 0;"><b>Quantity: </b>'.$row["pqty"].'</p>
                                                         <p style="margin: 0;"><b>Total: </b>$'.$row["ptot"].'</p>
                                                      </div>
                                                   </td>
                                                   <td style="background-color:#ffffff; min-width: 320px !important;border: 1px solid #cccccc;
                                                      border-top: 0px;margin-top:52px;/* padding:0 19px; */" valign="top">
                                                      <h2 style="margin: 0px;background: white;border-bottom: 1px solid #cccccc;text-align: center;font-size: 15px;padding: 3px 10px;">Shipping Details</h2>
                                                      <div style="padding: 7px 15px;">
                                                         <p style="font-size: 15px;margin: 0;"><b>'.$row['cname'].'</b></p>
                                                         <p style="margin: 0;">'.$row['caddress'].'</p>
                                                         <p style="margin: 0;"><b>City: </b>'.$row['ccity'].'</p>
                                                         <p style="margin: 0;"><b>State: </b>'.$row['cstate'].'</p>
                                                         <p style="margin: 0;"><b>Zip: </b>'.$row['czip'].'</p>
                                                         <p style="margin: 0;"><b>Country: </b>'.$row['ccountry'].'</p>
                                                      </div>
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
                          
                          <tr>
                    <td class="esd-structure es-p20" esd-general-paddings-checked="false"
                        style="background-color:#f8f8f8;padding:20px!important;border: 1px solid #0e810e;" bgcolor="#f8f8f8" align="left" esd-custom-block-id="482536">
                        <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]-->
                        <span class="es-button-border" style="border-radius: 5px; background: #010101;"> 
                                        <a href="https://oneglobalpharma.com/confirm/receive_order/INV'.$row['id']."".substr(strtotime($row["timestamp"]), 0, 4).'" style="border-radius:5px!important;font-weight:bold!important;padding: 4px 8px!important;text-decoration:none!important;border-width:10px 20px!important;color:#ffffff!important;background: #b1b1b1!important;border-color: #008b00!important;display:block!important;width:fit-content!important;margin:11px auto!important">
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
              </table>
              
           </td>
        </tr>
     </table>
  </div>
</body>
		';
		
sendmail("admin@globalpharmameds.com", "Newlands Pharmacy", $toemail, "Order Confirmation from www.globalpharmameds.com", $msg);
 
 $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://hideuri.com/api/v1/shorten",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "url=https://oneglobalpharma.com/confirm/receive_order/INV".$row["id"].substr(strtotime($row["timestamp"]), 0, 4)."",
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
            $shortURL = json_decode($response, true)['result_url'];
        }
 $post_data = [
                        'username'=>'Newlands Pharmacy', 
                        'key'=>'Newlands Pharmacy@2022', 
                        'method'=>'http', 
                        'to'=>$row['cmono'], 
                        'message'=>'Thank you for shopping with us '.$row['cname'].'. Your invoice number is #INV-'.$row["id"].substr(strtotime($row["timestamp"]), 0, 4).'. You can review your order at '.$shortURL.'. We will shortly send you the payment link - GlobalPharma', 
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
                  CURLOPT_POSTFIELDS => "token=mp15jsuyuzvpfrhz&to=".$row['cmono']."&body=Thank you for shopping with us ".$row['cname'].". Your invoice number is #INV-".$row['id']."".substr(strtotime($row["timestamp"]), 0, 4).". You can review your order at ".$shortURL.". We will shortly send you the payment link. - GlobalPharma&priority=0&referenceId=",
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


