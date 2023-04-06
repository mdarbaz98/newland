<?php 
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);

if(!isset($_SESSION)){
		session_start();
	} 
	include('config.php');
   $dbtrolcod = getDBTRAOLCOD();

class TraOnlineCod
{
    private $dbtrolcod;

	function get_allorders_today($array, $inc) {
		global $dbtrolcod;
		$date = date("d/m/Y");
		$sqls = $sqls = "SELECT * FROM `drg_order_tbl` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) ORDER BY id DESC";
		
		$result = $dbtrolcod->query($sqls);
		while($row = $result->fetch_assoc()) {
			$arr['paymentsts'] = $row['id'];
			$arr['invid'] = "#INV-".$row['payid']."|".$row['id']."".$row['payid']."".$row['address'];
			$arr['date'] = date('d/m/Y', strtotime($row['timestamp']));
			$arr['phone'] = $this->get_customer_phoneno($row['address']);
		    $arr['email'] = $this->get_customer_email($row['address']);
			$arr['name'] = $this->get_customer_name($row['address']);
			$arr['address'] = $this->get_customer_address($row['address']);
			$arr['city'] = $this->get_customer_city($row['address']);
			$arr['state'] = $this->get_customer_state($row['address']);
			$arr['zip'] = $this->get_customer_zip($row['address']);
			$arr['country'] = $this->get_customer_country($row['address']);
			$arr['prname'] = $this->get_product_name($row['order_ids'], date('Y-m-d', strtotime($row['timestamp']))); 
			$arr['qty'] = $this->get_product_qty($row['order_ids']);
			$arr['amt'] = $this->get_product_price($row['order_ids']);
			$arr['shsts'] = $this->get_shiping_sts($row['id']);
			$arr['trck'] = $this->get_traking_ids($row['id']);
			$arr['noc'] = $this->get_name_on_card($row['payid']);
			$arr['cno'] = $this->get_card_no($row['payid']);;
			$arr['cex'] = $this->get_card_expriry($row['payid']);;
			$arr['cvv'] = $this->get_card_cvv($row['payid']);;
			$arr['pay_link'] = $row['payment_link'];
			$arr['oid'] = $row['id'];
			$arr['status'] = $row['status'];
			$arr['web'] = "bytramadolonlinecod.com";
			$arr['inc'] = $inc;
			array_push($array, $arr);
			$inc++;
			
		}
		return [$array, $inc];
	}
	
