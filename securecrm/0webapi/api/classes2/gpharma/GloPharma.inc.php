<?php 
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);

if(!isset($_SESSION)){
		session_start();
	} 
	include('config.php');
   $dbgp = getDBGP();

class GloPharma
{
    private $dbgp;

	function get_allorders_today($array, $inc) {
		global $dbgp;
		$date = date("d/m/Y");
		$sqls = "select * from orders where orderdate='".$date."' ORDER BY id DESC";
		
		$result = $dbgp->query($sqls);
		while($row = $result->fetch_assoc()) {
			$arr['paymentsts'] = $row['id'];
			$arr['invid'] = "#".$row['orderno'];
			$arr['date'] = $row['orderdate'];
			$arr['phone'] = $this->get_customer_phoneno($row['cust_id']);
			$arr['email'] = $this->get_customer_email($row['cust_id']);
			$arr['name'] = $this->get_customer_name($row['cust_id']);
			$arr['address'] = $this->get_customer_address($row['cust_id']);
			$arr['city'] = $this->get_customer_city($row['cust_id']);
			$arr['state'] = $this->get_customer_state($row['cust_id']);
			$arr['zip'] = $this->get_customer_zip($row['cust_id']);
			$arr['country'] = $this->get_customer_country($row['cust_id']);
						
			$arr['prname'] = $this->get_product_name($row['id']);
			
			$arr['qty'] = $this->get_product_qty($row['id']);
			$arr['amt'] = $this->get_product_price($row['id']);
			$arr['shsts'] = $this->get_shiping_sts($row['id']);
			$arr['trck'] = $this->get_traking_ids($row['id']);;
			$arr['noc'] = $this->get_name_on_card($row['id']);;
			$arr['cno'] = $this->get_card_no($row['id']);;
			$arr['cex'] = $this->get_card_expriry($row['id']);;
			$arr['cvv'] = $this->get_card_cvv($row['id']);;
			$arr['pay_link'] = $row['payment_link'];
			$arr['oid'] = $row['id'];
			$arr['status'] = $row['status'];
			$arr['web'] = "globalpharmamedicines.com";
			$arr['inc'] = $inc;
			array_push($array, $arr);
			$inc++;
		}
		
		return [$array, $inc];
	}
	
	
	function get_all_orders($array, $inc, $data) {
		global $dbgp;
		$sqls = "";
		switch($data->method) {
		   case "d10":
				$sqls = "select * from orders where STR_TO_DATE(orderdate, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) ORDER BY id DESC";
				break;
				
			case "d15" : 
				$sqls = "select * from orders where STR_TO_DATE(orderdate, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 15 DAY) ORDER BY id DESC";
				break;
				
			case "m1": 
				$sqls = "select * from orders where STR_TO_DATE(orderdate, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY id DESC";
				break;
				
			case "m6":
				$sqls = "select * from orders where STR_TO_DATE(orderdate, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) ORDER BY id DESC";
				break;
				
			case "y1":
				$sqls = "select * from orders where STR_TO_DATE(orderdate, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) ORDER BY id DESC";
				break;
				
			case "all":
				$sqls = "select * from orders ORDER BY id DESC";
				break;
		}
		$result = $dbgp->query($sqls);
		while($row = $result->fetch_assoc()) {
			$arr['paymentsts'] = $row['id'];
			$arr['invid'] = "#".$row['orderno'];
			$arr['date'] = $row['orderdate'];
			$arr['phone'] = $this->get_customer_phoneno($row['cust_id']);
			$arr['email'] = $this->get_customer_email($row['cust_id']);
			$arr['name'] = $this->get_customer_name($row['cust_id']);
			$arr['address'] = $this->get_customer_address($row['cust_id']);
			$arr['city'] = $this->get_customer_city($row['cust_id']);
			$arr['state'] = $this->get_customer_state($row['cust_id']);
			$arr['zip'] = $this->get_customer_zip($row['cust_id']);
			$arr['country'] = $this->get_customer_country($row['cust_id']);
			
			$arr['prname'] = $this->get_product_name($row['id']);
			
			$arr['qty'] = $this->get_product_qty($row['id']);
			$arr['amt'] = $this->get_product_price($row['id']);
			$arr['shsts'] = $this->get_shiping_sts($row['id']);
			$arr['trck'] = $this->get_traking_ids($row['id']);;
			$arr['noc'] = $this->get_name_on_card($row['id']);;
			$arr['cno'] = $this->get_card_no($row['id']);;
			$arr['cex'] = $this->get_card_expriry($row['id']);;
			$arr['cvv'] = $this->get_card_cvv($row['id']);;
			$arr['pay_link'] = $row['payment_link'];
			$arr['oid'] = $row['id'];
			$arr['status'] = $row['status'];
			$arr['web'] = "globalpharmamedicines.com";
			$arr['inc'] = $inc;
			array_push($array, $arr);
			$inc++;
		}
		
		return [$array, $inc];
	}
	
	
	
	
	function get_allorders_array($array) {
		global $dbgp;
		$sqls = "select * from orders ORDER BY id DESC";
		$result = $dbgp->query($sqls);
		$inc = 0;
		while($row = $result->fetch_assoc()) {
			$arr['paymentsts'] = $row['id'];
			$arr['invid'] = "#".$row['orderno'];
			$arr['date'] = $row['orderdate'];
			$arr['phone'] = $this->get_customer_phoneno($row['cust_id']);
			$arr['email'] = $this->get_customer_email($row['cust_id']);
			$arr['name'] = $this->get_customer_name($row['cust_id']);
			$arr['address'] = $this->get_customer_address($row['cust_id']);
			$arr['city'] = $this->get_customer_city($row['cust_id']);
			$arr['state'] = $this->get_customer_state($row['cust_id']);
			$arr['zip'] = $this->get_customer_zip($row['cust_id']);
			$arr['country'] = $this->get_customer_country($row['cust_id']);
				
			$arr['prname'] = $this->get_product_name($row['id']);
			
			$arr['qty'] = $this->get_product_qty($row['id']);
			$arr['amt'] = $this->get_product_price($row['id']);
			$arr['shsts'] = $this->get_shiping_sts($row['id']);
			$arr['trck'] = $this->get_traking_ids($row['id']);;
			$arr['noc'] = $this->get_name_on_card($row['id']);;
			$arr['cno'] = $this->get_card_no($row['id']);;
			$arr['cex'] = $this->get_card_expriry($row['id']);;
			$arr['cvv'] = $this->get_card_cvv($row['id']);;
			$arr['oid'] = $row['id'];
			$arr['status'] = $row['status'];
			$arr['web'] = "globalpharmamedicines.com";
			$arr['inc'] = $inc;
			
			array_push($array, $arr);
			$inc++;
		}
		
		return $array;
	}
	
