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
    $getCoupon = $conn->prepare("SELECT * FROM ogcustomer where userid=?");
    $getCoupon->execute([$userid]);
    while($row=$getCoupon->fetch(PDO::FETCH_ASSOC)){
        $coupon = $row['coupon'];
    }
    if($coupon==""){
        
    }else {
    
        $selectCouponData = $conn->prepare("SELECT * FROM coupons WHERE code='$coupon' AND status='1'");
        $selectCouponData->execute();
        $totalCoupon= $selectCouponData->rowCount();
        if($totalCoupon>0){
            while($coupanData=$selectCouponData->fetch(PDO::FETCH_ASSOC)){
                $code = $coupanData['code'];
                $usertype = $coupanData['user'];
                $product = $coupanData['product'];
                $category = $coupanData['category'];
                if($usertype=='ALL'){
                    if(!empty($category)){
                        if($category=='ALL'){
                            
                        }else {
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
                                }
                            }
                            
                            $couponCatArray = explode(',',$category);
                            $matchArray=array_intersect($couponCatArray,$productArray);
                            if(count($matchArray)<1){
                                $updateCoupan = $conn->prepare("UPDATE ogcustomer set coupon=? where userid=?");
                                $updateCoupan->execute([NULL, $userid]);
                            }
                        }
                    }elseif(!empty($product)){
                        if($product=='ALL'){
                            
                        }else {
                            $productArray = array();
                            $getCartProductCode = $conn->prepare('SELECT * FROM ogcart WHERE userid=?');
                            $getCartProductCode->execute([$userid]);
                            while($cartCode = $getCartProductCode->fetch(PDO::FETCH_ASSOC)){
                                
                                $productCode = explode(',',strtoupper($cartCode['productCode']));
                                $productArray = array_merge($productArray, $productCode);
    
                            }
                            
                            $couponProdArray = explode(',',$product);
                            $matchArray=array_intersect($couponProdArray,$productArray);
                            if(count($matchArray)<1){
                                $updateCoupan = $conn->prepare("UPDATE ogcustomer set coupon=? where userid=?");
                                $updateCoupan->execute([NULL, $userid]);
                                
                            }else {
                                
                            }
                        }
                    }
                }elseif($usertype=='New'){
                    if($category=='ALL'){
                        $updateCoupan = $conn->prepare("UPDATE ogcustomer set coupon=? where userid=?");
                        $updateCoupan->execute([$code, $userid]);
                        if($updateCoupan){
                          echo 'Done';  
                        }
                    }else {
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
                            }
                        }
                        
                        $couponCatArray = explode(', ',$category);
                        $matchArray=array_intersect($couponCatArray,$productArray);
                        if(count($matchArray)>0){
                            echo 'Done';
                        }else {
                            echo 'invalid-item';
                        }
                    }
                }else {
                    $getEmail = $conn->prepare('SELECT * FROM ogcustomer WHERE userid=?');
                    $getEmail->execute([$userid]);
                    while($um=$getEmail->fetch(PDO::FETCH_ASSOC)){
                        $email = $um['userid'];
                    }
                    $mailArray = explode(",",$usertype);
                    
                   
                    if (in_array($userid, $mailArray)){
                        if($category=='ALL'){
                        $updateCoupan = $conn->prepare("UPDATE ogcustomer set coupon=? where userid=?");
                        $updateCoupan->execute([$code, $userid]);
                        if($updateCoupan){
                        //   echo 'Done';  
                        }
                        }else {
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
                                }
                            }
                            
                            $couponCatArray = explode(', ',$category);
                            $matchArray=array_intersect($couponCatArray,$productArray);
                            if(count($matchArray)>0){
                                echo 'Done';
                            }else {
                                echo 'invalid-item';
                            }
                        }
                    }else {
                        echo "not-valid-for-account";
                    }
                }
            }
        }
    }

    if($_POST['btn']=='signup') {
        $fname =  test_input($_POST['fname']);
        $lname = test_input($_POST['lname']);
        $email = test_input($_POST['email']);
        $password = test_input($_POST['password']);
        $phone = test_input($_POST['phone']);
        $codepin = test_input($_POST['codepin']);
        
        if(!empty($fname)){
            if(!empty($lname)){
                if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
                    if(!empty($password)){
                        $password = password_hash($password,PASSWORD_DEFAULT);
                        if(!empty($phone)){
                            if(!empty($codepin)){
                                $userCountHere=$conn->prepare("SELECT * FROM ogcustomer WHERE email='$email'");
                                $userCountHere->execute();
                                $count = $userCountHere->rowCount();
                                if($count>0){
                                    echo json_encode(array("url"=>"Already Exist"));
                                }
                                else {
                                    $registerUser=$conn->prepare("UPDATE ogcustomer SET fname=?, lname=?, email=?, phone=?, password=? where userid=?");
                                    $registerUser->execute([$fname, $lname, $email, $codepin." ".$phone, $password, $userid]);
                                    if($registerUser) {
                                        echo json_encode(array("url"=>$_POST['url']));
                                        $_SESSION['IS_LOGIN']=true;
                                        $_SESSION['NAME']=$fname;
                                    	$_SESSION['EMAIL']=$email;
                                    	$_SESSION['USER_ID']=$userid;
                                    }
                                }
                            }else{
                                echo json_encode(array("url"=>"Cempty"));
                            }
                        }else {
                            echo json_encode(array("url"=>"Phempty"));
                        }
                    }else {
                        echo json_encode(array("url"=>"Pempty"));
                    }
                }else {
                    echo json_encode(array("url"=>"Eempty"));
                }
            }else {
                echo json_encode(array("url"=>"Lempty"));
            }
        }else {
            echo json_encode(array("url"=>"Fempty"));
        }
    }
    
    if($_POST['btn']=='sendOTP') {
        $email = test_input($_POST['email']);
        
                if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $userCountHere=$conn->prepare("SELECT * FROM ogcustomer WHERE email='$email'");
                        $userCountHere->execute();
                        $countUser = $userCountHere->rowCount();
                        if($countUser>0){
                            while($row=$userCountHere->fetch(PDO::FETCH_ASSOC)){
                                $otp = $row['otp'];
                                $otp1 = str_split($otp, 1);
                                $otp1 = implode("-", $otp1);
                                $name = $row['fname']." ".$row['lname'];
                                
                                
                            }
                            if(strlen($otp)>1){
                                echo "already set";
                                $msg1 = '
                                <div style=" max-height: 100vh; height: auto; background: #ededed; padding: 72px 0 72px 0; ">
                                    <div style=" background: white; padding: 25px; width: 62%; margin: 0 auto; ">
                                        <img src="https://myglobal1.gumlet.io/images/logo/global-logo-new-land-2.png?w=138" width="138px">
                                        <h1>Verify your login</h1>
                                        <p>Below is your one time passcode:</p>
                                        <h1>'.$otp1.'</h1>
                                        <p>We\'re here to help if you need it, Visit Newlands Pharmacy Support for more info or contact us.</p>
                                        <p>- Newlands Pharmacy Security</p>
                                    </div>
                                </div>
                                ';

                                $mailjetApiKey = 'a6e20f63603953cd9ca2349265d2304b';
                                $mailjetApiSecret = '4a228283087d8e09a63a01a990576bc3';
                                $messageData = [
                                        'Messages' => [
                                                [
                                                        'From' => [
                                                                'Email' => 'no-reply@'.$INFO_WEBSITE_NAME ,
                                                                'Name' => 'OTP-NewlandsPharmacy'
                                                        ],
                                                        'To' => [
                                                                [
                                                                        'Email' => $email,
                                                                        'Name' => $name
                                                                ]
                                                        ],
                                                        'Subject' => 'OTP - Newlands Pharmacy',
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
                            else {
                                $otp = rand(1000,6000);
                                $otp1 = str_split($otp, 1);
                                $otp1 = implode("-", $otp1);
                                $updateOTP=$conn->prepare("UPDATE ogcustomer SET otp='$otp' WHERE email='$email'");
                                $updateOTP->execute();
                                
                                $msg = '
                                <div style=" max-height: 100vh; height: auto; background: #ededed; padding: 72px 0 72px 0; ">
                                    <div style=" background: white; padding: 25px; width: 62%; margin: 0 auto; ">
                                        <img src="https://myglobal1.gumlet.io/images/logo/global-logo.png" width="138px">
                                        <h1>Verify your login</h1>
                                        <p>Below is your one time passcode:</p>
                                        <h1>'.$otp1.'</h1>
                                        <p>We\'re here to help if you need it, Visit Newlands Pharmacy Support for more info or contact us.</p>
                                        <p>- Newlands Pharmacy Security</p>
                                    </div>
                                </div>
                                ';

                                $mailjetApiKey = 'a6e20f63603953cd9ca2349265d2304b';
                                $mailjetApiSecret = '4a228283087d8e09a63a01a990576bc3';
                                $messageData = [
                                        'Messages' => [
                                                [
                                                        'From' => [
                                                                'Email' => 'no-reply@'.$INFO_WEBSITE_NAME ,
                                                                'Name' => 'OTP-NewlandsPharmacy'
                                                        ],
                                                        'To' => [
                                                                [
                                                                        'Email' => $email,
                                                                        'Name' => $name
                                                                ]
                                                        ],
                                                        'Subject' => 'OTP - Newlands Pharmacy',
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
                                
                                echo "done";
                            }
                        }else {
                            echo 'Not Found';
                        }
                }else {
                    echo 'Eempty';
                }
            }
    
    if($_POST['btn']=='signin') {
        $email = test_input($_POST['email']);
        $password = test_input($_POST['password']);
        $otp = test_input($_POST['otp']);
        if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
            if(!empty($password)){
                $userCountHere=$conn->prepare("SELECT * FROM ogcustomer WHERE email='$email'");
                $userCountHere->execute();
                $countUser = $userCountHere->rowCount();
                if($countUser>0){
                    while($row=$userCountHere->fetch(PDO::FETCH_ASSOC)){
                        $useremail = $row['email'];
                        $userpassword = $row['password'];
                        $name = $row['fname'];
                        $newUserId = $row['userid'];
                        if(($useremail===$email) && password_verify($password,$userpassword)){
                            $selectLoginOgProduct = $conn->prepare("SELECT * from ogcart where userId='$newUserId' && wishlist=0");
                            $selectLoginOgProduct->execute();
                            while($ogrow=$selectLoginOgProduct->fetch(PDO::FETCH_ASSOC)){
                                $ogProductId = $ogrow['id'];
                                $ogProductCode = $ogrow['productCode'];
                                $ogStrengthCode = $ogrow['strengthCode'];
                                $ogQuantityCode = $ogrow['quantityCode'];
                                $ogQuantity = $ogrow['quantity'];
                                $ogQuantityPrice = $ogrow['quantityPrice'];
                                $totalQuantity = $ogrow['totalQuantity'];
                                $totalPrice = $ogrow['totalPrice'];
                                
                                $selectLastOgProduct = $conn->prepare("SELECT * from ogcart where quantityCode='$ogQuantityCode' && userId='$userid' && wishlist=0");
                                $selectLastOgProduct->execute();
                                $exist = $selectLastOgProduct->rowCount();
                                if($exist>0){
                                    $deleteOgProduct=$conn->prepare("DELETE FROM ogcart WHERE id='$ogProductId' && wishlist=0");
                                    $deleteOgProduct->execute();
                                    $updateCartUser=$conn->prepare("UPDATE ogcart SET userId='$newUserId' WHERE wishlist=0");
                                    $updateCartUser->execute();
                                }else {
                                    $updateCartUser=$conn->prepare("UPDATE ogcart SET userId='$newUserId' WHERE wishlist=0");
                                    $updateCartUser->execute();
                                }
                                
                            }
                            
                            setcookie("userID",$newUserId,time()+31556926 ,'/');
                            echo json_encode(array("url"=>$_POST['url']));
                            $emptyOtp=$conn->prepare("UPDATE ogcustomer SET otp='0' WHERE email='$email'");
                            $emptyOtp->execute();
                            $_SESSION['IS_LOGIN']=true;
                            $_SESSION['NAME']=$name;
                            $_SESSION['EMAIL']=$email;
                            $_SESSION['USER_ID']=$newUserId;
                        }else {
                            echo json_encode(array("url"=>'Wrong Password'));
                        }
                    }
                }else {
                    echo json_encode(array("url"=>'Not Found'));
                }
            }elseif(!empty($otp)) {
                $userCountHere=$conn->prepare("SELECT * FROM ogcustomer WHERE email='$email'");
                $userCountHere->execute();
                while($row=$userCountHere->fetch(PDO::FETCH_ASSOC)){
                    $useremail = $row['email'];
                    $userotp = $row['otp'];
                    $name = $row['fname'];
                    $newUserId = $row['userid'];
                    if(($useremail===$email) && ($userotp===$otp)){
                        $selectLoginOgProduct = $conn->prepare("SELECT * from ogcart WHERE userId='".$newUserId."' && wishlist=0");
                            $selectLoginOgProduct->execute();
                            while($ogrow=$selectLoginOgProduct->fetch(PDO::FETCH_ASSOC)){
                                $ogProductId = $ogrow['id'];
                                $ogProductCode = $ogrow['productCode'];
                                $ogStrengthCode = $ogrow['strengthCode'];
                                $ogQuantityCode = $ogrow['quantityCode'];
                                $ogQuantity = $ogrow['quantity'];
                                $ogQuantityPrice = $ogrow['quantityPrice'];
                                $totalQuantity = $ogrow['totalQuantity'];
                                $totalPrice = $ogrow['totalPrice'];
                                
                                $selectLastOgProduct = $conn->prepare("SELECT * from ogcart WHERE userId='$userid' && wishlist=0");
                                $selectLastOgProduct->execute();
                                while($oldogrow=$selectLastOgProduct->fetch(PDO::FETCH_ASSOC)){
                                    $oldOgProductId = $oldogrow['id'];
                                    $oldOgProductQuantityCode = $oldogrow['quantityCode'];
                                }
                                if($oldOgProductQuantityCode==$ogQuantityCode){
                                    $deleteOgProduct=$conn->prepare("DELETE FROM ogcart WHERE id='$ogProductId' && wishlist=0");
                                    $deleteOgProduct->execute();
                                    $updateCartUser=$conn->prepare("UPDATE ogcart SET userId='$newUserId' WHERE id='$oldOgProductId' && wishlist=0");
                                    $updateCartUser->execute();
                                }else {
                                    $updateCartUser=$conn->prepare("UPDATE ogcart SET userId='$newUserId' WHERE id='$oldOgProductId' && wishlist=0");
                                    $updateCartUser->execute();
                                }
                                
                            }
                        setcookie("userID",$newUserId,time()+31556926 ,'/');
                        echo json_encode(array("url"=>$_POST['url']));
                        $emptyOtp=$conn->prepare("UPDATE ogcustomer SET otp='0' WHERE email='$email'");
                        $emptyOtp->execute();
                        $_SESSION['IS_LOGIN']=true;
                        $_SESSION['NAME']=$name;
                        $_SESSION['EMAIL']=$email;
                        $_SESSION['USER_ID']=$newUserId;
                    }else {
                        echo json_encode(array("url"=>'Wrong OTP'));
                    }
                }
            }elseif(empty($password)){
                echo json_encode(array("url"=>'Pempty'));
            }else {
                echo json_encode(array("url"=>'Oempty'));
            }
        }else {
            echo json_encode(array("url"=>'Eempty'));
        }
    }
    
    if($_POST['btn']=='addToCart'){
        $qtyCode =  test_input($_POST['code']);
        $wish = test_input($_POST['wish']);
        $discount = 0;
        $getCart = $conn->prepare('SELECT * FROM ogcart WHERE quantityCode=? && wishlist=? && userId=?');
        $getCart->execute([$qtyCode, 1, $userid]);
        $totalWishCart= $getCart->rowCount();
        if($wish==0){
            if($totalWishCart>0){
                $deleteCart = $conn->prepare('DELETE FROM ogcart WHERE quantityCode=? && wishlist=? && userId=?');
                $deleteCart->execute([$qtyCode, 1, $userid]);
            }
        }
        $getCart = $conn->prepare('SELECT * FROM ogcart WHERE quantityCode=? && wishlist=? && userId=?');
        $getCart->execute([$qtyCode, 1, $userid]);
        $totalWishCart= $getCart->rowCount();
        
        if($totalWishCart<1){
            $select_stmt1=$conn->prepare("SELECT * FROM ogquantity WHERE quantityCode='$qtyCode'");
            $select_stmt1->execute();
            while($row=$select_stmt1->fetch(PDO::FETCH_ASSOC)){
                $strengthCode = $row['strengthCode'];
                $productCode = $row['productCode'];

                $selectCat=$conn->prepare("SELECT * FROM ogproduct WHERE productCode = '$productCode'");
                $selectCat->execute();
                while($row1=$selectCat->fetch(PDO::FETCH_ASSOC)){
                    $name = $row1['productCategory']; 
                    $cat =  (explode(",",$name));
                    $category = array();
                    foreach($cat AS $x) {
                        array_push($category,"'".$x."'");
                    }

                    $categoryName = (implode(",",$category));
                    $proStrn = $row1['proStrn']; 
                    $type = $row['productType'];    
                }
                $selectOffer=$conn->prepare("SELECT * FROM discount WHERE code LIKE '%".$qtyCode."%' AND type='QTY'");
                $selectOffer->execute();
                $countOffer = $selectOffer->rowCount();
                if($countOffer<1){
                    $selectOffer=$conn->prepare("SELECT * FROM discount WHERE code LIKE '%".$strengthCode."%' AND type='STRN'");
                    $selectOffer->execute();
                    $countOffer = $selectOffer->rowCount();
                    
                    if($countOffer<1){
                        
                        $selectOffer=$conn->prepare("SELECT * FROM discount WHERE code LIKE '%".$productCode."%' AND type='PROD'");
                        $selectOffer->execute();
                        $countOffer = $selectOffer->rowCount();
                        if($countOffer<1){
                            $selectOffer=$conn->prepare("SELECT * FROM discount WHERE name IN ($categoryName) AND type='CAT'");
                            $selectOffer->execute();
                            $countOffer = $selectOffer->rowCount();
                            if($countOffer<1){
                                $selectOffer=$conn->prepare("SELECT * FROM discount WHERE type='ALL'");
                                $selectOffer->execute();
                                $countOffer = $selectOffer->rowCount();
                                if($countOffer<1){
                                    
                                }else {
                                    while($crow=$selectOffer->fetch(PDO::FETCH_ASSOC)){
                                        $discount = $crow['discount'];
                                        $newprice = ($row['price']-($row['price']*($discount/100)));
                                    }
                                }
                            }else {
                                while($crow=$selectOffer->fetch(PDO::FETCH_ASSOC)){
                                    $discount = $crow['discount'];
                                    $newprice = ($row['price']-($row['price']*($discount/100)));
                                }
                            }
                        }else {
                            while($crow=$selectOffer->fetch(PDO::FETCH_ASSOC)){
                                $discount = $crow['discount'];
                                $newprice = ($row['price']-($row['price']*($discount/100)));
                            }
                        }
                        
                    }
                    else {
                        while($crow=$selectOffer->fetch(PDO::FETCH_ASSOC)){
                            $discount = $crow['discount'];
                            $newprice = ($row['price']-($row['price']*($discount/100)));
                        }
                    }
                    
                }
                else {
                    while($crow=$selectOffer->fetch(PDO::FETCH_ASSOC)){
                        $discount = $crow['discount'];
                        $newprice = ($row['price']-($row['price']*($discount/100)));
                    }
                }
                
                if($discount>0){
                    $productCode = $row['productCode'];
                    $strengthCode = $row['strengthCode'];
                    $quantity = $row['quantity'];
                    $price = $row['price'];
                    $totalQuantity = 1;
                    $totalPrice = $quantity * $newprice;
                    $ogprice = $quantity * $price;
                    $saveAmt = $ogprice-$totalPrice;
                }else {
                    $productCode = $row['productCode'];
                    $strengthCode = $row['strengthCode'];
                    $quantity = $row['quantity'];
                    $price = $row['price'];
                    $totalQuantity = 1;
                    $totalPrice = $quantity * $price;
                    $ogprice = $quantity * $price;
                    $saveAmt = $ogprice-$totalPrice;
                }
            }

            $select_stmt2=$conn->prepare("INSERT into ogcart(productCode, strengthCode, quantityCode, quantity, quantityPrice, totalQuantity, totalPrice, total, discount, orgPrice, userId, saveAmount, wishlist) value(?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $select_stmt2->execute([$productCode, $strengthCode, $qtyCode, $quantity, $price, $totalQuantity, $totalPrice, $totalPrice, $discount, $ogprice, $userid, $saveAmt, $wish]);
            if($select_stmt2) {
                echo "done";
            }
            else {
                echo "notdone";
            }
        }else {
            echo "done";
        }
    }
    if($_POST['btn']=='addQunatity'){
        $qtyCode =  test_input($_POST['code']);
        $userid = test_input($_POST['userid']);

        $select_stmt1=$conn->prepare("SELECT * FROM ogcart WHERE quantityCode='$qtyCode' AND userId='$userid' AND wishlist=0");
        $select_stmt1->execute();
        while($row=$select_stmt1->fetch(PDO::FETCH_ASSOC)){
            $qty = $row['totalQuantity'];
            $price = $row['totalPrice'];
            $orgprice = $row['orgPrice'];
            $saveamt = $row['saveAmount'];
            $totalDisAmount = $row['total'];
            
            $prevSaveAmt = $saveamt/$qty;
            $prevOrgprice = $orgprice/$qty;
            $prevTotal = $totalDisAmount/$qty; 
            
            $qty = $qty+1;
            $saveAmt = $saveamt + $prevSaveAmt;
            $orgPrice = $orgprice + $prevOrgprice;
            
            $total = $totalDisAmount + $prevTotal;
            
            // $saveAmt = 
            // $qty = $qty+1;
            
            // $saveAmt = $saveamt + $saveamt;
            // $orgPrice = $orgprice + $orgprice;
            
            // $total = $totalDisAmount + $totalDisAmount;
            
            // $orgprice = $row['orgPrice'] + $row['totalPrice'] + $saveamt;
            // $saveamt = $row['saveAmount']*$qty;
        }
        $select_stmt2=$conn->prepare("UPDATE ogcart SET totalQuantity = '$qty', total = '$total', orgPrice='$orgPrice', saveAmount='$saveAmt' WHERE quantityCode='$qtyCode' AND userId='$userid' AND wishlist=0");
        $select_stmt2->execute();
    }
    if($_POST['btn']=='removeQunatity'){
        $qtyCode =  test_input($_POST['code']);
        $userid = test_input($_POST['userid']);

        $select_stmt1=$conn->prepare("SELECT * FROM ogcart WHERE quantityCode='$qtyCode' AND userId='$userid' AND wishlist=0");
        $select_stmt1->execute();
        while($row=$select_stmt1->fetch(PDO::FETCH_ASSOC)){
            echo $row['totalQuantity'];
            $qty1 = $row['totalQuantity'];
            $discount1 = $row['discount'];
            $qtyPrice1 = $row['quantity']*$row['quantityPrice'];
            
            $total1 =  $row['total'] - $row['totalPrice'];
            $orgPrice1 = $row['orgPrice']-$qtyPrice1;
            $disAmt1 = $row['quantityPrice']*($discount1/100);
            $saveAmt1 = $orgPrice1-$total1;
        }
        // $select_stmt2=$conn->prepare("UPDATE ogcart SET totalQuantity='$qty1' WHERE quantityCode='$qtyCode' AND userId='$userid'");
        // $select_stmt2->execute();
        if($qty1==1){
            $delete_from_cart=$conn->prepare("DELETE FROM ogcart WHERE quantityCode='$qtyCode' AND userId='$userid' AND wishlist=0");
            $delete_from_cart->execute();
        }else{
            $qty1=$qty1-1;
            $select_stmt2=$conn->prepare("UPDATE ogcart SET totalQuantity = '$qty1', orgPrice='$orgPrice1', saveAmount='$saveAmt1', total='$total1' WHERE quantityCode='$qtyCode' AND userId='$userid' AND wishlist=0");
            $select_stmt2->execute();
        }
    }
    
    if($_POST['btn']=="load_cart") {
        $select_stmt1=$conn->prepare("SELECT * FROM ogcart WHERE userID='$userid' AND wishlist=0 ORDER BY id DESC limit 3");
        $select_stmt1->execute();

        $cartCountHere=$conn->prepare("SELECT * FROM ogcart WHERE userID='$userid' && wishlist=0");
        $cartCountHere->execute();
        $count = $cartCountHere->rowCount();

        $cartstatus ='';
        $i=1;
        $cart = '';
            while($row=$select_stmt1->fetch(PDO::FETCH_ASSOC)){
                $i+1;
                if($row){
                    $cartstatus = "Active";
                    $cartId = $row['id'];
                    $productCode = $row['productCode'];
                    $strengthCode = $row['strengthCode'];
                    $quantityCode = $row['quantityCode'];
                    $quantity = $row['quantity'];
                    $quantityPrice = $row['quantityPrice'];
                    $totalQuantity = $row['totalQuantity'];
                    $totalPrice = $row['totalPrice'];
                    $orgprice = $row['orgPrice'];
                    $discount = $row['orgPrice'];
                    $saveAmt=$row['saveAmount'];
                    $select_product_details=$conn->prepare("SELECT * FROM ogproduct WHERE productCode='$productCode'");
                    $select_product_details->execute();
                    while($product=$select_product_details->fetch(PDO::FETCH_ASSOC)){
                        $productName = $product['productName'];
                        $productImage = $product['productImage'];
                        $productType = $product['productType'];
                    } 

                    $select_strength_details=$conn->prepare("SELECT * FROM ogstrength WHERE strengthCode='$strengthCode'");
                    $select_strength_details->execute();
                    while($strength=$select_strength_details->fetch(PDO::FETCH_ASSOC)){
                        $strengthName = $strength['strengthName'];
                    } 
                    $select_strength_details=$conn->prepare("SELECT SUM(total) AS totalPrice, sum(orgPrice) as orgprice, SUM(saveAmount) AS totalSaveAmt  FROM ogcart WHERE userID='$userid' && wishlist=0");
                    $select_strength_details->execute();
                    while($priceTotal=$select_strength_details->fetch(PDO::FETCH_ASSOC)){
                        $totalCartPrice =  $priceTotal['totalPrice'];
                        $totalOrgPrice = $priceTotal['orgprice'];
                        $totalSaveAmt = $priceTotal['totalSaveAmt'];
                    } 
                    
                     $cart .="
                    <div style='' data-simplebar data-simplebar-auto-hide='false'>
                        <div class='widget-cart-item pb-2 '>
                            <button class='btn-close text-danger' id='".$cartId."' onclick='removeFromCart(this)' type='button' aria-label='Remove'><span aria-hidden='true'>&times;</span></button>
                            <div class='d-flex align-items-center'><a class='d-block' href='cart'><img class='p-3' src='https://myglobal1.gumlet.io/onglobaladmincrm/{$productImage}' width='64' alt='Product'></a>
                            <div class='ps-2'>
                                <h6 class='widget-product-title'><a href='cart'>{$productName} {$strengthName} ({$quantity} {$productType})</a></h6>
                                <div class='widget-product-meta'>
                                    <span class='text-muted'>{$totalQuantity} x </span><span>".$_SESSION["currency_symbol"].number_format(($totalPrice*$_SESSION["currency_rate"]),2)."</span>
                                    <small style='margin-top: -8px;color: #e91e63 !important;font-size: 13px;font-weight: 500;'>";
                                    if($saveAmt>0){
                                        $cart .= "<del class='text-muted'>".$_SESSION["currency_symbol"].number_format(($orgprice*$_SESSION["currency_rate"]),2)."</del>";
                                         
                                    }
                                    $cart .= "</small>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    ";
                }
            }
            if($cartstatus=="Active"){
                echo "
                <div class='d-flex flex-wrap cart_bar_heading justify-content-between align-items-center py-3'>
                    <div class='fs-sm me-2 py-2'>
                        <p>
                        ORDER SUMMARY
                        </p>
                        <p class='user_id'>
                        User ID: $userid $seesion_login
                        </p>
                    </div>
                    <div class='fs-sm me-2 py-2' style='color:#000;'>
                        <p>{$count} item(s)</p>
                    </div>
                </div>
                ";
                echo $cart;
                if($count>3) {
                    $total_pro = $count-3;
                    echo "
                    <div class='py-2'>
                    <p class='more_items'>+ {$total_pro} more items in cart</p>
                    </div>   
                    ";
                }
                echo "
                <div class='d-flex justify-content-between align-items-end pt-3'>
                    <div class='fs-sm me-2 py-2'>
                    <span class='text-muted'>Total</span>
                    <div class='cart_total_container'>
                    <span class='text-dark cart_main_total fs-base ms-1' style='font-weight:700;'>".$_SESSION["currency_symbol"].number_format(($totalCartPrice*$_SESSION["currency_rate"]),2)."</span>
                    ";
                    if($totalSaveAmt>0){
                    echo "<small style='margin-top: -8px;color: #e91e63 !important;font-size: 13px;font-weight: 500;'>
                        <del class='text-muted'>".$_SESSION["currency_symbol"].number_format(($totalOrgPrice*$_SESSION["currency_rate"]),2)."</del>
                    </small></div>";
                    }

                    echo "</div>
                    <a class='btn cart_checkout_btn btn-primary btn-sm' href='cart'>
                        Confirm
                    </a>
                </div>
                ";
            }else {
                echo "
                    <div style='height:15rem; display: flex; align-items:center; flex-direction: column; justify-content:center;'>
                        <div class='img-box' style='width: 70px; padding: 14px 11px 0px 11px; background: #ebefee; overflow: hidden; border-radius: 40px; margin-bottom: 14px;'>
                            <img src='https://myglobal1.gumlet.io/images/cart.png'>
                        </div>
                        <p>No products in the cart.</p>
                    </div>
                ";
            }
    }

    if($_POST['btn']=="count_cart") {
        $rowCount=$conn->prepare("SELECT * FROM ogcart WHERE userID='$userid' && wishlist=0");
        $rowCount->execute();
        $count = $rowCount->rowCount();
        echo $count;
    }
    
    if($_POST['btn']=="load-shop-quantity") {
        $productCode = $_POST['productCode'];
        $strengthCode = $_POST['strengthCode'];
        $select_stmt=$conn->prepare("SELECT * FROM ogquantity WHERE strengthCode='$strengthCode' AND productCode='$productCode'");
        $select_stmt->execute();
        $i=0;
        while($row=$select_stmt->fetch(PDO::FETCH_ASSOC)){
            $i+1;
            $strengthCode = $row['strengthCode'];
            $productCode = $row['productCode'];
            $quantityCode = $row['quantityCode'];
            $quantity = $row['quantity'];
            $price = $row['price'];
            $cart = "
            <div class='form-check form-option form-check-inline mb-2'>
                <input class='form-check-input' onchange='shopAddCart(this)' data-quanityt='' type='radio' id='".$quantityCode.$i."' name=''>
                <label class='form-option-label' for='".$quantityCode.$i."'>{$quantity} | {$price}</label>
            </div>
                ";
            echo $cart;
        }
    }

    if($_POST['btn']=="load-checkout-product") {
        $i = 0;
        $sshipping = 0;
		$ushipping = 0;
		$gshipping = 0;
		$eshipping = 0;
		$tshipping = 0;
		
		$sprice = 0;
		$uprice = 0;
		$gprice = 0;
		$eprice = 0;
		
		$steroid=false;
		$ustous = false;
		$generic = false;
		$express = false;
		
		$steroidstore="";
		$ustousstore="";
		$genericstore="";
		
		$steroidstart="";
		$genericstart="";
		$ustousstart="";
		$expressstart="";
		
		$steroidend="";
		$genericend="";
		$ustousend="";
		$expressend="";
		
        $select_stmt1=$conn->prepare("SELECT * FROM ogcart WHERE userID='$userid' && wishlist=0 ORDER BY id DESC");
        $select_stmt1->execute();
        
        $select_stmt2=$conn->prepare("SELECT * FROM ogcart WHERE userID='$userid' && wishlist=0 ORDER BY id DESC");
        $select_stmt2->execute();
        while($row=$select_stmt2->fetch(PDO::FETCH_ASSOC)){
            $i+1;
            $randomstock = rand(5,9);
            if($row){
                $cartstatus = "Active";
                $cartId = $row['id'];
                $productCode = $row['productCode'];
                $strengthCode = $row['strengthCode'];
                $quantityCode = $row['quantityCode'];
                $quantity = $row['quantity'];
                $quantityPrice = $row['quantityPrice'];
                $totalQuantity = $row['totalQuantity'];
                $qty = $row['totalQuantity'];
                $totalPrice = $row['totalPrice'];
                $total = $row['total'];
                $discount = $row['discount'];
                $orgprice = $row['orgPrice'];
                
                $select_product_details=$conn->prepare("SELECT * FROM ogproduct WHERE productCode='$productCode'");
                $select_product_details->execute();
                while($product=$select_product_details->fetch(PDO::FETCH_ASSOC)){
                    $productName = $product['productName'];
                    $productImage = $product['productImage'];
                    $productCategory = $product['productCategory'];
                    $productType = $product['productType'];
                    $productlower = strtolower($productCategory);
                    $prductcategoryslug = str_replace(" ","-",$productlower);
                    $productSlug = $product['productSlug'];
                } 
                
                if(strpos($productCategory,'Steroids')>0){
                    $sprice  +=$total;
                }
                elseif(strpos($productName,'USA to USA')>0) {
                    $uprice  += $total;
                }
                elseif(strpos($productName,'Express')>0) {
                    $eprice  += $total;
                }
                else {
                    $gprice  += $total;
                }
            }
        }
        
        $cartCountHere=$conn->prepare("SELECT * FROM ogcart WHERE userID='$userid' && wishlist=0");
        $cartCountHere->execute();
        $count = $cartCountHere->rowCount();
        $cartstatus ='';
        $i=1;
        $cart = '';
        while($row=$select_stmt1->fetch(PDO::FETCH_ASSOC)){
            $i+1;
            $randomstock = rand(5,9);
            if($row){
                $cartstatus = "Active";
                $cartId = $row['id'];
                $productCode = $row['productCode'];
                $strengthCode = $row['strengthCode'];
                $quantityCode = $row['quantityCode'];
                $quantity = $row['quantity'];
                $quantityPrice = $row['quantityPrice'];
                $totalQuantity = $row['totalQuantity'];
                $qty = $row['totalQuantity'];
                $totalPrice = $row['totalPrice'];
                $total = $row['total'];
                $totalSave = $row['saveAmount'];
                
                $discount = $row['discount'];
                $orgprice = $row['orgPrice'];
    
                $select_product_details=$conn->prepare("SELECT * FROM ogproduct WHERE productCode='$productCode'");
                $select_product_details->execute();
                while($product=$select_product_details->fetch(PDO::FETCH_ASSOC)){
                    $productName = $product['productName'];
                    $productImage = $product['productImage'];
                    $productCategory = $product['productCategory'];
                    $productType = $product['productType'];
                } 
                
                $select_strength_details=$conn->prepare("SELECT * FROM ogstrength WHERE strengthCode='$strengthCode'");
                $select_strength_details->execute();
                while($strength=$select_strength_details->fetch(PDO::FETCH_ASSOC)){
                    $strengthName = $strength['strengthName'];
                } 
                $select_strength_details=$conn->prepare("SELECT SUM(total) AS totalPrice FROM ogcart WHERE userID='$userid' && wishlist=0");
                $select_strength_details->execute();
                while($priceTotal=$select_strength_details->fetch(PDO::FETCH_ASSOC)){
                    $totalCartPrice =  $priceTotal['totalPrice'];
                } 
                
                
                if(strpos($productCategory,'Steroids')>0){
                	if($sprice>0 && $sprice<=55){
                		$sshipping = 35;
                		$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b>15-18 Days</b>";
						$newprice = 56-$sprice;
						$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($sshipping*$_SESSION["currency_rate"]),2);
						$shipsuggestion = "&nbsp;Add worth ".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)." more & save <b>".$_SESSION["currency_symbol"].""."10"."</b> on Shipping";
                	}
                	elseif($sprice>=56 && $sprice<250){
                	    $sshipping = 25;
                		$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b>15-18 Days</b>";
						$newprice = 250-$sprice;
						$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($sshipping*$_SESSION["currency_rate"]),2);
						$shipsuggestion = "&nbsp;Add worth <b>".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)."</b> more and get FREE SHIPPPING";
					}
					elseif($sprice>=250){
					    $sshipping = 0;
                		$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b>15-18 Days</b>";
						$shipcharges = "<i class='fa-solid fa-dollar-sign></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
						$shipsuggestion = "&nbsp;Congrates! You got Free shipping";
					}
                }
                
                elseif(strpos($productName,'USA to USA')>0) {
    //             	if($suprice>0 && $uprice<=55){
    //             		$ushipping = 35;
    //             		$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b>7-10 Days</b>";
				// 		$newprice = 56-$uprice;
				// 		$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: $".$ushipping;
				// 		$shipsuggestion = "&nbsp;Add worth ".$newprice." more & save <b>$"."10"."</b> on Shipping";
    //             	}
    //             	elseif($uprice>=56 and $uprice<250){
    //             	    $ushipping = 25;
    //             		$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp;&nbsp; Shipping time is <b>7-10 Days</b>";
				// 		$newprice = 250-$uprice;
				// 		$shipcharges = "<i class='fa-solid fa-dollar-sign' style='font-size: 19px; color: #05970a;'></i>&nbsp;&nbsp;Shipping Charges: $".$ushipping;
				// 		$shipsuggestion = "&nbsp;Add worth <b>$".$newprice."</b> more and get FREE SHIPPPING";
				// 	}
				// 	elseif($uprice>250){
				// 	    $ushipping = 0;
    //             		$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b>7-10 Days</b>";
				// 		$shipcharges = "<i class='fa-solid fa-dollar-sign' style='font-size: 19px; color: #05970a;'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
				// 		$shipsuggestion = "&nbsp;&nbsp;Congrates! You got Free shipping";
				// 	}
				        $ushipping = 0;
                		$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b>7-10 Days</b>";
						$shipcharges = "<i class='fa-solid fa-dollar-sign' style='font-size: 19px; color: #05970a;'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
						$shipsuggestion = "&nbsp;&nbsp;Congrates! You got Free shipping";
                }
                
                else{
                	
                }
                
                
                if(strpos($productCategory,'Steroids')>0){
                    $steroid=true;
                	$steroidstore.="
                	    <div class='cart-main-product1'>
                            <div class='row py-1 product-row' style='/* border-bottom: 1px solid #d3d3d3; */'>
                               <div class='col-3 col-lg-2 text-center d-flex align-items-center'>
                                  <img src='https://myglobal1.gumlet.io/onglobaladmincrm/{$productImage}' alt=''>
                               </div>
                               <div class='col-7 col-lg-8' style='
                                  display: flex;
                                  flex-direction: column;
                                  justify-content: center;
                                  '>
                                  <a class='product-title' href='{$prductcategoryslug}/{$productSlug}'>{$productName} ({$strengthName})";
                                  if(intval($totalSave)>0){
                                    $steroidstore.= "<small style='background: #e91e63 !important;color: #fff;font-size: 10px;font-weight: 500;padding: 0px 11px 0px 11px;border-radius: 7px;margin-left: 5px;'>".$discount."%Off</small>";
                                  }
                                  $steroidstore.= "</a>
                                  <div class='product-data'>
                                     <div class='product-delivery'><span class='font-weight-600'>Quantity:
                                        </span><span class='delivery-alert'>{$quantity}</span>
                                     </div>
                                     <div class='product-delivery'><span class='font-weight-600'>Strength:
                                        </span><span class='delivery-alert'>{$strengthName}</span>
                                     </div>
                                  </div>
                               </div>
                               <div class='col-2 col-lg-2' style='display: flex;flex-direction: column;justify-content: center;align-items: end;'>
                                    <div class='product-pricing'>
                                        <span style='color:#000;font-weight: 700;font-size: 16px;padding-right: 8px;'>".$_SESSION["currency_symbol"].number_format(($total*$_SESSION["currency_rate"]),2)."</span>";
                                        if(intval($totalSave)>0){
                                            $steroidstore.="<small style='color: #e91e63 !important;font-size: 11px;padding-right: 13px;font-weight: 500;'><del>".$_SESSION["currency_symbol"].number_format(($orgprice*$_SESSION["currency_rate"]),2)."</del></small>";
                                        }
                                        
                                        $ustousstore.="
                                    </div>
                               </div>
                            </div>
                         </div>
                	";
                }
                elseif(strpos($productName,'USA to USA')>0){
            		$ustous = true;
                	$ustousstore.="
                	    <div class='cart-main-product1'>
                            <div class='row py-1 product-row' style='/* border-bottom: 1px solid #d3d3d3; */'>
                               <div class='col-3 col-lg-2 text-center d-flex align-items-center'>
                                  <img src='https://myglobal1.gumlet.io/onglobaladmincrm/{$productImage}' alt=''>
                               </div>
                               <div class='col-7 col-lg-8' style='
                                  display: flex;
                                  flex-direction: column;
                                  justify-content: center;
                                  '>
                                  <a class='product-title' href='{$prductcategoryslug}/{$productSlug}'>{$productName} ({$strengthName})";
                                  if(intval($totalSave)>0){
                                    $ustousstore.= "<small style='background: #e91e63 !important;color: #fff;font-size: 10px;font-weight: 500;padding: 0px 11px 0px 11px;border-radius: 7px;margin-left: 5px;'>".$discount."%Off</small>";
                                  }
                                  $ustousstore.= "</a>
                                  <div class='product-data'>
                                     <div class='product-delivery'><span class='font-weight-600'>Quantity:
                                        </span><span class='delivery-alert'>{$quantity}</span>
                                     </div>
                                     <div class='product-delivery'><span class='font-weight-600'>Strength:
                                        </span><span class='delivery-alert'>{$strengthName}</span>
                                     </div>
                                  </div>
                               </div>
                               <div class='col-2 col-lg-2' style='display: flex;flex-direction: column;justify-content: center;align-items: end;'>
                                    <div class='product-pricing'>
                                        <span style='color:#000;font-weight: 700;font-size: 16px;padding-right: 8px;'>".$_SESSION["currency_symbol"].number_format(($total*$_SESSION["currency_rate"]),2)."</span>";
                                if(intval($totalSave)>0){
                                    $ustousstore.="<small style='color: #e91e63 !important;font-size: 11px;padding-right: 13px;font-weight: 500;'><del>".$_SESSION["currency_symbol"].number_format(($orgprice*$_SESSION["currency_rate"]),2)."</del></small>";
                                }
                                
                                $ustousstore.="
                                        <!--<small> - ".$_SESSION["currency_symbol"].number_format(($totalPrice*$_SESSION["currency_rate"]),2)." <span class='quantity-count'>x {$totalQuantity}</small></span>-->
                                    </div>
                               </div>
                            </div>
                         </div>
                	";
                }
                elseif(strpos($productName,'Express')>0){
            		$express = true;
                	$expressstore.="
                	    <div class='cart-main-product1'>
                            <div class='row py-1 product-row' style='/* border-bottom: 1px solid #d3d3d3; */'>
                               <div class='col-3 col-lg-2 text-center d-flex align-items-center'>
                                  <img src='https://myglobal1.gumlet.io/onglobaladmincrm/{$productImage}' alt=''>
                               </div>
                               <div class='col-7 col-lg-8' style='
                                  display: flex;
                                  flex-direction: column;
                                  justify-content: center;
                                  '>
                                  <a class='product-title' href='{$prductcategoryslug}/{$productSlug}'>{$productName} ({$strengthName})";
                                  if(intval($totalSave)>0){
                                    $expressstore.= "<small style='background: #e91e63 !important;color: #fff;font-size: 10px;font-weight: 500;padding: 0px 11px 0px 11px;border-radius: 7px;margin-left: 5px;'>".$discount."%Off</small>";
                                  }
                                  $expressstore.= "</a>
                                  <div class='product-data'>
                                     <div class='product-delivery'><span class='font-weight-600'>Quantity:
                                        </span><span class='delivery-alert'>{$quantity}</span>
                                     </div>
                                     <div class='product-delivery'><span class='font-weight-600'>Strength:
                                        </span><span class='delivery-alert'>{$strengthName}</span>
                                     </div>
                                  </div>
                               </div>
                               <div class='col-2 col-lg-2' style='display: flex;flex-direction: column;justify-content: center;align-items: end;'>
                                    <div class='product-pricing'>
                                        <span style='color:#000;font-weight: 700;font-size: 16px;padding-right: 8px;'>".$_SESSION["currency_symbol"].number_format(($total*$_SESSION["currency_rate"]),2)."</span>";
                                if(intval($totalSave)>0){
                                    $expressstore.="<small style='color: #e91e63 !important;font-size: 11px;padding-right: 13px;font-weight: 500;'><del>".$_SESSION["currency_symbol"].number_format(($orgprice*$_SESSION["currency_rate"]),2)."</del></small>";
                                }
                                
                                $expressstore.="
                                        <!--<small> - ".$_SESSION["currency_symbol"].number_format(($totalPrice*$_SESSION["currency_rate"]),2)." <span class='quantity-count'>x {$totalQuantity}</small></span>-->
                                    </div>
                               </div>
                            </div>
                         </div>
                	";
                }
                else{
            		$generic = true;
                	$genericstore.="
                	    <div class='cart-main-product1'>
                            <div class='row py-1 product-row' style='/* border-bottom: 1px solid #d3d3d3; */'>
                               <div class='col-3 col-lg-2 text-center d-flex align-items-center'>
                                  <img src='https://myglobal1.gumlet.io/onglobaladmincrm/{$productImage}' alt=''>
                               </div>
                               <div class='col-7 col-lg-8' style='
                                  display: flex;
                                  flex-direction: column;
                                  justify-content: center;
                                  '>
                                  <a class='product-title' href='{$prductcategoryslug}/{$productSlug}'>{$productName} ({$strengthName})
                                  ";
                                  if(intval($totalSave)>0){
                                  $genericstore.= "<small style='background: #e91e63 !important;color: #fff;font-size: 10px;font-weight: 500;padding: 0px 11px 0px 11px;border-radius: 7px;margin-left: 5px;'>".$discount."%Off</small>";
                                  }
                                  $genericstore.= "
                                  </a>
                                  <div class='product-data'>
                                     <div class='product-delivery'><span class='font-weight-600'>Quantity:
                                        </span><span class='delivery-alert'>{$quantity}</span>
                                     </div>
                                     <div class='product-delivery'><span class='font-weight-600'>Strength:
                                        </span><span class='delivery-alert'>{$strengthName}</span>
                                     </div>
                                  </div>
                               </div>
                               <div class='col-2 col-lg-2' style='display: flex;flex-direction: column;justify-content: center;align-items: end;'>
                                    <div class='product-pricing'>
                                        <span style='color:#000;font-weight: 700;font-size: 16px;padding-right: 8px;'>".$_SESSION["currency_symbol"].number_format(($total*$_SESSION["currency_rate"]),2)."</span>
                                ";
                                if(intval($totalSave)>0){
                                    $genericstore.="<small style='color: #e91e63 !important;font-size: 11px;padding-right: 13px;font-weight: 500;'><del>".$_SESSION["currency_symbol"].number_format(($orgprice*$_SESSION["currency_rate"]),2)."</del></small>";
                                }
                                
                                $genericstore.="<!--<small> - ".$_SESSION["currency_symbol"].number_format(($totalPrice*$_SESSION["currency_rate"]),2)." <span class='quantity-count'>x {$totalQuantity}</small></span>-->
                                    </div>
                               </div>
                            </div>
                         </div>
                	";
                }
                
                }
            }
        if($steroid){
                echo '
                <div class="card mb-2">
                    <div class="product-cart">
                ';

                if($quantity>0 && $quantity<=5){
                    $sshipping = 20;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b> 15-18 Days </b>";
					//$newprice = 99-$sprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($sshipping*$_SESSION["currency_rate"]),2);
					$shipsuggestion = "&nbsp;Add worth ".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)." more & save <b>$"."5"."</b> on Shipping";
                }else{
                    $sshipping = 40;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b>15-18 Days</b>";
					//$newprice = 99-$sprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($sshipping*$_SESSION["currency_rate"]),2);
					$shipsuggestion = "&nbsp;Add worth ".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)." more & save <b>$"."40"."</b> on Shipping";
                }


                // if($sprice>0 && $sprice<99){
                // 	$sshipping = 20;
                // 	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b>15-18 Days</b>";
				// 	$newprice = 99-$sprice;
				// 	$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($sshipping*$_SESSION["currency_rate"]),2);
				// 	$shipsuggestion = "&nbsp;Add worth ".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)." more & save <b>".$_SESSION["currency_symbol"]."10"."</b> on Shipping";
                // }
                // if($sprice>=99 && $sprice<149){
                // 	$sshipping = 15;
                // 	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b>15-18 Days</b>";
				// 	$newprice = 149-$sprice;
				// 	$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($sshipping*$_SESSION["currency_rate"]),2);
				// 	$shipsuggestion = "&nbsp;Add worth ".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)." more & save <b>".$_SESSION["currency_symbol"]."10"."</b> on Shipping";
                // }
                // elseif($sprice>=149 && $sprice<199){
                // 	$sshipping = 10;
                // 	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b>15-18 Days</b>";
				// 	$newprice = 199-$sprice;
				// 	$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($sshipping*$_SESSION["currency_rate"]),2);
				// 	$shipsuggestion = "&nbsp;Add worth <b>".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)."</b> more and get FREE SHIPPPING";
				// }
				// elseif($sprice>=199){
				// 	$sshipping = 0;
                //     $shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b>15-18 Days</b>";
				// 	$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
				// 	$shipsuggestion = "&nbsp;Congrates! You got Free shipping";
				// }
                
                echo '<div class="product-heading d-none">Steroids <span class="addMore">'.$shipsuggestion.'</span></div>';
                echo $steroidstore;
                
                
                echo "</div></div>";
                echo "
                <div class='product-meta-details' style='display: flex;align-items: center;justify-content: flex-end;'>
                   <p class='shiptime'>".$shippingTime."</p>
                   <p class='shipcharge'>".$shipcharges."</p>
                </div>";
            }
            if($generic){
                echo '
                <div class="card mb-2">
                    <div class="product-cart">
                ';
                if($gprice>0 && $gprice<99){
                    $gshipping = 20;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b> 15-18 Days</b>";
					$newprice = 99-$gprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($gshipping*$_SESSION["currency_rate"]),2);
					$shipsuggestion = "&nbsp;Add worth ".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)." more & save <b>$"."5"."</b> on Shipping";
                }
                elseif($gprice>=99 && $gprice<149){
                    $gshipping = 15;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b> 15-18 Days</b>";
					$newprice = 149-$gprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($gshipping*$_SESSION["currency_rate"]),2);
					$shipsuggestion = "&nbsp;Add worth ".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)." more & save <b>$"."5"."</b> on Shipping";
                }
                elseif($gprice>=149 && $gprice<199){
                	$gshipping = 10;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp;&nbsp; Shipping time is <b> 15-18 Days</b>";
					$newprice = 199-$gprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($gshipping*$_SESSION["currency_rate"]),2);
					$shipsuggestion = "&nbsp;Add worth <b>".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)."</b> more and get FREE SHIPPPING";
				}
				elseif($gprice>=199){
					$gshipping = 0;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b> 15-18 Days</b>";
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
					$shipsuggestion = "&nbsp;Congrates! You got Free shipping";
				}
				
                echo '<div class="product-heading">Generic Medication <p class="addMore">'.$shipsuggestion.'</p></div>';
                
                echo $genericstore;
                
                echo "
                <div class='product-meta-details' style='display: flex;align-items: center;justify-content: flex-end;'>
                   <p class='shiptime'>".$shippingTime."</p>
                   <p class='shipcharge'>".$shipcharges."</p>
                </div>";
                echo "</div></div>";
            }
        if($express){
                echo '
                <div class="card mb-2">
                    <div class="product-cart">
                ';
                if($eprice>0 && $eprice<=55){
                    $eshipping = 35;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b> 10 Days</b>";
					$newprice = 56-$eprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($eshipping*$_SESSION["currency_rate"]),2);
					$shipsuggestion = "&nbsp;Add worth ".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)." more & save <b>".$_SESSION["currency_symbol"]."10"."</b> on Shipping";
                }
                elseif($eprice>=56 && $eprice<250){
                	$eshipping = 25;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp;&nbsp; Shipping time is <b> 10 Days</b>";
					$newprice = 250-$eprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($eshipping*$_SESSION["currency_rate"]),2);
					$shipsuggestion = "&nbsp;Add worth <b>".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)."</b> more and get FREE SHIPPPING";
				}
				elseif($eprice>=250){
					$eshipping = 0;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b> 10 Days</b>";
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
					$shipsuggestion = "&nbsp;Congrates! You got Free shipping";
				}
				
                echo '<div class="product-heading">Express Medication <p class="addMore">'.$shipsuggestion.'</p></div>';
                
                echo $expressstore;
                
                echo "
                <div class='product-meta-details' style='display: flex;align-items: center;justify-content: flex-end;'>
                   <p class='shiptime'>".$shippingTime."</p>
                   <p class='shipcharge'>".$shipcharges."</p>
                </div>";
                echo "</div></div>";
            }
        if($ustous){
                echo '
                <div class="card mb-2">
                    <div class="product-cart">
                ';
    //             if($suprice>0 && $uprice<=55){
    //             	$ushipping = 35;
    //             	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b>7-10 Days</b>";
				// 	$newprice = 56-$uprice;
				// 	$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: $".$ushipping;
				// 	$shipsuggestion = "&nbsp;Add worth ".$newprice." more & save <b>$"."10"."</b> on Shipping";
    //             }
    //             elseif($uprice>=56 and $uprice<250){
    //             	$ushipping = 25;
    //             	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp;&nbsp; Shipping time is <b>7-10 Days</b>";
				// 	$newprice = 250-$uprice;
				// 	$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;Shipping Charges: $".$ushipping;
				// 	$shipsuggestion = "&nbsp;Add worth <b>$".$newprice."</b> more and get FREE SHIPPPING";
				// }
				// elseif($uprice>250){
				// 	$ushipping = 0;
    //                 $shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b>7-10 Days</b>";
				// 	$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
				// 	$shipsuggestion = "&nbsp;Congrates! You got Free shipping";
				// }
				
				
				$ushipping = 0;
                $shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b>7-10 Days</b>";
				$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
				$shipsuggestion = "&nbsp;Congrates! You got Free shipping";
				
				
                echo '<div class="product-heading">USA to USA Medication <p class="addMore">'.$shipsuggestion.'</p></div>';
                echo $ustousstore;
                
                echo "
                <div class='product-meta-details' style='display: flex;align-items: center;justify-content: flex-end;'>
                   <p class='shiptime' style='display: flex;color: #03a9f4;align-items: center;'>.$shippingTime.</p>
                   <p class='shipcharge'>".$shipcharges."</p>
                </div>";
                echo "</div></div>";
            }
    }
    
    if($_POST['btn']=="coupanLoad") {
        $data1 = "
        <div class='card' style='border: 0px !important;'>";
        $select_strength_details=$conn->prepare("SELECT SUM(total) AS totalPrice FROM ogcart WHERE userID='$userid'");
        $select_strength_details->execute();
        while($priceTotal=$select_strength_details->fetch(PDO::FETCH_ASSOC)){
            $totalCartPrice =  $priceTotal['totalPrice'];
            $select_user_coupan = $conn->prepare("SELECT coupon FROM ogcustomer WHERE userid='$userid'");
            $select_user_coupan->execute();
            while($coupan=$select_user_coupan->fetch(PDO::FETCH_ASSOC)){
                $coupon = $coupan['coupon'];
            }
            if(empty($coupon)) {
                $data1 .= "
                               <h2 class='have-coupon' id='headingOne' href='#couponLoad' data-bs-toggle='modal'> <lord-icon src='https://cdn.lordicon.com/qrbokoyz.json' trigger='loop' colors='primary:#121331,secondary:#08a88a' style='width: 34px;height: auto !important; max-height: 43px; margin-top: -3px !important;'></lord-icon>  APPLY COUPON</h2>
                            </div>
                        ";
                $amtDiscount = 0;
            }
            else {
                if(!empty($coupon)){
                    $selectCouponData = $conn->prepare("SELECT * FROM coupons WHERE code='$coupon'");
                    $selectCouponData->execute();
                    while($coupanData=$selectCouponData->fetch(PDO::FETCH_ASSOC)){
                        $discount=$coupanData['discount'];
                        $orderAmount=$coupanData['minOrderAmount'];
                        $amtDiscount = $totalCartPrice*($discount/100); 
                        $maxAmount = $coupanData['maxDiscountAmount'];
                        $amtDiscount = $totalCartPrice*($discount/100);
                        if($amtDiscount>$maxAmount && !empty($maxAmount)){
                            $amtDiscount=$maxAmount;
                        }
                        $data1 .= "
                            <div class='coupanBox'>
                                <div class='coupanInfo'>
                                    <h2>
                                    <lord-icon src='https://assets9.lottiefiles.com/private_files/lf30_5rwze8mv.json' trigger='loop' colors='primary:#121331,secondary:#08a88a' style='width: 34px;height: auto !important; max-height: 45px !important; margin-bottom: 11px !important;'></lord-icon> ".$coupanData['code']."</h1> 
                                </div>
                                <div class='coupanRemove' onclick='removeCoupan()' data-bs-toggle='modal' style='cursor:pointer;'>
                                    REMOVE
                                </div>
                            </div>
                        ";
                    }
                }else {
                    if(empty($coupon)){
                        $data1 .= "
                               <h2 class='have-coupon' id='headingOne' href='#couponLoad' data-bs-toggle='modal'> <lord-icon src='https://cdn.lordicon.com/qrbokoyz.json' trigger='loop' colors='primary:#121331,secondary:#08a88a' style='width: 34px;height: auto !important;margin-top: -3px !important;'></lord-icon>  APPLY COUPON</h2>
                            </div>
                        ";
                    }
                }
                
            }
        }
        
        echo $data1;
    }
    
    if($_POST['btn']=="load-main-cart-product") {
        $i=0;
        $sshipping = 0;
		$ushipping = 0;
		$gshipping = 0;
		$eshipping = 0;
		$tshipping = 0;
		$sprice = 0;
		$uprice = 0;
		$gprice = 0;
        $eprice = 0;
		
		$steroid=false;
		$ustous = false;
		$generic = false;
		$express = false;
		
		$steroidstore="";
		$ustousstore="";
		$genericstore="";
		$expressstore="";
		
		$steroidstart="";
		$genericstart="";
		$ustousstart="";
		$expressstart="";
		
		$steroidend="";
		$genericend="";
		$ustousend="";
		$expressend="";
		
        $select_stmt1=$conn->prepare("SELECT * FROM ogcart WHERE userID='$userid' && wishlist=0 ORDER BY id DESC");
        $select_stmt1->execute();
        
        $select_stmt2=$conn->prepare("SELECT * FROM ogcart WHERE userID='$userid' && wishlist=0 ORDER BY id DESC");
        $select_stmt2->execute();
        while($row=$select_stmt2->fetch(PDO::FETCH_ASSOC)){
            $i+1;
            $randomstock = rand(5,9);
            if($row){
                $cartstatus = "Active";
                $cartId = $row['id'];
                $productCode = $row['productCode'];
                $strengthCode = $row['strengthCode'];
                $quantityCode = $row['quantityCode'];
                $quantity = $row['quantity'];
                $quantityPrice = $row['quantityPrice'];
                $totalQuantity = $row['totalQuantity'];
                $qty = $row['totalQuantity'];
                $totalPrice = $row['totalPrice'];
                $total = $row['total'];
                
                $select_product_details=$conn->prepare("SELECT * FROM ogproduct WHERE productCode='$productCode'");
                $select_product_details->execute();
                while($product=$select_product_details->fetch(PDO::FETCH_ASSOC)){
                    $productName = $product['productName'];
                    $productImage = $product['productImage'];
                    $productCategory = $product['productCategory'];
                    $productType = $product['productType'];
                } 
                
                if(strpos($productCategory,'Steroids')>0){
                    $sprice  +=$total;
                }
                elseif(strpos($productName,'USA to USA')>0) {
                    $uprice  += $total;
                }
                elseif(strpos($productName,'Express')>0) {
                    $eprice  += $total;
                }
                else {
                    $gprice  += $total;
                }
            }
        }
        
        $cartCountHere=$conn->prepare("SELECT * FROM ogcart WHERE userID='$userid' && wishlist=0");
        $cartCountHere->execute();
        $count = $cartCountHere->rowCount();

        $cartstatus ='';
        $i=1;
        $cart = '';
        while($row=$select_stmt1->fetch(PDO::FETCH_ASSOC)){
            $i+1;
            $randomstock = rand(5,9);
            if($row){
                $cartstatus = "Active";
                $cartId = $row['id'];
                $productCode = $row['productCode'];
                $strengthCode = $row['strengthCode'];
                $quantityCode = $row['quantityCode'];
                $quantity = $row['quantity'];
                $quantityPrice = $row['quantityPrice'];
                $totalQuantity = $row['totalQuantity'];
                $qty = $row['totalQuantity'];
                $totalPrice = $row['totalPrice'];
                $total = $row['total'];
                $orgprice = $row['orgPrice'];
                $totalSave = $row['saveAmount'];
                $discount = $row['discount'];
                $select_product_details=$conn->prepare("SELECT * FROM ogproduct WHERE productCode='$productCode'");
                $select_product_details->execute();
                while($product=$select_product_details->fetch(PDO::FETCH_ASSOC)){
                    $productName = $product['productName'];
                    $productImage = $product['productImage'];
                    $productCategory = $product['productCategory'];
                    $productType = $product['productType'];
                    $productlower = strtolower($productCategory);
                    $prductcategoryslug = str_replace(" ","-",$productlower);
                    $productSlug = $product['productSlug'];
                } 
                
                $select_strength_details=$conn->prepare("SELECT * FROM ogstrength WHERE strengthCode='$strengthCode'");
                $select_strength_details->execute();
                while($strength=$select_strength_details->fetch(PDO::FETCH_ASSOC)){
                    $strengthName = $strength['strengthName'];
                } 
                $select_strength_details=$conn->prepare("SELECT SUM(total) AS totalPrice FROM ogcart WHERE userID='$userid' && wishlist=0");
                $select_strength_details->execute();
                while($priceTotal=$select_strength_details->fetch(PDO::FETCH_ASSOC)){
                    $totalCartPrice =  $priceTotal['totalPrice'];
                } 
                
                
                if(strpos($productCategory,'Steroids')>0){

                    // echo "steriods condition";
                	if($sprice>0 && $sprice<=55){
                		$sshipping = 35;
                		$shippingTime =  "<i class='fa-solid fa-truck' style='color: #03a9f4 !important;'></i>&nbsp;&nbsp; Shipping time is <b>15-18 Days</b>";
						$newprice = 56-$sprice;
						$shipcharges = "<i class='fa-solid fa-dollar-sign' style='font-size: 19px; color: #05970a;'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: $".$sshipping;
						$shipsuggestion = "&nbsp;Add worth ".$newprice." more & save <b>$"."10"."</b> on Shipping";
                	}
                	elseif($sprice>=56 && $sprice<250){
                	    $sshipping = 25;
                		$shippingTime =  "<i class='fa-solid fa-truck' style='color: #03a9f4 !important;'></i>&nbsp;&nbsp; Shipping time is <b>15-18 Days</b>";
						$newprice = 250-$sprice;
						$shipcharges = "<i class='fa-solid fa-dollar-sign' style='font-size: 19px; color: #05970a;'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: $".$sshipping;
						$shipsuggestion = "&nbsp;Add worth <b>$".$newprice."</b> more and get FREE SHIPPPING";
					}
					elseif($sprice>=250){
					    $sshipping = 0;
                		$shippingTime =  "<i class='fa-solid fa-truck' style='color: #03a9f4 !important;'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b>15-18 Days</b>";
						$shipcharges = "<i class='fa-solid fa-dollar-sign' style='font-size: 19px; color: #05970a;'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
						$shipsuggestion = "&nbsp;Congrates! You got Free shipping";
					}
                }
                
                
                elseif(strpos($productName,'USA to USA')>0) {
    //             	if($suprice>0 && $uprice<=55){
    //             		$ushipping = 35;
    //             		$shippingTime =  "<i class='fa-solid fa-truck' style='color: #03a9f4 !important;'></i>&nbsp;&nbsp; Shipping time is <b>7-10 Days</b>";
				// 		$newprice = 56-$uprice;
				// 		$shipcharges = "<i class='fa-solid fa-dollar-sign' style='font-size: 19px; color: #05970a;'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: $".$ushipping;
				// 		$shipsuggestion = "&nbsp;Add worth ".$newprice." more & save <b>$"."10"."</b> on Shipping";
    //             	}
    //             	elseif($uprice>=56 and $uprice<250){
    //             	    $ushipping = 25;
    //             		$shippingTime =  "<i class='fa-solid fa-truck' style='color: #03a9f4 !important;'></i>&nbsp;&nbsp;&nbsp; Shipping time is <b>7-10 Days</b>";
				// 		$newprice = 250-$uprice;
				// 		$shipcharges = "<i class='fa-solid fa-dollar-sign' style='font-size: 19px; color: #05970a;'></i>&nbsp;&nbsp;Shipping Charges: $".$ushipping;
				// 		$shipsuggestion = "&nbsp;Add worth <b>$".$newprice."</b> more and get FREE SHIPPPING";
				// 	}
				// 	elseif($uprice>250){
				// 	    $ushipping = 0;
    //             		$shippingTime =  "<i class='fa-solid fa-truck' style='color: #03a9f4 !important;'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b>7-10 Days</b>";
				// 		$shipcharges = "<i class='fa-solid fa-dollar-sign' style='font-size: 19px; color: #05970a;'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
				// 		$shipsuggestion = "&nbsp;&nbsp;Congrates! You got Free shipping";
				// 	}
				        $ushipping = 0;
                		$shippingTime =  "<i class='fa-solid fa-truck' style='color: #03a9f4 !important;'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b>7-10 Days</b>";
						$shipcharges = "<i class='fa-solid fa-dollar-sign' style='font-size: 19px; color: #05970a;'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
						$shipsuggestion = "&nbsp;&nbsp;Congrates! You got Free shipping";
                }
                
                else{
                	
                }
                
                
                if(strpos($productCategory,'Steroids')>0){
                    $steroid=true;
                	$steroidstore.="
                	    <div class='cart-main-product1' style='padding: 0px 15px'>
                            <div class='row py-1 product-row' style='/* border-bottom: 1px solid #d3d3d3; */'>
                               <div class='col-3 col-lg-2 text-center d-flex align-items-center'>
                                  <img src='https://myglobal1.gumlet.io/onglobaladmincrm/{$productImage}' alt=''>
                               </div>
                               <div class='col-7 col-lg-4' style='
                                  display: flex;
                                  flex-direction: column;
                                  justify-content: center;
                                  '>
                                  <a class='product-title' href='{$prductcategoryslug}/{$productSlug}'>{$productName} ({$strengthName})</a>
                                  <div class='product-data'>
                                     <div class='product-delivery'><span class='font-weight-600'>Quantity:
                                        </span><span class='delivery-alert'>{$quantity}</span>
                                     </div>
                                     <div class='product-delivery'><span class='font-weight-600'>Strength:
                                        </span><span class='delivery-alert'>{$strengthName}</span>
                                     </div>
                                  </div>
                                  <div class='product-pricing'>
                                     <span style='color:#000;font-weight: 700;font-size: 16px;padding-right: 8px;'>".$_SESSION["currency_symbol"].number_format(($total*$_SESSION["currency_rate"]),2)."</span>
                                ";
                                if(intval($totalSave)>0){
                                    
                                    $steroidstore.= "<small style='margin-top: -8px;color: #e91e63 !important;font-size: 13px;font-weight: 500;'><del>".$_SESSION["currency_symbol"].number_format(($orgprice*$_SESSION["currency_rate"]),2)."</del></small>";
                                    $steroidstore.= "<small style='background: #e91e63 !important;color: #fff;font-size: 10px;font-weight: 500;padding: 0px 11px 0px 11px;border-radius: 7px;margin-left: 5px;'>".$discount."%Off</small>";
                                    
                                }
                                
                                 $steroidstore.= "</div>
                                  <div class='mob-action-cart pl-0 increment-buttons' style='display:flex;flex-direction: row !important;'>
                                    <div class='cart-button btn cart-new-btn' id='".$cartId."' style='padding: 3px 0px !important;'>
                                        <i class='ci-trash'></i>
                                    </div>
                                    <div class='cart-button btn cart-new-btn' id='".$cartId."' style='margin-top:2px; padding: 3px 0px !important;'>
                                        <i class='fa-solid fa-heart'></i>
                                    </div>
                                  </div>
                               </div>
                               <div class='col-2 col-lg-3' style='display: flex; align-items: flex-start; padding-left:0px !important; padding-right:3px !important; flex-direction: column; justify-content: center;'>
                                  <div class='product-pricing total-pricing d-flex py-2'>
                                     <div class='d-flex align-items-center pb-1'>
                                        <div class='pl-0 increment-buttons' style='display:flex; justify-content:center; padding-left:0 !important;'>
                                            <span onclick='decrement(this)' class='cart-dec-btn btn cart-new-btn d-block btn-light' data-qty='{$quantity}' data-qty-code={$quantityCode} data-user='{$userid}' id='dec' data-price=''>-</span>
                                            <div class='cart-button btn cart-new-btn btn-primary'>
                                                <span class='add-to-cart '></span>
                                                <span class='added added-{$quantityCode}' data-value='{$qty}'>{$qty}</span>
                                                <i class='fa fa-shopping-cart'></i>
                                            </div>
                                            <span onclick='increment(this)' class='cart-inc-btn btn cart-new-btn d-block btn-light' data-qty='{$quantity}' data-qty-code={$quantityCode} data-user='{$userid}' id='inc'>+</span>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                               <div class='col-12 col-lg-2 mt-2 cart-action-btn'>
                                  <button class='btn btn-outline-danger' id='".$cartId."' onclick='removeFromCart(this)'>Remove</button> 
                                ";
                                if(isset($_SESSION['IS_LOGIN']) && isset($_SESSION['EMAIL']) && isset($_SESSION['USER_ID'])){
                                 $steroidstore.="
                                  <button class='btn btn-outline-primary' id='".$cartId."' onclick='addToWishlist(this)'>Move To Wishlist</button>";
                                }else {
                                $steroidstore.="
                                  <button class='btn btn-outline-primary' id='".$cartId."' onclick='addToWishlist(this)'>Move To Wishlist</button>";
                                }
                                 $steroidstore.="
                               </div>
                            </div>
                         </div>
                	";
                }
                elseif(strpos($productName,'USA to USA')>0){
            		$ustous = true;
                	$ustousstore.="
                	    <div class='cart-main-product1'  style='padding: 0px 15px'>
                            <div class='row py-1 product-row' style='/* border-bottom: 1px solid #d3d3d3; */'>
                               <div class='col-3 col-lg-2 text-center d-flex align-items-center'>
                                  <img src='https://myglobal1.gumlet.io/onglobaladmincrm/{$productImage}' alt=''>
                               </div>
                               <div class='col-7 col-lg-4' style='
                                  display: flex;
                                  flex-direction: column;
                                  justify-content: center;
                                  '>
                                  <a class='product-title' href='{$prductcategoryslug}/{$productSlug}'>{$productName} ({$strengthName})</a>
                                  <div class='product-data'>
                                     <div class='product-delivery'><span class='font-weight-600'>Quantity:
                                        </span><span class='delivery-alert'>{$quantity}</span>
                                     </div>
                                     <div class='product-delivery'><span class='font-weight-600'>Strength:
                                        </span><span class='delivery-alert'>{$strengthName}</span>
                                     </div>
                                  </div>
                                  <div class='product-pricing'>
                                     <span style='color:#000;font-weight: 700;font-size: 16px;padding-right: 8px;'>".$_SESSION["currency_symbol"].number_format(($total*$_SESSION["currency_rate"]),2)."</span>
                                   ";
                                if(intval($totalSave)!=0){
                                
                                    $ustousstore.= "<small style='margin-top: -8px;color: #e91e63 !important;font-size: 13px;font-weight: 500;'><del>".$_SESSION["currency_symbol"].number_format(($orgprice*$_SESSION["currency_rate"]),2)."</del></small>";
                                    $ustousstore.= "<small style='background: #e91e63 !important;color: #fff;font-size: 10px;font-weight: 500;padding: 0px 11px 0px 11px;border-radius: 7px;margin-left: 5px;'>".$discount."%Off</small>";
                                }
                                
                                 $ustousstore.= "  
                                     
                                  </div>
                                  <div class='mob-action-cart pl-0 increment-buttons' style='display:flex;flex-direction: row !important;'>
                                    <div class='cart-button btn cart-new-btn' id='".$cartId."' style='padding: 3px 0px !important;'>
                                        <i class='ci-trash'></i>
                                    </div>
                                    <div class='cart-button btn cart-new-btn' id='".$cartId."' style='margin-top:2px; padding: 3px 0px !important;'>
                                        <i class='fa-solid fa-heart'></i>
                                    </div>
                                  </div>
                               </div>
                               <div class='col-2 col-lg-3' style='display: flex; align-items: flex-start; padding-left:0px !important; flex-direction: column; justify-content: center;'>
                                  <div class='product-pricing total-pricing d-flex py-2'>
                                     <div class='d-flex align-items-center pb-1'>
                                        <div class='pl-0 increment-buttons' style='display:flex; justify-content:center; padding-left:0 !important;'>
                                            <span onclick='decrement(this)' class='cart-dec-btn btn cart-new-btn d-block btn-light' data-qty='{$quantity}' data-qty-code={$quantityCode} data-user='{$userid}' id='dec' data-price=''>-</span>
                                            <div class='cart-button btn cart-new-btn btn-primary'>
                                                <span class='add-to-cart '></span>
                                                <span class='added added-{$quantityCode}' data-value='{$qty}'>{$qty}</span>
                                                <i class='fa fa-shopping-cart'></i>
                                            </div>
                                            <span onclick='increment(this)' class='cart-inc-btn btn cart-new-btn d-block btn-light' data-qty='{$quantity}' data-qty-code={$quantityCode} data-user='{$userid}' id='inc'>+</span>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                               <div class='col-12 col-lg-2 mt-2 cart-action-btn'>
                                  <button class='btn btn-outline-danger' id='".$cartId."' onclick='removeFromCart(this)'>Remove</button>";
                                    if(isset($_SESSION['IS_LOGIN']) && isset($_SESSION['EMAIL']) && isset($_SESSION['USER_ID'])){
                                     $ustousstore.="
                                      <button class='btn btn-outline-primary' id='".$cartId."' onclick='addToWishlist(this)'>Move To Wishlist</button>";
                                    }else {
                                    $ustousstore.="
                                      <button class='btn btn-outline-primary' id='".$cartId."' onclick='addToWishlist(this)'>Move To Wishlist</button>";
                                    }
                                $ustousstore.="
                               </div>
                            </div>
                         </div>
                	";
                }
                elseif(strpos($productName,'Express')>0){
            		$express = true;
                	$expressstore.="
                	    <div class='cart-main-product1'  style='padding: 0px 15px'>
                            <div class='row py-1 product-row' style='/* border-bottom: 1px solid #d3d3d3; */'>
                               <div class='col-3 col-lg-2 text-center d-flex align-items-center'>
                                  <img src='https://myglobal1.gumlet.io/onglobaladmincrm/{$productImage}' alt=''>
                               </div>
                               <div class='col-7 col-lg-4' style='
                                  display: flex;
                                  flex-direction: column;
                                  justify-content: center;
                                  '>
                                  <a class='product-title' href='{$prductcategoryslug}/{$productSlug}'>{$productName} ({$strengthName})</a>
                                  <div class='product-data'>
                                     <div class='product-delivery'><span class='font-weight-600'>Quantity:
                                        </span><span class='delivery-alert'>{$quantity}</span>
                                     </div>
                                     <div class='product-delivery'><span class='font-weight-600'>Strength:
                                        </span><span class='delivery-alert'>{$strengthName}</span>
                                     </div>
                                  </div>
                                  <div class='product-pricing'>
                                     <span style='color:#000;font-weight: 700;font-size: 16px;padding-right: 8px;'>".$_SESSION["currency_symbol"].number_format(($total*$_SESSION["currency_rate"]),2)."</span>
                                   ";
                                if(intval($totalSave)!=0){
                                
                                    $expressstore.= "<small style='margin-top: -8px;color: #e91e63 !important;font-size: 13px;font-weight: 500;'><del>".$_SESSION["currency_symbol"].number_format(($orgprice*$_SESSION["currency_rate"]),2)."</del></small>";
                                    $expressstore.= "<small style='background: #e91e63 !important;color: #fff;font-size: 10px;font-weight: 500;padding: 0px 11px 0px 11px;border-radius: 7px;margin-left: 5px;'>".$discount."%Off</small>";
                                }
                                
                                 $expressstore.= "  
                                     
                                  </div>
                                  <div class='mob-action-cart pl-0 increment-buttons' style='display:flex;flex-direction: row !important;'>
                                    <div class='cart-button btn cart-new-btn' id='".$cartId."' style='padding: 3px 0px !important;'>
                                        <i class='ci-trash'></i>
                                    </div>
                                    <div class='cart-button btn cart-new-btn' id='".$cartId."' style='margin-top:2px; padding: 3px 0px !important;'>
                                        <i class='fa-solid fa-heart'></i>
                                    </div>
                                  </div>
                               </div>
                               <div class='col-2 col-lg-3' style='display: flex; align-items: flex-start; padding-left:0px !important; flex-direction: column; justify-content: center;'>
                                  <div class='product-pricing total-pricing d-flex py-2'>
                                     <div class='d-flex align-items-center pb-1'>
                                        <div class='pl-0 increment-buttons' style='display:flex; justify-content:center; padding-left:0 !important;'>
                                            <span onclick='decrement(this)' class='cart-dec-btn btn cart-new-btn d-block btn-light' data-qty='{$quantity}' data-qty-code={$quantityCode} data-user='{$userid}' id='dec' data-price=''>-</span>
                                            <div class='cart-button btn cart-new-btn btn-primary'>
                                                <span class='add-to-cart '></span>
                                                <span class='added added-{$quantityCode}' data-value='{$qty}'>{$qty}</span>
                                                <i class='fa fa-shopping-cart'></i>
                                            </div>
                                            <span onclick='increment(this)' class='cart-inc-btn btn cart-new-btn d-block btn-light' data-qty='{$quantity}' data-qty-code={$quantityCode} data-user='{$userid}' id='inc'>+</span>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                               <div class='col-12 col-lg-2 mt-2 cart-action-btn'>
                                  <button class='btn btn-outline-danger' id='".$cartId."' onclick='removeFromCart(this)'>Remove</button>";
                                    if(isset($_SESSION['IS_LOGIN']) && isset($_SESSION['EMAIL']) && isset($_SESSION['USER_ID'])){
                                     $expressstore.="
                                      <button class='btn btn-outline-primary' id='".$cartId."' onclick='addToWishlist(this)'>Move To Wishlist</button>";
                                    }else {
                                    $expressstore.="
                                      <button class='btn btn-outline-primary' id='".$cartId."' onclick='addToWishlist(this)'>Move To Wishlist</button>";
                                    }
                                $expressstore.="
                               </div>
                            </div>
                         </div>
                	";
                }
                else{
            		$generic = true;
                	$genericstore.="
                	    <div class='cart-main-product1'  style='padding: 0px 15px'>
                            <div class='row py-1 product-row' style='/* border-bottom: 1px solid #d3d3d3; */'>
                               <div class='col-3 col-lg-2 text-center d-flex align-items-center'>
                                  <img src='https://myglobal1.gumlet.io/onglobaladmincrm/{$productImage}' alt=''>
                               </div>
                               <div class='col-7 col-lg-4' style='
                                  display: flex;
                                  flex-direction: column;
                                  justify-content: center;
                                  '>
                                  <a class='product-title' href='{$prductcategoryslug}/{$productSlug}'>{$productName} ({$strengthName})</a>
                                  <div class='product-data'>
                                     <div class='product-delivery'><span class='font-weight-600'>Quantity:
                                        </span><span class='delivery-alert'>{$quantity}</span>
                                     </div>
                                     <div class='product-delivery'><span class='font-weight-600'>Strength:
                                        </span><span class='delivery-alert'>{$strengthName}</span>
                                     </div>
                                  </div>
                                  <div class='product-pricing'>
                                     <span style='color:#000;font-weight: 700;font-size: 16px;padding-right: 8px;'>".$_SESSION["currency_symbol"].number_format(($total*$_SESSION["currency_rate"]),2)."</span>
                                     
                                  ";
                                if(intval($totalSave)>0){
                                    $genericstore.= "<small style='color: #e91e63 !important;font-size: 13px;font-weight: 500;'><del>".$_SESSION["currency_symbol"].number_format(($orgprice*$_SESSION["currency_rate"]),2)."</del></small>";
                                    $genericstore.= "<small style='background: #e91e63 !important;color: #fff;font-size: 10px;font-weight: 500;padding: 0px 11px 0px 11px;border-radius: 7px;margin-left: 5px;'>".$discount."%Off</small>";
                                }
                                
                                 $genericstore.= " 
                                     
                                  </div>
                                  <div class='mob-action-cart pl-0 increment-buttons' style='display:flex;flex-direction: row !important;'>
                                    <div class='cart-button btn cart-new-btn' id='".$cartId."' style='padding: 3px 0px !important;'>
                                        <i class='ci-trash'></i>
                                    </div>
                                    <div class='cart-button btn cart-new-btn' id='".$cartId."' style='margin-top:2px; padding: 3px 0px !important;'>
                                        <i class='fa-solid fa-heart'></i>
                                    </div>
                                  </div>
                               </div>
                               <div class='col-2 col-lg-3' style='display: flex; align-items: flex-start; flex-direction: column; justify-content: center;'>
                                  <div class='product-pricing total-pricing d-flex py-2'>
                                     <div class='d-flex align-items-center pb-1'>
                                        <div class='pl-0 increment-buttons' style='display:flex; justify-content:center; padding-left:0 !important;'>
                                            <span onclick='decrement(this)' class='cart-dec-btn btn cart-new-btn d-block btn-light' data-qty='{$quantity}' data-qty-code={$quantityCode} data-user='{$userid}' id='dec' data-price=''>-</span>
                                            <div class='cart-button btn cart-new-btn btn-primary'>
                                                <span class='add-to-cart '></span>
                                                <span class='added added-{$quantityCode}' data-value='{$qty}'>{$qty}</span>
                                                <i class='fa fa-shopping-cart'></i>
                                            </div>
                                            <span onclick='increment(this)' class='cart-inc-btn btn cart-new-btn d-block btn-light' data-qty='{$quantity}' data-qty-code={$quantityCode} data-user='{$userid}' id='inc'>+</span>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                               <div class='col-12 col-lg-2 mt-2 cart-action-btn'>
                                  <button class='btn btn-outline-danger' id='".$cartId."' onclick='removeFromCart(this)'>Remove</button> ";
                                  if(isset($_SESSION['IS_LOGIN']) && isset($_SESSION['EMAIL']) && isset($_SESSION['USER_ID'])){
                                     $genericstore.="
                                      <button class='btn btn-outline-primary' id='".$cartId."' onclick='addToWishlist(this)'>Move To Wishlist</button>";
                                    }else {
                                    $genericstore.="
                                      <button class='btn btn-outline-primary' id='".$cartId."' onclick='addToWishlist(this)'>Move To Wishlist</button>";
                                    }
                                    $genericstore.="
                               </div>
                            </div>
                         </div>
                	";
                }
                
                }
            }
        if($steroid){
                echo '
                <div class="card mb-2">
                    <div class="product-cart">';
                if($quantity>0 && $quantity<=5){
                    $sshipping = 20;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b> 15-18 Days </b>";
					//$newprice = 99-$sprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($sshipping*$_SESSION["currency_rate"]),2);
					$shipsuggestion = "&nbsp;Add worth ".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)." more & save <b>$"."5"."</b> on Shipping";
                }else{
                    $sshipping = 40;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b>15-18 Days</b>";
					//$newprice = 99-$sprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($sshipping*$_SESSION["currency_rate"]),2);
					$shipsuggestion = "&nbsp;Add worth ".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)." more & save <b>$"."40"."</b> on Shipping";
                }
                
                // if($sprice>0 && $sprice<99){
                // 	$sshipping = 30;
                // 	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b>15-18 Days</b>";
				// 	$newprice = 99-$sprice;
				// 	$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($sshipping*$_SESSION["currency_rate"]),2);
				// 	$shipsuggestion = "&nbsp;Add worth ".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)." more & save <b>$"."5"."</b> on Shipping";
                // }
                // elseif($sprice>=99 && $sprice<149){
                // 	$sshipping = 15;
                // 	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b>15-18 Days</b>";
				// 	$newprice = 99-$sprice;
				// 	$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($sshipping*$_SESSION["currency_rate"]),2);
				// 	$shipsuggestion = "&nbsp;Add worth ".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)." more & save <b>$"."5"."</b> on Shipping";
                // }
                // elseif($sprice>=149 && $sprice<=199){
                // 	$sshipping = 10;
                // 	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b>15-18 Days</b>";
				// 	$newprice = 199-$sprice;
				// 	$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($sshipping*$_SESSION["currency_rate"]),2);
				// 	$shipsuggestion = "&nbsp;Add worth <b>".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)."</b> more and get FREE SHIPPPING";
				// }
				// elseif($sprice>=199){
				// 	$sshipping = 0;
                //     $shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b>15-18 Days</b>";
				// 	$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
				// 	$shipsuggestion = "&nbsp;Congrates! You got Free shipping";
				// }

                echo '<div class="product-heading d-none">Steroids <span class="addMore">'.$shipsuggestion.'</span></div>';
                echo $steroidstore;
                
                echo "
                <div class='product-meta-details' style='display: flex;align-items: center;justify-content: flex-end;'>
                   <p class='shiptime'>".$shippingTime."</p>
                   <p class='shipcharge'>".$shipcharges."</p>
                </div>";
                echo "</div></div>";
            }
        if($generic){
                echo '
                <div class="card mb-2">
                    <div class="product-cart">
                ';
                if($gprice>0 && $gprice<99){
                    $gshipping = 20;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b> 15-18 Days</b>";
					$newprice = 99-$gprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($gshipping*$_SESSION["currency_rate"]),2);
					$shipsuggestion = "&nbsp;Add worth ".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)." more & save <b>$"."5"."</b> on Shipping";
                }
                if($gprice>=99 && $gprice<149){
                    $gshipping = 15;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b> 15-18 Days</b>";
					$newprice = 149-$gprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($gshipping*$_SESSION["currency_rate"]),2);
					$shipsuggestion = "&nbsp;Add worth ".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)." more & save <b>$"."5"."</b> on Shipping";
                }
                elseif($gprice>=149 && $gprice<199){
                	$gshipping = 10;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp;&nbsp; Shipping time is <b> 15-18 Days</b>";
					$newprice = 199-$gprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;Shipping Charges: ".$_SESSION["currency_symbol"].number_format(($gshipping*$_SESSION["currency_rate"]),2);
					$shipsuggestion = "&nbsp;Add worth <b>".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)."</b> more and get FREE SHIPPPING";
				}
				elseif($gprice>=199){
					$gshipping = 0;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b> 15-18 Days</b>";
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
					$shipsuggestion = "&nbsp;Congrates! You got Free shipping";
				}
				
                echo '<div class="product-heading">Generic Medication <p class="addMore">'.$shipsuggestion.'</p></div>';
                
                echo $genericstore;
                
                echo "
                <div class='product-meta-details' style='display: flex;align-items: center;justify-content: flex-end;'>
                   <p class='shiptime'>".$shippingTime."</p>
                   <p class='shipcharge'>".$shipcharges."</p>
                </div>";
                echo "</div></div>";
            }
        if($express){
                echo '
                <div class="card mb-2">
                    <div class="product-cart">
                ';
                if($eprice>0 && $eprice<99){
                    $eshipping = 20;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b> 10 Days</b>";
					$newprice = 99-$eprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: $".$_SESSION["currency_symbol"].number_format(($gshipping*$_SESSION["currency_rate"]),2);
					$shipsuggestion = "&nbsp;Add worth ".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)." more & save <b>$"."5"."</b> on Shipping";
                }
                elseif($eprice>=99 && $eprice<149){
                    $eshipping = 15;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b> 10 Days</b>";
					$newprice = 149-$eprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: $".$_SESSION["currency_symbol"].number_format(($gshipping*$_SESSION["currency_rate"]),2);
					$shipsuggestion = "&nbsp;Add worth ".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)." more & save <b>$"."5"."</b> on Shipping";
                }
                elseif($eprice>=149 && $eprice<199){
                	$eshipping = 10;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp;&nbsp; Shipping time is <b> 10 Days</b>";
					$newprice = 199-$eprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;Shipping Charges: $".$_SESSION["currency_symbol"].number_format(($gshipping*$_SESSION["currency_rate"]),2);
					$shipsuggestion = "&nbsp;Add worth <b>".$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2)."</b> more and get FREE SHIPPPING";
				}
				elseif($eprice>=199){
					$eshipping = 0;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b> 10 Days</b>";
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
					$shipsuggestion = "&nbsp;Congrates! You got Free shipping";
				}
				
                echo '<div class="product-heading">Express Medication <p class="addMore">'.$shipsuggestion.'</p></div>';
                
                echo $expressstore;
                
                echo "
                <div class='product-meta-details' style='display: flex;align-items: center;justify-content: flex-end;'>
                   <p class='shiptime'>".$shippingTime."</p>
                   <p class='shipcharge'>".$shipcharges."</p>
                </div>";
                echo "</div></div>";
            }    
        if($ustous){
                echo '
                <div class="card mb-2">
                    <div class="product-cart">
                ';
    //             if($suprice>0 && $uprice<=55){
    //             	$ushipping = 35;
    //             	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b>7-10 Days</b>";
				// 	$newprice = 56-$uprice;
				// 	$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: $".$ushipping;
				// 	$shipsuggestion = "&nbsp;Add worth ".$newprice." more & save <b>$"."10"."</b> on Shipping";
    //             }
    //             elseif($uprice>=56 and $uprice<250){
    //             	$ushipping = 25;
    //             	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp;&nbsp; Shipping time is <b>7-10 Days</b>";
				// 	$newprice = 250-$uprice;
				// 	$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;Shipping Charges: $".$ushipping;
				// 	$shipsuggestion = "&nbsp;Add worth <b>$".$newprice."</b> more and get FREE SHIPPPING";
				// }
				// elseif($uprice>250){
				// 	$ushipping = 0;
    //                 $shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b>7-10 Days</b>";
				// 	$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
				// 	$shipsuggestion = "&nbsp;Congrates! You got Free shipping";
				// }
				
				
				    $ushipping = 0;
                    $shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b>7-10 Days</b>";
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
					$shipsuggestion = "&nbsp;Congrates! You got Free shipping";
					
					
					
                echo '<div class="product-heading">USA to USA Medication <p class="addMore" style="font-size: 12px; color: #05970a; display: block; align-items: center; margin: 0px 9px 0 -4px !important;">'.$shipsuggestion.'</p></div>';
                echo $ustousstore;
                
                echo "
                <div class='product-meta-details' style='display: flex;align-items: center;justify-content: flex-end;'>
                   <p class='shiptime' style='display: flex;color: #03a9f4;align-items: center;'>.$shippingTime.</p>
                   <p class='shipcharge' style='display: flex;font-size: 12px;color: #05970a; margin: 0 7px 0 9px !important; align-items: center;/* margin-top: 7px; */'>".$shipcharges."</p>
                </div>";
                
            }
            echo "</div>
                </div><div style=' display: block; text-align: right; '> <button onclick='removeAllCart()' style=' background: #e8414e; color: #fff; border: 0px; padding: 1px 7px; font-size: 12px; border-radius: 2px; '>Clear Cart</button> </div>
                ";
    }

    if($_POST['btn']=="load-payment-amount") {
        $i=0;
        $gprice = 0;
        $sprice = 0;
        $uprice = 0;
        $eprice = 0;
        $sshipping = 0;
        $gshipping = 0;
        $ushipping = 0;
        $eshipping = 0;
        $select_stmt1=$conn->prepare("SELECT * FROM ogcart WHERE userID='$userid' && wishlist=0 ORDER BY id DESC limit 1");
        $select_stmt1->execute();

        $select_stmt2=$conn->prepare("SELECT * FROM ogcart WHERE userID='$userid' && wishlist=0 ORDER BY id DESC");
        $select_stmt2->execute();
        while($row=$select_stmt2->fetch(PDO::FETCH_ASSOC)){
            $i+1;
            $randomstock = rand(5,9);
            if($row){
                $cartstatus = "Active";
                $cartId = $row['id'];
                $productCode = $row['productCode'];
                $strengthCode = $row['strengthCode'];
                $quantityCode = $row['quantityCode'];
                $quantity = $row['quantity'];
                $quantityPrice = $row['quantityPrice'];
                $totalQuantity = $row['totalQuantity'];
                $qty = $row['totalQuantity'];
                $totalPrice = $row['totalPrice'];
                $total = $row['total'];
                
                $select_product_details=$conn->prepare("SELECT * FROM ogproduct WHERE productCode='$productCode'");
                $select_product_details->execute();
                while($product=$select_product_details->fetch(PDO::FETCH_ASSOC)){
                    $productName = $product['productName'];
                    $productImage = $product['productImage'];
                    $productCategory = $product['productCategory'];
                    $productType = $product['productType'];
                } 
                
                if(strpos($productCategory,'Steroids')>0){
                    
                    $sprice  +=$total;
                }
                elseif(strpos($productName,'USA to USA')>0 or strpos($productName,'US to US')>0) {
                    $uprice  += $total;
                }
                elseif(strpos($productName,'Express')>0 or strpos($productName,'express')>0) {
                    $eprice  += $total;
                }
                else{
                    $gprice  += $total;
                }
            }
        }

        $cartCountHere=$conn->prepare("SELECT * FROM ogcart WHERE userID='$userid' && wishlist=0");
        $cartCountHere->execute();
        $count = $cartCountHere->rowCount();

        $cartstatus ='';
        $i=1;
        $cart = '';
        while($row=$select_stmt1->fetch(PDO::FETCH_ASSOC)){
            $i+1;
            $randomstock = rand(5,9);
            if($row){
                $cartstatus = "Active";
                $productCode = $row['productCode'];
                $strengthCode = $row['strengthCode'];
                $quantityCode = $row['quantityCode'];
                $quantity = $row['quantity'];
                $quantityPrice = $row['quantityPrice'];
                $totalQuantity = $row['totalQuantity'];
                $qty = $row['totalQuantity'];
                $totalPrice = $row['totalPrice'];
                $total = $row['total'];

                $select_product_details=$conn->prepare("SELECT * FROM ogproduct WHERE productCode='$productCode'");
                $select_product_details->execute();
                while($product=$select_product_details->fetch(PDO::FETCH_ASSOC)){
                    $productName = $product['productName'];
                    $productImage = $product['productImage'];
                    $productType = $product['productType'];
                } 

                $select_strength_details=$conn->prepare("SELECT * FROM ogstrength WHERE strengthCode='$strengthCode'");
                $select_strength_details->execute();
                while($strength=$select_strength_details->fetch(PDO::FETCH_ASSOC)){
                    $strengthName = $strength['strengthName'];
                } 
                
                $select_strength_details=$conn->prepare("SELECT SUM(total) AS totalPrice, SUM(orgPrice) AS totalCartAmount, SUM(saveAmount) AS saveAmt FROM ogcart WHERE userID='$userid' && wishlist=0");
                $select_strength_details->execute();
                while($priceTotal=$select_strength_details->fetch(PDO::FETCH_ASSOC)){
                    $totalCartAmount =  $priceTotal['totalCartAmount'];
                    $totalCartPrice =  $priceTotal['totalPrice'];
                    $saveAmt = $priceTotal['saveAmt'];
                    $select_user_coupan = $conn->prepare("SELECT coupon FROM ogcustomer WHERE userid='$userid'");
                    $select_user_coupan->execute();
                    while($coupan=$select_user_coupan->fetch(PDO::FETCH_ASSOC)){
                        $coupon = $coupan['coupon'];
                    }
                    if($coupon=="") {
                        $amtDiscount = 0;
                        $code = '';
                    }
                    else {
                        $selectCouponData = $conn->prepare("SELECT * FROM coupons WHERE code='$coupon'");
                        $selectCouponData->execute();
                        while($coupanData=$selectCouponData->fetch(PDO::FETCH_ASSOC)){
                            $code=$coupanData['code'];
                            
                            $discount=$coupanData['discount'];
                            $orderAmount=$coupanData['minOrderAmount'];
                            $maxAmount = $coupanData['maxDiscountAmount'];
                            $amtDiscount = $totalCartPrice*($discount/100);
                            $disType = $coupanData['isTypePercentage'];
                            if($disType==1){
                                $amtDiscount = $totalCartPrice*($discount/100);
                                if($amtDiscount>$maxAmount &&!empty($maxAmount)){
                                    $amtDiscount=$maxAmount;
                                }
                            }else{
                                $amtDiscount=$discount;
                            }
                            if($amtDiscount>$maxAmount  && !empty($maxAmount)){
                                $amtDiscount=$maxAmount;
                            }
                            
                        }
                    }
                    if($totalCartPrice>=250) {
                        $shipcharge = "<span style='color:green;'>FREE</span>";
                        $shipamount = 0;
                        $discount = 0;
                    }
                    else if($totalCartPrice >= 650) {
                        $shipcharge = "<span style='color:green;'>FREE</span>";
                        $shipamount = 0;
                        $discount = 25;
                    }
                    else {
                        $shipcharge = "$25.00";
                        $shipamount = 25;
                        $discount = 0;
                    }

                } 
                
                if($sprice>0){

                    if($quantity>0 && $quantity<=5){
                        $sshipping = 20;
                    }else{
                        $sshipping = 40;
                    }

                    // if($quantity==1){
                    //     $sshipping = 20;
                    // }elseif($quantity==2){
                    //     $sshipping = 20;
                    // }elseif($quantity==3){
                    //     $sshipping = 20;
                    // }elseif($quantity==4){
                    //     $sshipping = 20;
                    // }elseif($quantity==5){
                    //     $sshipping = 20;
                    // }


                    // if($sprice>0 && $sprice<=99){
                    //     $sshipping = 20;
                    // }
                    // elseif($sprice>99 && $sprice<=149){
                    // 	$sshipping = 15;
    				// }
                    // elseif($sprice>149 && $sprice<=199){
                    // 	$sshipping = 10;
    				// }
    			    // elseif($sprice>199){
    				// 	 $sshipping = 0;
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
				
				$ushipping = 0;
                if(($sshipping+$gshipping+$ushipping+$eshipping)>0){
                $totalShippingNew = $_SESSION["currency_symbol"].number_format((($sshipping+$gshipping+$ushipping+$eshipping)*$_SESSION["currency_rate"]),2);
                }else {
                    $totalShippingNew = "<span style='color: green; font-weight: 700;'>FREE</span>";
                }

                if($_SESSION['thirdparty']){
                $cart = "
                    <div class='price-cart-align'>
                       <div>
                        <p class='offer-text-pas' style='color:#11AB36;'>Additional 20% Off Applied</p>
                       </div>
                    </div>
                ";
                }else {
                    echo $_SESSION['thirdparty'];
                }

                $getCartItem = $conn->prepare('SELECT * FROM ogcart WHERE userid=? && wishlist=0 ORDER BY id ASC');
                $getCartItem->execute([$userid]);
                while($rowCt=$getCartItem->fetch(PDO::FETCH_ASSOC)){
                    $productCode = $rowCt['productCode'];
                    $getPrname = $conn->prepare('SELECT * FROM ogproduct WHERE productCode=?');
                    $getPrname->execute([$productCode]);
                    while($rowPd=$getPrname->fetch(PDO::FETCH_ASSOC)){
                        $prnctname = $rowPd['productName'];
                    }
                    $cart.="
                    <div class='price-cart-align'>
                        <div>
                            <p class=''><b>".$prnctname."</b></p>
                            </div>
                            <div>
                            <p style='font-weight: 500;display: flex;flex-direction: column;text-align: right;'>".$_SESSION["currency_symbol"].number_format(($rowCt['orgPrice']*$_SESSION["currency_rate"]),2)."</p>
                        </div>
                    </div>
                    ";
                }
                if(strlen($code)>2){
                    $cart .= "
                    <div class='price-cart-align'>
                        <div>
                            <p class='' style='color:#119385; display: flex; align-items: end;'>Discount(<span style='color:blue; font-weight:600;'><i class='ci-lable'></i>&nbsp;$code</span>)</p>
                        </div>
                        <div>
                            <p class='discount-rate' style='color:green; font-weight: 700; '><span style='font-weight: 700;'>-</span>".$_SESSION["currency_symbol"].number_format((($amtDiscount+$saveAmt)*$_SESSION["currency_rate"]),2)."</p>
                        </div>
                    </div>
                    ";
                }else {
                    $cart .= "
                    <div class='price-cart-align'>
                        <div>
                            <p class='' style='color:#119385; display: flex; align-items: end;'>Discount</p>
                        </div>
                        <div>
                            <p class='discount-rate' style='color:green; font-weight: 700; '><span style='font-weight: 700;'>-</span>".$_SESSION["currency_symbol"].number_format((($amtDiscount+$saveAmt)*$_SESSION["currency_rate"]),2)."</p>
                        </div>
                    </div>
                    ";
                }
                
                $cart .= "
                    
                    
                    <div class='price-cart-align'>
                       <div>
                          <p class=''>Shipping Charges</p>
                       </div>
                       <div>
                          <p style='color: #000;'>".$totalShippingNew."</p>
                       </div>
                    </div>

                    <div class='price-cart-align d-none'>
                       <div>
                          <p class=''>Prescription Charges</p>
                       </div>
                       <div>
                          <p style='color:green; font-weight: 700; '>$0</p>
                       </div>
                    </div>

                    <div class='price-cart-align' style='border-top: 1px dashed; margin-top: 5px; padding-top: 2px;'>
                       <div>
                          <p class='price-label'>Total Price</p>
                       </div>
                       <div>
                          <p class='price-label-final'>".$_SESSION["currency_symbol"].number_format(((($totalCartPrice+($sshipping+$gshipping+$ushipping+$eshipping))-$amtDiscount)*$_SESSION["currency_rate"]),2) ."</p>
                       </div>
                    </div>
                    <div class='total-savings'>Total Savings ". $_SESSION["currency_symbol"].number_format(((floatval($amtDiscount)+floatval($saveAmt))*$_SESSION["currency_rate"]),2)."</div>
                    <div class='mt-3'>
                                            <a href='checkout' type='button' class='btn btn-proceed'>Proceed <svg
                                                    aria-hidden='true' focusable='false' data-prefix='far'
                                                    data-icon='arrow-right' role='img'
                                                    xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'
                                                    class='svg-arrow svg-inline--fa fa-arrow-right fa-w-14 fa-2x'>
                                                    <path fill='currentColor'
                                                        d='M218.101 38.101L198.302 57.9c-4.686 4.686-4.686 12.284 0 16.971L353.432 230H12c-6.627 0-12 5.373-12 12v28c0 6.627 5.373 12 12 12h341.432l-155.13 155.13c-4.686 4.686-4.686 12.284 0 16.971l19.799 19.799c4.686 4.686 12.284 4.686 16.971 0l209.414-209.414c4.686-4.686 4.686-12.284 0-16.971L235.071 38.101c-4.686-4.687-12.284-4.687-16.97 0z'
                                                        class=''></path>
                                                </svg></a>
                                        </div>
                    ";

                echo $cart;
                }
            }
    }


    if($_POST['btn']=="load-checkout-amount") {
        $i=0;
        $gprice = 0;
        $sprice = 0;
        $uprice = 0;
        $eprice = 0;
        $sshipping = 0;
        $gshipping = 0;
        $ushipping = 0;
        $eshipping = 0;
        $select_stmt1=$conn->prepare("SELECT * FROM ogcart WHERE userID='$userid' && wishlist=0 ORDER BY id DESC limit 1");
        $select_stmt1->execute();

        $select_stmt2=$conn->prepare("SELECT * FROM ogcart WHERE userID='$userid' && wishlist=0 ORDER BY id DESC");
        $select_stmt2->execute();
        while($row=$select_stmt2->fetch(PDO::FETCH_ASSOC)){
            $i+1;
            $randomstock = rand(5,9);
            if($row){
                $cartstatus = "Active";
                $cartId = $row['id'];
                $productCode = $row['productCode'];
                $strengthCode = $row['strengthCode'];
                $quantityCode = $row['quantityCode'];
                $quantity = $row['quantity'];
                $quantityPrice = $row['quantityPrice'];
                $totalQuantity = $row['totalQuantity'];
                $qty = $row['totalQuantity'];
                $totalPrice = $row['totalPrice'];
                $total = $row['total'];
                
                $select_product_details=$conn->prepare("SELECT * FROM ogproduct WHERE productCode='$productCode'");
                $select_product_details->execute();
                while($product=$select_product_details->fetch(PDO::FETCH_ASSOC)){
                    $productName = $product['productName'];
                    $productImage = $product['productImage'];
                    $productCategory = $product['productCategory'];
                    $productType = $product['productType'];
                } 
                
                if(strpos($productCategory,'Steroids')>0){
                    $sprice  +=$total;
                }
                elseif(strpos($productName,'USA to USA')>0 or strpos($productName,'US to US')>0) {
                    $uprice  += $total;
                }
                elseif(strpos($productName,'Express')>0 or strpos($productName,'express')>0) {
                    $eprice  += $total;
                }
                else{
                    $gprice  += $total;
                }
            }
        }

        $cartCountHere=$conn->prepare("SELECT * FROM ogcart WHERE userID='$userid' && wishlist=0");
        $cartCountHere->execute();
        $count = $cartCountHere->rowCount();

        $cartstatus ='';
        $i=1;
        $cart = '';
        while($row=$select_stmt1->fetch(PDO::FETCH_ASSOC)){
            $i+1;
            $randomstock = rand(5,9);
            if($row){
                $cartstatus = "Active";
                $productCode = $row['productCode'];
                $strengthCode = $row['strengthCode'];
                $quantityCode = $row['quantityCode'];
                $quantity = $row['quantity'];
                $quantityPrice = $row['quantityPrice'];
                $totalQuantity = $row['totalQuantity'];
                $qty = $row['totalQuantity'];
                $totalPrice = $row['totalPrice'];
                $total = $row['total'];

                $select_product_details=$conn->prepare("SELECT * FROM ogproduct WHERE productCode='$productCode'");
                $select_product_details->execute();
                while($product=$select_product_details->fetch(PDO::FETCH_ASSOC)){
                    $productName = $product['productName'];
                    $productImage = $product['productImage'];
                    $productType = $product['productType'];
                } 

                $select_strength_details=$conn->prepare("SELECT * FROM ogstrength WHERE strengthCode='$strengthCode'");
                $select_strength_details->execute();
                while($strength=$select_strength_details->fetch(PDO::FETCH_ASSOC)){
                    $strengthName = $strength['strengthName'];
                } 
                
                $select_strength_details=$conn->prepare("SELECT SUM(total) AS totalPrice, SUM(orgPrice) AS totalCartAmount, SUM(saveAmount) AS saveAmt FROM ogcart WHERE userID='$userid' && wishlist=0");
                $select_strength_details->execute();
                while($priceTotal=$select_strength_details->fetch(PDO::FETCH_ASSOC)){
                    $totalCartAmount =  $priceTotal['totalCartAmount'];
                    $totalCartPrice =  $priceTotal['totalPrice'];
                    $saveAmt = $priceTotal['saveAmt'];
                    $select_user_coupan = $conn->prepare("SELECT coupon FROM ogcustomer WHERE userid='$userid'");
                    $select_user_coupan->execute();
                    while($coupan=$select_user_coupan->fetch(PDO::FETCH_ASSOC)){
                        $coupon = $coupan['coupon'];
                    }
                    if($coupon=="") {
                        $amtDiscount = 0;
                        $code = '';
                    }
                    else {
                        $selectCouponData = $conn->prepare("SELECT * FROM coupons WHERE code='$coupon'");
                        $selectCouponData->execute();
                        while($coupanData=$selectCouponData->fetch(PDO::FETCH_ASSOC)){
                            $code=$coupanData['code'];
                            
                            $discount=$coupanData['discount'];
                            $orderAmount=$coupanData['minOrderAmount'];
                            $maxAmount = $coupanData['maxDiscountAmount'];
                            $amtDiscount = $totalCartPrice*($discount/100);
                            $disType = $coupanData['isTypePercentage'];
                            if($disType==1){
                                $amtDiscount = $totalCartPrice*($discount/100);
                                if($amtDiscount>$maxAmount && !empty($maxAmount)){
                                    $amtDiscount=$maxAmount;
                                }
                            }else{
                                $amtDiscount=$discount;
                            }
                            if($amtDiscount>$maxAmount  && !empty($maxAmount)){
                                $amtDiscount=$maxAmount;
                            }
                            
                        }
                    }
                    if($totalCartPrice>=250) {
                        $shipcharge = "<span style='color:green;'>FREE</span>";
                        $shipamount = 0;
                        $discount = 0;
                    }
                    else if($totalCartPrice >= 650) {
                        $shipcharge = "<span style='color:green;'>FREE</span>";
                        $shipamount = 0;
                        $discount = 25;
                    }
                    else {
                        $shipcharge = "$25.00";
                        $shipamount = 25;
                        $discount = 0;
                    }

                } 
                
                

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
                    // 	$sshipping = 15;
    				// }
                    // elseif($sprice>149 && $sprice<=199){
                    // 	$sshipping = 10;
    				// }
    			    // elseif($sprice>199){
    				// 	 $sshipping = 0;
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
				
				$ushipping = 0;
                if(($sshipping+$gshipping+$ushipping+$eshipping)>0){
                    $delChargesNewCheckout = $_SESSION["currency_symbol"].number_format((($sshipping+$gshipping+$ushipping+$eshipping)*$_SESSION["currency_rate"]),2);
                }else {
                    $delChargesNewCheckout = "<span style='color: green; font-weight: 700;'>FREE</span>";
                }

                $getCartItem = $conn->prepare('SELECT * FROM ogcart WHERE userid=? && wishlist=0 ORDER BY id ASC');
                $getCartItem->execute([$userid]);
                while($rowCt=$getCartItem->fetch(PDO::FETCH_ASSOC)){
                    $productCode = $rowCt['productCode'];
                    $getPrname = $conn->prepare('SELECT * FROM ogproduct WHERE productCode=?');
                    $getPrname->execute([$productCode]);
                    while($rowPd=$getPrname->fetch(PDO::FETCH_ASSOC)){
                        $prnctname = $rowPd['productName'];
                    }
                    $cart.="
                        <div class='price-cart-align'>
                            <div>
                                <p class=''><b>".$prnctname."</b></p>
                                </div>
                                <div>
                                <p style='font-weight: 500;display: flex;flex-direction: column;text-align: right;'>".$_SESSION["currency_symbol"].number_format(($rowCt['orgPrice']*$_SESSION["currency_rate"]),2)."</p>
                            </div>
                        </div>
                        ";
                }
                if(strlen($code)>2){
                    $cart .= "
                    <div class='price-cart-align'>
                        <div>
                            <p class='' style='color:#119385; display: flex; align-items: end;'>Discount(<span style='color:blue; font-weight:600;'><i class='ci-lable'></i>&nbsp;$code</span>)</p>
                        </div>
                        <div>
                            <p class='discount-rate' style='color:green; font-weight: 700; '><span style='font-weight: 700;'>-</span>".$_SESSION["currency_symbol"].number_format((($amtDiscount+$saveAmt)*$_SESSION["currency_rate"]),2)."</p>
                        </div>
                    </div>
                    ";
                }else {
                    $cart .= "
                    <div class='price-cart-align'>
                        <div>
                            <p class='' style='color:#119385; display: flex; align-items: end;'>Discount</p>
                        </div>
                        <div>
                            <p class='discount-rate' style='color:green; font-weight: 700; '><span style='font-weight: 700;'>-</span>".$_SESSION["currency_symbol"].number_format((($amtDiscount+$saveAmt)*$_SESSION["currency_rate"]),2)."</p>
                        </div>
                    </div>
                    ";
                }
                $cart .= "
                    
                    <div class='price-cart-align'>
                       <div>
                          <p class=''>Shipping Charges</p>
                       </div>
                       <div>
                          <p style='color: #119385; font-weight: 700;'>".$delChargesNewCheckout."</p>
                       </div>
                    </div>
                    <div class='price-cart-align d-none'>
                       <div>
                          <p class=''>Prescription Charges</p>
                       </div>
                       <div>
                          <p style='color:green; font-weight: 700; '>$0</p>
                       </div>
                    </div>
                    <div class='price-cart-align' style='border-top: 1px dashed; margin-top: 5px; padding-top: 2px;'>
                       <div>
                          <p class='price-label'>Total Price</p>
                       </div>
                       <div>
                          <p class='price-label-final'>".$_SESSION["currency_symbol"].number_format(((($totalCartPrice+($sshipping+$gshipping+$ushipping+$eshipping))-$amtDiscount)*$_SESSION["currency_rate"]),2) ."</p>
                       </div>
                    </div>
                    <div class='total-savings'>Total Savings ". $_SESSION["currency_symbol"].number_format(((floatval($amtDiscount)+floatval($saveAmt))*$_SESSION["currency_rate"]),2)."</div>
                    
                    ";

                echo $cart;
                }
            }
    }
    
    
    if($_POST['btn']=="load-wishlist-product") {
        $sshipping = 0;
		$ushipping = 0;
		$gshipping = 0;
		$tshipping = 0;
		$sprice = 0;
		$uprice = 0;
		$gprice = 0;
		
		$steroid=false;
		$ustous = false;
		$generic = false;
		
		$steroidstore="";
		$ustousstore="";
		$genericstore="";
		
		$steroidstart="";
		$genericstart="";
		$ustousstart="";
		
		$steroidend="";
		$genericend="";
		$ustousend="";
		
        $select_stmt1=$conn->prepare("SELECT * FROM ogcart WHERE userID='$userid' && wishlist=1 ORDER BY id DESC");
        $select_stmt1->execute();
        
        $select_stmt2=$conn->prepare("SELECT * FROM ogcart WHERE userID='$userid' && wishlist=1 ORDER BY id DESC");
        $select_stmt2->execute();
        while($row=$select_stmt2->fetch(PDO::FETCH_ASSOC)){
            $i+1;
            $randomstock = rand(5,9);
            if($row){
                $cartstatus = "Active";
                $cartId = $row['id'];
                $productCode = $row['productCode'];
                $strengthCode = $row['strengthCode'];
                $quantityCode = $row['quantityCode'];
                $quantity = $row['quantity'];
                $quantityPrice = $row['quantityPrice'];
                $totalQuantity = $row['totalQuantity'];
                $qty = $row['totalQuantity'];
                $totalPrice = $row['totalPrice'];
                $total = $row['total'];
                
                $select_product_details=$conn->prepare("SELECT * FROM ogproduct WHERE productCode='$productCode'");
                $select_product_details->execute();
                while($product=$select_product_details->fetch(PDO::FETCH_ASSOC)){
                    $productName = $product['productName'];
                    $productImage = $product['productImage'];
                    $productCategory = $product['productCategory'];
                    $productType = $product['productType'];
                } 
                
                if(strpos($productCategory,'Steroids')>0){
                    $sprice  +=$total;
                }
                elseif(strpos($productName,'USA to USA')>0) {
                    $uprice  += $total;
                }
                else {
                    $gprice  += $total;
                }
            }
        }
        
        $cartCountHere=$conn->prepare("SELECT * FROM ogcart WHERE userID='$userid' && wishlist=1");
        $cartCountHere->execute();
        $count = $cartCountHere->rowCount();

        $cartstatus ='';
        $i=1;
        $cart = '';
        while($row=$select_stmt1->fetch(PDO::FETCH_ASSOC)){
            $i+1;
            $randomstock = rand(5,9);
            if($row){
                $cartstatus = "Active";
                $cartId = $row['id'];
                $productCode = $row['productCode'];
                $strengthCode = $row['strengthCode'];
                $quantityCode = $row['quantityCode'];
                $quantity = $row['quantity'];
                $quantityPrice = $row['quantityPrice'];
                $totalQuantity = $row['totalQuantity'];
                $qty = $row['totalQuantity'];
                $totalPrice = $row['totalPrice'];
                $total = $row['total'];
                $orgprice = $row['orgPrice'];
                $totalSave = $row['saveAmount'];
                $discount = $row['discount'];
                $select_product_details=$conn->prepare("SELECT * FROM ogproduct WHERE productCode='$productCode'");
                $select_product_details->execute();
                while($product=$select_product_details->fetch(PDO::FETCH_ASSOC)){
                    $productName = $product['productName'];
                    $productImage = $product['productImage'];
                    $productCategory = $product['productCategory'];
                    $productType = $product['productType'];
                } 
                
                $select_strength_details=$conn->prepare("SELECT * FROM ogstrength WHERE strengthCode='$strengthCode'");
                $select_strength_details->execute();
                while($strength=$select_strength_details->fetch(PDO::FETCH_ASSOC)){
                    $strengthName = $strength['strengthName'];
                } 
                $select_strength_details=$conn->prepare("SELECT SUM(total) AS totalPrice FROM ogcart WHERE userID='$userid' && wishlist=1");
                $select_strength_details->execute();
                while($priceTotal=$select_strength_details->fetch(PDO::FETCH_ASSOC)){
                    $totalCartPrice =  $priceTotal['totalPrice'];
                } 
                
                
                if(strpos($productCategory,'Steroids')>0){
                	if($sprice>0 && $sprice<=55){
                		$sshipping = 35;
                		$shippingTime =  "<i class='fa-solid fa-truck' style='color: #03a9f4 !important;'></i>&nbsp;&nbsp; Shipping time is <b>15-18 Days</b>";
						$newprice = 56-$sprice;
						$shipcharges = "<i class='fa-solid fa-dollar-sign' style='font-size: 19px; color: #05970a;'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: $".$sshipping;
						$shipsuggestion = "&nbsp;Add worth ".$newprice." more & save <b>$"."10"."</b> on Shipping";
                	}
                	elseif($sprice>=56 && $sprice<250){
                	    $sshipping = 25;
                		$shippingTime =  "<i class='fa-solid fa-truck' style='color: #03a9f4 !important;'></i>&nbsp;&nbsp; Shipping time is <b>15-18 Days</b>";
						$newprice = 250-$sprice;
						$shipcharges = "<i class='fa-solid fa-dollar-sign' style='font-size: 19px; color: #05970a;'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: $".$sshipping;
						$shipsuggestion = "&nbsp;Add worth <b>$".$newprice."</b> more and get FREE SHIPPPING";
					}
					elseif($sprice>=250){
					    $sshipping = 0;
                		$shippingTime =  "<i class='fa-solid fa-truck' style='color: #03a9f4 !important;'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b>15-18 Days</b>";
						$shipcharges = "<i class='fa-solid fa-dollar-sign' style='font-size: 19px; color: #05970a;'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
						$shipsuggestion = "&nbsp;Congrates! You got Free shipping";
					}
                }
                
                elseif(strpos($productName,'USA to USA')>0) {
                	if($suprice>0 && $uprice<=55){
                		$ushipping = 35;
                		$shippingTime =  "<i class='fa-solid fa-truck' style='color: #03a9f4 !important;'></i>&nbsp;&nbsp; Shipping time is <b>7-10 Days</b>";
						$newprice = 56-$uprice;
						$shipcharges = "<i class='fa-solid fa-dollar-sign' style='font-size: 19px; color: #05970a;'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: $".$ushipping;
						$shipsuggestion = "&nbsp;Add worth ".$newprice." more & save <b>$"."10"."</b> on Shipping";
                	}
                	elseif($uprice>=56 and $uprice<250){
                	    $ushipping = 25;
                		$shippingTime =  "<i class='fa-solid fa-truck' style='color: #03a9f4 !important;'></i>&nbsp;&nbsp;&nbsp; Shipping time is <b>7-10 Days</b>";
						$newprice = 250-$uprice;
						$shipcharges = "<i class='fa-solid fa-dollar-sign' style='font-size: 19px; color: #05970a;'></i>&nbsp;&nbsp;Shipping Charges: $".$ushipping;
						$shipsuggestion = "&nbsp;Add worth <b>$".$newprice."</b> more and get FREE SHIPPPING";
					}
					elseif($uprice>250){
					    $ushipping = 0;
                		$shippingTime =  "<i class='fa-solid fa-truck' style='color: #03a9f4 !important;'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b>7-10 Days</b>";
						$shipcharges = "<i class='fa-solid fa-dollar-sign' style='font-size: 19px; color: #05970a;'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
						$shipsuggestion = "&nbsp;&nbsp;Congrates! You got Free shipping";
					}
                }
                
                else{
                	
                }
                
                
                if(strpos($productCategory,'Steroids')>0){
                    $steroid=true;
                	$steroidstore.="
                	    <div class='cart-main-product1' style='padding: 0px 15px'>
                            <div class='row py-1 product-row' style='/* border-bottom: 1px solid #d3d3d3; */'>
                               <div class='col-3 col-lg-2 text-center d-flex align-items-center'>
                                  <img src='https://myglobal1.gumlet.io/onglobaladmincrm/{$productImage}' alt=''>
                               </div>
                               <div class='col-7 col-lg-4' style='
                                  display: flex;
                                  flex-direction: column;
                                  justify-content: center;
                                  '>
                                  <a class='product-title'>{$productName} ({$strengthName})</a>
                                  <div class='product-data'>
                                     <div class='product-delivery'><span class='font-weight-600'>Quantity:
                                        </span><span class='delivery-alert'>{$quantity}</span>
                                     </div>
                                     <div class='product-delivery'><span class='font-weight-600'>Strength:
                                        </span><span class='delivery-alert'>{$strengthName}</span>
                                     </div>
                                  </div>
                                  <div class='product-pricing'>
                                     <span style='color:#000;font-weight: 700;font-size: 16px;padding-right: 8px;'>$".$total."</span>
                                ";
                                if(intval($totalSave)>0){
                                    
                                    $steroidstore.= "<small style='margin-top: -8px;color: #e91e63 !important;font-size: 13px;font-weight: 500;'><del>$".$orgprice."</del></small>";
                                }
                                
                                 $steroidstore.= "</div>
                                  
                               </div>
                               <div class='col-2 col-lg-3' style='display: flex; align-items: flex-start; padding-left:0px !important; padding-right:3px !important; flex-direction: column; justify-content: center;'>
                                  <div class='product-pricing total-pricing d-flex py-2'>
                                     <div class='d-flex align-items-center pb-1'>
                                        
                                     </div>
                                  </div>
                               </div>
                               <div class='col-12 col-lg-2 mt-2 cart-action-btn'>
                                  <button class='btn btn-success' id='".$cartId."' style=' background: #20c5be; border: 1px solid #20c5be; margin-right: 8px; font-size: 11px; padding: 5px 15px; ' onclick='againAddToCart(this)'>Add To Cart</button>  
                                  <button class='btn btn-danger' id='".$cartId."'  style=' background: #f04451; border: 1px solid #f04451; margin-right: 8px; font-size: 11px; padding: 5px 15px; ' onclick='removeWishList(this)'>Remove</button> 
                               </div>
                            </div>
                         </div>
                	";
                }
                elseif(strpos($productName,'USA to USA')>0){
            		$ustous = true;
                	$ustousstore.="
                	    <div class='cart-main-product1'  style='padding: 0px 15px'>
                            <div class='row py-1 product-row' style='/* border-bottom: 1px solid #d3d3d3; */'>
                               <div class='col-3 col-lg-2 text-center d-flex align-items-center'>
                                  <img src='https://myglobal1.gumlet.io/onglobaladmincrm/{$productImage}' alt=''>
                               </div>
                               <div class='col-7 col-lg-4' style='
                                  display: flex;
                                  flex-direction: column;
                                  justify-content: center;
                                  '>
                                  <a class='product-title'>{$productName} ({$strengthName})</a>
                                  <div class='product-data'>
                                     <div class='product-delivery'><span class='font-weight-600'>Quantity:
                                        </span><span class='delivery-alert'>{$quantity}</span>
                                     </div>
                                     <div class='product-delivery'><span class='font-weight-600'>Strength:
                                        </span><span class='delivery-alert'>{$strengthName}</span>
                                     </div>
                                  </div>
                                  <div class='product-pricing'>
                                     <span style='color:#000;font-weight: 700;font-size: 16px;padding-right: 8px;'>$".$total."</span>
                                   ";
                                if(intval($totalSave)!=0){
                                
                                    $ustousstore.= "<small style='margin-top: -8px;color: #e91e63 !important;font-size: 13px;font-weight: 500;'><del>$".$orgprice."</del></small>";
                                }
                                
                                 $ustousstore.= "  
                                     
                                  </div>
                                  
                               </div>
                               <div class='col-2 col-lg-3' style='display: flex; align-items: flex-start; padding-left:0px !important; flex-direction: column; justify-content: center;'>
                                  <div class='product-pricing total-pricing d-flex py-2'>
                                     <div class='d-flex align-items-center pb-1'>

                                     </div>
                                  </div>
                               </div>
                               <div class='col-12 col-lg-2 mt-2 cart-action-btn'>
                                  <button class='btn btn-success' id='".$cartId."' style=' background: #20c5be; border: 1px solid #20c5be; margin-right: 8px; font-size: 11px; padding: 5px 15px; ' onclick='againAddToCart(this)'>Add To Cart</button>  
                                  <button class='btn btn-danger' id='".$cartId."'  style=' background: #f04451; border: 1px solid #f04451; margin-right: 8px; font-size: 11px; padding: 5px 15px; ' onclick='removeWishList(this)'>Remove</button> 
                               </div>
                            </div>
                         </div>
                	";
                }
                else{
            		$generic = true;
                	$genericstore.="
                	    <div class='cart-main-product1'  style='padding: 0px 15px'>
                            <div class='row py-1 product-row' style='/* border-bottom: 1px solid #d3d3d3; */'>
                               <div class='col-3 col-lg-2 text-center d-flex align-items-center'>
                                  <img src='https://myglobal1.gumlet.io/onglobaladmincrm/{$productImage}' alt=''>
                               </div>
                               <div class='col-7 col-lg-4' style='
                                  display: flex;
                                  flex-direction: column;
                                  justify-content: center;
                                  '>
                                  <a class='product-title'>{$productName} ({$strengthName})</a>
                                  <div class='product-data'>
                                     <div class='product-delivery'><span class='font-weight-600'>Quantity:
                                        </span><span class='delivery-alert'>{$quantity}</span>
                                     </div>
                                     <div class='product-delivery'><span class='font-weight-600'>Strength:
                                        </span><span class='delivery-alert'>{$strengthName}</span>
                                     </div>
                                  </div>
                                  <div class='product-pricing'>
                                     <span style='color:#000;font-weight: 700;font-size: 16px;padding-right: 8px;'>$".$total."</span>
                                     
                                  ";
                                if(intval($totalSave)>0){
                                    $genericstore.= "<small style='color: #e91e63 !important;font-size: 13px;font-weight: 500;'><del>$".$orgprice."</del></small>";
                                    $genericstore.= "<small style='background: #e91e63 !important;color: #fff;font-size: 10px;font-weight: 500;padding: 0px 11px 0px 11px;border-radius: 7px;margin-left: 5px;'>".$discount."%Off</small>";
                                }
                                
                                 $genericstore.= " 
                                     
                                  </div>
                               </div>
                               <div class='col-2 col-lg-3' style='display: flex; align-items: flex-start; flex-direction: column; justify-content: center;'>
                                  <div class='product-pricing total-pricing d-flex py-2'>
                                     
                                  </div>
                               </div>
                               <div class='col-12 col-lg-2 mt-2 cart-action-btn'>
                                  <button class='btn btn-success' id='".$cartId."' style=' background: #20c5be; border: 1px solid #20c5be; margin-right: 8px; font-size: 11px; padding: 5px 15px; ' onclick='againAddToCart(this)'>Add To Cart</button> 
                                  <button class='btn btn-danger' id='".$cartId."'  style=' background: #f04451; border: 1px solid #f04451; margin-right: 8px; font-size: 11px; padding: 5px 15px; ' onclick='removeWishList(this)'>Remove</button> 
                               </div>
                            </div>
                         </div>
                	";
                }
                
                }
            }
        if($steroid){
                echo '
                <div class="card mb-2">
                    <div class="product-cart">
                ';
                if($sprice>0 && $sprice<=55){
                	$sshipping = 35;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b>15-18 Days</b>";
					$newprice = 56-$sprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: $".$sshipping;
					$shipsuggestion = "&nbsp;Add worth ".$newprice." more & save <b>$"."10"."</b> on Shipping";
                }
                elseif($sprice>=56 && $sprice<250){
                	$sshipping = 25;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b>15-18 Days</b>";
					$newprice = 250-$sprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: $".$sshipping;
					$shipsuggestion = "&nbsp;Add worth <b>$".$newprice."</b> more and get FREE SHIPPPING";
				}
				elseif($sprice>=250){
					$sshipping = 0;
                    $shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b>15-18 Days</b>";
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
					$shipsuggestion = "&nbsp;Congrates! You got Free shipping";
				}
                echo '<div style="padding: 6px 0 4px 0;" class="product-heading">Steroids</div>';
                echo $steroidstore;
                
                // echo "
                // <div class='product-meta-details' style='display: flex;align-items: center;justify-content: flex-end;'>
                //   <p class='shiptime'>.$shippingTime.</p>
                //   <p class='shipcharge'>".$shipcharges."</p>
                // </div>";
                echo "</div></div>";
            }
        if($generic){
                echo '
                <div class="card mb-2">
                    <div class="product-cart">
                ';
                if($gprice>0 && $gprice<=55){
                    $gshipping = 35;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b> 15-18 Days</b>";
					$newprice = 56-$gprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: $".$gshipping;
					$shipsuggestion = "&nbsp;Add worth $".$newprice." more & save <b>$"."10"."</b> on Shipping";
                }
                elseif($gprice>=56 && $gprice<250){
                	$gshipping = 25;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp;&nbsp; Shipping time is <b> 15-18 Days</b>";
					$newprice = 250-$gprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;Shipping Charges: $".$gshipping;
					$shipsuggestion = "&nbsp;Add worth <b>$".$newprice."</b> more and get FREE SHIPPPING";
				}
				elseif($gprice>=250){
					$gshipping = 0;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b> 15-18 Days</b>";
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
					$shipsuggestion = "&nbsp;Congrates! You got Free shipping";
				}
				
                echo '<div style="padding: 6px 0 4px 0;" class="product-heading">Generic Medication</div>';
                
                echo $genericstore;
                
                // echo "
                // <div class='product-meta-details' style='display: flex;align-items: center;justify-content: flex-end;'>
                //   <p class='shiptime'>.$shippingTime.</p>
                //   <p class='shipcharge'>".$shipcharges."</p>
                // </div>";
                echo "</div></div>";
            }
        if($ustous){
                echo '
                <div class="card mb-2">
                    <div class="product-cart">
                ';
                if($suprice>0 && $uprice<=55){
                	$ushipping = 35;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is <b>7-10 Days</b>";
					$newprice = 56-$uprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: $".$ushipping;
					$shipsuggestion = "&nbsp;Add worth ".$newprice." more & save <b>$"."10"."</b> on Shipping";
                }
                elseif($uprice>=56 and $uprice<250){
                	$ushipping = 25;
                	$shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp;&nbsp; Shipping time is <b>7-10 Days</b>";
					$newprice = 250-$uprice;
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;Shipping Charges: $".$ushipping;
					$shipsuggestion = "&nbsp;Add worth <b>$".$newprice."</b> more and get FREE SHIPPPING";
				}
				elseif($uprice>250){
					$ushipping = 0;
                    $shippingTime =  "<i class='fa-solid fa-truck'></i>&nbsp;&nbsp; Shipping time is&nbsp; <b>7-10 Days</b>";
					$shipcharges = "<i class='fa-solid fa-dollar-sign'></i>&nbsp;&nbsp;&nbsp;Shipping Charges: <b> FREE</b>";
					$shipsuggestion = "&nbsp;Congrates! You got Free shipping";
				}
                echo '<div style="padding: 6px 0 4px 0;"  class="product-heading">USA to USA Medication</div>';
                echo $ustousstore;
                
                // echo "
                // <div class='product-meta-details' style='display: flex;align-items: center;justify-content: flex-end;'>
                //   <p class='shiptime' style='display: flex;color: #03a9f4;align-items: center;'>.$shippingTime.</p>
                //   <p class='shipcharge' style='display: flex;font-size: 12px;color: #05970a; margin: 0 7px 0 9px !important; align-items: center;/* margin-top: 7px; */'>".$shipcharges."</p>
                // </div>";
                echo "</div></div>
                ";
            }
            echo "
            <div style=' display: block; text-align: right; '> <button onclick='removeWishListAll()' style=' background: #e8414e; color: #fff; border: 0px; padding: 1px 7px; font-size: 12px; border-radius: 2px; '>Clear Wishlist</button> </div>
            ";
    }
    
    if($_POST['btn']=="orderNow") {
        $orderId = "INV".date("ymdhis");
        $timestamp = date("Y-m-d H:i:s");
        $oldcrmtimestamp = date("d/m/Y");
        $fname = test_input($_POST['first-name']);
        $lname = test_input($_POST['last-name']);
        $email = test_input($_POST['email']);
        $phone = test_input($_POST['phone']);
        $addressline1 = test_input($_POST['addressLine1']);
        $addressline2 = test_input($_POST['addressLine2']);
        $country = test_input($_POST['country']);
        $state = test_input($_POST['state']);
        $city = test_input($_POST['city']);
        $postalCode = test_input($_POST['postalCode']);
        if(!empty($fname)){
            if(!empty($lname)){
                if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
                    if(!empty($phone)){
                        $phone =  $_POST['codepin']."-".$phone;
                        if(!empty($addressline1)) {
                            if(!empty($country)) {
                                if(!empty($state)) {
                                    if(!empty($city)) {
                                        if(!empty($postalCode)) {
                                            $servername = "162.214.198.68";
                                            $username = "onegloba_glomedz";
                                            $password = "Kumarakshay@195";
                                            $dbname = "onegloba_globalmedz";
                                                
                                            // Create connection
                                            $oldCrmConn = new mysqli($servername, $username, $password, $dbname);
                                            // Check connection
                                            if ($oldCrmConn->connect_error) {
                                                    die("Connection failed: " . $conn->connect_error);
                                            }
                                            else {
                                            }
                                            $insertCustomer=$conn->prepare("INSERT into ogcustomer(userid, fname, lname, email, phone) value(?,?,?,?,?)");
                                            $insertCustomer->execute([$userid, $fname, $lname, $email, $phone]);
                                            if($insertCustomer) {
                                                
                                                $select_country=$conn->prepare("SELECT * FROM countries WHERE country_id = '$country'");
                                                $select_country->execute();
                                                while($row=$select_country->fetch(PDO::FETCH_ASSOC)){
                                            		$countryName=$row['country_name'];
                                                }
                                                
                                                $select_state=$conn->prepare("SELECT * FROM states WHERE state_id = '$state'");
                                                $select_state->execute();
                                                while($row=$select_state->fetch(PDO::FETCH_ASSOC)){
                                            		$stateName=$row['state_name'];
                                                }
                                                
                                                $select_city=$conn->prepare("SELECT * FROM cities WHERE city_id = '$city'");
                                                $select_city->execute();
                                                while($row=$select_city->fetch(PDO::FETCH_ASSOC)){
                                            		$cityName=$row['city_name'];
                                                }
                                                
                                                $insertAddress = $conn->prepare("INSERT into ogaddress(userid, fname, lname, email, phone, addressline1, addressline2, city, country, state, postalcode) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
                                                
                                                $insertAddress->execute([$userid, $fname, $lname, $email, $phone, $addressline1, $addressline2, $cityName, $countryName, $stateName, $postalCode]);
                                                if($insertAddress) {
                                                    $selectCartProduct=$conn->prepare("SELECT * FROM ogcart WHERE userId= '$userid' && wishlist=0");
                                                    $selectCartProduct->execute();
                                                    while($row=$selectCartProduct->fetch(PDO::FETCH_ASSOC)){
                                                		$productCode = $row['productCode'];
                                                		$strengthCode = $row['strengthCode'];
                                                		$quantityCode = $row['quantityCode'];
                                                		$quantity = $row['quantity'];
                                                		$quantityPrice = $row['quantityPrice'];
                                                		$totalQuantity = $row['totalQuantity'];
                                                		$totalPrice = $row['totalPrice'];
                                                		$total = $row['total'];
                                                		
                                                		$selectProductName=$conn->prepare("SELECT * FROM ogproduct WHERE productCode= '$productCode'");
                                                        $selectProductName->execute();
                                                        while($row=$selectProductName->fetch(PDO::FETCH_ASSOC)){
                                                    		$productName=$row['productName'];
                                                        }
                                                        
                                                        $selectStrengthName=$conn->prepare("SELECT * FROM ogstrength WHERE strengthCode= '$strengthCode'");
                                                        $selectStrengthName->execute();
                                                        while($row=$selectStrengthName->fetch(PDO::FETCH_ASSOC)){
                                                    		$strengthName=$row['strengthName'];
                                                        }
                                                        
                                                        $selectQuantity=$conn->prepare("SELECT * FROM ogquantity WHERE quantityCode= '$quantityCode'");
                                                        $selectQuantity->execute();
                                                        while($row=$selectQuantity->fetch(PDO::FETCH_ASSOC)){
                                                    		$quantityName=$row['quantity'];
                                                        }
                                                		
                                                		$newStrength = $productName." ".$strengthName; 
                                                		
                                                		$getOldData="SELECT * FROM pdetails WHERE strength LIKE '%$newStrength%'";
                                                        $oldProductResult = $oldCrmConn->query($getOldData);
                                                        while($productRow = $oldProductResult->fetch_assoc())
                                                        {
                                                            $strengthid = $productRow['pid'];
                                                        }
                                                        
                                                        // $getCustId = "SELECT * FROM shippinginfo ORDER BY sid DESC limit 1";
                                                        // $lastCustId = $oldCrmConn->query($getCustId);
                                                        // while($custidrow = $lastCustId->fetch_assoc())
                                                        // {
                                                        //     $custid = $custidrow['cid'];
                                                        //     $custid++;
                                                            
                                                        //     $insertshipping = "INSERT INTO shippinginfo(cid,email, fname, lname, address, city, state, country, zip, phone, payby) VALUES($custid, $email, $fname, $lname, $addressline1.' '.$addressline2, $city, $state, $country, $postalCode, $phone, 'Pay by credit or debit card')";
                                                        //     if($oldCrmConn->query($insertshipping)){
                                                        //         $insertorders = "INSERT INTO orders(cust_id, orderno, orderdate, payment_mode, order_value, shipping, total, user_ip, payment_link, status) VALUES($custid, $orderId, $oldcrmtimestamp, 'Credit Card', '255', '255', '255', ' ', ' ', 'Pending', )" ;
                                                        //         if($oldCrmConn->query($insertorders)){
                                                        //             $lastid = $oldCrmConn->insert_id;
                                                        //             echo "Customer ID:".$custid;
                                                        //             $getOldData1="SELECT * FROM `tblproductdetails` WHERE strength='$strengthid' and qty='$quantityName'";
                                                        //             $oldProductResult = $oldCrmConn->query($getOldData1);
                                                        //             while($productRow1 = $oldProductResult->fetch_assoc())
                                                        //             {
                                                        //                 $catid = $productRow1['cid'];
                                                        //                 $productid = $productRow1['pid'];
                                                        //                 $strengthid = $productRow1['strength'];
                                                        //                 echo "Catid:".$catid." | productid:".$productid." | strengthid : ".$strengthid;
                                                        //                 $insertToOldCrm = "INSERT INTO order_details(order_id, cid, pid, strength, qty, price) VALUES($lastid, $catid, $productid, $strengthid, $quantity*$totalQuantity, $quantityPrice)";
                                                        //                 if ($oldCrmConn->query($insertToOldCrm) === TRUE) {
                                                        //                   echo "New record created successfully";
                                                        //                 } else {
                                                        //                   echo "Error: " . $insertToOldCrm . "<br>" . $oldCrmConn->error;
                                                        //                 }
                                                        //             }
                                                                    
                                                        //         }else {
                                                        //         echo "Error: " . $insertshipping . "<br>" . $conn->error;
                                                        //     }
                                                                
                                                        //     }else {
                                                        //         echo "Error: " . $insertshipping . "<br>" . $conn->error;
                                                        //     }
                                                        // }
                                                        
                                                        
                                                        
                                                        // $insertToOldCrm = "INSERT INTO order_details(order_id, cid, pid, strength, qty, price)"
                                                		
                                                		$insertProduct = $conn->prepare("INSERT into ogorderproduct(orderid, productCode, quantityCode, strengthCode, quantity, quantityPrice, totalQuantity, totalPrice, total, userId) 
                                                		VALUES(?,?,?,?,?,?,?,?,?,?)");
                                                        $insertProduct->execute([$orderId, $productCode, $quantityCode, $strengthCode, $quantity, $quantityPrice, $totalQuantity, $totalPrice, $total, $userid]);
                                                        
                                                        if($insertProduct){
                                                            $allProductPrice=$conn->prepare("SELECT SUM(total) AS totalPrice FROM ogcart WHERE userID='$userid' && wishlist=0");
                                                            $allProductPrice->execute();
                                                            while($priceTotal=$allProductPrice->fetch(PDO::FETCH_ASSOC)){
                                                                $totalCartPrice =  $priceTotal['totalPrice'];
                                                                if($totalCartPrice>=250) {
                                                                    $shipping = 0;
                                                                    $total = $totalCartPrice + $shipping;
                                                                }
                                                                else {
                                                                    $shipping = 25;
                                                                    $total = $totalCartPrice + $shipping;
                                                                }
                                                            } 
                                                            $insertOrderDetails = $conn->prepare("INSERT INTO orderdetails(orderid, userid, subtotal, dcharge, discount, total, paymentMethod, paidAmount, paymentStatus, orderStatus, orderDate) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
                                                            $insertOrderDetails->execute(['#'.$orderId, $userid, $totalCartPrice, $shipping, '0', $total, 'paypal', '0', 'Unpaid', 'Pending demo', $timestamp]);
                                                            if($insertOrderDetails){
                                                                echo "done";
                                                                
                                                                $deleteCart = $conn->prepare("DELETE FROM ogcart WHERE userId= '$userid' && wishlist=0");
                                                                $deleteCart->execute();
                                                                
                                                                $_SESSION['userLogin'] = "True";
                                                                $_SESSION['userid']=$userid;
                                                                $sentMail = new MailSmsOtp();
                                                                $sentMail->mail($email, 'Thank You For Order.', $msg);
                                                            }
                                                            else {
                                                                echo "Fail";
                                                            }
                                                        }else {
                                                            
                                                        }
                                                    }
                                                }else {
                                                    echo "Not Insert Address";
                                                }
                                            }
                                            else {
                                                echo "Not Inserted";
                                            }
                                        }else {
                                            echo "Postal Code Empty";
                                        } 
                                    }else {
                                        echo "city empty";
                                    } 
                                }else {
                                    echo "state empty";
                                } 
                            }else {
                                echo "country empty";
                            }   
                        }else {
                            echo "Address empty";
                        }
                    }else {
                        echo "phone empty";
                    }
                }else {
                    echo "email empty";
                }
            }else {
                echo "lname empty";
            }
        }
        else {
            echo "fname empty";
        }
    }
    
    if($_POST['btn']=='addCoupan'){
        $coupon =  test_input($_POST['code']);
        $selectCouponData = $conn->prepare("SELECT * FROM coupons WHERE code='$coupon' AND status='1'");
        $selectCouponData->execute();
        $totalCoupon= $selectCouponData->rowCount();
        if($totalCoupon>0){
            while($coupanData=$selectCouponData->fetch(PDO::FETCH_ASSOC)){
                $code = $coupanData['code'];
                $usertype = $coupanData['user'];
                $product = $coupanData['product'];
                $category = $coupanData['category'];
                if($usertype=='ALL'){
                    if(!empty($category)){
                        if($category=='ALL'){
                            $updateCoupan = $conn->prepare("UPDATE ogcustomer set coupon=? where userid=?");
                            $updateCoupan->execute([$code, $userid]);
                            if($updateCoupan){
                            echo 'Done';  
                            }
                        }else {
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
                                }
                            }
                            
                            $couponCatArray = explode(',',$category);
                            $matchArray=array_intersect($couponCatArray,$productArray);
                            if(count($matchArray)>0){
                                $updateCoupan = $conn->prepare("UPDATE ogcustomer set coupon=? where userid=?");
                                $updateCoupan->execute([$code, $userid]);
                                if($updateCoupan){
                                    echo 'Done';  
                                }
                            }else {
                                echo 'invalid-item';
                            }
                        }
                    }elseif(!empty($product)){
                        if($product=='ALL'){
                            $updateCoupan = $conn->prepare("UPDATE ogcustomer set coupon=? where userid=?");
                            $updateCoupan->execute([$code, $userid]);
                            if($updateCoupan){
                            echo 'Done';  
                            }
                        }else {
                            $productArray = array();
                            $getCartProductCode = $conn->prepare('SELECT * FROM ogcart WHERE userid=?');
                            $getCartProductCode->execute([$userid]);
                            while($cartCode = $getCartProductCode->fetch(PDO::FETCH_ASSOC)){
                                
                                $productCode = explode(',',strtoupper($cartCode['productCode']));
                                $productArray = array_merge($productArray, $productCode);
    
                            }
                            
                            $couponProdArray = explode(',',$product);
                            $matchArray=array_intersect($couponProdArray,$productArray);
                            if(count($matchArray)>0){
                                $updateCoupan = $conn->prepare("UPDATE ogcustomer set coupon=? where userid=?");
                                $updateCoupan->execute([$code, $userid]);
                                if($updateCoupan){
                                    echo 'Done';  
                                }
                            }else {
                                echo 'invalid-item';
                            }
                        }
                    }
                }elseif($usertype=='New'){
                    if($category=='ALL'){
                        $updateCoupan = $conn->prepare("UPDATE ogcustomer set coupon=? where userid=?");
                        $updateCoupan->execute([$code, $userid]);
                        if($updateCoupan){
                          echo 'Done';  
                        }
                    }else {
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
                            }
                        }
                        
                        $couponCatArray = explode(', ',$category);
                        $matchArray=array_intersect($couponCatArray,$productArray);
                        if(count($matchArray)>0){
                            echo 'Done';
                        }else {
                            echo 'invalid-item';
                        }
                    }
                }else {
                    $getEmail = $conn->prepare('SELECT * FROM ogcustomer WHERE userid=?');
                    $getEmail->execute([$userid]);
                    while($um=$getEmail->fetch(PDO::FETCH_ASSOC)){
                        $email = $um['userid'];
                    }
                    $mailArray = explode(", ",$usertype);
                    
                    if(in_array($userid, $mailArray)){
                        if($category=='ALL'){
                        $updateCoupan = $conn->prepare("UPDATE ogcustomer set coupon=? where userid=?");
                        $updateCoupan->execute([$code, $userid]);
                        if($updateCoupan){
                          echo 'Done';  
                        }
                        }else {
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
                                }
                            }
                            
                            $couponCatArray = explode(', ',$category);
                            $matchArray=array_intersect($couponCatArray,$productArray);
                            if(count($matchArray)>0){
                                echo 'Done';
                            }else {
                                echo 'invalid-item';
                            }
                        }
                    }else {
                        echo "not-valid-for-account";
                    }
                }
            }
        }else {
            echo "Not Found";
        }
    }

