<?php 
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);

if(!isset($_SESSION)){
		session_start();
	} 
	include('config.php');
   $dbtrht = getTRAMHOWTO();

class TramHowto
{
    private $dbtrht;

	function get_allorders_today($array, $inc) {
		global $dbtrht;
		$date = date("d/m/Y");
		$sqls = 'SELECT * FROM `trhwp_wc_order_stats` WHERE `date_created` >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) ORDER BY order_id DESC';
		
		$result = $dbtrht->query($sqls);
		while($row = $result->fetch_assoc()) {
			$arr['paymentsts'] = $row['order_id'];
			$arr['invid'] = "#".$row['order_id'];
			$arr['date'] = date('d/m/Y', strtotime($row['date_created']));
			
			$arr['phone'] = $this->get_customer_phoneno($row['order_id']);
			$arr['email'] = $this->get_customer_email($row['order_id']);
			$arr['name'] = $this->get_customer_name($row['order_id']);
			$arr['address'] = $this->get_customer_address($row['order_id']);
			$arr['city'] = $this->get_customer_city($row['order_id']);
			$arr['state'] = $this->get_customer_state($row['order_id']);
			$arr['zip'] = $this->get_customer_zip($row['order_id']);
			$arr['country'] = $this->get_customer_country($row['order_id']);
			$arr['prname'] = $this->get_product_name($row['order_id']);
			$arr['qty'] = $this->get_product_qty($row['order_id']);
			$arr['amt'] = $this->get_product_price($row['order_id']);
			$arr['shsts'] = $this->get_shiping_sts($row['order_id']);
			$arr['trck'] = $this->get_traking_ids($row['order_id']);
			$arr['noc'] = 'XXXXXX XXX';
			$arr['cno'] = 'XXXX XXXX XXXX XXXX'; 
			$arr['cex'] = 'XX';
			$arr['cvv'] = 'XXX';
			$arr['pay_link'] = $row['payment_link'];
			$arr['oid'] = $row['order_id'];
			$arr['status'] = $row['status']=='wc-processing'?'Pending':$row['status'];
			$arr['web'] = "thtramadol-howto.com";
			$arr['inc'] = $inc;
			array_push($array, $arr);
			$inc++;
		}
		return [$array, $inc];
	}
	
	function get_all_orders($array, $inc, $data) {
		global $dbtrht;
		$sqls = "";
		switch($data->method) {
			case "d10":
				$sqls = "SELECT * FROM `trhwp_wc_order_stats` WHERE `date_created` >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) ORDER BY order_id DESC";
				break;
				
			case "d15" : 
				$sqls = "SELECT * FROM `trhwp_wc_order_stats` WHERE `date_created` >= DATE_SUB(CURDATE(), INTERVAL 15 DAY) ORDER BY order_id DESC";
				break;
				
			case "m1": 
				$sqls = "SELECT * FROM `trhwp_wc_order_stats` WHERE `date_created` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY order_id DESC";
				break;
				
			case "m6":
				$sqls = "SELECT * FROM `trhwp_wc_order_stats` WHERE `date_created` >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) ORDER BY order_id DESC";
				break;
				
			case "y1":
				$sqls = "SELECT * FROM `trhwp_wc_order_stats` WHERE `date_created` >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) ORDER BY order_id DESC";
				break;
				
			case "all":
				$sqls = "SELECT * FROM `trhwp_wc_order_stats` ORDER BY order_id DESC";
				break;
		}
		$result = $dbtrht->query($sqls);
		while($row = $result->fetch_assoc()) {
			$arr['paymentsts'] = $row['order_id'];
			$arr['invid'] = "#".$row['order_id'];
			$arr['date'] = date('d/m/Y', strtotime($row['date_created']));
			
			$arr['phone'] = $this->get_customer_phoneno($row['order_id']);
			$arr['email'] = $this->get_customer_email($row['order_id']);
			$arr['name'] = $this->get_customer_name($row['order_id']);
			$arr['address'] = $this->get_customer_address($row['order_id']);
			$arr['city'] = $this->get_customer_city($row['order_id']);
			$arr['state'] = $this->get_customer_state($row['order_id']);
			$arr['zip'] = $this->get_customer_zip($row['order_id']);
			$arr['country'] = $this->get_customer_country($row['order_id']);
			$arr['prname'] = $this->get_product_name($row['order_id']);
			$arr['qty'] = $this->get_product_qty($row['order_id']);
			$arr['amt'] = $this->get_product_price($row['order_id']);
			$arr['shsts'] = $this->get_shiping_sts($row['order_id']);
			$arr['trck'] = $this->get_traking_ids($row['order_id']);
			$arr['noc'] = 'XXXXXX XXX';
			$arr['cno'] = 'XXXX XXXX XXXX XXXX'; 
			$arr['cex'] = 'XX';
			$arr['cvv'] = 'XXX';
			$arr['pay_link'] = $row['payment_link'];
			$arr['oid'] = $row['order_id'];
			$arr['status'] = $row['status']=='wc-processing'?'Pending':$row['status'];
			$arr['web'] = "thtramadol-howto.com";
			$arr['inc'] = $inc;
			array_push($array, $arr);
			$inc++;
		}
		
		return [$array, $inc];
	}
	
