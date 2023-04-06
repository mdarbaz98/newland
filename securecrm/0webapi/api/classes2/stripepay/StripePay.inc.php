<?php 
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);

if(!isset($_SESSION)){
		session_start();
	} 
	include('config.php');
   $dbstripepay = getDBSTRIPEPAY();

class StripePay
{
    private $dbstripepay;

	function get_allorders_today($array, $inc) {
		global $dbstripepay;
		$date = date("d/m/Y");
		$sqls = $sqls = "SELECT * FROM `tmp_cart_tbl` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) ORDER BY id DESC";
		
		$result = $dbstripepay->query($sqls);
		while($row = $result->fetch_assoc()) {
			$arr['paymentsts'] = $row['id'];
			$arr['invid'] = "#INV-".$row['id']."".substr(strtotime($row["timestamp"]), 0, 4);
			$arr['date'] = date('d/m/Y', strtotime($row['timestamp']));
			$arr['phone'] = $this->get_customer_phoneno($row['id']);
		    $arr['email'] = $this->get_customer_email($row['id']);
			$arr['name'] = $this->get_customer_name($row['id']);
			$arr['address'] = $this->get_customer_address($row['id']);
			$arr['city'] = $this->get_customer_city($row['id']);
			$arr['state'] = $this->get_customer_state($row['id']);
			$arr['zip'] = $this->get_customer_zip($row['id']);
			$arr['country'] = $this->get_customer_country($row['id']);
			$arr['prname'] = $this->get_product_name($row['cart_items']);
			$arr['qty'] = $this->get_product_qty($row['cart_items']);
			$arr['amt'] = $this->get_product_price($row['cart_items']);
			$arr['shsts'] = $this->get_shiping_sts($row['id']);
			$arr['trck'] = $this->get_traking_ids($row['id']);
			$arr['noc'] = "--";
			$arr['cno'] = "XXXX XXXX XXXX XXXX";
			$arr['cex'] = "XX/XXXX";
			$arr['cvv'] = "XXX";
			$arr['oid'] = $row['id'];
			$arr['pay_link'] = $row['payment_link'];
			$arr['status'] = $row['status'];
			$arr['web'] = "sedegital.com";
			$arr['inc'] = $inc;
			array_push($array, $arr);
			$inc++;
		}
		return [$array, $inc];
	}
	
