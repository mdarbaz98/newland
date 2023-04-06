<?php

$msg = '';
$sql = "SELECT * FROM `tbl_manual_order` WHERE id='".$id."'";
$result = $db->query($sql);
$row = $result->fetch_assoc();

$toemail = $row['cemail'];

$msg .= '<table class="es-content esd-header-popover" cellspacing="0" cellpadding="0" align="center" width="600">
	<tbody>
		<tr> 
			<td style="color:#d0d0d0;border-bottom:1px solid #d4b004;">Welcome to Globalpharmameds.com</td>
			<td style="text-align:right;border-bottom:1px solid #d4b004;"><a href="https://globalpharmameds.com" style="color:#d0d0d0;text-decoration:none;">View in browser</a></td>
		</tr>
		<tr>
			<td colspan="2" style="border-bottom:1px solid #b3b3b1;">
				<img src="https://globalpharmameds.com/assets/img/logo.png" width="120px;">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<img src="https://memegene.net/sites/default/files/wallpaper/green-tick-clipart/281623/green-tick-clipart-transparent-background-281623-7199576.png" width="80px;" style="margin: 0px auto;">
				 <h2>Thank You For Your Order!</h2>
				  <p style="text-align:center; color: #f31d1d;font-size: 15px;">we are Contacting from Selco Enterprises Pvt Ltd <br> <h3 style="color:green;">We successfully received payment of $'.$row['ptot'].' from you</h3><br>
			</td>
		</tr>
		<tr>
			<td style="background-color:#e6e6e6;padding:10px;margin-top:20px;">
				<h4 style="margin: 0px;">Order Confirmation</h4>
			</td>
			<td style="background-color:#e6e6e6;padding:10px;margin-top:20px;">
				#INV-'.$row['id']."".substr(strtotime($row["timestamp"]), 0, 4).'
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<table align="center" width="100%;">
				<tr>
					
					<th style="text-align:left;height:50px;">Product</th>
					<th style="text-align:left;">Qty</th>
					<th style="text-align:left;">Payment Total</th>
				</tr>
				<tr>
					<td>'.$row["pname"].'</td>
					<td>'.$row["pqty"].'</td>
					<td>$'.$row["ptot"].'</td>
			    </tr>
			</table>
			</td>
		</tr>
			<tr>
		    <td colspan="2">
			<table align="center" width="100%;" cellpadding="0" cellspacing="0">
				<tr>
					<td style="background-color:#e6e6e6;padding:10px;">
						<h4 style="margin: 0px;">Shipping Address</h4>
					</td>
				</tr>
				<tr>
					<td>
						<h4 style="margin:0px;">'.$row['cname'].'</h4>
						<p>'.$row['caddress'].'<br>'.$row['ccity'].', '.$row['cstate'].'('.$row['czip'].'), '.$row['ccountry'].'<br>Phone: '.$row['cmono'].'<br> Email: '.$row['cemail'].'</p>
					</td>
				</tr>
				<tr>
					<td style="padding-top: 0px;" colspan="2">
						<hr style="border-top:3px solid #d0cfcf;">
						<br>
					</td>
				</tr>
				<tr>
					<td style="padding-top: 0px;" colspan="2" align="left">
					    <p style="line-height: 150%"><span style="font-size: 20px; line-height: 150%">Important Information</span></p>
						
						<p>The Invoice for <b style="color: #d48344">$'.$row['ptot'].'</b> will say that you are purchasing Household goods from us, This is for the security of both of us</p>

						<p>we request you to please not to mention name of medications or anything about medications anywhere on the payment page, nor with the credit/Debit card company</p>

						<p>If you receive a call from credit card company asking about the nature of the payment, just mention that you ordered Household goods from us,</p>

						<p>your products will be shipped by india post and Shipping time is 12-15 days (Trackable service)</p>

						<p>My call back number is <?php  echo $_SESSION['phone1'] ?> (leo) call us for any further query</p>

						<p>Please follow the same email or admin@drugstoreplanet.com  for further inquires and for any further issues</p>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="left">
						<br>
						<p>Thanks & Regards,</p>
						<p>Selco Enterprices</p>
					</td>
				</tr>
			</table>
			</td>
		</tr>
		';
 
 sendmail("admin@globalpharmameds.com", "Newlands Pharmacy", $toemail, "Order confirmed successfully | www.globalpharmameds.com", $msg);
 
?>