	function get_allorders_array($array) {
		global $dbtrht;
		$sqls = "SELECT * FROM `trhwp_wc_order_stats` ORDER BY order_id DESC";
		$result = $dbtrht->query($sqls);
		$inc = 0;
		while($row = $result->fetch_assoc()) {
			
			$arr['paymentsts'] = $row['order_id'];
			$arr['invid'] = "#".$row['order_id'];
			$arr['date'] = date('d/m/Y', strtotime($row['date_created']));
			
			$arr['phone'] = $this->get_customer_phoneno($row['order_id']);
			$arr['email'] = $this->get_customer_email($row['order_id']);
			$arr['name'] = $this->get_customer_name($row['order_id']);
			$arr['address'] = $this->get_customer_address($row['order_id']);
			$arr['city'] = $this->get_customer_city($row['order_id']);
			$arr['state'] = $this->get_customer_state($row['order_id']);
			$arr['zip'] = $this->get_customer_zip($row['order_id']);
			$arr['country'] = $this->get_customer_country($row['order_id']);
			$arr['prname'] = $this->get_product_name($row['order_id']);
			$arr['qty'] = $this->get_product_qty($row['order_id']);
			$arr['amt'] = $this->get_product_price($row['order_id']);
			$arr['shsts'] = $this->get_shiping_sts($row['order_id']);
			$arr['trck'] = $this->get_traking_ids($row['order_id']);
			$arr['noc'] = 'XXXXXX XXX';
			$arr['cno'] = 'XXXX XXXX XXXX XXXX'; 
			$arr['cex'] = 'XX';
			$arr['cvv'] = 'XXX';
			$arr['pay_link'] = $row['payment_link'];
			$arr['oid'] = $row['order_id'];
			$arr['status'] = $row['status']=='wc-processing'?'Pending':$row['status'];
			$arr['web'] = "thtramadol-howto.com";
			$arr['inc'] = $inc;
			
			array_push($array, $arr);
			$inc++;
		}
		
		return $array;
	}
	
	function get_single_order_array($pid) {
		global $dbtrht;
		$sqls = "SELECT * FROM `trhwp_wc_order_stats` WHERE order_id='".$pid."'";
		$result = $dbtrht->query($sqls);
		$nor = $result->num_rows;
		$row = $result->fetch_assoc();
		if($nor>0) {
			$arr['paymentsts'] = $row['order_id'];
			$arr['invid'] = "#".$row['order_id'];
			$arr['date'] = date('d/m/Y', strtotime($row['date_created']));
			
			$arr['phone'] = $this->get_customer_phoneno($row['order_id']);
			$arr['email'] = $this->get_customer_email($row['order_id']);
			$arr['name'] = $this->get_customer_name($row['order_id']);
			$arr['address'] = $this->get_customer_address($row['order_id']);
			$arr['city'] = $this->get_customer_city($row['order_id']);
			$arr['state'] = $this->get_customer_state($row['order_id']);
			$arr['zip'] = $this->get_customer_zip($row['order_id']);
			$arr['country'] = $this->get_customer_country($row['order_id']);
			$arr['prname'] = $this->get_product_name($row['order_id']);
			$arr['qty'] = $this->get_product_qty($row['order_id']);
			$arr['amt'] = $this->get_product_price($row['order_id']);
			$arr['shsts'] = $this->get_shiping_sts($row['order_id']);
			$arr['trck'] = $this->get_traking_ids($row['order_id']);
			$arr['noc'] = 'XXXXXX XXX';
			$arr['cno'] = 'XXXX XXXX XXXX XXXX'; 
			$arr['cex'] = 'XX';
			$arr['cvv'] = 'XXX';
			$arr['pay_link'] = $row['payment_link'];
			$arr['oid'] = $row['order_id'];
			$arr['status'] = $row['status']=='wc-processing'?'Pending':$row['status'];
			$arr['web'] = "thtramadol-howto.com";
			
			return $arr;
		} else {
			return array();
		}
	}
	
