<?php
    include('env.php');
    header("Content-type:application/json");
    header("Acess-Control-Allow-Ogrigin: https://".$INFO_WEBSITE_NAME ."/");
    
    $con = mysqli_connect("localhost", "globa7ox_oneglobalbrandnew", "#[JZYJ,N?[mV", "globa7ox_oneglobalbrandnew");

    if(!$con) {
        die('Could not connect: '.mysqli_error());
    }
    $per_page=8;
    $start=0;
    $current_page=1;
    if(isset($_GET['totData'])){
        $per_page=$_GET['totData'];
    }else {
        $per_page=8;
    }
    if(isset($_GET['page'])){
    	$start=$_GET['page'];
    	if($start<=0){
    		$start=0;
    		$current_page=1;
    	}else{
    		$current_page=$start;
    		$start--;
    		$start=$start*$per_page;
    	}
    }
    
    $productArray=array();
    $mainProductArray = array();
    $strengthArray = array();
    $quantityArray = array();
    
    $fetchSql = "SELECT * FROM `ogproduct` WHERE productImage='assets/images/products/'";
    
    if($_GET['productName']){
        $fetchSql .= " AND productName LIKE '%".$_GET['productName']."%' ";
    }
    if($_GET['categoryName']){
        $fetchSql .= " AND categorytName LIKE '%".$_GET['categoryName']."%' ";
    } 
    if($_GET['bestseller']){
        $fetchSql .= " AND besteller LIKE '%".$_GET['bestseller']."%' ";
    } 
    // $fetchSql .= " limit $start,$per_page";
    $fetchProduct = mysqli_query($con, $fetchSql) or die(mysqli_error($con));
    if(mysqli_num_rows($fetchProduct)>0){
        while ($product = mysqli_fetch_assoc($fetchProduct)) {
            $code = $product['productCode'];
            // $mainProductArray['productCode'] = $product['productCode'];
            $mainProductArray['productName'] = $product['productName'];
            $mainProductArray['productLink'] = 'onglobaladmincrm/update-product.php?code='.$product['productCode'];
            // $mainProductArray['bestseller'] = $product['bestseller'];
            // $mainProductArray['productDescription'] = $product['productDescription'];
            // $mainProductArray['productCategory'] = $product['productCategory'];
            // $mainProductArray['productType'] = $product['productType'];
            $mainProductArray['productImage'] = $product['productImage'];
            // $mainProductArray['productImageAlt'] = $product['productImageAlt'];
            // $mainProductArray['productImageTitle'] = $product['productImageTitle'];
            // $mainProductArray['productSlug'] = $product['productSlug'];
            // $mainProductArray['strength'] = array();
        
            // $fetchStrength = mysqli_query($con, "SELECT * FROM ogstrength WHERE productCode = '$code' ") or die(mysqli_error($mysqli));
            // while ($strength = mysqli_fetch_assoc($fetchStrength)) {
            //     $strengthCode= $strength['strengthCode'];
            //     $strengthArray['strengthCode'] = $strength['strengthCode'];
            //     $strengthArray['productCode'] = $strength['productCode'];
            //     $strengthArray['strengthName'] = $strength['strengthName'];
            //     $strengthArray['Quantity'] = array();
                
            //     $fetchQauntity = mysqli_query($con, "SELECT * FROM ogquantity WHERE strengthCode = '$strengthCode' ") or die(mysqli_error($mysqli));
            //     while ($quantity = mysqli_fetch_assoc($fetchQauntity)) {
            //         $quantityArray['quantityCode'] = $quantity['quantityCode'];
            //         $quantityArray['quantity'] = $quantity['quantity'];
            //         $quantityArray['price'] = $quantity['price'];
            //         array_push($strengthArray['Quantity'],$quantityArray);
            //     }
            //     array_push($mainProductArray['strength'],$strengthArray);
            // }
        
            array_push($productArray,$mainProductArray);
        }
        
        $jsonData = json_encode($productArray, JSON_PRETTY_PRINT);
    }
    else {
        $jsonData = json_encode(array('message'=>"No record found", 'status' => false));
    }
    
    
    echo $jsonData; 
    
?>