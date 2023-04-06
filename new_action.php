<?php
session_start();
$userid = $_COOKIE["userID"];
error_reporting(0);
require_once "include/database.php";
require_once("myFuntions.php");
// include('myFunctions.php');
require_once("include/class.phpmailer.php");
require_once("include/class.php");
//error_reporting(1);
header("Content-type:application/json");
header("Access-Control-Allow-Origin: *");

require 'vendor/autoload.php';
// include('mail-structure.php');


$mailjetApiKey = 'a6e20f63603953cd9ca2349265d2304b';
$mailjetApiSecret = '4a228283087d8e09a63a01a990576bc3';
$email="mehtabq24@gmail.com";
$name="Mehtab Qureshi";
$messageData = [
        'Messages' => [
                [
                        'From' => [
                                'Email' => 'no-reply@'.'Mehtab qureshi' ,
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
                        'HTMLPart' => 'sadsdads'
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



if($_POST['btn']=="load_maincart_data") {
$select_stmt1=$conn->prepare("SELECT * FROM ogcart WHERE userID='$userid' && wishlist=0 ORDER BY id DESC");
$select_stmt1->execute();
$cart_product="";
$product_calculation="";
$shipping_time = "";
$saving_amnt=0;
$total_amnt=0;
$actual_amnt=0;
$shipping_charges=0;
$global_total=0;
$global=false;
$count = $select_stmt1->rowCount();
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

        $actual_amnt=round($actual_amnt+$orgprice,2);

        $saving_amnt= round($saving_amnt+$totalSave,2);
        
        $global_total=round($global_total+$total,2);

        $strengthName = getStrengthname($conn, $strengthCode);
        $product = getProductInfoByCode($conn, $productCode);
        $productName = $product['name'];
        $genericName = $product['genericName'];
        $images = getProductImage($conn, $productCode);
        $front_img = $images[0];
        

        if(strpos($productName,'to US')){
            $type = 'USA';
            $shipping_country_img ='usa.png';
            $sshipping = 0;
            $shipping_time="<p>Shipping Time:<span>5-7 Days</span></p>";
            $global_total = $global_total+$sshipping;
            $shipping_charges_val='<span class="value shippingCharges"><span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>Free</span>';
        }else{
            $global=true;
            $shipping_country_img ='worldwide.png';    
            $type = 'Global';
            $shipping_time="<p>Shipping Time:<span>15-18 Days</span></p>";
        }

        $url = "https://myglobal1.gumlet.io/onglobaladmincrm/";
        $img_url=$url.$front_img;
        
       $cart_product.='<div class="cartmain_container">
        <div class="cart_container '.$total_amnt.'">
            <div class="grid-container inner-grid">
                <div class="grid-item inner_item1 pe-md-3">
                    <img src="'.$img_url.'" alt="" />
                </div>
                <div class="grid-item inner_item2">
                    <p>'.$productName.'<span>('.$genericName.')</span></p>
                </div>
                <div class="grid-item inner_item3 d-flex justify-content-around align-items-center">
                    <div class="off d-md-block d-none">'.$discount.'%off</div>
                    <span class="d-md-none">Remove</span>
                    <button class="d-md-block d-none" onclick="deleteCartproduct('.$cartId.')"><img src="image/cartImages/delete.png" alt="" /></button>
                </div>
                <div class="grid-item inner_item4 d-flex justify-content-between align-items-center">
                    <p>Quantity:<span>'.$quantity.'</span></p>
                    <p>Strength:<span>'.$strengthName.'</span></p>
                </div>
                <div class="grid-item inner_item5">'.$shipping_time.'</div>

                <div class="duplicate-div d-md-none d-flex justify-content-between align-items-center py-2">
                    <div class="off">15%off</div>
                    <button type="button" class="btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Edit
                    </button>
                </div>
                <div class="comb-div d-flex justify-content-between">
                    <div class="grid-item inner_item6 d-flex justify-content-around align-items-center">
                        <img src="image/cartImages/'.$shipping_country_img.'" class="me-md-2" alt="origin-img" />
                        <p>'.$type.' Premium Shipping</p>
                    </div>
                    <div class="grid-item inner_item7 d-flex gap-3 justify-content-between align-items-center">
                        <p>$'.$totalPrice.'<span>$'.$orgprice.'</span></p>
                        <button type="button" class="btn btn-primary d-none d-md-block edit-btn" onclick="cartProductupdate('.$cartId.')">
                            Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>';

    }
}
            if($global){ 
            if($global_total>0 && $global_total<99 ){
                $sshipping = 20;
                $global_total = $global_total+$sshipping;
                $shipping_charges_val='<span class="value shippingCharges"><span class="success-icon"></span>$'.$sshipping.'</span>';
            }elseif($global_total>=99 && $global_total<149){
                    $sshipping = 15;     
                    $global_total = $global_total+$sshipping;
                    $shipping_charges_val='<span class="value shippingCharges"><span class="success-icon"></span>$'.$sshipping.'</span>';
            }elseif($global_total>=149 && $global_total<=199){
                    $sshipping = 10;
                    $global_total = $global_total+$sshipping;
                    $shipping_charges_val='<span class="value shippingCharges"><span class="success-icon"></span>$'.$sshipping.'</span>';
            }elseif($global_total>=199){
                $sshipping = 0;
                $global_total = $global_total+$sshipping;
                $shipping_charges_val='<span class="value shippingCharges"><span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>Free</span>';
            }
        }

    $product_calculation='<div class="calculation">
                            <div class="list">
                                <span class="title">Actual Price</span>
                                <span class="value ogprice">$'.$actual_amnt.'</span>
                            </div>
                            <div class="list">
                                <span class="title">Shipping Charges</span>
                                '.$shipping_charges_val.'
                            </div>
                            <div class="list">
                                <span class="title">Total Saving</span>
                                <span class="value save-value">$'.$saving_amnt.'</span>
                            </div>
                            <div class="list">
                                <span class="title">Prescription Charges</span>
                                <span class="value totalprice">$0</span>
                            </div>
                            <div class="list" >
                                <span class="total">Total Price</span>
                                <span class="value finalprice">$'.$global_total.'</span>
                            </div>
                        </div>';

$arr_data1 = array('datahtml' => $cart_product, 'product_calculation'=> $product_calculation, 'cart_product_count'=> $count, 'discount_price'=> $discount);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($arr_data1);

}



// update cart pop up start work
if($_POST['btn']=='updateCartproduct'){
    $cartId =  $_POST['cartid'];
    $cart_product_strength="";
    $cart_product_quantity="";
    $select_stmt1=$conn->prepare("SELECT * FROM ogcart WHERE id='$cartId' && wishlist=0");
    $select_stmt1->execute();
    $quantity_array = array();
    while($row=$select_stmt1->fetch(PDO::FETCH_ASSOC)){
          $productCode = $row['productCode'];
          $strengthCode_cart = $row['strengthCode'];
          $quantityCode = $row['quantityCode'];
          $cart_quantity = $row['quantity'];
          $cart_quantityPrice = $row['quantityPrice'];
          $cart_totalPrice = $row['totalPrice'];
          $orgPrice = $row['orgPrice'];

          
         $cart_stregnth_name=getStrengthname($conn, $strengthCode_cart);
          $product = getProductInfoByCode($conn,$productCode);
            $productName = $product['name'];
            $productCategory = $product['category'];

            $discount = getDiscount($conn, $quantityCode, $strengthCode_cart, $productCode, $productCategory);
            $cart_quantity_discount = round($cart_quantityPrice-($cart_quantityPrice*($discount/100)),2);

                $getStrength = $conn->prepare('SELECT * FROM ogstrength WHERE productCode=? ORDER BY strengthName ASC');
                $getStrength->execute([$productCode]);
                $j=1;
                while($strengthRow = $getStrength->fetch(PDO::FETCH_ASSOC)) {
                    $strengthName = $strengthRow['strengthName'];
                    $strengthCode = $strengthRow['strengthCode'];
                    
                    if($strengthCode==$strengthCode_cart){
                        $Activeclass='show active';
                        $active_ul_li='active';
                        $toggle = 'true';
                    }else{
                        $Activeclass='';
                        $toggle='false';
                        $active_ul_li='';
                    }

                    $cart_product_strength.='<li class="nav-item" role="presentation '.$strengthName_cart.'">
                                                <button class="nav-link '.$active_ul_li.'" id="strength-'.$strengthCode.'" data-bs-toggle="tab" data-bs-target="#cart_'.$strengthCode.'" type="button" role="tab" aria-controls="'.$strengthCode.'" aria-selected="'.$toggle.'">'.$strengthName.'</button>
                                              <input type="hidden" name="product_strength" class="cart_'.$j.'" id="product_strength" value="'.$strengthName.'"/>      
                                            </li>';

                    $getQuantity1 = $conn->prepare('SELECT * FROM ogquantity WHERE strengthCode=? AND productCode=? AND quantity!=120 ORDER BY quantity ASC ');
                    $getQuantity1->execute([$strengthCode,$productCode]);
                    
                    $cart_product_quantity.='<div class="tab-pane fade '.$Activeclass.'" id="cart_'.$strengthCode.'" role="tabpanel" aria-labelledby="strength-'.$strengthCode.'">
                                            <div class="qty-container">';
                    
                                while($quantityRow = $getQuantity1->fetch(PDO::FETCH_ASSOC)) {

                                    $quantity = $quantityRow['quantity'];
                                    $quantityCode = $quantityRow['quantityCode'];
                                    $quantityPrice = $quantityRow['price'];
                                    $quantityOgPrice = $quantityRow['ogprice'];
                                    $total_quantity_price = $quantityPrice*$quantity;
                                    if($strengthCode==$strengthCode_cart){
                                    if($cart_quantity==$quantity){
                                        $quantity_class='active';
                                    }else{
                                        $quantity_class="";
                                    }}
                                    $discount_quantity = getDiscount($conn, $quantityCode, $strengthCode, $productCode, $productCategory);
                                    $usatousa = usaToUsa($conn, $productName, $strengthName, $discount_quantity);
                                    $quantity_discount = round($quantityPrice-($quantityPrice*($discount_quantity/100)),2);
                                    $cart_product_quantity.='<div class="qty-per-pill '.$quantity_class.'" onclick="test(this)" data-quantity="'.$quantity.'" data-strength="'.$j.'" data-product_strength="'.$strengthCode.'" data-cartProductid="'.$cartId.'" data-productCode="'.$productCode.'" data-qty_code="'.$quantityCode.'" data-qyt_prc="'.$quantityPrice.'" data-discount="'.$discount_quantity.'" data-product_orgPrice="'.$orgPrice.'" >
                                                                    <div class="str">'.$quantity.'</div>
                                                                    <div class="qty"><p>$'.$quantity_discount.'/pill</p><p>$'.$total_quantity_price.'</p></div>
                                                                </div>';
                                    }
                      $cart_product_quantity.='</div></div>';  
                      $j++;
                }
                $pill_calculation_strength.='<div class="calculation">
                                            <div class="list">
                                                <span class="title">Pill Strength</span>
                                                <span class="value ogprice Pill_Strength">'.$cart_stregnth_name.'</span>
                                            </div>
                                            <div class="list">
                                                <span class="title">Pill Quantity</span>
                                                <span class="value shippingCharges Pill_Quantity"><span class="success-icon"></span>'.$cart_quantity.'</span>
                                            </div>
                                            <div class="list">
                                                <span class="title">Per pill cost</span>
                                                <span class="value save-value Per_pill_cost">$'.$cart_quantity_discount.'</span>
                                            </div>
                                            <div class="list" style="border: none">
                                                <span class="total">To Pay</span>
                                                <span class="value finalprice toPay_total">$'.$orgPrice.'</span>
                                            </div>
                                        </div>';
    }
    $arr_data1 = array('cart_product_strength' => $cart_product_strength, 'cart_product_quantity'=>$cart_product_quantity, 'product_cart_name'=> $productName, 'pill_calculation_strength'=>$pill_calculation_strength);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($arr_data1);

}


// on cart pop up update strength and quantity 
if($_POST['btn']=='updateCartproduct_quantityPrice'){
        $cartId =  $_POST['cartid'];
        $discount =  $_POST['discount'];
        $quantity =  $_POST['quantity'];
        $productCode =  $_POST['productcode'];
        $quantityCode =  $_POST['quantityCode'];
        $strengthCode =  $_POST['product_strength'];
        $product_orgprice =  $_POST['product_orgprice'];
        $strengthValue =  $_POST['strength'];
        $quantityPrice =  $_POST['quantityPrice'];
        $product_price = $quantity*$quantityPrice;
        $saving_amnt=round($product_price*($discount/100),2);
        $total = round($product_price-($product_price*($discount/100)),2);
        $quantity_discount = round($quantityPrice-($quantityPrice*($discount/100)),2);
        $updateCart = $conn->prepare("UPDATE ogcart set productCode=?, strengthCode=?, quantityCode=?, quantity=?, quantityPrice=?, totalPrice=?, total=?,
        discount=?, saveAmount=?, orgPrice=? where id=?");
        if($updateCart->execute([$productCode, $strengthCode, $quantityCode, $quantity, $quantityPrice, $total, $total, $discount, $saving_amnt, $product_price, $cartId]))
        {
               $success_msg = 'done';  
        }
        $arr_data1 = array('Pill_Strength' => $strengthValue, 'Pill_Quantity'=>$quantity, 'Per_pill_cost'=> $quantity_discount, 'toPay_total'=>$product_price, 'success_msg'=>$success_msg);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($arr_data1);
}


if($_POST['btn']=='DeleteFromCartPage'){
    $cartId =  $_POST['cartid'];
    $deleteCartProduct = $conn->prepare('DELETE FROM ogcart WHERE id="'.$cartId.'" && wishlist=0');
    $deleteCartProduct->execute();
    if($deleteCartProduct){
        echo "done";
    }
}

if($_POST['btn']=='RemoveAllcartproduct'){
    $deleteCartProduct = $conn->prepare('DELETE FROM ogcart WHERE userId=? && wishlist=0');
    $deleteCartProduct->execute([$userid]);
    if($deleteCartProduct){
        echo "done";
    }
}

// get user logged address data

if($_POST['btn']=='allAddressList_new'){
    
    if(isset($_SESSION['USER_ID'])){
    $addressList = "";
    $checkAddress=$conn->prepare("SELECT * FROM ogaddress WHERE userid='".$_SESSION['USER_ID']."'");
    $checkAddress->execute();
    $i=1;
    while($row=$checkAddress->fetch(PDO::FETCH_ASSOC)){
        ++$i;
        $dadd = $row['defaultAdd'];
        if($dadd==1){  
            $status = "checked";
        }else {
            $status = "";
        }
        $addressId = $row['id'];
        $name = $row['fname'].' '.$row['lname'];

        $first_letter_fname = substr($row['fname'], 0, 1);
        $first_letter_lname = substr($row['lname'], 0, 1);

        $address = $row['addressline1'];
        $city = $row['city'];
        $state = $row['state'];
        $country = $row['country'];
        $postalcode  =$row['postalcode'];
        $phone = $row['phone'];
        $email = $row['email'];
        $addressList.= '
            <input type="radio" name="addresscheck" value="'.$addressId.'" id="address'.$addressId.'" '.$status.'>
            <label for="address'.$addressId.'" class="addressPopCheck">
            <input type="hidden" name="customer_addressId" value="'.$addressId.'" id="customer_addressId">
            <div class="grid-item outer_item2 destop-user-add d-none d-md-block">
            <div class="add_sec">';
        $addressList.='
                <img class="img1" src="image/cartImages/card texture1.png" alt="" />
                <img class="img2" src="image/cartImages/card texture2.png" alt="" />
                <div class="profile_picdiv1 d-flex justify-content-between align-items-center">
                    <div class="profile_pic">
                        <p class="d-flex justify-content-center align-items-center">
                        '.$first_letter_fname.$first_letter_lname.'
                        </p>
                    </div>
                    <div class="profile_name">
                        <p>'.$name.'</p>
                    </div>
                    <button class="d-flex justify-content-center align-items-center" onclick="editNewUserAddress('.$addressId.')">
                    <a href="javascript:void(0)"><img src="image/cartImages/pencil.png" alt="edit_pencil"></a>
                    </button>
                </div>
                <div class="profile_picdiv2 d-flex justify-content-between align-items-center">
                    <div class="profile_add">
                        <p>'.$address.'"</p>
                        <p>'.$email.'</p>
                    </div>
                    <button class="d-flex justify-content-center align-items-center" onclick="deleteUserAddress('.$addressId.')">
                        <img src="image/cartImages/delete.png" alt="" />
                    </button>
                </div>
                <div class="add_address d-flex justify-content-around align-items-center">
                    <i class="fa-solid fa-plus"></i>
                    <p class="mb-0" onclick="addUserAddress()">Add</p>
                </div>
            </div>
        </div>                    
    </label>';
    }   
    echo $addressList;
    }else{
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

                $addressList.= '
            <input type="radio" name="addresscheck" value="'.$addressId.'" id="address'.$addressId.'" '.$status.'>
            <label for="address'.$addressId.'" class="addressPopCheck">
            <input type="hidden" name="customer_addressId" value="'.$addressId.'" id="customer_addressId">
            <div class="grid-item outer_item2 destop-user-add d-none d-md-block">
            <div class="add_sec">';
                $addressList.='
                <img class="img1" src="image/cartImages/card texture1.png" alt="" />
                <img class="img2" src="image/cartImages/card texture2.png" alt="" />
                <div class="profile_picdiv1 d-flex justify-content-between align-items-center">
                    <div class="profile_pic">
                        <p class="d-flex justify-content-center align-items-center">
                        '.$first_letter_fname.$first_letter_lname.'
                        </p>
                    </div>
                    <div class="profile_name">
                        <p>'.$name.'</p>
                    </div>
                    <button class="d-flex justify-content-center align-items-center" onclick="editNewUserAddress('.$addressId.')">
                    <a href="javascript:void(0)"><img src="image/cartImages/pencil.png" alt="edit_pencil"></a>
                    </button>
                </div>
                <div class="profile_picdiv2 d-flex justify-content-between align-items-center">
                    <div class="profile_add">
                        <p>'.$address.'"</p>
                        <p>'.$email.'</p>
                    </div>
                    <button class="d-flex justify-content-center align-items-center" onclick="deleteUserAddress('.$addressId.')">
                        <img src="image/cartImages/delete.png" alt="" />
                    </button>
                </div>
                <div class="add_address d-flex justify-content-around align-items-center">
                    <i class="fa-solid fa-plus"></i>
                    <p class="mb-0" onclick="addUserAddress()">Add</p>
                </div>
            </div>
        </div>                    
    </label>';

            }
            echo $addressList;
        }
    }
}

if($_POST['btn']=='deleteUserAddress'){
    $addressID =  $_POST['addressID'];
    $deleteaddress = $conn->prepare('DELETE FROM ogaddress WHERE id="'.$addressID.'"');
    $deleteaddress->execute();
    if($deleteaddress){
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

if($_POST['btn']=='serviceReview_id') {
    $lastId= $_POST['serviceReview_id'];
    $last_increment_val= $_POST['last_increment_val'];
    
    $service_html_data="";
    $service_review_limit = $conn->prepare("SELECT * FROM reviews WHERE id>$lastId AND reviewType='Service Review' AND status='Approved' ORDER BY id ASC limit 10");
    $service_review_limit->execute();
    $service_review_limit_count = $service_review_limit->rowCount();
    $row_service_review_limit = $service_review_limit->fetchAll(PDO::FETCH_ASSOC);
    if($service_review_limit_count>0){
        $i=$last_increment_val;
        $status = "data";
        foreach($row_service_review_limit as $review_row){

                                $post_date = $review_row['date'];
                                $datetime1 = new DateTime();
                                $datetime2 = new DateTime($post_date);
                                $interval = $datetime1->diff($datetime2);
                                $month_ago = $interval->format('%m');
                                $year_ago = $interval->format('%y');
                                if($month_ago==0){
                                    $set_date = $year_ago." Years Ago";
                                }else{
                                    $set_date = $month_ago." Months Ago";
                                }

            $lastId = $review_row['id'];   
            $service_html_data.='<div class="rlist-item">
                                <div class="number">'.$i.'</div>
                                    <div class="content">
                                        <div class="row">
                                                <div class="col-lg-6 vol-12">
                                                    <div class="user-data">
                                                        <div class="name">'.$review_row['username'].'</div>
                                                        <div class="star-rating">';
                                                            if($review_row['rating']==1){
                                                                $service_html_data.= '<span class=""><img src="./image/review/star.png"></span>';                                            
                                                            }elseif($review_row['rating']==2){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }elseif($review_row['rating']==3){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }elseif($review_row['rating']==4){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }elseif($review_row['rating']==5){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }
                                                            $service_html_data.='
                                                        </div>
                                                        <div class="review-status">
                                                            <i class="fa-solid fa-circle-check"></i>
                                                            <p>Query Resolved</p>
                                                        </div>
                                                    </div>
                                                    <div class="review-user-meta">
                                                        <div class="user-type">Existing Users</div>
                                                        <div class="user-location">'.$review_row['state'].','.$review_row['country'].'</div>
                                                        <div class="date">'.$set_date.'</div>
                                                    </div>
                                                    <div class="review-content">'.$review_row['review'].'</div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="review-product-image">';
                                                            $service_review_image = $conn->prepare('SELECT * FROM reviewImages WHERE reviewId=? ORDER BY id ASC');
                                                            $service_review_image->execute([$review_row['id']]);
                                                            while($row_service_review_image = $service_review_image->fetch(PDO::FETCH_ASSOC)){
                                                            $service_html_data.='<div class="image-item">
                                                                                    <img src="https://myglobal1.gumlet.io/onglobaladmincrm/'.$row_service_review_image['path'].'" class="review-item-image">
                                                                                </div>';
                                                            }
                                $service_html_data.='</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
            $i++;
        }

    }else{
        $status = "nodata";
    }

    $last_increment_val=$i;
    $arr_data = array('datahtml' => $service_html_data, 'last_id' => $lastId, 'last_increment_val' => $last_increment_val, 'status'=>$status,'total_count'=>$service_review_limit_count);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($arr_data);
}
if($_POST['btn']=='websiteReview_id') {
    $lastId= $_POST['websiteReview_id'];
    $last_increment_val= $_POST['last_increment_val'];
    
    $service_html_data="";
    $service_review_limit = $conn->prepare("SELECT * FROM reviews WHERE id>$lastId AND reviewType='Website Review' AND status='Approved' ORDER BY id ASC limit 10");
    $service_review_limit->execute();
    $service_review_limit_count = $service_review_limit->rowCount();
    $row_service_review_limit = $service_review_limit->fetchAll(PDO::FETCH_ASSOC);
    if($service_review_limit_count>0){
        $i=$last_increment_val;
        $status = "data";
        foreach($row_service_review_limit as $review_row){
            $post_date = $review_row['date'];
            $datetime1 = new DateTime();
            $datetime2 = new DateTime($post_date);
            $interval = $datetime1->diff($datetime2);
            $month_ago = $interval->format('%m');
            $year_ago = $interval->format('%y');
            if($month_ago==0){
                $set_date = $year_ago." Years Ago";
            }else{
                $set_date = $month_ago." Months Ago";
            }

            $lastId = $review_row['id'];   
            $service_html_data.='<div class="rlist-item">
                                <div class="number">'.$i.'</div>
                                    <div class="content">
                                        <div class="row">
                                                <div class="col-lg-6 vol-12">
                                                    <div class="user-data">
                                                        <div class="name">'.$review_row['username'].'</div>
                                                        <div class="star-rating">';
                                                            if($review_row['rating']==1){
                                                                $service_html_data.= '<span class=""><img src="./image/review/star.png"></span>';                                            
                                                            }elseif($review_row['rating']==2){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }elseif($review_row['rating']==3){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }elseif($review_row['rating']==4){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }elseif($review_row['rating']==5){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }
                                                            $service_html_data.='
                                                        </div>
                                                        <div class="review-status">
                                                            <i class="fa-solid fa-circle-check"></i>
                                                            <p>Query Resolved</p>
                                                        </div>
                                                    </div>
                                                    <div class="review-user-meta">
                                                        <div class="user-type">Existing Users</div>
                                                        <div class="user-location">'.$review_row['state'].','.$review_row['country'].'</div>
                                                        <div class="date">'.$set_date.'</div>
                                                    </div>
                                                    <div class="review-content">'.$review_row['review'].'</div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="review-product-image">';
                                                            $service_review_image = $conn->prepare('SELECT * FROM reviewImages WHERE reviewId=? ORDER BY id ASC');
                                                            $service_review_image->execute([$review_row['id']]);
                                                            while($row_service_review_image = $service_review_image->fetch(PDO::FETCH_ASSOC)){
                                                            $service_html_data.='<div class="image-item">
                                                                                    <img src="https://myglobal1.gumlet.io/onglobaladmincrm/'.$row_service_review_image['path'].'" class="review-item-image">
                                                                                </div>';
                                                            }
                                $service_html_data.='</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
            $i++;
        }

    }else{
        $status = "nodata";
    }

    $last_increment_val=$i;
    $arr_data = array('datahtml' => $service_html_data, 'last_id' => $lastId, 'last_increment_val' => $last_increment_val, 'status'=>$status,'total_count'=>$service_review_limit_count);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($arr_data);
}
if($_POST['btn']=='overallProduct_id') {
    $lastId= $_POST['overallProduct_id'];
    $last_increment_val= $_POST['last_increment_val'];
    $service_html_data="";
    $service_review_limit = $conn->prepare("SELECT * FROM reviews WHERE id>$lastId AND reviewType='Product Review' AND status='Approved' ORDER BY id ASC limit 10");
    $service_review_limit->execute();
    $service_review_limit_count = $service_review_limit->rowCount();
    $row_service_review_limit = $service_review_limit->fetchAll(PDO::FETCH_ASSOC);
    if($service_review_limit_count>0){
        $i=$last_increment_val;
        $status = "data";
        foreach($row_service_review_limit as $review_row){
            $post_date = $review_row['date'];
            $productCode = $review_row['productCode'];
            $datetime1 = new DateTime();
            $datetime2 = new DateTime($post_date);
            $interval = $datetime1->diff($datetime2);
            $month_ago = $interval->format('%m');
            $year_ago = $interval->format('%y');
            if($month_ago==0){
                $set_date = $year_ago." Years Ago";
            }else{
                $set_date = $month_ago." Months Ago";
            }
            $lastId = $review_row['id'];   
            
            $product_review_limit = $conn->prepare('SELECT productName FROM ogproduct WHERE productCode=?');
            $product_review_limit->execute([$productCode]);
            $product_review_limit = $product_review_limit->fetchAll(PDO::FETCH_ASSOC);
            $productName = $product_review_limit[0]['productName'];


            $service_html_data.='<div class="rlist-item">
                                    <div class="pill_design">
                                    <div class="number">'.$i.'</div>
                                    <p class="product_name_tage">'.$productName.'</p>
                                </div>
                                    <div class="content">
                                        <div class="row">
                                                <div class="col-lg-6 vol-12">
                                                    <div class="user-data">
                                                        <div class="name">'.$review_row['username'].'</div>
                                                        <div class="star-rating">';
                                                            if($review_row['rating']==1){
                                                                $service_html_data.= '<span class=""><img src="./image/review/star.png"></span>';                                            
                                                            }elseif($review_row['rating']==2){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }elseif($review_row['rating']==3){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }elseif($review_row['rating']==4){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }elseif($review_row['rating']==5){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }
                                                            $service_html_data.='
                                                        </div>
                                                        <div class="review-status">
                                                            <i class="fa-solid fa-circle-check"></i>
                                                            <p>Query Resolved</p>
                                                        </div>
                                                    </div>
                                                    <div class="review-user-meta">
                                                        <div class="user-type">Existing Users</div>
                                                        <div class="user-location">'.$review_row['state'].','.$review_row['country'].'</div>
                                                        <div class="date">'.$set_date.'</div>
                                                    </div>
                                                    <div class="review-content">'.$review_row['review'].'</div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="review-product-image">';
                                                            $service_review_image = $conn->prepare('SELECT * FROM reviewImages WHERE reviewId=? ORDER BY id ASC');
                                                            $service_review_image->execute([$review_row['id']]);
                                                            while($row_service_review_image = $service_review_image->fetch(PDO::FETCH_ASSOC)){
                                                            $service_html_data.='<div class="image-item">
                                                                                    <img src="https://myglobal1.gumlet.io/onglobaladmincrm/'.$row_service_review_image['path'].'" class="review-item-image">
                                                                                </div>';
                                                            }
                                $service_html_data.='</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
            $i++;
        }

    }else{
        $status = "nodata";
    }

    $last_increment_val=$i;
    $arr_data = array('datahtml' => $service_html_data, 'last_id' => $lastId, 'last_increment_val' => $last_increment_val, 'status'=>$status,'total_count'=>$service_review_limit_count);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($arr_data);
}
if($_POST['btn']=='overallReview_id') {
    $lastId= $_POST['overallReview_id'];
    $last_increment_val= $_POST['last_increment_val'];
    
    $service_html_data="";
    $service_review_limit = $conn->prepare("SELECT * FROM reviews WHERE id>$lastId AND status='Approved' ORDER BY id ASC limit 10");
    $service_review_limit->execute();
    $service_review_limit_count = $service_review_limit->rowCount();
    $row_service_review_limit = $service_review_limit->fetchAll(PDO::FETCH_ASSOC);
    if($service_review_limit_count>0){
        $i=$last_increment_val;
        $status = "data";
        foreach($row_service_review_limit as $review_row){
            $post_date = $review_row['date'];
            $datetime1 = new DateTime();
            $datetime2 = new DateTime($post_date);
            $interval = $datetime1->diff($datetime2);
            $month_ago = $interval->format('%m');
            $year_ago = $interval->format('%y');
            if($month_ago==0){
                $set_date = $year_ago." Years Ago";
            }else{
                $set_date = $month_ago." Months Ago";
            }
            $lastId = $review_row['id'];   
            $service_html_data.='<div class="rlist-item">
                                <div class="number">'.$i.'</div>
                                    <div class="content">
                                        <div class="row">
                                                <div class="col-lg-6 vol-12">
                                                    <div class="user-data">
                                                        <div class="name">'.$review_row['username'].'</div>
                                                        <div class="star-rating">';
                                                            if($review_row['rating']==1){
                                                                $service_html_data.= '<span class=""><img src="./image/review/star.png"></span>';                                            
                                                            }elseif($review_row['rating']==2){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }elseif($review_row['rating']==3){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }elseif($review_row['rating']==4){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }elseif($review_row['rating']==5){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }
                                                            $service_html_data.='
                                                        </div>
                                                        <div class="review-status">
                                                            <i class="fa-solid fa-circle-check"></i>
                                                            <p>Query Resolved</p>
                                                        </div>
                                                    </div>
                                                    <div class="review-user-meta">
                                                        <div class="user-type">Existing Users</div>
                                                        <div class="user-location">'.$review_row['state'].','.$review_row['country'].'</div>
                                                        <div class="date">'.$set_date.'</div>
                                                    </div>
                                                    <div class="review-content">'.$review_row['review'].'</div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="review-product-image">';
                                                            $service_review_image = $conn->prepare('SELECT * FROM reviewImages WHERE reviewId=? ORDER BY id ASC');
                                                            $service_review_image->execute([$review_row['id']]);
                                                            while($row_service_review_image = $service_review_image->fetch(PDO::FETCH_ASSOC)){
                                                            $service_html_data.='<div class="image-item">
                                                                                    <img src="https://myglobal1.gumlet.io/onglobaladmincrm/'.$row_service_review_image['path'].'" class="review-item-image">
                                                                                </div>';
                                                            }
                                $service_html_data.='</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
            $i++;
        }

    }else{
        $status = "nodata";
    }

    $last_increment_val=$i;
    $arr_data = array('datahtml' => $service_html_data, 'last_id' => $lastId, 'last_increment_val' => $last_increment_val, 'status'=>$status,'total_count'=>$service_review_limit_count);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($arr_data);
}
// for product review search bar



if($_POST['btn']=='productSearchbar') {
    $value= $_POST['productSearchVal'];
    $productSearchbar_html_data="";

    // echo "SELECT * FROM `ogproduct` WHERE `productName` LIKE '%$value%'";

    $productSearchbar = $conn->prepare("SELECT * FROM `ogproduct` WHERE `productName` LIKE '%$value%'");
    $productSearchbar->execute();
    $productSearchbar_count = $productSearchbar->rowCount();
    $productSearchbar_row = $productSearchbar->fetchAll(PDO::FETCH_ASSOC);
    $productCode_array = array();

    foreach($productSearchbar_row as $productSearchbar_row){
        array_push($productCode_array, $productSearchbar_row['productCode']);
        $productName = $productSearchbar_row['productName'];
    }

    // $productSearchbar_review = $conn->prepare("SELECT * FROM `reviews` WHERE `productCode` LIKE '%$value%'");
    // $productSearchbar_review->execute();
    // $productSearchbar_review_count = $productSearchbar_review->rowCount();
    // $productSearchbar_review_row = $productSearchbar_review->fetchAll(PDO::FETCH_ASSOC);

    

    // echo "<pre>";
    // print_r($productCode_array);
    // echo "</pre>";
    

    foreach($productCode_array as $productCode){
    //echo $productCode;

    $productSearchbar_review = $conn->prepare("SELECT * FROM `reviews` WHERE `productCode`='$productCode'");
    $productSearchbar_review->execute();
    $productSearchbar_review_count = $productSearchbar_review->rowCount();
    $productSearchbar_review_row = $productSearchbar_review->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // print_r($productSearchbar_review_row);
    // echo "</pre>";
 

    
        foreach($productSearchbar_review_row as $review_row){
            $post_date = $review_row['date'];
            $datetime1 = new DateTime();
            $datetime2 = new DateTime($post_date);
            $interval = $datetime1->diff($datetime2);
            $month_ago = $interval->format('%m');
            $year_ago = $interval->format('%y');
            if($month_ago==0){
                $set_date = $year_ago." Years Ago";
            }else{
                $set_date = $month_ago." Months Ago";
            } 
            $service_html_data.='<div class="rlist-item"><div class="number">'.$i.'</div>
                                <p class="product_name_tage">'.$productName.'</p>
                                    <div class="content">
                                        <div class="row">
                                                <div class="col-lg-6 vol-12">
                                                    <div class="user-data">
                                                        <div class="name">'.$review_row['username'].'</div>
                                                        <div class="star-rating">';
                                                            if($review_row['rating']==1){
                                                                $service_html_data.= '<span class=""><img src="./image/review/star.png"></span>';                                            
                                                            }elseif($review_row['rating']==2){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }elseif($review_row['rating']==3){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }elseif($review_row['rating']==4){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }elseif($review_row['rating']==5){
                                                                $service_html_data.='<span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>
                                                                                    <span class=""><img src="./image/review/star.png"></span>';
                                                            }
                                                            $service_html_data.='
                                                        </div>
                                                        <div class="review-status">
                                                            <i class="fa-solid fa-circle-check"></i>
                                                            <p>Query Resolved</p>
                                                        </div>
                                                    </div>
                                                    <div class="review-user-meta">
                                                        <div class="user-type">Existing Users</div>
                                                        <div class="user-location">'.$review_row['state'].','.$review_row['country'].'</div>
                                                        <div class="date">'.$set_date.'</div>
                                                    </div>
                                                    <div class="review-content">'.$review_row['review'].'</div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="review-product-image">';
                                                            $service_review_image = $conn->prepare('SELECT * FROM reviewImages WHERE reviewId=? ORDER BY id ASC');
                                                            $service_review_image->execute([$review_row['id']]);
                                                            while($row_service_review_image = $service_review_image->fetch(PDO::FETCH_ASSOC)){
                                                            $service_html_data.='<div class="image-item">
                                                                                    <img src="https://myglobal1.gumlet.io/onglobaladmincrm/'.$row_service_review_image['path'].'" class="review-item-image">
                                                                                </div>';
                                                            }
                                $service_html_data.='</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
            
        }


    }
    // echo $service_html_data;//
    // $last_increment_val=$i;
    $arr_data = array('datahtml' => $service_html_data);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($arr_data);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>