if($_POST['btn']=='removeCoupon') {
    $updateCoupan = $conn->prepare("UPDATE ogcustomer set coupon=? where userid=?");
    $updateCoupan->execute([NULL, $userid]);
    if($updateCoupan){
            echo "Done";
    }
}

if($_POST['btn']=='RemoveFromCartPage'){
    $cartId =  test_input($_POST['id']);
    $deleteCartProduct = $conn->prepare('DELETE FROM ogcart WHERE id="'.$cartId.'" && wishlist=0');
    $deleteCartProduct->execute();
    if($deleteCartProduct){
        echo "done";
    }
}

if($_POST['btn']=='RemoveAll'){
    $cartId =  test_input($_POST['id']);
    $deleteCartProduct = $conn->prepare('DELETE FROM ogcart WHERE userId=? && wishlist=0 ');
    $deleteCartProduct->execute([$userid]);
    if($deleteCartProduct){
        echo "done";
    }
}

if($_POST['btn']=='removeWishListAll'){
    $cartId =  test_input($_POST['id']);
    $deleteCartProduct = $conn->prepare('DELETE FROM ogcart WHERE userId=? && wishlist=1 ');
    $deleteCartProduct->execute([$userid]);
    if($deleteCartProduct){
        echo "done";
    }
}

if($_POST['btn']=='removeWishList'){
    $cartId =  test_input($_POST['id']);
    $deleteCartProduct = $conn->prepare('DELETE FROM ogcart WHERE id="'.$cartId.'" && wishlist=1');
    $deleteCartProduct->execute();
    if($deleteCartProduct){
        echo "done";
    }
}

