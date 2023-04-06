<?php
    function getStrengthname($conn, $strengthCode){
        $getStrength = $conn->prepare('SELECT * FROM ogstrength WHERE strengthCode=? ORDER BY strengthName ASC');
        $getStrength->execute([$strengthCode]);
        while($row=$getStrength->fetch(PDO::FETCH_ASSOC)) {
            return $strengthName = $row['strengthName'];
            //array_push($strnArr, $strengthCode);
        }
    }

    // get product information
    function getProductInfoByCode($conn,$productCode) {
        $proArray = array();
        $select_product=$conn->prepare("SELECT ogproduct.productCode,ogproduct.productType,ogproduct.productSlug, ogproduct.productCategory, ogproduct.productName, ogproduct.productDescription,  ogproductuse.data AS productUse, ogproductsideeffect.data AS sideeffect, ogproductwarning.data AS warning, ogproductinteraction.data AS interaction FROM ogproduct INNER JOIN ogproductuse ON ogproduct.productCode=ogproductuse.productCode INNER JOIN ogproductsideeffect ON ogproduct.productCode=ogproductsideeffect.productCode INNER JOIN ogproductwarning ON ogproduct.productCode=ogproductwarning.productCode INNER JOIN ogproductinteraction ON ogproduct.productCode=ogproductinteraction.productCode WHERE ogproduct.productCode=?");
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
            $proArray['protype'] = $row['productType'];
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
            $genname = $row['productIngredientName'];
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

        // $getProductImageTable = $conn->prepare('SELECT * FROM ogproductimage WHERE productImageCode=?');
        // $getProductImageTable->execute([$productCode]);
        // while($row=$getProductImageTable->fetch(PDO::FETCH_ASSOC)){
        //     array_push($proImage, $row['productImagePath']);
        // }
        return $proImage;
    }

    // get USA product for shipping time

    function getNewCode($conn, $productName) {
        $usa = array();
        $productName = str_replace(" USA to USA", '', $productName);
        $matchUsa = $conn->prepare("SELECT * FROM ogproduct WHERE productName = '".$productName."'");
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

    function cartStrength($conn, $productCode, $userid) {
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

?>