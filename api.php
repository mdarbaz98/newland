<?php
    include('include/database.php');
    include('functions.php');
    header("Content-type:application/json");
    header("Access-Control-Allow-Origin: *");
    session_start();
    $userid = $_COOKIE["userID"];
    $requestType = $_GET['requestType'];

    if($requestType=='wishlist') {
        $productCodeArray = array();
       echo $requestType = $_GET['requestType'];
        //echo $productCategorySlug = $_GET['productCode'];
        // $productCategorySlug = "Asthama Medication";
    //     $prductCategoryModify = str_replace("-"," ",$productCategorySlug);
    //     $productSlugNew = ucwords($prductCategoryModify);
        
    //     $getProductCode=$conn->prepare("SELECT productCode FROM ogproduct WHERE productStatus='active' && productCategory LIKE '%".$productSlugNew."%' ORDER BY productId ASC");
    //     $getProductCode->execute();
    //     while($row=$getProductCode->fetch(PDO::FETCH_ASSOC)) {
    //         array_push($productCodeArray,$row['productCode']);
    //     }
        
    //     $cartStrength = cartStrength($conn,$productCode, $_COOKIE["userID"]);
    //     $productStrength = productStrength($conn,$productCode);

    //     $result=array_intersect($cartStrength,$productStrength);
    //     if(!empty(array_intersect($cartStrength,$productStrength))) {
    //         $strn = array_intersect($cartStrength,$productStrength)[0];
    //         $position = array_search($strn, $productStrength)+1;
    //     }else {
    //         $position = 1;
    //     }
    //    $product = getrelatedProductCategoryfromProductCode($conn, $productCodeArray);        
    }
    
    if($requestType=='category') {
        $productCodeArray = array();
        $productCategorySlug = $_GET['productCode'];
        // $productCategorySlug = "Asthama Medication";
        $prductCategoryModify = str_replace("-"," ",$productCategorySlug);
        $productSlugNew = ucwords($prductCategoryModify);
        
        $getProductCode=$conn->prepare("SELECT productCode FROM ogproduct WHERE productStatus='active' && productCategory LIKE '%".$productSlugNew."%' ORDER BY productId ASC");
        $getProductCode->execute();
        while($row=$getProductCode->fetch(PDO::FETCH_ASSOC)) {
            array_push($productCodeArray,$row['productCode']);
        }
        
        $cartStrength = cartStrength($conn,$productCode, $_COOKIE["userID"]);
        $productStrength = productStrength($conn,$productCode);

        $result=array_intersect($cartStrength,$productStrength);
        if(!empty(array_intersect($cartStrength,$productStrength))) {
            $strn = array_intersect($cartStrength,$productStrength)[0];
            $position = array_search($strn, $productStrength)+1;
        }else {
            $position = 1;
        }
       $product = getrelatedProductCategoryfromProductCode($conn, $productCodeArray);        
    }

    if($requestType=='product') {
        $productCode = $_GET['productCode'];
        $i=0;
        $product = array();
        $strengthArray = array();
        $productArray = array();
        
        $cartStrength = cartStrength($conn,$productCode, $_COOKIE["userID"]);
        $productStrength = productStrength($conn,$productCode);

        $result=array_intersect($cartStrength,$productStrength);
        if(!empty(array_intersect($cartStrength,$productStrength))) {
            $strn = array_intersect($cartStrength,$productStrength)[0];
            $position = array_search($strn, $productStrength)+1;
        }else {
            $position = 1;
        }
        $usaget = 0;
        $rm_array_strength=array();
        $strength_sort_array=array();
        $getStrength = $conn->prepare('SELECT * FROM ogstrength WHERE productCode=? ORDER BY strengthName ASC');
        $getStrength->execute([$productCode]);
        while($strengthRow = $getStrength->fetch(PDO::FETCH_ASSOC)) {
            $active2;
            ++$i;
            $active = $position==$i ? 1 : 0;
            $strengthName = $strengthRow['strengthName'];
            $strengthCode = $strengthRow['strengthCode'];

            // $strength_name = $strengthRow['strengthName'];
            // $remove_stren_mg = str_replace("mg","",$strength_name);
            // //$remove_stren_mg_integer = (int)$remove_stren_mg;
            // array_push($rm_array_strength, $remove_stren_mg);
            // sort($rm_array_strength);
            

            // foreach($rm_array_strength as $sort_strength){
            //     $strength_sort_name = $sort_strength."mg";

            // }
            
            // array_push($strength_sort_array, $strength_sort_name);            

            // echo "<pre>";
            // print_r($strength_sort_array);
            // echo "</pre>";
           // exit();
            // $rm_mg = $rm_array_strength[0];

            
            array_push($strengthArray, $strengthCode);

            $productInfo = getProductInfoByCode($conn,$productCode);
            $productName = $productInfo['name'];
            $productCategory = explode(",",$productInfo['category']);
            $product['product']['name']=$productName;
            $product['product']['code']=$productCode;
            $product['product']['category']=$productCategory[0];
            $product['product']['brand']=$productInfo['brandName'];
            $product['product']['description']=$productInfo['description'];
            $product['product']['use']=$productInfo['use'];
            $product['product']['sideeffect']=$productInfo['sideeffect'];
            $product['product']['warning']=$productInfo['warning'];
            $product['product']['interaction']=$productInfo['interaction'];
            $product['product']['productStatus']=$productInfo['productStatus'];
            $product['product']['productType']=$productInfo['productType'];
            $product['product']['abuse']=$productInfo['abuse'];
            $product['product']['symptoms']=$productInfo['symptoms'];
            $product['product']['storage']=$productInfo['storage'];
            $product['product']['manufacture']=$productInfo['manufacture'];
            if(strpos($productName,'to US')){
                $product['product']['type'] = 'USA';
                $globeinfo = getNewCode($conn, $productName);
                if($globeinfo['globeAvail']==1){
                    $product['product']['globeAvail'] = 1;
                    $product['product']['globeCode'] = $globeinfo['productCode'];
                }else {
                    $product['product']['globeAvail'] = 0;
                }
            }else {
                $product['product']['type'] = 'global';
                $usaproinfo = getUsaCode($conn, $productName);
                if($usaproinfo['usaAvail']==1){
                    $product['product']['usaAvail'] = 1;
                    $product['product']['usaCode'] = $usaproinfo['productCode'];
                }else {
                    $product['product']['usaAvail'] = 0;
                }
            }

            $product['product']['slug']=$productInfo['slug'];
            $product['product']['generic']=rtrim($productInfo['genericName'], ", ");
            
            
            $imageArray = getProductImage($conn,$productCode);
            $img=0;
            foreach($imageArray AS $x){
            $product['product']['image'][$img]=$x;
                $img++;
            }
            
            $product['strength']["$strengthName"]['active']=$active;
            $product['strength']["$strengthName"]['code']=$strengthCode;
            
            
            
            $j=0;
            $checkUsaCart = $conn->prepare('SELECT * FROM ogquantity WHERE strengthCode=? AND productCode=? AND quantity!=120 ORDER BY quantity ASC ');
            $checkUsaCart->execute([$strengthCode,$productCode]);
            while($checkUsaCartr = $checkUsaCart->fetch(PDO::FETCH_ASSOC)) {
                $cartQuantity = cartQuantity($conn, $productCode, $strengthCode,  $_COOKIE["userID"]);
                $productQuantity = productQuantity($conn,$productCode,$strengthCode);
                $quantityCode = $checkUsaCartr['quantityCode'];
                $quantityName = $checkUsaCartr['quantity'];
                $usatousa = usaToUsa($conn, $productName, $strengthName, $quantityName );
                if($usatousa['isUSA']==1){
                    $usaCode = $usatousa['code'];
                    if($usatousa['oncart']=='yes'){
                        $positionQty = array_search($quantityCode, $productQuantity)+1;
                        $usaget = 1;
                    }
                }
            }
            $cartQuantity = cartQuantity($conn, $productCode, $strengthCode,  $_COOKIE["userID"]);
            if($usaget==0){

                $getQuantity1 = $conn->prepare('SELECT * FROM ogquantity WHERE strengthCode=? AND productCode=? AND quantity!=120 ORDER BY quantity ASC ');
                $getQuantity1->execute([$strengthCode,$productCode]);
                while($quantityRow = $getQuantity1->fetch(PDO::FETCH_ASSOC)) {
                    $productQuantity = productQuantity($conn,$productCode,$strengthCode);
                    if(!empty(array_intersect($cartQuantity,$productQuantity))) {
                        $qty = array_intersect($cartQuantity,$productQuantity)[0];
                        $positionQty = array_search($qty, $productQuantity)+1;
                    }else {
                        $positionQty = 1;
                    }
                }
            }
            $getQuantity = $conn->prepare('SELECT * FROM ogquantity WHERE strengthCode=? AND productCode=? AND quantity!=120 ORDER BY quantity ASC ');
            $getQuantity->execute([$strengthCode,$productCode]);
            while($quantityRow = $getQuantity->fetch(PDO::FETCH_ASSOC)) {
                
                if (in_array($quantityRow['quantityCode'], $cartQuantity)){
                    $cartVal = 'yes';
                }else {
                    $cartVal = 'no';
                }
                ++$j;
                
                $quantity = $quantityRow['quantity'];
                $quantityCode = $quantityRow['quantityCode'];
                $quantityPrice = $quantityRow['price'];
                $quantityOgPrice = $quantityRow['ogprice'];
                $discount = getDiscount($conn, $quantityCode, $strengthCode, $productCode, $productInfo['category']);
                $usatousa = usaToUsa($conn, $productName, $strengthName, $quantity);
                if($positionQty==$j){
                    $active2 = 1;
                }else {
                    $active2 = 0;
                }
                $product['quantity']["$strengthName"]["code"]=$strengthCode;
                $product['quantity']["$strengthName"]["active"]=$active;
                $product['quantity']["$strengthName"]["quantity"]["$quantity"]['code']=$quantityCode;
                $product['quantity']["$strengthName"]["quantity"]["$quantity"]['price']=floatval($quantityPrice);
                $product['quantity']["$strengthName"]["quantity"]["$quantity"]['ogprice']=floatval($quantityOgPrice);
                $product['quantity']["$strengthName"]["quantity"]["$quantity"]['active']=$active2;
                $product['quantity']["$strengthName"]["quantity"]["$quantity"]['oncart']=$cartVal;
                $product['quantity']["$strengthName"]["quantity"]["$quantity"]['discount']=$discount;
                if($usatousa['isUSA']==1){
                    $product['quantity']["$strengthName"]["quantity"]["$quantity"]['isusa']=1;
                    $product['quantity']["$strengthName"]["quantity"]["$quantity"]['usa']['code']=$usatousa['code'];
                    $product['quantity']["$strengthName"]["quantity"]["$quantity"]['usa']['price']=$usatousa['price'];
                    $product['quantity']["$strengthName"]["quantity"]["$quantity"]['usa']['ogprice']=$usatousa['ogprice'];
                    $product['quantity']["$strengthName"]["quantity"]["$quantity"]['usa']['oncart']=$usatousa['oncart'];
                    $product['quantity']["$strengthName"]["quantity"]["$quantity"]['usa']['discount']=$usatousa['discount'];
                    $product['quantity']["$strengthName"]["quantity"]["$quantity"]['usa']['quantity']=$usatousa['qty'];
                }else {
                    $product['quantity']["$strengthName"]["quantity"]["$quantity"]['isusa']=0;
                }
                $leastPrice = lowestStrnPrice($conn, $strengthCode);
                $product['quantity']["$strengthName"]["leastPrice"] = round($leastPrice-($leastPrice*($discount/100)),2);
            }

        }
    }

    if($requestType=='relatedProduct') {
        $productCode = $_GET['productCode'];
        $productInfo = getProductInfoByCode($conn,$productCode);
        $productCodeArray = array();
        $productCategory = explode(",",$productInfo['category']);

        $totalCategory = count($productCategory);
        for($i=0;$i<$totalCategory;$i++) {
            $getProductCode=$conn->prepare("SELECT * FROM ogproduct WHERE productCategory LIKE '%".$productCategory[$i]."%' AND productStatus='active' LIMIT 6");
            $getProductCode->execute();
            while($row=$getProductCode->fetch(PDO::FETCH_ASSOC)) {
                array_push($productCodeArray,$row['productCode']);
            }
        }

        $productCodeList = implode(",",$productCodeArray);

        
        $product = array();
        $strengthArray = array();
        $productArray = array();
        
        $cartStrength = cartStrength($conn,$productCode, $_COOKIE["userID"]);
        $productStrength = productStrength($conn,$productCode);

        $result=array_intersect($cartStrength,$productStrength);
        if(!empty(array_intersect($cartStrength,$productStrength))) {
            $strn = array_intersect($cartStrength,$productStrength)[0];
            $position = array_search($strn, $productStrength)+1;
        }else {
            $position = 1;
        }

        // $getProductInfo = $conn->prepare('SELECT * ')
    
        
        $inc = 0;
        foreach($productCodeArray AS $productCode){
            

            $cartStrength1 = cartStrength($conn,$productCode, $_COOKIE["userID"]);
            $productStrength1 = productStrength($conn,$productCode);
            
            $result=array_intersect($cartStrength,$productStrength);
            
            if(!empty(array_intersect($cartStrength1,$productStrength1))) {
                $strn = array_intersect($cartStrength1,$productStrength1)[0];
                $position = array_search($strn, $productStrength1)+1;
            }else {
                $position = 1;
            }
            $i=0;
            $inc++;
            if($inc<20){
                $usaget = 0;
                $getStrength = $conn->prepare('SELECT * FROM ogstrength WHERE productCode=? ORDER BY strengthName ASC');
                $getStrength->execute([$productCode]);
                
                while($strengthRow = $getStrength->fetch(PDO::FETCH_ASSOC)) {
                    $active2;
                    ++$i;
                    $active = $position==$i ? 1 : 0;
                    $strengthName = $strengthRow['strengthName'];
                    $strengthCode = $strengthRow['strengthCode'];
                    
                    array_push($strengthArray, $strengthCode);

                    $productInfo = getProductInfoByCode($conn,$productCode);
                    $productName = $productInfo['name'];
                    $productCategory = explode(",",$productInfo['category']);
                    $product[$inc]['product']['name']=$productName;
                    $product[$inc]['product']['code']=$productCode;
                    $product[$inc]['product']['category']=$productCategory[0];
                    
                    $product[$inc]['product']['description']=$productInfo['description'];
                    $product[$inc]['product']['use']=$productInfo['use'];
                    $product[$inc]['product']['sideeffect']=$productInfo['sideeffect'];
                    $product[$inc]['product']['warning']=$productInfo['warning'];
                    $product[$inc]['product']['interaction']=$productInfo['interaction'];
                    $product[$inc]['product']['productStatus']=$productInfo['productStatus'];

                    if(strpos($productName,'to US')){
                        $product[$inc]['product']['type'] = 'USA';
                        $globeinfo = getNewCode($conn, $productName);
                        if($globeinfo['globeAvail']==1){
                            $product[$inc]['product']['globeAvail'] = 1;
                            $product[$inc]['product']['globeCode'] = $globeinfo['productCode'];
                        }else {
                            $product[$inc]['product']['globeAvail'] = 0;
                        }
                    }else {
                        $product[$inc]['product']['type'] = 'global';
                        $usaproinfo = getUsaCode($conn, $productName);
                        if($usaproinfo['usaAvail']==1){
                            $product[$inc]['product']['usaAvail'] = 1;
                            $product[$inc]['product']['usaCode'] = $usaproinfo['productCode'];
                        }else {
                            $product[$inc]['product']['usaAvail'] = 0;
                        }
                    }
                    $product[$inc]['product']['slug']=$productInfo['slug'];
                    $product[$inc]['product']['generic']=rtrim($productInfo['genericName'], ", ");
                    $product[$inc]['product']['productType'] = $productInfo['productType'];
                    $imageArray = getProductImage($conn,$productCode);
                    $img=0;
                    foreach($imageArray AS $x){
                    $product[$inc]['product']['image'][$img]=$x;
                        $img++;
                    }
                    
                    $product[$inc]['strength']["$strengthName"]['active']=$active;
                    $product[$inc]['strength']["$strengthName"]['code']=$strengthCode;
                    
                    
                    
                    $j=0;
                    $checkUsaCart = $conn->prepare('SELECT * FROM ogquantity WHERE strengthCode=? AND productCode=? AND quantity!=120 ORDER BY quantity ASC ');
                    $checkUsaCart->execute([$strengthCode,$productCode]);
                    while($checkUsaCartr = $checkUsaCart->fetch(PDO::FETCH_ASSOC)) {
                        $cartQuantity = cartQuantity($conn, $productCode, $strengthCode,  $_COOKIE["userID"]);
                        $productQuantity = productQuantity($conn,$productCode,$strengthCode);
                        $quantityCode = $checkUsaCartr['quantityCode'];
                        $quantityName = $checkUsaCartr['quantity'];
                        $usatousa = usaToUsa($conn, $productName, $strengthName, $quantityName );
                        if($usatousa['isUSA']==1){
                            $usaCode = $usatousa['code'];
                            if($usatousa['oncart']=='yes'){
                                $positionQty = array_search($quantityCode, $productQuantity)+1;
                                // $usaget = 1;
                            }
                        }
                    }
                    $cartQuantity = cartQuantity($conn, $productCode, $strengthCode,  $_COOKIE["userID"]);
                    if($usaget==0){

                        $getQuantity1 = $conn->prepare('SELECT * FROM ogquantity WHERE strengthCode=? AND productCode=? AND quantity!=120 ORDER BY quantity ASC ');
                        $getQuantity1->execute([$strengthCode,$productCode]);
                        while($quantityRow = $getQuantity1->fetch(PDO::FETCH_ASSOC)) {
                            $productQuantity = productQuantity($conn,$productCode,$strengthCode);
                            if(!empty(array_intersect($cartQuantity,$productQuantity))) {
                                $qty = array_intersect($cartQuantity,$productQuantity)[0];
                                $positionQty = array_search($qty, $productQuantity)+1;
                            }else {
                                $usatousa = usaToUsa($conn, $productName, $strengthName, $quantityName );
                                if($usatousa['isUSA']==1){
                                    if($usatousa['oncart']=='yes'){
                                        $positionQty = array_search($quantityCode, $productQuantity)+1;
                                    }else {
                                        $positionQty = 1;
                                    }
                                }else {
                                    $positionQty = 1;
                                }
                            }
                        }
                    }
                    $getQuantity = $conn->prepare('SELECT * FROM ogquantity WHERE strengthCode=? AND productCode=? AND quantity!=120 ORDER BY quantity ASC ');
                    $getQuantity->execute([$strengthCode,$productCode]);
                    while($quantityRow = $getQuantity->fetch(PDO::FETCH_ASSOC)) {
                        
                        if (in_array($quantityRow['quantityCode'], $cartQuantity)){
                            $cartVal = 'yes';
                        }else {
                            $cartVal = 'no';
                        }
                        ++$j;
                        
                        $quantity = $quantityRow['quantity'];
                        $quantityCode = $quantityRow['quantityCode'];
                        $quantityPrice = $quantityRow['price'];
                        $quantityOgPrice = $quantityRow['ogprice'];
                        $discount = getDiscount($conn, $quantityCode, $strengthCode, $productCode, $productInfo['category']);
                        $usatousa = usaToUsa($conn, $productName, $strengthName, $quantity);
                        if($positionQty==$j){
                            $active2 = 1;
                        }else {
                            $active2 = 0;
                        }
                        $product[$inc]['quantity']["$strengthName"]["code"]=$strengthCode;
                        $product[$inc]['quantity']["$strengthName"]["active"]=$active;
                        $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['code']=$quantityCode;
                        $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['price']=floatval($quantityPrice);
                        $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['ogprice']=floatval($quantityOgPrice);
                        $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['active']=$active2;
                        $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['oncart']=$cartVal;
                        $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['discount']=$discount;
                        if($usatousa['isUSA']==1){
                            $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['isusa']=1;
                            $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['usa']['code']=$usatousa['code'];
                            $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['usa']['price']=$usatousa['price'];
                            $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['usa']['ogprice']=$usatousa['ogprice'];
                            $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['usa']['oncart']=$usatousa['oncart'];
                            $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['usa']['discount']=$usatousa['discount'];
                            $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['usa']['quantity']=$usatousa['qty'];
                        }else {
                            $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['isusa']=0;
                        }
                    }
                }
            }
            
        }
        
        
    }

    if($requestType=='singleRelatedProduct') {
        $productCode = $_GET['productCode'];
        $productCodeArray = array();
        array_push($productCodeArray,$productCode);
        $productCodeList = implode(",",$productCodeArray);
        $product = array();
        $strengthArray = array();
        $productArray = array();        
        $cartStrength = cartStrength($conn,$productCode, $_COOKIE["userID"]);
        $productStrength = productStrength($conn,$productCode);
        $result=array_intersect($cartStrength,$productStrength);
        if(!empty(array_intersect($cartStrength,$productStrength))) {
            $strn = array_intersect($cartStrength,$productStrength)[0];
            $position = array_search($strn, $productStrength)+1;
        }else {
            $position = 1;
        }

        // $getProductInfo = $conn->prepare('SELECT * ')
    
        
        $inc = 0;
        foreach($productCodeArray AS $productCode){
            

            $cartStrength1 = cartStrength($conn,$productCode, $_COOKIE["userID"]);
            $productStrength1 = productStrength($conn,$productCode);
            $result=array_intersect($cartStrength,$productStrength);
            if(!empty(array_intersect($cartStrength1,$productStrength1))) {
                $strn = array_intersect($cartStrength1,$productStrength1)[0];
                $position = array_search($strn, $productStrength1)+1;
            }else {
                $position = 1;
            }
            $i=0;
            $inc++;
            if($inc<20){
                $usaget = 0;
                $getStrength = $conn->prepare('SELECT * FROM ogstrength WHERE productCode=? ORDER BY strengthName ASC');
                $getStrength->execute([$productCode]);
                while($strengthRow = $getStrength->fetch(PDO::FETCH_ASSOC)) {
                    $active2;
                    ++$i;
                    $active = $position==$i ? 1 : 0;
                    $strengthName = $strengthRow['strengthName'];
                    $strengthCode = $strengthRow['strengthCode'];
                    
                    array_push($strengthArray, $strengthCode);

                    $productInfo = getProductInfoByCode($conn,$productCode);
                    $productName = $productInfo['name'];
                    $productCategory = explode(",",$productInfo['category']);
                    $product[$inc]['product']['name']=$productName;
                    $product[$inc]['product']['code']=$productCode;
                    $product[$inc]['product']['category']=$productCategory[0];
                    
                    $product[$inc]['product']['description']=$productInfo['description'];
                    $product[$inc]['product']['use']=$productInfo['use'];
                    $product[$inc]['product']['sideeffect']=$productInfo['sideeffect'];
                    $product[$inc]['product']['warning']=$productInfo['warning'];
                    $product[$inc]['product']['interaction']=$productInfo['interaction'];

                    if(strpos($productName,'to US')){
                        $product[$inc]['product']['type'] = 'USA';
                        $globeinfo = getNewCode($conn, $productName);
                        if($globeinfo['globeAvail']==1){
                            $product[$inc]['product']['globeAvail'] = 1;
                            $product[$inc]['product']['globeCode'] = $globeinfo['productCode'];
                        }else {
                            $product[$inc]['product']['globeAvail'] = 0;
                        }
                    }else {
                        $product[$inc]['product']['type'] = 'global';
                        $usaproinfo = getUsaCode($conn, $productName);
                        if($usaproinfo['usaAvail']==1){
                            $product[$inc]['product']['usaAvail'] = 1;
                            $product[$inc]['product']['usaCode'] = $usaproinfo['productCode'];
                        }else {
                            $product[$inc]['product']['usaAvail'] = 0;
                        }
                    }
                    $product[$inc]['product']['slug']=$productInfo['slug'];
                    $product[$inc]['product']['generic']=rtrim($productInfo['genericName'], ", ");
                    $product[$inc]['product']['productType'] = $productInfo['productType'];

                    $imageArray = getProductImage($conn,$productCode);
                    $img=0;
                    foreach($imageArray AS $x){
                    $product[$inc]['product']['image'][$img]=$x;
                        $img++;
                    }
                    
                    $product[$inc]['strength']["$strengthName"]['active']=$active;
                    $product[$inc]['strength']["$strengthName"]['code']=$strengthCode;
                    
                    
                    
                    $j=0;
                    $checkUsaCart = $conn->prepare('SELECT * FROM ogquantity WHERE strengthCode=? AND productCode=?  AND quantity!=120 ORDER BY quantity ASC ');
                    $checkUsaCart->execute([$strengthCode,$productCode]);
                    while($checkUsaCartr = $checkUsaCart->fetch(PDO::FETCH_ASSOC)) {
                        $cartQuantity = cartQuantity($conn, $productCode, $strengthCode,  $_COOKIE["userID"]);
                        $productQuantity = productQuantity($conn,$productCode,$strengthCode);
                        $quantityCode = $checkUsaCartr['quantityCode'];
                        $quantityName = $checkUsaCartr['quantity'];
                        $usatousa = usaToUsa($conn, $productName, $strengthName, $quantityName );
                        if($usatousa['isUSA']==1){
                            $usaCode = $usatousa['code'];
                            if($usatousa['oncart']=='yes'){
                                $positionQty = array_search($quantityCode, $productQuantity)+1;
                                // $usaget = 1;
                            }
                        }
                    }
                    $cartQuantity = cartQuantity($conn, $productCode, $strengthCode,  $_COOKIE["userID"]);
                    if($usaget==0){

                        $getQuantity1 = $conn->prepare('SELECT * FROM ogquantity WHERE strengthCode=? AND productCode=? AND quantity!=120 ORDER BY quantity ASC ');
                        $getQuantity1->execute([$strengthCode,$productCode]);
                        while($quantityRow = $getQuantity1->fetch(PDO::FETCH_ASSOC)) {
                            $productQuantity = productQuantity($conn,$productCode,$strengthCode);
                            if(!empty(array_intersect($cartQuantity,$productQuantity))) {
                                $qty = array_intersect($cartQuantity,$productQuantity)[0];
                                $positionQty = array_search($qty, $productQuantity)+1;
                            }else {
                                $usatousa = usaToUsa($conn, $productName, $strengthName, $quantityName );
                                if($usatousa['isUSA']==1){
                                    if($usatousa['oncart']=='yes'){
                                        $positionQty = array_search($quantityCode, $productQuantity)+1;
                                    }else {
                                        $positionQty = 1;
                                    }
                                }else {
                                    $positionQty = 1;
                                }
                            }
                        }
                    }
                    $getQuantity = $conn->prepare('SELECT * FROM ogquantity WHERE strengthCode=? AND productCode=? AND quantity!=120 ORDER BY quantity ASC ');
                    $getQuantity->execute([$strengthCode,$productCode]);
                    while($quantityRow = $getQuantity->fetch(PDO::FETCH_ASSOC)) {
                        
                        if (in_array($quantityRow['quantityCode'], $cartQuantity)){
                            $cartVal = 'yes';
                        }else {
                            $cartVal = 'no';
                        }
                        ++$j;
                        
                        $quantity = $quantityRow['quantity'];
                        $quantityCode = $quantityRow['quantityCode'];
                        $quantityPrice = $quantityRow['price'];
                        $quantityOgPrice = $quantityRow['ogprice'];
                        $discount = getDiscount($conn, $quantityCode, $strengthCode, $productCode, $productInfo['category']);
                        $usatousa = usaToUsa($conn, $productName, $strengthName, $quantity);
                        if($positionQty==$j){
                            $active2 = 1;
                        }else {
                            $active2 = 0;
                        }
                        $product[$inc]['quantity']["$strengthName"]["code"]=$strengthCode;
                        $product[$inc]['quantity']["$strengthName"]["active"]=$active;
                        $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['code']=$quantityCode;
                        $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['price']=floatval($quantityPrice);
                        $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['ogprice']=floatval($quantityOgPrice);
                        $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['active']=$active2;
                        $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['oncart']=$cartVal;
                        $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['discount']=$discount;
                        if($usatousa['isUSA']==1){
                            $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['isusa']=1;
                            $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['usa']['code']=$usatousa['code'];
                            $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['usa']['price']=$usatousa['price'];
                            $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['usa']['ogprice']=$usatousa['ogprice'];
                            $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['usa']['oncart']=$usatousa['oncart'];
                            $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['usa']['discount']=$usatousa['discount'];
                            $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['usa']['quantity']=$usatousa['qty'];
                        }else {
                            $product[$inc]['quantity']["$strengthName"]["quantity"]["$quantity"]['isusa']=0;
                        }
                    }
                }
            }
            
        }
        
        
    }

    // echo "<pre>";
    $jsonData = json_encode($product, JSON_PRETTY_PRINT);
    echo $jsonData; 