	function get_all_orders($array, $inc, $data) {
		global $dbstripepay;
		$sqls = "";
		switch($data->method) {
			case "d10":
				$sqls = "SELECT * FROM `tmp_cart_tbl` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) ORDER BY id DESC";
				break;
				
			case "d15" : 
				$sqls = "SELECT * FROM `tmp_cart_tbl` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 15 DAY) ORDER BY id DESC";
				break;
				
			case "m1": 
				$sqls = "SELECT * FROM `tmp_cart_tbl` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY id DESC";
				break;
				
			case "m6":
				$sqls = "SELECT * FROM `tmp_cart_tbl` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) ORDER BY id DESC";
				break;
				
			case "y1":
				$sqls = "SELECT * FROM `tmp_cart_tbl` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) ORDER BY id DESC";
				break;
				
			case "all":
				$sqls = "SELECT * FROM `tmp_cart_tbl` ORDER BY id DESC";
				break;
		}
		$result = $dbstripepay->query($sqls);
		while($row = $result->fetch_assoc()) {
			$arr['paymentsts'] = $row['id'];
			$arr['invid'] = "#INV-".$row['id']."".substr(strtotime($row["timestamp"]), 0, 4);
			$arr['date'] = date('d/m/Y', strtotime($row['timestamp']));
			$arr['phone'] = $this->get_customer_phoneno($row['id']);
		    $arr['email'] = $this->get_customer_email($row['id']);
			$arr['name'] = $this->get_customer_name($row['id']);
			$arr['address'] = $this->get_customer_address($row['id']);
			$arr['city'] = $this->get_customer_city($row['id']);
			$arr['state'] = $this->get_customer_state($row['id']);
			$arr['zip'] = $this->get_customer_zip($row['id']);
			$arr['country'] = $this->get_customer_country($row['id']);
			$arr['prname'] = $this->get_product_name($row['cart_items']);
			$arr['qty'] = $this->get_product_qty($row['cart_items']);
			$arr['amt'] = $this->get_product_price($row['cart_items']);
			$arr['shsts'] = $this->get_shiping_sts($row['id']);
			$arr['trck'] = $this->get_traking_ids($row['id']);
			$arr['noc'] = "--";
			$arr['cno'] = "XXXX XXXX XXXX XXXX";
			$arr['cex'] = "XX/XXXX";
			$arr['cvv'] = "XXX";
			$arr['oid'] = $row['id'];
			$arr['pay_link'] = $row['payment_link'];
			$arr['status'] = $row['status'];
			$arr['web'] = "sedegital.com";
			$arr['inc'] = $inc;
			array_push($array, $arr);
			$inc++;
		}
		
		return [$array, $inc];
	}
	
	
	function get_allorders_array($array) {
		global $dbstripepay;
		$sqls = "SELECT * FROM `tmp_cart_tbl` ORDER BY id DESC";
		$result = $dbstripepay->query($sqls);
		$inc = 0;
		while($row = $result->fetch_assoc()) {
			
			$arr['paymentsts'] = $row['id'];
			$arr['invid'] = "#INV-".$row['id']."".substr(strtotime($row["timestamp"]), 0, 4);
			$arr['date'] = date('d/m/Y', strtotime($row['timestamp']));
			$arr['phone'] = $this->get_customer_phoneno($row['id']);
		    $arr['email'] = $this->get_customer_email($row['id']);
			$arr['name'] = $this->get_customer_name($row['id']);
			$arr['address'] = $this->get_customer_address($row['id']);
			$arr['city'] = $this->get_customer_city($row['id']);
			$arr['state'] = $this->get_customer_state($row['id']);
			$arr['zip'] = $this->get_customer_zip($row['id']);
			$arr['country'] = $this->get_customer_country($row['id']);
			$arr['prname'] = $this->get_product_name($row['cart_items']);
			$arr['qty'] = $this->get_product_qty($row['cart_items']);
			$arr['amt'] = $this->get_product_price($row['cart_items']);
			$arr['shsts'] = $this->get_shiping_sts($row['id']);
			$arr['trck'] = $this->get_traking_ids($row['id']);
			$arr['noc'] = "--";
			$arr['cno'] = "XXXX XXXX XXXX XXXX";
			$arr['cex'] = "XX/XXXX";
			$arr['cvv'] = "XXX";
			$arr['oid'] = $row['id'];
			$arr['pay_link'] = $row['payment_link'];
			$arr['status'] = $row['status'];
			$arr['web'] = "sedegital.com";
			$arr['inc'] = $inc;
			
			array_push($array, $arr);
			$inc++;
		}
		
		return $array;
	}
	
