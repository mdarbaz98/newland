<?php
    require_once "include/database.php";
    require_once("include/class.phpmailer.php");
    require_once("include/class.php");
    require 'vendor/autoload.php';
    // include('mail-structure.php');
    $userid = $_COOKIE["userID"];
    
    session_start();
    
    
    $lastID = $_POST['id'];
    $catName = $_POST['catName'];

    $showLimit = 8;
    $data="";
    
    // $getAllProd=$conn->prepare("SELECT * FROM ogproduct WHERE productCategory='$catName' && productId > ".$lastID);
    // $getAllProd->execute();  
    // $allProd=$getAllProd->rowCount();
    
    
    $getProduct=$conn->prepare("SELECT * FROM ogproduct WHERE productCategory LIKE'%".$catName."%' && productId > ".$lastID." AND productStatus='active' ORDER BY productId ASC limit ".$showLimit);
    $getProduct->execute();
    $totalProduct=$getProduct->rowCount();
    while($row=$getProduct->fetch(PDO::FETCH_ASSOC)){ 
        $productId = $row['productId'];
        $productName = $row['productName'];
        $productCode = $row['productCode'];
        $productCategory = $row['productCategory'];
        $productlower = strtolower($productCategory);
        $prductcategoryslug = str_replace(" ","-",$productlower);
        $productDetails = $row['productDescription'];
        $productDetails = $row['productDescription'];
                                $productImage = $row['productImage'];
                                if(strlen($productImage)>2 AND $productImage!='assets/images/products/'){
                                  $productImage = $row['productImage'];
                                }else {
                                  $productImage = 'defaultMed.png';
                                }
        $productImageAlt = $row['productImageAlt'];
        $productImageTitle = $row['productImageTitle'];
        $productType = $row['productType'];
        $productSlug = $row['productSlug'];
        $productDiscount = $row['productDiscount'];
        $productSeoTitle = $row['productSeoTitle'];
        $productSeoDescription = $row['productDescription'];
        $data.='<div class="col-lg-3 col-12">
                                <div class="card product-card pb-0 my-0">
                                  <div class="card-img-top d-block overflow-hidden">
                                      <a href="'.$prductcategoryslug.'/'.$productSlug.'">
                                        <img src="https://myglobal1.gumlet.io/onglobaladmincrm/'.$productImage.'" alt="'.$productImageAlt.'title="'.$productImageTitle.'">
                                      </a>
                                  </div>
                                  <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1">'.$productCategory.'</a>
                                    <a href="'.$prductcategoryslug.'/'.$productSlug.'">
                                    <h3 class="product-title fs-sm">'.$productName.'</h3>
                                    <p class="product-description d-flex justify-content-start  justify-lg-content-between">';
                                    if(strpos($productCategory,'Steroids')>0){
                                        $data.='<span>12 to 18 Days Standard Delivery</sapn>';
                                    }
                                    elseif(strpos($productName,'USA to USA')>0) {
                                        $data.='<span>5 to 7 Days USA to USA Shipping</sapn>';
                                    }
                                    else {
                                        $data.='<span>12 to 18 Days Standard Delivery</sapn>';
                                    }
                                 $data.='   
                                    </p>
                                    </a>';
                                        $select_product_price=$conn->prepare("SELECT * FROM ogquantity WHERE productCode='$productCode' ORDER BY price ASC limit 1");
                                        $select_product_price->execute();
                                        while($row=$select_product_price->fetch(PDO::FETCH_ASSOC))
                                        {
                                            $price = $row['price']; 
                                        }
                                    $data.='<p class="product-price">
                                      '.$_SESSION["currency_symbol"].number_format(($price*$_SESSION["currency_rate"]),2).'/<small>'.$productType.'</small>*';
                                        
                                            $selectDiscount=$conn->prepare("SELECT * FROM discount WHERE code='$productCode' && type='PROD' ORDER BY id DESC limit 1");
                                            $selectDiscount->execute();
                                            $total = $selectDiscount->rowCount();
                                            while($rowDis=$selectDiscount->fetch(PDO::FETCH_ASSOC))
                                            {
                                                $discount = $rowDis['discount']; 
                                            }
                                            if($total>0){
                                    $data.='  <span class="dis">'.$discount.'%Off</span>';
                                            }
                                            $data.='
                                      
                                    </p>
                                  </div>
                                </div>
                              </div>   
        ';
    }
    
    
    echo json_encode(array("data"=>$data,"productId"=>$productId));
?>