	function get_single_order_array_byid($pid) {
		global $dbtrht;
		$sqls = "SELECT * FROM `trhwp_wc_order_stats` WHERE order_id='".$pid."'";
		$result = $dbtrht->query($sqls);
		$nor = $result->num_rows;
		$row = $result->fetch_assoc();
		if($nor>0) {
			$arr['paymentsts'] = $row['order_id'];
			$arr['invid'] = "#".$row['order_id'];
			$arr['date'] = date('d/m/Y', strtotime($row['date_created']));
			
			$arr['phone'] = $this->get_customer_phoneno($row['order_id']);
			$arr['email'] = $this->get_customer_email($row['order_id']);
			$arr['name'] = $this->get_customer_name($row['order_id']);
			$arr['address'] = $this->get_customer_address($row['order_id']);
			$arr['city'] = $this->get_customer_city($row['order_id']);
			$arr['state'] = $this->get_customer_state($row['order_id']);
			$arr['zip'] = $this->get_customer_zip($row['order_id']);
			$arr['country'] = $this->get_customer_country($row['order_id']);
			$arr['prname'] = $this->get_product_name($row['order_id']);
			$arr['qty'] = $this->get_product_qty($row['order_id']);
			$arr['amt'] = $this->get_product_price($row['order_id']);
			$arr['shsts'] = $this->get_shiping_sts($row['order_id']);
			$arr['trck'] = $this->get_traking_ids($row['order_id']);
			$arr['noc'] = 'XXXXXX XXX';
			$arr['cno'] = 'XXXX XXXX XXXX XXXX'; 
			$arr['cex'] = 'XX';
			$arr['cvv'] = 'XXX';
			$arr['pay_link'] = $row['payment_link'];
			$arr['oid'] = $row['order_id'];
			$arr['status'] = $row['status']=='wc-processing'?'Pending':$row['status'];
			$arr['web'] = "thtramadol-howto.com";
			
			return $arr;
		} else {
			return array();
		}
	}
	
	
	function get_customer_phoneno($oid) {
		global $dbtrht;
		$sql = 'select * from trhwp_postmeta where post_id="'.$oid.'" AND meta_key="_billing_phone"';	
		$result1 = $dbtrht->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['meta_value'], "UTF-8", "UTF-8");
	}
	
	function get_customer_email($oid) {
		global $dbtrht;
		$sql = 'select * from trhwp_postmeta where post_id="'.$oid.'" AND meta_key="_billing_email"';	
		$result1 = $dbtrht->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['meta_value'], "UTF-8", "UTF-8");
	}
	
	function get_customer_name($oid) {
		global $dbtrht;
		$sql = 'select * from trhwp_postmeta where post_id="'.$oid.'" AND meta_key="_shipping_first_name" ';	
		$result1 = $dbtrht->query($sql);
		$row = $result1->fetch_assoc();
		
		$sql2 = 'select * from trhwp_postmeta where post_id="'.$oid.'" AND meta_key="_shipping_last_name" ';	
		$result12 = $dbtrht->query($sql2);
		$row2 = $result12->fetch_assoc();
		return mb_convert_encoding($row['meta_value']." ".$row2['meta_value'], "UTF-8", "UTF-8");
	}
	
	function get_customer_address($oid) {
		global $dbtrht;
		$sql = 'select * from trhwp_postmeta where post_id="'.$oid.'" AND meta_key="_shipping_address_index"';	
		$result1 = $dbtrht->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['meta_value'], "UTF-8", "UTF-8");
	}
	
	function get_customer_city($oid) {
		global $dbtrht;
		$sql = 'select * from trhwp_postmeta where post_id="'.$oid.'" AND meta_key="_shipping_city"';	
		$result1 = $dbtrht->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['meta_value'], "UTF-8", "UTF-8");
	}
	
	function get_customer_state($oid) {
		global $dbtrht;
		$sql = 'select * from trhwp_postmeta where post_id="'.$oid.'" AND meta_key="_shipping_state"';	
		$result1 = $dbtrht->query($sql);
		$row = $result1->fetch_assoc();
		if(empty($row)) {
		    return 0;
		} else {
		    return mb_convert_encoding($row['meta_value'], "UTF-8", "UTF-8");
		}
	}
	
	function get_customer_zip($oid) {
		global $dbtrht;
		$sql = 'select * from trhwp_postmeta where post_id="'.$oid.'" AND meta_key="_shipping_postcode"';	
		$result1 = $dbtrht->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['meta_value'], "UTF-8", "UTF-8");
	}
	
	function get_customer_country($oid) {
		global $dbtrht;
		$sql = 'select * from trhwp_postmeta where post_id="'.$oid.'" AND meta_key="_shipping_country"';	
		$result1 = $dbtrht->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['meta_value'], "UTF-8", "UTF-8");
	}
	
	function get_product_name($oid) {
		global $dbtrht;
		$array = array();
		$result = $dbtrht->query("select * from trhwp_woocommerce_order_items Where order_id='".$oid."' AND order_item_type='line_item'");
		while($rows = $result->fetch_assoc()) {	
			$arr['pname'] = $rows['order_item_name']."/".$this->get_product_mgin($rows['order_item_id']);
			$arr['qty'] = $this->get_product_qtyin($rows['order_item_id']);
			$arr['price'] = $this->get_product_totin($rows['order_item_id'])/$arr['qty'];
			array_push($array, $arr);
		}
		return $array;
	}
	
	function get_product_qtyin($id) {
		global $dbtrht;
		$result = $dbtrht->query("SELECT * FROM `trhwp_woocommerce_order_itemmeta` WHERE `order_item_id` = '".$id."' AND `meta_key`='select-quality'");
		if($result->num_rows<1) {
			$result = $dbtrht->query("SELECT * FROM `trhwp_woocommerce_order_itemmeta` WHERE `order_item_id` = '".$id."' AND `meta_key`='select-quantity'");
		}
		$rows = $result->fetch_assoc();
		return $rows['meta_value'];
	}
	
	function get_product_mgin($id) {
		global $dbtrht;
		$result = $dbtrht->query("select * from trhwp_woocommerce_order_itemmeta Where order_item_id='".$id."' AND meta_key='select-mg'");
		$rows = $result->fetch_assoc();
		return empty($rows['meta_value'])?"":$rows['meta_value'];
	}

	function get_product_totin($id) {
		global $dbtrht;
		$result = $dbtrht->query("select * from trhwp_woocommerce_order_itemmeta Where order_item_id='".$id."' AND meta_key='_line_subtotal'");
		$rows = $result->fetch_assoc();
		return $rows['meta_value'];
	}
	
	function get_product_qty($oid) {
		global $dbtrht;
		$result = $dbtrht->query("select * from trhwp_woocommerce_order_items Where order_id='".$oid."' AND order_item_type='line_item'");
		$rows1 = $result->fetch_assoc();
		$result = $dbtrht->query("SELECT * FROM `trhwp_woocommerce_order_itemmeta` WHERE `order_item_id`='".$rows1['order_item_id']."' AND meta_key='select-quality'");
		$rows = $result->fetch_assoc();
		return empty($rows['meta_value'])?"":$rows['meta_value'];
	}
	
	function get_product_price($oid) {
		global $dbtrht;
		$result = $dbtrht->query("select * from trhwp_woocommerce_order_items Where order_id='".$oid."' AND order_item_type='line_item'");
		$rows1 = $result->fetch_assoc();
		$result = $dbtrht->query("select * from trhwp_woocommerce_order_itemmeta Where order_item_id='".$rows1['order_item_id']."' AND meta_key='select-quality' ");
		if($result->num_rows<1) {
			$result = $dbtrht->query("SELECT * FROM `trhwp_woocommerce_order_itemmeta` WHERE `order_item_id` = '".$rows1['order_item_id']."' AND `meta_key`='select-quantity'");
		}
		$rows = $result->fetch_assoc();
		$price = $this->get_product_totin($rows['order_item_id'])/$rows['meta_value'];
		return $price;
	}
	
	function get_shiping_sts($id) {
		global $dbtrht;
		$sql = "select * from tbl_shipping_sts where order_id='$id'";	
		$result1 = $dbtrht->query($sql);
		$row = $result1->fetch_assoc();
		return empty($row['ship_name'])?"":$row['ship_name'];
	}
	
	function get_traking_ids($id) {
		global $dbtrht;
		$sql = "select * from tbl_traking_ids where order_id='$id'";	
		$result1 = $dbtrht->query($sql);
		$arr = array();
		while($row = $result1->fetch_assoc()) {
			array_push($arr, $row['tracking_id']);
		}
		return $arr;
	}
	
	/*Delete Order Function*/
	function delete_order_today($data, $array) {
		global $dbtrht;
		$userData = '';
		$sql = "DELETE from trhwp_wc_order_stats WHERE order_id='".$data->id."'";
		$result = $dbtrht->query($sql);
	}
	
	function delete_order($data, $array) {
		global $dbtrht;
		$userData = '';
		$sql = "DELETE from trhwp_wc_order_stats WHERE order_id='".$data->id."'";
		$result = $dbtrht->query($sql);
		$array = $this->get_allorders_array($array);
		return $array;
	} 
	
	
	/*Update order Status*/ 
	function update_order_status_todayoc($data, $array) {
		global $dbtrht;
		$userData = '';
		$sql = "UPDATE `trhwp_wc_order_stats` SET `status`='".$data->statusval."' WHERE `order_id`='".$data->oid."'";
		$result = $dbtrht->query($sql);
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
		global $dbtrht;
		$userData = '';
		$sql = "UPDATE `trhwp_wc_order_stats` SET `status`='".$data->statusval."' WHERE `order_id`='".$data->oid."'";
		$result = $dbtrht->query($sql);
		if($data->statusval=="Cancelled") {
		} else {
			$id = $data->oid;
			include('mail_msg/oc-status.php');
		}
		$array = $this->get_allorders_array($array);
		return $array;
	}
	
	
	/*Add Shipping company name function*/
	function addshipping_toc($data, $array) {
		global $dbtrht;
		if(!empty($data->shipp)) {
			$sql = "INSERT INTO `tbl_shipping_sts`(`order_id`, `ship_name`) VALUES ('".$data->oid."', '".$data->shipp."')";
			$result = $dbtrht->query($sql);
		}
	}
	
	/*Add Order Payment Link function*/
	function addocpayment_link($data, $array) {
		global $dbtrht;
		if(!empty($data->linkurl)) {
			$sql = "UPDATE trhwp_wc_order_stats SET `payment_link`='".$data->linkurl."' WHERE order_id='".$data->oid."'";
			$result = $dbtrht->query($sql);
		}
	}
	
	function addshippingall_order($data, $array) {
		global $dbtrht;
		if(!empty($data->shipp)) {
			$sql = "INSERT INTO `tbl_shipping_sts`(`order_id`, `ship_name`) VALUES ('".$data->oid."', '".$data->shipp."')";
			$result = $dbtrht->query($sql);
		}
		$array = $this->get_allorders_array($array);
		return $array;
	}
	
	/*Add Traking All and Single IDS*/
	function addtrakingidtoday_oc($data, $array) {
		global $dbtrht;
		foreach($data->trakingids as $value):
			if(!empty($value->trakingid)) {
				$sql = "INSERT INTO `tbl_traking_ids`(`order_id`, `tracking_id`) VALUES ('".$data->oid."', '".$value->trakingid."')";
				$result = $dbtrht->query($sql);
			}
		endforeach;
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
	}
	
	function addtrakingid($data, $array) {
		global $dbtrht;
		foreach($data->trakingids as $value):
			if(!empty($value->trakingid)) {
				$sql = "INSERT INTO `tbl_traking_ids`(`order_id`, `tracking_id`) VALUES ('".$data->oid."', '".$value->trakingid."')";
				$result = $dbtrht->query($sql);
			}
		endforeach;
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
		$array = $this->get_allorders_array($array);
		return $array;
	}
	
	/*Function for Mark Order Dliver by suer via Mail*/
	function mark_oc_deliver($id) {
		global $dbtrht;
		$sql = 'UPDATE `trhwp_wc_order_stats` SET status="Delivered" WHERE order_id="'.$id.'"';
		$result = $dbtrht->query($sql);
		
	}
	
	/* FUnction to resend Traking ID in Modal dialog*/
	function resend_traking_mail($data) {
		global $dbtrht;
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
	}
	
	
	
	
	
}?>