if($_POST['btn']=='AddedToWishlist'){
    $cartId =  test_input($_POST['id']);
    $addToWishlist = $conn->prepare('UPDATE ogcart SET wishlist=1 WHERE id="'.$cartId.'"');
    $addToWishlist->execute();
    if($addToWishlist){
        echo "done";
    }
}

if($_POST['btn']=='AddedToCart'){
    $cartId =  test_input($_POST['id']);
    $addToWishlist = $conn->prepare('UPDATE ogcart SET wishlist=0 WHERE id="'.$cartId.'"');
    $addToWishlist->execute();
    if($addToWishlist){
        echo "done";
    }
}
    
if(isset($_POST["country_id"])){
    //Get all state data
	$country_id= test_input($_POST['country_id']);
	$select_state=$conn->prepare("SELECT * FROM states WHERE country_id = '$country_id'");
    $select_state->execute();
    $count = $select_state->rowCount();
    
    //Display states list
    if($count > 0){
        echo '<option value="">Select state</option>';
        while($row=$select_state->fetch(PDO::FETCH_ASSOC)){
		$state_id=$row['state_id'];
		$state_name=$row['state_name'];
        echo "<option value='$state_id'>$state_name</option>";
        }
    }else{
        echo '<option value="">State not available</option>';
    }
}