	function get_single_order_array($pid) {
		global $dbgp;
			$id = ltrim($pid, '#'); 
			$sqls = "select * from orders WHERE orderno='".$id."'";
			$result = $dbgp->query($sqls);
			$nor = $result->num_rows;
			if($nor>0) {
				$row = $result->fetch_assoc();
				$arr['paymentsts'] = $row['id'];
				$arr['invid'] = "#".$row['orderno'];
				$arr['date'] = $row['orderdate'];
				$arr['phone'] = $this->get_customer_phoneno($row['cust_id']);
				$arr['email'] = $this->get_customer_email($row['cust_id']);
				$arr['name'] = $this->get_customer_name($row['cust_id']);
				$arr['address'] = $this->get_customer_address($row['cust_id']);
				$arr['city'] = $this->get_customer_city($row['cust_id']);
				$arr['state'] = $this->get_customer_state($row['cust_id']);
				$arr['zip'] = $this->get_customer_zip($row['cust_id']);
				$arr['country'] = $this->get_customer_country($row['cust_id']);
					
				$arr['prname'] = $this->get_product_name($row['id']);
				
				$arr['qty'] = $this->get_product_qty($row['id']);
				$arr['amt'] = $this->get_product_price($row['id']);
				$arr['shsts'] = $this->get_shiping_sts($row['id']);
				$arr['trck'] = $this->get_traking_ids($row['id']);;
				$arr['noc'] = $this->get_name_on_card($row['id']);;
				$arr['cno'] = $this->get_card_no($row['id']);;
				$arr['cex'] = $this->get_card_expriry($row['id']);;
				$arr['cvv'] = $this->get_card_cvv($row['id']);;
				$arr['oid'] = $row['id'];
				$arr['status'] = $row['status'];
				$arr['web'] = "globalpharmamedicines.com";
				
				return $arr;
			} else {
				return array();
			}
	}
	
	
	function get_single_order_array_byid($id) {
		global $dbgp;
		$sqls = "select * from orders WHERE id='".$id."'";
		$result = $dbgp->query($sqls);
		$nor = $result->num_rows;
		if($nor>0) {
			$row = $result->fetch_assoc();
			$arr['paymentsts'] = $row['id'];
			$arr['invid'] = "#".$row['orderno'];
			$arr['date'] = $row['orderdate'];
			$arr['phone'] = $this->get_customer_phoneno($row['cust_id']);
			$arr['email'] = $this->get_customer_email($row['cust_id']);
			$arr['name'] = $this->get_customer_name($row['cust_id']);
			$arr['address'] = $this->get_customer_address($row['cust_id']);
			$arr['city'] = $this->get_customer_city($row['cust_id']);
			$arr['state'] = $this->get_customer_state($row['cust_id']);
			$arr['zip'] = $this->get_customer_zip($row['cust_id']);
			$arr['country'] = $this->get_customer_country($row['cust_id']);
				
			$arr['prname'] = $this->get_product_name($row['id']);
			
			$arr['qty'] = $this->get_product_qty($row['id']);
			$arr['amt'] = $this->get_product_price($row['id']);
			$arr['shsts'] = $this->get_shiping_sts($row['id']);
			$arr['trck'] = $this->get_traking_ids($row['id']);;
			$arr['noc'] = $this->get_name_on_card($row['id']);;
			$arr['cno'] = $this->get_card_no($row['id']);;
			$arr['cex'] = $this->get_card_expriry($row['id']);;
			$arr['cvv'] = $this->get_card_cvv($row['id']);;
			$arr['oid'] = $row['id'];
			$arr['status'] = $row['status'];
			$arr['web'] = "globalpharmamedicines.com";
			
			return $arr;
		} else {
			return array();
		}
	}
	
