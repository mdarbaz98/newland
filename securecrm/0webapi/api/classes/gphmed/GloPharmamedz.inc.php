<?php 
ini_set('display_errors', 1);
error_reporting(~0);
if(!isset($_SESSION)){
		session_start();
	} 
	include('config.php');
   $dbgpmz = getDBGPMZ();

class GloPharmamedz
{
    private $dbgpmz;

	function get_allorders_today($array, $inc) {
		global $dbgpmz;
		$date = date("d/m/Y");
		$sqls = "select * from orders where STR_TO_DATE(orderdate, '%d/%m/%Y') >= DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL 1.5  DAY) ORDER BY id DESC";
		
		$result = $dbgpmz->query($sqls);
		while($row = $result->fetch_assoc()) {
			$arr['paymentsts'] = $row['id'];
			$arr['invid'] = "#".$row['orderno'];
			$arr['date'] = $row['orderdate'];
			$arr['custid'] = $row['cust_id'];
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
			$arr['pid'] = $this->get_product_pid($row['id']);
			$arr['amt'] = $this->get_product_price($row['id']);
			$arr['shsts'] = $this->get_shiping_sts($row['id']);
			$arr['trck'] = $this->get_traking_ids($row['id']);
			$arr['payby'] = $this->get_customer_payby($row['cust_id']);
			$arr['pay_link'] = $row['payment_link'];
			$arr['oid'] = $row['id'];
			$arr['orderValue'] = $row['order_value']+$row['discount'];
			$arr['shipping']=$row['shipping'];
			$arr['discount']=$row['discount'];
			$arr['total']=$row['total'];
			$arr['status'] = $row['status'];
			$arr['web'] = "oneglobalpharma.com";
			$arr['inc'] = $inc;
			array_push($array, $arr);
			$inc++;
		}
		
		return [$array, $inc];
	}
	
	
	function get_all_orders($array, $inc, $data) {
		global $dbgpmz;
		$sqls = "";
		switch($data->method) {
		   case "d10":
				$sqls = "select * from orders where STR_TO_DATE(orderdate, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) ORDER BY id DESC";	
				break;
				
			case "d15" :
				$sqls = "select * from orders where STR_TO_DATE(orderdate, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 15 DAY) ORDER BY id DESC"; 
				//$sqls = "select * from orders where orderdate>='30/09/2021' and orderdate<='30/11/2021' ORDER BY id DESC";
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
		$result = $dbgpmz->query($sqls);
		while($row = $result->fetch_assoc()) {
			$arr['paymentsts'] = $row['id'];
			$arr['custid'] = $row['cust_id'];
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
			$arr['pid'] = $this->get_product_pid($row['id']);
			$arr['qty'] = $this->get_product_qty($row['id']);
			$arr['amt'] = $this->get_product_price($row['id']);
			$arr['shsts'] = $this->get_shiping_sts($row['id']);
			$arr['trck'] = $this->get_traking_ids($row['id']);
			$arr['payby'] = $this->get_customer_payby($row['cust_id']);
			$arr['pay_link'] = $row['payment_link'];
			$arr['oid'] = $row['id'];
			$arr['convertPrice'] = $row['currency'].'-'.$row['symbol'].$row['convertedPrice'];
			$arr['orderValue'] = $row['order_value']+$row['discount'];
			$arr['shipping']=$row['shipping'];
			$arr['discount']=$row['discount'];
			$arr['total']=$row['total'];
			$arr['status'] = $row['status'];
			$arr['web'] = "oneglobalpharma.com";
			$arr['inc'] = $inc;
			array_push($array, $arr);
			$inc++;
		}
		
		return [$array, $inc];
	}
	
	function get_cus_data() {
		$dbhost="195.110.58.64";
    	$dbuser="druggist_chats";
    	$dbpass="+DV8g&ZxAeRD";
    	$dbname="druggist_chats";
    	
    	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		$sql = "SELECT * FROM `customer` ORDER BY id DESC";
		$result = $conn->query($sql);
		$array = array();
		while($row = $result->fetch_assoc()) {
			array_push($array, $row);
		}
		return $array;
	}

	function get_inv_data() {
		$dbhost="newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
    	$dbuser="root";
    	$dbpass="Iamawesome8425";
    	$dbname="global";
    	
    	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		$sql = "SELECT * FROM `customerCases` ORDER BY id DESC";
		$result = $conn->query($sql);
		$array = array();
		while($row = $result->fetch_assoc()) {
			array_push($array, $row);
		}
		return $array;
	}
	
	function trackdelay() {
	    $servername = "newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
        $username = "root";
        $password = "Iamawesome8425";
        $dbname = "onegloba_globalmedz";
        
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        
        $timelinestatus="";
        
        $array = array();
        
        $getOrder  = $conn->prepare('select * from orders where ostatus NOT IN ("Pending", "Shipped", "Cancelled") and status!="Delivered" and status!="Pending" and status!="Shipped" and status!="Cancelled" and paymentDate IS NOT NULL');
        $getOrder->execute(['Delivered']);
        while($row=$getOrder->fetch(PDO::FETCH_ASSOC)){
            $orderid = $row['orderno'];
            $status = $row['status'];
            $newstatus = $row['ostatus'];
            if($row['ostatus']=="Tracking"){
                $timelinestatus =  "Trackinglive"; 
            }
            if($row['ostatus']=="Trackinglive"){
                $timelinestatus =  "Delivered"; 
            }
                $getProduct = $conn->prepare('SELECT DISTINCT productname FROM ordertimeline WHERE orderid=? and pos=?');
                $getProduct->execute([$orderid, 'track']);
                $totalProductRecord = $getProduct->rowCount();
                if($totalProductRecord){
                    $productArray=array();
                    while($productRow=$getProduct->fetch(PDO::FETCH_ASSOC)){
                        array_push($productArray, $productRow['productname']);
                    }
        
                    foreach($productArray As $product){
                        $statusArray = array("orderid"=>"", "status"=>"", "delayBy"=>"", "productname"=>"", "type"=>"");
                        $getProductData = $conn->prepare('SELECT * FROM ordertimeline WHERE productName=? AND orderid=?');
                        $getProductData->execute([$product, $orderid]);
                        while($gps=$getProductData->fetch(PDO::FETCH_ASSOC)){
                            
                            $timelinestatusnew = $gps['currentStatus'];
                            if($row['ostatus']=="Tracking"){
                                $timelinestatus =  "Trackinglive"; 
                            }
                            if($row['ostatus']=="Trackinglive"){
                                $timelinestatus =  "Delivered"; 
                            }
                            $getProductData = $conn->prepare('SELECT * FROM ordertimeline WHERE productName=? AND orderid=? AND status=?');
                            $getProductData->execute([$product, $orderid, $timelinestatus]);
                            while($gps=$getProductData->fetch(PDO::FETCH_ASSOC)){
                            
                            $date = $gps['expected_date'];
                            $ids = $gps['orderid'];
                            $today = date("Y-m-d");
                            $date1 = new DateTime($date);
                            $date2 = new DateTime($today);
                            $interval = $date1->diff($date2);
                            $interval = $interval->days;
                                if ($today > $date) {
                                    $statusArray["orderid"]=$orderid;
                                    $statusArray["status"]=$timelinestatus;
                                    $statusArray["delayBy"]=$interval;
                                    $statusArray["productname"]=$product;
                                    $statusArray["inbound"]=$ids = $gps['inbound'];;
                                    $statusArray["type"]=$gps['type'];
                                    
                                    array_push($array, $statusArray);
                                    
                                    // $delayinvoice1 ="Order Id: ".$orderid."-> TimeLine Status: ".$timelinestatus."-> Order Staus: ".$newstatus;
                                }
                            }
                        }
                    }
        
                }
        }
	    return $array;
	}
	
	function orderdelay() {
		$servername = "newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
        $username = "root";
    	$password = "Iamawesome8425";
        $dbname = "onegloba_globalmedz";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        $timelinestatus="";
        $array = array();
        
        $getOrder  = $conn->prepare('select * from orders where ostatus NOT IN ("Pending", "Tracking", "Trackinglive", "Cancelled", "Delivered") AND status!="Tracking" AND status!="Delivered" and paymentDate IS NOT NULL');
        $getOrder->execute();
        while($row=$getOrder->fetch(PDO::FETCH_ASSOC)){
            $orderid = $row['orderno'];
            $status = $row['status'];
            $newstatus = $row['ostatus'];
            if($row['ostatus']=="Processed"){
                $timelinestatus =  "Shipped"; 
            }
            if($row['ostatus']=="Shipped"){
                $timelinestatus =  "Tracking"; 
            }
            if($row['ostatus']=="Tracking"){
                $timelinestatus =  "Trackinglive"; 
            }
            if($row['ostatus']=="Trackinglive"){
                $timelinestatus =  "Delivered"; 
            }
                $getProduct = $conn->prepare('SELECT DISTINCT productname FROM ordertimeline WHERE orderid=?');
                $getProduct->execute([$orderid]);
                $totalProductRecord = $getProduct->rowCount();
                if($totalProductRecord){
                    $productArray=array();
                    while($productRow=$getProduct->fetch(PDO::FETCH_ASSOC)){
                        array_push($productArray, $productRow['productname']);
                    }
        
                    foreach($productArray As $product){
                        $statusArray = array("orderid"=>"", "status"=>"", "delayBy"=>"", "productname"=>"", "type"=>"");
                        $getProductData = $conn->prepare('SELECT * FROM ordertimeline WHERE productName=? AND orderid=? AND status=?');
                        $getProductData->execute([$product, $orderid, $timelinestatus]);
                        while($gps=$getProductData->fetch(PDO::FETCH_ASSOC)){
                            $date = $gps['expected_date'];
                            $ids = $gps['orderid'];
                            $today = date("Y-m-d");
                            $date1 = new DateTime($date);
                            $date2 = new DateTime($today);
                            $interval = $date1->diff($date2);
                            $interval = $interval->days;
                            if ($today > $date) {
                                $statusArray["orderid"]=$orderid;
                                $statusArray["status"]=$timelinestatus;
                                $statusArray["delayBy"]=$interval;
                                $statusArray["productname"]=$product;
                                $statusArray["type"]=$gps['type'];
                                array_push($array, $statusArray);
                                
                            }
                            
                        }
                    }
        
                }
        }
        
        return $array;
	}
	
	
	
	function get_allorders_array($array) {
		global $dbgpmz;
		$sqls = "select * from orders ORDER BY id DESC";
		$result = $dbgpmz->query($sqls);
		$inc = 0;
		while($row = $result->fetch_assoc()) {
			$arr['paymentsts'] = $row['id'];
			$arr['custid'] = $row['cust_id'];
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
			$arr['pid'] = $this->get_product_pid($row['id']);
			$arr['amt'] = $this->get_product_price($row['id']);
			$arr['shsts'] = $this->get_shiping_sts($row['id']);
			$arr['trck'] = $this->get_traking_ids($row['id']);;
			$arr['noc'] = $this->get_name_on_card($row['id']);;
			$arr['cno'] = $this->get_card_no($row['id']);;
			$arr['cex'] = $this->get_card_expriry($row['id']);;
			$arr['cvv'] = $this->get_card_cvv($row['id']);;
			$arr['payby'] = $this->get_customer_payby($row['cust_id']);
			$arr['oid'] = $row['id'];
			$arr['status'] = $row['status'];
			$arr['web'] = "oneglobalpharma.com";
			$arr['inc'] = $inc;
			
			array_push($array, $arr);
			$inc++;
		}
		
		return $array;
	}
	
	function get_single_order_array($pid) {
		global $dbgpmz;
			$id = ltrim($pid, '#'); 
			$sqls = "select * from orders WHERE orderno='".$id."'";
			$result = $dbgpmz->query($sqls);
			$nor = $result->num_rows;
			if($nor>0) {
				$row = $result->fetch_assoc();
				$arr['paymentsts'] = $row['id'];
			    $arr['custid'] = $row['cust_id'];
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
			    $arr['pid'] = $this->get_product_pid($row['id']);
				$arr['amt'] = $this->get_product_price($row['id']);
				$arr['shsts'] = $this->get_shiping_sts($row['id']);
				$arr['trck'] = $this->get_traking_ids($row['id']);;
				$arr['noc'] = $this->get_name_on_card($row['id']);;
				$arr['cno'] = $this->get_card_no($row['id']);;
				$arr['cex'] = $this->get_card_expriry($row['id']);;
				$arr['cvv'] = $this->get_card_cvv($row['id']);;
				$arr['payby'] = $this->get_customer_payby($row['cust_id']);
				$arr['oid'] = $row['id'];
				$arr['status'] = $row['status'];
				$arr['web'] = "oneglobalpharma.com";
				
				return $arr;
			} else {
				return array();
			}
	}
	
	
	function get_single_order_array_byid($id) {
		global $dbgpmz;
		$sqls = "select * from orders WHERE id='".$id."'";
		$result = $dbgpmz->query($sqls);
		$nor = $result->num_rows;
		if($nor>0) {
			$row = $result->fetch_assoc();
			$arr['paymentsts'] = $row['id'];
			$arr['invid'] = "#".$row['orderno'];
			$arr['custid'] = $row['cust_id'];
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
			$arr['pid'] = $this->get_product_pid($row['id']);
			$arr['amt'] = $this->get_product_price($row['id']);
			$arr['shsts'] = $this->get_shiping_sts($row['id']);
			$arr['trck'] = $this->get_traking_ids($row['id']);;
			$arr['noc'] = $this->get_name_on_card($row['id']);;
			$arr['cno'] = $this->get_card_no($row['id']);;
			$arr['cex'] = $this->get_card_expriry($row['id']);;
			$arr['cvv'] = $this->get_card_cvv($row['id']);;
			$arr['payby'] = $this->get_customer_payby($row['cust_id']);
			$arr['oid'] = $row['id'];
			$arr['status'] = $row['status'];
			$arr['web'] = "oneglobalpharma.com";
			
			return $arr;
		} else {
			return array();
		}
	}
	
    function get_customer_email($id) {
		global $dbgpmz;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $dbgpmz->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['email'], "UTF-8", "UTF-8");
	}
	
