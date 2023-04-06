<?php
error_reporting(0);
require_once "include/database.php";
require_once("include/class.phpmailer.php");
require_once("include/class.php");
require 'vendor/autoload.php';
// include('mail-structure.php');
$userid = $_COOKIE["userID"];

session_start();
$seesion_login = $_SESSION["IS_LOGIN"];

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
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

    $user_ip = $ipaddress;
    $people_json = file_get_contents('https://ipinfo.io/?token=26abe7355b303f');
    $decoded_json = json_decode($people_json, false);
    $listaddress = '';

?>

<?php
include('env.php');
require_once "include/database.php";
require_once ("include/class.phpmailer.php");
require_once ("include/class.php");
require 'vendor/autoload.php';
error_reporting(1);
// require_once("email.php");
// include('mail-structure.php');
$userid = $_COOKIE["userID"];
$selectCartProduct = $conn->prepare("SELECT * FROM ogcart WHERE userId= '$userid' && wishlist=0");
$selectCartProduct->execute();
$gprice = 0;
$sprice = 0;
$uprice = 0;
$sshipping = 0;
$ushipping = 0;

while ($row = $selectCartProduct->fetch(PDO::FETCH_ASSOC))
{
    $productCode = $row['productCode'];
    $strengthCode = $row['strengthCode'];
    $quantityCode = $row['quantityCode'];
    $quantity = $row['quantity'];
    $quantityPrice = $row['quantityPrice'];
    $totalQuantity = $row['totalQuantity'];
    $totalPrice = $row['totalPrice'];
    $total = $row['total'];
    $select_product_details = $conn->prepare("SELECT * FROM ogproduct WHERE productCode='$productCode'");
    $select_product_details->execute();
    while ($product = $select_product_details->fetch(PDO::FETCH_ASSOC))
    {
        $productName = $product['productName'];
        $productImage = $product['productImage'];
        $productCategory = $product['productCategory'];
        $productType = $product['productType'];
    }
    if (strpos($productCategory, 'Steroids') > 0)
    {
        $sprice += $total;
    }
    elseif (strpos($productName, 'USA to USA') > 0 or strpos($productName, 'US to US') > 0)
    {
        $uprice += $total;
    }
    else
    {
        $gprice += $total;
    }
}
session_start();
if ($_POST['btn'] == "orderNow")
{
    $orderId = "INV-" . date("ymdhis");
    $timestamp = date("Y-m-d H:i:s");
    $oldcrmtimestamp = date("d/m/Y");
    $fname = test_input($_POST['first-name']);
    $lname = test_input($_POST['last-name']);
    $email = test_input($_POST['email']);
    $phone = str_replace(" ","",test_input($_POST['phone']));
    $addressline1 = test_input($_POST['addressLine1']);
    $addressline2 = test_input($_POST['addressLine2']);
    $country = test_input($_POST['country']);
    $state = test_input($_POST['state']);
    $city = test_input($_POST['city']);
    $postalCode = test_input($_POST['postalCode']);
    $addressId = test_input($_POST['addressId']);
    if ($addressId < 1)
    {
        if (!empty($fname))
        {
            if (!empty($lname))
            {
                if (!empty($email))
                {
                    if (!empty($phone))
                    {
                        $phone = test_input($_POST['codepin']) . "-" . $phone;
                        if (!empty($addressline1))
                        {
                            if (!empty($country))
                            {
                                if (!empty($state))
                                {
                                    if (!empty($city))
                                    {
                                        if (!empty($postalCode))
                                        {
                                            $servername = "newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
                                            $username = "root";
                                            $password = "Iamawesome8425";
                                            $dbname = "onegloba_globalmedz";

                                            // Create connection
                                            $oldCrmConn = new mysqli($servername, $username, $password, $dbname);
                                            // Check connection
                                            if ($oldCrmConn->connect_error)
                                            {
                                                die("Connection failed: " . $conn->connect_error);
                                            }
                                            else
                                            {
                                            }
                                            $updateCusomer = $conn->prepare("UPDATE ogcustomer SET fname=?, lname=?, email=?, phone=?, cookieUser=? WHERE userid=?");
                                            $updateCusomer->execute([$fname, $lname, $email, $phone, 'No', $userid]);
                                            if ($updateCusomer)
                                            {

                                                $select_country = $conn->prepare("SELECT * FROM countries WHERE country_id = '$country'");
                                                $select_country->execute();
                                                while ($row = $select_country->fetch(PDO::FETCH_ASSOC))
                                                {
                                                    $countryName = $row['country_name'];
                                                }

                                                $select_state = $conn->prepare("SELECT * FROM states WHERE state_id = '$state'");
                                                $select_state->execute();
                                                while ($row = $select_state->fetch(PDO::FETCH_ASSOC))
                                                {
                                                    $stateName = $row['state_name'];
                                                }

                                                $select_city = $conn->prepare("SELECT * FROM cities WHERE city_id = '$city'");
                                                $select_city->execute();
                                                while ($row = $select_city->fetch(PDO::FETCH_ASSOC))
                                                {
                                                    $cityName = $row['city_name'];
                                                }

                                                $updateAddress = $conn->prepare("UPDATE ogaddress SET defaultAdd='0' WHERE userid=?");
                                                $updateAddress->execute([$userid]);

                                                $insertAddress = $conn->prepare("INSERT into ogaddress(userid, fname, lname, email, phone, addressline1, addressline2, city, country, state, postalcode,defaultAdd) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");

                                                $insertAddress->execute([$userid, $fname, $lname, $email, $phone, $addressline1, $addressline2, $cityName, $countryName, $stateName, $postalCode, '1']);

                                                $selectAddressId = $conn->prepare("SELECT id FROM ogaddress WHERE userid=? order by id DESC limit 1");
                                                $selectAddressId->execute([$userid]);
                                                while ($addressIDs = $selectAddressId->fetch(PDO::FETCH_ASSOC))
                                                {
                                                    $lastAddId = $addressIDs['id'];
                                                }
                                                // echo $lastAddId;
                                                if ($insertAddress)
                                                {
                                                    $selectCartProduct = $conn->prepare("SELECT * FROM ogcart WHERE userId= '$userid' && wishlist=0");
                                                    $selectCartProduct->execute();
                                                    while ($row = $selectCartProduct->fetch(PDO::FETCH_ASSOC))
                                                    {
                                                        $productCode = $row['productCode'];
                                                        $strengthCode = $row['strengthCode'];
                                                        $quantityCode = $row['quantityCode'];
                                                        $quantity = $row['quantity'];
                                                        $quantityPrice = $row['quantityPrice'];
                                                        $totalQuantity = $row['totalQuantity'];
                                                        $totalPrice = $row['totalPrice'];
                                                        $total = $row['total'];
                                                        $saveAmountCart = $row['saveAmount'];
                                                        $discountCart = $row['discount'];
                                                        $total2 = $row['total'];
                                                        $select_product_details = $conn->prepare("SELECT * FROM ogproduct WHERE productCode='$productCode'");
                                                        $select_product_details->execute();
                                                        while ($product = $select_product_details->fetch(PDO::FETCH_ASSOC))
                                                        {
                                                            $productName = $product['productName'];
                                                            $productImage = $product['productImage'];
                                                            $productCategory = $product['productCategory'];
                                                            $productType = $product['productType'];
                                                        }
                                                        $selectStrengthName = $conn->prepare("SELECT * FROM ogstrength WHERE strengthCode= '$strengthCode'");
                                                        $selectStrengthName->execute();
                                                        while ($row = $selectStrengthName->fetch(PDO::FETCH_ASSOC))
                                                        {
                                                            $strengthName = $row['strengthName'];
                                                        }

                                                        if (strpos($productCategory, 'Steroids') > 0)
                                                        {
                                                            $sprice += $total;
                                                        }
                                                        elseif (strpos($productName, 'USA to USA') > 0 or strpos($productName, 'US to US') > 0)
                                                        {
                                                            $uprice += $total;
                                                        }
                                                        else
                                                        {
                                                            $gprice += $total;
                                                        }

                                                        $insertProduct = $conn->prepare("INSERT into ogorderproduct(productName, productCategory, strength, orderid, productCode, quantityCode, strengthCode, quantity, quantityPrice, totalQuantity, totalPrice, total, discount, saveAmount, userId)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                                                        $insertProduct->execute([$productName, $productCategory, $strengthName, $orderId, $productCode, $quantityCode, $strengthCode, $quantity, $quantityPrice, $totalQuantity, $totalPrice, $totalPrice * $totalQuantity, $discountCart, $saveAmountCart, $userid]);

                                                    }
                                                    $getCustId = "SELECT * FROM shippinginfo ORDER BY sid DESC limit 1";
                                                    $lastCustId = $oldCrmConn->query($getCustId);
                                                    while ($custidrow = $lastCustId->fetch_assoc())
                                                    {
                                                        $custid = $custidrow['cid'];
                                                        $custid++;
                                                    }

                                                    $insertToOldCrm = "INSERT INTO shippinginfo(cid,email,fname, lname, address, city, state, country, zip, phone, payby) VALUES($custid, '$email', '$fname', '$lname', '$addressline1', '$cityName', '$stateName', '$countryName', '$postalCode', '$phone', 'Pay by credit or debit card')";
                                                    if ($oldCrmConn->query($insertToOldCrm) === true)
                                                    {
                                                        $allProductPrice = $conn->prepare("SELECT SUM(total) AS totalPrice FROM ogcart WHERE userID='$userid' && wishlist=0");
                                                        $allProductPrice->execute();
                                                        while ($priceTotal = $allProductPrice->fetch(PDO::FETCH_ASSOC))
                                                        {
                                                            $totalCartPrice = $priceTotal['totalPrice'];
                                                            $select_user_coupan = $conn->prepare("SELECT coupon FROM ogcustomer WHERE userid='$userid'");
                                                            $select_user_coupan->execute();
                                                            while ($coupan = $select_user_coupan->fetch(PDO::FETCH_ASSOC))
                                                            {
                                                                $coupon = $coupan['coupon'];
                                                            }
                                                            if ($coupon == "")
                                                            {
                                                                $amtDiscount = 0;
                                                            }
                                                            else
                                                            {
                                                                $selectCouponData = $conn->prepare("SELECT * FROM coupons WHERE code='$coupon'");
                                                                $selectCouponData->execute();
                                                                while ($coupanData = $selectCouponData->fetch(PDO::FETCH_ASSOC))
                                                                {
                                                                    $discount = $coupanData['discount'];
                                                                    $orderAmount = $coupanData['orderAmount'];
                                                                    $code = $coupanData['code'];
                                                                    $maxAmount = $coupanData['maxAmount'];
                                                                    $amtDiscount = $totalCartPrice * ($discount / 100);
                                                                    $disType = $coupanData['isTypePercentage'];
                                                                    if ($disType == 1)
                                                                    {
                                                                        $amtDiscount = $totalCartPrice * ($discount / 100);
                                                                        if ($amtDiscount > $maxAmount)
                                                                        {
                                                                            $amtDiscount = $maxAmount;
                                                                        }
                                                                    }
                                                                    else
                                                                    {
                                                                        if ($amtDiscount > $maxAmount)
                                                                        {
                                                                            $amtDiscount = $maxAmount;
                                                                        }else {
                                                                        $amtDiscount = $discount;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            
                                                            
                                                        }
                                                        $insertorders = "INSERT INTO orders(cust_id, orderno, orderdate, payment_mode, order_value, shipping, total, user_ip, payment_link, status) 
                                                                VALUES($custid, '$orderId', '$oldcrmtimestamp', 'Credit Card', '$totalCartPrice', '$shipping', '$total', ' ', ' ', 'Pending')";
                                                        if ($oldCrmConn->query($insertorders))
                                                        {
                                                            $lastid = $oldCrmConn->insert_id;
                                                            $insertToOldCrm = "INSERT INTO tbtcustomer(cid,fname, lname, email, mobile, password) VALUES($custid, '$fname', '$lname', '$email', '$phone', ' ')";
                                                            if ($oldCrmConn->query($insertToOldCrm) === true)
                                                            {

                                                            }
                                                            else
                                                            {
                                                                echo "Error: " . $insertToOldCrm . "<br>" . $oldCrmConn->error;
                                                            }

                                                            $selectCartProduct = $conn->prepare("SELECT * FROM ogcart WHERE userId= '$userid' && wishlist=0");
                                                            $selectCartProduct->execute();
                                                            while ($row = $selectCartProduct->fetch(PDO::FETCH_ASSOC))
                                                            {
                                                                $productCode = $row['productCode'];
                                                                $strengthCode = $row['strengthCode'];
                                                                $quantityCode = $row['quantityCode'];
                                                                $quantity = $row['quantity'];
                                                                $quantityPrice = $row['quantityPrice'];
                                                                $totalQuantity = $row['totalQuantity'];
                                                                $totalPrice = $row['totalPrice'];
                                                                $total = $row['total'];

                                                                $selectProductName = $conn->prepare("SELECT * FROM ogproduct WHERE productCode= '$productCode'");
                                                                $selectProductName->execute();
                                                                while ($row = $selectProductName->fetch(PDO::FETCH_ASSOC))
                                                                {
                                                                    $productName = $row['productName'];
                                                                    $productCategory = $row['prorductCategory'];
                                                                }
                                                                $selectStrengthName = $conn->prepare("SELECT * FROM ogstrength WHERE strengthCode= '$strengthCode'");
                                                                $selectStrengthName->execute();
                                                                while ($row = $selectStrengthName->fetch(PDO::FETCH_ASSOC))
                                                                {
                                                                    $strengthName = $row['strengthName'];
                                                                }
                                                                $selectQuantity = $conn->prepare("SELECT * FROM ogquantity WHERE quantityCode= '$quantityCode'");
                                                                $selectQuantity->execute();
                                                                while ($row = $selectQuantity->fetch(PDO::FETCH_ASSOC))
                                                                {
                                                                    $quantityName = $row['quantity'];
                                                                }

                                                                $insertCategory = "INSERT INTO `category` (`title`, `image_src`, `status`) VALUES ('$productCategory', 'sfsf', '1');";
                                                                if ($oldCrmConn->query($insertCategory))
                                                                {
                                                                    $newcategoryid = $oldCrmConn->insert_id;
                                                                }

                                                                $insertProduct = "INSERT INTO `subcategory`(`id`, `productname`, `image`, `price`, `packageSize`, `description`, `status`) VALUES ('$newcategoryid', '$productName', 'sdsd', 5, 'ff', 'ff', '3')";
                                                                if ($oldCrmConn->query($insertProduct))
                                                                {
                                                                    $newproductsid = $oldCrmConn->insert_id;
                                                                }

                                                                $insertStrength = "INSERT INTO `pdetails`(`cid`, `product_id`, `strength`, `packaging_method`) VALUES ('$newcategoryid', '$newproductsid','$strengthName', 'pill')";
                                                                if ($oldCrmConn->query($insertStrength))
                                                                {
                                                                    $newstrengthid = $oldCrmConn->insert_id;
                                                                }

                                                                $insertToOldCrm = "INSERT INTO order_details(order_id, cid, pid, strength, qty, price) VALUES($lastid, $newcategoryid, $newproductsid, $newstrengthid, $quantity*$totalQuantity, $quantityPrice)";
                                                                if ($oldCrmConn->query($insertToOldCrm) === true)
                                                                {

                                                                }
                                                                else
                                                                {
                                                                    echo "Error: " . $insertToOldCrm . "<br>" . $oldCrmConn->error;
                                                                }

                                                                $newStrength = $productName . " " . $strengthName;
                                                                $getOldData = "SELECT * FROM pdetails WHERE strength LIKE '%$newStrength%'";
                                                                $oldProductResult = $oldCrmConn->query($getOldData);
                                                                while ($productRow = $oldProductResult->fetch_assoc())
                                                                {
                                                                    $strengthid = $productRow['pid'];
                                                                }

                                                                $getOldData1 = "SELECT * FROM tblproductdetails WHERE strength='$strengthid' and qty='$quantityName' limit 1";
                                                                $oldProductResult = $oldCrmConn->query($getOldData1);
                                                                while ($productRow1 = $oldProductResult->fetch_assoc())
                                                                {
                                                                    $catids = $productRow1['cid'];
                                                                    $productids = $productRow1['pid'];
                                                                    $strengthids = $productRow1['strength'];
                                                                    $insertToOldCrm = "INSERT INTO order_details(order_id, cid, pid, strength, qty, price) VALUES($lastid, $cat, $productids, $strengthids, $quantity*$totalQuantity, $quantityPrice)";

                                                                }

                                                            }

                                                        }
                                                        else
                                                        {
                                                            echo "Error: " . $insertorders . "<br>" . $oldCrmConn->error;
                                                        }
                                                    }
                                                    else
                                                    {
                                                        echo "Error: " . $insertToOldCrm . "<br>" . $oldCrmConn->error;
                                                    }

                                                }
                                                else
                                                {
                                                    echo "Not Insert Address";
                                                }
                                                if ($insertProduct)
                                                {
                                                    $allProductPrice = $conn->prepare("SELECT SUM(total) AS totalPrice FROM ogcart WHERE userID='$userid' && wishlist=0");
                                                    $allProductPrice->execute();
                                                    while ($priceTotal = $allProductPrice->fetch(PDO::FETCH_ASSOC))
                                                    {
                                                        $totalCartPrice = $priceTotal['totalPrice'];
                                                        $select_user_coupan = $conn->prepare("SELECT coupon FROM ogcustomer WHERE userid='$userid'");
                                                        $select_user_coupan->execute();
                                                        while ($coupan = $select_user_coupan->fetch(PDO::FETCH_ASSOC))
                                                        {
                                                            $coupon = $coupan['coupon'];
                                                        }
                                                        if ($coupon == "")
                                                        {
                                                            $amtDiscount = 0;
                                                        }
                                                        else
                                                        {
                                                            $selectCouponData = $conn->prepare("SELECT * FROM coupons WHERE code='$coupon'");
                                                            $selectCouponData->execute();
                                                            while ($coupanData = $selectCouponData->fetch(PDO::FETCH_ASSOC))
                                                            {
                                                                $discount = $coupanData['discount'];
                                                                $orderAmount = $coupanData['orderAmount'];
                                                                $code = $coupanData['code'];
                                                                $maxAmount = $coupanData['maxAmount'];
                                                                $disType = $coupanData['isTypePercentage'];
                                                                if ($disType == 1)
                                                                {
                                                                    $amtDiscount = $totalCartPrice * ($discount / 100);
                                                                    if ($amtDiscount > $maxAmount)
                                                                    {
                                                                        $amtDiscount = $maxAmount;
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    $amtDiscount = $discount;
                                                                }
                                                            }
                                                        }

                                                        if ($sprice >0)
                                                        {

                                                            if($quantity>0 && $quantity<=5){
                                                                $sshipping = 20;
                                                            }else{
                                                                $sshipping = 40;
                                                            }
                                                        }
                                                        // elseif ($sprice >= 56 && $sprice < 250)
                                                        // {
                                                        //     $sshipping = 25;
                                                        // }
                                                        // elseif ($sprice >= 250)
                                                        // {
                                                        //     $sshipping = 0;
                                                        // }



                                                        if ($gprice > 0 && $gprice <= 55)
                                                        {
                                                            $gshipping = 35;
                                                        }
                                                        elseif ($gprice >= 56 && $gprice < 250)
                                                        {
                                                            $gshipping = 25;
                                                        }
                                                        elseif ($gprice >= 250)
                                                        {
                                                            $gshipping = 0;
                                                        }

                                                        if ($uprice > 0 && $uprice <= 55)
                                                        {
                                                            $ushipping = 0;
                                                        }
                                                        elseif ($uprice >= 56 && $uprice < 250)
                                                        {
                                                            $ushipping = 0;
                                                        }
                                                        elseif ($uprice >= 250)
                                                        {
                                                            $ushipping = 0;
                                                        }

                                                        $shipping = $sshipping + $gshipping + $ushipping;
                                                        $total = $totalCartPrice - $amtDiscount;
                                                        $total = $total + $shipping;
                                                    }

                                                    $updateOrderOld = "UPDATE orders SET order_value='$totalCartPrice', shipping='$shipping', discount='$amtDiscount', total='$total' WHERE id='$lastid'";
                                                    $oldCrmConn->query($updateOrderOld);
                                                    echo $updateOrderOld;
                                                    $insertOrderDetails = $conn->prepare("INSERT INTO orderdetails(orderid, userid, subtotal, dcharge, discount, total, paymentMethod, paidAmount, paymentStatus, orderStatus, orderDate, addressId, coupon,fname, lname, email, phone, addressline1, addressline2, city, country, state, postalcode) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                                                    $insertOrderDetails->execute([$orderId, $userid, $totalCartPrice, $shipping, $amtDiscount, $total, NULL, '0', 'Unpaid', 'Pending', $timestamp, $lastAddId, $code, $fname, $lname, $email, $phone, $addressline1, $addressline2, $cityName, $countryName, $stateName, $postalCode, ]);
                                                    if ($insertOrderDetails)
                                                    {
                                                        $deleteFromCart = $conn->prepare("DELETE FROM ogcart WHERE userId && wishlist=0");
                                                        $deleteFromCart->execute([$userid]);
                                                        $updateCoupon = $conn->prepare("UPDATE ogcustomer SET coupon=NULL WHERE userid=?");
                                                        $updateCoupon->execute([$userid]);
                                                        echo json_encode(array(
                                                            "invid" => $orderId
                                                        ));
                                                        // $_SESSION['userLogin'] = "True";
                                                        // $_SESSION['userid']=$userid;
                                                        // $sentMail = new MailSmsOtp();
                                                        // $sentMail->mail($email, 'Thank You For Order.', $msg);
                                                        
                                                    }
                                                    else
                                                    {
                                                        echo "Fail";
                                                    }
                                                }
                                                else
                                                {
                                                }
                                            }
                                            else
                                            {
                                                echo "Not Inserted";
                                            }
                                        }
                                        else
                                        {
                                            echo "Postal Code Empty";
                                        }
                                    }
                                    else
                                    {
                                        echo "city empty";
                                    }
                                }
                                else
                                {
                                    echo "state empty";
                                }
                            }
                            else
                            {
                                echo "country empty";
                            }
                        }
                        else
                        {
                            echo "Address empty";
                        }
                    }
                    else
                    {
                        echo "phone empty";
                    }
                }
                else
                {
                    echo "email empty";
                }
            }
            else
            {
                echo "lname empty";
            }
        }
        else
        {
            echo "fname empty";
        }
    }
}
if (strlen($addressId) > 0)
{
    $orderId = "INV-" . date("ymdhis");
    $selectUserID = $conn->prepare("SELECT * FROM ogaddress WHERE id = ?");
    $selectUserID->execute([$addressId]);
    while ($addressROW = $selectUserID->fetch(PDO::FETCH_ASSOC))
    {
        $addressUserId = $addressROW['userid'];
        $email = $addressROW['email'];
        $fname = $addressROW['fname'];
        $lname = $addressROW['lname'];
        $phone = str_replace(" ","",$addressROW['phone']);
    }
    $selectExistUser1 = $conn->prepare("SELECT * FROM ogcustomer WHERE userid = ?");
    $selectExistUser1->execute([$addressUserId]);
    while ($row1= $selectExistUser1->fetch(PDO::FETCH_ASSOC))
    {
            $coupon = $row1['coupon'];
    }

    $selectExistUser = $conn->prepare("SELECT * FROM ogcustomer WHERE email = ?");
    $selectExistUser->execute([$email]);
    $isCustomer = $selectExistUser->rowCount();
    if ($isCustomer > 0)
    {
        while ($row = $selectExistUser->fetch(PDO::FETCH_ASSOC))
        {
            $existuserid = $row['userid'];
        }
        // $updateExistAddress->$conn->prepare("UPDATE ogaddress SET defaultAdd=? WHERE userid=?");
        // $updateExistAddress->execute([0,$existuserid]);
        // $updateExistAddress->$conn->prepare("UPDATE ogaddress SET defaultAdd=?, userid=? WHERE id=?");
        // $updateExistAddress->execute([1,$existuserid,$addressId]);
        

        $updateAddress = $conn->prepare("UPDATE ogaddress SET defaultAdd='0' WHERE userid=?");
        $updateAddress->execute([$existuserid]);

        $setDefualt = $conn->prepare("UPDATE ogaddress SET defaultAdd='1', userid=? WHERE id=?");
        $setDefualt->execute([$existuserid, $addressId]);

    }
    else
    {
        $selectUserID = $conn->prepare("SELECT * FROM ogaddress WHERE id = ?");
        $selectUserID->execute(['$addressId']);
        while ($addressROW = $selectUserID->fetch(PDO::FETCH_ASSOC))
        {
            $addressUserId = $addressROW['userid'];
            $email = $addressROW['email'];
            $fname = $addressROW['fname'];
            $lname = $addressROW['lname'];
            $phone = str_replace(" ","",$addressROW['phone']);
            $couponAg = $addressROW['coupon'];
        }
        $deleteCustomer = $conn->prepare("DELETE FROM ogcustomer WHERE userid=?");
        $deleteCustomer->execute([$addressUserId]);
        $insertNewCustomer = $conn->prepare("INSERT into ogcustomer(userid, fname, lname, email, phone, coupon) value(?,?,?,?,?,?)");
        $insertNewCustomer->execute([$addressUserId, $fname, $lname, $email, $phone, $couponAg]);
    }

    $selectUserIDAgain = $conn->prepare("SELECT * FROM ogaddress WHERE id = ?");
    $selectUserIDAgain->execute([$addressId]);
    while ($addressROWAgain = $selectUserIDAgain->fetch(PDO::FETCH_ASSOC))
    {
        $useridnew = $addressROWAgain['userid'];
        if (!isset($_SESSION['IS_LOGIN']))
        {
            $deleteFromCart = $conn->prepare("DELETE FROM ogcart WHERE userId=?");
            $deleteFromCart->execute([$existuserid]);
        }

        $updateOgCart = $conn->prepare('UPDATE ogcart SET userId=? WHERE userId=?');
        $updateOgCart->execute([$useridnew, $userid]);
        
        
        $userid = $addressROWAgain['userid'];
        
        $updateCoup = $conn->prepare('UPDATE ogcustomer SET coupon=? WHERE userId=?');
        $updateCoup->execute([$coupon, $userid]);

    }

    if (!isset($_SESSION['USER_ID']))
    {
        $bytes = random_bytes(36);
        $unicode = bin2hex($bytes);
        $updateUniCode = $conn->prepare("UPDATE ogcustomer SET uniqueloginid=? WHERE userid=?");
        $updateUniCode->execute([$unicode, $userid]);

        $msg1 = '
                                                    <table style="max-width:670px; width: 100%; margin:0 auto;background-color:#fff;border-radius:3px;">
                                                        <tbody>
                                                          <tr>
                                                            <td>
                                                                <div style="padding: 48px 0;text-align: center;width: 100%; background: #7287ff;">
                                                                    <img src="images/mail/celebrate.gif" style=" width: 104px; ">
                                                                    <h4 style=" margin: 0 !important; font-family: Lato,Arial,Helvetica,sans-serif; font-size: 16px; font-weight: 900; color: #ffffff; ">CONGRETULATION!!</h4>
                                                                    <h2 style="color: #fff;font-weight: 900;font-family:Lato,Arial,Helvetica,sans-serif;font-size: 35px;margin: 0;margin-bottom: 4px;">Account Created</h2>
                                                                </div>
                                                                <div style=" padding: 14px 12px; text-align: center; border-left: 1px solid #f0efef; border-right: 1px solid #f0efef; border-bottom: 1px solid #f0efef;">
                                                                    <h2 style="color: #000;font-weight: 400;font-family:Lato,Arial,Helvetica,sans-serif;font-size: 15px;margin: 0;margin-bottom: 4px;">
                                                                        Congratulations! Your account has been successfully created. Just follow
                                                                        this link below to access your account and you will be able to track your orders
                                                                    </h2>
                                                                    <a href="https://'.$INFO_WEBSITE_NAME .'\/directlogin/' . $unicode . '" style=" font-size: 20px; font-family: Lato,Arial,Helvetica,sans-serif; font-weight: 600; text-decoration: none; background: #7287ff; color: #fff; padding: 10px 18px 12px 18px; display: block; width: 76%; margin: 24px auto 0 auto; border-radius: 3px; text-align: center; box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 13%); ">Access Account</a>
                                                                    <p style=" font-family: Lato,Arial,Helvetica,sans-serif; font-weight: 800; ">OR</p> 
                                                                    <a href="https://'.$INFO_WEBSITE_NAME .'\/directlogin/' . $unicode . '" style=" color: #7287ff; text-decoration: none; font-weight: 500; font-size: 17px; ">directlogin/' . $unicode . '</a>
                                                                    <p style=" font-family: Lato,Arial,Helvetica,sans-serif; ">Get in touch if you have any questions regarding our new product.</p>
                                                                    <p style=" font-family: Lato,Arial,Helvetica,sans-serif; font-size: 14px; font-weight: 500; ">Feel free to contact us 24/7. We are here to help.</p> 
                                                                    <p style=" font-family: Lato,Arial,Helvetica,sans-serif; font-size: 14px; font-weight: 500; ">All the best</p> 
                                                                    <p style=" font-family: Lato,Arial,Helvetica,sans-serif; font-size: 14px; font-weight: 700; color: #000000; ">Team Newlands Pharmacy</p
                                                                </div>
                                                                
                                                            </td>
                                                          </tr>
                                                        </tbody>
                                                    </table>
                                                ';
        
	
                

	    // $emails = new \SendGrid\Mail\Mail();
        // $emails->setFrom("no-reply@Newlands Pharmacy.com", "Newlands Pharmacy");
        // $emails->setSubject("Direct Access For Newlands Pharmacy");
        // $emails->addTo($email, $fname . ' ' . $lname);
        // $emails->addContent("text/html", $msg1);
        // $apiKey = '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';
        // $sendgrid = new \SendGrid($apiKey);
        // try
        // {
        //     $response = $sendgrid->send($emails);
        //     // print $response->statusCode() . "\n";
        //     // print_r($response->headers());
        //     // print $response->body() . "\n";
            
        // }
        // catch(Exception $e)
        // {
        //     echo "<pre>";
        //     echo 'Caught exception: ' . $e->getMessage() . "\n";
        // }

        $mailjetApiKey = 'a6e20f63603953cd9ca2349265d2304b';
        $mailjetApiSecret = '4a228283087d8e09a63a01a990576bc3';
        $messageData = [
                'Messages' => [
                        [
                                'From' => [
                                        'Email' => 'orderonline@'.$INFO_WEBSITE_NAME ,
                                        'Name' => 'Newlands Pharmacy Order'
                                ],
                                'To' => [
                                        [
                                                'Email' => $email,
                                                'Name' => $fname . ' ' . $lname
                                        ]
                                ],
                                'Bcc' => [
                                    [
                                            'Email' => 'tradeonlinepharma@gmail.com',
                                            'Name' => 'Trade Online'
                                    ]
                                ],
                                'Subject' => 'Direct Access For Newlands Pharmacy',
                                'TextPart' => '',
                                'HTMLPart' => $msg1
                        ]
                ]
        ];
        $jsonData = json_encode($messageData);
        $ch = curl_init('https://api.mailjet.com/v3.1/send');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_USERPWD, "{$mailjetApiKey}:{$mailjetApiSecret}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsonData)
        ]);
        $response = json_decode(curl_exec($ch));

    }

    // $updateAddress = $conn->prepare("UPDATE ogaddress SET defaultAdd='0' WHERE userid=?");
    // $updateAddress->execute([$userid]);
    // $setDefualt = $conn->prepare("UPDATE ogaddress SET defaultAdd='1' WHERE id=?");
    // $setDefualt->execute([$addressId]);
    

    $servername = "newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
    $username = "root";
    $password = "Iamawesome8425";
    $dbname = "onegloba_globalmedz";

    // Create connection
    $oldCrmConn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($oldCrmConn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    else
    {
    }
    $updateCusomer = $conn->prepare("UPDATE ogcustomer SET cookieUser=? WHERE userid=?");
    $updateCusomer->execute(['No', $userid]);
    if ($updateCusomer)
    {

        $select_country = $conn->prepare("SELECT * FROM countries WHERE country_id = '$country'");
        $select_country->execute();
        while ($row = $select_country->fetch(PDO::FETCH_ASSOC))
        {
            $countryName = $row['country_name'];
        }

        $select_state = $conn->prepare("SELECT * FROM states WHERE state_id = '$state'");
        $select_state->execute();
        while ($row = $select_state->fetch(PDO::FETCH_ASSOC))
        {
            $stateName = $row['state_name'];
        }

        $select_city = $conn->prepare("SELECT * FROM cities WHERE city_id = '$city'");
        $select_city->execute();
        while ($row = $select_city->fetch(PDO::FETCH_ASSOC))
        {
            $cityName = $row['city_name'];
        }

        // $insertAddress = $conn->prepare("INSERT into ogaddress(userid, fname, lname, email, phone, addressline1, addressline2, city, country, state, postalcode) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        // $insertAddress->execute([$userid, $fname, $lname, $email, $phone, $addressline1, $addressline2, $cityName, $countryName, $stateName, $postalCode]);
        if (1 == 1)
        {
            $productStatusArray  =array();

            function array_push_assoc($array, $key, $value){
            $array[$key] = $value;
            return $array;
            }
            
            $shippingCompany1=array();
            $selectCartProduct = $conn->prepare("SELECT * FROM ogcart WHERE userId= '$userid' && wishlist=0");
            $selectCartProduct->execute();
            while ($row = $selectCartProduct->fetch(PDO::FETCH_ASSOC))
            {
                $productCode = $row['productCode'];
                $strengthCode = $row['strengthCode'];
                $quantityCode = $row['quantityCode'];
                $quantity = $row['quantity'];
                $quantityPrice = $row['quantityPrice'];
                $totalQuantity = $row['totalQuantity'];
                $saveAmountCart = $row['saveAmount'];
                $discountCart = $row['discount'];
                $orgPriceCart = $row['orgPrice'];
                $totalPrice = $row['totalPrice'];
                $total = $row['total'];
                $select_product_details = $conn->prepare("SELECT * FROM ogproduct WHERE productCode='$productCode'");
                $select_product_details->execute();
                while ($product = $select_product_details->fetch(PDO::FETCH_ASSOC))
                {   
                    $productId = $product['productId'];
                    $productName = $product['productName'];
                    $productImage = $product['productImage'];
                    $productCategory = $product['productCategory'];
                    $productType = $product['productType'];
                    array_push($shippingCompany1, $product['shippingCompany']);
                }
                $selectStrengthName = $conn->prepare("SELECT * FROM ogstrength WHERE strengthCode= '$strengthCode'");
                $selectStrengthName->execute();
                while ($row = $selectStrengthName->fetch(PDO::FETCH_ASSOC))
                {
                    $strengthName = $row['strengthName'];
                }


                $productStatusArray = array_push_assoc($productStatusArray, 'x'.$productId, 'Draft');

                

                $insertProduct = $conn->prepare("INSERT into ogorderproduct(productName, productCategory, strength, orderid, productCode, quantityCode, strengthCode, quantity, quantityPrice, totalQuantity, totalPrice, total, discount, saveAmount, orgPrice, userId) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $insertProduct->execute([$productName, $productCategory, $strengthName, $orderId, $productCode, $quantityCode, $strengthCode, $quantity, $quantityPrice, $totalQuantity, $totalPrice, $totalPrice * $totalQuantity, $discountCart, $saveAmountCart, $orgPriceCart, $userid]);
            }
            $shippingCompany1 =  implode(",",(array_unique($shippingCompany1)));

            $getCustId = "SELECT * FROM shippinginfo ORDER BY sid DESC limit 1";
            $lastCustId = $oldCrmConn->query($getCustId);
            while ($custidrow = $lastCustId->fetch_assoc())
            {
                $custid = $custidrow['cid'];
                $custid++;
            }

            $selectData = $conn->prepare("SELECT * FROM ogaddress WHERE id='" . $addressId . "'");
            $selectData->execute();
            while ($addressCust = $selectData->fetch(PDO::FETCH_ASSOC))
            {
                $userid = $addressCust['userid'];
                $email = $addressCust['email'];
                $fname = $addressCust['fname'];
                $lname = $addressCust['lname'];
                $phone = str_replace(" ","",$addressCust['phone']);
                $addressline1 = $addressCust['addressline1'] . $addressCust['addressline2'];
                $stateName = $addressCust['state'];
                $cityName = $addressCust['city'];
                $countryName = $addressCust['country'];
                $postalCode = $addressCust['postalcode'];
            }
            $insertToOldCrm = "INSERT INTO shippinginfo(cid,email,fname, lname, address, city, state, country, zip, phone, payby) VALUES($custid, '$email', '$fname', '$lname', '$addressline1', '$cityName', '$stateName', '$countryName', '$postalCode', '$phone', 'Pay by credit or debit card')";
            if ($oldCrmConn->query($insertToOldCrm) === true)
            {
                $select_user_coupan = $conn->prepare("SELECT coupon FROM ogcustomer WHERE userid='$userid'");
                $select_user_coupan->execute();
                while($coupan=$select_user_coupan->fetch(PDO::FETCH_ASSOC)){
                    $coupon = $coupan['coupon'];
                }
                if($coupon=="") {
                    $amtDiscount = 0;
                }
                else {
                    $selectCouponData = $conn->prepare("SELECT * FROM coupons WHERE code='$coupon'");
                    $selectCouponData->execute();
                    while($coupanData=$selectCouponData->fetch(PDO::FETCH_ASSOC)){
                        $discount=$coupanData['discount'];
                        $orderAmount=$coupanData['minOrderAmount'];
                        $maxAmount = $coupanData['maxDiscountAmount'];
                        $disType = $coupanData['isTypePercentage'];
                        $code = $coupanData['code'];
                        $usertype = $coupanData['user'];
                        $product = $coupanData['product'];
                        $category = $coupanData['category'];
                        if($usertype=='ALL'){
                            if(!empty($category)){
                                if($category=='ALL'){
                                    $select_strength_details=$conn->prepare("SELECT SUM(total) AS totalPrice FROM ogcart WHERE userID='$userid' && wishlist=0");
                                    $select_strength_details->execute();
                                    while($priceTotal=$select_strength_details->fetch(PDO::FETCH_ASSOC)){
                                        $totalCartPrice =  $priceTotal['totalPrice'];
                                    }
                                }else {
                                    $totalCartPrice = 0;
                                    $productArray = array();
                                    $getCartProductCode = $conn->prepare('SELECT * FROM ogcart WHERE userid=?');
                                    $getCartProductCode->execute([$userid]);
                                    while($cartCode = $getCartProductCode->fetch(PDO::FETCH_ASSOC)){
                                        $productCode = $cartCode['productCode'];
                                        $getProductCategory=$conn->prepare('SELECT * FROM ogproduct WHERe productCode = ?');
                                        $getProductCategory->execute([$productCode]);
                                        while($productCat = $getProductCategory->fetch(PDO::FETCH_ASSOC)){
                                            $productCategory = explode(',',strtoupper($productCat['productCategory']));
                                            $productArray = array_merge($productArray, $productCategory);
                                            $couponCatArray = explode(',',$category);
                                            $matchArray=array_intersect($couponCatArray,$productArray);
                                            if(count($matchArray)>0){
                                                 $totalCartPrice =  $totalCartPrice+$cartCode['total'];
                                            }
                                        }
                                    }
                                }
                            }elseif(!empty($product)){
                                if($product=='ALL'){
                                    $select_strength_details=$conn->prepare("SELECT SUM(total) AS totalPrice FROM ogcart WHERE userID='$userid' && wishlist=0");
                                    $select_strength_details->execute();
                                    while($priceTotal=$select_strength_details->fetch(PDO::FETCH_ASSOC)){
                                        $totalCartPrice =  $priceTotal['totalPrice'];
                                    }
                                }else {
                                    $totalCartPrice = 0;
                                    $productArray = array();
                                    $getCartProductCode = $conn->prepare('SELECT * FROM ogcart WHERE userid=?');
                                    $getCartProductCode->execute([$userid]);
                                    while($cartCode = $getCartProductCode->fetch(PDO::FETCH_ASSOC)){
                                        $productCode = $cartCode['productCode'];
                                        
                                        if (in_array($productCode, explode(',',$product))){
                                            $totalCartPrice=$totalCartPrice+$cartCode['total'];
                                        }
                                    }
                                }
                            }
                        }
                        if($disType==1){
                            $amtDiscount = $totalCartPrice*($discount/100);
                            if($amtDiscount>$maxAmount && $maxAmount>1){
                                $amtDiscount=$maxAmount;
                            }
                        }else{
                            if($discount>$maxAmount && $maxAmount>1){
                                $amtDiscount=$maxAmount;
                            }else {
                                $amtDiscount=$discount;
                            }
                        }
                    }
                }
                
                
                
                $allProductPrice = $conn->prepare("SELECT SUM(total) AS totalPrice, SUM(orgPrice) AS totalCartAmount, SUM(saveAmount) AS saveAmt FROM ogcart WHERE userID='$userid' && wishlist=0");
                $allProductPrice->execute();
                while ($priceTotal = $allProductPrice->fetch(PDO::FETCH_ASSOC))
                {

                    $totalCartPrice = $priceTotal['totalPrice'];
                    $totalCartAmount =  $priceTotal['totalCartAmount'];
                    $saveAmt = $priceTotal['saveAmt'];
                    if ($sprice > 0 && $sprice <= 55)
                    {
                        $sshipping = 35;
                    }
                    elseif ($sprice >= 56 && $sprice < 250)
                    {
                        $sshipping = 25;
                    }
                    elseif ($sprice >= 250)
                    {
                        $sshipping = 0;
                    }
    
                    if ($gprice > 0 && $gprice <= 55)
                    {
                        $gshipping = 35;
                    }
                    elseif ($gprice >= 56 && $gprice < 250)
                    {
                        $gshipping = 25;
                    }
                    elseif ($gprice >= 250)
                    {
                        $gshipping = 0;
                    }
    
                    if ($uprice > 0 && $uprice <= 55)
                    {
                        $ushipping = 0;
                    }
                    elseif ($uprice >= 56 && $uprice < 250)
                    {
                        $ushipping = 0;
                    }
                    elseif ($uprice >= 250)
                    {
                        $ushipping = 0;
                    }
                    $shipping = $sshipping + $gshipping + $ushipping;
                    $total = $totalCartPrice - $amtDiscount;
                    $total = $total + $shipping;
                    $totalDis = $amtDiscount+$saveAmt;
                }
                $curCode = "'".$_SESSION['currency']."'"; 
                $curprice = number_format(($total*$_SESSION["currency_rate"]),2); 
                $curprice = str_replace(",","",$curprice);
                $curSym = "'".$_SESSION['currency_symbol']."'";
                $insertorders = "INSERT INTO orders(cust_id, orderno, orderdate, payment_mode, order_value, shipping, discount, total, user_ip, payment_link, status, currency, convertedPrice, symbol, productStatus) 
                                                                VALUES($custid, '$orderId', '$oldcrmtimestamp', 'Credit Card', '$totalCartPrice', '$shipping', '$totalDis', '$total', '', '', 'Pending', $curCode, $curprice, $curSym, '".json_encode($productStatusArray)."')";
                
                if ($oldCrmConn->query($insertorders))
                {
                    $lastid = $oldCrmConn->insert_id;
                    $insertToOldCrm = "INSERT INTO tbtcustomer(cid,fname, lname, email, mobile, password) VALUES($custid, '$fname', '$lname', '$email', '$phone', ' ')";
                    if ($oldCrmConn->query($insertToOldCrm) === true)
                    {

                    }
                    else
                    {
                        echo "Error: " . $insertToOldCrm . "<br>" . $oldCrmConn->error;
                    }
                    
                    $selectCartProduct = $conn->prepare("SELECT * FROM ogcart WHERE userId= '$userid' && wishlist=0");
                    $selectCartProduct->execute();
                    while ($row = $selectCartProduct->fetch(PDO::FETCH_ASSOC))
                    {
                        $productCode = $row['productCode'];
                        $strengthCode = $row['strengthCode'];
                        $quantityCode = $row['quantityCode'];
                        $quantity = $row['quantity'];
                        $quantityPrice = $row['quantityPrice'];
                        $totalQuantity = $row['totalQuantity'];
                        $totalPrice = $row['totalPrice'];
                        $total = $row['total'];
                        $selectProductName = $conn->prepare("SELECT * FROM ogproduct WHERE productCode= '$productCode'");
                        $selectProductName->execute();
                        while ($row = $selectProductName->fetch(PDO::FETCH_ASSOC))
                        {
                            $productName = $row['productName'];
                            $productCategory = $row['productCategory'];
                        }

                        $selectStrengthName = $conn->prepare("SELECT * FROM ogstrength WHERE strengthCode= '$strengthCode'");
                        $selectStrengthName->execute();
                        while ($row = $selectStrengthName->fetch(PDO::FETCH_ASSOC))
                        {
                            $strengthName = $row['strengthName'];
                        }
                        $selectQuantity = $conn->prepare("SELECT * FROM ogquantity WHERE quantityCode= '$quantityCode'");
                        $selectQuantity->execute();
                        while ($row = $selectQuantity->fetch(PDO::FETCH_ASSOC))
                        {
                            $quantityName = $row['quantity'];
                        }

                        $insertCategory = "INSERT INTO `category` (`title`, `image_src`, `status`) VALUES ('$productCategory', 'sfsf', '1');";
                        if ($oldCrmConn->query($insertCategory))
                        {
                            $newcategoryid = $oldCrmConn->insert_id;
                        }

                        $insertProduct = "INSERT INTO `subcategory`(`id`, `productname`, `image`, `price`, `packageSize`, `description`, `status`) VALUES ('$newcategoryid', '$productName', 'sdsd', 5, 'ff', 'ff', '3')";
                        if ($oldCrmConn->query($insertProduct))
                        {
                            $newproductsid = $oldCrmConn->insert_id;
                        }

                        $insertStrength = "INSERT INTO `pdetails`(`cid`, `product_id`, `strength`, `packaging_method`) VALUES ('$newcategoryid', '$newproductsid','$strengthName', 'pill')";
                        if ($oldCrmConn->query($insertStrength))
                        {
                            $newstrengthid = $oldCrmConn->insert_id;
                        }

                        $insertToOldCrm = "INSERT INTO order_details(order_id, cid, pid, strength, qty, price) VALUES($lastid, $newcategoryid, $newproductsid, $newstrengthid, $quantity*$totalQuantity, $quantityPrice)";
                        if ($oldCrmConn->query($insertToOldCrm) === true)
                        {

                        }
                        else
                        {
                            echo "Error: " . $insertToOldCrm . "<br>" . $oldCrmConn->error;
                        }

                        $newStrength = $productName . " " . $strengthName;
                        $getOldData = "SELECT * FROM pdetails WHERE strength LIKE '%$newStrength%'";
                        $oldProductResult = $oldCrmConn->query($getOldData);
                        while ($productRow = $oldProductResult->fetch_assoc())
                        {
                            $strengthid = $productRow['pid'];
                        }
                        if(!isset($strengthid)){
                            $strengthid=0;
                        }

                        $getOldData1 = "SELECT * FROM tblproductdetails WHERE strength='$strengthid' and qty='$quantityName' limit 1";
                        $oldProductResult = $oldCrmConn->query($getOldData1);
                        while ($productRow1 = $oldProductResult->fetch_assoc())
                        {
                            $catids = $productRow1['cid'];
                            $productids = $productRow1['pid'];
                            $strengthids = $productRow1['strength'];

                        }

                    }

                }
                else
                {
                    echo "Error: " . $insertorders . "<br>" . $oldCrmConn->error;
                }
            }
            else
            {
                echo "Error: " . $insertToOldCrm . "<br>" . $oldCrmConn->error;
            }

        }
        else
        {
            echo "Not Insert Address";
        }
        if ($insertProduct)
        {
            $select_user_coupan = $conn->prepare("SELECT coupon FROM ogcustomer WHERE userid='$userid'");
                $select_user_coupan->execute();
                while($coupan=$select_user_coupan->fetch(PDO::FETCH_ASSOC)){
                    $coupon = $coupan['coupon'];
                }
                if($coupon=="") {
                    $code = " ";
                    $amtDiscount = 0;
                }
                else {
                    $selectCouponData = $conn->prepare("SELECT * FROM coupons WHERE code='$coupon'");
                    $selectCouponData->execute();
                    while($coupanData=$selectCouponData->fetch(PDO::FETCH_ASSOC)){
                        $discount=$coupanData['discount'];
                        $orderAmount=$coupanData['minOrderAmount'];
                        $maxAmount = $coupanData['maxDiscountAmount'];
                        $disType = $coupanData['isTypePercentage'];
                        $code = $coupanData['code'];
                        $usertype = $coupanData['user'];
                        $product = $coupanData['product'];
                        $category = $coupanData['category'];
                        if($usertype=='ALL'){
                            if(!empty($category)){
                                if($category=='ALL'){
                                    $select_strength_details=$conn->prepare("SELECT SUM(total) AS totalPrice FROM ogcart WHERE userID='$userid' && wishlist=0");
                                    $select_strength_details->execute();
                                    while($priceTotal=$select_strength_details->fetch(PDO::FETCH_ASSOC)){
                                        $totalCartPrice =  $priceTotal['totalPrice'];
                                    }
                                }else {
                                    $totalCartPrice = 0;
                                    $productArray = array();
                                    $getCartProductCode = $conn->prepare('SELECT * FROM ogcart WHERE userid=?');
                                    $getCartProductCode->execute([$userid]);
                                    while($cartCode = $getCartProductCode->fetch(PDO::FETCH_ASSOC)){
                                        $productCode = $cartCode['productCode'];
                                        $getProductCategory=$conn->prepare('SELECT * FROM ogproduct WHERe productCode = ?');
                                        $getProductCategory->execute([$productCode]);
                                        while($productCat = $getProductCategory->fetch(PDO::FETCH_ASSOC)){
                                            $productCategory = explode(',',strtoupper($productCat['productCategory']));
                                            $productArray = array_merge($productArray, $productCategory);
                                            $couponCatArray = explode(',',$category);
                                            $matchArray=array_intersect($couponCatArray,$productArray);
                                            if(count($matchArray)>0){
                                                 $totalCartPrice =  $totalCartPrice+$cartCode['total'];
                                            }
                                        }
                                    }
                                }
                            }elseif(!empty($product)){
                                if($product=='ALL'){
                                    $select_strength_details=$conn->prepare("SELECT SUM(total) AS totalPrice FROM ogcart WHERE userID='$userid' && wishlist=0");
                                    $select_strength_details->execute();
                                    while($priceTotal=$select_strength_details->fetch(PDO::FETCH_ASSOC)){
                                        $totalCartPrice =  $priceTotal['totalPrice'];
                                    }
                                }else {
                                    $totalCartPrice = 0;
                                    $productArray = array();
                                    $getCartProductCode = $conn->prepare('SELECT * FROM ogcart WHERE userid=?');
                                    $getCartProductCode->execute([$userid]);
                                    while($cartCode = $getCartProductCode->fetch(PDO::FETCH_ASSOC)){
                                        $productCode = $cartCode['productCode'];
                                        
                                        if (in_array($productCode, explode(',',$product))){
                                            $totalCartPrice=$totalCartPrice+$cartCode['total'];
                                        }
                                    }
                                }
                            }
                        }
                        if($disType==1){
                            $amtDiscount = $totalCartPrice*($discount/100);
                            if($amtDiscount>$maxAmount && $maxAmount>1){
                                $amtDiscount=$maxAmount;
                            }
                        }else{
                            if($discount>$maxAmount && $maxAmount>1){
                                $amtDiscount=$maxAmount;
                            }else {
                                $amtDiscount=$discount;
                            }
                        }
                    }
                }
                
                
                
                $allProductPrice = $conn->prepare("SELECT SUM(total) AS totalPrice, SUM(orgPrice) AS totalCartAmount, SUM(saveAmount) AS saveAmt FROM ogcart WHERE userID='$userid' && wishlist=0");
                $allProductPrice->execute();
                while ($priceTotal = $allProductPrice->fetch(PDO::FETCH_ASSOC))
                {

                    $totalCartPrice = $priceTotal['totalPrice'];
                    $totalCartAmount =  $priceTotal['totalCartAmount'];
                    $saveAmt = $priceTotal['saveAmt'];
                    if($sprice>0){


                        if($quantity>0 && $quantity<=5){
                            $sshipping = 20;
                        }else{
                            $sshipping = 40;
                        }

                        // if($sprice>0 && $sprice<=99){
                        //     $sshipping = 20;
                        // }
                        // elseif($sprice>99 && $sprice<=149){
                        //     $sshipping = 15;
                        // }
                        // elseif($sprice>149 && $sprice<=199){
                        //     $sshipping = 10;
                        // }
                        // elseif($sprice>199){
                        //      $sshipping = 0;
                        // }
                    }
                    if($gprice>0){
                        if($gprice>0 && $gprice<=99){
                            $gshipping = 20;
                        }
                        elseif($gprice>99 && $gprice<=149){
                            $gshipping = 15;
                        }
                        elseif($gprice>149 && $gprice<=199){
                            $gshipping = 10;
                        }
                        elseif($gprice>199){
                             $gshipping = 0;
                        }
                    }
                    
                    if($eprice>0){
                        if($eprice>0 && $eprice<=99){
                            $eshipping = 20;
                        }
                        elseif($eprice>99 && $eprice<=149){
                            $eshipping = 15;
                        }
                        elseif($eprice>149 && $eprice<199){
                            $eshipping = 10;
                        }
                        elseif($eprice>=250){
                             $eshipping = 0;
                        }
                    }
    
                    if ($uprice > 0 && $uprice <= 55)
                    {
                        $ushipping = 0;
                    }
                    elseif ($uprice >= 56 && $uprice < 250)
                    {
                        $ushipping = 0;
                    }
                    elseif ($uprice >= 250)
                    {
                        $ushipping = 0;
                    }
                    $shipping = $sshipping + $gshipping + $ushipping;
                    $total = $totalCartPrice - $amtDiscount;
                    $total = $total + $shipping;
                    $disEmail = $amtDiscount + $saveAmt;
                }
                $utc=gmdate("Y-m-d\TH:i:s\Z");
            if(strlen($code)>2){

            }else {
                $code = NULL;
            }

            $setMasterHistory = $conn->prepare("INSERT INTO masterHistory(masterid, master, masterRole, orderid, type, action, actionType, createdAt) VALUES (?,?,?,?,?,?,?,?)");
            $setMasterHistory->execute([0, $fname." ".$lname, 'customer', $orderId, 'order', 'placed an order', 'create', $utc]);

            $insertOrderDetails = $conn->prepare("INSERT INTO orderdetails(orderid, userid, subtotal, dcharge, discount, total, currency, convertedPrice, symbol, paymentMethod, paidAmount, paymentStatus, orderStatus, orderDate, addressId, coupon,fname, lname, email, phone, addressline1, addressline2, city, country, state, postalcode, productStatus, ogtotal, source, website, shippingCompany, offsetDate, paymentlink, isDiscountPercent) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $insertOrderDetails->execute([$orderId, $userid, $totalCartPrice, $shipping, $amtDiscount+$saveAmt , $total, $_SESSION['currency'], number_format(($total*$_SESSION["currency_rate"]),2), $_SESSION['currency_symbol'], NULL, '0', 'Unpaid', 'Draft', $timestamp, $addressId, $code, $fname, $lname, $email, $phone, $addressline1, $addressline2, $cityName, $countryName, $stateName, $postalCode, json_encode($productStatusArray), $totalCartAmount, 'GLB', $INFO_WEBSITE_NAME , $shippingCompany1,$utc, 'https://'.$INFO_WEBSITE_NAME .'/payselect/'.$orderId,1]);
            if ($insertOrderDetails)
            {
                $deleteFromCart = $conn->prepare("DELETE FROM ogcart WHERE userId=? && wishlist=0");
                $deleteFromCart->execute([$userid]);

                $updateCoupon = $conn->prepare("UPDATE ogcustomer SET coupon=NULL WHERE userid=?");
                $updateCoupon->execute([$userid]);

                $deleteCoupon = $conn->prepare("DELETE FROM coupons WHERE user=?");
                $deleteCoupon->execute([$_COOKIE["userID"]]);

                $updateCoupon = $conn->prepare("UPDATE ogcustomer SET coupon=NULL WHERE userid=?");
                $updateCoupon->execute([$_COOKIE["userID"]]);

                echo json_encode(array(
                    "invid" => $orderId
                ));

                $_SESSION['invoiceId'] = $orderId;

                $_SESSION['userLogin'] = "True";
                $_SESSION['userid'] = $userid;

                $msg = '

                <table style="max-width:600px;background-color:#fff;margin:5px auto;padding:15px;border-radius:15px">

                    <tbody>
                        <tr>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td align="center">
                                                <img width="200px" height="auto;" style="margin-bottom:10px;margin-top:10px"
                                                    src="https://i.ibb.co/k1bNrsJ/logo.png"
                                                    alt="logo" class="CToWUd" data-bit="iit">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td align="center">
                                                <img width="100%"
                                                    src="https://i.ibb.co/Z1gZq46/Order-Confirmation.png"
                                                    alt="Pending" class="CToWUd a6T" data-bit="iit" tabindex="0">
                                                <div class="a6S" dir="ltr" style="opacity: 0.01; left: 709px; top: 401.906px;">
                                                    <div id=":or" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0"
                                                        aria-label="Download attachment " data-tooltip-class="a1V"
                                                        data-tooltip="Download">
                                                        <div class="akn">
                                                            <div class="aSK J-J5-Ji aYr"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td align="center">
                                                <h2>INVOICE-ID: '.$orderId.'</h2>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div style="font-size:1.5em">
                                <p>
                                    Hello '.$fname.',
                                </p>
                                <p>
                                    <strong>
                                        Your journey towards healthy life starts here.
                                    </strong>
                                </p>
                                <p>
                                    Thank you for placing your order with us, we appreciate your vote of
                                    confidence in Newlands pharmacy . Your Invoice number is
                                    <strong>I'.$orderId.'</strong>.We request your patience, You will soon receive the
                                    payment link and invoice copy of $' . $total . ' for your order. You can check
                                    your order as mentioned below and if any changes needs to be done,
                                    kindly call our representative at '.$_SESSION['phone1'].' ?> or email us at
                                    <a style="text-decoration:none" href="mailto:admin@'.$INFO_WEBSITE_NAME .'" rel="noreferrer"
                                        target="_blank">admin@'.$INFO_WEBSITE_NAME .'</a>
                                </p>
                            </div>

                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td align="center">
                                            <h2 style="text-align:center">NOTE TO OUR VALUED CUSTOMERS</h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <img style="max-width:400px;height:auto"
                                                src="https://i.ibb.co/BqWB0yY/Note-1.png"
                                                alt="note1" class="CToWUd a6T" data-bit="iit" tabindex="0">
                                            <div class="a6S" dir="ltr" style="opacity: 0.01; left: 633.5px; top: 1229.33px;">
                                                <div id=":os" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0"
                                                    aria-label="Download attachment " data-tooltip-class="a1V"
                                                    data-tooltip="Download">
                                                    <div class="akn">
                                                        <div class="aSK J-J5-Ji aYr"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <img style="max-width:400px;height:auto"
                                                src="https://i.ibb.co/LQvG1Ls/note-2.png"
                                                alt="note2" class="CToWUd a6T" data-bit="iit" tabindex="0">
                                            <div class="a6S" dir="ltr" style="opacity: 0.01; left: 633.5px; top: 1581.83px;">
                                                <div id=":ot" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0"
                                                    aria-label="Download attachment " data-tooltip-class="a1V"
                                                    data-tooltip="Download">
                                                    <div class="akn">
                                                        <div class="aSK J-J5-Ji aYr"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <img style="max-width:400px;height:auto"
                                                src="https://i.ibb.co/FxLFJpm/Note-3.png"
                                                alt="note3" class="CToWUd a6T" data-bit="iit" tabindex="0">
                                            <div class="a6S" dir="ltr" style="opacity: 0.01; left: 631px; top: 1836.33px;">
                                                <div id=":ou" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0"
                                                    aria-label="Download attachment " data-tooltip-class="a1V"
                                                    data-tooltip="Download">
                                                    <div class="akn">
                                                        <div class="aSK J-J5-Ji aYr"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div style="font-size:1.5em">
                                <p>
                                    Note: Name on bank statement for your order of <strong>$' . $total . '</strong> will be Newlands Clothing.
                                    This name will also appear on your credit or debit card statement.
                                </p>
                            </div>

                            <table style="font-size:1.3em;margin-top:10px;margin-bottom:10px">
                                <tbody><tr>
                                <td valign="top" align="center" style="vertical-align:top">
                                    <img style="width:3em;margin:0px 12px" src="https://i.ibb.co/b32WJ8k/customer-service.png" alt="Assistance" class="CToWUd" data-bit="iit">
                                </td>
                                <td>
                                    <h3 style="margin:0px">24/7 Assistance</h3>
                                    
                                    <p style="margin-top:0px;margin-bottom:10px">
                                    <a style="text-decoration:none" href="tel:+13155154364" target="_blank">Call</a>,
                                    <a style="text-decoration:none" href="mailto:admin@'.$INFO_WEBSITE_NAME .'" target="_blank">Email</a> or
                                    <a style="text-decoration:none" href="https://'.$INFO_WEBSITE_NAME .'/" target="_blank" data-saferedirecturl="https://'.$INFO_WEBSITE_NAME .'/">Visit NewLands Pharmacy</a>
                                    for expert assistance.
                                    </p>

                                    <div style="margin-top:20px">
                                    <img style="width:1.5em" src="https://i.ibb.co/khLFyV5/Whatsapp.png" alt="whatsapp" class="CToWUd" data-bit="iit">
                                    <a style="text-decoration:none" href="tel:+13155154364" target="_blank">'.$_SESSION['phone1'].'</a>
                                    </div>
                                    <div style="margin-bottom:20px;margin-top:10px">
                                    <img style="width:1.5em" src="https://i.ibb.co/DVDhrV8/Mail.png" alt="email" class="CToWUd" data-bit="iit">
                                    <a style="text-decoration:none" href="mailto:admin@'.$INFO_WEBSITE_NAME .'" target="_blank">admin@'.$INFO_WEBSITE_NAME .'</a>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td valign="top" align="center" style="vertical-align:top">
                                    <img style="width:3em;margin:0px 12px" src="https://i.ibb.co/xD6mR4H/guarantee.png" alt="Guarantee" class="CToWUd" data-bit="iit">
                                </td>
                                <td>
                                    <h3 style="margin:0px">Our Guarantee</h3>
                                    <p style="margin-top:0px">
                                    Your satisfaction is 100% guaranted. See our 
                                    <a style="text-decoration:none" href="">Return and Exchange</a>
                                    policy
                                    </p>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                        <div>
                            <h3 style="text-align:center">New Lands Pharma</h3>
                            <p style="text-align:center;display:block">Ohio, USA</p>
                        </div>

                            </td>
                        </tr>
                    </tbody>
                </table>

                ';          

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

    if (strpos($actual_link, 'newlandpharmacy') OR strpos($actual_link, 'oneglobalpharma')) { 
        $websiteemail = 'orderonline@'.$INFO_WEBSITE_NAME ;
    }elseif (strpos($actual_link, 'oneglobalpharma')) {
        $websiteemail = 'orderonline@noneglobalpharma.com';
    }else {
        $websiteemail = 'orderonline@'.$INFO_WEBSITE_NAME ;
    }

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://hideuri.com/api/v1/shorten",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "url=".$actual_link."/order/invoice/".$orderId."",
    CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded"
    ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $shortURL = json_decode($response, true)['result_url'];
    }

    $post_data = [
        'username'=>'MyGlobalPharma', 
        'key'=>'MyGlobalPharma@2022',  
        'method'=>'http', 
        'to'=>$phone, 
        'message'=>'Thank you for shopping with us '.$fname.'. Your invoice number is #'.$orderId.'. We will shortly send you the payment link. Meanwhile you can review your order here: '.$shortURL.' . For any assistance kindly reply to this message and feel free to call us on +13155154364  -Newlands Pharmacy',
        
        'senderid'=>'mycompany'
    ];
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, "https://api-mapper.clicksend.com/http/v2/send.php" );
    curl_setopt($ch, CURLOPT_POST, 1 );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $postResult = curl_exec($ch);
    if (curl_errno($ch)) {
        // print curl_error($ch);
    }
    curl_close($ch);
    // var_dump($postResult);
        
        
    $curl = curl_init();
        
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.ultramsg.com/instance5491/messages/chat",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "token=mp15jsuyuzvpfrhz&to=".$phone."&body=Thank you for shopping with us ".$fname.". Your invoice number is #".$orderId.". We will shortly send you the payment link. Meanwhile you can review your order here: ".$shortURL." . For any assistance kindly reply to this message and feel free to call us on +13155154364  -
    Newlands Pharmacy&priority=1&referenceId=",
    
    CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded"
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
        
    curl_close($curl);
        
    if ($err) {
        //   echo "cURL Error #:" . $err;
    } else {
        //   echo $response;
    }

    // $emails1 = new \SendGrid\Mail\Mail();
    // $emails1->setFrom("no-reply@Newlands Pharmacy.com", "Newlands Pharmacy");
    // $emails1->setSubject("Your Newlands Pharmacy Order Confirmation ( " . $orderId . " )");
    // $emails1->addTo($email, $fname . ' ' . $lname);
    // $emails1->addBcc("tradeonlinepharma@gmail.com", "Trade Online");
    // $emails1->addContent("text/html", $msg);
    // $apiKey = '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';
    // $sendgrid = new \SendGrid($apiKey);
    // try{
    //     $response = $sendgrid->send($emails1);
    // }
    // catch(Exception $e){
    //     echo "<pre>";
    //     echo 'Caught exception: ' . $e->getMessage() . "\n";
    // }
    
    $mailjetApiKey = 'a6e20f63603953cd9ca2349265d2304b';
    $mailjetApiSecret = '4a228283087d8e09a63a01a990576bc3';
    $messageData = [
            'Messages' => [
                    [
                            'From' => [
                                    'Email' => 'orderonline@'.$INFO_WEBSITE_NAME ,
                                    'Name' => 'Newlands Pharmacy Order'
                            ],
                            'To' => [
                                    [
                                            'Email' => $email,
                                            'Name' => $fname . ' ' . $lname
                                    ]
                            ],
                            'Bcc' => [
                                [
                                        'Email' => 'tradeonlinepharma@gmail.com',
                                        'Name' => 'Trade Online'
                                ]
                            ],
                            'Subject' => 'Order Confirmation: Your order #'. $orderId .' with Newlands Pharmacy has been successfully placed!',
                            'TextPart' => '',
                            'HTMLPart' => $msg
                    ]
            ]
    ];
    $jsonData = json_encode($messageData);
    $ch = curl_init('https://api.mailjet.com/v3.1/send');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_USERPWD, "{$mailjetApiKey}:{$mailjetApiSecret}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
    ]);
    $response = json_decode(curl_exec($ch));

    // print_r($response);
                
            }
            else
            {
                echo "Fail";
            }
        }
        else
        {

        }
    }
    else
    {
        echo "Not Inserted";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://hideuri.com/api/v1/shorten",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "url=".$actual_link."/order/invoice/".$orderId."",
    CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded"
    ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $shortURL = json_decode($response, true)['result_url'];
    }

    $post_data = [
        'username'=>'MyGlobalPharma', 
        'key'=>'MyGlobalPharma@2022',  
        'method'=>'http', 
        'to'=>$phone, 
        'message'=>'Thank you for shopping with us '.$fname.'. Your invoice number is #'.$orderId.'. We will shortly send you the payment link. Meanwhile you can review your order here: '.$shortURL.' . For any assistance kindly reply to this message and feel free to call us on +13155154364  -Newlands Pharmacy',
        
        'senderid'=>'mycompany'
    ];
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, "https://api-mapper.clicksend.com/http/v2/send.php" );
    curl_setopt($ch, CURLOPT_POST, 1 );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $postResult = curl_exec($ch);
    if (curl_errno($ch)) {
        // print curl_error($ch);
    }
    curl_close($ch);
    // var_dump($postResult);
        
        
    $curl = curl_init();
        
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.ultramsg.com/instance5491/messages/chat",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "token=mp15jsuyuzvpfrhz&to=".$phone."&body=Thank you for shopping with us ".$fname.". Your invoice number is #".$orderId.". We will shortly send you the payment link. Meanwhile you can review your order here: ".$shortURL." . For any assistance kindly reply to this message and feel free to call us on +13155154364  -
    Newlands Pharmacy&priority=1&referenceId=",
    
    CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded"
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
        
    curl_close($curl);




?>