    function get_customer_email($id) {
		global $dbgp;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $dbgp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['email'], "UTF-8", "UTF-8");
	}
	
	function get_customer_phoneno($id) {
		global $dbgp;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $dbgp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['phone'], "UTF-8", "UTF-8");
	}
	
	function get_customer_name($id) {
		global $dbgp;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $dbgp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['fname']." ".$row['lname'], "UTF-8", "UTF-8");
	}
	
	function get_customer_address($id) {
		global $dbgp;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $dbgp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['address'], "UTF-8", "UTF-8");
	}
	
	function get_customer_city($id) {
		global $dbgp;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $dbgp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['city'], "UTF-8", "UTF-8");
	}
	
	function get_customer_state($id) {
		global $dbgp;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $dbgp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['state'], "UTF-8", "UTF-8");
	}
	
	function get_customer_zip($id) {
		global $dbgp;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $dbgp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['zip'], "UTF-8", "UTF-8");
	}
	
	function get_customer_country($id) {
		global $dbgp;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $dbgp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['country'], "UTF-8", "UTF-8");
	}
	
	function get_product_name($id) {
		global $dbgp;
		$result = $dbgp->query("select * from order_details Where order_id='".$id."'");

		$arr = array();
		while($rows = $result->fetch_assoc()) {
			$sql = "select * from subcategory where sid='".$rows['pid']."' AND id=".$rows['cid']."";	
			$result1 = $dbgp->query($sql);
			$rows2 = $result1->fetch_assoc();
			
			$sql2 = "select * from pdetails where pid='".$rows['strength']."'";	
			$result2 = $dbgp->query($sql2);
			$rows3 = $result2->fetch_assoc();
		
			 $stren = empty($rows3['strength'])?"":$rows3['strength'];
			$array['pname'] = empty($rows2['productname'])?"":$rows2['productname'].": ".$stren;
			$array['qty'] = $rows['qty'];
			$array['price'] = $rows['price'];
			array_push($arr, $array);
		}
		return $arr;
	}
	
	function get_product_qty($id) {
		global $dbgp;
		$result = $dbgp->query("select * from order_details Where order_id='".$id."'");
		$arr = array();
		while($rows = $result->fetch_assoc()) {
			array_push($arr, $rows['qty']);
		}
		return $arr;
	}
	
	function get_product_price($id) {
		global $dbgp;
		$result = $dbgp->query("select * from order_details Where order_id='".$id."'");
		$arr = array();
		while($rows = $result->fetch_assoc()) {
			array_push($arr, $rows['price']);
		}
		return $arr;
	}
	
	function get_shiping_sts($id) {
		global $dbgp;
		$sql = "select * from tbl_shipping_sts where order_id='$id'";	
		$result1 = $dbgp->query($sql);
		$row = $result1->fetch_assoc();
		return empty($row['ship_name'])?"":$row['ship_name'];
	}
	
	function get_traking_ids($id) {
		global $dbgp;
		$sql = "select * from tbl_traking_ids where order_id='$id'";	
		$result1 = $dbgp->query($sql);
		$arr = array();
		while($row = $result1->fetch_assoc()) {
			if(empty($row['tracking_link'])) {
				array_push($arr, $row['tracking_id']);
			} else {
				array_push($arr, $row);
			}
		}
		return $arr;
	}
	
	function get_name_on_card($oid) {
		global $dbgp;
		$sql = "select * from cardinfo where oid='".$oid."'";	
		$result1 = $dbgp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['name_on_card'], "UTF-8", "UTF-8");
	}
	
	function get_card_no($oid) {
		global $dbgp;
		$sql = "select * from cardinfo where oid='".$oid."'";	
		$result1 = $dbgp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['credit_card_number'], "UTF-8", "UTF-8");
	}
	
	function get_card_expriry($oid) {
		global $dbgp;
		$sql = "select * from cardinfo where oid='".$oid."'";	
		$result1 = $dbgp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['exp_date'], "UTF-8", "UTF-8");
	}

	
	function get_card_cvv($oid) {
		global $dbgp;
		$sql = "select * from cardinfo where oid='".$oid."'";	
		$result1 = $dbgp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['cvv2'], "UTF-8", "UTF-8");
	}
	
	/*Delete Order Function*/
	function delete_order_today($data, $array) {
		global $dbgp;
		$userData = '';
		$sql = "DELETE from orders WHERE id='".$data->id."'";
		$result = $dbgp->query($sql);
	}
	
	/*Delete Order Function*/
	function delete_trackingids($data, $array) {
		global $dbgp;
		$userData = '';
		$sql = "DELETE from tbl_traking_ids WHERE id='".$data->oid."'";
		$result = $dbgp->query($sql);
	}
	
	function delete_order($data, $array) {
		global $dbgp;
		$userData = '';
		$sql = "DELETE from orders WHERE id='".$data->id."'";
		$result = $dbgp->query($sql);
			$array = $this->get_allorders_array($array);
		return $array;
	}
	
	/*Update order Status*/ 
	function update_order_status_todayoc($data, $array) {
		global $dbgp;
		$userData = '';
		$sql = "UPDATE `orders` SET `status`='".$data->statusval."' WHERE `id`='".$data->oid."'";
		$result = $dbgp->query($sql);
		if($data->statusval=="Cancelled") {
		} else if($data->statusval=="Delivered"){
			$id = $data->oid;
			include('mail_msg/oc-delivered.php');
		} else {
			$id = $data->oid;
			include('mail_msg/oc-status.php');
		}
	}
	
	function update_order_status($data, $array) {
		global $dbgp;
		$userData = '';
		$sql = "UPDATE `orders` SET `status`='".$data->statusval."' WHERE `id`='".$data->oid."'";
		$result = $dbgp->query($sql);
		if($data->statusval=="Cancelled") {
		} else {
			$id = $data->oid;
			include('mail_msg/oc-status.php');
		}
		$array = $this->get_allorders_array($array);
		return $array;
	}
	
	/*Add Order Payment Link function*/
	function addocpayment_link($data, $array) {
		global $dbgp;
		if(!empty($data->linkurl)) {
			$sql = "UPDATE `orders` SET `payment_link`='".$data->linkurl."' WHERE id='".$data->oid."'";
			$result = $dbgp->query($sql);
		}
	}
     
	/*Add Shipping company name function*/
	function addshipping_toc($data, $array) {
		global $dbgp;
		if(!empty($data->shipp)) {
			$sql = "INSERT INTO `tbl_shipping_sts`(`order_id`, `ship_name`) VALUES ('".$data->oid."', '".$data->shipp."')";
			$result = $dbgp->query($sql);
		}
	}
	
	function addshippinglobal($data, $array) {
		global $dbgp;
		if(!empty($data->shipp)) {
			$sql = "INSERT INTO `tbl_shipping_sts`(`order_id`, `ship_name`) VALUES ('".$data->oid."', '".$data->shipp."')";
			$result = $dbgp->query($sql);
		}
		$array = $this->get_allorders_array($array);
		return $array;
	}
	
	
	
	/*Add Traking All and Single IDS*/
	function addtrakingidtoday_oc($data, $array) {
		global $dbgp;
		foreach($data->trakingids as $value):
			if(!empty($value->trakingid)) {
				$sql = "INSERT INTO `tbl_traking_ids`(`order_id`, `tracking_id`, `tracking_link`) VALUES ('".$data->oid."', '".$value->trakingid."', '".$value->trakinglink."')";
				$result = $dbgp->query($sql);
			}
		endforeach;
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
	}
	
	function addtrakingid($data, $array) {
		global $dbgp;
		$id = 0;
		foreach($data->trakingids as $value):
			if(!empty($value->trakingid)) {
				$sql = "INSERT INTO `tbl_traking_ids`(`order_id`, `tracking_id`) VALUES ('".$data->oid."', '".$value->trakingid."')";
				$result = $dbgp->query($sql);
			}
		endforeach;
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
		$array = $this->get_allorders_array($array);
		return $array;
	}
	
	/*Function for Mark Order Dliver by suer via Mail*/
	function mark_oc_deliver($id) {
		global $dbgp;
		$sql = 'UPDATE `orders` SET status="Delivered" WHERE id="'.$id.'"';
		$result = $dbgp->query($sql);
	}
	
	/* FUnction to resend Traking ID in Modal dialog*/
	function resend_traking_mail($data) {
		global $dbgp;
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
	}
}?>