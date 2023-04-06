<?php
include('include/database.php');  
    function category($category="Allergy Medications"){
            $select_product=$conn->prepare("SELECT * FROM ogproduct WHERE productCategory=".$category." limit 7");
            $select_product->execute();  
            $row=$select_product->rowCount();
            while($row=$select_product->fetch(PDO::FETCH_ASSOC))
            {
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
            
            $message='<div class="pb-2">
                <a href="'.$prductcategoryslug.'/'.$productSlug.'">
                <div class="card product-card pb-3">
                  <a class="card-img-top d-block overflow-hidden" href="'.$prductcategoryslug.'/'.$productSlug.'">
                      <img src="onglobaladmincrm/'.$productImage.'" alt="'.$productImageAlt.'" title="'.$productImageTitle.'">
                  </a>
                <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">'.$productCategory.'</a>
                    <h3 class="product-title fs-sm">'.$productName.'</h3>
                    <p class="product-description d-flex justify-content-between">
                      <span><i class="ci-star-filled"></i> &nbsp;5.0 (48)</span>
                      <!-- <span class="dis">15%Off</span> -->
                      <span>7 Days Delivery</sapn>
                    </p>';
                    
                        $select_product_price=$conn->prepare("SELECT * FROM ogquantity WHERE productCode='$productCode' ORDER BY price ASC limit 1");
                        $select_product_price->execute();
                        while($row=$select_product_price->fetch(PDO::FETCH_ASSOC))
                        {
                            $price = $row['price']; 
                        }
                    
                    $message.='<p class="product-price">
                      $'.$price.'/<small>'.$productType.'</small>*
                      <span class="dis">15%Off</span>
                    </p>
                 </div>
                  <div class="card-body">
                    <div class="text-center">';
                      
                        $select_strength=$conn->prepare("SELECT * FROM ogstrength WHERE productCode='$productCode'");
                        $select_strength->execute();  
                        $row1=$select_strength->rowCount();
                        $i = 0;
                        $x = 0;
                        while($row1=$select_strength->fetch(PDO::FETCH_ASSOC))
                        {
                          $i++;
                          $x++;
                          $strengthName = $row1['strengthName'];
                          $strengthCode = $row1['strengthCode'];
                          $productCode = $row1['productCode'];
                      
                      $message.='<div class="form-check form-option form-check-inline">
                        <input class="form-check-input" onclick="shopAddCart(this)" data-product-name="'.$productName.'" data-product-type="'.$productType.'" data-product-image="'.$productImage.'" data-strength-name="'.$strengthName.'" data-product-code="'.$productCode.'" data-strength-code="'.$strengthCode.'" type="radio" id="'.$productCode.$i.$x.'" name="'.$productCode.'">
                        <label class="form-option-label" for="'.$productCode.$i.$x.'">'.$strengthName.'</label>
                      </div>
                      
                        }
                      
                    </div>
                  </div>
                </div>
                <hr class="d-sm-none">
                </div>';
            
            }
                return $message;
            }   
    }
?>
            