<?php

$address = 'SELECT * FROM `tbl_cases_list` Where id="'.$id.'"';
$res = $dbdp->query($address);
$rowsadd = $res->fetch_assoc();

$orderid = $rowsadd['invid'];
$name = $rowsadd["name"];
$to_email = $rowsadd["email"];
$web = $rowsadd['web'];
if($web=="Manualorder" || $web=="globalpharmamedicines.com") {
	$web ="globalpharmameds.com";
}
				
											
$sql = 'SELECT * FROM tbl_traking_ids WHERE order_id="CS_'.$id.'"';
$result = $dbdp->query($sql);
$nor = $result->num_rows;

$str = '<div style="width: fit-content;margin: 0px auto;background-color: #f7f7f7;padding: 25px;border: 4px solid #e6e6e6;border-radius: 25px;"><table class="es-content esd-header-popover" cellspacing="0" cellpadding="0" align="center" width="600">
	<tbody>
		<tr>
			<td colspan="2" align="center">
				<h2><a href="'.$web.'" style="text-transform:uppercase;text-decoration:none;color:#171717;">Hi '.$name.',</a></h2>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<h3 style="color: #00af00;font-weight: 300;">Your package has been reshipped please find the details below</h3>';
				 
				    if($nor>0 && $nor < 2) {
						$row = $result->fetch_object();
						$str .= '<h1>Tracking ID: '.$row->tracking_id.'</h1>
						 <h2>Order No: '.$orderid.'</h2>
						 <p style="text-align:center;color:#4e4d4d;">We are contacting you from '.$web.' Thank you very much for providing an opportunity to do business with you.</p>
						 <br>
						 <br>';
						$str .='<a href="https://tools.usps.com/go/TrackConfirmAction?tRef=fullpage&tLc=2&text28777=&tLabels='.$row->tracking_id.'" style="color: #fff;text-decoration: none;background-color: #273b4e;padding: 13px 21px;font-size: 25px;">Track Now</a>';
					} else if($nor>1) {
						$str .= '<h2>Order No: '.$orderid.'</h2>
								 <p style="text-align:center;color:#4e4d4d;">We are contacting you from '.$web.' Thank you very much for providing an opportunity to do business with you.</p>
								 <br>
								 <br>';
						$str .= '<table cellspacing="10" cellpadding="5">
									<tr>
										<th>Tracking ID\'S</th>
										<th>Track Now</th>
									</tr>
								'; 
						while($rows = $result->fetch_assoc()) {
							//print_r($rows);
							$str .='<tr>
									<td>'.$rows['tracking_id'].'</td>
									<td> <a href="https://tools.usps.com/go/TrackConfirmAction?tRef=fullpage&tLc=2&text28777=&tLabels='.$rows['tracking_id'].'" style="color: #fff;text-decoration: none;background-color: #273b4e;padding: 5px 21px;font-size: 20px;">Track Now</a></td>
								</tr>';
						}
						$str .= '</table>'; 
					}
				 $str .= '<br>
				 <br><br>
				 <br>';
				 
			$str .='</td>
		</tr>
	</tbody>
</table></div>';

sendmail("admin@".$web, "Reship Order", $to_email, "Order ".$orderid." has been reshipped", $str);

?>