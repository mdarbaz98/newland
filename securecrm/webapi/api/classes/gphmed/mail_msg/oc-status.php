<?php
$sql = 'SELECT * FROM `orders` WHERE id="'.$id.'"';
$result = $dbgpmz->query($sql);
$row = $result->fetch_assoc();
$invid = "#".$row['orderno'];

$sql1 = 'select * from billinginfoforcard where cid="'.$row['cust_id'].'"';	
$result1 = $dbgpmz->query($sql1);
$rowsadd = $result1->fetch_assoc();
$toemail = mb_convert_encoding($rowsadd['email1'], "UTF-8", "UTF-8");

$tids = array();
$tsql = "SELECT * FROM `tbl_traking_ids` WHERE order_id='".$id."'";
$tresult = $dbgpmz->query($tsql);
while($rows1 = $tresult->fetch_assoc()) {
	array_push($tids, $rows1);
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
		
		
	if($total>250) {
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
				<td>$'.($total+20).'</td>
			</tr>';
			$total = $total+20;
	}
		
				
				
				
$msg ='';

$msg .='<table class="es-content esd-header-popover" cellspacing="0" cellpadding="0" align="center" width="600">
	<tbody>
		<tr>
			<td colspan="2" align="center">
				<br>
				<br><br>
				<span><img src="https://oneglobalpharma.com/greentik.png" style="width:52px;"></span>
				<br><br>
				 <h3 style="color: #1FC214;">Thank You! Your Order had been '.($row['status']=="Tracking"?"Tracked":$row['status']).' Successfully</h3>';
				 if($row['status']=="Processed"){
				     $msg .= '<p>What\s next? We will ship your order in 2 days and inform.</p>';
				 } else if($row['status']=="Shipped") {
				     $msg .= '<p>What\s next? We will receive your order in 2 days and inform.</p>';
				 }
				 else if($row['status']=="Tracking") {
				     $msg .= '<p>What\s next? You will recived your items 15-20 days from the order date.</p>';
				 }
				  else if($row['status']=="Delivered") {
				     $msg .= '<p>What\s next? Plase confirm that you recive order from below options. </p>';
				 }
		 $msg .='<h2 style="background-color: #bcd0f6;padding: 10px; width: fit-content;border-radius: 25px;border: 2px solid #80abff;">ORDER ID: '.$invid.'</h2>
				  <h3 style="margin-bottom: 0px;">Name on statments for $'.$total.': Ship Lights</h3>
				 <p style="margin:0px;">(name appear on your  credit, or debit card statments)</p>
				 <br>
			</td>
		</tr>
		
		<tr>
		    <td colspan="2">
			<table align="center" width="100%;" cellpadding="0" cellspacing="0">
				
			
				<tr>
					<td style="padding-top: 0px;" colspan="2">
						<hr style="border-top:3px solid #f8f8f8;">
					</td>
				</tr>
				<tr>
					<td style="padding-top: 0px;" colspan="2">
						<p style="margin:0px;color:#001fcc;font-size:17px;"><b>Order Date:</b> '.date("d M, Y", strtotime($row['orderdate'])).' (On this day you paid us)</p>
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
								
								if($row['status']=="Tracking" || $row['status']=="Delivered") {
									$msg .= '<td style="text-align: center;position: relative;right: -46px;color: #00a820;"></td>';
								} else {
									$msg .= '<td></td>';
								}
								$msg .='<td></td>
							</tr>
							
							<tr>';
								
								if($row['status']=="Processed" || $row['status']=="Shipped" || $row['status']=="Tracking" || $row['status']=="Delivered") {
									$msg .= '<td>
												<span>
													<img src="https://oneglobalpharma.com/greentik.png" style="width:20px;padding-left: 5px;">
												</span>
											</td>';
								}
								
								
								if($row['status']=="Shipped" || $row['status']=="Tracking" || $row['status']=="Delivered") {
									$msg .= '<td>
												<span>
													<img src="https://oneglobalpharma.com/greentik.png" style="width:20px;padding-left: 5px;">
												</span>
											</td>';
								}
								
								if($row['status']=="Tracking" || $row['status']=="Delivered") {
									$msg .= '<td>
												<span>
													<img src="https://oneglobalpharma.com/greentik.png" style="width:20px;padding-left: 5px;">
													<span style="color:#00a820;">
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													On the way →</span>
												</span>
											</td>';
								}
									
								if($row['status']=="Delivered") {
									$msg .= '<td>
											<span>
													<img src="https://oneglobalpharma.com/greentik.png" style="width:20px;float:right;">
												</span>
											</td>';
								}
								
								$msg .= '</tr>
										<tr>';
								
							if($row['status']=="Processed" || $row['status']=="Shipped" || $row['status']=="Tracking" || $row['status']=="Delivered") {
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
							
							
							if($row['status']=="Shipped" || $row['status']=="Tracking" || $row['status']=="Delivered") {
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
							
							if($row['status']=="Tracking" || $row['status']=="Delivered") {
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
							
							if($row['status']=="Delivered") {
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
								
								if($row['status']=="Tracking" || $row['status']=="Delivered") {
									
									foreach($tids as $key=> $value):
										if(empty($value['tracking_link'])) {
											$msg .= '<br>Package '.($key+1).'. <a href="https://t.17track.net/en#nums='.$value['tracking_id'].'" style="margin-bottom: 10px;color: #fff;text-decoration: none;background-color: #8cb3ff;padding: 5px 21px;border-radius: 3px;display: inline-block;">Track Now</a>';
										} else {
											$msg .= '<br>Package '.($key+1).'. <a href="'.$value['tracking_link'].'" style="margin-bottom: 10px;color: #fff;text-decoration: none;background-color: #8cb3ff;padding: 5px 21px;border-radius: 3px;display: inline-block;">Track Now</a>';
										}
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
					<br><br><p><b>Please click here and let us know that you got this emai</b></p>
						<a href="https://oneglobalpharma.com/intermediate/oc_sts_report.php?web=globpharm&sts='.$row['status'].'&id='.$id.'" style="padding: 10px 20px;
										background-color: #4c89ff;
										color: #fff;
										text-decoration: none;
										font-size: 20px;
										border: 2px solid #0e60ff;
										border-radius: 25px;">I Confirm</a>
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
									<a href="https://oneglobalpharma.com/intermediate/help_center.php" style="	border:2px solid #0085eb;
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
									<a href="https://oneglobalpharma.com/intermediate/rep_an_issue.php?web=globpharm&id='.$id.'" style="	border:2px solid #0085eb;
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
							<br>
							<li>Instead I will mention that i paid for Website Advertising Services as showed in my cart on checkout.</li>
					    	<br>
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


sendmail("admin@selcoenterprises.com", "Newlands Pharmacy", $toemail, "Your Order Status changed Successfully | globalpharmamed.com", (string) $msg);

?>