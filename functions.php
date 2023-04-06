<?php
    function cartStrength($conn, $productCode,$userid) {
        $strnArr = array();
        $getCartItem = $conn->prepare('SELECT * FROM ogcart WHERE userId=? AND productCode=? ORDER BY id DESC');
        $getCartItem->execute([$userid,$productCode]);
        while($row=$getCartItem->fetch(PDO::FETCH_ASSOC)) {
            $strengthCode = $row['strengthCode'];
            array_push($strnArr, $strengthCode);
        }
        return $strnArr;
    }

    function cartQuantity($conn, $productCode, $strengthCode, $userid) {
        $strnArr = array();
        $getCartItem = $conn->prepare('SELECT * FROM ogcart WHERE userId=? AND productCode=? AND strengthCode=? ORDER BY id DESC');
        $getCartItem->execute([$userid,$productCode,$strengthCode]);
        while($row=$getCartItem->fetch(PDO::FETCH_ASSOC)) {
            $quantityCode = $row['quantityCode'];
            array_push($strnArr, $quantityCode);
        }
        return $strnArr;
    }
    

    function productStrength($conn, $productCode) {
        $strnArr = array();
        $getStrength = $conn->prepare('SELECT * FROM ogstrength WHERE productCode=? ORDER BY strengthName ASC');
        $getStrength->execute([$productCode]);
        while($row=$getStrength->fetch(PDO::FETCH_ASSOC)) {
            $strengthCode = $row['strengthCode'];
            array_push($strnArr, $strengthCode);
        }
        return $strnArr;
    }

    function productQuantity($conn,$productCode,$strengthCode) {
        $qtyArr = array();
        $getQuantity = $conn->prepare('SELECT * FROM ogquantity WHERE strengthCode=? AND productCode=? AND quantity!=120 ORDER BY quantity ASC');
        $getQuantity->execute([$strengthCode,$productCode]);
        while($row1 = $getQuantity->fetch(PDO::FETCH_ASSOC)) {
            $quantityCode = $row1['quantityCode'];
            array_push($qtyArr, $quantityCode);
        }
        return $qtyArr;
    }

    function lowestStrnPrice($conn,$strengthCode) {
        $getQuantity = $conn->prepare('SELECT * FROM ogquantity WHERE strengthCode=? AND quantity!=120 ORDER BY price ASC LIMIT 1');
        $getQuantity->execute([$strengthCode]);
        while($row1 = $getQuantity->fetch(PDO::FETCH_ASSOC)) {
            $quantityPrice = $row1['price'];
        }
        return $quantityPrice;
    }

    function getProductInfo($conn, $productSlug) {
        $proArray = array();
        $select_product=$conn->prepare("SELECT * FROM ogproduct WHERE productSlug=? AND productStatus=?");
        $select_product->execute([$productSlug, 'active']);  
        $row_count=$select_product->rowCount();
        while($row=$select_product->fetch(PDO::FETCH_ASSOC))
        {
            $proArray['code'] = $row['productCode'];
            $proArray['category'] = $row['productCategory'];
            $proArray['active'] = $row_count;
        }
        
        return $proArray;
        
    }

    function getProductInfoByCode($conn,$productCode) {
        $proArray = array();
        $select_product=$conn->prepare("SELECT ogproduct.productCode, ogproduct.productStatus, ogproduct.productType,ogproduct.productSlug, ogproduct.productCategory, ogproduct.productName, ogproduct.productDescription, ogproductuse.data AS productUse, ogproductsideeffect.data AS sideeffect, ogproductwarning.data AS warning, ogproductinteraction.data AS interaction, ogproductManufacturedBy.manufactureName AS manufacture, ogproductuseDrugAbuse.data AS abuse, ogproductWithdrawalSymptoms.data AS symptoms, ogproductstorage.data AS storage FROM ogproduct INNER JOIN ogproductuse ON ogproduct.productCode=ogproductuse.productCode INNER JOIN ogproductsideeffect ON ogproduct.productCode=ogproductsideeffect.productCode INNER JOIN ogproductwarning ON ogproduct.productCode=ogproductwarning.productCode INNER JOIN ogproductinteraction ON ogproduct.productCode=ogproductinteraction.productCode INNER JOIN ogproductManufacturedBy ON ogproduct.productCode=ogproductManufacturedBy.productCode 
        INNER JOIN ogproductuseDrugAbuse ON ogproduct.productCode=ogproductuseDrugAbuse.productCode
        INNER JOIN ogproductWithdrawalSymptoms ON ogproduct.productCode=ogproductWithdrawalSymptoms.productCode
        INNER JOIN ogproductstorage ON ogproduct.productCode=ogproductstorage.productCode
        WHERE ogproduct.productCode=? AND productStatus='active'");
        $select_product->execute([$productCode]);  
        $row=$select_product->rowCount();
        while($row=$select_product->fetch(PDO::FETCH_ASSOC))
        {
            $proArray['code'] = $row['productCode'];
            $proArray['category'] = $row['productCategory'];
            $proArray['name'] = $row['productName'];
            $proArray['description'] = $row['productDescription'];
            $proArray['slug'] = $row['productSlug'];
            $proArray['use'] = $row['productUse'];
            $proArray['sideeffect'] = $row['sideeffect'];
            $proArray['warning'] = $row['warning'];
            $proArray['interaction'] = $row['interaction'];
            $proArray['productStatus'] = $row['productStatus'];
            $proArray['abuse'] = $row['abuse'];
            $proArray['symptoms'] = $row['symptoms'];
            $proArray['storage'] = $row['storage'];
            $proArray['manufacture'] = $row['manufacture'];
            $proArray['productType'] = $row['productType'];
        }
        $brandName="";
        $selectBrand=$conn->prepare("SELECT * FROM ogproductaltname WHERE productCode='$productCode' ");
        $selectBrand->execute();
        while($row=$selectBrand->fetch(PDO::FETCH_ASSOC))
        {
            $altname = $row['productAltName'].", ";
            $brandName = $brandName.$altname;
        }
        $proArray['brandName'] = $brandName;

        $genericName="";
        $selectGeneric=$conn->prepare("SELECT * FROM ogproductingredient WHERE productCode='$productCode' ");
        $selectGeneric->execute();
        while($row=$selectGeneric->fetch(PDO::FETCH_ASSOC))
        {
            $genname = $row['productIngredientName'].", ";
            $genericName = $genericName.$genname;
        }
        $proArray['genericName'] = $genericName;

        return $proArray;
        
    }

    function getProductImage($conn, $productCode){
        $proImage = array();
        $getProductImage = $conn->prepare('SELECT * FROM ogproduct WHERE productCode=?');
        $getProductImage->execute([$productCode]);
        while($row=$getProductImage->fetch(PDO::FETCH_ASSOC)){
            array_push($proImage, $row['productImage']);
        }

        $getProductImageTable = $conn->prepare('SELECT * FROM ogProductExtraImage WHERE productCode=?');
        $getProductImageTable->execute([$productCode]);
        while($row=$getProductImageTable->fetch(PDO::FETCH_ASSOC)){
            array_push($proImage, $row['path']);
        }
        return $proImage;
    }



    function getDiscount($conn,$qtyCode,$strengthCode,$productCode,$categoryName) {
        $discount=0;
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
                    $cat =  (explode(",",$categoryName));
                    $category = array();
                    foreach($cat AS $x) {
                        array_push($category,"'".$x."'");
                    }

                    $categoryName = (implode(",",$category));
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
                                // $newprice = ($row['price']-($row['price']*($discount/100)));
                            }
                        }
                    }else {
                        while($crow=$selectOffer->fetch(PDO::FETCH_ASSOC)){
                            $discount = $crow['discount'];
                            // $newprice = ($row['price']-($row['price']*($discount/100)));
                        }
                    }
                }else {
                    while($crow=$selectOffer->fetch(PDO::FETCH_ASSOC)){
                        $discount = $crow['discount'];
                        // $newprice = ($row['price']-($row['price']*($discount/100)));
                    }
                }
                
            }
            else {
                while($crow=$selectOffer->fetch(PDO::FETCH_ASSOC)){
                    $discount = $crow['discount'];
                    // $newprice = ($row['price']-($row['price']*($discount/100)));
                }
            }
            
        }
        else {
            while($crow=$selectOffer->fetch(PDO::FETCH_ASSOC)){
                $discount = $crow['discount'];
                // $newprice = ($row['price']-($row['price']*($discount/100)));
            }
        }
        return $discount;
    }

    function usaToUsa($conn, $productName, $strengthName, $quantityName) {
        $usa = array();
        $matchUsa = $conn->prepare("SELECT * FROM ogproduct WHERE productName LIKE '%".$productName."%' AND productName LIKE '%USA to USA%' AND productStatus='active'");
        $matchUsa->execute();
        $countProduct=$matchUsa->rowCount();
        if($countProduct>0){
            while($row=$matchUsa->fetch(PDO::FETCH_ASSOC)){
                $productCode = $row['productCode'];
                $categoryName = $row['productCategory'];
            }
            $matchUsa = $conn->prepare("SELECT * FROM ogstrength WHERE strengthName=? AND productCode=?");
            $matchUsa->execute([$strengthName, $productCode]);
            $countStrength=$matchUsa->rowCount();
            if($countStrength>0){
                while($row=$matchUsa->fetch(PDO::FETCH_ASSOC)){
                    $strengthCode = $row['strengthCode'];
                }
                $matchUsa = $conn->prepare("SELECT * FROM ogquantity WHERE quantity=? AND strengthCode=? AND productCode=?");
                $matchUsa->execute([$quantityName, $strengthCode, $productCode]);
                $countQty=$matchUsa->rowCount();
                if($countQty>0){
                    $usa['isUSA']=1;
                    while($row=$matchUsa->fetch(PDO::FETCH_ASSOC)){
                        $discount = getDiscount($conn,$row['quantityCode'],$strengthCode,$productCode,$categoryName);
                        $usa['code']=$row['quantityCode'];
                        $usa['price']=$row['price'];
                        $usa['ogprice']=$row['ogprice'];
                        $usa['productCode']=$productCode;
                        $usa['strengthCode']=$strengthCode;
                        $usa['categoryName']=$categoryName;
                        $usa['discount']=$discount;
                        $usa['qty']=$row['quantity'];
                        $usaCart = cartQuantity($conn, $productCode, $strengthCode, $_COOKIE["userID"]);
                        if(in_array($row['quantityCode'],$usaCart)){
                            $usa['oncart']='yes';
                        }else {
                            $usa['oncart']='no';
                        }
                    }
                }else {
                    $usa['isUSA']=0;
                }
            }else {
                $usa['isUSA']=0;
            }
        }else {
            $usa['isUSA']=0;
        }

        return $usa;
    }

    function getUsaCode($conn, $productName) {
        $usa = array();
        $matchUsa = $conn->prepare("SELECT * FROM ogproduct WHERE productName LIKE '%".$productName."%' AND productName LIKE '%USA to USA%'  AND productStatus='active'");
        $matchUsa->execute();
        $countProduct=$matchUsa->rowCount();
        if($countProduct>0){
            while($row=$matchUsa->fetch(PDO::FETCH_ASSOC)){
                $productCode = $row['productCode'];
                $usa['productCode']=$productCode;
                $usa['usaAvail']=1;
            }
        }else {
            $usa['usaAvail']=0;
        }

        return $usa;
    }

    function getNewCode($conn, $productName) {
        $usa = array();
        $productName = str_replace(" USA to USA", '', $productName);
        $matchUsa = $conn->prepare("SELECT * FROM ogproduct WHERE productName = '".$productName."'  AND productStatus='active'");
        $matchUsa->execute();
        $countProduct=$matchUsa->rowCount();
        if($countProduct>0){
            while($row=$matchUsa->fetch(PDO::FETCH_ASSOC)){
                $productCode = $row['productCode'];
                $usa['productCode']=$productCode;
                $usa['globeAvail']=1;
            }
        }else {
            $usa['globeAvail']=0;
        }

        return $usa;
    }

    function getrelatedProductCategoryfromProductCode($conn, $productCodeArray){  
        // echo "<pre>";
        // print_r($productCodeArray);
        // echo "</pre>";
    
        $product = array();
        $strengthArray = array();
        $productArray = array();
        $inc = 0;
        foreach($productCodeArray AS $productCode){
            $cartStrength1 = cartStrength($conn,$productCode, $_COOKIE["userID"]);
            $productStrength1 = productStrength($conn,$productCode);   
            $result=array_intersect($cartStrength1,$productStrength1);
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
                
                while($strengthRow = $getStrength->fetch(PDO::FETCH_ASSOC)){
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
                    $product[$inc]['product']['abuse'] = $productInfo['abuse'];
                    $product[$inc]['product']['symptoms'] = $productInfo['symptoms'];
                    $product[$inc]['product']['storage'] = $productInfo['storage'];
                    $product[$inc]['product']['productType']=$productInfo['productType'];
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
                    $imageArray = getProductImage($conn,$productCode);
                    $img=0;
                    foreach($imageArray AS $x){
                    $product[$inc]['product']['image'][$img]=$x;
                        $img++;
                    }
                    
                    $product[$inc]['strength']["$strengthName"]['active']=$active;
                    $product[$inc]['strength']["$strengthName"]['code']=$strengthCode;
                    
                    $j=0;
                    $checkUsaCart = $conn->prepare('SELECT * FROM ogquantity WHERE strengthCode=? AND productCode=? ORDER BY quantity ASC');
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
    
                        $getQuantity1 = $conn->prepare('SELECT * FROM ogquantity WHERE strengthCode=? AND productCode=? ORDER BY quantity ASC ');
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
                    $getQuantity = $conn->prepare('SELECT * FROM ogquantity WHERE strengthCode=? AND productCode=? ORDER BY quantity ASC');
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
        return $product;
    }
    
    