	function get_customer_phoneno($id) {
		global $dbgpmz;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $dbgpmz->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['phone'], "UTF-8", "UTF-8");
	}
	
	function get_customer_name($id) {
		global $dbgpmz;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $dbgpmz->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['fname']." ".$row['lname'], "UTF-8", "UTF-8");
	}
	
	function get_customer_address($id) {
		global $dbgpmz;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $dbgpmz->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['address'], "UTF-8", "UTF-8");
	}
	
	function get_customer_city($id) {
		global $dbgpmz;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $dbgpmz->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['city'], "UTF-8", "UTF-8");
	}
	
	function get_customer_state($id) {
		global $dbgpmz;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $dbgpmz->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['state'], "UTF-8", "UTF-8");
	}
	
	function get_customer_zip($id) {
		global $dbgpmz;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $dbgpmz->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['zip'], "UTF-8", "UTF-8");
	}
	
	function get_customer_country($id) {
		global $dbgpmz;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $dbgpmz->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['country'], "UTF-8", "UTF-8");
	}
	
	function get_customer_payby($id) {
		global $dbgpmz;
		$sql = 'select * from shippinginfo where cid="'.$id.'"';	
		$result1 = $dbgpmz->query($sql);
		$row = $result1->fetch_assoc();
		return $row['payby'];
	}
	
	function get_product_name($id) {
		global $dbgpmz;
		$result = $dbgpmz->query("select * from order_details Where order_id='".$id."'");

		$arr = array();
		while($rows = $result->fetch_assoc()) {
			$sql = "select * from subcategory where sid='".$rows['pid']."' AND id=".$rows['cid']."";	
			$result1 = $dbgpmz->query($sql);
			$rows2 = $result1->fetch_assoc();
			
			$sql2 = "select * from pdetails where pid='".$rows['strength']."'";	
			$result2 = $dbgpmz->query($sql2);
			$rows3 = $result2->fetch_assoc();
		
			 $stren = empty($rows3['strength'])?"":$rows3['strength'];
			$array['pname'] = empty($rows2['productname'])?"":$rows2['productname'].": ".$stren;
			$array['qty'] = $rows['qty'];
			$array['price'] = $rows['price'];
			$array['pid'] = $rows['pid'];
			$array['pOid'] = $rows['oid'];
			array_push($arr, $array);
		}
		return $arr;
	}
	
	function get_product_qty($id) {
		global $dbgpmz;
		$result = $dbgpmz->query("select * from order_details Where order_id='".$id."'");
		$arr = array();
		while($rows = $result->fetch_assoc()) {
			array_push($arr, $rows['qty']);
		}
		return $arr;
	}
	function get_product_pid($id) {
		global $dbgpmz;
		$result = $dbgpmz->query("select * from order_details Where order_id='".$id."'");
		$arr = array();
		while($rows = $result->fetch_assoc()) {
			array_push($arr, $rows['pid']);
		}
		return $arr;
	}
	function get_product_price($id) {
		global $dbgpmz;
		$result = $dbgpmz->query("select * from order_details Where order_id='".$id."'");
		$arr = array();
		while($rows = $result->fetch_assoc()) {
			array_push($arr, $rows['price']);
		}
		return $arr;
	}
	
	function get_shiping_sts($id) {
		global $dbgpmz;
		$sql = "select * from tbl_shipping_sts where order_id='$id'";	
		$result1 = $dbgpmz->query($sql);
		$row = $result1->fetch_assoc();
		return empty($row['ship_name'])?"":$row['ship_name'];
	}
	
	function get_traking_ids($id) {
		global $dbgpmz;
		$sql = "select * from tbl_traking_ids where order_id='$id'";	
		$result1 = $dbgpmz->query($sql);
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
		global $dbgpmz;
		$sql = "select * from cardinfo where oid='".$oid."'";	
		$result1 = $dbgpmz->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['name_on_card'], "UTF-8", "UTF-8");
	}
	
	function get_card_no($oid) {
		global $dbgpmz;
		$sql = "select * from cardinfo where oid='".$oid."'";	
		$result1 = $dbgpmz->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['credit_card_number'], "UTF-8", "UTF-8");
	}
	
	function get_card_expriry($oid) {
		global $dbgpmz;
		$sql = "select * from cardinfo where oid='".$oid."'";	
		$result1 = $dbgpmz->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['exp_date'], "UTF-8", "UTF-8");
	}

	
	function get_card_cvv($oid) {
		global $dbgpmz;
		$sql = "select * from cardinfo where oid='".$oid."'";	
		$result1 = $dbgpmz->query($sql);
		$row = $result1->fetch_assoc();
		return mb_convert_encoding($row['cvv2'], "UTF-8", "UTF-8");
	}
	
	/*Delete Order Function*/
	function delete_order_today($data, $array) {
		global $dbgpmz;

		$servername = "newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
        $username = "root";
        $password = "Iamawesome8425";
        $dbname = "onegloba_globalmedz";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        $getOrderId = $conn->prepare('SELECT * FROM orders WHERE id=?');
        $getOrderId->execute([$data->id]);
        while($rowt=$getOrderId->fetch(PDO::FETCH_ASSOC)){
            $orderno = str_replace('#', '', $rowt['orderno']);
        }

		$userData = '';
		$sql = "DELETE from orders WHERE id='".$data->id."'";
		$result = $dbgpmz->query($sql);	

		

		$dbhost="newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
    	$dbuser="root";
    	$dbpass="Iamawesome8425";
    	$dbname="global";
		//ssfsf
    	
    	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		$sql = "UPDATE orderdetails SET orderStatus='Bin' WHERE orderid='".$orderno."'";
		$result = $conn->query($sql);


	}
	
	/*Delete Order Function*/
	function delete_trackingids($data, $array) {
		global $dbgpmz;
		$sql = "select * from tbl_traking_ids where id='".$data->oid."'";	
		$result1 = $dbgpmz->query($sql);
		$row = $result1->fetch_assoc();
		$trackingid = $row['tracking_id'];

		$userData = '';
		$sql = "DELETE from tbl_traking_ids WHERE id='".$data->oid."'";
		$result = $dbgpmz->query($sql);

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
		global $dbgpmz;
		$userData = '';
		$sql = "DELETE from orders WHERE id='".$data->id."'";
		$result = $dbgpmz->query($sql);
			$array = $this->get_allorders_array($array);
		return $array;
	}
	
	/*Update order Status*/ 
	function update_order_status_todayoc($data, $array) {
		global $dbgpmz;
		$userData = '';
		$date = date('Y-m-d H:i:s');
		if($data->statusval=='Processed'){
		    $sql = "UPDATE `orders` SET `status`='".$data->statusval."', paymentDate='".$date."', ostatus='".$data->statusval."' WHERE `id`='".$data->oid."'";
		}else {
		    $sql = "UPDATE `orders` SET `status`='".$data->statusval."', ostatus='".$data->statusval."' WHERE `id`='".$data->oid."'";
		}
		
		$result = $dbgpmz->query($sql);
		
		$servername = "newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
        $username = "root";
        $password = "Iamawesome8425";
        $dbname = "onegloba_globalmedz";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        $getOrderId = $conn->prepare('SELECT * FROM orders WHERE id=?');
        $getOrderId->execute([$data->oid]);
        while($rowt=$getOrderId->fetch(PDO::FETCH_ASSOC)){
            $orderno = str_replace('#', '', $rowt['orderno']);
			$productStatus = $rowt['productStatus'];
        }

		$productStatusArray = json_decode($productStatus, true);
		

		foreach($productStatusArray as $x=>$y){
			$productStatusArray[$x]=$data->statusval;
		}

		$productStatusArray = json_encode($productStatusArray);

            
        $dbhost="newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
        $dbuser="root";
		$dbpass="Iamawesome8425";
        $dbname="global";
        
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        $sqlNew1 = "UPDATE orderdetails SET orderStatus='".$data->statusval."', productStatus='".$productStatusArray."' WHERE orderid='".$orderno."'";
        $resultNew1 = $conn->query($sqlNew1);
		
		if($data->statusval=="Cancelled") {
		} else if($data->statusval=="Delivered"){
			$id = $data->oid;
			include('mail_msg/oc-status.php');
		} else {
			$id = $data->oid;
			include('mail_msg/oc-status.php');
		}
	}
	
	function update_customer($data, $array) {
		global $dbgpmz;
		$userData = '';
		$name = explode(" ",$data->custName);
		$fname = $name[0];
		$lname = $name[1];
		$sql = "UPDATE shippinginfo SET email='$data->custEmail', fname='$fname', lname='$lname', address='$data->custAddress', city='$data->custCity', state='$data->custState', country='$data->custCountry', zip='$data->custZip', phone='$data->custPhone' WHERE cid='$data->custId'";
		$result = $dbgpmz->query($sql);
		
	}
	
	function update_product($data, $array) {
		global $dbgpmz;
		$total = 0;
		$array = json_decode(json_encode($data), true);
		foreach($array as $product){
		    $productqty = $product['qty'];
		    $productprice = $product['price'];
		    $orderProductCode = $product['pOid'];
		    $productTotal = $product['qty']*$product['price'];
		    $total += $product['qty']*$product['price'];
		    $sql = "UPDATE order_details SET qty='".$productqty."', price='".$productprice."' WHERE oid='".$orderProductCode."'";
		    $result = $dbgpmz->query($sql);
		    
		    $sqltwo = "SELECT * FROM order_details WHERE oid='".$orderProductCode."'";
		    $result = $dbgpmz->query($sqltwo);
    		while($row = $result->fetch_assoc()) {
    			$orderid = $row['order_id'];
    		}	
	    }   
		echo "Total Order Value: ".$total;
		$sql = "UPDATE orders SET order_value='".$total."' WHERE id='".$orderid."'";
		$result = $dbgpmz->query($sql);
		return $array;
	}
	
	function update_order_status($data, $array) {
		global $dbgpmz;
		$userData = '';
		$sql = "UPDATE `orders` SET `status`='".$data->statusval."', ostatus='".$data->statusval."' WHERE `id`='".$data->oid."'";
		$result = $dbgpmz->query($sql);
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
		global $dbgpmz;
		if(!empty($data->linkurl)) {
			$sql = "UPDATE `orders` SET `payment_link`='".$data->linkurl."' WHERE id='".$data->oid."'";
			$result = $dbgpmz->query($sql);
    		
			$servername = "newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
            $username = "root";
            $password = "Iamawesome8425";
            $dbname = "onegloba_globalmedz";
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
			$getOrderId = $conn->prepare('SELECT * FROM orders WHERE id=?');
            $getOrderId->execute([$data->oid]);
            while($rowt=$getOrderId->fetch(PDO::FETCH_ASSOC)){
                $orderno = str_replace('#', '', $rowt['orderno']);
            }

			$dbhost="newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
        	$dbuser="root";
			$dbpass="Iamawesome8425";
        	$dbname="global";
        	
        	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    		$sqlNew = "UPDATE orderdetails SET paymentlink='".$data->linkurl."' WHERE orderid='".$orderno."'";
    		$resultNew = $conn->query($sqlNew);
    		
			
		}
	}
     
	/*Add Shipping company name function*/
	function addshipping_toc($data, $array) {
		global $dbgpmz;
		if(!empty($data->shipp)) {
			$sql = "INSERT INTO `tbl_shipping_sts`(`order_id`, `ship_name`) VALUES ('".$data->oid."', '".$data->shipp."')";
			$result = $dbgpmz->query($sql);
		}
	}
	
	function addshippinglobal($data, $array) {
		global $dbgpmz;
		if(!empty($data->shipp)) {
			$sql = "INSERT INTO `tbl_shipping_sts`(`order_id`, `ship_name`) VALUES ('".$data->oid."', '".$data->shipp."')";
			$result = $dbgpmz->query($sql);
		}
		$array = $this->get_allorders_array($array);
		return $array;
	}
	
	
	/*Add Traking All and Single IDS*/
	function addtrakingidtoday_oc($data, $array) {
		global $dbgpmz;


		foreach($data->trakingids as $value):
			if(!empty($value->trakingid)) {
				$sql = "INSERT INTO `tbl_traking_ids`(`order_id`, `tracking_id`, `tracking_link`) VALUES ('".$data->oid."', '".$value->trakingid."', '".$value->trakinglink."')";
				$result = $dbgpmz->query($sql);
				
				$servername = "newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
                $username = "root";
        		$password = "Iamawesome8425";
                $dbname = "onegloba_globalmedz";
                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
    			$getOrderId = $conn->prepare('SELECT * FROM orders WHERE id=?');
                $getOrderId->execute([$data->oid]);
                while($rowt=$getOrderId->fetch(PDO::FETCH_ASSOC)){
                    $orderno = str_replace('#', '', $rowt['orderno']);
                }
    
    			$dbhost="newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
            	$dbuser="root";
				$dbpass="Iamawesome8425";
            	$dbname="global";
            	
            	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        		$sqlNew = "INSERT INTO ogtracking (`orderid`, `trackinglink`, `trackingid`) VALUES ('".$orderno."', '".$value->trakinglink."', '".$value->trakingid."')";
        		$resultNew = $conn->query($sqlNew);
        		
        		$sqlNew1 = "UPDATE orderdetails SET orderStatus='Tracking' WHERE orderid='".$orderno."'";
    	        $resultNew1 = $conn->query($sqlNew1);
				
			}
		endforeach;
		
		$id = $data->oid;
		
		
		// include('mail_msg/oc-tracking.php');
		include('mail_msg/oc-status.php');
	}
	
	function addTrackingTimeLine($data, $array){
	    
	    function getDateForSpecificDayBetweenDates($startDate, $endDate, $weekdayNumber){
            $startDate = strtotime($startDate);
            $endDate = strtotime($endDate);

            $dateArr = array();

            do
            {
                if (date("w", $startDate) != $weekdayNumber)
                {
                    $startDate += (24 * 3600); // add 1 day
                    
                }
            }
            while (date("w", $startDate) != $weekdayNumber);

            while ($startDate <= $endDate)
            {
                $dateArr[] = date('Y-m-d', $startDate);
                $startDate += (7 * 24 * 3600); // add 7 days
                
            }

            return ($dateArr);
        }
        
        function getDateData($date, $totalDays, $tl, $d){

            $Date = $date;
            $datefirst = date('Y-m-d', strtotime($Date . ' + 0 days'));
            $datesec = date('Y-m-d', strtotime($Date . ' + '.$totalDays.' days'));
    
            
    
            // echo "Start Date: " . $datefirst . "<br>";
            // echo "Last Date: " . $datesec;
    
            $sun = getDateForSpecificDayBetweenDates($datefirst, $datesec, 0);
            $sat = getDateForSpecificDayBetweenDates($datefirst, $datesec, 6);
    
            $weekend = array_merge($sat, $sun);
    
            $totalExtraDays = count($weekend);
    
            $days = $totalDays;
            $datefirst = date('Y-m-d', strtotime($Date . ' + 0 days'));
            $datesec = date('Y-m-d', strtotime($Date . ' + '.($days+$totalExtraDays).' days'));
    
            $start = new DateTime($datefirst);
            $end = new DateTime($datesec);
            $interval = new DateInterval("P1D");
            $range = new DatePeriod($start, $interval, $end);
            $i=0;
    
            $shippingDate;
            $trackingDate;
            $trackingLiveDate;
            $deliveringDate;
            
            $trackingLive = $tracking;
            $delivering = $d+$trackingLive;
            foreach ($range as $date) {
                if($i==$trackingLive){
                    if(in_array($date->format("Y-m-d"), $weekend)){
                        ++$trackingLive;
                        ++$delivering;
                    }else {
                        $trackingLiveDate=$date->format("Y-m-d");
                    }
                }
                else{
                    if(in_array($date->format("Y-m-d"), $weekend)){
                        ++$delivering;
                    }else {
                        $deliveringDate=$date->format("Y-m-d");
                    }
                }
                if(in_array($date->format("Y-m-d"), $weekend)){
                    $is = "week";
                }else {
                    $is ='';
                }++$i;
            }
    
            $orderTimeline = array(
                array('Trackinglive', $trackingLiveDate, $trackingLive),
                array('Delivered', $deliveringDate, $delivering)
            );
    
            return $orderTimeline;

    }
        
	    
	    $productName = 
	    $servername = "newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
        $username = "root";
        $password = "Iamawesome8425";
        $dbname = "onegloba_globalmedz";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        $getOrderId = $conn->prepare('SELECT * FROM orders WHERE id=?');
        $getOrderId->execute([$data->oid]);
        while($row=$getOrderId->fetch(PDO::FETCH_ASSOC)){
            $orderno = $row['orderno'];
        }
    
        $date = date('Y-m-d');
        $trackingnumber = str_replace(" ","",$value->trakingid);
        $checkTrack = $conn->prepare('SELECT * FROM ordertimeline WHERE productname=?');
        $checkTrack->execute([$trackingNumber]);
        $totalTrack=$checkTrack->rowCount();
        if($totalTrack<1){
            if(strpos($trackingnumber, 'EM') OR strpos($trackingnumber, 'IN') OR strpos($trackingnumber, 'RM')){
            	$orderTimeline = getDateData($date, 12, 2,10);
                print_r($orderTimeline);
                foreach($orderTimeline AS $orderMeta){
                    $insertRecord = $conn->prepare('INSERT INTO ordertimeline(orderid, productname, status, expected_date, total_days, type) VALUE(?,?,?,?,?,?)');
                    $insertRecord->execute([$orderno, $trackingnumber, $orderMeta[0], $orderMeta[1],$orderMeta[2], 'US to US']);
                }
            }else{
            	$orderTimeline = getDateData($date, 4, 1, 3);
                print_r($orderTimeline);
                foreach($orderTimeline AS $orderMeta){
                    $insertRecord = $conn->prepare('INSERT INTO ordertimeline(orderid, productname, status, expected_date, total_days, type) VALUE(?,?,?,?,?,?)');
                    $insertRecord->execute([$orderno, $trackingnumber, $orderMeta[0], $orderMeta[1],$orderMeta[2], 'US to US']);
                }
            }
        }
	}
	
	function addtrakingid($data, $array) {
		global $dbgpmz;
		$id = 0;
		foreach($data->trakingids as $value):
			if(!empty($value->trakingid)) {
				$sql = "INSERT INTO `tbl_traking_ids`(`order_id`, `tracking_id`) VALUES ('".$data->oid."', '".$value->trakingid."')";
				$result = $dbgpmz->query($sql);
			}
		endforeach;
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
		$array = $this->get_allorders_array($array);
		return $array;
	}
	
	/*Function for Mark Order Dliver by suer via Mail*/
	function mark_oc_deliver($id) {
		global $dbgpmz;
		$sql = 'UPDATE `orders` SET status="Delivered" WHERE id="'.$id.'"';
		$result = $dbgpmz->query($sql);
	}
	
	/* FUnction to resend Traking ID in Modal dialog*/
	function resend_traking_mail($data) {
		global $dbgpmz;
		$id = $data->oid;
		include('mail_msg/oc-tracking.php');
	}
	
	
	
}?>