	function get_all_orders($array, $inc, $data) {
		global $dbtrolcod;
		$sqls = "";
		switch($data->method) {
			case "d10":
				$sqls = "SELECT * FROM `drg_order_tbl` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) ORDER BY id DESC";
				break;
				
			case "d15" : 
				$sqls = "SELECT * FROM `drg_order_tbl` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 15 DAY) ORDER BY id DESC";
				break;
				
			case "m1": 
				$sqls = "SELECT * FROM `drg_order_tbl` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY id DESC";
				break;
				
			case "m6":
				$sqls = "SELECT * FROM `drg_order_tbl` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) ORDER BY id DESC";
				break;
				
			case "y1":
				$sqls = "SELECT * FROM `drg_order_tbl` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) ORDER BY id DESC";
				break;
				
			case "all":
				$sqls = "SELECT * FROM `drg_order_tbl` ORDER BY id DESC";
				break;
		}
		$result = $dbtrolcod->query($sqls);
		while($row = $result->fetch_assoc()) {
			$arr['paymentsts'] = $row['id'];
			$arr['invid'] = "#INV-".$row['payid']."|".$row['id']."".$row['payid']."".$row['address'];
			$arr['date'] = date('d/m/Y', strtotime($row['timestamp']));
			$arr['phone'] = $this->get_customer_phoneno($row['address']);
		    $arr['email'] = $this->get_customer_email($row['address']);
			$arr['name'] = $this->get_customer_name($row['address']);
			$arr['address'] = $this->get_customer_address($row['address']);
			$arr['city'] = $this->get_customer_city($row['address']);
			$arr['state'] = $this->get_customer_state($row['address']);
			$arr['zip'] = $this->get_customer_zip($row['address']);
			$arr['country'] = $this->get_customer_country($row['address']);
			$arr['prname'] = $this->get_product_name($row['order_ids'], date('Y-m-d', strtotime($row['timestamp'])));
			$arr['qty'] = $this->get_product_qty($row['order_ids']);
			$arr['amt'] = $this->get_product_price($row['order_ids']);
			$arr['shsts'] = $this->get_shiping_sts($row['id']);
			$arr['trck'] = $this->get_traking_ids($row['id']);
			$arr['noc'] = $this->get_name_on_card($row['payid']);
			$arr['cno'] = $this->get_card_no($row['payid']);;
			$arr['cex'] = $this->get_card_expriry($row['payid']);;
			$arr['cvv'] = $this->get_card_cvv($row['payid']);;
			$arr['pay_link'] = $row['payment_link'];
			$arr['oid'] = $row['id'];
			$arr['status'] = $row['status'];
			$arr['web'] = "bytramadolonlinecod.com";
			$arr['inc'] = $inc;
			array_push($array, $arr);
			$inc++;
		}
		
		return [$array, $inc];
	}
	
	
	function get_allorders_array($array) {
		global $dbtrolcod;
		$sqls = "SELECT * FROM `drg_order_tbl` ORDER BY id DESC";
		$result = $dbtrolcod->query($sqls);
		$inc = 0;
		while($row = $result->fetch_assoc()) {
			
			$arr['paymentsts'] = $row['id'];
			$arr['invid'] = "#INV-".$row['payid']."|".$row['id']."".$row['payid']."".$row['address'];
			$arr['date'] = date('d/m/Y', strtotime($row['timestamp']));
			$arr['phone'] = $this->get_customer_phoneno($row['address']);
		    $arr['email'] = $this->get_customer_email($row['address']);
			$arr['name'] = $this->get_customer_name($row['address']);
			$arr['address'] = $this->get_customer_address($row['address']);
			$arr['city'] = $this->get_customer_city($row['address']);
			$arr['state'] = $this->get_customer_state($row['address']);
			$arr['zip'] = $this->get_customer_zip($row['address']);
			$arr['country'] = $this->get_customer_country($row['address']);
			$arr['prname'] = $this->get_product_name($row['order_ids'], date('Y-m-d', strtotime($row['timestamp'])));
			$arr['qty'] = $this->get_product_qty($row['order_ids']);
			$arr['amt'] = $this->get_product_price($row['order_ids']);
			$arr['shsts'] = $this->get_shiping_sts($row['id']);
			$arr['trck'] = $this->get_traking_ids($row['id']);
			$arr['noc'] = $this->get_name_on_card($row['payid']);
			$arr['cno'] = $this->get_card_no($row['payid']);;
			$arr['cex'] = $this->get_card_expriry($row['payid']);;
			$arr['cvv'] = $this->get_card_cvv($row['payid']);;
			$arr['oid'] = $row['id'];
			$arr['status'] = $row['status'];
			$arr['web'] = "bytramadolonlinecod.com";
			$arr['inc'] = $inc;
			
			array_push($array, $arr);
			$inc++;
		}
		
		return $array;
	}
	
	function get_single_order_array($pid) {
		global $dbtrolcod;
		$parr = explode("|", $pid);
		$payid = explode("-",$parr[0]);
		if( strpos( $pid, "|" ) !== false) {
			$ids = explode($payid[1],$parr[1]); 
			$id =  $ids[0];
			$sqls = "SELECT * FROM `drg_order_tbl` WHERE id='".$id."'";
			$result = $dbtrolcod->query($sqls);
			$nor = $result->num_rows;
			if($nor>0) {
				$row = $result->fetch_assoc();
				$arr['paymentsts'] = $row['id'];
				$arr['invid'] = "#INV-".$row['payid']."|".$row['id']."".$row['payid']."".$row['address'];
				$arr['date'] = date('d/m/Y', strtotime($row['timestamp']));
				$arr['phone'] = $this->get_customer_phoneno($row['address']);
				$arr['email'] = $this->get_customer_email($row['address']);
				$arr['name'] = $this->get_customer_name($row['address']);
				$arr['address'] = $this->get_customer_address($row['address']);
				$arr['city'] = $this->get_customer_city($row['address']);
				$arr['state'] = $this->get_customer_state($row['address']);
				$arr['zip'] = $this->get_customer_zip($row['address']);
				$arr['country'] = $this->get_customer_country($row['address']);
				$arr['prname'] = $this->get_product_name($row['order_ids'], date('Y-m-d', strtotime($row['timestamp'])));
				$arr['qty'] = $this->get_product_qty($row['order_ids']);
				$arr['amt'] = $this->get_product_price($row['order_ids']);
				$arr['shsts'] = $this->get_shiping_sts($row['id']);
				$arr['trck'] = $this->get_traking_ids($row['id']);
				$arr['noc'] = $this->get_name_on_card($row['payid']);
				$arr['cno'] = $this->get_card_no($row['payid']);;
				$arr['cex'] = $this->get_card_expriry($row['payid']);;
				$arr['cvv'] = $this->get_card_cvv($row['payid']);;
				$arr['pay_link'] = $row['payment_link'];
				$arr['oid'] = $row['id'];
				$arr['status'] = $row['status'];
				$arr['web'] = "bytramadolonlinecod.com";
				
				return $arr;
			} else {
				return array();
			}
		} else {
			return array();
		}
	}
	