if(isset($_POST["state_id"])){
	$state_id= test_input($_POST['state_id']);
    //Get all city data
    $select_city=$conn->prepare("SELECT * FROM cities WHERE state_id = '$state_id'");
    $select_city->execute();
    $count = $select_city->rowCount();
    
    //Display cities list
    if($count > 0){
        echo '<option value="">Select city</option>';
        while($row=$select_city->fetch(PDO::FETCH_ASSOC)){
		$city_id=$row['city_id'];
		$city_name=$row['city_name']; 
        echo "<option value='$city_id'>$city_name</option>";
        }
    }else{
        echo '<option value="">City not available</option>';
    }
}

if($_POST['btn']=='updateCustomer'){
    $userid = test_input($_POST['userid']);
    $fname = test_input($_POST['fname']);
    $lname = test_input($_POST['lname']);
    $phone = test_input($_POST['phone']);
    $email = test_input($_POST['email']);
    
    $updateUserData =$conn->prepare("UPDATE ogcustomer SET fname=?, lname=?, email=?, phone=? WHERE userid=?");
    $updateUserData->execute([$fname, $lname, $email, $phone, $userid]);
    if($updateUserData){
        echo "Done";
    }else {
        echo "Error";
    }
    
}

if($_POST['btn']=="reorder"){
    $oid = test_input($_POST['oid']);
    $getOrderProduct=$conn->prepare("SELECT * FROM ogorderproduct WHERE orderid = '$oid'");
    $getOrderProduct->execute();
    while($row=$getOrderProduct->fetch(PDO::FETCH_ASSOC)){
        $insertProductToCart = $conn->prepare("INSERT INTO ogcart(productCode, strengthCode, quantityCode, quantity, quantityPrice, totalQuantity, totalPrice, total, userid, reorder) VALUES(?,?,?,?,?,?,?,?,?,?)");
        $insertProductToCart->execute([$row['productCode'],$row['strengthCode'],$row['quantityCode'],$row['quantity'],$row['quantityPrice'],$row['totalQuantity'],$row['totalPrice'],$row['totalPrice']*$row['totalQuantity'],$row['userId'],'1']);
        if($insertProductToCart){
            echo "done";
        }else{
            echo "Fail";
        }
        
    }
}
    