	function get_single_order_array($pid) {
		global $dbstripepay;
		$parr = explode("|", $pid);
		$payid = explode("-",$parr[0]);
		if( strpos( $pid, "|" ) !== false) {
			$ids = explode($payid[1],$parr[1]); 
			$id =  $ids[0];
			$sqls = "SELECT * FROM `tmp_cart_tbl` WHERE id='".$id."'";
			$result = $dbstripepay->query($sqls);
			$nor = $result->num_rows;
			if($nor>0) {
				$row = $result->fetch_assoc();
				$arr['paymentsts'] = $row['id'];
				$arr['invid'] = "#INV-".$row['id']."".substr(strtotime($row["timestamp"]), 0, 4);
				$arr['date'] = date('d/m/Y', strtotime($row['timestamp']));
				$arr['phone'] = $this->get_customer_phoneno($row['id']);
				$arr['email'] = $this->get_customer_email($row['id']);
				$arr['name'] = $this->get_customer_name($row['id']);
				$arr['address'] = $this->get_customer_address($row['id']);
				$arr['city'] = $this->get_customer_city($row['id']);
				$arr['state'] = $this->get_customer_state($row['id']);
				$arr['zip'] = $this->get_customer_zip($row['id']);
				$arr['country'] = $this->get_customer_country($row['id']);
				$arr['prname'] = $this->get_product_name($row['cart_items']);
				$arr['qty'] = $this->get_product_qty($row['cart_items']);
				$arr['amt'] = $this->get_product_price($row['cart_items']);
				$arr['shsts'] = $this->get_shiping_sts($row['id']);
				$arr['trck'] = $this->get_traking_ids($row['id']);
				$arr['noc'] = "--";
				$arr['cno'] = "XXXX XXXX XXXX XXXX";
				$arr['cex'] = "XX/XXXX";
				$arr['cvv'] = "XXX";
				$arr['oid'] = $row['id'];
				$arr['pay_link'] = $row['payment_link'];
				$arr['status'] = $row['status'];
				$arr['web'] = "sedegital.com";
				$arr['inc'] = $inc;
				
				return $arr;
			} else {
				return array();
			}
		} else {
			return array();
		}
	}
	
	function get_single_order_array_byid($id) {
		global $dbstripepay;
		$sqls = "SELECT * FROM `tmp_cart_tbl` WHERE id='".$id."'";
		$result = $dbstripepay->query($sqls);
		$nor = $result->num_rows;
		if($nor>0) {
			$row = $result->fetch_assoc();
			$arr['paymentsts'] = $row['id'];
			$arr['invid'] = "#INV-".$row['id']."".substr(strtotime($row["timestamp"]), 0, 4);
			$arr['date'] = date('d/m/Y', strtotime($row['timestamp']));
			$arr['phone'] = $this->get_customer_phoneno($row['id']);
			$arr['email'] = $this->get_customer_email($row['id']);
			$arr['name'] = $this->get_customer_name($row['id']);
			$arr['address'] = $this->get_customer_address($row['id']);
			$arr['city'] = $this->get_customer_city($row['id']);
			$arr['state'] = $this->get_customer_state($row['id']);
			$arr['zip'] = $this->get_customer_zip($row['id']);
			$arr['country'] = $this->get_customer_country($row['id']);
			$arr['prname'] = $this->get_product_name($row['cart_items']);
			$arr['qty'] = $this->get_product_qty($row['cart_items']);
			$arr['amt'] = $this->get_product_price($row['cart_items']);
			$arr['shsts'] = $this->get_shiping_sts($row['id']);
			$arr['trck'] = $this->get_traking_ids($row['id']);
			$arr['noc'] = "--";
			$arr['cno'] = "XXXX XXXX XXXX XXXX";
			$arr['cex'] = "XX/XXXX";
			$arr['cvv'] = "XXX";
			$arr['oid'] = $row['id'];
			$arr['pay_link'] = $row['payment_link'];
			$arr['status'] = $row['status'];
			$arr['web'] = "sedegital.com";
			
			return $arr;
		} else {
			return array();
		}
	}
	
	
    function get_customer_email($id) {
		global $dbstripepay;
		$sql = 'select * from drg_billing_info where c_id="'.$id.'"';	
		$result1 = $dbstripepay->query($sql);
		$row = $result1->fetch_assoc();
		if(empty($row)) {
		    return 0;
		} else {
        	return mb_convert_encoding($row['bemail_address'], "UTF-8", "UTF-8");
		}
	}
	
	function get_customer_phoneno($id) {
		global $dbstripepay;
		$sql = 'select * from drg_billing_info where c_id="'.$id.'"';	
		$result1 = $dbstripepay->query($sql);
		$row = $result1->fetch_assoc();
		if(empty($row)) {
		    return 0;
		} else {
        	return mb_convert_encoding($row['bphone_number'], "UTF-8", "UTF-8");
		}
	}
	