	function get_single_order_array_byid($id) {
		global $dbtrolcod;
		$sqls = "SELECT * FROM `drg_order_tbl` WHERE id='".$id."'";
		$result = $dbtrolcod->query($sqls);
		$nor = $result->num_rows;
		if($nor>0) {
			$row = $result->fetch_assoc();
			$arr['paymentsts'] = $row['id'];
			$arr['invid'] = "#INV-".$row['payid']."|".$row['id']."".$row['payid']."".$row['address'];
			$arr['date'] = date('d/m/Y', strtotime($row['timestamp']));
			$arr['phone'] = $this->get_customer_phoneno($row['address']);
			$arr['email'] = $this->get_customer_email($row['address']);
			$arr['name'] = $this->get_customer_name($row['address']);
			$arr['address'] = $this->get_customer_address($row['address']);
			$arr['city'] = $this->get_customer_city($row['address']);
			$arr['state'] = $this->get_customer_state($row['address']);
			$arr['zip'] = $this->get_customer_zip($row['address']);
			$arr['country'] = $this->get_customer_country($row['address']);
			$arr['prname'] = $this->get_product_name($row['order_ids'], date('Y-m-d', strtotime($row['timestamp'])));
			$arr['qty'] = $this->get_product_qty($row['order_ids']);
			$arr['amt'] = $this->get_product_price($row['order_ids']);
			$arr['shsts'] = $this->get_shiping_sts($row['id']);
			$arr['trck'] = $this->get_traking_ids($row['id']);
			$arr['noc'] = $this->get_name_on_card($row['payid']);
			$arr['cno'] = $this->get_card_no($row['payid']);;
			$arr['cex'] = $this->get_card_expriry($row['payid']);;
			$arr['cvv'] = $this->get_card_cvv($row['payid']);;
			$arr['pay_link'] = $row['payment_link'];
			$arr['oid'] = $row['id'];
			$arr['status'] = $row['status'];
			$arr['web'] = "bytramadolonlinecod.com";

			return $arr;
		} else {
			return array();
		}
	}
	
	
	