if($_POST['btn']=="EditUser"){
    
    $addressID = test_input($_POST['addressID']);
    $getAddress=$conn->prepare("SELECT * FROM ogaddress WHERE id = '$addressID'");
    $getAddress->execute();
    while($row=$getAddress->fetch(PDO::FETCH_ASSOC)){
        echo json_encode(array(
            "fname"=>$row['fname'],
            "lname"=>$row['lname'],
            "email"=>$row['email'],
            "phone"=>$row['phone'],
            "address1"=>$row['addressline1'],
            "address2"=>$row['addressline2'],
            "country"=>$row['country'],
            "state"=>$row['state'],
            "city"=>$row['city'],
            "pincode"=>$row['postalcode'],
        ));    
    }
}
if($_POST['btn']=="loadAccountAddress"){
        $address="";
        $getaddress=$conn->prepare("SELECT * FROM ogaddress WHERE userid='".$_SESSION['USER_ID']."' ORDER BY defaultAdd DESC");
        $getaddress->execute();
        while($row=$getaddress->fetch(PDO::FETCH_ASSOC)){
            $id = $row['id'];
            $name = $row['fname'].' '.$row['lname'];
            $zip = $row['postalcode'];
            $fulladdress = $row['addressline1'].' '.$row['addressline2'];
            if($row['defaultAdd']==0){
                $default = '<span class="setDefaultAddress" onclick="setDefaultAddress('.$id.')" style="cursor:pointer;">Set Deafult Address</span>';
            }else {
                $default = '<span class="DefaultAddress"><i class="fa-solid fa-check"></i>&nbsp;Deafult</span>';
            }
            $address.='<div class=" col-lg-6 col-12 rounded-3 p-2 mb-4">
                    <div class="addresslist p-2">
                        <div class="deleteAddress">
                            <span onclick="deleteUserAddress('.$id.')">Delete</span>
                        </div>
                        <div class="ps-3">
                            <p class="addressTitle"><b>'.$name.' '.$zip.'</b></p>
                            <div class="p mb-0 fs-ms fullAddress">'.$fulladdress.'</div>
                            <div class="p mb-0 fs-ms fullAddress">'.$row['city'].' '.$row['state'].' '.$row['country'].', '.$zip.'</div>
                            <div class="addressOptions">
                                <a class="editAddress" href="#editUserAddress" onclick="editUserAddress('.$id.')" data-bs-toggle="modal">Edit Address</a>
                                '.$default.'
                            </div>
                        </div>
                    </div>
                </div>';
    }
    echo $address;
}

