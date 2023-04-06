<?php 
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);

if(!isset($_SESSION)){
		session_start();
	} 
	include('config.php');
   $dbdp = getDBDP();

class DrugPlan
{
    private $dbdp;

	function get_allorders_today($array, $inc) {
		global $dbdp;
		$date = date("d/m/Y");
		$sqls = $sqls = "SELECT * FROM `drg_order_tbl` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) ORDER BY id DESC";
		
		$result = $dbdp->query($sqls);
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
			$arr['web'] = "drugstoreplanet.com";
			$arr['inc'] = $inc;
			array_push($array, $arr);
			$inc++;
		}
		return [$array, $inc];
	}
	
	function get_all_orders($array, $inc, $data) {
		global $dbdp;
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
		$result = $dbdp->query($sqls);
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
			$arr['web'] = "drugstoreplanet.com";
			$arr['inc'] = $inc;
			array_push($array, $arr);
			$inc++;
		}
		
		return [$array, $inc];
	}
	
	
	function get_allorders_array($array) {
		global $dbdp;
		$sqls = "SELECT * FROM `drg_order_tbl` ORDER BY id DESC";
		$result = $dbdp->query($sqls);
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
			$arr['pay_link'] = $row['payment_link'];
			$arr['oid'] = $row['id'];
			$arr['status'] = $row['status'];
			$arr['web'] = "drugstoreplanet.com";
			$arr['inc'] = $inc;
			
			array_push($array, $arr);
			$inc++;
		}
		
		return $array;
	}
	
	function get_single_order_array($pid) {
		global $dbdp;
		$parr = explode("|", $pid);
		$payid = explode("-",$parr[0]);
		if( strpos( $pid, "|" ) !== false) {
			$ids = explode($payid[1],$parr[1]); 
			$id =  $ids[0];
			$sqls = "SELECT * FROM `drg_order_tbl` WHERE id='".$id."'";
			$result = $dbdp->query($sqls);
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
				$arr['web'] = "drugstoreplanet.com";
				
				return $arr;
			} else {
				return array();
			}
		} else {
			return array();
		}
	}
	
	
	function get_single_order_array_byid($id) {
		global $dbdp;
		$sqls = "SELECT * FROM `drg_order_tbl` WHERE id='".$id."'";
		$result = $dbdp->query($sqls);
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
			$arr['web'] = "drugstoreplanet.com";
			
			return $arr;
		} else {
			return array();
		}
	}
	
	
    function get_customer_email($id) {
		global $dbdp;
		$sql = 'select * from drg_billing_info where id="'.$id.'"';	
		$result1 = $dbdp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['bemail_address'], "UTF-8", "UTF-8");
	}
	
	function get_customer_phoneno($id) {
		global $dbdp;
		$sql = 'select * from drg_billing_info where id="'.$id.'"';	
		$result1 = $dbdp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['bphone_number'], "UTF-8", "UTF-8");
	}
	
	function get_customer_name($id) {
		global $dbdp;
		$sql = 'select * from drg_billing_info where id="'.$id.'"';	
		$result1 = $dbdp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['bfirst_name']." ".$row['blast_name'], "UTF-8", "UTF-8");
	}
	
	function get_customer_address($id) {
		global $dbdp;
		$sql = 'select * from drg_billing_info where id="'.$id.'"';	
		$result1 = $dbdp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['baddress'], "UTF-8", "UTF-8");
	}
	
	function get_customer_city($id) {
		global $dbdp;
		$sql = 'select * from drg_billing_info where id="'.$id.'"';	
		$result1 = $dbdp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['bcity'], "UTF-8", "UTF-8");
	}
	
	function get_customer_state($id) {
		global $dbdp;
		$sql = 'select * from drg_billing_info where id="'.$id.'"';	
		$result1 = $dbdp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['bstate'], "UTF-8", "UTF-8");
	}
	
	function get_customer_zip($id) {
		global $dbdp;
		$sql = 'select * from drg_billing_info where id="'.$id.'"';	
		$result1 = $dbdp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['bzip_code'], "UTF-8", "UTF-8");
	}
	
	function get_customer_country($id) {
		global $dbdp;
		$sql = 'select * from drg_billing_info where id="'.$id.'"';	
		$result1 = $dbdp->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['bcountry'], "UTF-8", "UTF-8");
	}
	
	function get_product_name($ids, $date) {
		global $dbdp;
		$str = '';
		$amtarr = explode(",",$ids);
		$i=0;
		$total = 0;
		$arr = array();
		while($i<count($amtarr)) {
			$totamt = $amtarr[$i];
			$result = $dbdp->query("select * from tblproductdetails Where id='".$totamt."'");
			$nor = $result->num_rows;
			if($nor==0) {
			    $array['pname'] = "NA";
			    $array['qty'] = 0;
			    $array['price'] = "";
			    array_push($arr, $array);
			    $i++;
			} else {
    			$rows = $result->fetch_assoc();
    			$imgres = $dbdp->query("select * from subcategory Where sid='".$rows['pid']."'");
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
    			$i++;
			}
		}
		return $arr;
	}
	
	function get_product_qty($ids) {
		global $dbdp;
		$str = '';
		$amtarr = explode(",",$ids);
		$i=0;
		$total = 0;
		$arr = array();
		while($i<count($amtarr)) {
			$totamt = $amtarr[$i];
			$result = $dbdp->query("select * from tblproductdetails Where id='".$totamt."'");
			$nor = $result->num_rows;
			if($nor==0) {
			    array_push($arr, 0);
			} else {
			    $rows = $result->fetch_assoc();
			    array_push($arr, $rows['qty']);
			}
			$i++;
		}
		return $arr;
	}
	
	function get_product_price($ids) {
		global $dbdp;
		$str = '';
		$amtarr = explode(",",$ids);
		$i=0;
		$total = 0;
		$arr = array();
		while($i<count($amtarr)) {
		$totamt = $amtarr[$i];
		$result = $dbdp->query("select * from tblproductdetails Where id='".$totamt."'");
		$nor = $result->num_rows;
    		if($nor==0) {
    		    array_push($arr, 0);   
    		} else {
    		    $rows = $result->fetch_assoc();
    	    	array_push($arr, $rows['price']);   
    		}
			$i++;
		}
		return $arr;
	}
	
	
	function get_shiping_sts($id) {
		global $dbdp;
		$sql = "select * from tbl_shipping_sts where order_id='$id'";	
		$result1 = $dbdp->query($sql);
		$row = $result1->fetch_assoc();
		return empty($row['ship_name'])?"":$row['ship_name'];
	}
	
	function get_traking_ids($id) {
		global $dbdp;
		$sql = "select * from tbl_traking_ids where order_id='$id'";	
		$result1 = $dbdp->query($sql);
		$arr = array();
		while($row = $result1->fetch_assoc()) {
			array_push($arr, $row['tracking_id']);
		}
		return $arr;
	}
	
	function get_name_on_card($pid) {
		global $dbdp;
		$sql = "select * from drg_paymeny_tbl where id='".$pid."'";	
		$result1 = $dbdp->query($sql);
		$row = $result1->fetch_assoc();
		return $row['namecard'];
	}
	
	function get_card_no($oid) {
		global $dbdp;
		$sql = "select * from drg_paymeny_tbl where id='".$oid."'";	
		$result1 = $dbdp->query($sql);
		$row = $result1->fetch_assoc();
		return $row['cno'];
	}
	
	function get_card_expriry($oid) {
		global $dbdp;
		$sql = "select * from drg_paymeny_tbl where id='".$oid."'";	
		$result1 = $dbdp->query($sql);
		$row = $result1->fetch_assoc();
		return $row['date']."/".$row['year'];
	}

	
	function get_card_cvv($oid) {
		global $dbdp;
		$sql = "select * from drg_paymeny_tbl where id='".$oid."'";	
		$result1 = $dbdp->query($sql);
		$row = $result1->fetch_assoc();
		return $row['cvv'];
	}
	
	/*Delete Order Function*/
	function delete_order_today($data, $array) {
		global $dbdp;
		$userData = '';
		$sql = "DELETE from drg_order_tbl WHERE id='".$data->id."'";
		$result = $dbdp->query($sql);
	}
	
	function delete_order($data, $array) {
		global $dbdp;
		$userData = '';
		$sql = "DELETE from drg_order_tbl WHERE id='".$data->id."'";
		$result = $dbdp->query($sql);
			$array = $this->get_allorders_array($array);
		return $array;
	} 
	
	
	function update_order_status_todayoc($data, $array) {
		global $dbdp;
		$userData = '';
		$sql = "UPDATE `drg_order_tbl` SET `status`='".$data->statusval."' WHERE `id`='".$data->oid."'";
		$result = $dbdp->query($sql);
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
		global $dbdp;
		$userData = '';
		$sql = "UPDATE `drg_order_tbl` SET `status`='".$data->statusval."' WHERE `id`='".$data->oid."'";
		$result = $dbdp->query($sql);
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
		global $dbdp;
		if(!empty($data->shipp)) {
			$sql = "INSERT INTO `tbl_shipping_sts`(`order_id`, `ship_name`) VALUES ('".$data->oid."', '".$data->shipp."')";
			$result = $dbdp->query($sql);
		}
	}
	
	/*Add Order Payment Link function*/
	function addocpayment_link($data, $array) {
		global $dbdp;
		if(!empty($data->linkurl)) {
			$sql = "UPDATE drg_order_tbl SET `payment_link`='".$data->linkurl."' WHERE id='".$data->oid."'";
			$result = $dbdp->query($sql);
		}
	}
	
	function addshippingdrugstore($data, $array) {
		global $dbdp;
		if(!empty($data->shipp)) {
			$sql = "INSERT INTO `tbl_shipping_sts`(`order_id`, `ship_name`) VALUES ('".$data->oid."', '".$data->shipp."')";
			$result = $dbdp->query($sql);
		}
		$array = $this->get_allorders_array($array);
		return $array;
	}
	
	
	
	/*Add Traking All and Single IDS*/
	function addtrakingidtoday_oc($data, $array) {
		global $dbdp;
		foreach($data->trakingids as $value):
			if(!empty($value->trakingid)) {
				$sql = "INSERT INTO `tbl_traking_ids`(`order_id`, `tracking_id`) VALUES ('".$data->oid."', '".$value->trakingid."')";
				$result = $dbdp->query($sql);
			}
		endforeach;
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
	}
	
	function addtrakingid($data, $array) {
		global $dbdp;
		foreach($data->trakingids as $value):
			if(!empty($value->trakingid)) {
				$sql = "INSERT INTO `tbl_traking_ids`(`order_id`, `tracking_id`) VALUES ('".$data->oid."', '".$value->trakingid."')";
				$result = $dbdp->query($sql);
			}
		endforeach;
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
		$array = $this->get_allorders_array($array);
		return $array;
	}
	
	/*Function for Mark Order Dliver by suer via Mail*/
	function mark_oc_deliver($id) {
		global $dbdp;
		$sql = 'UPDATE `drg_order_tbl` SET status="Delivered" WHERE id="'.$id.'"';
		$result = $dbdp->query($sql);
		
	}
	
	/* FUnction to resend Traking ID in Modal dialog*/
	function resend_traking_mail($data) { 
		global $dbdp;
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
	}
	
	function resend_payment_reminder_mail($data) {
		$name = $data->name;
		$orderdetails = $data->prname;
		$pay_link = $data->pay_link;
		$email = $data->email;
		$web = $data->web;
		include('mail_msg/all-oc-payment-reminder.php');
		//print_r($data);	
	}
	
	function reorder_ask_customer_email($data) {
		include('mail_msg/reorder_ask_customer_email.php');
		//print_r($data);	
	}
	
	/*Cases All Functions*/
	function create_new_case($datares) {
		$data = $datares->arr;
		global $dbdp;
		$randomid = "CS-".mt_rand(100000,999999); 
		$sql ="INSERT INTO `tbl_cases_list`(`case_id`,`order_id`, `invid`, `name`, `address`, `email`, `phone`, `web`, `issue`) VALUES ('".$randomid."','".$data->oid."','".$data->invid."','".$data->name."','".$data->address."','".$data->email."','".$data->cno."','".$data->web."','".$datares->issue."')";
		$result = $dbdp->query($sql);
		$last_id = $dbdp->insert_id;
		foreach($data->prname as $key=>$value):
			$sql ="INSERT INTO `tbl_case_product_details`(`case_id`, `p_name`, `qty`, `price`) VALUES ('".$last_id."','".$value->pname."','".$value->qty."','".$value->price."')";
			$result = $dbdp->query($sql);
		endforeach;
		return "Saved Successfully";
	}
	
	function get_all_open_cases() {
		global $dbdp;
		$sql = "SELECT * FROM `tbl_cases_list` WHERE `status`='Open' ORDER BY id DESC";
		$result = $dbdp->query($sql);
		$array = array();
		while($rows = $result->fetch_assoc()) {
			$rows['date'] = date('d/m/Y', strtotime($rows['timestamp']));
			$rows['prname'] = $this->get_case_product_name($rows['id']);
			$rows['trakings'] = $this->get_opencases_traking_ids("CS_".$rows['id']);
			$rows['note'] = $this->get_note_case($rows['id']);
			array_push($array, $rows);
		}
		return $array;
	}
	
	
	function get_opencases_traking_ids($id) {
		global $dbdp;
		$sql = "select * from tbl_traking_ids where order_id='$id'";	
		$result1 = $dbdp->query($sql);
		$arr = array();
		while($row = $result1->fetch_assoc()) {
			array_push($arr, $row['tracking_id']);
		}
		return $arr;
	}
	
	function get_all_closed_cases() {
		global $dbdp;
		$sql = "SELECT * FROM `tbl_cases_list` WHERE `status`='Closed' ORDER BY id DESC ";
		$result = $dbdp->query($sql);
		$array = array();
		while($rows = $result->fetch_assoc()) {
			$rows['date'] = date('d/m/Y', strtotime($rows['timestamp']));
			$rows['prname'] = $this->get_case_product_name($rows['id']);
			$rows['trakings'] = $this->get_opencases_traking_ids("CS_".$rows['id']);
			$rows['note'] = $this->get_note_case($rows['id']);
			array_push($array, $rows);
		}
		return $array;
	}
	
	function get_case_product_name($id) {
		global $dbdp;
		$arr = array();
		$sql = "SELECT * FROM `tbl_case_product_details` WHERE case_id='".$id."'";
		$result = $dbdp->query($sql);
		while($rows = $result->fetch_assoc()) {
			array_push($arr, $rows);
		}
		return $arr;
	}
	
	function get_note_case($id) {
		global $dbdp;
		$arr = array();
		$sql = "SELECT * FROM `tbl_cases_note` WHERE case_id='".$id."' ORDER BY id ASC";
		$result = $dbdp->query($sql);
		while($rows = $result->fetch_assoc()) {
			array_push($arr, $rows);
		}
		return $arr;
	}
	
	
	
	function delete_case($id) {
		global $dbdp;
		$sql = "DELETE FROM `tbl_cases_list` WHERE id='".$id."'";
		$result = $dbdp->query($sql);
		return "Saved Successfully";
	}
	
	function changestatuscases($id) {
		global $dbdp;
		$sql = "UPDATE `tbl_cases_list` SET status='Closed' WHERE id='".$id."'";
		$result = $dbdp->query($sql);
		return "Saved Successfully";
	}
	
	function addcase_note($data) {
		global $dbdp;
		$sql = "INSERT INTO `tbl_cases_note`(`case_id`, `case_note`) VALUES ('".$data->id."','".$data->note."')";
		$result = $dbdp->query($sql);
		$id = $dbdp->insert_id;
		return $id;
	}
	
	function delcase_note($data) {
		global $dbdp;
		$sql = "DELETE FROM `tbl_cases_note` WHERE id='".$data->id."'";
		$result = $dbdp->query($sql);
		return "Saved Successfully";
	}
	
	function changestatuscases_reopen($id) {
		global $dbdp;
		$sql = "UPDATE `tbl_cases_list` SET status='Open' WHERE id='".$id."'";
		$result = $dbdp->query($sql);
		return "Saved Successfully";
	}
	
	function get_all_customer_reports() {
		global $dbdp;
		$sql = "SELECT * FROM `tbl_cust_issues` ORDER BY id DESC";
		$result = $dbdp->query($sql);
		$array = array();
		while($rows = $result->fetch_assoc()) {
			$rows['date'] = date('d/m/Y', strtotime($rows['timestamp']));
			$rows['conversation'] = $this->get_conversation($rows['id']); 
			array_push($array, $rows);
		}
		return $array;
	}
	
	function  get_conversation($id) {
		global $dbdp;
		$sql = 'SELECT * FROM `tbl_contact_conversation` WHERE cid='.$id.' ORDER BY id ASC';
		$result = $dbdp->query($sql);
		$array = array();
		while($row = $result->fetch_assoc()) {
			array_push($array, $row);
		}
		return $array;
	}
	
	function enquiry_reply_send($data) {
		global $dbdp;
	    $sql ='INSERT INTO `tbl_contact_conversation`(`cid`, `admin_msg`) VALUES ("'.$data->id.'", "'.$data->msg.'")';
		$result = $dbdp->query($sql);
		include('mail_msg/reply-enquiry.php');
	}
	
	function enquiry_reply_send_user($data) {
		global $dbdp;
		$id = mysqli_real_escape_string($dbdp, $data['id']);
		$user_msg = mysqli_real_escape_string($dbdp, $data['user_msg']);
	    $sql ='INSERT INTO `tbl_contact_conversation`(`cid`, `user_msg`) VALUES ("'.$id.'", "'.$user_msg.'")';
		$result = $dbdp->query($sql);
		include('mail_msg/reply-enquiry-custo.php');
		return "Saved Data";
	}
	
	
	
	function get_all_customer_reports_oneday() {
		global $dbdp;
		$sql = "SELECT * FROM `tbl_cust_issues` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) ORDER BY id DESC";
		$result = $dbdp->query($sql);
		$nor = $result->num_rows;
		return $nor;
	}
	
	function delete_cust_report($id) {
		global $dbdp;
		$sql = "DELETE FROM `tbl_cust_issues` WHERE id='".$id."'";
		$result = $dbdp->query($sql);
		return "Saved Successfully";
	}
	
	function change_cust_report_sts($id) {
		global $dbdp;
		$sql = "UPDATE `tbl_cust_issues` SET status='1' WHERE id='".$id."'";
		$result = $dbdp->query($sql);
		return "Saved Successfully";
	}
	
	function reshiptrakingids($data) {
		global $dbdp;
		foreach($data->trakingids as $value):
			if(!empty($value->trakingid)) {
				$sql = "INSERT INTO `tbl_traking_ids`(`order_id`, `tracking_id`) VALUES ('CS_".$data->oid."', '".$value->trakingid."')";
				$result = $dbdp->query($sql);
			}
		endforeach;
		$id = $data->oid;
		include('mail_msg/all-cases-reship-traking.php');
		return "Saved Successfully";
	}
	
	function resend_reshipmail($data) {
		global $dbdp;
		$id = $data->oid;
		include('mail_msg/all-cases-reship-traking.php');
		return "Saved Successfully";
	}
	
	function get_all_phone_grant_data() {
		global $dbdp;
		$sql = 'SELECT * FROM `tbl_phoneno_grant_per` ORDER BY id DESC';
		$result = $dbdp->query($sql);
		$array = array();
		while($row = $result->fetch_assoc()) {
			$nextdate = strtotime($row['timestamp'].'+3 days');
			$ndate = date("d-m-y", $nextdate);
			$tdate = date("d-m-y");
			if($ndate==$tdate) {
				$sql2 = 'DELETE FROM `tbl_phoneno_grant_per` WHERE id="'.$row['id'].'"';	
				$result2 = $dbdp->query($sql2);
			} else {
				array_push($array, $row);
			}
		}
		return $array;
	}
	
	function give_grant_permission_phoneno($id) {
		global $dbdp;
		$sql = 'UPDATE `tbl_phoneno_grant_per` SET status="2" WHERE id="'.$id.'"';
		$result = $dbdp->query($sql);
		return "Updated Successfully";
	}
	
	function delete_permission_phoneno($id) {
		global $dbdp;
		$sql = 'DELETE FROM `tbl_phoneno_grant_per` WHERE id="'.$id.'"';
		$result = $dbdp->query($sql);
		return "Updated Successfully";
	}
	
	function addnew_permission_request($data) {
		global $dbdp;
		$sql = 'INSERT INTO `tbl_phoneno_grant_per`(`oid`, `name`, `phone`, `web`) VALUES ("'.$data->invid.'","'.$data->name.'","'.$data->no.'","'.$data->web.'")';
		$result = $dbdp->query($sql);
		return "Updated Successfully";
	}
	
	/** Add new Admin Request Comment*/
	function add_cooment($data) {
		global $dbdp;
		$sql = 'INSERT INTO `drg_admin_reprts`(`username`, `comment`) VALUES ("'.$data->name.'","'.$data->issue.'")';
		$result = $dbdp->query($sql);
		return $this->get_all_admincomments();
	}
	
	function get_all_admincomments() {
		global $dbdp;
		$sql = 'SELECT * FROM `drg_admin_reprts` ORDER BY id DESC';
		$result = $dbdp->query($sql);
		$array = array();
		while($row = $result->fetch_assoc()) {
			$row['conversation'] = $this->get_all_admin_conversations($row['id']); 
			array_push($array, $row);
		}
		return $array;
	}
	
	function get_all_admin_conversations($id) {
		global $dbdp;
		$sql = 'SELECT * FROM `admint_to_admin_conversation` WHERE aid="'.$id.'" ORDER BY id ASC';
		$result = $dbdp->query($sql);
		$array = array();
		while($row = $result->fetch_assoc()) {
			array_push($array, $row);
		}
		return $array;
	}
	
	function save_sec_admin_msg($data) {
		global $dbdp;
		$id = mysqli_real_escape_string($dbdp, $data->id);
		$user_msg = mysqli_real_escape_string($dbdp, $data->msg);
	    $sql ='INSERT INTO `admint_to_admin_conversation`(`aid`, `sec_admin_msg`) VALUES ("'.$id.'", "'.$user_msg.'")';
		$result = $dbdp->query($sql);
		$res = $this->get_all_admincomments();
		return $res;
	}
	
	function detele_admin_message($data) {
		global $dbdp;
		$id = mysqli_real_escape_string($dbdp, $data->id);
	    $sql ='DELETE FROM `admint_to_admin_conversation` WHERE `aid`="'.$id.'"';
		$result = $dbdp->query($sql);
		$sql1 ='DELETE FROM `drg_admin_reprts` WHERE `id`="'.$id.'"';
		$result1 = $dbdp->query($sql1);
		$res = $this->get_all_admincomments();
		return $res;
	}
	
	function save_master_admin_msg($data) {
		global $dbdp;
		$id = mysqli_real_escape_string($dbdp, $data->id);
		$user_msg = mysqli_real_escape_string($dbdp, $data->msg);
	    $sql ='INSERT INTO `admint_to_admin_conversation`(`aid`, `admin_msg`) VALUES ("'.$id.'", "'.$user_msg.'")';
		$result = $dbdp->query($sql);
		$res = $this->get_all_admincomments();
		return $res;
	}
	
	function save_report_an_issue($res, $data, $web) {
		global $dbdp;
		$sql ='INSERT INTO `tbl_cust_issues` (`order_id`, `cname`, `cno`, `web`, `issue`)  VALUES ("'.$res['invid'].'", "'.$res['name'].'", "'.$res['email'].'", "'.$web.'", "'.$data['dataque'].'")';
		$result = $dbdp->query($sql);
	}
	
	function save_aftersales_followup($res, $data, $web){
		global $dbdp;
		
		$sql1 = "SELECT * FROM tbl_after_sales_followup Where secid='".$data['id']."'";
		$result1 = $dbdp->query($sql1);
		$nor = $result1->num_rows;
		
		$sql2 = "SELECT max(`queue`) FROM `tbl_after_sales_followup`";
		$result2 = $dbdp->query($sql2);
		$rows = $result2->fetch_assoc();
		
		$maxqueue = $rows['max(`queue`)'];
		
		if($nor>0) {
			$sql = 'UPDATE `tbl_after_sales_followup` SET `status`="'.$data['status'].'", `queue`="'.($maxqueue+1).'" WHERE `secid`="'.$data['id'].'"';
			$result = $dbdp->query($sql);
		} else {
			$sql ='INSERT INTO `tbl_after_sales_followup`(`secid`, `oid`, `web`, `status`, `queue`) VALUES ("'.$data['id'].'","'.$res['invid'].'","'.$web.'","'.$data['status'].'" ,"'.($maxqueue+1).'")';
			$result = $dbdp->query($sql);
		}
		
	}
	
	function auto_save_in_followup($id, $web){
		global $dbdp;
		$sql1 = "SELECT * FROM tbl_after_sales_followup Where secid='".$id."'";
		$result1 = $dbdp->query($sql1);
		$nor = $result1->num_rows;
		$sql2 = "SELECT max(`queue`) FROM `tbl_after_sales_followup`";
		$result2 = $dbdp->query($sql2);
		$rows = $result2->fetch_assoc();
		$maxqueue = $rows['max(`queue`)'];
		if($nor>0) {} else {
			$sql ='INSERT INTO `tbl_after_sales_followup`(`secid`, `oid`, `web`, `status`, `queue`) VALUES ("'.$id.'","#inv00","'.$web.'","NA" ,"'.($maxqueue+1).'")';
			$result = $dbdp->query($sql);
		}
	}
	
	function get_all_undelivred_oc() {
		global $dbdp;
		
		$sql = 'SELECT * FROM `tbl_undelivered_oc` ORDER BY id DESC';
		$result = $dbdp->query($sql);
		$array = array();
		while($row = $result->fetch_assoc()) {
			$row['issue'] = json_decode($row['issue']);
			$row['ismorepills'] = json_decode($row['ismorepills']);
			array_push($array, $row);
		}
		return $array;
	}
	
	function delete_undelivred_oc($id) {
		global $dbdp;
		
		$sql = 'DELETE FROM `tbl_undelivered_oc` WHERE `id`="'.$id.'"';
		$result = $dbdp->query($sql);
		return "Deleted Successfully";
	}
	
	function delete_followup_oc($id) {
		global $dbdp;
		
		$sql = 'DELETE FROM `tbl_after_sales_followup` WHERE `id`="'.$id.'"';
		$result = $dbdp->query($sql);
		return "Deleted Successfully";
	}
	
	function delete_followup_oc_when_original_delete($id) {
		global $dbdp;
		
		$sql = 'DELETE FROM `tbl_after_sales_followup` WHERE `secid`="'.$id.'"';
		$result = $dbdp->query($sql);
		return "Deleted Successfully";
	}
	
	function update_undelivred_oc($data) {
		global $dbdp;
		if($data->statusval=="Delivered") {
			$sql = "DELETE FROM `tbl_undelivered_oc` WHERE `id`='".$data->oid."'";
			$result = $dbdp->query($sql);
		} else {
			$sql = "UPDATE `tbl_undelivered_oc` SET `status`='".$data->statusval."' WHERE `id`='".$data->oid."'";
			$result = $dbdp->query($sql);
		}
		return "Updated Successfully";
	}
	
	function update_followup_oc($data) {
		global $dbdp;
		if($data->statusval=="Delivered") {
			$sql = "DELETE FROM `tbl_after_sales_followup` WHERE `id`='".$data->oid."'";
			$result = $dbdp->query($sql);
		} else if($data->statusval=="Undelivered") {
			$sql0 = "SELECT * FROM tbl_after_sales_followup WHERE `id`='".$data->oid."'";
			$result = $dbdp->query($sql0);
			$row = $result->fetch_assoc();
			
			$sql1 = "INSERT INTO `tbl_undelivered_oc`(`secid`, `web`) VALUES ('".$row['secid']."','".$row['web']."')";
			$result = $dbdp->query($sql1);
			
			$sql = "DELETE FROM `tbl_after_sales_followup` WHERE `id`='".$data->oid."'";
			$result = $dbdp->query($sql);
		} else{
			
			$sql2 = "SELECT max(`queue`) FROM `tbl_after_sales_followup`";
			$result2 = $dbdp->query($sql2);
			$rows = $result2->fetch_assoc();
			$maxqueue = $rows['max(`queue`)'];
		
		
			$sql = "UPDATE `tbl_after_sales_followup` SET `status`='".$data->statusval."', `queue`='".($maxqueue+1)."' WHERE `id`='".$data->oid."'";
			$result = $dbdp->query($sql);
			$res = $this->set_followup_numberofcall($data);
		}
		return "Updated Successfully";
	}
	
	
	function get_all_aftersalesfollowup_oc() {
		global $dbdp;
		
		$sql = 'SELECT * FROM `tbl_after_sales_followup` ORDER BY queue ASC';
		$result = $dbdp->query($sql);
		$array = array();
		while($row = $result->fetch_assoc()) {
			$row['numofcalls'] = json_decode($row['numofcalls']);
			array_push($array, $row);
		}
		return $array;
	}
	
	function set_followup_numberofcall($data) {
		global $dbdp;
		$sql = 'SELECT * FROM `tbl_after_sales_followup` WHERE id="'.$data->oid.'"';
		$result = $dbdp->query($sql);
		$row = $result->fetch_assoc();
		
		$arr = json_decode($row['numofcalls']);
		if($data->statusval=="Processed") {
			$setval = (int)$arr[0]+1;
			$arr[0] = $setval;
			$sql = "UPDATE `tbl_after_sales_followup` SET `numofcalls`='".json_encode($arr)."' WHERE `id`='".$data->oid."'";
			$result = $dbdp->query($sql);
		} else if($data->statusval=="Shipped") {
			$setval = (int)$arr[1]+1;
			$arr[1] = $setval;
			$sql = "UPDATE `tbl_after_sales_followup` SET `numofcalls`='".json_encode($arr)."' WHERE `id`='".$data->oid."'";
			$result = $dbdp->query($sql);
		} else if($data->statusval=="Tracking") {
			$setval = (int)$arr[2]+1;
			$arr[2] = $setval;
			$sql = "UPDATE `tbl_after_sales_followup` SET `numofcalls`='".json_encode($arr)."' WHERE `id`='".$data->oid."'";
			$result = $dbdp->query($sql);
		} else if($data->statusval=="Delivered") {
			$setval = (int)$arr[3]+1;
			$arr[3] = $setval;
			$sql = "UPDATE `tbl_after_sales_followup` SET `numofcalls`='".json_encode($arr)."' WHERE `id`='".$data->oid."'";
			$result = $dbdp->query($sql);
		}
	}
}?>