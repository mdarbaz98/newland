<?php
$ocdetails = '';
$total = 0;

foreach($orderdetails as $key=>$value):

	if($web=="Manualorder") {
		$ocdetails .='<tr>
					<td>'.$value->pname.'</td>
					<td>'.$value->qty.'</td>
					<td>$'.$value->price.'</td>
					<td>$'.$value->price.'</td>
				</tr>';
		$total = $value->price;
	} else {
		$tot = $value->qty*$value->price;
		$parr = explode("+",$value->pname);
		$ocdetails .='<tr>
						<td>'.$parr[0].'</td>
						<td>'.$value->qty.'</td>
						<td>$'.$value->price.'</td>
						<td>$'.$tot.'</td>
					</tr>';
		$total = $total + $tot;
	}
endforeach;

date_default_timezone_set("Asia/Kolkata");



$str ='<table class="es-content esd-header-popover" cellspacing="0" cellpadding="0" align="center" width="600">
	<tbody>
		<tr>
			<td colspan="2" style="background-color: #f5f5f5;padding: 10px;border-radius:10px;border: 1px solid #dcdcdc">
				<div style="text-align:center;">
					<h2 style="text-transform:uppercase;">Hi '.$name.',</h2>
					<p>Thank you for do shopping with us. We Received an order from you as below order details, please follow the steps and complete the payment process. </p>
					<h3 style="margin-bottom: 0px;">Name on statments will be: Ship Lights</h3>
					 <p style="margin:0px;">(name that appear on your  credit, or debit card statments)</p>
					
					<h3 style="color:#00c8ea;">ORDER DETAILS :</h3>
				
				</div>
				<table width="100%" align="center" style="text-align: left;border-color:#ffffff;" border="1" cellspacing="0" cellpadding="5" >
					<tr>
						<td style="background-color:#f4f4f4;padding:10px;width:60%;">
							<h4 style="margin: 0px;">ORDER DETAILS</h4>
						</td>
						<td style="background-color:#f4f4f4;padding:10px;">
							<h4 style="margin: 0px;">SHIPPING ADDRESS</h4>
						</td>
					</tr>
					<tr>
						<td>
							<table width="100%">
								<tr>
									<th>Product Name</th>
									<th>Quantity</th>
									<th>Price</th>
									<th>Total</th>
								</tr>';
								$str .= $ocdetails;
						$str .='<tr>
									<th colspan="3" style="text-align:right;">Sub Total:</th>
									<th>$'.$total.'</th>
								</tr>';
						if($web=="Manualorder") {
							$str .='<tr>
										<th colspan="3" style="text-align:right;">Shipping:</th>
										<th>$00.00</th>
									</tr>';
						} else {
							if($total>350) {
								$str .='<tr>
										<th colspan="3" style="text-align:right;">Shipping:</th>
										<th>$00.00</th>
									</tr>';
							} else {
								$str .='<tr>
										<th colspan="3" style="text-align:right;">Shipping:</th>
										<th>$20.00</th>
									</tr>';
							}
						}
						
						if($web=="Manualorder") {
							/*$str .='<tr>
										<th colspan="3" style="text-align:right;">Discount:</th>
										<th>$00.00</th>
									</tr>';*/
						} else {
						/*if($total>600) {
								$dis = $total*7/100;
								$str .='<tr>
										<th colspan="3" style="text-align:right;">Discount:</th>
										<th>$'.$dis.'</th>
									</tr>';
							} else {
								$dis = 00;
								$str .='<tr>
										<th colspan="3" style="text-align:right;">Discount:</th>
										<th>$'.$dis.'</th>
									</tr>';
							}*/
							$dis = 00;
						}
						
						if($web=="Manualorder") {
							$str .='<tr>
									<th colspan="3" style="text-align:right;">Total:</th>
									<th>$'.$total.'</th>
								</tr>';
						} else {
							if($total>350) {
								$str .='<tr>
										<th colspan="3" style="text-align:right;">Total:</th>
										<th>$'.($total-$dis).'</th>
									</tr>';
								$total = $total-$dis;
							} else {
								$str .='<tr>
										<th colspan="3" style="text-align:right;">Total:</th>
										<th>$'.($total+20).'</th>
									</tr>';
								$total = $total+20;
							}
						}
						
					$str .='</table>
						</td>
						<td>
							<h4 style="margin:0px;">'.$name.'</h4>
							<p>'.$data->address.'<br>'.$data->city.'-'.$data->zip.',('.$data->country.').<br>'.$data->phone.'<br>'.$data->email.'</p>
							<span style="font-weight:400;">(Shipping Time 15-21 Days)</span>
						</td>
					</tr>';
		$str .='</table>
				
				<br>
				<center>
				<a href="https://oneglobalpharma.com/intermediate/modal_guide.php?link='.$pay_link.'" style="color: white;background-color: #31c8ea;padding: 10px;border-radius: 7px;box-shadow: 1px 4px 8px 0px #737373;border: 1px solid #fff;text-decoration:none;">PROCEED TO PAY $'.$total.'</a>
				</center>
				<br><br>
				
				
				<h3 style="border-bottom: 1px solid #bbbbbb;width: fit-content;color:#00c8ea;">7 Things To Note:</h3>
				<ul>
					<li>Order Will be shipped upon receiving the payment from you.</li>
					<li>Name appears on <b>credit card or paypal statements is "SHIP LIGHTS".</b></li>
					<li>Dont disclose the purchase of medication with Paypal.</li>
					<li>Your package will be shipped from our nearest warehouse.</li>
					<li>Tracking number will arrive in 2-3 days.</li>
					<li>Estimated delivery time is 15-21 days.</li>
					<li>In case of query or issue call or email us, Don\'t contact paypal. </li>
				</ul>
			</td>
		</tr> 
		
	</tbody>
</table>';
$subject = "Here is your invoice to pay for $".$total;

if($web=="Manualorder" || $web=="globalpharmamedicines.com") {
	sendmail("admin@globalpharmameds.com", "Newlands Pharmacy", $email, $subject, $str);
} else if($web=="thtramadol-howto.com"){
    sendmail("admin@tramadol-howto.com", "tramadol-howto.com", $email, $subject, $str);
} else if($web=="sedegital.com") {
	sendmail("admin@selcoenterprises.com", "Selco Digital", $email, $subject, $str);
} else {
    sendmail("admin@".$web, $web, $email, $subject, $str);
}





?>