if($_POST['btn']=="updateUserAddress"){
    $id = test_input($_POST['addressID']);
    $fname = test_input($_POST['fname']);
    $lname = test_input($_POST['lname']);
    $email = test_input($_POST['email']);
    $phone = test_input($_POST['updatephone']);
    $addressline1 = test_input($_POST['addressline1']);
    $addressline2 = test_input($_POST['addressline2']);
    $country = test_input($_POST['country']);
    $city = test_input($_POST['city']);
    $state = test_input($_POST['state']);
    $pincode = test_input($_POST['pincode']);
    var_dump($_POST);
    $updateAddress = $conn->prepare('UPDATE ogaddress SET fname=?, lname=?, email=?, phone=?, addressline1=?, addressline2=?, country=?, state=?, city=?, postalcode=? WHERE id=?');
    $updateAddress->execute([$fname, $lname, $email, $phone, $addressline1, $addressline2, $country, $state, $city, $pincode, $id]);
    echo "Done";
}



if($_POST['btn']=='deleteUserAddress'){
    $id =  test_input($_POST['addressID']);
    $deleteAddress = $conn->prepare('DELETE FROM ogaddress WHERE id=?');
    $deleteAddress->execute([$id]);
    if($deleteAddress){
        echo "done";
    }
}

if($_POST['btn']=='loadCheckoutDefaultAddress'){
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
    $id = 0;
    if(isset($_SESSION['USER_ID'])){
        $checkAddress=$conn->prepare("SELECT * FROM ogaddress WHERE userid='".$_SESSION['USER_ID']."' and defaultAdd='1' limit 1");
        $checkAddress->execute();
        $isAddress = $checkAddress->rowCount();
        $i=0;
        if($isAddress>0){
            $show = "none";
            while($row=$checkAddress->fetch(PDO::FETCH_ASSOC)){
                ++$i;
                if($i==1){
                    $status = "checked";
                }else {
                    $status = "";
                }
                $addressId = $row['id'];
                $name = $row['fname'].' '.$row['lname'];
                $address = $row['addressline1'].' '.$row['addressline2'];
                $city = $row['city'];
                $state = $row['state'];
                $country = $row['country'];
                $postalcode  =$row['postalcode'];
                $phone = $row['phone'];
                
                $listaddress .= '
                    <input type="radio" name="addressId" id="addressId"  value="'.$addressId.'" '.$status.'>
                    <label for="address'.$addressId.'" class="address">
                        <div class="row addressCheck">
                            <div class="col-lg-8 col-12">
                                <h1 class="mt-0">Delivered To:'.$postalcode.', '.$city.'</h1>
                                <p>'.$row['addressline1'].' '.$row['addressline2'].'</p>
                            </div>
                            <div class="col-lg-4 col-12">
                                <a class="btn btn-primary btn-sm d-lg-inline-block changeAddress" style="width: fit-content;" href="#checkoutAddressList" onclick="editUserAddress('.$id.')" data-bs-toggle="modal"><i class="fa-solid fa-right-from-bracket me-2"></i>Change Address</a>
                            </div>
                        </div>
                    </label>
                ';
                
            }
        }else {
            if(isset($_SESSION['USER_ID'])){
                $listaddress .= '
                <label class="address">
                    <div class="row addressCheck">
                        <div class="col-lg-8 col-12">
                            <h1 class="mt-0">Enter Delivery Address</h1>
                        </div>
                        <div class="col-lg-3 col-12">
                            <a class="btn btn-primary btn-sm d-lg-inline-block changeAddress" style="width: fit-content; padding: 3px 21px;" href="#addUserAddress" data-bs-toggle="modal">Enter</a>
                        </div>
                    </div>
                </label>';
            }else {
                $listaddress .= '
                <label class="address">
                    <div class="row addressCheck">
                        <div class="col-lg-8 col-12">
                            <h1 class="mt-0">Delivered To: <span style="font-weight:400 !important">'.$decoded_json->postal.', '.$decoded_json->city.'</span></h1>
                        </div>
                        <div class="col-lg-3 col-12">
                            <a class="class="btn btn-primary btn-sm d-lg-inline-block changeAddress" style="width: fit-content;"  href="#addNewUserAddress" data-bs-toggle="modal">Enter Address</a>
                        </div>
                    </div>
                </label>
                ';
            }
            
        }
    }else {
       $checkAddress=$conn->prepare("SELECT * FROM ogaddress WHERE userid='".$userid."' limit 1");
        $checkAddress->execute();
        $isAddress = $checkAddress->rowCount();
        $i=0;
        if($isAddress>0){
            $show = "none";
            while($row=$checkAddress->fetch(PDO::FETCH_ASSOC)){
                ++$i;
                if($i==1){
                    $status = "checked";
                }else {
                    $status = "";
                }
                $addressId = $row['id'];
                $name = $row['fname'].' '.$row['lname'];
                $address = $row['addressline1'].' '.$row['addressline2'];
                $city = $row['city'];
                $state = $row['state'];
                $country = $row['country'];
                $postalcode  =$row['postalcode'];
                $phone = $row['phone'];
                
                $listaddress .= '
                    <input type="radio" name="addressId" id="addressId" value="'.$addressId.'" '.$status.'>
                    <label for="address'.$addressId.'" class="address">
                        <div class="row addressCheck">
                            <div class="col-lg-8 col-12">
                                <h1 class="mt-0">Delivered To:'.$postalcode.', '.$city.'</h1>
                                <p>'.$row['addressline1'].' '.$row['addressline2'].'</p>
                            </div>
                            <div class="col-lg-4 col-12"  style="padding-left: 9px !important;">
                                <a class="btn btn-primary btn-sm d-lg-inline-block changeAddress"  style="width: fit-content;"  href="#addNewUserAddress" data-bs-toggle="modal">Change Address</a>
                            </div>
                        </div>
                    </label>
                ';
                
            }
        }else {
            if(isset($_SESSION['USER_ID'])){
                $listaddress .= '
                <label class="address">
                    <div class="row addressCheck">
                        <div class="col-lg-8 col-12">
                            <h1 class="mt-0">Delivered To: <span style="font-weight:400 !important">'.$decoded_json->postal.', '.$decoded_json->city.'</span></h1>
                        </div>
                        <div class="col-lg-3 col-12" style="padding-left: 9px !important;">
                            <a class="btn btn-primary btn-sm d-lg-inline-block changeAddress" style="width: fit-content;"  href="#addUserAddress" data-bs-toggle="modal">Enter Address</a>
                        </div>
                    </div>
                </label>';
            }else {
                $listaddress .= '
                <label class="address new-address-check">
                    <div class="row addressCheck">
                        <div class="col-lg-8 col-12">
                            <h1 class="mt-0">Enter Delivery Address</h1>
                        </div>
                        <div class="col-lg-3 col-12" style="padding-left: 9px !important;">
                            <a class="btn btn-primary btn-sm d-lg-inline-block changeAddress" style="width: fit-content; padding: 3px 21px;"  href="#addNewUserAddress" data-bs-toggle="modal">Enter</a>
                        </div>
                    </div>
                </label>
                
                ';
            }
            
        }
    }
    
    echo $listaddress;
}