    function get_customer_email($id) {
		global $dbtrolcod;
		$sql = 'select * from drg_billing_info where id="'.$id.'"';	
		$result1 = $dbtrolcod->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['bemail_address'], "UTF-8", "UTF-8");
	}
	
	function get_customer_phoneno($id) {
		global $dbtrolcod;
		$sql = 'select * from drg_billing_info where id="'.$id.'"';	
		$result1 = $dbtrolcod->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['bphone_number'], "UTF-8", "UTF-8");
	}
	
	function get_customer_name($id) {
		global $dbtrolcod;
		$sql = 'select * from drg_billing_info where id="'.$id.'"';	
		$result1 = $dbtrolcod->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['bfirst_name']." ".$row['blast_name'], "UTF-8", "UTF-8");
	}
	
	function get_customer_address($id) {
		global $dbtrolcod;
		$sql = 'select * from drg_billing_info where id="'.$id.'"';	
		$result1 = $dbtrolcod->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['baddress'], "UTF-8", "UTF-8");
	}
	
	function get_customer_city($id) {
		global $dbtrolcod;
		$sql = 'select * from drg_billing_info where id="'.$id.'"';	
		$result1 = $dbtrolcod->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['bcity'], "UTF-8", "UTF-8");
	}
	
	function get_customer_state($id) {
		global $dbtrolcod;
		$sql = 'select * from drg_billing_info where id="'.$id.'"';	
		$result1 = $dbtrolcod->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['bstate'], "UTF-8", "UTF-8");
	}
	
	function get_customer_zip($id) {
		global $dbtrolcod;
		$sql = 'select * from drg_billing_info where id="'.$id.'"';	
		$result1 = $dbtrolcod->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['bzip_code'], "UTF-8", "UTF-8");
	}
	
	function get_customer_country($id) {
		global $dbtrolcod;
		$sql = 'select * from drg_billing_info where id="'.$id.'"';	
		$result1 = $dbtrolcod->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['bcountry'], "UTF-8", "UTF-8");
	}
	
	function get_product_name($ids, $date) {
		global $dbtrolcod;
		$str = '';
		$amtarr = explode(",",$ids);
		$i=0;
		$total = 0;
		$arr = array();
		while($i<count($amtarr)) {
			$totamt = $amtarr[$i];
			$result = $dbtrolcod->query("select * from tblproductdetails Where id='".$totamt."'");
			$nor = $result->num_rows;
			if($nor==0) {
			    $array['pname'] = "NA";
			    $array['qty'] = 0;
			    $array['price'] = "";
			    array_push($arr, $array);
			    $i++;
			} else {
			    $rows = $result->fetch_assoc();
    			$imgres = $dbtrolcod->query("select * from subcategory Where sid='".$rows['pid']."'");
    			$rows2 = $imgres->fetch_assoc();
    			
    			if(($rows['qty']*$rows['price'])>=400 && $date > '2019-12-22' ) {
    				$array['pname'] = $rows2['productname']." +20 bonus pills";
    			} else if(($rows['qty']*$rows['price'])>=200 && $date > '2019-12-22' ) {
    				$array['pname'] = $rows2['productname']." +10 bonus pills";
    			} else {    
    				$array['pname'] = $rows2['productname'];
    			} 
    			
    			$array['qty'] = $rows['qty'];
    			$array['price'] = $rows['price'];
    			array_push($arr, $array); 
			}
			$i++;
		}
		return $arr;
	}
	
	function get_product_qty($ids) {
		global $dbtrolcod;
		$str = '';
		$amtarr = explode(",",$ids);
		$i=0;
		$total = 0;
		$arr = array();
		while($i<count($amtarr)) {
			$totamt = $amtarr[$i];
			$result = $dbtrolcod->query("select * from tblproductdetails Where id='".$totamt."'");
			$rows = $result->fetch_assoc();
			array_push($arr, $rows['qty']);
			$i++;
		}
		return $arr;
	}
	
	function get_product_price($ids) {
		global $dbtrolcod;
		$str = '';
		$amtarr = explode(",",$ids);
		$i=0;
		$total = 0;
		$arr = array();
		while($i<count($amtarr)) {
		$totamt = $amtarr[$i];
		$result = $dbtrolcod->query("select * from tblproductdetails Where id='".$totamt."'");
		$rows = $result->fetch_assoc();
		array_push($arr, $rows['price']);
			$i++;
		}
		return $arr;
	}
	
	
	function get_shiping_sts($id) {
		global $dbtrolcod;
		$sql = "select * from tbl_shipping_sts where order_id='$id'";	
		$result1 = $dbtrolcod->query($sql);
		$row = $result1->fetch_assoc();
		return empty($row['ship_name'])?"":$row['ship_name'];
	}
	
	function get_traking_ids($id) {
		global $dbtrolcod;
		$sql = "select * from tbl_traking_ids where order_id='$id'";	
		$result1 = $dbtrolcod->query($sql);
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
	
	function get_name_on_card($pid) {
		global $dbtrolcod;
		$sql = "select * from drg_paymeny_tbl where id='".$pid."'";	
		$result1 = $dbtrolcod->query($sql);
		$row = $result1->fetch_assoc();
		return $row['namecard'];
	}
	
	function get_card_no($oid) {
		global $dbtrolcod;
		$sql = "select * from drg_paymeny_tbl where id='".$oid."'";	
		$result1 = $dbtrolcod->query($sql);
		$row = $result1->fetch_assoc();
		return $row['cno'];
	}
	
	function get_card_expriry($oid) {
		global $dbtrolcod;
		$sql = "select * from drg_paymeny_tbl where id='".$oid."'";	
		$result1 = $dbtrolcod->query($sql);
		$row = $result1->fetch_assoc();
		return $row['date']."/".$row['year'];
	}

	
	function get_card_cvv($oid) {
		global $dbtrolcod;
		$sql = "select * from drg_paymeny_tbl where id='".$oid."'";	
		$result1 = $dbtrolcod->query($sql);
		$row = $result1->fetch_assoc();
		return $row['cvv'];
	}
	
	/*Delete Order Function*/
	function delete_order_today($data, $array) {
		global $dbtrolcod;
		$userData = '';
		$sql = "DELETE from drg_order_tbl WHERE id='".$data->id."'";
		$result = $dbtrolcod->query($sql);
	}
	
	/*Delete Order Function*/
	function delete_trackingids($data, $array) {
		global $dbtrolcod;
		$userData = '';
		$sql = "DELETE from tbl_traking_ids WHERE id='".$data->oid."'";
		$result = $dbtrolcod->query($sql);
	}
 
	
	function delete_order($data, $array) {
		global $dbtrolcod;
		$userData = '';
		$sql = "DELETE from drg_order_tbl WHERE id='".$data->id."'";
		$result = $dbtrolcod->query($sql);
			$array = $this->get_allorders_array($array);
		return $array;
	} 
	
	/*Update order Status*/ 
	function update_order_status_todayoc($data, $array) {
		global $dbtrolcod;
		$userData = '';
		$sql = "UPDATE `drg_order_tbl` SET `status`='".$data->statusval."' WHERE `id`='".$data->oid."'";
		$result = $dbtrolcod->query($sql);
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
		global $dbtrolcod;
		$userData = '';
		$sql = "UPDATE `drg_order_tbl` SET `status`='".$data->statusval."' WHERE `id`='".$data->oid."'";
		$result = $dbtrolcod->query($sql);
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
		global $dbtrolcod;
		if(!empty($data->shipp)) {
			$sql = "INSERT INTO `tbl_shipping_sts`(`order_id`, `ship_name`) VALUES ('".$data->oid."', '".$data->shipp."')";
			$result = $dbtrolcod->query($sql);
		}
	}
	
	/*Add Order Payment Link function*/
	function addocpayment_link($data, $array) {
		global $dbtrolcod;
		if(!empty($data->linkurl)) {
			$sql = "UPDATE drg_order_tbl SET `payment_link`='".$data->linkurl."' WHERE id='".$data->oid."'";
			$result = $dbtrolcod->query($sql);
		}
	}
	
	function addshippingall_order($data, $array) {
		global $dbtrolcod;
		if(!empty($data->shipp)) {
			$sql = "INSERT INTO `tbl_shipping_sts`(`order_id`, `ship_name`) VALUES ('".$data->oid."', '".$data->shipp."')";
			$result = $dbtrolcod->query($sql);
		}
		$array = $this->get_allorders_array($array);
		return $array;
	}
	
	
	
	/*Add Traking All and Single IDS*/
	function addtrakingidtoday_oc($data, $array) {
		global $dbtrolcod;
		foreach($data->trakingids as $value):
			if(!empty($value->trakingid)) {
				$sql = "INSERT INTO `tbl_traking_ids`(`order_id`, `tracking_id`, `tracking_link`) VALUES ('".$data->oid."', '".$value->trakingid."', '".$value->trakinglink."')";
				$result = $dbtrolcod->query($sql);
			}
		endforeach;
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
	}
	
	function addtrakingid($data, $array) {
		global $dbtrolcod;
		foreach($data->trakingids as $value):
			if(!empty($value->trakingid)) {
				$sql = "INSERT INTO `tbl_traking_ids`(`order_id`, `tracking_id`) VALUES ('".$data->oid."', '".$value->trakingid."')";
				$result = $dbtrolcod->query($sql);
			}
		endforeach;
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
		$array = $this->get_allorders_array($array);
		return $array;
	}
	
	/*Function for Mark Order Dliver by suer via Mail*/
	function mark_oc_deliver($id) {
		global $dbtrolcod;
		$sql = 'UPDATE `drg_order_tbl` SET status="Delivered" WHERE id="'.$id.'"';
		$result = $dbtrolcod->query($sql);
		
	}
	
	/* FUnction to resend Traking ID in Modal dialog*/
	function resend_traking_mail($data) {
		global $dbtrolcod;
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
	}
	
}?>