<?php 
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
    $delayinvoice = array();
    
    // $getOrder  = $conn->prepare('select * from orders where status!=? and ostatus!="Pending" and ostatus!="Cancelled" and paymentDate IS NOT NULL');
    // $getOrder->execute(['Delivered']);
    // while($row=$getOrder->fetch(PDO::FETCH_ASSOC)){
    //     echo $row['orderno']."<br>";  
    //     echo $row['ostatus']."<br>"; 
    //     if($row['ostatus']=="Processed"){
    //         $timelinestatus =  "Shipped"; 
    //     }
    //     if($row['ostatus']=="Shipped"){
    //         $timelinestatus =  "Tracking"; 
    //     }
    //     if($row['ostatus']=="Tracking"){
    //         $timelinestatus =  "Trackinglive"; 
    //     }
    //     if($row['ostatus']=="Trackinglive"){
    //         $timelinestatus =  "Delivered"; 
    //     }
    //     echo $timelinestatus;
    //     echo "<br><br>";
    // }
    
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
        if($newstatus!='Tracking' OR $newstatus!='Trackinglive'){
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
                            $statusArray["cstatus"]=$row['ostatus'];
                            $statusArray['tcstatus']=$newstatus;
                            array_push($delayinvoice, $statusArray);
                            
                            // $delayinvoice1 ="Order Id: ".$orderid."-> TimeLine Status: ".$timelinestatus."-> Order Staus: ".$newstatus;
                        }
                        
                    }
                }
    
            }
        }else{
            $getProduct = $conn->prepare('SELECT DISTINCT productname FROM ordertimeline WHERE orderid=?');
            $getProduct->execute([$orderid]);
            $totalProductRecord = $getProduct->rowCount();
            if($totalProductRecord){
                $productArray=array();
                while($productRow=$getProduct->fetch(PDO::FETCH_ASSOC)){
                    array_push($productArray, $productRow['productname']);
                }
    
                foreach($productArray As $product){
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
                            array_push($delayinvoice, $orderid."(".$interval.")");
                            // $delayinvoice1 ="Order Id: ".$orderid."-> TimeLine Status: ".$timelinestatus."-> Order Staus: ".$newstatus;
                        }
                    }
                }
    
            }
        }
    }
    echo "
        <style>
            .table {
                border-collapse: collapse;
            }
            .table, th, td {
                border: 1px solid #000;
            }
        </style>
        <table>
            <tr>
                <th>Order No</th>
                <th>Tracking Number</th>
                <th>Type</th>
                <th>Current Status</th>
                <th>Timeline Current Status</th>
                <th>Status</th>
            </tr>
    ";
    foreach($delayinvoice as $product){
        echo "
            <tr>
                <td>".$product['orderid']."</td>
                <td>".$product['productname']."</td>
                <td>".$product['type']."</td>
                <td>".$product['cstatus']."</td>
                <td>".$product['tcstatus']."</td>
                <td><b>".$product['status']."</b> is delayed by ".$product['delayBy']." days.</td>
            </tr>
        ";
    }
    echo "
        </table>
    ";
    