if($_POST['btn']=='setDefaultAddress'){
    $updateAddress = $conn->prepare("UPDATE ogaddress SET defaultAdd=0 WHERE userid='".$_SESSION['USER_ID']."'");
    $updateAddress->execute();
    $setDefaultAddress=$conn->prepare("UPDATE ogaddress SET defaultAdd=1 WHERE id='".$_POST['id']."'");
    $setDefaultAddress->execute();
    echo "done";
}

if($_POST['btn']=='loadUserAddressModal'){
    $data = "";
    $checkAddress=$conn->prepare("SELECT * FROM ogaddress WHERE userid='".$_SESSION['USER_ID']."'");
    $checkAddress->execute();
    while($row=$checkAddress->fetch(PDO::FETCH_ASSOC)){
    $dadd = $row['defaultAdd'];
    if($dadd==1){  
        $status = "checked";
    }else {
        $status = "";
    }
    $addressId = $row['id'];
    $name = $row['fname'].' '.$row['lname'];
    $address = $row['addressline1'].' '.['addressline2'];
    $address1 = $row['addressline1'];
    $address2 = $row['addressline2'];
    $city = $row['city'];
    $state = $row['state'];
    $country = $row['country'];
    $postalcode  =$row['postalcode'];
    $phone = $row['phone'];
    
    $data .='<input type="radio" name="addresscheck" value="'.$addressId.'" id="address'.$addressId.'" '.$status .'>
            <label for="address'.$addressId.'" class="addressPopCheck">
                <h1 class="mt-0">Delivered To: '.$postalcode.', '.$city.'</h1>
                <p>'.$address1.' '.$address2.'</p>
            </label>';
    
    }
    echo $data;
}

if($_POST['btn']=='UpdateOrder'){
    $invid = test_input($_POST['invid']);
    $getorder=$conn->prepare("SELECT * FROM orderdetails WHERE orderid=?");
    $getorder->execute([$invid]);
    while($row=$getorder->fetch(PDO::FETCH_ASSOC)){
        $productStatus = $row['productStatus'];
    }
    $productStatus = str_replace('Draft', 'Pending', $productStatus);
    $updateAddress = $conn->prepare("UPDATE orderdetails SET orderStatus=?, productStatus=? WHERE orderid=?");
    $updateAddress->execute(['Pending', $productStatus, $invid]);
    echo "done";
}