	function get_customer_name($id) {
		global $dbstripepay;
		$sql = 'select * from drg_billing_info where c_id="'.$id.'"';	
		$result1 = $dbstripepay->query($sql);
		$row = $result1->fetch_assoc();
		if(empty($row)) {
		    return 0;
		} else {
        	return mb_convert_encoding($row['bfirst_name']." ".$row['blast_name'], "UTF-8", "UTF-8");
		}
	}
	
	function get_customer_address($id) {
		global $dbstripepay;
		$sql = 'select * from drg_billing_info where c_id="'.$id.'"';	
		$result1 = $dbstripepay->query($sql);
		$row = $result1->fetch_assoc();
		if(empty($row)) {
		    return 0;
		} else {
        	return mb_convert_encoding($row['baddress'], "UTF-8", "UTF-8");
		}
	}
	
	function get_customer_city($id) {
		global $dbstripepay;
		$sql = 'select * from drg_billing_info where c_id="'.$id.'"';	
		$result1 = $dbstripepay->query($sql);
		$row = $result1->fetch_assoc();
		if(empty($row)) {
		    return 0;
		} else {
        	return mb_convert_encoding($row['bcity'], "UTF-8", "UTF-8");
		}
	}
	
	function get_customer_state($id) {
		global $dbstripepay;
		$sql = 'select * from drg_billing_info where c_id="'.$id.'"';	
		$result1 = $dbstripepay->query($sql);
		$row = $result1->fetch_assoc();
		if(empty($row)) {
		    return 0;
		} else {
        	return mb_convert_encoding($row['bstate'], "UTF-8", "UTF-8");
		}
	}
	
	function get_customer_zip($id) {
		global $dbstripepay;
		$sql = 'select * from drg_billing_info where c_id="'.$id.'"';	
		$result1 = $dbstripepay->query($sql);
		$row = $result1->fetch_assoc();
		if(empty($row)) {
		    return 0;
		} else {
        	return mb_convert_encoding($row['bzip_code'], "UTF-8", "UTF-8");
		}
	}
	
	function get_customer_country($id) {
		global $dbstripepay;
		$sql = 'select * from drg_billing_info where c_id="'.$id.'"';	
		$result1 = $dbstripepay->query($sql);
		$row = $result1->fetch_assoc();
		if(empty($row)) {
		    return 0;
		} else {
        	return mb_convert_encoding($row['bcountry'], "UTF-8", "UTF-8");
		}
	}
	
	function get_product_name($items) {
		global $dbstripepay;
		$cartitems = json_decode($items);	
		$arr = array();
		
		foreach($cartitems as $key=>$value):
			$array['pname'] = $value->productname;
			$array['qty'] = $value->qty;
			$array['price'] = $value->price;
			array_push($arr, $array);
		endforeach;
		return $arr;
	}
	
	function get_product_qty($items) {
		global $dbstripepay;
		$cartitems = json_decode($items);	
		$arr = array();
		foreach($cartitems as $key=>$value):
			array_push($arr, $value->qty);
		endforeach;
		return $arr;
	}
	
	function get_product_price($items) {
		global $dbstripepay;
		$arr = array();
		$cartitems = json_decode($items);
		foreach($cartitems as $key=>$value):
			array_push($arr, $value->price);
		endforeach;
		return $arr;
	}
	
	
	function get_shiping_sts($id) {
		global $dbstripepay;
		$sql = "select * from tbl_shipping_sts where order_id='$id'";	
		$result1 = $dbstripepay->query($sql);
		$row = $result1->fetch_assoc();
		return empty($row['ship_name'])?"":$row['ship_name'];
	}
	
