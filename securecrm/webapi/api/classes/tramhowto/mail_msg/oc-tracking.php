<?php

$address = 'SELECT * FROM `trhwp_wc_order_stats` Where order_id="'.$id.'"';
$res = $dbtrht->query($address);
$rowsadd = $res->fetch_assoc();
//$rowsadd = $res->fetch_assoc();
$orderid = "#".$rowsadd['order_id'];
//print_r($rowsadd); die;

$sql1 = 'select * from trhwp_postmeta where post_id="'.$rowsadd['order_id'].'" AND meta_key="_billing_email"';	
$result1 = $dbtrht->query($sql1);
$rows = $result1->fetch_assoc();
$to_email = mb_convert_encoding($rows['meta_value'], "UTF-8", "UTF-8");

//print_r($to_email); die;							
											
$sql = 'SELECT * FROM tbl_traking_ids WHERE order_id="'.$id.'"';
$result = $dbtrht->query($sql);


$sql3 = 'UPDATE trhwp_wc_order_stats SET status="Shipped" WHERE order_id="'.$id.'"';
$result3 =$dbtrht->query($sql3);


$nor = $result->num_rows;

$str = '<table class="es-content esd-header-popover" cellspacing="0" cellpadding="0" align="center" width="600">
	<tbody>
		<tr>
			<td colspan="2" align="center">
				<img src="https://tramadol-howto.com/wp-content/uploads/2020/01/logo-12.png" width="200px">
				<br>
				<br>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<h3>Thank You For Shop with us</h3>';
				 
				    if($nor>0 && $nor < 2) {
						$row = $result->fetch_object();
						$str .= '<h1>Your Traking ID: '.$row->tracking_id.'</h1>
						 <h2>Order No: #'.$orderid.'</h2>
						 <p style="text-align:center;color:#a9a9a9;">We are contacting you from tramadol-howto.com Thank you very much for providing an opportunity to do business with you.</p>
						 <br>
						 <br>';
						$str .='<a href="https://t.17track.net/en#nums='.$row->tracking_id.'" style="color: #fff;text-decoration: none;background-color: #007df9;padding: 13px 21px;font-size: 25px;border-radius: 9px;">Track Now</a>';
					} else if($nor>1) {
						$str .= '<h2>Order No: '.$orderid.'</h2>
								 <p style="text-align:center;color:#a9a9a9;">We are contacting you from tramadol-howto.com Thank you very much for providing an opportunity to do business with you.</p>
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
									<td> <a href="https://t.17track.net/en#nums='.$rows['tracking_id'].'" style="color: #fff;text-decoration: none;background-color: #007df9;padding: 5px 21px;font-size: 20px;border-radius: 3px;">Track Now</a></td>
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
</table>';

sendmail("admin@tramadol-howto.com", "Tramadol How-to", $to_email, "Track Your Order | Tramadol-howto.com.com", $str);

?>