if($_POST['btn']=='addUserAddress') {
    $fname = test_input($_POST['fname']);
    $lname = test_input($_POST['lname']);
    $phone = str_replace('+', '+', test_input($_POST['codepin'])).str_replace('-','',test_input($_POST['phone']));
    $addressline1 = test_input($_POST['addressline1']);
    $addressline2 = test_input($_POST['addressline2']);
    $country = test_input($_POST['country']);
    $city = test_input($_POST['city']);
    $state = test_input($_POST['state']);
    $pincode = str_replace('+', '+', test_input($_POST['codepin']));
    $zip = test_input($_POST['pincode']);
    if(str_contains($phone, 'X') OR str_contains($phone, 'x')){
        die('phone');
    }

    foreach($_POST as $x=>$y){
        if($x!='addressline2'){
            if($x!='phonelength'){
                if(empty($y)){
                    
                    die($x);
                }
            }
        }
    }

    $updateAddress = $conn->prepare("UPDATE ogaddress SET defaultAdd=? WHERE userid=?");
    $updateAddress->execute([0,$_SESSION['USER_ID']]);
    
    $insertAddress = $conn->prepare("INSERT into ogaddress(userid, fname, lname, email, phone, addressline1, addressline2, city, country, state, postalcode,defaultAdd) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
    $insertAddress->execute([$_SESSION['USER_ID'], $fname, $lname, $_SESSION['EMAIL'], str_replace(' ','',$phone), $addressline1, $addressline2, $city, $country, $state, $zip, '1']);
    if($insertAddress){
        echo "done";
    }
}


if($_POST['btn']=='addNewUserAddress') {
    $fname = test_input($_POST['fname']);
    $lname = test_input($_POST['lname']);
    $phone = str_replace('+', '+', test_input($_POST['codepin'])).str_replace('-','',test_input($_POST['phone']));
    $email = test_input($_POST['email']);
    $addressline1 = test_input($_POST['addressline1']);
    $addressline2 = test_input($_POST['addressline2']);
    $country = test_input($_POST['country']);
    $city = test_input($_POST['city']);
    $state = test_input($_POST['state']);
    $pincode = test_input($_POST['pincode']);

    if(str_contains($phone, 'X') OR str_contains($phone, 'x')){
        die('phone');
    }

    foreach($_POST as $x=>$y){
        if($x!='addressline2'){
            if($x!='phonelength'){
                if(empty($y)){
                    
                    die($x);
                }
            }
        }
    }

    $deleteAddress = $conn->prepare("DELETE FROM ogaddress WHERE userid=?");
    $deleteAddress->execute([$userid]);
    
    
    $insertAddress = $conn->prepare("INSERT into ogaddress(userid, fname, lname, email, phone, addressline1, addressline2, city, country, state, postalcode,defaultAdd) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
    $insertAddress->execute([$userid, $fname, $lname, $email, str_replace(' ','',$phone), $addressline1, $addressline2, $city, $country, $state, $pincode, '0']);
    if($insertAddress){
        echo "done";
    }
}
if($_POST['btn']=='med-enq') {
    $medname = test_input($_POST['med-name']);
    $email = test_input($_POST['email']);
    $fname = test_input($_POST['fname']);
    $lname = test_input($_POST['lname']);
    $phone = test_input($_POST['phone']);
    $note = test_input($_POST['note']);
    $codepin = test_input($_POST['codepin']);
    if(!empty($fname)){
        if(!empty($lname)){
            if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
                if(!empty($phone)){
                    if(!empty($note)){
                        $insertEnq = $conn->prepare("INSERT INTO medEnq(name, email, phone, medname, note) VALUES(?,?,?,?,?)");
                        $insertEnq->execute([$fname." ".$lname, $email, $codepin.'-'.$phone, $medname, $note]);
                        if($insertEnq){
                            echo "done";
                        }
                    }else {
                        echo "nError";
                    }
                }else {
                    echo "pError";
                }
            }else {
                echo "eError";
            }
        }else {
            echo "lError";
        }
    }else {
        echo "fError";
    }
    
}

if($_POST['btn']=='getTrackRecord'){
    $orderid = test_input($_POST['orderid']);
    $data = "";
    $i=0;
    $getstatus=$conn->prepare("SELECT * FROM orderLocation WHERE orderid='".$orderid ."' ORDER BY time ASC");
    $getstatus->execute();
    $count = $getstatus->rowCount();
    if($count>0){
    while($row=$getstatus->fetch(PDO::FETCH_ASSOC)){
        ++$i;
        $time = $row['time'];
        $location = $row['location'];
        $formatDate = date('l,jS F Y H:I', strtotime($time));
        $day = strtoupper(date('a', strtotime($time)));
        $data .= '
            <div class="track-list" style=" border-left: 3px solid #1877f2; margin: 14px; padding-left: 8px; " >
                <p style="font-size: 11px;width: fit-content;background: #1877f2;padding: 0px 7px;font-weight: 700;color: #fff;">'.$i.'</p>
                <p style="font-size: 11px;">'.$formatDate.''.$day.'</p>
                <p style=" font-size: 13px; width: fit-content; padding: 1px 0; border-radius: 11px; color: #000; font-weight: 600; ">'.$location.'</p>
            </div>
        ';
    }
    }else {
        $data.='<div class="track-list" style=" border-left: 3px solid #1877f2; margin: 14px; padding-left: 8px; " >
                <p style="font-size: 11px;">Tracking Status not updated.</p>
                <p style=" font-size: 13px; width: fit-content; padding: 1px 0; border-radius: 11px; color: #000; font-weight: 600; ">Try Again Letter</p>
            </div>';
    }
    
    echo $data;
}

if($_POST['btn']=='allAddressList'){
    $addressList = "";
    $checkAddress=$conn->prepare("SELECT * FROM ogaddress WHERE userid='".$_SESSION['USER_ID']."'");
    $checkAddress->execute();
    while($row=$checkAddress->fetch(PDO::FETCH_ASSOC)){
        $dadd = $row['defaultAdd'];
        if($dadd==1){  
            $status = "checked";
        }else {
            $status = "";
        }
        $addressId = $row['id'];
        $name = $row['fname'].' '.$row['lname'];
        $address = $row['addressline1'].' '.['addressline2'];
        $city = $row['city'];
        $state = $row['state'];
        $country = $row['country'];
        $postalcode  =$row['postalcode'];
        $phone = $row['phone'];
            
        $addressList .= '
            <input type="radio" name="addresscheck" value="'.$addressId.'" id="address'.$addressId.'" '.$status.'>
            <label for="address'.$addressId.'" class="addressPopCheck">
                <h1 class="mt-0">Delivered To: '.$postalcode.', '.$city.'</h1>
                <p>'.$row['addressline1'].' '.$row['addressline2'].'</p>
            </label>
        ';
    }   
    echo $addressList;
}   

if($_POST['btn']=='loadCartData'){
    $selectLoginOgProduct = $conn->prepare("SELECT * from ogcart where userId='$userid' && wishlist=0");
    $selectLoginOgProduct->execute();
    $totalCartProduct=$selectLoginOgProduct->rowCount();
    echo $totalCartProduct;
}

if($_POST['btn']=='loadCartData1'){
    $selectLoginOgProduct = $conn->prepare("SELECT * from ogcart where userId='$userid' && wishlist=1");
    $selectLoginOgProduct->execute();
    $totalCartProduct=$selectLoginOgProduct->rowCount();
    echo $totalCartProduct;
}

if($_POST['btn']=='loadatcartwish') {
    $data1="";
    $select_stmt2=$conn->prepare("SELECT * FROM ogcart WHERE userID=? && wishlist=1 ORDER BY id DESC");
                            $select_stmt2->execute([$_COOKIE["userID"]]);
                            while($row=$select_stmt2->fetch(PDO::FETCH_ASSOC)){
                                $i+1;
                                $randomstock = rand(5,9);
                                if($row){
                                    $cartstatus = "Active";
                                    $cartId = $row['id'];
                                    $productCode = $row['productCode'];
                                    $strengthCode = $row['strengthCode'];
                                    $quantityCode = $row['quantityCode'];
                                    $quantity = $row['quantity'];
                                    $quantityPrice = $row['quantityPrice'];
                                    $totalQuantity = $row['totalQuantity'];
                                    $qty = $row['totalQuantity'];
                                    $totalPrice = $row['totalPrice'];
                                    $total = $row['total'];
                                    
                                    $select_product_details=$conn->prepare("SELECT * FROM ogproduct WHERE productCode='$productCode'");
                                    $select_product_details->execute();
                                    while($product=$select_product_details->fetch(PDO::FETCH_ASSOC)){
                                        $productName = $product['productName'];
                                        $productImage = $product['productImage'];
                                        $productCategory = $product['productCategory'];
                                        $productType = $product['productType'];
                                    } 
                                }
                                
                                $data1.="
                                    <div class=''>
                                        <a>
                                        <div class='card product-card' style='position: relative; display: flex;align-items: center;'>
                                            <div class='card-img-top d-block overflow-hidden'>
                                                <img src='https://myglobal1.gumlet.io/onglobaladmincrm/$productImage?w=208' style='width: 82px;'>
                                            </div>
                                            <div class='card-body'>
                                                <h3 class='product-title fs-sm'>".$productName."</h3>
                                                <p class='product-price'>
                                                  $".$total."/<small>".$productType."</small>*
                                                  <span class='dis'></span>
                                                </p>
                                             </div>
                                        </div>
                                        <div class='btnsss' style='display: flex;'>
                                            <button class='btn btn-success' id='".$cartId."'style=' background: #20c5be; border: 1px solid #20c5be; margin-right: 8px; font-size: 11px; padding: 5px 15px; ' onclick='againAddToCart(this)'>Move To Cart</button>  
                                            <button class='btn btn-danger' id='".$cartId."' style=' background: #f04451; border: 1px solid #f04451; margin-right: 8px; font-size: 11px; padding: 5px 15px; ' onclick='removeWishList(this)'>Remove</button>
                                        </div>
                                    </a>
                                </div>
                                ";
                                
                            }
                            echo '<div class="tns-carousel-inner" style="opacity: 1 !important;" data-carousel-options="{&quot;items&quot;: 2, &quot;loop&quot;: true, &quot;controls&quot;: true, &quot;autoHeight&quot;: false, &quot;margin&quot;: 15, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1}, &quot;480&quot;:{&quot;items&quot;:1}, &quot;720&quot;:{&quot;items&quot;:1}, &quot;991&quot;:{&quot;items&quot;:2}, &quot;1140&quot;:{&quot;items&quot;:3}, &quot;1300&quot;:{&quot;items&quot;:4}, &quot;1500&quot;:{&quot;items&quot;:4}}}">';
                            echo $data1." ";
                            echo '</div>';
}

if($_POST['btn']=='showcat') {
    $data = '';
    $selectCategory=$conn->prepare("
    SELECT * FROM ogcategory WHERE ogCategoryStatus='active' ORDER BY 
    CASE WHEN ogCategoryName='Other' THEN ogCategoryName END ASC,
    CASE WHEN ogCategoryName!='Other' THEN ogCategoryName END ASC");
    $selectCategory->execute();  
    $categoryRow=$selectCategory->rowCount();
    while($categoryRow=$selectCategory->fetch(PDO::FETCH_ASSOC)){
        $ogCategoryName = $categoryRow['ogCategoryName'];
        $ogCategorySlug = $categoryRow['ogCategorySlug'];    

                  $data.='<div class="accordion-item border-bottom">
                    <h3 class="accordion-header px-grid-gutter">
                      <button class="accordion-button collapsed py-3" onchange="scrolling(this)" type="button" data-bs-toggle="collapse" data-bs-target="#'.$ogCategorySlug.'" aria-expanded="false" aria-controls="dairy">
                        <span class="d-flex align-items-center">'.$ogCategoryName.'</span>
                      </button>
                    </h3>
                    <div class="collapse" id="'.$ogCategorySlug.'" data-bs-parent="#shop-categories">
                      <div class="px-grid-gutter pt-1 pb-4">
                        <div class="widget widget-filter">
                          <div class="input-group input-group-sm mb-2">
                            <input class="widget-filter-search form-control rounded-end" type="text" placeholder="Search">
                            <i class="fa-solid fa-magnifying-glass position-absolute top-50 end-0 translate-middle-y fs-sm me-3"></i>
                          </div>
                          <ul class="widget-list widget-filter-list pt-1" style="min-height: 2rem;" data-simplebar data-simplebar-auto-hide="false">';
                            
                                $selectProduct=$conn->prepare("SELECT * FROM ogproduct WHERE productCategory=? AND productStatus!=?");
                                $selectProduct->execute([$ogCategoryName, 'inactive']);  
                                $productRowCount=$selectProduct->rowCount();
                                if($productRowCount<1){
                                   $data.="No Product Found";
                                }
                                else {
                            
                            
                            
                              $selectProduct=$conn->prepare("SELECT * FROM ogproduct WHERE productCategory=? AND productStatus!=? limit 10");
                              $selectProduct->execute([$ogCategoryName, 'inactive']);  
                              //$productRowCount=$selectProduct->rowCount();
                              while($productRow=$selectProduct->fetch(PDO::FETCH_ASSOC))
                              {
                                  $productName = $productRow['productName'];
                                  $productCode = $productRow['productCode'];
                                  $productCategory = $productRow['productCategory'];
                                  $productlower = strtolower($productCategory);
                                  $prductcategoryslug = str_replace(" ","-",$productlower);
                                  $productDetails = $productRow['productDescription'];
                                  $productImage = $productRow['productImage'];
                                  $productImageAlt = $productRow['productImageAlt'];
                                  $productImageTitle = $productRow['productImageTitle'];
                                  $productType = $productRow['productType'];
                                  $productSlug = $productRow['productSlug'];
                                  
                            $data.='<li class="widget-list-item widget-filter-item">
                              <a class="widget-list-link d-flex justify-content-between align-items-center" href="'.$prductcategoryslug.'/'.$productSlug.'">
                                <span class="widget-filter-item-text">'.$productName.'</span>';
                                
                                    $select_product_price=$conn->prepare("SELECT * FROM ogquantity WHERE productCode='$productCode' ORDER BY price ASC limit 1");
                                    $select_product_price->execute();
                                    while($row=$select_product_price->fetch(PDO::FETCH_ASSOC))
                                    {
                                        $price = $row['price']; 
                                    }
                                    $selectCat=$conn->prepare("SELECT * FROM ogproduct WHERE productCode = '$productCode'");
                                        $selectCat->execute();
                                        while($row=$selectCat->fetch(PDO::FETCH_ASSOC)){
                                            $name = $row['productCategory']; 
                                            $catsName = $row['productCategory']; 
                                            $cat =  (explode(",",$name));
                                            $category = array();
                                            foreach($cat AS $x) {
                                                array_push($category,"'".$x."'");
                                            }
                                    
                                            $categoryName = (implode(",",$category));
                                            $proStrn = $row['proStrn']; 
                                          
                                            $type = $row['productType'];    
                                        }
                                        $discount = 0;
                                        $newprice = 0;
                                        $selectOffer=$conn->prepare("SELECT * FROM discount WHERE code='$productCode' AND type='PROD'");
                                        $selectOffer->execute();
                                        
                                        $countOffer = $selectOffer->rowCount();
                                        if($countOffer<1){
                                            $selectOffer=$conn->prepare("SELECT * FROM discount WHERE name IN ($categoryName) AND type='CAT'");
                                            $selectOffer->execute();
                                            $countOffer = $selectOffer->rowCount();
                                            if($countOffer<1){
                                                $selectOffer=$conn->prepare("SELECT * FROM discount WHERE type='ALL'");
                                                $selectOffer->execute();
                                                $countOffer = $selectOffer->rowCount();
                                                if($countOffer<1){
                                                    
                                                }else {
                                                    while($crow=$selectOffer->fetch(PDO::FETCH_ASSOC)){
                                                        $discount = $crow['discount'];
                                                        $newprice = ($price-($price*($discount/100)));
                                                    }
                                                }
                                            }else {
                                                while($crow=$selectOffer->fetch(PDO::FETCH_ASSOC)){
                                                    $discount = $crow['discount'];
                                                    $newprice = ($price-($price*($discount/100)));
                                                }
                                            }
                                        }else {
                                            while($crow=$selectOffer->fetch(PDO::FETCH_ASSOC)){
                                                $discount = $crow['discount'];
                                                $newprice = ($price-($price*($discount/100)));
                                            }
                                        }
                                if($discount>0){
                                    $data.='<span class="fs-xs text-muted ms-3">'.$_SESSION["currency_symbol"].number_format(($newprice*$_SESSION["currency_rate"]),2).' <small><del>'.$_SESSION["currency_symbol"].number_format(($price*$_SESSION["currency_rate"]),2).'</del></small>'.'</span></a></li>';
                                }else {
                                $data.='<span class="fs-xs text-muted ms-3">'.$_SESSION["currency_symbol"].number_format(($price*$_SESSION["currency_rate"]),2).'</span></a></li>';
                                }
                              }
                            }
                    $data.='
                    <li class="widget-list-item widget-filter-item">
                                    <a class="widget-list-link d-flex align-items-center" href="'.$ogCategorySlug.'">
                                        <span class="widget-filter-item-text view">View all</span><span class="fs-xs text-muted price-view">'.$productRowCount.'</span>
                                    </a>
                                </li>
                    ';
                                $data.='
                            </ul>
                            </div>
                        </div>
                        </div>
                    </div>';
                  
        }

echo $data;
}

if($_POST['btn']=='out-prod') {
    foreach($_POST as $x=>$y){
        if(empty($y)){
            die($x);
        }elseif($x=='email'){
            if (!filter_var($y, FILTER_VALIDATE_EMAIL)) {
                  die($x);
            }
        }elseif($x=='phone'){
            if (strlen(str_replace(' ','',$y))<10) {
                  die($x);
            }
        }
    }
    $phone = str_replace(' ','', ( str_replace('+','',$_POST['codepin']).''.str_replace('-','',$_POST['phone']) ));
    $insertData = $conn->prepare('INSERT INTO customerCases(web, type, page, name, email, phone, message) VALUES (?,?,?,?,?,?,?)');
    $insertData->execute([$_POST['web'], $_POST['type'], $_POST['page'], $_POST['fname'].' '.$_POST['lname'], $_POST['email'], $phone, '(Inquiry For'.$_POST['med-name'].' )'.$_POST['message']]);

    $mailjetApiKey = 'a6e20f63603953cd9ca2349265d2304b';
    $mailjetApiSecret = '4a228283087d8e09a63a01a990576bc3';
    $messageData = [
            'Messages' => [
                    [
                            'From' => [
                                    'Email' => 'request@Newlands Pharmacy.com',
                                    'Name' => 'Newlands Pharmacy Enquiry'
                            ],
                            'To' => [
                                    [
                                            'Email' => ' '.$_POST['email'].' ',
                                            'Name' => ' '.$_POST['fname'].' '
                                    ]
                            ],
                            'Subject' => 'Newlands Pharmacy Inquiry',
                            'TextPart' => '',
                            'HTMLPart' => 'We have recived your inquiry'
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
    //Send Text Message=============================
    $post_data = [
        'username'=>'Newlands Pharmacy', 
        'key'=>'Newlands Pharmacy@2022', 
        'method'=>'http', 
        'to'=>$phone, 
        'message'=>'Dear Customer, We have recived your inquiry from painosoma', 
        'senderid'=>'mycompany'];
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

    //Send Whatsapp Message=============================
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.ultramsg.com/instance5491/messages/chat",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "token=mp15jsuyuzvpfrhz&to=".$phone."&body=Dear Customer, We have recived your inquiry from painosoma&priority=0&referenceId=",
        CURLOPT_HTTPHEADER => array(
          "content-type: application/x-www-form-urlencoded"
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
      
    curl_close($curl);
    
    if ($err) {
        //  echo "cURL Error #:" . $err;
    } else {
        //  echo $response;
    }

    if($_POST['web']=='SOMA') {
            $web = 'painosoma-popup';
    }elseif($_POST['web']=='PAS') {
            $web = 'practicalanxietysolutions-popup';
    }

    $collect[] = array( //customised inputs
        "Full Name" => $_POST['username'],
        "Enter your email Address" => $_POST['email'],
        "Contact Number" => $phone,
        "Enter Note" => $_POST['message'],
        "form_id" => uniqid(),
        "form_name" => $web
    );

    $content = json_encode($collect);
    
    $url = "https://hook.eu1.make.com/3y7skw7nnre84dnm4kdgpkmahbpmrmt5";    
    
    $curl = curl_init($url);
    // curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
    
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'content-Type: application/json',
            'Content-Length: ' . strlen($content))
    );
    
    $json_response = curl_exec($curl);
    
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
    if ( $status != 200 ) {
        die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }
    
    curl_close($curl);
    
    $response = json_decode($json_response, true);
    
     echo "done";
}

    if($_POST['btn']=='currency') {
        $code = test_input($_POST['currency']);
        $details = json_decode(file_get_contents("https://api.currencyapi.com/v3/convert?apikey=DhVYwUSFNki3WH3lSiMmqF62yXhCiya1cE0YijAs&value=1&base_currency=USD&currencies=$code"));
        $currency = (array)$details->data->$code->value;
        $rate = ($currency[0]);

        $symbol = json_decode(file_get_contents("https://api.currencyapi.com/v3/currencies?apikey=DhVYwUSFNki3WH3lSiMmqF62yXhCiya1cE0YijAs&currencies=$code"));
        $currencySymbol = (array)$symbol->data->$code->symbol_native;
        $currencySymbols = $currencySymbol[0];

        $_SESSION['currency']=$code;
        $_SESSION["currency_rate"] = $rate;
        $_SESSION["currency_symbol"] = $currencySymbols;
    }

    if($_POST['btn']=='validateEmail') {
        $email = $_POST['email'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.debounce.io/v1/?email=".$email."&api=6316d7b26b2a0",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $resData = json_decode($response,true);
        echo $resData['debounce']['reason'];
    }

    if($_POST['btn']=='validatePhone') {
        $code = $_POST['code'];
        $phone = $_POST['phone'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.numlookupapi.com/v1/validate/".$code.$phone."?apikey=Sjd94lzjEBT8gNoa2I1sjpYmP0wjUUscMGrINXaY",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        ));

        $response = curl_exec($curl);
        // print_r($response);
        curl_close($curl);

        $resData = json_decode($response,true);
        
        echo $resData['valid'];
    }

    if($_POST['btn']=='getAddress'){
        function encodeValue($s) {
            return htmlentities($s, ENT_COMPAT|ENT_QUOTES,'ISO-8859-1', true); 
        }
    
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://us-autocomplete-pro.api.smartystreets.com/lookup?auth-id=bbdd6709-e2e2-4c64-bbf2-8edd586eed80&auth-token=rhk5wNVnU4oXqu07CjAA&search=".encodeValue($_POST['address'])."&selected=&license=us-autocomplete-pro-cloud",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        ));
    
        $response = curl_exec($curl);
    
        curl_close($curl);
        $addressArray = array();
        $zipArray = array();
        $stateArray = array();
        $cityArray = array();
        $countryArray = array();
        $resData = json_decode($response,true);
        foreach($resData['suggestions'] as $x){
            $address = $x['street_line']." ".$x['city'].", ".$x['state']." ".$x['zipcode'];
            $zip = $x['zipcode'];
            $state = $x['state'];
            $city = $x['city'];
            $country = 'US';
            array_push($addressArray,$address);
            array_push($zipArray, $zip);
            array_push($stateArray, $state);
            array_push($cityArray, $city);
            array_push($countryArray, $country);
            // echo $x['suggestions'].$x['street_line'].$x['city'].", ".$x['state'].$x['zipcode'];
        }
        $jsonData = json_encode(array(
            "address" => $addressArray,
            "state" => $stateArray,
            "city" => $cityArray,
            "zip" => $zipArray,
            "country" => $countryArray,
        ), JSON_PRETTY_PRINT);
        echo $jsonData;
    }
    if($_POST['btn']=='zipVerify'){
        function getZipInfo($zip){
            if(isset(getAddress($zip, 'us')['results'][$zip][0]['city_en'])){
                echo json_encode(array(
                    "city" => getAddress($zip, 'us')['results'][$zip][0]['city_en'],
                    "state" => getAddress($zip, 'us')['results'][$zip][0]['state_en'],
                    "country" => getAddress($zip, 'us')['results'][$zip][0]['country_code']
    
                ));
    
            }elseif(isset(getAddress($zip, 'uk')['results'][$zip][0]['city_en'])){
    
                echo json_encode(array(
                    "city" => getAddress($zip, 'us')['results'][$zip][0]['city_en'],
                    "state" => getAddress($zip, 'us')['results'][$zip][0]['state_en'],
                    "country" => getAddress($zip, 'us')['results'][$zip][0]['country_code']
    
                ));
    
            }elseif(isset(getAddress($zip, 'in')['results'][$zip][0]['city_en'])){
    
                echo json_encode(array(
                    
                    "city" => getAddress($zip, 'in')['results'][$zip][0]['city_en'],
                    "state" => getAddress($zip, 'in')['results'][$zip][0]['state_en'],
                    "country" => getAddress($zip, 'in')['results'][$zip][0]['country_code']
    
                ));
    
            }else {
    
                echo "error";
    
            }
    
        }
        function getAddress($zip, $country) {
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://app.zipcodebase.com/api/v1/search?apikey=b41ebb80-02a8-11ed-8712-573f961d1a74&codes=$zip&country=$country",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            ));
    
            $response = curl_exec($curl);
    
            curl_close($curl);
    
            $resData = json_decode($response,true);
    
            return $resData;
            // print_r($resData['results'][$zip][0]['city_en']);
        }
        
        getZipInfo($_POST['zipcode']);
    }
    
    if($_POST['btn']=='setPaymentMethod'){
        $subtotal = test_input($_POST['subtotal']);
        $dcharge = test_input($_POST['dcharge']);
        $discount = test_input($_POST['discount']);
        $total = test_input($_POST['total']);
        $ogtotal = test_input($_POST['ogtotal']);
        $currentpay = test_input($_POST['currentPay']);
        $inv =  test_input($_POST['inv']);
        $pname =  test_input($_POST['pname']);
        $source = test_input( $_POST['source']);

        if($pname=='cashapp' OR $pname=='zelle') {
            if($currentpay==$pname){
                echo "done";
            }
            elseif(strlen($currentpay)<2){
                if($source=='MAN'){
                    $newtotal = $ogtotal-($ogtotal*0);
                    $newdiscount = $discount+($ogtotal*0);
                    $paymentDiscount = $ogtotal*0;
                }else {
                    $newtotal = (($ogtotal+$dcharge)-$discount)-((($ogtotal+$dcharge)-$discount)*0);
                    $newdiscount = $discount+($total*0);
                    $paymentDiscount = ((($ogtotal+$dcharge)-$discount)*0);
                }
                $setPaymentMethod = $conn->prepare('UPDATE orderdetails SET paymentMethod=?, paymentDiscount=?, total=? where orderid=?');
                $setPaymentMethod->execute([$pname, $paymentDiscount, $newtotal, $inv]);
                echo "done";
            }
            elseif($currentpay!='cashapp' AND $currentpay!='zelle'){
                if($source=='MAN'){
                    $newtotal = $ogtotal-($ogtotal*0);
                    $newdiscount = $discount+($ogtotal*0);
                    $paymentDiscount = $ogtotal*0;
                }else {
                    $newtotal = (($ogtotal+$dcharge)-$discount)-((($ogtotal+$dcharge)-$discount)*0);
                    $newdiscount = $discount+($total*0);
                    $paymentDiscount = ((($ogtotal+$dcharge)-$discount)*0);
                }
                $setPaymentMethod = $conn->prepare('UPDATE orderdetails SET paymentMethod=?, paymentDiscount=?, total=? where orderid=?');
                $setPaymentMethod->execute([$pname, $paymentDiscount, $newtotal, $inv]);
                echo "done";
            }else {
                $setPaymentMethod = $conn->prepare('UPDATE orderdetails SET paymentMethod=? where orderid=?');
                $setPaymentMethod->execute([$pname, $inv]);
                echo "done";
            }
        }else {
            if($currentpay==$pname){
                echo "done";
            }
            elseif(strlen($currentpay)<2){
                $setPaymentMethod = $conn->prepare('UPDATE orderdetails SET paymentMethod=? where orderid=?');
                $setPaymentMethod->execute([$pname, $inv]);
                echo "done";
            }elseif($currentpay=='cashapp' OR $currentpay=='zelle'){
                if($source=='MAN'){
                    $newdiscount = ($subtotal+$dcharge)-$ogtotal;
                    $newtotal = ($subtotal+$dcharge)-$newdiscount;
                }else {
                    $newdiscount = $ogtotal-$subtotal;
                    $newtotal = ($ogtotal+$dcharge)-$discount;
                }
                $setPaymentMethod = $conn->prepare('UPDATE orderdetails SET paymentMethod=?, paymentDiscount=?, total=? where orderid=?');
                $setPaymentMethod->execute([$pname, 0, $newtotal, $inv]);
                echo "done";
            }
            else {
                $setPaymentMethod = $conn->prepare('UPDATE orderdetails SET paymentMethod=? where orderid=?');
                $setPaymentMethod->execute([$pname, $inv]);
                echo "done";
            }
        }

        $_SESSION['payInvoiceOrg'] = $inv;
        $_SESSION['payInvoiceDub'] = $inv;
        $_SESSION['invoiceId'] = $inv;

    }
    if($_POST['btn']=='updateOrderAgain'){
        $inv =  test_input($_POST['inv']);
        $phone = test_input($_POST['phone']);
        $pname = test_input($_POST['pname']);
        $total = test_input($_POST['total']);

        

        $message = 'Payment received of $'.$total.' via cashapp for '.$inv;
        $whatsappMessage = "Thank you for making a payment of $".$total." with ".$pname." ".$inv." Please wait while we confirm your order and send you a confirmation email for your order. In case of any queries, please connect us on +13155154364.";

        $setPaymentMethod = $conn->prepare('UPDATE orderdetails SET paymentAgreement=? where orderid=?');
        $setPaymentMethod->execute(['1', $inv]);

        function sendMessage($x){
            $content = array(
                "en" => $x,
                "name" => 'Payment Recieved'
                );
        
            $fields = array(
                'app_id' => "b2d1076e-d4d9-42c6-a873-ef4bf2e401fd",
                'included_segments' => array('All'),
                'contents' => $content
            );
        
            $fields = json_encode($fields);
        
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                       'Authorization: Basic NTk4NTJiMTgtNjE5MS00ZGY5LTgxZGQtM2U4ZjlhYWJmYTI3'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    
        
            $response = curl_exec($ch);
            curl_close($ch);
        
            return $response;
        }

        function sendWpMessage($p,$x) {
            $curl = curl_init();
        
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ultramsg.com/instance5491/messages/chat",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "token=mp15jsuyuzvpfrhz&to=".$p."&body=".$x."&priority=1&referenceId=",
            
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
        }

        function sendTextMessage($p, $x) {
            $post_data = [
                'username'=>'MyGlobalPharma', 
                'key'=>'MyGlobalPharma@2022',  
                'method'=>'http', 
                'to'=>$p, 
                'message'=>$x,
                
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
        }
        
        $response = sendMessage($message);
        sendWpMessage($phone, $whatsappMessage);
        sendTextMessage($phone, $whatsappMessage);
        

        echo "done";
        $_SESSION['payInvoiceOrg']='done';
    }


    if($_POST['btn']=='setSliderSession') {
        $slider = test_input($_POST['slider']);
        $_SESSION['catSlider']=$slider;
        echo "done";
    }

    if($_POST['btn']=='AddCustomeCart') {
        $discount = test_input($_POST['discount']);
        $strength = test_input($_POST['strength']);
        $qty = test_input($_POST['qty']);
        $price = test_input($_POST['price']);
        $prcode = test_input($_POST['prcode']);
        $total = test_input($_POST['total']);
        $save = test_input($_POST['save']);
        $ogprice = test_input($_POST['orgprice']);
        echo $userid;
        $insertIntoCart = $conn->prepare('INSERT INTO `ogcart`(`productCode`, `strengthCode`, `quantityCode`, `quantity`, `quantityPrice`, `totalQuantity`, `totalPrice`, `total`, `userId`, `reorder`, `discount`, `saveAmount`, `orgPrice`, `wishlist`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $insertIntoCart->execute([$prcode, $strength, ' ', $qty, $price,1,$total, $total, $userid, 0,  $discount, $save, $ogprice, 0]);
        echo "done";
    }
    
    if($_POST['btn']=='applyDis') {
        $dis = test_input($_POST['dis']);
        if($dis==20) {
            $code = "HALLOWIN5";
        }
        $selectCouponData=$conn->prepare("SELECT * FROM coupons WHERE code=?");
        $selectCouponData->execute([$code]);
        while($row=$selectCouponData->fetch(PDO::FETCH_ASSOC)){
            $cuserid = $row['user'];
        }

        

        $cuserid = $cuserid.",".$userid;
        echo $cuserid;

        $updateCouponData=$conn->prepare("UPDATE coupons SET user=? WHERE code=?");
        $updateCouponData->execute([$userid, $code]);

        $updateUserCoupon=$conn->prepare("UPDATE ogcustomer SET coupon=? WHERE userid=?");
        $updateUserCoupon->execute([$code, $userid]);

        $_SESSION['HALLOFF']="yes";
        
        echo "done";
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
?>
