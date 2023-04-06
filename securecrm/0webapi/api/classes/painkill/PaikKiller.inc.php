<?php 
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);

if(!isset($_SESSION)){
		session_start();
	} 
  include_once('config.php');
   $db = getDB();

class PaikKiller
{
    private $db;


	function login($data) {
		global $db;
		$db = getDB();
	    function getUserIP()
        {
            // Get real visitor IP behind CloudFlare network
            if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                      $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                      $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            }
            $client  = @$_SERVER['HTTP_CLIENT_IP'];
            $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
            $remote  = $_SERVER['REMOTE_ADDR'];
        
            if(filter_var($client, FILTER_VALIDATE_IP))
            {
                $ip = $client;
            }
            elseif(filter_var($forward, FILTER_VALIDATE_IP))
            {
                $ip = $forward;
            }
            else
            {
                $ip = $remote;
            }
        
            return $ip;
        }
        date_default_timezone_set('Asia/Kolkata');
        $timestamp = date("Y-m-d H:i:s");
        $user_ip = getUserIP();
        
        $people_json = file_get_contents('https://ipwhois.app/json/'.$user_ip);

        $decoded_json = json_decode($people_json, false);
        
        
        $sql = "INSERT into userip(ip, country, city, region, latitude, logitude, date) VALUE('".$user_ip."','".$decoded_json->country."','".$decoded_json->city."','".$decoded_json->region."','".$decoded_json->latitude."','".$decoded_json->longitude."','".$timestamp."')";
		$result = $db->query($sql);
        
		$sql = "SELECT * FROM master_admin_login WHERE username='".$data->username."' AND password='".md5($data->password)."'";
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
		$nor = $result->num_rows;
		
		if($nor>0)
		{
			$str = '{"msg":"Login Successfully"}';
		} else {
			$str = '{"error":{"text":"Bad request wrong username and password"}}';
		} 
		return $str;
	}
	
// 	function login($data) {
// 		global $db;
// 		$db = getDB();
// 	    function getUserIP()
//         {
//             // Get real visitor IP behind CloudFlare network
//             if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
//                       $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
//                       $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
//             }
//             $client  = @$_SERVER['HTTP_CLIENT_IP'];
//             $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
//             $remote  = $_SERVER['REMOTE_ADDR'];
        
//             if(filter_var($client, FILTER_VALIDATE_IP))
//             {
//                 $ip = $client;
//             }
//             elseif(filter_var($forward, FILTER_VALIDATE_IP))
//             {
//                 $ip = $forward;
//             }
//             else
//             {
//                 $ip = $remote;
//             }
        
//             return $ip;
//         }
//         date_default_timezone_set('Asia/Kolkata');
//         $timestamp = date("Y-m-d H:i:s");
//         $user_ip = getUserIP();
        
//         $people_json = file_get_contents('https://ipwhois.app/json/'.$user_ip);

//         $decoded_json = json_decode($people_json, false);
        
//         $getIP = "SELECT * FROM accessip WHERE ip='".$user_ip."'";
// 		$resultIP = $db->query($getIP);
// 		$rowIP = $resultIP->fetch_assoc();
// 		$iptotal = $resultIP->num_rows;
		
// 		if($iptotal>0)
// 		{
//             $sql = "INSERT into userip(ip, country, city, region, latitude, logitude, date) VALUE('".$user_ip."','".$decoded_json->country."','".$decoded_json->city."','".$decoded_json->region."','".$decoded_json->latitude."','".$decoded_json->longitude."','".$timestamp."')";
//     		$result = $db->query($sql);
            
//     		$sql = "SELECT * FROM master_admin_login WHERE username='".$data->username."' AND password='".md5($data->password)."'";
//     		$result = $db->query($sql);
//     		$row = $result->fetch_assoc();
//     		$nor = $result->num_rows;
    		
//     		if($nor>0)
//     		{
//     			$str = '{"msg":"Login Successfully"}';
//     		} else {
//     			$str = '{"error":{"text":"Bad request wrong username and password"}}';
//     		} 
    		