	function get_traking_ids($id) {
		global $dbstripepay;
		$sql = "select * from tbl_traking_ids where order_id='$id'";	
		$result1 = $dbstripepay->query($sql);
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
	
	
	/*Delete Order Function*/
	function delete_order_today($data, $array) {
		global $dbstripepay;
		$userData = '';
		$sql = "DELETE from tmp_cart_tbl WHERE id='".$data->id."'";
		$result = $dbstripepay->query($sql);
	}
	
	/*Delete Order Function*/
	function delete_trackingids($data, $array) {
		global $dbstripepay;
		$sql = "DELETE from tbl_traking_ids WHERE id='".$data->oid."'";
		$result = $dbstripepay->query($sql);
	}
	
	function delete_order($data, $array) {
		global $dbstripepay;
		$userData = '';
		$sql = "DELETE from tmp_cart_tbl WHERE id='".$data->id."'";
		$result = $dbstripepay->query($sql);
			$array = $this->get_allorders_array($array);
		return $array;
	} 
	
	/*Update order Status*/ 
	function update_order_status_todayoc($data, $array) {
		global $dbstripepay;
		$userData = '';
		$sql = "UPDATE `tmp_cart_tbl` SET `status`='".$data->statusval."' WHERE `id`='".$data->oid."'";
		$result = $dbstripepay->query($sql);
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
		global $dbstripepay;
		$userData = '';
		$sql = "UPDATE `tmp_cart_tbl` SET `status`='".$data->statusval."' WHERE `id`='".$data->oid."'";
		$result = $dbstripepay->query($sql);
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
		global $dbstripepay;
		if(!empty($data->shipp)) {
			$sql = "INSERT INTO `tbl_shipping_sts`(`order_id`, `ship_name`) VALUES ('".$data->oid."', '".$data->shipp."')";
			$result = $dbstripepay->query($sql);
		}
	}
	
	/*Add Order Payment Link function*/
	function addocpayment_link($data, $array) {
		global $dbstripepay;
		if(!empty($data->linkurl)) {
			$sql = "UPDATE tmp_cart_tbl SET `payment_link`='".$data->linkurl."' WHERE id='".$data->oid."'";
			$result = $dbstripepay->query($sql);
		}
	}
	
	function addshippingordercp($data, $array) {
		global $dbstripepay;
		if(!empty($data->shipp)) {
			$sql = "INSERT INTO `tbl_shipping_sts`(`order_id`, `ship_name`) VALUES ('".$data->oid."', '".$data->shipp."')";
			$result = $dbstripepay->query($sql);
		}
		$array = $this->get_allorders_array($array);
		return $array;
	}
	
	
	
	/*Add Traking All and Single IDS*/
	function addtrakingidtoday_oc($data, $array) {
		global $dbstripepay;
		foreach($data->trakingids as $value):
			if(!empty($value->trakingid)) {
				$sql = "INSERT INTO `tbl_traking_ids`(`order_id`, `tracking_id`, `tracking_link`) VALUES ('".$data->oid."', '".$value->trakingid."', '".$value->trakinglink."')";
				$result = $dbstripepay->query($sql);
			}
		endforeach;
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
	}
	
	function addtrakingid($data, $array) {
		global $dbstripepay;
		foreach($data->trakingids as $value):
			if(!empty($value->trakingid)) {
				$sql = "INSERT INTO `tbl_traking_ids`(`order_id`, `tracking_id`) VALUES ('".$data->oid."', '".$value->trakingid."')";
				$result = $dbstripepay->query($sql);
			}
		endforeach;
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
		$array = $this->get_allorders_array($array);
		return $array;
	}
	
	/*Function for Mark Order Dliver by suer via Mail*/
	function mark_oc_deliver($id) {
		global $dbstripepay;
		$sql = 'UPDATE `tmp_cart_tbl` SET status="Delivered" WHERE id="'.$id.'"';
		$result = $dbstripepay->query($sql);
		
	}
	
	/* FUnction to resend Traking ID in Modal dialog*/
	function resend_traking_mail($data) {
		global $dbstripepay;
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
	}
	
}?>