<?php
    include('env.php');
    header("Content-type:application/json");
    header("Acess-Control-Allow-Ogrigin: https://".$INFO_WEBSITE_NAME ."/");
    
    // $con = mysqli_connect("localhost", "globa7ox_oneglobalbrandnew", "#[JZYJ,N?[mV", "globa7ox_oneglobalbrandnew");

    $actual_link = (isset($_SERVER['HTTP']) && $_SERVER['HTTPS']=== 'on' ? "https" : "http"). "://$_SERVER[HTTP_HOST]";
    if(strpos($actual_link, 'newlandpharmacy') OR strpos($actual_link, 'oneglobalpharma')){
        $con = mysqli_connect("newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com", "root",  "Iamawesome8425", "global",'3306');
    }elseif(strpos($actual_link, 'localhost')) {
        $con = mysqli_connect("localhost", "root",  "", "global",'3306');
    }else {
        $con = mysqli_connect("newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com", "root", "Iamawesome8425", "global",'3306');
    }

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
    $altArray = array();
    $altArray1 = array();
    $prnameArray = array();
    
    $pro = $_GET['productName'];
    $altmeds = "SELECT * FROM ogproductingredient WHERE productIngredientName LIKE '%".$pro."%'";
    $altmedname = mysqli_query($con, $altmeds) or die(mysqli_error($con));
    if(mysqli_num_rows($altmedname)>0){
        while ($altname = mysqli_fetch_assoc($altmedname)) {
            $codes= "'".$altname['productCode']."'";
            array_push($altArray1, $codes);
        }
    }
    
    $altmed = "SELECT * FROM ogproductaltname WHERE productAltName LIKE '%".$_GET['productName']."%'";
   
    $altmed = mysqli_query($con, $altmed) or die(mysqli_error($con));
    if(mysqli_num_rows($altmed)>0){
        while ($alt = mysqli_fetch_assoc($altmed)) {
            $code = "'".$alt['productCode']."'";
            array_push($altArray, $code);
        }
    }
    $pname = array_merge($altArray,$altArray1);
    $string_version = implode(',', $pname);
    // echo $string_version;
    if(!empty($pname)){
        $getproduct = "SELECT productName from ogproduct WHERE productCode IN (".$string_version.") AND productStatus='active'";
        $getproduct = mysqli_query($con, $getproduct) or die(mysqli_error($con));
        if(mysqli_num_rows($altmed)>0){
            while ($prodname = mysqli_fetch_assoc($getproduct)) {
                $name = "'".$prodname['productName']."'";
                array_push($prnameArray, $name);
            }
        } 
        $prod_version = implode(',', $prnameArray);
    }
    
        if(empty($pname)){
            $fetchSql = "SELECT * FROM ogproduct WHERE (productName LIKE '%".$_GET['productName']."%' OR productName='".$_GET['productName']."') AND productStatus='active'";
        }else {
            $fetchSql = "SELECT * FROM ogproduct WHERE (productCode IN (".$string_version.") OR productName LIKE '%".$_GET['productName']."%') AND productStatus='active'";
        }
        $fetchProduct = mysqli_query($con, $fetchSql) or die(mysqli_error($con));
        if(mysqli_num_rows($fetchProduct)>0){
            while ($product = mysqli_fetch_assoc($fetchProduct)) {
                $code = $product['productCode'];
                $mainProductArray['productName'] = $product['productName'];
                $mainProductArray['productCategory'] = $product['productCategory'];
                $mainProductArray['productImage'] = $product['productImage'];
                $mainProductArray['productSlug'] = $product['productSlug'];
                $mainProductArray['strength'] = "";
                $mainProductArray['price'] = "";
                $mainProductArray['ing'] = "";
                $strengthArr=array();
                $priceArr = array();
                $ing = array();
            
                $fetchStrength = mysqli_query($con, "SELECT * FROM ogstrength WHERE productCode = '$code' ") or die(mysqli_error($mysqli));
                while ($strength = mysqli_fetch_assoc($fetchStrength)) {
                    array_push($strengthArr, $strength['strengthName']);
                }
                
                $fetchQauntity = mysqli_query($con, "SELECT * FROM ogquantity WHERE productCode = '$code'  ORDER BY price ASC LIMIT 1") or die(mysqli_error($mysqli));
                while ($quantity = mysqli_fetch_assoc($fetchQauntity)) {
                    array_push($priceArr,$quantity['price']);
                }
                
                $fetchIng = mysqli_query($con, "SELECT * FROM ogproductingredient WHERE productCode = '$code'") or die(mysqli_error($mysqli));
                while ($ings = mysqli_fetch_assoc($fetchIng)) {
                    array_push($ing,$ings['productIngredientName']);
                }
                
                
                $strn=implode(",",$strengthArr);
                $price=implode(",",$priceArr);
                $ing=implode(",",$ing);
                $mainProductArray['strength']=$strn;
                $mainProductArray['price']=$price;
                $mainProductArray['ing']=$ing;
                array_push($productArray,$mainProductArray);
            }
            
            $jsonData = json_encode($productArray, JSON_PRETTY_PRINT);
        }
        else {
            $productArray=array();
            $mainProductArray['productName'] = "No record found";
            $mainProductArray['productImage'] = "No record found";
            $mainProductArray['productSlug'] = "No record found";
            $mainProductArray['productCategory'] = "No record found";
            $mainProductArray['strength'] = "No record found";
            $mainProductArray['ing'] = "No record found";
            $mainProductArray['price'] = "No record found";
            array_push($productArray,$mainProductArray);
            $jsonData = json_encode($productArray, JSON_PRETTY_PRINT);
        }
    
    echo $jsonData; 
    
?>
