<?php

$str = '';
$total = 0;
if($data->web=="Manualorder" || $data->web=="globalpharmamedicines.com" || $data->web=="drugstoreplanet.com" || $data->web=="tramadolexport.com" || $data->web=="buyanxietymedicines") {
	$web ="https://globalpharmameds.com/";
} else if($data->web=="thtramadol-howto.com") {
	$web = "tramadol-howto.com";
} else if($data->web=="bytramadolonlinecod.com") {
	$web = "buytramadolonlinecod.com";
} else {
	$web = $data->web;
}

foreach($data->prname as $key=>$value):
		  if($data->web=="Manualorder") {
			  $str .='<tr>
					<td>'.$value->pname.'</td>
					<td>'.$value->qty.'</td>
					<td>$'.$value->price.'</td>
					<td>$'.$value->price.'</td>
				  </tr>';
			  $total = $total + $value->price;
		  } else {
			  $str .='<tr>
					<td>'.$value->pname.'</td>
					<td>'.$value->qty.'</td>
					<td>$'.$value->price.'</td>
					<td>$'.($value->qty*$value->price).'</td>
				  </tr>';
			  $total = $total + ($value->qty*$value->price);
		  }
		  
endforeach;


		$str .= '<tr>
					<td></td>
					<th colspan="2" align="right" style="border-top:2px solid gray;"><b>Sub Total: </b></th>
					<td style="border-top:2px solid gray;">$'.$total.'</td>
				</tr>';
		
		
	if($total>350) {
		$str .= '<tr>
					<td></td>
					<th colspan="2" align="right"><b>Shipping Free: </b></th>
					<td>$00.00</td>
				</tr>';
	} else {
		$str .= '<tr>
					<td></td>
					<th colspan="2" align="right"><b>Shipping: </b></th>
					<td>$20.00</td>
				</tr>';
	}

	if($total>350) {
		$str .='<tr>
				<td></td>
				<th colspan="2" align="right"><b>Total: </b></th>
				<td>$'.$total.'</td>
			</tr>';
	} else {
		$str .='<tr>
				<td></td>
				<th colspan="2" align="right"><b>Total: </b></th>
				<td>$'.($total+20).'</td>
			</tr>';
	}
		
$pname = "";
if(strpos(strtolower($data->prname[0]->pname), "tramadol") !== false){
    $arr = explode(" ",$data->prname[0]->pname);
    $pname = $arr[0];
} else if(strpos(strtolower($data->prname[0]->pname), "xanax") !== false) {
    $arr = explode(" ",$data->prname[0]->pname);
    $pname = $arr[0];
} else if(strpos($data->prname[0]->pname, ":") !== false){
    $arr = explode(" ",$data->prname[0]->pname);
    $pname = $arr[0];
} else {
    $pname = $data->prname[0]->pname;
}
		
		  
$msg ='';

$msg .='<table class="es-content esd-header-popover" cellspacing="0" cellpadding="0" align="center" width="600">
	<tbody>
		<tr>
			<td colspan="2" align="center">
				 <h1 style="color: #0093ff;">Hi '.$data->name.'</h1>
				 <p style="margin-bottom: 0px;font-size:20px;">We are Contacting from '.$web.' This is about your Last order that you placed with us For Some Medications in past. (Order Details are mentioned below)</p>
				 <br>
			</td>
		</tr>
		
		<tr>
		    <td colspan="2">
			<table align="center" width="100%;" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="2" align="center" style="font-size: 20px;color:#0093ff;">
						<h3> Previous Order Details </h3>
					</td>
				</tr>
				<tr>
					<td style="background-color:#e6e6e6;padding:10px;">
						<h4 style="margin: 0px;">ORDER DETAILS</h4>
					</td>
					<td style="background-color:#e6e6e6;padding:10px;">
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
						<h4 style="margin:0px;">'.$data->name.'</h4>
						<p>'.$data->address.'<br>'.$data->city.'-'.$data->zip.',('.$data->country.'<br>'.$data->phone.'<br>'.$data->email.'</p>
					</td>';
					
			
		$msg .='</tr>
				<tr>
					<td style="padding-top: 0px;" colspan="2">
						<hr style="border-top:3px solid #d0cfcf;">
						<br>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center" style="background-color: #f4f4f4;padding: 10px;">
						<div style="padding: 10px;font-size: 19px;">
							<h3 style="font-size: 20px;color:#0093ff;margin: 0px;margin-bottom:7px;">To reorder '.$pname.' or any other Medication</h3>
							Visit our online pharmacy
							<br>
							<br>
							<br>
							<a href="https://globalpharmameds.com/" style="padding: 10px 20px;
											background-color: #0093ff;
											margin-top: 27px;
											color: #fff;
											text-decoration: none;
											font-size: 20px;">Shop Now ></a>
											<br><br>
						</div>
					</td>
				</tr>
				<tr>
					<td style="padding-top: 0px;" colspan="2" align="center">
						<h3 style="font-size: 20px; line-height: 150%;color:#0093ff;">Hope we did well in delivering your previous order</h3>
						
						<p>We are leading online pharmacy to offer tramadol at very affordable price We deal in all kind of generic medications & Specialized in Selling all kind of pain relief, & anti-anxiety Medications at best affordable price</p>
						<br></br>

					</td>
				</tr>
				<tr>
					<td colspan="2">
					<br></br><hr>
						<h3 style="font-size: 20px;color:#0093ff;margin-bottom: 0px;">Benefits of ordering from us again </h3>
						<p>* Secure payment  by Credit/debit card</p>
						<p>* Lowest and affordable price</p>
						<p>* Genuine and Quality Generic Medications</p>
						<p>* Tracking Number will be provided after ordering</p>
						<p>* 24/7 Support on call and Email for issues & queries</p>
						<p>* Guaranteed Shipment in 15-20 days </p>
						<p>* Free 1 time reshipment if package stuck in customs</p>
						<p>* Followup on call & email with you until you receive your items</p>
						<p>* Free Shipping on orders above $350,  Discounts & Bonus pills </p>
					</td>
				</tr>
			</table>
			</td>
		</tr>
	</tbody>
</table>';





$subject = "Hey ".$data->name.", you've ordered ".$pname." from us in past";

sendmail("admin@alpapharma.com", "Your Order", $data->email, $subject, $msg); 

?>