// 		}else {
// 		    $str = '{"error":{"text":"Invalid Access"}}';
// 		}
//         return $str;
// 	}
	
	function get_allorders_today($array, $inc) {
		global $db;
		$date = date("d/m/Y");
		$sqls = "select * from orders WHERE orderdate='".$date."' ORDER BY id DESC";
		$result = $db->query($sqls);
		$nor = $result->num_rows;
		if($nor>0) {
		    while($row = $result->fetch_assoc()) {
    			$arr['paymentsts'] = $row['id'];
    			$arr['invid'] = "$".$row['orderno'];
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
    			$arr['trck'] = $this->get_traking_ids($row['id']);
    			$arr['noc'] = $this->get_name_on_card($row['id']);
    			$arr['cno'] = $this->get_card_no($row['id']);
    			$arr['cex'] = $this->get_card_expriry($row['id']);
    			$arr['cvv'] = $this->get_card_cvv($row['id']);
    			$arr['pay_link'] = $row['payment_link'];
    			$arr['oid'] = $row['id'];
			$arr['total']=$this->get_product_price($row['id']);
    			$arr['status'] = $row['status'];
    			$arr['web'] = "painkillermedicines.com";
    			$arr['inc'] = $inc;
    			array_push($array, $arr);
    			$inc++;
    		}
		}
		return [$array, $inc];
	}
	
	function get_all_orders($array, $inc, $data) {
		global $db;
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
		$result = $db->query($sqls);
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
			$arr['trck'] = $this->get_traking_ids($row['id']);
			$arr['pay_link'] = $row['payment_link'];
			$arr['oid'] = $row['id'];
			$arr['total']=$this->get_product_price($row['id']);
			$arr['status'] = $row['status'];
			$arr['web'] = "painkillermedicines.com";
			$arr['inc'] = $inc;
			array_push($array, $arr);
			$inc++;
		}
		
		return [$array, $inc];
	}
	
	
	
	function get_allorders_array($array) {
		global $db;
		$sqls = "select * from orders ORDER BY id DESC ";
		$result = $db->query($sqls);
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
			$arr['trck'] = $this->get_traking_ids($row['id']);
			$arr['noc'] = $this->get_name_on_card($row['id']);
			$arr['cno'] = $this->get_card_no($row['id']);
			$arr['cex'] = $this->get_card_expriry($row['id']);
			$arr['cvv'] = $this->get_card_cvv($row['id']);
			$arr['oid'] = $row['id'];
			$arr['total']=$this->get_product_price($row['id']);
			$arr['status'] = $row['status'];
			$arr['web'] = "painkillermedicines.com";
			$arr['inc'] = $inc;
			
			array_push($array, $arr);
			$inc++;
		}
		
		return $array;
	}
	
	function get_single_order_array($pid) {
		global $db;
			$id = ltrim($pid, '#'); 
			$sqls = "select * from orders WHERE orderno='".$id."'";
			$result = $db->query($sqls);
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
			$arr['total']=$this->get_product_price($row['id']);
				$arr['status'] = $row['status'];
				$arr['web'] = "painkillermedicines.com";
				
				return $arr;
			} else {
				return array();
			}
	}
	
	function get_single_order_array_byid($id) {
		global $db;
		$sqls = "select * from orders WHERE id='".$id."'";
		$result = $db->query($sqls);
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
			$arr['total']=$this->get_product_price($row['id']);
			$arr['status'] = $row['status'];
			$arr['web'] = "painkillermedicines.com";
			
			return $arr;
		} else {
			return array();
		}
	}
	
    function get_customer_email($id) {
		global $db;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $db->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['email'], "UTF-8", "UTF-8");
	}
	
	function get_customer_phoneno($id) {
		global $db;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $db->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['phone'], "UTF-8", "UTF-8");
	}
	
	function get_customer_name($id) {
		global $db;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $db->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['fname']." ".$row['lname'], "UTF-8", "UTF-8");
	}
	
	function get_customer_address($id) {
		global $db;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $db->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['address'], "UTF-8", "UTF-8");
	}
	
	function get_customer_city($id) {
		global $db;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $db->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['city'], "UTF-8", "UTF-8");
	}
	
	function get_customer_state($id) {
		global $db;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $db->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['state'], "UTF-8", "UTF-8");
	}
	
	function get_customer_zip($id) {
		global $db;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $db->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['zip'], "UTF-8", "UTF-8");
	}
	
	function get_customer_country($id) {
		global $db;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $db->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['country'], "UTF-8", "UTF-8");
	}
	
	function get_product_name($id) {
		global $db;
		$result = $db->query("select * from order_details Where order_id='".$id."'");

		$arr = array();
		while($rows = $result->fetch_assoc()) {
			$sql = "select * from subcategory where sid='".$rows['pid']."' AND id='".$rows['cid']."'";	
			$result1 = $db->query($sql);
			$rows2 = $result1->fetch_assoc();
			
			$sql2 = "select * from pdetails where pid='".$rows['strength']."'";	
			$result2 = $db->query($sql2);
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
		global $db;
		$result = $db->query("select * from order_details Where order_id='".$id."'");
		$arr = array();
		while($rows = $result->fetch_assoc()) {
			array_push($arr, $rows['qty']);
		}
		return $arr;
	}
	
	function get_product_price($id) {
		global $db;
		$result = $db->query("select * from order_details Where order_id='".$id."'");
		$arr = array();
		while($rows = $result->fetch_assoc()) {
			array_push($arr, $rows['price']);
		}
		return $arr;
	}
	
	function get_shiping_sts($id) {
		global $db;
		$sql = "select * from tbl_shipping_sts where order_id='$id'";	
		$result1 = $db->query($sql);
		$row = $result1->fetch_assoc();
		return empty($row['ship_name'])?"":$row['ship_name'];
	}
	
	function get_traking_ids($id) {
		global $db;
		$sql = "select * from tbl_traking_ids where order_id='$id'";	
		$result1 = $db->query($sql);
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
		global $db;
		$sql = "select * from cardinfo where oid='".$oid."'";	
		$result1 = $db->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['name_on_card'], "UTF-8", "UTF-8");
	}
	
	function get_card_no($oid) {
		global $db;
		$sql = "select * from cardinfo where oid='".$oid."'";	
		$result1 = $db->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['credit_card_number'], "UTF-8", "UTF-8");
	}
	
	function get_card_expriry($oid) {
		global $db;
		$sql = "select * from cardinfo where oid='".$oid."'";	
		$result1 = $db->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['exp_date'], "UTF-8", "UTF-8");
	}

	
	function get_card_cvv($oid) {
		global $db;
		$sql = "select * from cardinfo where oid='".$oid."'";	
		$result1 = $db->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['cvv2'], "UTF-8", "UTF-8");
	}
	
	/*Delete Order Function*/
	function delete_order_today($data, $array) {
		global $db;
		$db = getDB();
		$userData = '';
		$sql = "DELETE from orders WHERE id='".$data->id."'";
		$result = $db->query($sql);
	}
	
	/*Delete Order Function*/
	function delete_trackingids($data, $array) {
		global $db;
		$db = getDB();

		$sql = "select * from tbl_traking_ids where id='".$data->oid."'";	
		$result1 = $db->query($sql);
		$row = $result1->fetch_assoc();
		$trackingid = $row['tracking_id'];

		$userData = '';
		$sql = "DELETE from tbl_traking_ids WHERE id='".$data->oid."'";
		$result = $db->query($sql);

		$dbhost="newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
    	$dbuser="root";
    	$dbpass="Iamawesome8425";
    	$dbname="global";
		//ssfsf
    	
    	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		$sql = "DELETE FROM ogtracking WHERE trackingid='".$trackingid."'";
		$result = $conn->query($sql);

	}
	
	
	function delete_order($data, $array) {
		global $db;
		$db = getDB();
		$userData = '';
		$sql = "DELETE from orders WHERE id='".$data->id."'";
		$result = $db->query($sql);
			$array = $this->get_allorders_array($array);
		return $array;
	}
	
	/*Update order Status*/ 
	function update_order_status_todayoc($data, $array) {
		global $db;
		$db = getDB();
		$userData = '';
		$sql = "UPDATE `orders` SET `status`='".$data->statusval."' WHERE `id`='".$data->oid."'";
		$result = $db->query($sql);
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
		global $db;
		$db = getDB();
		$userData = '';
		$sql = "UPDATE `orders` SET `status`='".$data->statusval."' WHERE `id`='".$data->oid."'";
		$result = $db->query($sql);
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
		global $db;
		$db = getDB();
		if(!empty($data->shipp)) {
			$sql = "INSERT INTO `tbl_shipping_sts`(`order_id`, `ship_name`) VALUES ('".$data->oid."', '".$data->shipp."')";
			$result = $db->query($sql);
		}
	}
	
	/*Add Order Payment Link function*/
	function addocpayment_link($data, $array) {
		global $db;
		if(!empty($data->linkurl)) {
			$sql = "UPDATE `orders` SET `payment_link`='".$data->linkurl."' WHERE id='".$data->oid."'";
			$result = $db->query($sql);
		}
	}
	
	function addshippingpain($data, $array) {
		global $db;
		$db = getDB();
		if(!empty($data->shipp)) {
			$sql = "INSERT INTO `tbl_shipping_sts`(`order_id`, `ship_name`) VALUES ('".$data->oid."', '".$data->shipp."')";
			$result = $db->query($sql);
		}
		$array = $this->get_allorders_array($array);
		return $array;
	}
	
	
	
	/*Add Traking All and Single IDS*/
	function addtrakingidtoday_oc($data, $array) {
		global $db;
		$db = getDB();
		foreach($data->trakingids as $value):
			if(!empty($value->trakingid)) { 
				 $sql = "INSERT INTO `tbl_traking_ids`(`order_id`, `tracking_id`, `tracking_link`) VALUES ('".$data->oid."', '".$value->trakingid."', '".$value->trakinglink."')";
				$result = $db->query($sql);
			}
		endforeach;
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
	}
	
	function addtrakingid($data, $array) {
		global $db;
		$db = getDB();
		$id = 0;
		foreach($data->trakingids as $value):
			if(!empty($value->trakingid)) {
				$sql = "INSERT INTO `tbl_traking_ids`(`order_id`, `tracking_id`) VALUES ('".$data->oid."', '".$value->trakingid."')";
				$result = $db->query($sql);
			}
		endforeach;
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
		$array = $this->get_allorders_array($array);
		return $array;
	}
	
	/*Function for Mark Order Dliver by suer via Mail*/
	function mark_oc_deliver($id) {
		global $db;
		$db = getDB();
		$sql = 'UPDATE `orders` SET status="Delivered" WHERE id="'.$id.'"';
		$result = $db->query($sql);
	}
	
	/* FUnction to resend Traking ID in Modal dialog*/
	function resend_traking_mail($data) {
		global $db;
		$db = getDB();
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
	}
	
	/* All manual Order Return Function*/
	function get_manual_all_orders($array, $inc, $method) {
		global $db;		
		switch($method) {
			case "d1":
				$sqls = "SELECT * FROM `tbl_manual_order` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) ORDER BY id DESC";
				break;
				
			case "d10":
				$sqls = "SELECT * FROM `tbl_manual_order` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) ORDER BY id DESC";
				break;
				
			case "d15" : 
				$sqls = "SELECT * FROM `tbl_manual_order` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 15 DAY) ORDER BY id DESC";
				break;
				
			case "m1": 
				$sqls = "SELECT * FROM `tbl_manual_order` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY id DESC";
				break;
				
			case "m6":
				$sqls = "SELECT * FROM `tbl_manual_order` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) ORDER BY id DESC";
				break;
				
			case "y1":
				$sqls = "SELECT * FROM `tbl_manual_order` WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) ORDER BY id DESC";
				break;
				
			case "all":
				$sqls = "SELECT * FROM `tbl_manual_order` ORDER BY id DESC";
				break;
			default:
			    $sqls = "SELECT * FROM `tbl_manual_order` ORDER BY id DESC";
		}
	
		$result = $db->query($sqls);
		
		while($row = $result->fetch_assoc()) {
			
			$arr['paymentsts'] = $row['id'];
			$arr['invid'] = "#INV-".$row['id']."".substr(strtotime($row["timestamp"]), 0, 4);
			$arr['date'] = date('d/m/Y', strtotime($row['timestamp']));
			$arr['phone'] = $row['cmono'];
			$arr['email'] = $row['cemail'];
			$arr['name'] = $row['cname'];
			$arr['address'] = $row['caddress'];
			$arr['city'] = $row['ccity'];
			$arr['state'] = $row['cstate'];
			$arr['zip'] = $row['czip'];
			$arr['country'] = $row['ccountry'];
			
				$pnamearr = array();
				$asr['pname'] = $row['pname'];
				$asr['qty'] = $row['pqty'];
				$asr['price'] = $row['ptot'];
				array_push($pnamearr, $asr);
						
			$arr['prname'] = $pnamearr;
			
			
			$arr['qty'] = $row['pqty'];
			$arr['amt'] = $row['ptot'];
			$arr['shsts'] = $this->get_shipingsts_manualoc($row['id']);
			$arr['trck'] = $this->get_traking_ids_manualoc($row['id']);
			
			$arr['noc'] = "";
			$arr['cno'] = "";
			$arr['cex'] = "";
			$arr['cvv'] = "";
			$arr['pay_link'] = $row['payment_link'];
			$arr['oid'] = $row['id'];
			$arr['status'] = $row['pprice'];
			$arr['total']=$row['ptot'];
			$arr['web'] = "Manualorder";
			$arr['inc'] = $inc;
			array_push($array, $arr);
			$inc++;
		}
		
		return [$array, $inc];
	}
	
	function manualoc_get_single_order_array($pid) {
		global $db;		
		$payid = explode("-",$pid);
		$id = substr_replace($payid[1] ,"", -4);
		$sqls = "SELECT * FROM `tbl_manual_order` WHERE id='".$id."'";
		$result = $db->query($sqls);
		$nor = $result->num_rows;
		if($nor>0) {
			$row = $result->fetch_assoc();
			$arr['paymentsts'] = $row['id'];
			$arr['invid'] = "#INV-".$row['id']."".substr(strtotime($row["timestamp"]), 0, 4);
			$arr['date'] = date('d/m/Y', strtotime($row['timestamp']));
			$arr['phone'] = $row['cmono'];
			$arr['email'] = $row['cemail'];
			$arr['name'] = $row['cname'];
			$arr['address'] = $row['caddress'];
			$arr['city'] = $row['ccity'];
			$arr['state'] = $row['cstate'];
			$arr['zip'] = $row['czip'];
			$arr['country'] = $row['ccountry'];
			
				$pnamearr = array();
				$asr['pname'] = $row['pname'];
				$asr['qty'] = $row['pqty'];
				$asr['price'] = $row['ptot'];
				array_push($pnamearr, $asr);
						
			$arr['prname'] = $pnamearr;
			
			
			$arr['qty'] = $row['pqty'];
			$arr['amt'] = $row['ptot'];
			$arr['shsts'] = $this->get_shipingsts_manualoc($row['id']);
			$arr['trck'] = $this->get_traking_ids_manualoc($row['id']);
			
			$arr['noc'] = "";
			$arr['cno'] = "";
			$arr['cex'] = "";
			$arr['cvv'] = "";
			$arr['pay_link'] = $row['payment_link'];
			$arr['oid'] = $row['id'];
			$arr['total']=$row['ptot'];
			$arr['status'] = $row['pprice'];
			$arr['web'] = "Manualorder";
			
			return $arr;
		} else {
			return array();
		}
	}
	
	function mcget_single_order_array_byid($id) {
		global $db;		
		$sqls = "SELECT * FROM `tbl_manual_order` WHERE id='".$id."'";
		$result = $db->query($sqls);
		$nor = $result->num_rows;
		if($nor>0) {
			$row = $result->fetch_assoc();
			$arr['paymentsts'] = $row['id'];
			$arr['invid'] = "#INV-".$row['id']."".substr(strtotime($row["timestamp"]), 0, 4);
			$arr['date'] = date('d/m/Y', strtotime($row['timestamp']));
			$arr['phone'] = $row['cmono'];
			$arr['email'] = $row['cemail'];
			$arr['name'] = $row['cname'];
			$arr['address'] = $row['caddress'];
			$arr['city'] = $row['ccity'];
			$arr['state'] = $row['cstate'];
			$arr['zip'] = $row['czip'];
			$arr['country'] = $row['ccountry'];
			
				$pnamearr = array();
				$asr['pname'] = $row['pname'];
				$asr['qty'] = $row['pqty'];
				$asr['price'] = $row['ptot'];
				array_push($pnamearr, $asr);
						
			$arr['prname'] = $pnamearr;
			
			
			$arr['qty'] = $row['pqty'];
			$arr['amt'] = $row['ptot'];
			$arr['shsts'] = $this->get_shipingsts_manualoc($row['id']);
			$arr['trck'] = $this->get_traking_ids_manualoc($row['id']);
			
			$arr['noc'] = "";
			$arr['cno'] = "";
			$arr['cex'] = "";
			$arr['cvv'] = "";
			$arr['pay_link'] = $row['payment_link'];
			$arr['oid'] = $row['id'];
			$arr['total']=$row['ptot'];
			$arr['status'] = $row['pprice'];
			$arr['web'] = "Manualorder";
			
			return $arr;
		} else {
			return array();
		}
	}
	
	/* get Traking ID of Manual Order*/
	function get_traking_ids_manualoc($id) {
		global $db;
		$sql = "select * from tbl_traking_ids WHERE order_id='M_".$id."'";	
		$result1 = $db->query($sql);
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
	
	/* get Shipping Company of Manual Order*/
	function get_shipingsts_manualoc($id) {
		global $db;
		$sql = "select * from tbl_shipping_sts WHERE order_id='M_".$id."'";	
		$result1 = $db->query($sql);
		$row = $result1->fetch_assoc();
		return empty($row['ship_name'])?"":$row['ship_name'];
	}
	
	
	/* Update Status Of manual Order*/
	function update_order_status_manual_oc($data) {
		global $db;
		$db = getDB();
		$userData = '';
		$date = date('Y-m-d H:i:s');
		$sql = "UPDATE `tbl_manual_order` SET `pprice`='".$data->statusval."', paymentDate='".$date."' WHERE `id`='".$data->oid."'";
		$result = $db->query($sql);
		if($data->statusval=="Cancelled") {
		} else if($data->statusval=="Delivered"){
			$id = $data->oid;
			include('manual_order/oc-delivered.php');
		} else {
			$id = $data->oid;
			include('manual_order/oc-status.php');
		}
		$sql = "select * from tbl_manual_order WHERE id='".$data->oid."'";	
		$result1 = $db->query($sql);
		while($row = $result1->fetch_assoc()) {
			$timestamp = $row["timestamp"];
		}
		$invid = "INV-".$data->oid."".substr(strtotime($timestamp), 0, 4);
		$dbhost="newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
        $dbuser="root";
		$dbpass="Iamawesome8425";
        $dbname="global";
        
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        $sqlNew1 = "UPDATE orderdetails SET orderStatus='".$data->statusval."', productStatus='{\"x9725\": \"".$data->statusval."\"}' WHERE orderid='".$invid."'";
        $resultNew1 = $conn->query($sqlNew1);


		$array = $this->get_manual_all_orders(array(),0,"all");
		return $array[0];
	}
	
	/*function Delete manual Order*/
	function delete_order_manual_oc($data) {
		global $db;
		$db = getDB();
		$userData = '';
		$sql = "DELETE from tbl_manual_order WHERE id='".$data->id."'";
		$result = $db->query($sql);
		$array = $this->get_manual_all_orders(array(),0,"all");
		return $array[0];
	}
	
	/*function Delete manual Order*/
	function delete_trackingids_moc($data) {
		global $db;

		$sql = "select * from tbl_traking_ids where id='".$data->oid."'";	
		$result1 = $db->query($sql);
		$row = $result1->fetch_assoc();
		$trackingid = $row['tracking_id'];

		$userData = '';
		$sql = "DELETE from tbl_traking_ids WHERE id='".$data->oid."'";
		$result = $db->query($sql);

		$dbhost="newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
    	$dbuser="root";
    	$dbpass="Iamawesome8425";
    	$dbname="global";
		//ssfsf
    	
    	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		$sql = "DELETE FROM ogtracking WHERE trackingid='".$trackingid."'";
		$result = $conn->query($sql);
	}
	
	/* Add Tracking Manual Order */
	function addtrakingid_manual_oc($data) {
		global $db;
		$db = getDB();
		$id = 0;
		foreach($data->trakingids as $value):
			if(!empty($value->trakingid)) {
				$sql = "INSERT INTO `tbl_traking_ids`(`order_id`, `tracking_id`, `tracking_link`) VALUES ('M_".$data->oid."', '".$value->trakingid."', '".$value->trakinglink."')";
				$result = $db->query($sql);
			}
		endforeach;
		$id = $data->oid;
		$sqlUpdate = "UPDATE SET pprice='Tracking' WHERE id='".$data->oid."'";	
		$resultUpdate = $db->query($sqlUpdate);

		$sql = "select * from tbl_manual_order WHERE id='".$data->oid."'";	
		$result1 = $db->query($sql);
		while($row = $result1->fetch_assoc()) {
			$timestamp = $row["timestamp"];
		}
		$invid = "INV-".$data->oid."".substr(strtotime($timestamp), 0, 4);
		
    	$dbhost="newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
        $dbuser="root";
		$dbpass="Iamawesome8425";
        $dbname="global";
            	
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        $sqlNew = "INSERT INTO ogtracking (`orderid`, `trackinglink`, `trackingid`) VALUES ('".$invid."', '".$value->trakinglink."', '".$value->trakingid."')";
        $resultNew = $conn->query($sqlNew);
        		
        $sqlNew1 = "UPDATE orderdetails SET orderStatus='Tracking', productStatus='{\"x9725\": \"Tracking\"}' WHERE orderid='".$invid."'";
    	$resultNew1 = $conn->query($sqlNew1);
		include('manual_order/oc-tracking.php');

		

		$array = $this->get_manual_all_orders(array(),0,"all");

		return $array[0];
	}
	
	/* Add Shiping Company Manual Order*/
	function addshipping_maualoc($data, $arr) {
		global $db;
		$db = getDB();
		if(!empty($data->shipp)) {
			$sql = "INSERT INTO `tbl_shipping_sts`(`order_id`, `ship_name`) VALUES ('M_".$data->oid."', '".$data->shipp."')";
			$result = $db->query($sql);
		}
	}
	
	/* Add Payment Link Order*/
	function addocpayment_link_maualoc($data, $arr) {
		global $db;
		$db = getDB();
		if(!empty($data->linkurl)) {
			$sql = "UPDATE tbl_manual_order SET `payment_link`='".$data->linkurl."' WHERE id='".$data->oid."'";
			$result = $db->query($sql);

			$sql = "select * from tbl_manual_order WHERE id='".$data->oid."'";	
			$result1 = $db->query($sql);
			while($row = $result1->fetch_assoc()) {
				$timestamp = $row["timestamp"];
			}
			$invid = "INV-".$data->oid."".substr(strtotime($timestamp), 0, 4);
			

			$dbhost="newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
        	$dbuser="root";
			$dbpass="Iamawesome8425";
        	$dbname="global";
        	
        	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    		$sqlNew = "UPDATE orderdetails SET paymentlink='".$data->linkurl."', paymentMethod='paypal' WHERE orderid='".$invid."'";
    		$resultNew = $conn->query($sqlNew);


		}
	}
	
	
	
	/* Save manual Order*/
	function save_manual_order($data) {
	    
		global $db;
		$db = getDB();
		if(
			$data->cname=="smith" || 
			$data->cname=="Smith" || 
			empty($data->cname) || 
			empty($data->ptot) || 
			empty($data->pqty) || 
			empty($data->cadd) || 
			empty($data->ccity) || 
			empty($data->cstate) || 
			empty($data->czip) || 
			empty($data->ccountry) || 
			empty($data->cemail) || 
			empty($data->cphone) || 
			empty($data->pname)
			) {
			$array = $this->get_manual_all_orders(array(),0,"all");
			return $array[0];
		} else {
			$qur = "INSERT INTO `tbl_manual_order`(`pname`, `pqty`, `pprice`, `ptot`, `cname`, `caddress`, `ccity`, `cstate`, `czip`, `ccountry`,`cemail`, `cmono`, `payment_link`) VALUES ('".$data->pname."','".$data->pqty."','".$data->paymentsts."','".$data->ptot."','".$data->cname."','".$data->cadd."','".$data->ccity."','".$data->cstate."','".$data->czip."','".$data->ccountry."','".$data->cemail."','".$data->cphone."', '')";
			$result = $db->query($qur);	
			$id = $db->insert_id;

			$sql = "select * from tbl_manual_order WHERE id='".$id."'";	
			$result1 = $db->query($sql);
			while($row = $result1->fetch_assoc()) {
				$timestamp = $row["timestamp"];
			}
			$invid = "INV-".$id."".substr(strtotime($timestamp), 0, 4);
			$db_host="newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
			$db_user="root";
			$db_name="global";
			$db_password="Iamawesome8425";
			try
			{
				$connMain=new PDO("mysql:host={$db_host};dbname={$db_name};port=3306",$db_user,$db_password);
				$connMain->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOEXCEPTION $e)
			{
				$e->getMessage();
			}

			$inserManData = $connMain->prepare('INSERT INTO orderdetails(source, website, isInbound, shippingCompany, orderid, userid, custid, paymentlink, masterid, subtotal, dcharge, discount, total, ogtotal, currency, convertedPrice, symbol, profit, paymentMethod, paidAmount, paymentStatus, orderStatus, productStatus, addressId, fname, lname, email,phone, addressline1, addressline2, state, city, country, postalcode, coupon) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);');
			$inserManData->execute(['MAN', ' ', ' ', ' ', $invid, '0', '0', NULL, '0', $data->ptot, 0, 0, $data->ptot, $data->ptot, 'USD', $data->ptot, '$', 0, ' ', 0.00, 'Unpaid', 'Pending', '{"x9725": "Pending"}', 0, $data->cname, ' ', $data->cemail, $data->cphone, $data->cadd, ' ', $data->cstate, $data->ccity, $data->ccountry, $data->czip, '']);

			$inserManData = $connMain->prepare('INSERT INTO ogorderproduct(orderid,shippingCompany, productCode, strengthCode, quantityCode, status, productName, productCategory, strength, quantity, quantityPrice, quantityCost, totalQuantity, totalPrice, total, saveAmount, userId) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
			$inserManData->execute([$invid, ' ', ' ', ' ', ' ', 'Pending', $data->pname, 'Custom', 'x',  $data->pqty, $data->ptot/$data->pqty, $data->ptot, '1', $data->ptot, $data->ptot, 0, 1]);

		}
		if($data->paymentsts=="Pending") {
			include('manual_order/pending-payment.php');
		} else {
			include('manual_order/received-payment.php');
		}
		$array = $this->get_manual_all_orders(array(),0,"all");
		return $array[0];
	}
	
	/* Update manual Order*/
	function update_manual_order($data) {
		global $db;
		$db = getDB();

		$qur = "UPDATE `tbl_manual_order` SET `pname`='".$data->prname[0]->pname."',`pqty`='".$data->prname[0]->qty."',`ptot`='".$data->prname[0]->price."',`cname`='".$data->name."',`caddress`='".$data->address."',`ccity`='".$data->city."',`cstate`='".$data->state."',`czip`='".$data->zip."',`ccountry`='".$data->country."',`cemail`='".$data->email."',`cmono`='".$data->phone."' WHERE id='".$data->oid."'";
		$result = $db->query($qur);	
		$id = $db->insert_id;
		
		$array = $this->get_manual_all_orders(array(),0,"all");
		return $array[0];
	}
	
	/* FUnction to resend Traking ID in Modal dialog in Manual Order*/
	function resend_traking_mail_manual_oc($data) {
		global $db;
		$db = getDB();
		$id = $data->oid;
		include('manual_order/oc-tracking.php');
	}
}?>
