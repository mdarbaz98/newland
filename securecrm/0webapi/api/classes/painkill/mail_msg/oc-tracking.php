<?php
$address = 'SELECT * FROM `orders` Where id="'.$id.'"';
$res = $db->query($address);
$rowsadd = $res->fetch_assoc();
//$rowsadd = $res->fetch_assoc();
//print_r($rowsadd); die;

$qqq=$db->query("select * from tbtcustomer where cid='".$rowsadd['cust_id']."'");
$rrr=$qqq->fetch_assoc();
$to_email = $rrr["email"];
											
$sql = 'SELECT * FROM tbl_traking_ids WHERE order_id="'.$id.'"';
$result = $db->query($sql);

$sql3 = 'UPDATE `orders` SET `status`="Shipped" WHERE `id`="'.$id.'"';
$result3 = $db->query($sql3);


$nor = $result->num_rows;
//print_r($row->tracking_id); die;

$str = '<table class="es-content esd-header-popover" cellspacing="0" cellpadding="0" align="center" width="600">
	<tbody>
		<tr>
			<td colspan="2" align="center">
				<img src="https://painkillermedicines.com/assets/img/logo.png">
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
						 <h2>Order No: #'.$rowsadd['orderno'].'</h2>
						 <p style="text-align:center;color:#a9a9a9;">We are contacting you from painkillermedicines.com Thank you very much for providing an opportunity to do business with you.</p>
						 <br>
						 <br>';
						$str .='<a href="https://t.17track.net/en#nums='.$row->tracking_id.'" style="color: #fff;text-decoration: none;background-color: #007df9;padding: 13px 21px;font-size: 25px;border-radius: 9px;">Track Now</a>';
					} else if($nor>1) {
						$str .= '<h2>Order No: #'.$rowsadd['orderno'].'</h2>
								 <p style="text-align:center;color:#a9a9a9;">We are contacting you from painkillermedicines.com Thank you very much for providing an opportunity to do business with you.</p>
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

sendmail("admin@painkillermedicines.com", "Pain Killer", $to_email, "Track Your Order | Painkillermedicines.com", $str);

?>