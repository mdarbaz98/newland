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
			<td colspan="2" style="border-bottom:1px solid #d9d9d9;">
				<ul style="float:right;margin: 8px;">
					<li style="display:inline;font-size:13px;font-weight:700;"> +1 (315) 515 4364 </li> / 
					<li style="display:inline;font-size:14px;font-weight:700;"> admin@globalpharmameds.com </li>
				</ul>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<br>
				<span><img src="http://selcoenterprises.com/greentik.png" style="width:32px;"></span>
				<br>
				 <h3 style="color: #009b00;">Your Order Processed Successfully.</h3>
				 <p>What\'s next? We will ship your order in 2 days and inform.</p>
				 <h2 style="background-color: #bcd0f6;padding: 10px; width: fit-content;border-radius: 25px;border: 2px solid #80abff;">ORDER ID: '.$invid.'</h2>
				 <h3 style="margin-bottom: 0px;">Name on statments for $'.$total.': Ship Lights</h3>
				 <p style="margin:0px;">(name appear on your  credit, or debit card statments)</p>
				 
				 <br>
				 <br>
			</td>
		</tr>
		
		<tr>
		    <td colspan="2">
			<table align="center" width="100%;" cellpadding="0" cellspacing="0">
				<tr>
					<td style="background-color:#f4f4f4;padding:10px;">
						<h4 style="margin: 0px;">ORDER DETAILS</h4>
					</td>
					<td style="background-color:#f4f4f4;padding:10px;width: 235px;">
						<h4 style="margin: 0px;">SHIPPING ADDRESS</h4>
					</td>
				</tr>
				<tr>
					<td>
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
					<td style="padding-left: 12px;vertical-align: top;padding-top: 19px;border-left: 2px solid #d1d1d1;">
						<h4 style="margin:0px;">'.$row['cname'].'</h4>
						<p>'.$row['caddress'].'<br>'.$row['ccity'].'-'.$row['czip'].',('.$row['ccountry'].').<br>'.$row['cmono'].'<br>'.$row['cemail'].'</p>
						<span style="font-weight:400;">(Shipping Time 15-21 Days)</span>
					</td>';
					
			
		$msg .='</tr>
				<tr>
					<td style="padding-top: 0px;" colspan="2">
						<hr style="border-top:3px solid #f8f8f8;">
					</td>
				</tr>
				<tr>
					<td style="padding-top: 0px;" colspan="2">
						<p style="margin:0px;color:#001fcc;font-size:17px;"><b>Order Date:</b> '.date("d M, Y", strtotime($row['timestamp'])).' (On this day you paid us)</p>
					</td>
				</tr>
				<tr>
					<td style="padding-top: 0px;" colspan="2">
						<hr style="border-top:3px solid #f8f8f8;">
						<br>
						<br>
					</td>
				</tr>
				<tr>
					<td style="padding-top: 0px;" colspan="2">
						<table cellspacing="0" border="0" cellpadding="0" width="550px" align="center" >
							<tr>
								<td></td>
								<td></td>';
								
								if($row['pprice']=="Tracking" || $row['pprice']=="Delivered") {
									$msg .= '<td style="text-align: center;position: relative;right: -46px;color: #00a820;"></td>';
								} else {
									$msg .= '<td></td>';
								}
								$msg .='<td></td>
							</tr>
							
							<tr>';
								
								if($row['pprice']=="Processed" || $row['pprice']=="Shipped" || $row['pprice']=="Tracking" || $row['pprice']=="Delivered") {
									$msg .= '<td>
												<span>
													<img src="http://selcoenterprises.com/greentik.png" style="width:20px;padding-left: 5px;">
												</span>
											</td>';
								}
								
								
								if($row['pprice']=="Shipped" || $row['pprice']=="Tracking" || $row['pprice']=="Delivered") {
									$msg .= '<td>
												<span>
													<img src="http://selcoenterprises.com/greentik.png" style="width:20px;padding-left: 5px;">
												</span>
											</td>';
								}
								
								if($row['pprice']=="Tracking" || $row['pprice']=="Delivered") {
									$msg .= '<td>
												<span>
													<img src="http://selcoenterprises.com/greentik.png" style="width:20px;padding-left: 5px;">
													<span style="color:#00a820;">
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													On the way ?</span>
												</span>
											</td>';
								}
									
								if($row['pprice']=="Delivered") {
									$msg .= '<td>
											<span>
													<img src="http://selcoenterprises.com/greentik.png" style="width:20px;float:right;">
												</span>
											</td>';
								}
								
								$msg .= '</tr>
										<tr>';
								
							if($row['pprice']=="Processed" || $row['pprice']=="Shipped" || $row['pprice']=="Tracking" || $row['pprice']=="Delivered") {
								$msg .= '<td style="vertical-align: top;color: #309a00;">
											<span style="padding: 3px 11px;
													 background-color: #309a00;
													 border-radius: 50%;">
													 </span>
													<div style="height: 4px;
																width: 118px;
																background-color: #309a00;
																display: inline-block;"></div>
													 <br> 
													<b>Processed</b><br>
													<span style="color:#9b9b9b;">Payment Received</span>
										</td>';
							} else {
								$msg .= '<td style="vertical-align: top;color: #adadad;">
											<span style="padding: 3px 11px;
													 background-color: #adadad;
													 border-radius: 50%;">
													 </span>
													 <div style="height: 4px;
																	width: 118px;
																	background-color: #adadad;
																	margin-top: -12px;
																	display: inline-block;"></div>
													 <br>
													<b>Processed</b><br>
										</td>';
							}
							
							
							if($row['pprice']=="Shipped" || $row['pprice']=="Tracking" || $row['pprice']=="Delivered") {
								$msg .=	'<td>
											<span style="padding: 3px 11px;
													 background-color: #309a00;
													 border-radius: 50%;">
													 </span>
													 <div style="height: 4px;
																	width: 102px;
																	background-color: #309a00;
																	margin-top: -12px;
																	z-index:-1;
																	display: inline-block;"></div>
													 <br>
													<b style="color:#309a00;" >Shipped</b><br>
													<span style="color:#9b9b9b;">Item Shipped</span>			
										</td>';
							} else {
								$msg .=	'<td>
											<span style="padding: 3px 11px;
													 background-color: #adadad;
													 border-radius: 50%;">
													 </span>
													 <div style="height: 4px;
																	width: 102px;
																	background-color: #adadad;
																	margin-top: -12px;
																	display: inline-block;"></div>
													 <br>
													<b style="color:#adadad;" >Shipped</b><br>	
													<span style="color:#fff;">Item Shipped</span>	
										</td>';
							}
							
							if($row['pprice']=="Tracking" || $row['pprice']=="Delivered") {
								$msg .= '<td>
											<span style="padding: 3px 11px;
													 background-color: #309a00;
													 border-radius: 50%;">
													 </span>
													 <div style="height: 4px;
																	width: 246px;
																	background-color: #309a00;
																	margin-top: -12px;
																	display: inline-block;"></div>
													 <br>
													  
													<b style="color:#309a00;" >Tracking</b><br>
													<span style="color:#9b9b9b;">Tracking send on email</span>
										</td>';
									
							} else {
								$msg .= '<td>
											<span style="padding: 3px 11px;
													 background-color: #adadad;
													 border-radius: 50%;">
													 </span>
													 <div style="height: 4px;
																	width: 246px;
																	background-color: #adadad;
																	margin-top: -12px;
																	display: inline-block;"></div>
													 <br>
													  
													<b style="color:#adadad;" >Tracking</b><br>
													<span style="color:#fff;">Tracking send on email</span>
										</td>';
							}
							
							if($row['pprice']=="Delivered") {
								$msg .=	'<td align="right" style="vertical-align: top;">
											<div style="height: 4px;
																	width: 100px;
																	background-color: #309a00;
																	margin-top: -12px;
																	display: inline-block;"></div>
											<span style="padding: 3px 11px;
													 background-color: #309a00;
													 border-radius: 50%;">
													 </span>
													 
													 <br>
													<b style="color:#309a00;" >Delivered</b><br>
													<span style="color:#9b9b9b;">Item Delivered</span>			
										</td>';
							} else {
								$msg .=	'<td align="right" style="vertical-align: top;">
										<div style="height: 4px;
															width: 100px;
															background-color: #adadad;
															margin-top: -12px;
															display: inline-block;"></div>
										<span style="padding: 3px 11px;
											 background-color: #adadad;
											 border-radius: 50%;">
											 </span>
											 <br>
											<b style="color:#adadad;" >Delivered</b><br>
											<span style="color:#fff;">Item Delivered</span>			
								</td>';
							}
				
				
						$msg .= '</tr>
							<tr>
							<td></td>
								<td colspan="2">';
								
								if($row['pprice']=="Tracking" || $row['pprice']=="Delivered") {
									
									foreach($tids as $key=> $value):
										$msg .= '<br>Package '.($key+1).'. <a href="https://t.17track.net/en#nums='.$value.'" style="margin-bottom: 10px;color: #fff;text-decoration: none;background-color: #8cb3ff;padding: 5px 21px;border-radius: 3px;display: inline-block;">Track Now</a>';
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
					<td style="padding-top: 0px;text-align:center;" colspan="2" >
					<br><br>
						<a href="http://selcoenterprises.com/intermediate/oc_sts_report.php?web=manualoc&sts='.$row['pprice'].'&id='.$id.'" style="padding: 10px 20px;
										background-color: #4c89ff;
										color: #fff;
										text-decoration: none;
										font-size: 20px;
										border: 2px solid #0e60ff;
										border-radius: 25px;">Please click here and let us know that you got this email</a>
										<br>
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
					<br>
					<br>
						<table width="100%" style="text-align:center;">
							<tr>
								<td width="30%">
									<p>
									<a href="http://selcoenterprises.com/intermediate/help_center.php" style="	border:2px solid #0085eb;
														padding: 22px;
														color: #0085eb;
														font-size: 17px;
														text-decoration: none;
														font-weight:700;
														border-radius: 7px;">Help center</a>
									</p>
								</td>
								<td width="40%">
									<span style="background-color: #0085eb;
												padding: 6px 17px;
												border-radius: 25px;
												color: #fff;
												font-size: 20px;    
												position: relative; top: 31px;">Support</span>
									<p style="	border:2px solid #0085eb;
														padding: 22px;
														color: #0085eb;
														font-size: 17px;
														text-decoration: none;
														border-radius: 7px;" >
										<b>Call Us: <?php  echo $_SESSION['phone1'] ?></b><br>
										<span>OR</span><br>
										<span>Reply Back on same email</span>
									</p>
								</td>
								<td width="30%">
									<p>
									<a href="http://selcoenterprises.com/intermediate/rep_an_issue.php?web=manualoc&id='.$id.'" style="	border:2px solid #0085eb;
														padding: 22px;
														color: #0085eb;
														font-size: 17px;
														text-decoration: none;
														font-weight:700;
														border-radius: 7px;">Report an issue</a>
									</p>
								</td>
							</tr>
						</table>
						<br>
					<br>
					</td>
				</tr>
				
				<tr>
					<td style="padding: 18px;background-color: #f0f5ff;" colspan="2" >
					<p><b>3 Things you have agreed on</b><br>
						<ol>
							<li>I will not mention anything about the purchase of medications (with Credit/debit Card Company or PayPal).</li>
							<hr>
							<li>Instead I will mention that i paid for Website Advertising Services as showed in my cart on checkout.</li>
							<hr>
							<li>In case of issues related to my order, I agree to contact your Customer Support instead of making chargeback or dispute with Credit/debit Card Company or PayPal.</li>
						</ol>
					</p>
					</td>
				</tr>
				
			</table>
			</td>
		</tr>
	</tbody>
</table>';

sendmail("admin@globalpharmameds.com", "Newlands Pharmacy", $toemail, "Your Order status | Globalpharmameds.com", $msg);

?>