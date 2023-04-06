<?php
$sql = 'SELECT * FROM `orders` WHERE id="'.$id.'"';
$result = $dbgpmz->query($sql);
$row = $result->fetch_assoc();
$invid = "#".$row['orderno'];
$date = $row['orderdate'];

$sql1 = 'select * from billinginfoforcard where cid="'.$row['cust_id'].'"';	
$result1 = $dbgpmz->query($sql1);
$rowsadd = $result1->fetch_assoc();
$toemail = mb_convert_encoding($rowsadd['email1'], "UTF-8", "UTF-8");

$tids = array();
$tsql = "SELECT * FROM `tbl_traking_ids` WHERE order_id='".$id."'";
$tresult = $dbgpmz->query($tsql);
while($rows1 = $tresult->fetch_assoc()) {
	array_push($tids, $rows1['tracking_id']);
}

$result = $dbgpmz->query("select * from order_details Where order_id='".$id."'");

$str = '';
$total = 0; 
$arr = array();
while($rows = $result->fetch_assoc()) {
	$sql = "select * from subcategory where sid='".$rows['pid']."' AND id=".$rows['cid']."";	
	$result1 = $dbgpmz->query($sql);
	$rows2 = $result1->fetch_assoc();
	
	$sql2 = "select * from pdetails where pid='".$rows['strength']."'";	
	$result2 = $dbgpmz->query($sql2);
	$rows3 = $result2->fetch_assoc();

	 $stren = empty($rows3['strength'])?"":$rows3['strength'];
	$array['pname'] = empty($rows2['productname'])?"":$rows2['productname'].": ".$stren;
	$array['qty'] = $rows['qty'];
	$array['price'] = $rows['price'];
	
	$str .='<tr>
			<td>'.$array['pname'].'</td>
			<td>'.$array['qty'].'</td>
			<td>$'.$array['price'].'</td>
			<td>$'.($array['qty']*$array['price']).'</td>
		  </tr>';
		  $total = $total + ($array['qty']*$array['price']);
}
		
		
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
	<tbody style="background: aliceblue;">
		<tr>
			<td colspan="2" align="center">
			    <span><img src="https://oneglobalpharma.com/assets/img/deliver1.png" style="width:128px; margin: 0 auto;"></span>
				<br><br>
				<h3 style="color: #007CF5;font-size: 24px; text-transform: uppercase;">Hey '.$rowsadd['fname'].' '.$rowsadd['lname'].', We have Delivered your orders.</h3>
				<p style="font-weight: 800;font-size: 15px;">What\'s next? We will ship your order in 2 days and inform.</p>
				
				 <a href="https://oneglobalpharma.com/intermediate/cust_del_complete.php?web=globpharmedz&id='.$id.'" style="background-color: #007cf5; color: #fff; padding: 5px 10px;border: 2px solid #4c89ff;border-radius: 25px;font-weight:600;text-decoration:none;">Yes, i received my order</a>
				 
				 <a href="https://oneglobalpharma.com/intermediate/cust_not_recv_order.php?web=globpharmedz&id='.$id.'" style="display: inline; background-color: #007cf5; color: #fff; padding: 5px 10px;border: 2px solid #4c89ff;border-radius: 25px;font-weight:600;text-decoration:none;">I have not received my order yet</a><br><br>
				 
				 <a href="https://oneglobalpharma.com/intermediate/miss_medication_recv.php?web=globpharmedz&id='.$id.'" style="display: inline; background-color: #007cf5; color: #fff; padding: 5px 10px;border: 2px solid #4c89ff;border-radius: 25px;font-weight:600;text-decoration:none;">Received incomplete/incorrect order</a>
				 <br>
				 <br>
			</td>
		</tr>
		
		<tr>
		    <td colspan="2">
			<table align="center" width="100%;" cellpadding="0" cellspacing="0">
                <tr>
					<td style="background-color:#007cf5;padding:10px;width:50%;text-align:center;color:#fff;font-size:15px">
						<h4 style="margin:0px">SUMMARY</h4>
					</td>
					<td style="background-color:#007cf5;padding:10px;width:50%;text-align:center;color:#fff;font-size:15px">
						<h4 style="margin:0px">SHIPPING ADDRESS</h4>
					</td>
				</tr>
				<tr>
					<td style="background-color:#fff !important;">
						<table align="center" width="100%;">
							<tr>
								
								<th style="text-align:left;height:50px;">Name</th>
								<th style="text-align:left;">Qty</th>
								<th style="text-align:left;">Price</th>
								<th style="text-align:left;">Total</th>
							</tr>
							'.$str.'
						</table>
					</td>
					<td style="background-color:#fff !important; padding-left: 12px;vertical-align: top;padding-top: 19px;border-left: 2px solid #d1d1d1;">
						<h4 style="margin:0px;">'.$rowsadd['fname'].' '.$rowsadd['lname'].'</h4>
						<p>'.$rowsadd['address'].'<br>'.$rowsadd['city'].'-'.$rowsadd['zip'].',('.$rowsadd['country'].').<br>'.$rowsadd['phone'].'<br>'.$rowsadd['email'].'</p>
						<span style="font-weight:400;">(Shipping Time 15-21 Days)</span>
					</td>';
					
			
		$msg .='</tr>
				<tr>
					<td style="padding-top: 0px;" colspan="2">
						<h2 style="background-color:#007cf5;padding:10px 32px;color:#fff;display: block;margin: 15px auto 0 auto;width:fit-content;border-radius:25px;border:2px solid #007cf5;">ORDER ID: #INV-315495</h2>
        				<h3 style="margin-bottom:0px;text-align: center;">Name on statments for '.$total.': Kawai Toys</h3>
        				<p style="margin:0px;text-align: center;">(name appear on your credit, or debit card statments)</p>
        				<br>
        				<tr>
        					<td style="padding-top: 0px;" colspan="2">
        					</td>
        				</tr>
        				<tr>
        					<td style="padding-top: 0px;" colspan="2">
        						<p style="margin: 2px 0; text-align: center; color: #007cf5; font-size:17px; font-weight: 600;"><b>Order Date:</b> '.$date.' (On this day you paid us)</p>
        					</td>
        				</tr>
					</td>
				</tr>
				<tr>
					<td style="padding-top: 0px;" colspan="2">
						<table cellspacing="0" border="0" cellpadding="0" width="550px" align="center" >
							<tr>';
							
								$msg .='<td style="padding:20px 20px 50px 20px"></td>
							</tr><tr>';
								
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
                            	else if($row['status']=="Delivered") {
                            	$msg .= '
                            		<img src="https://oneglobalpharma.com/assets/img/delivered1.png" style="width:100%; margin: 0 auto;">
                            	';
                            }
				
				
						$msg .= '
							</tr><tr>
								<td colspan="2" style=" display: flex; flex-direction: inherit; align-items: start; ">';
								
								if($row['status']=="Tracking" || $row['status']=="Delivered") {
									
									foreach($tids as $key=> $value):
										$msg .= '<a href="https://t.17track.net/en#nums='.$value.'" style="margin-bottom:10px;color:#fff;display: block;margin: 0 auto;margin-top: 37px;width: fit-content;text-decoration:none;background-color: #007cf5;font-size: 17px;padding: 3px 30px;">Track Now '.($key+1).'</a>';
									endforeach;
								} 
								$msg .='</td>
								<td></td>
								
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td style="padding-top: 0px;" colspan="2">
						<hr style="border-top:3px solid #f8f8f8;">
					</td>
				</tr>
			
				<tr>
					<td style="padding-top: 0px;text-align:center;font-size:20px;" colspan="2" >
					<br>
					<p><b>Need help with your order (for issues or query).</b><br>
						Please choose your suitable way to contact us.
					</p>
					</td>
				</tr>
				<tr>
					<td colspan="2" >
					<span style="background-color: #145cff;padding:6px 17px;display: block;border-radius: 5px;color:#fff;font-size:20px;margin: 9px auto;width: fit-content;">Support </span>
					<p style=" border: 2px solid #007cf5; color: #007cf5; font-size: 16px; display: block; width: fit-content; margin: 0 auto; padding: 17px 17px; border-radius: 16px; "><b style=" ">Call Us: <?php  echo $_SESSION['phone1'] ?></b> OR Reply Back on same email</p>
					<p style="
                        text-align: center;
                        width: 73%;
                        margin: 0 auto;
                    ">
                    					    <a href="https://oneglobalpharma.com/intermediate/help_center.php" style="border: 2px solid #007cf5;padding: 12px 27px;box-sizing: border-box;display: block;float: left;margin: 10px 2px;width: 48%;font-size:17px;text-decoration:none;font-weight:700;color: #007cf5;border-radius:7px;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://oneglobalpharma.com/intermediate/help_center.php&amp;source=gmail&amp;ust=1627112377756000&amp;usg=AFQjCNFBK0Ugn_juiEZu4svfhWauwPXehQ">Help center</a>
                    					    <a href="https://oneglobalpharma.com/intermediate/rep_an_issue.php?web=globpharm&amp;id=1246" style="
                        border: 2px solid #007cf5;
                        padding: 12px 27px;
                        box-sizing: border-box;
                        display: block;
                        float: left;
                        margin: 10px 2px;
                        width: 48%;
                        font-size: 17px;
                        text-decoration: none;
                        font-weight: 700;
                        border-radius: 7px;
                        " target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://oneglobalpharma.com/intermediate/rep_an_issue.php?web%3Dglobpharm%26id%3D1246&amp;source=gmail&amp;ust=1627112377756000&amp;usg=AFQjCNGxlG-2exieLkuggllog09sLd-zxQ">Report an issue</a>
                    					</p>
						<br>
					<br>
					</td>
				</tr>
				
				<tr>
					<td style="padding: 18px 20px; background-color: #048bff;" colspan="2" >
					<p><b style="display:block;margin: 0 auto; color:#048bff; background-color:#fff;width: fit-content;padding: 5px 10px;border-radius: 20px;">3 Things you have agreed on</b><br>
					<p style=" color: #fff; font-weight: 800; padding: 3px 30px; border-radius: 31px; font-size: 13px; "><b style=" font-size: 28px; ">1</b>. I will not mention anything about the purchase of medications (with Credit/debit Card Company).</p>
					<p style=" color: #fff; font-weight: 800; padding: 3px 30px; border-radius: 31px; font-size: 13px; "><b style=" font-size: 28px; ">2</b>. Instead I will mention that i paid for Website Advertising Services as showed in my cart on checkout.</p>
					<p style=" color: #fff; font-weight: 800; padding: 3px 30px; border-radius: 31px; font-size: 13px; "><b style=" font-size: 28px; ">3</b>. In case of issues related to my order, I agree to contact your Customer Support instead of making chargeback or dispute with Credit/debit Card Company.</p>
					</p>
					</td>
				</tr>
				
				
			</table>
			</td>
		</tr>
	</tbody>
</table>';

sendmail("order@selcoenterprises.com", "Newlands Pharmacy", $toemail, "Your Order With Newlands Pharmacy is delivered.", $msg);

?>