<?php 
    session_start();
    error_reporting(0);
    require_once "include/database.php";
    $productCode = $_POST['productCode'];
    $userid = $_COOKIE["userID"];
    echo '
        <ul class="nav nav-pills mb-3" role="tablist">
    ';
    $i=0;
    $qty=0;
    $select_strength=$conn->prepare("SELECT * FROM ogstrength WHERE productCode = '$productCode' ORDER BY `ogstrength`.`strengthName` ASC");	
    $select_strength->execute();
    
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
    $strnArray = array();
    $selectStrengthFromCart=$conn->prepare("SELECT strengthCode FROM ogcart WHERE userId = '$userid' && productCode='$productCode' && wishlist=0 ORDER BY id DESC limit 1");	
    $selectStrengthFromCart->execute();
    while($strenghtog=$selectStrengthFromCart->fetch(PDO::FETCH_ASSOC)){
        $strengthCodes = $strenghtog['strengthCode'];
    }
    $get="";
    while($row=$select_strength->fetch(PDO::FETCH_ASSOC)){
        ++$i;

        if(strlen($strengthCodes)>1){
            if($row['strengthCode']==$strengthCodes){
                $class="active";
            }else {
                $class="";
            }
        }elseif(strlen($proStrn)>1) {
            if($row['strengthCode']==$proStrn){
                $class="active";
            }else {
                $class="";
            }
        }else {
            if($i==1){
                $class="active";
            }else {
                $class="";
            }
        }

        
        // elseif($i==1 && $get==""){
        //     $class="show active";
        //     $get = "done";
        // }else {
        //     $class=" ";
        // }
        $strnCode = $row['strengthCode'];
        // $selectOffer=$conn->prepare("SELECT * FROM discount WHERE code='$strnCode' AND type='STRN'");
        // $selectOffer->execute();
        // $countOffer = $selectOffer->rowCount();   
        // if($countOffer<1){
                    
        // }
        // else {
        //     while($crow=$selectOffer->fetch(PDO::FETCH_ASSOC)){
        //         $discount = $crow['discount'];
        //     }
        // }
        
        
        $selectOffer=$conn->prepare("SELECT * FROM discount WHERE code='$strnCode' AND type='STRN'");
                $selectOffer->execute();
                $countOffer = $selectOffer->rowCount();
                
                if($countOffer<1){
                    
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
                
        
        
        
        if($countOffer>0){
            echo '<li class="nav-item">
                <a href="#'.$row['strengthCode'].'" class="nav-link '.$class.'" id="'.$row['strengthCode'].'3" data-bs-toggle="pill" role="tab" aria-controls="'.$row['strengthCode'].'3" aria-selected="true">
                    '.$row['strengthName'].'
                    
                    <span class="strn-dis">'.$discount.'%Off</span>
                </a>
            </li>';
        }else {
            echo '<li class="nav-item">
                <a href="#'.$row['strengthCode'].'" class="nav-link '.$class.'" id="'.$row['strengthCode'].'3" data-bs-toggle="pill" role="tab" aria-controls="'.$row['strengthCode'].'3" aria-selected="true">
                    '.$row['strengthName'].'
                    
                </a>
            </li>';
        }
                
                
        
    }
    
    echo '</ul>
    <div class="tab-content">
    ';
    
    $j=0;
    $strnArray1 = array();
    $selectStrengthFromCart=$conn->prepare("SELECT strengthCode FROM ogcart WHERE userId = '$userid' && wishlist=0");	
    $selectStrengthFromCart->execute();
    while($strenghtog=$selectStrengthFromCart->fetch(PDO::FETCH_ASSOC)){
        $cartStrnArray1 = explode(',',$strenghtog['strengthCode']);
        $strnArray1 = array_merge($strnArray1, $cartStrnArray1);
    }
    $select_strength=$conn->prepare("SELECT * FROM ogstrength WHERE productCode = '$productCode' ORDER BY `ogstrength`.`strengthName` ASC");	
    $select_strength->execute();
    $get="";
    while($row=$select_strength->fetch(PDO::FETCH_ASSOC)){
        $strengthCode = $row['strengthCode'];
        ++$j;
        if(strlen($strengthCodes)>1){
            if ($row['strengthCode']==$strengthCodes){
                $class="active show";
            }else {
                $class="";
            }
        }elseif(strlen($proStrn)>1) {
            if($row['strengthCode']==$proStrn){
                $class="active show";
            }else {
                $class="";
            }
        }else {
            if($j==1){
                $class="active show";
            }else {
                $class="";
            }
        }




        // if($j==1 && ($row['strengthCode']==$strengthCodes)){
        //     $class="show active";
        // }
        // elseif($j==1){
        //     $class="show active";
        // }
        // elseif($row['strengthCode']==$strengthCodes){
        //     $class="show active";
        // }
        // else {
        //     $class=" ";
        // }
        echo '<div id="'.$strengthCode.'" class="tab-pane fade '.$class.'" role="tabpanel" aria-labelledby="'.$strengthCode.'3">
                            <table class="table table-striped" style="width:100% !important; text-align: center;">
                                <tr>
                                  <th scope="col">Quantity</th>
                                  <th scope="col">Per '. ucfirst($type).'</th>
                                  <th scope="col">Total Price</th>
                                  <th scope="col">Order Now</th>
                                </tr>';
        
        $select_quantity=$conn->prepare("SELECT * FROM ogquantity WHERE strengthCode = '$strengthCode' ORDER BY quantity DESC");
        $select_quantity->execute();
        while($row=$select_quantity->fetch(PDO::FETCH_ASSOC)){
            $btn="";
            $qtyCode = $row['quantityCode'];
            $discount = 0;
            $select_stmt1=$conn->prepare("SELECT * FROM ogcart WHERE quantityCode='$qtyCode' AND userId='$userid' AND wishlist=0");
            $select_stmt1->execute();
            $count = $select_stmt1->rowCount();
            
            $wselect_stmt1=$conn->prepare("SELECT * FROM ogcart WHERE quantityCode='$qtyCode' AND userId='$userid' AND wishlist=1");
            $wselect_stmt1->execute();
            $wcount = $wselect_stmt1->rowCount();
            $selectOffer=$conn->prepare("SELECT * FROM discount WHERE code='$qtyCode' AND type='QTY'");
            $selectOffer->execute();
            $countOffer = $selectOffer->rowCount();
            if($countOffer<1){
                $selectOffer=$conn->prepare("SELECT * FROM discount WHERE code='$strengthCode' AND type='STRN'");
                $selectOffer->execute();
                $countOffer = $selectOffer->rowCount();
                
                if($countOffer<1){
                    
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

            if($countOffer>0) {
                $offerPricing = $newprice;
            }else {
                $offerPricing = $row['price'];
            }

            if($count==0){ 
                
                    if($wcount>0){
                        $btn = '
                        <button type="button" class="cart-button btn btn-primary buttonCart" data-wishlist="0" data-qty="'.$row['quantity'].'" onclick="cartClick(this)" data-total-price="'.$row['quantity']*$offerPricing.'" data-cat-name="'.$catsName.'" data-qty-code="'.$qtyCode.'" data-user="'.$userid.'" data-value="'.$qty.'">
                            <span class="button__text add-to-cart ">Add To Cart</span>
                        </button>
                        <a href="wishlist" class="cart-button wishbtn btn btn-primary buttonCart" data-wishlist="1" style="background: transparent;margin-left: 5px;padding: 0px;border: 1px solid #fff;">
                            <span class="button__text add-to-cart "><i class="fas fa-heart" style=" color: #e91e63; font-size: 21px;"></i></span>
                        </a>';
                    }else {
                    $btn = '
                        <button type="button" class="cart-button btn btn-primary buttonCart" data-wishlist="0" data-qty="'.$row['quantity'].'" onclick="cartClick(this)" data-qty-code="'.$qtyCode.'" data-cat-name="'.$catsName.'" data-total-price="'.$row['quantity']*$offerPricing.'" data-user="'.$userid.'" data-value="'.$qty.'">
                            <span class="button__text add-to-cart ">Add To Cart</span>
                        </button>
                        <button type="button" class="cart-button wishbtn btn btn-primary buttonCart" data-wishlist="1" style="background: transparent;margin-left: 5px;padding: 0px;border: 1px solid #fff;" data-qty="'.$row['quantity'].'" onclick="cartClick(this)" data-qty-code="'.$qtyCode.'" data-user="'.$userid.'" data-value="'.$qty.'">
                            <span class="button__text add-to-cart "><i class="fas fa-heart" style=" color: #998c8c; font-size: 21px;"></i></span>
                        </button>';
                    }
                }
                else {
                    $btn = "<a href='cart' class='cart-button  btn btn-accent' style='width: fit-content;'>
                            Go to cart
                    </a>
                    ";
                    $btn1 = "<div class='container' style='display:flex; justify-content:center;'>
                    <span class='pqt-minus btn d-block btn-light' data-qty='".$row['quantity']."' data-qty-code='".$qtyCode."' data-user='".$userid."' id='dec' data-price=' onclick=' dec(this)'=''>-</span>
                    <div class='cart-button  btn btn-primary'>
                    <span class='add-to-cart '></span>
                    <span data-value='1'>1</span>
                    <i class='fa fa-shopping-cart'></i>
                    </div>
                    <span class='pqt-plus btn d-block btn-light' data-qty='".$row['quantity']."' data-qty-code='".$qtyCode."' data-user='".$userid."' onclick='inc(this)' id='inc'>+</span>
                        </div>";
            }
            
            if($countOffer>0) {
                if($row['quantity']*$newprice>=199 OR (strpos($catsName, 'to us')>1 OR strpos($catsName, 'TO US')>1)){
                    $ship = '
                        <span class="freeship">FREE SHIPPING</span>
                    ';
                }
                else {
                    $ship = '';
                }
            }else {
                if($row['quantity']*$row['price']>=199 OR (strpos($catsName, 'to us')>1 OR strpos($catsName, 'TO US')>1)){
                    $ship = '
                        <span class="freeship">FREE SHIPPING</span>
                    ';
                }
                else {
                    $ship = '';
                }
            }
            
            if($countOffer>0){
                echo '
                <tr style="vertical-align: middle; position: relative; color: #000 !important;font-weight: 500; position: relative;">
                    
                    <td style="vertical-align: middle; ">'.$row['quantity'].'</td>
                    <td>'.$_SESSION["currency_symbol"].number_format((($newprice)*$_SESSION["currency_rate"]),2).'&nbsp;<small><del>'.$_SESSION["currency_symbol"].number_format(($row['price']*$_SESSION["currency_rate"]),2).'</del></small></td>
                    <td>
                        <div class="offer-pricing">
                            <div class="offer-price">
                                '.$_SESSION["currency_symbol"].number_format((($row['quantity']*$newprice)*$_SESSION["currency_rate"]),2)."&nbsp;<small class='ogPrice'>
                                <del>".$_SESSION["currency_symbol"].number_format((($row['quantity']*$row['price'])*$_SESSION["currency_rate"]),2).'</del></small>
                            </div>
                            '.$ship.'
                            <div class="tot-price">
                                '.$discount.'%Off
                            </div>
                        <div>
                    </td>
                    <td style="display: flex;">'.$btn.'</td>
                </tr>
                ';
            }else {
            echo '
                <tr style="vertical-align: middle; position: relative; color: #000 !important;font-weight: 500;">
                    
                    <td>'.$row['quantity'].'</td>
                    <td>'.$_SESSION["currency_symbol"].number_format(($row['price']*$_SESSION["currency_rate"]),2).'</td>
                    <td >'.$ship.''.$_SESSION["currency_symbol"].number_format((($row['quantity']*$row['price'])*$_SESSION["currency_rate"]),2).'</td>
                    
                    <td style="display: flex;">'.$btn.'</td>
                </tr>
                ';
            }
                
                
                
        }
        
        echo "
            </table>
        </div>
        ";
    }
    
    echo "</div>";
    
    
    // $select_stmt=$conn->prepare("SELECT * FROM ogquantity WHERE strengthCode = '$strength'");	
    // $select_stmt->execute();
    // $quantityRowCount=$select_stmt->rowCount();
    // if($quantityRowCount > 0) {
    //     while($row=$select_stmt->fetch(PDO::FETCH_ASSOC)){
    //         $qtyCode = $row['quantityCode'];
    //         $getStatus=$conn->prepare("SELECT * FROM ogcart WHERE quantityCode = '$qtyCode' && userId = '$userid'");
    //         $getStatus->execute();
            
    //         $getStatus = $getStatus->fetch(PDO::FETCH_ASSOC);
    //         if($getStatus) {
    //             $status = 'activeQty';
    //         }
    //         else {
    //             $status='dd';
    //         }
    //         $total_p = $row['quantity'] * $row['price'];
    //         if(($row['quantity'] * $row['price']) > 400) {
    //             $class = "";
    //         }
    //         else {
    //             $class = "";
    //         }
    //         $output1 = "
    //             <label class='switch'>
    //                 <input type='radio' class='{$status} listQuantity' id='quantity' data-product-name='{$productName}' data-product-image='{$productImage}' data-product-type='{$type}' data-strength-id='{$strength}' data-strength='{$strength_amount}' data-quantity-id='{$row['quantityCode']}' data-quantity='{$row['quantity']}' data-price='{$row['price']}' data-product-code='{$row['productCode']}' name='quantity' onChange='quantity(this)' value='{$row['quantity']}'>
    //                 <span class='sliders {$class}'>
    //                     <span class='qty'>{$row['quantity']} <small>{$type}</small></span>
    //                     <span class='price'>$".$row['price']."/{$type}<span class='total_p'>$ {$total_p}</span></span> 
    //             ";   
    //             $option = "<span class='fship'>FREE SHIPPING</span><i class='fa-solid fa-truck f-ship sliderss'></i>";
    //             $output2 = "     
    //                 </span>
    //             </label>
    //         ";

    //         if(($row['quantity'] * $row['price']) > 250) {
    //             $output = $output1.$option.$output2;
    //         }
    //         else {
    //             $output = $output1.$output2;
    //         }
    //         echo $output;
    //     }
    // }else {
    //     echo "Quantity Not Found For This Strength";
    // }

?>